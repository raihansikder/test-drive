@extends('mainframe.layouts.blank.partial')

<?php
/**
 * @var \App\InspectionStep $eleemnt
 * @var string $uuid
 */
// Section : Configure the variables
$form = "inspectionStepAddForm";                    // Configure form. DRY!
$datatableId = "inspectionStepWidgetDatatableDt";   // Configure Datatable Id. DRY!
$uuid = $element->uuid;                             // Important! Set uuid.
?>
@section('content')
    <form id="{{$form}}" name="{{$form}}" action="{!! $element->formAction() !!}" method="{{$element->formMethod()}}">
        <div class="modal-header">
            <h4 class="modal-title">{{$element->formState()}} Inspection Step</h4>
            @include('mainframe.layouts.default.includes.modals.modal-close-btn')
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section: Default hidden inputs. Must be available --}}
                    @csrf
                    @include('form.hidden',['var'=>['name'=>'uuid']])
                    <input name="_meta[refresh_datatable_id]" value="{{$datatableId}}" type="hidden">
                    
                    {{-- Section: Custom form fields --}}
                    @include('form.hidden',['var'=>['name'=>'inspection_id']])
                    @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-6']])
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @include('mainframe.layouts.default.includes.modals.modal-footer')
        </div>
    </form>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
        // 1-Add validation rules, and other custom JS
        let $form = $('#{{$form}}'); // For the love of DRY!
        $form.find('#name').addClass('validate[required]');

        // 2-Enable ajax form submission
        enableAjaxFormSubmission('{{$form}}');
    </script>
@endsection