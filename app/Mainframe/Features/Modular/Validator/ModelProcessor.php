<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnused */
/** @noinspection PhpExpressionResultUnusedInspection */

namespace App\Mainframe\Features\Modular\Validator;

use App\Mainframe\Features\Core\Traits\Validable;
use App\Mainframe\Features\Modular\BaseModule\Traits\HasElement;
use App\Mainframe\Features\Modular\Immutable\HasImmutables;
use App\Mainframe\Jobs\JobAsyncSave;
use App\Mainframe\Jobs\JobSyncData;
use App\Module;
use Arr;
use Illuminate\Support\Str;
use Validator;

class ModelProcessor
{
    use HasElement, HasImmutables, Validable;

    /**
     * Current user
     */
    public $user;

    /**
     * Event: create, update, delete, restore
     *
     * @var 'create'|'update'|'delete'|'restore'
     */
    public $event;

    /**
     * Module
     *
     * @var Module
     */
    public $module;

    /**
     * Element hydrated with new values
     *
     * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public $element;

    /**
     * An array that has the original value of the element.
     * Field names are array keys.
     *
     * @var array<string, mixed>
     */
    public array $original;

    /**
     * Old element(object) filled with old values
     *
     * @var ?\App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public $oldElement;

    /**
     * Fields that cannot be changed once the element is created.
     *
     * @var array
     */
    public $immutables = [];

    /**
     * Define the allowed strict value change of specific fields
     *
     * @var array
     */
    public $transitions = [
        // 'status' => [
        //     'New' => ['In Progress', 'Closed'],
        // ],
    ];

    /**
     * Field that should be explicitly tracked in the DB table: changes
     *
     * @var array
     */
    public $trackedFields = [];

    /**
     * MainframeModelValidator constructor.
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule|mixed  $element
     */
    public function __construct($element)
    {
        $this->element = $element;
        $this->user = user();
        $this->original = $element->getOriginal();
        $this->module = $element->module();
    }

    /**
     * Setter for event
     *
     * @return void
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * Fill the model with values. This is helpful when a model has additional
     * fields that are not filled through mass assignment but need to be
     * filled so that the data is locally available. Often in the
     * case of an id-name pair id will be filled by mass assignment,
     * but the name needs to be autofilled in this method.
     *
     * @param  $element  \App\Mainframe\Features\Modular\BaseModule\BaseModule|mixed
     * @return $this
     */
    public function fill($element)
    {
        return $this;
    }

    /**
     * Laravel validator validation rules.
     *
     * @param  mixed  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,255|unique:modules,name,'.(isset($element->id) ? (string) $element->id : 'null').',id,deleted_at,NULL',

            'is_active' => 'required|in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /**
     * Custom error messages for the validation rules above.
     *
     * @param  array  $merge
     * @return array
     */
    public static function customErrorMessages($merge = [])
    {
        $messages = [];

        return array_merge($messages, $merge);
    }

    /**
     * Custom attributes for the validation rules above.
     *
     * @param  array  $merge
     * @return array
     */
    public static function customAttributes($merge = [])
    {
        $attributes = [];

        return array_merge($attributes, $merge);
    }

    /**
     * Run Laravel validation
     *
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function validate()
    {
        $this->validator = Validator::make($this->element->getAttributes(), $this::rules($this->element),
            $this::customErrorMessages(), $this::customAttributes());

        return $this->validator;
    }

    /**
     * Merge validation error to MessageBag
     *
     * @return $this
     */
    public function sendToMessageBag()
    {
        $msg = 'Operation Failed';
        if ($this->event == 'create') {
            $msg = 'Failed to create new '.lcfirst(Str::singular($this->module->title));
        }
        if ($this->event == 'update') {
            $msg = 'Failed to update '.Str::singular($this->module->title.' ('.$this->element->id.')');
        }
        if ($this->event == 'delete') {
            $msg = 'Failed to delete '.Str::singular($this->module->title.' ('.$this->element->id.')');
        }

        $this->addErrorMessage($msg);
        $this->addValidatorErrors($this->validator);

        return $this;
    }

    /**
     * Invalidate if the value of an immutable field has been changed.
     *
     * @return $this
     */
    public function validateImmutables()
    {
        foreach ($this->getImmutables() as $field) {
            if ($this->element->fieldHasChanged($field)) {
                // $this->fieldError($field, 'Value of '.$field.' cannot be changed at this stage.');
                $original = $this->original($field);
                $updated = $this->element->$field;

                if (! is_string($original)) {
                    $original = json_encode($original);
                }
                if (! is_string($updated)) {
                    $updated = json_encode($updated);
                }

                if ($original == $updated) {
                    return $this;
                }

                $this->fieldError($field, "$field:  can not be changed '$original' > '$updated' at this stage "."[{$this->module->title}#{$this->element->id}]");
            }
        }

        return $this;
    }

    /**
     * Checks if all the transitions are valid.
     *
     * @return $this
     */
    public function validateTransitions()
    {
        $allTransitions = $this->transitions();

        foreach ($allTransitions as $field => $transition) {
            if ($this->element->fieldHasChanged($field)) {
                $change = $this->element->transition($field);
                $old = $change['old'];
                $new = $change['new'];

                // Handle enum
                if (isset($old->value)) {
                    $old = $old->value;
                }

                if (isset($new->value)) {
                    $new = $new->value;
                }

                if ($change && ! $this->transitionIsAllowed($field, $old, $new)) {
                    $this->fieldError($field,
                        ucfirst($field)." - can not be updated from  '$old' to '$new'");
                }
            }
        }

        return $this;
    }

    /**
     * Check if a field has been just created some value. This function is useful
     * inside processor saved()
     *
     * @return bool
     */
    public function justCreatedWith($field, $value)
    {
        if ($this->event !== 'create') {
            return false;
        }

        if ($value == $this->element->$field) {
            return true;
        }

        return false;
    }

    /**
     * Get old and new value of a changed field
     */
    public function transitionOf(string $field): ?array
    {
        // Previous $this->element->fieldHasChanged($field)
        if ($this->fieldHasChanged($field)) {
            return ['field' => $field, 'old' => $this->original($field), 'new' => $this->element->$field];
        }

        return null;
    }

    /**
     * Get the change of a specific field
     *
     * @return array|null
     */
    public function fieldChange($field)
    {
        return $this->transitionOf($field);
    }

    /**
     * Check if any of the given fields has changed
     *
     * @param  array|string  $fields
     * @return bool
     */
    public function fieldHasChanged($fields)
    {
        $fields = Arr::wrap($fields);

        if (! $this->element->isUpdating()) {
            return false;
        }

        return array_any($fields, fn ($field) => $this->original($field) != $this->element->$field);
    }

    /**
     * Check if any of the fields have changed.
     *
     * @param  array  $fields
     * @return bool
     */
    public function anyFieldHasChanged($fields = [])
    {
        return $this->fieldHasChanged($fields);
    }

    /**
     * Check if all the fields have changed
     *
     * @param  array  $fields
     * @return bool
     */
    public function allFieldsHavChanged($fields = [])
    {
        return array_all($fields, fn ($field) => $this->fieldHasChanged($field));
    }

    /**
     * Check if a transition from a specific value to another specific value took place
     * for the given field
     *
     * @param  string  $field
     * @param  mixed  $from
     * @param  mixed  $to
     * @return bool
     */
    public function hasTransition($field, $from, $to)
    {
        if (! is_array($from)) {
            $from = [$from];
        }

        if (! is_array($to)) {
            $to = [$to];
        }

        $change = $this->transitionOf($field);

        if ($change) {
            return in_array($change['old'], $from) && in_array($change['new'], $to);
        }

        return false;
    }

    /**
     * Check if a transition from a specific value happened
     *
     * @param  array<string>|string  $from
     */
    public function hasTransitionFrom(string $field, array|string $from): bool
    {
        if (! is_array($from)) {
            $from = [$from];
        }

        $change = $this->transitionOf($field);

        if ($change) {
            return in_array($change['old'], $from);
        }

        return false;
    }

    /**
     * Check if a transition to a specific value happened
     *
     * @param  string  $field
     * @param  mixed  $to
     * @return bool
     */
    public function hasTransitionTo($field, $to)
    {
        if (! is_array($to)) {
            $to = [$to];
        }

        $change = $this->transitionOf($field);

        if ($change) {
            return in_array($change['new'], $to);
        }

        return false;
    }

    /**
     * Check if a value transition is allowed.
     *
     * @param  string  $field
     * @param  mixed  $from
     * @param  mixed  $to
     * @return bool
     */
    public function transitionIsAllowed($field, $from, $to)
    {
        // Handle enum
        if (isset($from->value)) {
            $from = $from->value;
        }

        if (isset($to->value)) {
            $to = $to->value;
        }

        $allTransitions = $this->transitions();

        if (! isset($allTransitions[$field])) {
            return true;
        }

        if (! isset($allTransitions[$field][$from])) {
            return true;
        }

        $transitions = Arr::wrap($allTransitions[$field][$from]);

        return in_array('*', $transitions) || in_array($to, $transitions);
    }

    /**
     * Get an array of allowed next transition values
     *
     * @param  string  $field
     * @param  ?non-empty-string  $from
     * @return array
     */
    public function allowedTransitionsOf($field, $from = null)
    {
        $from = $from ?: $this->original($field);
        $allTransitions = $this->transitions();

        if (isset($allTransitions[$field][$from])) {
            return array_merge($allTransitions[$field][$from], [$from]); // Merge the same item
        }

        return Arr::wrap($from);
    }

    /**
     * Check if a relation exists for the element. This checking is useful to restrict deletion
     *  if a relation exists
     *
     * @param  array  $relations
     * @param  int  $limit
     * @return $this
     *
     * @alias invalidIfRelationsExist
     *
     * @deprecated use invalidIfRelationsExist
     */
    public function checkExistingRelations($relations = [], $limit = 10)
    {
        return $this->invalidIfRelationsExist($relations, $limit);
    }

    /**
     * Check if a relation exists for the element. This checking is useful to restrict deletion
     * if a relation exists
     *
     * @return $this
     */
    public function invalidIfRelationsExist($relations = [], $limit = 10)
    {
        foreach ($relations as $relation) {
            $this->checkExistingRelation($relation, $limit);
        }

        return $this;
    }

    /**
     * Check if a relation exists for the element. This checking is useful to restrict deletion
     * if a relation exists
     *
     * @param  int  $limit
     * @param  mixed  $msg
     * @return $this
     */
    public function checkExistingRelation($relation, $limit = 10, $msg = null)
    {
        $msg = $msg ?? ' related '.str_replace('_', ' ', Str::snake($relation)).' found';

        $relation = $this->element->{$relation}();
        $existingCount = $relation->count();
        if (! $existingCount) {
            return $this;
        }

        $sampleIds = $relation->limit($limit)->pluck('id')->toArray();

        $fullMsg = $existingCount.$msg.'. Id '.implode(', ', $sampleIds);

        if ($existingCount > $limit) {
            $fullMsg .= ' ... and more.';
        }

        $this->error($fullMsg);

        return $this;
    }

    /**
     * Define the allowed transitions in array and return
     *
     * @return array
     */
    public function transitions()
    {
        return $this->transitions;
    }

    /**
     * Get a list of immutable fields
     *
     * @return array
     *
     * @deprecated use transitions
     */
    public function getTransitions()
    {
        return $this->transitions();
    }

    public function getTrackedFields()
    {
        return array_merge($this->trackedFields, array_keys($this->transitions));
    }

    /**
     * Get the original value. If the original value does not exist, return null
     *
     * @return mixed
     */
    public function original($key)
    {
        return $this->original[$key] ?? null;
    }

    /**
     * Generic function to process all validation logic. This function auto
     * determines whether it should call the creating() or updating()
     * logic based on the existence of id field in the element.
     *
     * @return $this
     */
    public function run()
    {
        return $this->forSave();
    }

    /**
     * Dry runs all the validation logics for saving
     *
     * @return $this
     */
    public function checkForSave()
    {
        return $this->forSave();
    }

    /**
     * Dry runs all the validation logics for delete
     *
     * @return $this
     */
    public function checkForDelete()
    {
        return $this->forDelete();
    }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    |
    | Model events where validation is checked. These events refer to intentions.
    | If you are attempting to save a model in some place of your application
    | Then you should call the save() processor function.
    */

    /**
     * Run the steps for save
     *
     * @param  ?\App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
     * @return $this
     */
    public function forSave($element = null)
    {
        $element = $element ?: $this->element;
        $element->autoFill();
        $this->fill($element)->validate();

        if (! $this->isValid()) {
            return $this;
        }

        $this->preSaving(); // inject project-specific business logic
        $this->saving($element);

        if ($element->isCreating()) {
            $this->preCreating(); // inject project-specific business logic

            return $this->creating($element);
        }

        if ($element->isUpdating()) {
            $this->preUpdating();

            return $this->updating($element);
        }

        return $this;
    }

    /**
     * Function that should execute prior saving
     *
     * @return $this
     */
    public function preSaving()
    {
        return $this;
    }

    /**
     * Save the element
     */
    public function save()
    {
        // echo 'In Processor Save() ';

        $this->event = $this->element->isCreating() ? 'create' : 'update';

        // Run validation, call saving, then call creating/updating
        $this->forSave();

        if (! $this->isValid()) { // If invalid, add a message to the message-bag
            $this->sendToMessageBag();

            return $this;
        }

        // If valid, attempt model save operation
        if (! $this->element->save()) {
            $this->error('Error: Can not be saved.');

            return $this;
        }

        // Saved successfully
        if ($this->event == 'create') { // Trigger created()
            $this->created($this->element);
        }

        if ($this->event == 'update') { // Trigger updated()
            $this->updated($this->element);
        }

        $this->saved($this->element); // Trigger saved()

        return $this;
    }

    /**
     * Save the element
     */
    public function saveQuietly()
    {
        if ($this->forSave()->isValid()) {
            $this->element->saveQuietly();
        }

        return $this;
    }

    /**
     * Save using Job/Queue
     *
     * @return \App\Mainframe\Features\Modular\Validator\ModelProcessor
     */
    public function saveAsync()
    {
        JobAsyncSave::dispatch($this);

        return $this;
    }

    // /**
    //  * Run validation for 'create'. This initially runs the save()
    //  * validation checks then loads creating() checks.
    //  *
    //  * @param  ?\App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
    //  * @return $this
    //  */
    // public function forCreate($element = null)
    // {
    //     $element = $element ?: $this->element;
    //
    //     $this->fill($element)->validate();
    //
    //     $this->saving($element);
    //     $this->preCreating();
    //     $this->creating($element);
    //
    //     return $this;
    // }

    /**
     * Run common codes before update.
     *
     * @return $this
     */
    public function preCreating()
    {
        // $this->checkImmutables(); // Example
        // $this->checkTransitions(); // Example

        return $this;
    }

    /**
     * Create the element
     */
    // public function create()
    // {
    //     if ($this->forCreate()->valid()) {
    //         $this->element->save();
    //     }
    //
    //     return $this;
    // }

    // /**
    //  * Run validation for update.
    //  *
    //  * @param  ?\App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
    //  * @return $this
    //  */
    // public function forUpdate($element = null)
    // {
    //     $element = $element ?: $this->element;
    //     $this->fill($element)->validate();
    //
    //     $this->saving($element);
    //     $this->preUpdating();
    //     $this->updating($element);
    //
    //     return $this;
    // }

    /**
     * Run common codes before update.
     *
     * @return $this
     */
    public function preUpdating()
    {
        $this->oldElement = $this->oldElement ?: (clone $this->element)->refresh();
        $this->validateImmutables();
        $this->validateTransitions();

        return $this;
    }

    /**
     * Create the element
     */
    // public function update()
    // {
    //     if ($this->forUpdate()->valid()) {
    //         $this->element->save();
    //     }
    //
    //     return $this;
    // }

    /**
     * Run validation for delete.
     *
     * @param  ?\App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
     * @return $this
     */
    public function forDelete($element = null)
    {
        $element = $element ?: $this->element;
        $element->deleted_by = user()->id; // Fill with the deleter id.
        $this->preDeleting();
        $this->deleting($element);

        return $this;
    }

    /**
     * Run common codes before delete
     */
    public function preDeleting() {}

    /**
     * Create the element
     *
     * @throws \Exception
     */
    public function delete()
    {
        // echo 'In Processor delete() ';
        $this->event = 'delete';

        $this->forDelete();

        if (! $this->isValid()) {
            $this->sendToMessageBag();

            return $this;
        }

        if (! $this->element->delete()) {
            $this->error('Error: This action is restricted. You can not delete');

            return $this;
        }

        $this->element->saveQuietly(); // Set deleted by field

        $this->deleted($this->element);

        return $this;
    }

    /**
     * Run validation for restore.
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule|mixed  $element
     * @return $this
     */
    public function restore($element = null)
    {
        $element = $element ?: $this->element;

        $this->event = 'restore';
        $this->forSave();
        $this->restoring($element);

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Data sync between different tables.
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Propagate data from one table to another if one of the given fields
     * has changed.
     *
     * @return void
     */
    public function syncDataForChanges(array $fields = [])
    {
        if ($this->fieldHasChanged($fields)) {
            JobSyncData::dispatch($this->element);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | Event specific validation
    |--------------------------------------------------------------------------
    |
    | Following functions are overridden in model validators to write
    | event-specific validation logic.
    */

    /**
     * Saving validation.
     * Common for both 'create' and 'update'.
     *
     * @return $this
     */
    public function saving($element)
    {
        // echo 'In Processor saving(). ';

        return $this;
    }

    /**
     * Creating validation
     *
     * @return $this
     */
    public function creating($element)
    {
        // echo 'In Processor creating(). ';

        return $this;
    }

    /**
     * Created validation.
     *
     * @return $this
     */
    public function created($element)
    {
        // echo 'In Processor created(). ';

        return $this;
    }

    /**
     * Updating validation
     *
     * @return $this
     */
    public function updating($element)
    {
        // echo 'In Processor updating(). ';

        return $this;
    }

    /**
     * Updating validation
     *
     * @return $this
     */
    public function updated($element)
    {
        // echo 'In Processor updated(). ';

        return $this;
    }

    /**
     * Saved validation.
     * Common for both 'created' and 'updated'.
     *
     * @return $this
     */
    public function saved($element)
    {
        // echo 'In Processor saved(). ';

        return $this;
    }

    /**
     * Deleting validation
     *
     * @return $this
     */
    public function deleting($element)
    {
        // echo 'In Processor deleting(). ';

        return $this;
    }

    /**
     * Deleting validation
     *
     * @return $this
     */
    public function deleted($element)
    {
        // echo 'In Processor deleted(). ';

        return $this;
    }

    /**
     * Restoring validation
     *
     * @return $this
     */
    public function restoring($element)
    {
        // echo 'In Processor restoring(). ';

        return $this;
    }

    /**
     * Restoring validation
     *
     * @return $this
     */
    public function restored($element)
    {
        // echo 'In Processor restored(). ';

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Tenant validations
    |--------------------------------------------------------------------------
    |
    |
    */
    // /**
    //  * Check if the name is duplicate within a tenant. The same name can be used by
    //  * other tenants.
    //  * The logic has been moved to \App\Mainframe\Rules\CheckCrossTenantDuplication
    //  *
    //  * @return $this
    //  */
    // public function checkCrossTenantNameDuplication()
    // {
    //     $element = $this->element;
    //
    //     $query = $element->where('name', $element->name);
    //
    //     if ($element->tenant_id) {
    //         $query->where(function ($q) use ($element) {
    //             /** @var \Illuminate\Database\Query\Builder $q */
    //             $q->whereNull('tenant_id')
    //                 ->orWhere('tenant_id', Tenant::globalTenantId())
    //                 ->orWhere('tenant_id', $element->tenant_id);
    //         });
    //     }
    //
    //     if ($element->isEditing()) {
    //         $query->where('id', '!=', $element->id);
    //     }
    //
    //     if ($query->exists()) {
    //         $this->error('The name already exists', 'name');
    //     }
    //
    //     return $this;
    // }

    /**
     * Check if uploadable must have one upload
     *
     * @param  string  $class  A class name i.e. \App\User
     * @return $this
     */
    public function checkMinimumUploadRequirement(string $class, ?string $type = null, ?int $min = 1): static
    {
        $upload = $this->element;
        $min = $min ?: 1;

        if ($upload->uploadable_type != $class) {
            return $this;
        }

        if ($type == null) {
            if ($upload->uploadable->uploads()->count() < $min) {
                $this->error("At least $min file(s) are required. Upload a new file to replace current one");
            }

            return $this;
        }

        if ($upload->uploadable->uploads()->where('type', $type)->count() == $min) {
            $this->error("At least $min file(s) of type:$type is required. Upload a new file to replace current one");
        }

        return $this;
    }
}
