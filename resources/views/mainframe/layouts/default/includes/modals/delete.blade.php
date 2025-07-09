<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="deleteForm" method="POST" action="" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <input name="redirect_success" type="hidden"/>
                <input name="redirect_fail" type="hidden"/>
                {{-- <input name="refresh_datatable_id" type="hidden"/>--}}
                <input name="ret" type="hidden">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">Confirm Delete</h4>
                </div>
                
                <div class="modal-body">
                    Are you sure you want to delete this completely?
                </div>
                <div class="modal-footer">
                    <button type="submit" id='deleteSubmit' name='delete' class="btn btn-danger pull-left">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                
                </div>
            </form>
        </div>
    </div>
</div>

@section('js')
    @parent
    <script>

        // let refresh_datatable_id = $('input[name=refresh_datatable_id]').val();
        //
        // console.log(refresh_datatable_id);
        //
        // if (refresh_datatable_id.length) {
        //     $('input[name=redirect_success]').val('#');
        //    enableAjaxFormSubmission('deleteForm', function (response) {
        //         // Refresh datatable
        //         $('#' + refresh_datatable_id).DataTable().ajax.reload();
        //         // Show response modal for 2 seconds
        //         showResponseModal(response, default_response_modal_timeout);
        //     });
        // } else {
        //    enableAjaxFormSubmission('deleteForm');
        // }
    </script>
@endsection
