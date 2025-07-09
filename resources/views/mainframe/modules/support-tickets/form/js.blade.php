<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\SupportTicket $element
 * @var \App\SupportTicket $supportTicket
 * @var \App\Project\Modules\SupportTickets\SupportTicketViewProcessor $view
 */
?>
<script>
    /*--------------------------------------------------------------------------
    | Common - creating and updating                                           |
    |--------------------------------------------------------------------------*/
    $('#support_ticket_tag_ids').select2();

    // Redirection after delete
    @if($element->parent_id)
    $('.delete-cta button[name=genericDeleteBtn]').attr('data-redirect_success', '{!! route('parent.edit',$element->parent_id) !!}')
    @endif

    // Validation
    addValidationRules();
    enableAjaxFormSubmission('{{$module->name}}');

    initEditor('details', _.merge(editor_config_extended, {
        extraPlugins: 'autogrow',
        autoGrow_onStartup: true,
        autoGrow_maxHeight: 600,
        removePlugins: 'resize'
    }));

    initEditor('reviewers_note', editor_config_minimal);

    /*--------------------------------------------------------------------------
    | creating                                                                 |
    |--------------------------------------------------------------------------*/
    @if($element->isCreating())
    // Write JS that will execute in create Form
    $('input[name=contact_no]').val('{{user()->mobile}}');
    $("#status_name").val('{{\App\SupportTicket::SUPPORT_TICKET_STATUS_NEW}}').change();
    @endif

    /*--------------------------------------------------------------------------
    | updating                                                                 |
    |--------------------------------------------------------------------------*/
    @if($element->isUpdating())
    // Write JS that will execute while updating
    // Redirection
    // $('#{{$module->name}}-redirect-success').val('#'); //  # Stops redirection
    @endif
    /*--------------------------------------------------------------------------
    | List of functions                                                        |
    |--------------------------------------------------------------------------*/
    /**
     * Add CSS for validation rules
     */
    function addValidationRules() {
        $("input[name=name]").addClass('validate[required]');
        $("select[name=primary_category_id]").addClass('validate[required]');
        // $("select[name=secondary_category_id]").addClass('validate[required]');
        $("input[name=contact_no]").addClass('validate[required]');
        $("input[name=details]").addClass('validate[required]');
    }
</script>
