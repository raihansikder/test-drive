<?php
/** @var array $var
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 */
// Note - Only invoke this feature if the $element is already saved
if (isset($element) && !$element->isCreated()) {
    return;
}

$datatable = $datatable ?? new \App\Project\Datatables\CommentWidgetDatatable();
$datatable->hidden = ['id', 'name', 'created_by'];
$datatable->addUrlParam(['element_id' => $element->id, 'module_id' => $element->module()->id]);
$datatable->minimal();
$datatable->bPaginate = true;
$datatable->bLengthChange = false;
$datatable->pageLength = 5;

$default = ['editable' => true];
$var = array_merge($default, $var ?? []);
?>

@if($var['editable'])
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-default pull-right m-t-10" data-toggle="modal"
            data-target="#addCommentFormModal"> Add Comment
    </button>
@endif

<div class="col-md-12 no-padding">
    @include('project.layouts.module.grid.includes.datatable',['datatable'=>$datatable])
</div>

@section('content-bottom')
    @parent
    <!-- Modal -->
    <div id="addCommentFormModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add A New Comment</h4>
                </div>
                <div class="modal-body">
                    <form id="commentForm" name="commentForm" action="{{route('comments.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="module_id" value="{{$element->module()->id}}" class="small"/>
                        <input type="hidden" name="element_id" value="{{$element->id}} "/>
                        <input type="hidden" name="commentable_type" value="{{$element->rootModel()}}"/>
                        <input type="hidden" name="commentable_id" value="{{$element->id}}"/>
                        <div class="clearfix"></div>
                        @include('form.textarea',['var'=>['name'=>'body','label'=>'Comment','div'=>'col-md', 'editable'=>true]])
                        <div class="clearfix"></div>

                        <button id="commentFormButton" name="commentFormButton"
                                type="submit" class="btn btn-secondary comment-send-btn">Save
                        </button>
                    </form>
                </div>
                {{-- <div class="modal-footer">--}}
                {{--     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{-- </div>--}}
            </div>

        </div>
    </div>
@endsection

@section('js')
    @parent
    @if($var['editable'])
        <script>
            // 1. FE validation
            // $('#commentForm #body').addClass('validate[required]');

            // 2. Handle form post
            enableAjaxFormSubmission('commentForm',
                function success(response) {
                    // $("#commentModal").modal('hide'); // If a modal was used.
                    $("#commentForm").trigger('reset'); // Reset comment form
                    $('#commentWidgetDatatableDt').DataTable().ajax.reload(); // Reload datatable
                    $('#addCommentFormModal').modal('hide');
                },
                function fail(response) {
                    showResponseModal(response); // Show response in default MF modal
                    $('#commentWidgetDatatableDt').DataTable().ajax.reload(); // Reload datatable
                }
            );
        </script>
    @endif
@endsection

@unset($datatable, $var, $datatable, $default)
