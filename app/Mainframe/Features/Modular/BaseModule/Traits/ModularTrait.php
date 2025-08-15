<?php
/** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpUnused */
/** @noinspection UnknownTableOrViewInspection */

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

use DB;
use Str;
use App\User;
use App\Change;
use App\Module;
use App\Spread;
use App\Tenant;
use App\Upload;
use App\Comment;
use App\Project;
use App\Mainframe\Helpers\Mf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Mainframe\Features\Core\ViewProcessor;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;

/** @mixin User $this */
trait ModularTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Default getters
    |--------------------------------------------------------------------------
    */

    /**
     * Get module name
     *
     * @return string|null
     */
    public function moduleName()
    {
        return $this->moduleName ?? null;
    }

    /**
     * Check if tenant is enabled
     *
     * @return bool
     * @depricated use isTenant
     */
    public function tenantEnabled()
    {
        return $this->isTenantEnabled();
    }

    /**
     * Check if tenant is enabled
     *
     * @return bool
     * @alias for tenantEnabled
     */
    public function isTenantEnabled()
    {
        return $this->tenantEnabled ?? false;
    }

    /**
     * Get the defined array of spread field names
     *
     * @return array|string[]
     */
    public function spreadFields()
    {
        return $this->spreadFields ?? [];
    }

    /**
     * Get the defined tag field names array
     *
     * @return array
     */
    public function getTagFields()
    {
        return $this->tagFields ?? [];
    }

    /**
     * Check if showing global tenant elements(tenant_id = 0) is enabled. If this is enabled,
     * then elements of global tenants (tenant_id = 0) will be shown in listing
     * and dropdowns.
     *
     * @return bool
     */
    public function showGlobalTenantElements()
    {
        return $this->showGlobalTenantElements ?? false;
    }

    /**
     * Check if non-tenant elements(tenant_id = null) are enabled. If this is enabled,
     * then non-tenant elements(tenant_id = null) will be shown in listing and dropdowns.
     *
     * @return bool
     */
    public function showNonTenantElements()
    {
        return $this->showNonTenantElements ?? false;
    }

    /**
     * Get the $append value
     *
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    /**
     * Get the $with value
     *
     * @return array
     */
    public function getWith()
    {
        return $this->with;
    }

    /*
    |--------------------------------------------------------------------------
    | Section Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    | Scopes allow you to easily re-use query logic in your models. To define
    | a scope, simply prefix a model method with scope:
    */

    /**
     * Eloquent query scope for $query->active()
     *
     * @param $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where($this->getTable().'.is_active', 1);
    }


    /*
    |--------------------------------------------------------------------------
    | Modular features
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Get the module of the element
     *
     * @return Module
     */
    public function module()
    {
        return Module::byName($this->moduleName);
    }

    /**
     * Get the class path of the root model (located in app\)
     *
     * @return string
     */
    public function rootModel()
    {
        return 'App\\'.class_basename($this);
    }


    /**
     * Gets all attribute names except the specified array.
     * Shorthand function for getAttributeKeysExcept.
     *
     * @param  array  $except
     * @return array
     */
    public function fields($except = [])
    {
        return $this->getAttributeKeysExcept($except);
    }

    /**
     * Get all attributes
     *
     * @return array
     */
    public function getAttributeKeys()
    {
        return array_keys($this->getAttributes());
    }

    /**
     * Get attributes except
     *
     * @param  array  $except
     * @return array
     */
    public function getAttributeKeysExcept($except = [])
    {
        return collect($this->getAttributes())->except($except)->keys()->toArray();
    }

    /**
     * Check if a model table has a given column
     *
     * @param  string  $column
     * @return bool
     */
    public function hasColumn($column)
    {
        return in_array($column, $this->tableColumns());
    }

    /**
     * Get an array of columns that ends with the given string
     *
     * @param $str
     * @return array
     */
    public function getColumnsThatEndsWith($str)
    {
        $found = [];
        $columns = $this->tableColumns();
        foreach ($columns as $column) {
            if (Str::endsWith($str, $column)) {
                $found[] = $column;
            }
        }
        return $found;
    }

    /**
     * Get all the table columns of the model
     *
     * @return array
     * @depricated
     * @alias for columns()
     */
    public function tableColumns()
    {
        return $this->columns();
    }

    /**
     * Get all the table columns of the model
     *
     * @return array
     */
    public function columns()
    {
        return Mf::tableColumns($this->getTable());
    }


    /*
    |--------------------------------------------------------------------------
    | Section : Changes and value transition related functions
    |--------------------------------------------------------------------------
    | Audit and change related methods
    |
    */

    /**
     * Get the latest changes.
     * http://www.laravel-auditing.com
     *
     * @return mixed
     */
    public function latestChanges()
    {
        return $this->audits()->latest()->first()->getModified();
    }

    /**
     * Check if the value of a field has changed
     *
     * @param $field
     * @return bool
     */
    public function fieldHasChanged($field)
    {
        if (array_key_exists($field, $this->getChanges())) {
            return true; // This only works inside boot::saved()
        }

        if (($this->isUpdating() && isset($this->$field)) && $this->getOriginal($field) != $this->$field) {
            return true;
        }

        return false;
    }

    /**
     * Get the last updater user of a field
     *
     * @param  string  $field
     * @return Model|\Illuminate\Database\Query\Builder|mixed|null
     */
    public function updaterOfField($field)
    {
        $audits = $this->audits()->latest()->get();

        $userId = null;

        foreach ($audits as $audit) {
            $userId = $audit->user_id;
            $changes = $audit->getModified();
            if (array_key_exists($field, $changes)) {
                break;
            }
        }

        if ($userId) {
            return User::remember(timer('long'))->find($userId);
        }

        return $this->creator;
    }

    /**
     * Get old and new value of a changed field
     *
     * @param $field
     * @return array
     */
    public function transition($field)
    {
        if ($this->fieldHasChanged($field)) {
            return [
                'field' => $field,
                'old' => $this->getOriginal($field),
                'new' => $this->$field,
            ];
        }

        return null;
    }

    /**
     * Check if a certain transition took place.
     *
     * @param  string  $field
     * @param  string|array  $from
     * @param  string|array  $to
     * @return bool
     */
    public function hasTransition($field, $from, $to)
    {
        if (!is_array($from)) {
            $from = [$from];
        }

        if (!is_array($to)) {
            $to = [$to];
        }

        $change = $this->transition($field);

        if ($change) {
            return in_array($change['old'], $from) && in_array($change['new'], $to);
        }

        return false;
    }

    /**
     * Check if a field value is changed from a specific value
     *
     * @param  string  $field
     * @param  string|array  $from
     * @return bool
     */
    public function hasTransitionFrom($field, $from)
    {
        if (!is_array($from)) {
            $from = [$from];
        }

        $change = $this->transition($field);

        if ($change) {
            return in_array($change['old'], $from);
        }

        return false;
    }

    /**
     * Check if a field value is changed to a specific value
     *
     * @param  string  $field
     * @param  array|string  $to
     * @return bool
     */
    public function hasTransitionTo($field, $to)
    {
        if (!is_array($to)) {
            $to = [$to];
        }

        $change = $this->transition($field);

        if ($change) {
            return in_array($change['new'], $to);
        }

        return false;
    }

    /**
     * Get an array of allowed next transition values for a specific field
     *
     * @param $field
     * @param  null  $from
     * @return array
     */
    public function allowedTransitionsOf($field, $from = null)
    {
        $from = $from ?: $this->$field; // from current value

        return $this->processor()->allowedTransitionsOf($field, $from);
    }

    /**
     * Store tracked changes in changes table
     *
     * @return $this
     */
    public function trackFieldChanges()
    {
        $fields = $this->processor()->getTrackedFields();

        foreach ($fields as $field) {
            if ($this->fieldHasChanged($field)) {
                $transition = $this->transition($field);
                $this->changes()->create([
                    'module_id' => $this->module()->id,
                    'element_id' => $this->id,
                    'element_uuid' => $this->uuid,
                    'field' => $field,
                    'old' => $transition['old'],
                    'new' => $transition['new'],
                ]);
            }
        }

        return $this;
    }

    /**
     * Get a change from a tracked field.
     *
     * @param $field
     * @return HasMany
     */
    public function track($field)
    {
        return $this->changes()->where('field', $field);
    }

    /*
    |--------------------------------------------------------------------------
    | Section: User related functions
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Returns an array of user ids including creator and updater user ids.
     * This can be overridden in different modules as per business.
     *
     * @return array
     */
    public function relatedUserIds()
    {
        $userIds = []; // Init array to store all user ids
        if (isset($this->creator->id)) {
            $userIds[] = $this->creator->id;
        }
        // Get the creator
        // if the creator and updater are same, no need to add the id twice
        if (isset($this->updater->id, $this->creator->id) && $this->creator->id !== $this->updater->id) {
            $userIds[] = $this->updater->id;
        } //get the updater

        return $userIds;
    }

    /*
    |--------------------------------------------------------------------------
    | Tenants & Project related functions
    |--------------------------------------------------------------------------
    */

    /**
     * Checks if a user has tenant context
     *
     * @return bool
     * @internal param $name
     */
    public function hasTenantContext()
    {
        return $this->hasColumn('tenant_id') && $this->tenantEnabled;
    }

    /**
     * Check if the element is compatible with the user's tenant
     *
     * @param  null  $user
     * @return bool
     */
    public function isTenantCompatible($user = null)
    {
        $user = $user ?: user();

        if (!$this->hasTenantContext()) {
            return true;
        }

        // If the element (tenant=null) then it is a global element and should be accessible by all the tenants
        if ($this->tenant_id == null) {
            return true;
        }

        if (($user->tenant_id) && ($this->tenant_id != $user->tenant_id)) {
            return false;
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Form states and attributes based on element state
    |--------------------------------------------------------------------------
    |
    */
    public function formState()
    {
        if ($this->isCreating()) {
            return 'create';
        }

        return 'edit';
    }

    public function formMethod()
    {
        if ($this->isCreating()) {
            return 'POST';
        }

        return 'PATCH';
    }

    public function formAction()
    {
        if ($this->isCreating()) {
            return $this->storeUrl();
        }

        return $this->updateUrl();
    }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Check if the model is being created at the moment.
     * If true, then the model has not been stored yet.
     *
     * @return bool
     */
    public function isCreating()
    {
        return !$this->isUpdating();
    }

    /**
     * Check if the model is being edited/updated.
     *
     * @return bool
     */
    public function isUpdating()
    {
        return $this->isEditing();
    }

    /**
     * Check if the model is being edited/updated.
     *
     * @return bool
     */
    public function isEditing()
    {
        return isset($this->id);
    }

    /**
     * Check if the model has been stored in the database.
     *
     * @return bool
     */
    public function isCreated()
    {
        return $this->isUpdating();
    }

    /**
     * Disable firing model events.
     * Useful for avoiding infinite loop scenario.
     *
     * @return $this
     */
    public function disableEvents()
    {
        /** @var Model $model */
        $model = $this->module()->model;
        $model::unsetEventDispatcher();

        return $this;
    }

    /**
     * Note: Native laravel 11 function
     * Disable model events while saving.
     *
     * @param  array  $options
     * @return mixed
     */
    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }
    /*
    |--------------------------------------------------------------------------
    | Processor related functions
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Get the processor for this element
     *
     * @return \App\Mainframe\Features\Modular\Validator\ModelProcessor|mixed
     */
    public function processor()
    {
        return $this->module()->processorInstance($this);
    }

    /**
     * Shorthand function for processor
     *
     * @return \App\Mainframe\Features\Modular\Validator\ModelProcessor|mixed
     */
    public function process()
    {
        return $this->processor();
    }

    /**
     * Get a processed element after running the processor logic.
     * This element may not be fully valid.
     *
     * @return $this
     */
    public function processed()
    {
        return $this->process()->forSave()->element;
    }

    /**
     * Check if an element is valid for saving.
     * This runs the full business logic of processor but doesn't save.
     *
     * @return bool
     */
    public function validate()
    {
        return $this->process()->forSave()->isValid();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Uploadable and upload related
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Link existing uploads with this element
     *
     * @return $this
     */
    public function linkUploads()
    {
        /** @var Module $this */
        Upload::linkTemporaryUploads($this);

        return $this;
    }


    /*
    |--------------------------------------------------------------------------
    | Section: Spread related functions
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Updates values in the database for spreads keys.
     * This adds entries in the 'spreads' tables.
     */
    public function syncSpreadKeys()
    {
        foreach ($this->spreadFields() as $field => $relatedTo) {
            $ids = toArray($this->$field);

            if (empty($ids)) {
                $this->spreads()->where('key', $field)->forceDelete();
                continue;
            }

            $this->spreads()->where('key', $field)->whereNotIn('related_id', $ids)->forceDelete();

            $existingIds = $this->spreads()->where('key', $field)->pluck('related_id');
            $newIds = collect($ids)->diff($existingIds)->all();

            $name = $this->getTable();

            foreach ($newIds as $relatedId) {
                if (!$relatedId) {
                    continue;
                }
                $spread = [
                    'name' => $name,
                    'key' => $field,
                    'module_id' => $this->module()->id,
                    'element_id' => $this->id,
                    'element_uuid' => $this->uuid,
                    'relates_to' => $relatedTo,
                    'related_id' => $relatedId,
                ];

                $this->spreads()->create($spread);
            }
        }

        return $this;
    }

    /**
     * Updates values in the database for spreads tags.
     * This adds entries in the spreads tables.
     */
    public function syncSpreadTags()
    {
        foreach ($this->getTagFields() as $field) {
            $tags = cleanArray(toArray($this->$field));

            if (empty($tags)) {
                $this->spreads()->where('key', $field)->forceDelete();
                continue;
            }

            $this->spreads()->where('key', $field)->whereNotIn('tag', $tags)->forceDelete();

            $existingTags = $this->spreads()->where('key', $field)->pluck('tag');
            $newTags = collect($tags)->diff($existingTags)->all();

            $name = $this->getTable();

            foreach ($newTags as $tag) {
                $spread = [
                    'name' => $name,
                    'key' => $field,
                    'module_id' => $this->module()->id,
                    'element_id' => $this->id,
                    'element_uuid' => $this->uuid,
                    'tag' => $tag,
                ];

                $this->spreads()->create($spread);
            }
        }

        return $this;
    }

    /**
     * Get spread tags as array
     *
     * @param $field
     * @return array
     */
    public function getSpreadTags($field)
    {
        return $this->spreadTags($field)->pluck('tag')->toArray();
    }

    /**
     * Autofill common fields.
     */
    public function autoFill()
    {
        $this->uuid = $this->uuid ?? uuid();
        $this->created_by = $this->created_by ?? user()->id;
        $this->created_at = $this->created_at ?? now();
        $this->updated_by = user()->id; // Force fill the current user
        $this->updated_at = $this->updated_at ?? now();
        $this->autoFillTenant();

        return $this;
    }

    /**
     * Fill tenant id once during creation. Later tenant id can not be
     * updated.
     */
    public function autoFillTenant()
    {
        if ($this->hasTenantContext()) {
            $this->tenant_id = $this->tenant_id ?: user()->tenant_id;
            // $this->project_id = $this->project_id ?: $this->tenant->project_id; // Excluded project_id injection because settings table had no project_id
        }

        return $this;
    }

    /**
     * Mark an entry as deleted by setting the deleted_at, deleted_by
     *
     * @param  null  $by
     * @param  null  $at
     * @return $this
     */
    public function markDeleted($by = null, $at = null)
    {
        $by = $by ?: user()->id;
        $at = $at ?: now();

        if (isset($this->id) && $this->deleted_by == null) {
            DB::table($this->getTable())->where('id', $this->id)->update([
                'deleted_by' => $by,
                'deleted_at' => $at,
            ]);
        }

        return $this;
    }

    /**
     * Fill polymorphic fields.
     * Note: This function should be used in polymorphic model's boot::creating() method.
     *
     * @param  string  $fieldPrefix  i.e.uploadable
     * @return $this
     */
    public function fillModuleAndElement($fieldPrefix)
    {
        // Define polymorphic field names
        $idField = $fieldPrefix.'_id';   // uploadable_id
        $typeField = $fieldPrefix.'_type'; // uploadable_type

        /*---------------------------------------------------------------------------------
        | Case 1. uploadable_type, uploadable_id available from default laravel poly-morph
        | Fill : module_id, element_id, element_uuid
        |---------------------------------------------------------------------------------*/
        if (isset($this->$typeField, $this->$idField)) {
            $this->$typeField = 'App\\'.class_basename($this->$typeField); // Change to root model \App\Upload
            $this->element_id = $this->$idField;

            $linkedModule = Module::byClass($this->$typeField);

            $this->module_id = $linkedModule->id;

            // Find the linked element and fill missing fields
            $linkedElement = $linkedModule->modelInstance()
                ->remember(timer('very-long'))
                ->find($this->element_id);

            if ($linkedElement) {
                $this->element_uuid = $linkedElement->uuid;
            }

            return $this;
        }

        /*-----------------------------------------------------------------
        | Case 2. module_id, element_id is available from MF implementation
        | Fill : uploadable_type, uploadable_name, element_uuid
        |-----------------------------------------------------------------*/
        if (isset($this->module_id, $this->element_id)) {
            $linkedModule = $this->linkedModule; // linked based on module_id (i.e. users module)
            $this->$typeField = trim($linkedModule->rootModelClassPath(), '\\');

            // Find the linked element and fill missing fields
            $linkedElement = $linkedModule->modelInstance()
                ->remember(timer('very-long'))
                ->find($this->element_id);
            if ($linkedElement) {
                $this->$idField = $linkedElement->id;
                $this->element_uuid = $linkedElement->uuid;
            }

            return $this;
        }

        return $this;
    }

    /**
     * Get an instance of the view processor
     *
     * @return \App\Mainframe\Features\Core\ViewProcessor
     */
    public function viewProcessor()
    {
        $module = $this->module();
        $modelClassPath = $module->modelClassPath();

        $classPaths = [

            // Step 1: Check in same folder
            $modelClassPath.'View',
            $modelClassPath.'ViewProcessor',

            // Step 2: Check in module directory
            $module->namespace.'\\'.$module->modelClassName().'View',
            $module->namespace.'\\'.$module->modelClassName().'ViewProcessor',

            // Step 3: Check project default
            projectNamespace().'\Features\Modular\BaseModule\BaseModuleView',
            projectNamespace().'\Features\Modular\BaseModule\BaseModuleViewProcessor',

            // Step 4: Fallback to mainframe
            '\App\Mainframe\Features\Modular\BaseModule\BaseModuleView',
            '\App\Mainframe\Features\Modular\BaseModule\BaseModuleViewProcessor',
        ];

        foreach ($classPaths as $classPath) {
            if (class_exists($classPath)) {
                /** @var ViewProcessor $view */
                $view = new $classPath;

                /** @var BaseModule $this */
                return $view->setModel($this)->setModule($module);
            }
        }

        return null;
    }

    /**
     * Index page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function indexUrl($params = [])
    {
        return route($this->module()->route_name.'.index', $params);
    }

    /**
     * Create page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function createUrl($params = [])
    {
        return route($this->module()->route_name.'.create', $params);
    }

    /**
     * Store request url. Note: This URL is used for form POST
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function storeUrl($params = [])
    {
        return route($this->module()->route_name.'.store', $params);
    }

    /**
     * Show details page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function showUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['element' => $this], $params);
            return route($this->module()->route_name.'.show', $params);
        }

        return null;
    }

    /**
     * Edit page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function editUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['element' => $this], $params);
            return route($this->module()->route_name.'.edit', $params);
        }

        return null;
    }

    /**
     * update request url. Note: This URL is used for form POST
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function updateUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['element' => $this], $params);
            return route($this->module()->route_name.'.update', $params);
        }

        return null;
    }

    /**
     * Delete/Destroy request url. Note: This URL is used for form POST
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function destroyUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['element' => $this], $params);
            return route($this->module()->route_name.'.destroy', $params);
        }

        return null;
    }

    /**
     * Datatable JSON url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function datatableJsonUrl($params = [])
    {
        return route($this->module()->route_name.'.datatable-json', $params);
    }

    /**
     * List JSON url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function listJsonUrl($params = [])
    {
        return route($this->module()->route_name.'.list-json', $params);
    }

    /**
     * Report page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function reportUrl($params = [])
    {
        return route($this->module()->route_name.'.report', $params);
    }

    /**
     * Uploads page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function uploadsUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['id' => $this], $params);
            return route($this->module()->route_name.'.uploads', $params);
        }

        return null;
    }

    /**
     * Index page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function changesUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['id' => $this], $params);
            return route($this->module()->route_name.'.changes', $params);
        }

        return null;
    }

    /**
     * Index page url
     *
     * @param  array  $params  Pass additional url params
     * @return string
     */
    public function cloneUrl($params = [])
    {
        if ($this->isCreated()) {
            $params = array_merge(['id' => $this], $params);
            return route($this->module()->route_name.'.clone', $params);
        }

        return null;
    }

    /**
     * HTML link
     *
     * @param  string  $field
     * @param  array  $params
     * @return string
     */
    public function editLink($field = 'id', $params = [])
    {
        return "<a href='".$this->editUrl($params)."'>".($this->$field ?? $field).'</a>';
    }


    /*
    |--------------------------------------------------------------------------
    | Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    |
    | An element can be editable or non-editable based on its internal status
    | This is not related to any user, rather it is a model's individual state
    | For example - A confirmed quotation should not be editable regardless
    | of who is trying to edit it.
    */
    /**
     * Check if the model can be viewed based on its values.
     *
     * @return bool
     */
    public function isViewable()
    {
        return true;
    }

    /**
     * Check if the model can be created based on its values.
     *
     * @return bool
     */
    public function isCreatable()
    {
        return true;
    }

    /**
     * Check if the model can be edited based on its values.
     *
     * @return bool
     */
    public function isEditable()
    {
        return true;
    }

    /**
     * Check if the model can be deleted based on its values.
     *
     * @return bool
     */
    public function isDeletable()
    {
        return true;
    }

    /**
     * Check if the model can be restored based on its values.
     *
     * @return bool
     */
    public function isRestorable()
    {
        return false;
    }

    /**
     * Check if the model can be clones based on its values.
     *
     * @return bool
     */
    public function isCloneable()
    {
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    |
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant() { return $this->belongsTo(Tenant::class); }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project() { return $this->belongsTo(Project::class); }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }

    /**
     * @return mixed
     */
    public function linkedModule()
    {
        return $this->belongsTo(Module::class, 'module_id')->remember(timer('very-long'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changes()
    {
        return $this->hasMany(Change::class, 'element_id')->where('module_id', $this->module()->id);
        // return $this->morphMany('App\Change', 'changeable'); Note: Do not use morphMany
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uploads()
    {
        // return $this->morphMany(Upload::class,'uploadable');
        return $this->hasMany(Upload::class, 'element_id')->where('module_id', $this->module()->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function spreads()
    {
        return $this->morphMany(Spread::class, 'spreadable'); // Note: Keep morphMany!!
    }

    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spreadModels($slug)
    {
        $key = $slug;
        if (!Str::endsWith($slug, '_ids')) {
            $key = Str::singular($slug).'_ids';
        }

        $class = $this->spreadFields[$key];

        return $this->belongsToMany($class, 'spreads', 'spreadable_id', 'related_id')->where('key', $key);
    }

    /**
     * @param $field
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spreadTags($field)
    {
        return $this->hasMany(Spread::class, 'element_id')->where('module_id', $this->module()->id)->where('key',
            $field);
        // return $this->morphMany(Spread::class, 'spreadable')->where('key', $field);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * For multi-tenancy add a sequence number.
     *
     * @return int|mixed|void|null
     */
    public function putTenantSerial()
    {
        if (!$this->tenant_id) {
            return;
        }
        if ($this->tenant_sl) {
            return;
        }

        $last = DB::table($this->getTable())
            ->where('id', '!=', $this->id)
            ->where('tenant_id', $this->tenant_id)
            ->latest()->first(['tenant_sl']);

        $sl = 1;
        if ($last && $last->tenant_sl) {
            $sl += $last->tenant_sl;
        }

        $this->tenant_sl = $sl;
        $this->saveQuietly();

        return $sl;
    }

    /**
     * Send emails to the following emails
     *
     * @return array
     */
    public function emailRecipients()
    {
        $emails = [
            optional($this->creator)->email,
            optional($this->updater)->email,
        ];

        // $emails = collect($emails)->unique()->filter(function ($value) { return !is_null($value); })->all();
        return array_unique(array_filter($emails));
    }

    /**
     * Send emails to the following emails
     *
     * @return array
     */
    public function smsRecipients()
    {
        //$mobiles = collect($mobiles)->unique()->filter(function ($value) { return !is_null($value); })->all();
        return array_unique(array_filter([
            optional($this->creator)->mobile,
            optional($this->updater)->mobile,
        ]));
    }

    /**
     * This function updates(saves) other tables where changes of this model should reflect. I.e., if a dictionary
     * name is updated, then all the entries where this name is used should be updated.
     *
     * @return void
     */
    public function syncData() { }

    /**
     * Function to fill the denormalized fields. This should be called in processor saving() once the validations
     * have passed. I.e., client_name, client_address should be filled based on client_id.
     *
     * @return $this
     */
    public function denormalize() { return $this; }

    // /**
    //  * Set name_ext values
    //  *
    //  * @return $this
    //  */
    // public function setNameExt()
    // {
    //     if (!$this->hasColumn('name_ext')) {
    //         return $this;
    //     }
    //
    //     if ($this->hasColumn('name') && $this->hasColumn('name_ext')) {
    //         $this->name_ext = $this->name;
    //     }
    //
    //     if ($this->hasTenantContext() && $this->tenant) {
    //         $this->name_ext .= ' ('.$this->tenant->name.')';
    //     }
    //
    //     return $this;
    // }
    //
    // /**
    //  * Set a slug
    //  *
    //  * @return $this
    //  */
    // public function setSlug()
    // {
    //
    //     if ($this->hasColumn('name') && $this->hasColumn('slug')) {
    //         $this->slug = \Str::slug($this->name);
    //     }
    //
    //     return $this;
    // }

    /*
    |--------------------------------------------------------------------------
    | Short function to find
    |--------------------------------------------------------------------------
    */
    /**
     * Find an element by name
     *
     * @param $name
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public static function byName($name)
    {
        return self::where('name', $name)->first();
    }

    /**
     * Find an element by uuid
     *
     * @param $uuid
     * @return \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public static function byUuid($uuid)
    {
        return self::where('uuid', $uuid)->first();
    }

    /**
     * Find an element by slug
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|object|null
     */
    public static function bySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Find an element by code
     *
     * @param $code
     * @return \Illuminate\Database\Eloquent\Model|object|null
     */
    public static function byCode($code)
    {
        return self::where('code', $code)->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Observer function
    |--------------------------------------------------------------------------
    */

    /**
     * Run a set of common functions when an element is saved.
     * This function is likely to be used in Observer::saved().
     *
     * @return void
     */
    public function runCommonExecutablesOnSaved()
    {
        $this->linkUploads();
        $this->trackFieldChanges();
        $this->syncSpreadKeys();
        $this->syncSpreadTags();
    }

    /**
     * Todo: have to revisit
     * Execute a set of common cleanup operations when an element is deleted.
     * This function is likely to be used in Observer::deleted().
     * It removes related uploads, changes, and spread entries associated with the deleted model.
     *
     * @return void
     */
    public function runCommonExecutablesOnDeleted()
    {
        $class = $this->module()->rootModelClassPath();

        // Mark upload as deleted
        $valuesToMarkDeleted = ['deleted_at' => now(), 'deleted_by' => user()->id];

        // DB::table('uploads')->where('uploadable_type', $class)
        //     ->where('uploadable_id', $this->id)->update($valuesToMarkDeleted);

        DB::table('changes')->where('changeable_type', $class)
            ->where('changeable_id', $this->id)->delete();

        DB::table('spreads')->where('spreadable_type', $class)
            ->where('spreadable_id', $this->id)->delete();
    }

}
