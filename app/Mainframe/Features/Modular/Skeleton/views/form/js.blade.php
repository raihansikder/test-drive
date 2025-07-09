<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\SuperHero $element
 * @var \App\SuperHero $superHero
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHeroViewProcessor $view
 */
?>
<script>
    /*--------------------------------------------------------------------------
    | Common - creating and updating                                           |
    |--------------------------------------------------------------------------*/

    // $('select').select2(); // Convert all <select> to Select2

    // Redirect to parent after delete success
    @if($element->parent_id)
    $('.delete-cta button[name=genericDeleteBtn]').attr('data-redirect_success', '{!! route('parent.edit',$element->parent_id) !!}')
    @endif

    // Validation
    addValidationRules();
    enableAjaxFormSubmission('{{$module->name}}');

    /*--------------------------------------------------------------------------
    | creating                                                                 |
    |--------------------------------------------------------------------------*/
    @if($element->isCreating())
    //  // Write JS that will execute in create Form
    @endif

    /*--------------------------------------------------------------------------
    | updating                                                                 |
    |--------------------------------------------------------------------------*/
    @if($element->isUpdating())
    //  //Write JS that will execute while updating
    // Redirection
    // $('#{{$module->name}}-redirect-success').val('#'); // Uncomment this to stops redirection
    @endif
    
    /*--------------------------------------------------------------------------
    | List of functions                                                        |
    |--------------------------------------------------------------------------*/
    
    /**
     * Add CSS for validation rules
     */
    function addValidationRules() {
        $("input[name=name]").addClass('validate[required]');
    }
</script>
