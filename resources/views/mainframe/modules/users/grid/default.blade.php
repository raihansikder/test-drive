@extends('project.layouts.module.template')

<?php
/**
 * @var \App\Project\Modules\Users\UserDatatable $datatable
 * @var \App\Project\Features\Core\ViewProcessor $view
 * @var \App\Module $module
 */
$datatable = $datatable ?? $view->datatable; // Resolve datatable
$dtName = $datatable->name(); // Datatable name
$formId = $datatable->filterFormId(); // Define filter form Id
// $datatable->filterOnSubmit = false; // If set to false filter will be applied without submit button click
?>

@section('title')
    @include('project.layouts.module.grid.includes.title')
@endsection


@section('content')
    {{-- Section: Filters --}}
    @if($datatable->showCustomFilter())
        <form id="{{$formId}}" class="dt-filter-form">

            {{-- Filter --}}
            @include('form.select-model-multiple',['var'=>['name'=>'group_id','label'=>'Group', 'model'=>\App\Group::class, 'name_field'=>'title', 'class'=>'filter-input']])
            @include('mainframe.form.date-range',['var'=>['name'=>'created_at','label'=>'Created At', 'class'=>'filter-input']])
            @include('form.text',['var'=>['name'=>'name','label'=>'Name', 'class'=>'filter-input']])

            {{-- Submit and Reset btn --}}
            @include('mainframe.form.datatable.submit-reset-btn')

        </form>
    @endif
    {{-- Section: Table --}}
    @include('mainframe.form.datatable.table')

@endsection

@section('js')
    @parent
    <script type="text/javascript">

		// Step 1. Custom js
		$('#{{$formId}} select').select2();

		// Step 2. Define filter form AJAX data
		let ajax = {
			url: "{!! $datatable->ajaxUrl() !!}",
			data: function (d) { // Step.2.1 Define AJAX data. Properly target to avoid conflict with other element in form
				d.name = $('#{{$formId}} #name').val();
				d.group_id = $('#{{$formId}} #group_id').val();
				d.created_at_from = $('#{{$formId}} #created_at_from').val(); // From date-range picker
				d.created_at_till = $('#{{$formId}} #created_at_till').val(); // From date-range picker
			}
		};
    </script>
    @include('mainframe.form.datatable.js')
@endsection

@unset($datatable, $dtName, $formId)
