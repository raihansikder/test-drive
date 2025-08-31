<div id="msgModal" class="modal fade message-modal" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 600px">
        <div class="modal-content">
            <div class="modal-header">
                @include('mainframe.layouts.default.includes.modals.modal-close-btn')
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgSuccess" class="ajaxMsg ajax-msg-success callout"></div>
                        <div id="msgError" class="ajaxMsg ajax-msg-error callout "></div>
                        <div id="msgMessage" class="ajaxMsg ajax-msg callout"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
