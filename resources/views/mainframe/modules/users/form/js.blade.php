<?php
/**
 * @var \App\Mainframe\Modules\Users\User $module
 * @var \App\User $user
 * @var \App\User $element
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 */
?>
<script>
    /*
    |--------------------------------------------------------------------------
    | Common - creating and updating
    |--------------------------------------------------------------------------
    */
    $('select#groups').select2();

    /**
     * Assigns validation rules during saving (both creating and updating)
     */
    addValidationRules(); // Assign validation classes/rules
    enableAjaxFormSubmission('{{$module->name}}'); // Enable Ajax based form validation.

    /*
    |--------------------------------------------------------------------------
    | creating
    |--------------------------------------------------------------------------
    */
    @if($element->isCreating())
    // Write JS that will execute in create Form
    @endif

    /*
    |--------------------------------------------------------------------------
    | updating
    |--------------------------------------------------------------------------
    */
    @if($element->isUpdating())
    // Write JS that will execute while updating
    // Redirection
    $('#{{$module->name}}-redirect-success').val('#'); //  # Stops redirection after save
    $("select[name=group_ids]").addClass('validate[required]');
    @endif
    /*
    |--------------------------------------------------------------------------
    | List of functions
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Add CSS for validation rules
     */
    function addValidationRules() {
        $("input[name=email]").addClass('validate[required]');
    }
</script>
