<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="deleteForm" method="POST" action="" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <input name="ret" type="hidden">

                {{-- Custom fields --}}
                <input name="redirect_success" type="hidden"/>
                <input name="redirect_fail" type="hidden"/>
                <input name="_meta[refresh_datatable_id]" class="refresh_datatable_id" type="hidden">
                <input name="_meta[hide_class]" class="hide_class" type="hidden">

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
