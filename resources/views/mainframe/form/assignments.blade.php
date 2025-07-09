<?php
/** @var array $var
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 */
?>
<?php

use App\Project\Datatables\AssignmentWidgetDatatable;

$datatable = new AssignmentWidgetDatatable();
$datatable->hidden = [
    'id',
    'name',
    'created_by',
];
$datatable->addUrlParam(['element_id' => $element->id, 'module_id' => $element->module()->id]);
$datatable->minimal();
$datatable->bPaginate = true;
$datatable->bLengthChange = false;
$datatable->pageLength = 5;
?>
<div class="col-md-12 no-padding">
    <form id="assignmentForm" name="assignmentForm" action="{{route('assignments.store')}}" method="POST">

        @csrf
        <input type="hidden" name="module_id" value="{{$element->module()->id}}" class="small"/>
        <input type="hidden" name="element_id" value="{{$element->id}} "/>
        <input type="hidden" name="element_uuid" value="{{$element->uuid}} "/>
        <input type="hidden" name="assignable_type" value="{{$element->rootModel()}}"/>
        <input type="hidden" name="assignable_id" value="{{$element->id}}"/>

        <div class="clearfix"></div>

        @include('form.select-ajax',['var'=>['name'=>'assignee_user_id', 'label'=>'Select an user', 'name_field'=>'name', 'model'=>\App\User::class,'div'=>'col-md']])
        @include('form.textarea',['var'=>['name'=>'note','label'=>'Write  note','div'=>'col-md']])
        <div class="clearfix"></div>

        <button id="assignmentFormButton" name="assignmentFormButton" type="submit"
                class="btn btn-secondary assignment-save-btn">Assign
        </button>
    </form>

    <div class="col-md-12 no-padding">
        @include('mainframe.layouts.module.grid.includes.datatable',['datatable'=>$datatable])
    </div>
</div>


@section('js')
    @parent

    <script>
        /**************************
         * 1. Add FE validations
         * todo:(optional)
         *************************/
        $('#assignee_user_id #body').addClass('validate[required]');
        /**************************
         * 2. Handle form post
         *************************/
        enableAjaxFormSubmission('assignmentForm',
            function success(response) {
                $("#assignmentModal").modal('hide');
                $("#assignmentForm").trigger('reset');
                $('#assignmentWidgetDatatableDt').DataTable().ajax.reload();
            },
            function fail(response) {
                showResponseModal(response);
            }
        );

        $('#assignmentFormButton').on('click', function () {
            $("#assignee_user_id").select2('val', "").trigger('change');
        });
    </script>
@endsection

@unset($var)
