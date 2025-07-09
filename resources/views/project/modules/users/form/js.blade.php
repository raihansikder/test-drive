<script>
    /*
    |--------------------------------------------------------------------------
    | Common - creating and updating
    |--------------------------------------------------------------------------
    */

    $('select[id=groups]').select2();

    /**
     * Assigns validation rules during saving (both creating and updating)
     */
    addValidationRules(); // Assign validation classes/rules
    {{--enableAjaxFormSubmission('{{$module->name}}'); // Enable Ajax based form validation. --}}

    enableAjaxFormSubmission('{{$module->name}}',
        function (response) {
            $('.modal').modal('hide');       // 1. Hide all open modals
            showResponseModal(response);     // 2. Show response/status in the message modal

            if (v.count(response.redirect)) {  // 3. Redirect if a redirect_success URL exits
                setTimeout(() => {
                    window.location.replace(response.redirect);
                }, 2000);
            }
        }); // Enable Ajax based form validation.
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
    // $('#{{$module->name}}-redirect-success').val('#'); //  # Stops redirection after save
    @endif
    /*
    |--------------------------------------------------------------------------
    | List of functions
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Assigns validation rules during saving (both creating and updating)
     */
    function addValidationRules() {
        $("input[name=email]").addClass('validate[required]');
        $("select[name=group_ids]").addClass('validate[required]');
    }
</script>
