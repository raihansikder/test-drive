@extends('mainframe.layouts.blank.partial')

<?php
/**
 * @var \App\District $district
 * @var string $uuid
 */
?>

@section('content')
    <div class="modal-header">
        <h3 class="modal-title uppercase" id="modalLabel">Add Upazila</h3>
        <button id="upazilaAddModalCloseButton" type="button" class="close"
                data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="upazilaAddForm" name="upazilaAddForm" action="{{route('upazilas.store')}}" method="POST">
        <div class="modal-body">
            <div class="row">
                @csrf
                <input name="division_id" type="hidden" value="{{$district->division_id}}">
                <input name="district_id" type="hidden" value="{{$district->id}}">
                <input name="uuid" type="hidden" value="{{$uuid}}">
                <div class="col-md-12">
                    @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
                    @include('form.text',['var'=>['name'=>'name_bn','label'=>'Name (Bangla)']])
                    @include('form.number',['var'=>['name'=>'code','label'=>'Code']])
                    <div class="clearfix"></div>
                    @include('form.plain-text',['var'=>['name'=>'combined_code','label'=>'Combined Code','tooltip'=>'Auto Generated']])
                    @include('form.number',['var'=>['name'=>'longitude','label'=>'Longitude']])
                    @include('form.number',['var'=>['name'=>'latitude','label'=>'Latitude']])
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button id="upazilaAddFormButton" name="upazilaAddFormButton"
                    type="submit" class="btn btn-primary">Save
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
        
        /**************************
         * 1 - Add FE validations
         *************************/

        $('#upazilaAddForm #name').addClass('validate[required]');
        $('#upazilaAddForm #code').addClass('validate[required]');
        $('#districtAddForm #longitude').addClass('validate[number]');
        $('#districtAddForm #latitude').addClass('validate[number]');

        /************************************************************
         * 2 - Handle form post using Mainframe form handler
         ************************************************************/

        enableAjaxFormSubmission('upazilaAddForm',
            function success(response) {
                $("#createUpazilaModal").modal('hide'); // Hide the dynamic modal
                $('#upazilaWidgetDatatableDt').DataTable().ajax.reload(); // Reload datatable
            },
            function fail(response) {
                showResponseModal(response); // Show the default response modal
            }
        );

    </script>
@endsection
