<?php /** @noinspection PhpUnused */

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

use Str;
use Route;
use App\Mainframe\Features\Core\ViewProcessor;

/** @mixin ViewProcessor $this */
trait ViewProcessorTrait
{
    /**
     * @param  string  $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Add view variables to be shared to the blade.
     *
     * @param $vars
     * @return $this
     */
    public function addVars($vars)
    {
        $this->vars = array_merge($this->getVars(), $vars);

        return $this;
    }

    /**
     * Getter for view variables to be shared to the blade
     *
     * @return array
     */
    public function getVars()
    {
        return $this->vars ?? [];
    }

    /**
     * Set view variables to be shared with the blade
     *
     * @param $vars
     * @return $this
     */
    public function setVars($vars)
    {
        $this->vars = $vars;

        return $this;
    }

    /**
     * Set an element and based on that set the module, model and add immutables
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
     * @return $this
     */
    public function setElement($element)
    {
        if (!$element) {
            return $this;
        }

        $this->element = $element;

        $this->setModule($element->module())
            ->setModel($element->newInstance());

        if ($this->isEditing()) {
            $this->addImmutables($element->processor()->getImmutables());
        }

        return $this;
    }

    /**
     * Set module
     *
     * @param  \App\Module  $module
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Set model
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule  $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param  \App\Mainframe\Features\Datatable\Datatable  $datatable
     * @return $this
     */
    public function setDatatable($datatable)
    {
        $this->datatable = $datatable;

        return $this;
    }

    /**
     * Set editable (model/form editability)
     *
     * @param  bool  $editable
     * @return $this
     */
    public function setEditable(bool $editable)
    {
        $this->editable = $editable;

        return $this;
    }

    public function editable()
    {
        if ($this->editable === false) {
            return false;
        }

        if ($this->isCreating()) {
            return true;
        }

        if ($this->isEditing()) {
            return $this->user->can('update', $this->element);
        }

        return $this->editable;
    }

    /*---------------------------------
    |  Immutables
    |---------------------------------*/
    /**
     * @param $immutables
     * @return $this
     */
    public function setImmutables($immutables = [])
    {
        $this->immutables = $immutables;

        return $this;
    }

    /**
     * @param $immutables
     * @return $this
     * @deprecated  use setImmutables
     */
    public function setImmutable($immutables = [])
    {
        return $this->setImmutables($immutables);
    }

    /**
     * @param  array  $immutables
     * @return $this
     */
    public function addImmutables($immutables = [])
    {
        $this->immutables = array_unique(array_merge($this->immutables, $immutables));

        return $this;
    }

    /*---------------------------------
    |  Hidden fields
    |---------------------------------*/
    /**
     * @param $hiddenFields
     * @return $this
     */
    public function setHiddenFields($hiddenFields = [])
    {
        $this->hiddenFields = $hiddenFields;

        return $this;
    }

    /**
     * @param $hiddenFields
     * @return $this
     * @deprecated  use setHiddenFields
     */
    public function setHiddenField($hiddenFields = [])
    {
        return $this->setHiddenFields($hiddenFields);
    }

    /**
     * @param  array  $hiddenFields
     * @return $this
     */
    public function addHiddenFields($hiddenFields = [])
    {
        $this->hiddenFields = array_unique(array_merge($this->hiddenFields, $hiddenFields));

        return $this;
    }

    /**
     * Check if a function exists with same signature and return the result
     *
     * @param $signature
     * @return bool
     */
    public function show($signature)
    {
        $method = 'show'.Str::camel($signature);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Blade template locations
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Blade path for default template
     *
     * @return string
     */
    public function defaultTemplate()
    {
        $project = projectResources().'.layouts.default.template';

        if (view()->exists($project)) {
            return $project;
        }

        return 'mainframe.layouts.default.template';
    }

    /**
     * Blade path for left menu
     *
     * @return string
     */
    public function leftMenu()
    {
        $project = projectResources().'.layouts.default.includes.navigation.left-menu.menu-items';

        if (view()->exists($project)) {
            return $project;
        }

        return 'mainframe.layouts.default.includes.navigation.left-menu.menu-items';
    }

    /**
     * Resolve the view blade for the module form
     *
     * @param  string  $state
     * @return string
     * @noinspection PhpIfWithCommonPartsInspection
     */
    public function formPath($state = 'create')
    {
        $default = $this->module->view_directory.'.form.default';
        if ($state == 'create') {
            return $default;
        }

        // Else, use a different blade...

        return $default;
    }

    /**
     * Blade template for grid
     *
     * @return string
     */
    public function gridPath()
    {
        return $this->module->view_directory.'.grid.default';
    }

    /**
     * Blade template for change log
     *
     * @return string
     */
    public function changesPath()
    {
        $project = projectResources().'.layouts.module.changes.index';

        if (view()->exists($project)) {
            return $project;
        }

        return 'mainframe.layouts.module.changes.index';
    }

    /*
    |--------------------------------------------------------------------------
    | View Variables
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Obtain the variables shared in a module create form
     *
     * @return array
     */
    public function varsCreate()
    {
        $this->addVars([
            'uuid' => $this->element->uuid,
            'element' => $this->element,
            'formState' => 'create',
            'formConfig' => [
                'route' => $this->module->name.'.store',
                'class' => $this->module->name.'-form module-base-form create-form',
                'name' => $this->module->name,
                'method' => 'POST',
                'files' => true,
            ],
            'editable' => $this->editable(),
            'immutables' => $this->immutables(),
            'hiddenFields' => $this->hiddenFields(),
        ]);

        return $this->vars;
    }

    /**
     * Obtain the variables shared in a module edit form
     *
     * @return array
     */
    public function viewVarsEdit()
    {
        $this->addVars([
            'element' => $this->element,
            'formState' => 'edit',
            'formConfig' => [
                'route' => [$this->module->name.'.update', $this->element->id],
                'class' => $this->module->name.'-form module-base-form edit-form',
                'name' => $this->module->name,
                'files' => true,
                'method' => 'PATCH',
                'id' => $this->module->name.'Form',
            ],
            'editable' => $this->editable(),
            'immutables' => $this->immutables(),
            'hiddenFields' => $this->hiddenFields(),
        ]);

        return $this->vars;
    }

    /**
     * Immutables
     * Get the array of immutable field names.
     * Originally the immutables are passed in view processor from module processor.
     *
     * @return array
     * @deprecated user immutables();
     */
    public function getImmutables()
    {
        return $this->immutables();
    }

    /**
     * Immutables
     * Get the array of immutable field names.
     * Originally the immutables are passed in view processor from module processor.
     *
     * @return array
     */
    public function immutables()
    {
        return array_unique($this->immutables);
    }

    /**
     * Hidden fields
     * Get the array of hidden field names.
     * Originally the hidden are passed in view processor from module processor.
     *
     * @return array
     */
    public function hiddenFields()
    {
        return array_unique($this->hiddenFields);
    }

    /**
     * @return bool
     */
    public function isCreating()
    {
        return isset($this->element) && $this->element->isCreating();
    }

    public function isCreated()
    {
        return $this->isEditing();
    }

    /**
     * Check if the element is being edited
     *
     * @return bool
     */
    public function isEditing()
    {
        return isset($this->element) && $this->element->isCreated();
    }

    /**
     * Generate form title
     *
     * @return string
     */
    public function formTitle()
    {
        // if (Str::endsWith(\Route::getCurrentRoute()->getName(), '.index')) {
        //     return Str::plural($this->module->title);
        // }
        //
        // return Str::singular($this->module->title);
        return $this->title();
    }

    /**
     * Grid create button text
     *
     * @return string
     */
    public function createBtnText()
    {
        return "Create a new ".lcfirst(Str::singular($this->module->title));
    }

    /**
     * Create button url
     *
     * @return string
     */
    public function createBtnUrl()
    {
        // Merge the existing request to URL which allows pre-selection in the form.
        return route($this->module->name.".create", request()->all());
    }

    /**
     * List(index) button url
     *
     * @return string
     */
    public function listBtnUrl()
    {
        return route($this->module->name.".index");
    }

    /**
     * Report button url
     *
     * @return string
     */
    public function reportBtnUrl()
    {
        // Merge the existing request to URL which allows pre-selection in the form.
        return route($this->module->name.".report", request()->all());
    }

    /**
     * Show module form title
     *
     * @return string|void
     */
    public function title()
    {
        // Grid title
        if (Str::endsWith(Route::getCurrentRoute()->getName(), '.index')) {
            return $this->gridTitle();
        }

        // Form title
        if (!$this->element) {
            return;
        }

        $prefix = '';
        if ($this->isCreating()) {
            $prefix = "Create New ";
        }

        $elementName = $this->formElementTitle();

        $text = $prefix.' '.$this->module->singularTitle().'- '.$elementName;
        return trim($text, ' -');
    }

    public function formElementTitle()
    {
        return optional($this->element)->name;
    }

    /**
     * @return string|void
     */
    public function gridTitle()
    {
        if (!$this->module) {
            return;
        }

        return Str::plural($this->module->title);
    }

    public function createBtnTooltip()
    {
        return "Create a new ".Str::singular($this->module->title);
    }

    public function listBtnTooltip()
    {
        return "View list of ".Str::singular($this->module->title);
    }

    public function reportBtnTooltip()
    {
        return "View advanced report with filters, excel export etc.";
    }

    /*
    |--------------------------------------------------------------------------
    | Datatable render functions
    |--------------------------------------------------------------------------
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Condition functions to show a section in view
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Check visibility of create button
     *
     * @return bool
     */
    public function showFormCreateBtn()
    {
        return $this->user->can('create', $this->model);
    }

    /**
     * Check visibility of list button
     *
     * @return bool
     */
    public function showFormListBtn()
    {
        return $this->user->can('view-any', $this->model);
    }

    public function showDefaultFormSaveBtn()
    {
        if ($this->element->isCreating()) {
            return $this->user->can('create', $this->element);
        }

        return $this->user->can('update', $this->element);
    }

    public function defaultFormSaveBtnClass()
    {
        return "submit btn btn-success {$this->module->name}-SubmitBtn module-save-btn pull-left";
    }

    public function defaultFormSaveBtnText()
    {
        return "<i class='fa fa-check text-gray'></i> Save  ";
    }

    public function showDefaultFormTimeStamps()
    {
        return $this->element->isCreated();
    }

    public function showDefaultFormDeleteBtn()
    {
        if (!$this->element->isCreated()) {
            return false;
        }
        return $this->user->can('delete', $this->element);
    }

    public function showDefaultFormChangeLogBtn()
    {
        if (!$this->element->isCreated()) {
            return false;
        }

        return $this->user->can('view-change-log', $this->element);
    }

    /**
     * Check visibility of report button
     *
     * @return bool
     */
    public function showReportLink()
    {
        return $this->user->can('view-report', $this->model);
    }

    /**
     * Check if tenant selector should be shown
     *
     * @return bool
     */
    public function showTenantSelector()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        if (isset($this->module) && !$this->module->tenantEnabled()) {
            return false;
        }

        /** @noinspection PhpIfWithCommonPartsInspection */
        if ($this->user->ofTenant()) {
            return false;
        }

        return false;
    }

    /**
     * Show clone button in module form
     *
     * @return bool
     */
    public function showCloneBtn()
    {
        if (!$this->element->isCloneable()) {
            return false;
        }

        if (!$this->user->can('clone', $this->element)) {
            return false;
        }

        return true;
    }

    /**
     * Show comment section
     *
     * @return bool
     */
    public function showCommentSection()
    {
        return isset($this->element) && $this->element->isCreated();
    }

    public function showDownloadAllAsZipButton()
    {
        return $this->element->isCreated() && $this->element->uploads()->exists();
    }
    /*
    |--------------------------------------------------------------------------
    | Form wizard steps
    |--------------------------------------------------------------------------
    |
    |
    */
    /**
     * Form wizard current step
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function step()
    {
        return request('step', 1);
    }

    public function nextStep()
    {
        return $this->step() + 1;
    }

    public function lastStep()
    {
        return $this->step() - 1;
    }

    /**
     * A generic back link
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string|null
     */
    public function backRef()
    {
        if (request()->has('back_ref') && is_string(request('back_ref'))) {
            return request('back_ref');
        }

        return null;
    }

    /**
     * Determines if analytics should be enabled based on the current application environment.
     *
     * @return bool True if the application is in production, false otherwise.
     */
    public function enableSiteAnalytics()
    {
        return app()->isProduction();
    }
}
