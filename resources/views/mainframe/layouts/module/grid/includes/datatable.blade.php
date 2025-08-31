<?php

/**
 * @var \App\Project\Features\Datatable\Datatable $datatable
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
$datatable = $datatable ?? $view->datatable; // Resolve datatable
$dtName = $datatable->name(); // Datatable name
$formId = $datatable->filterFormId(); // Define filter form Id
$datatable->showCustomFilter = false;
?>

{{-- Section: Filters --}}
@if($datatable->showCustomFilter())
    <form id="{{$formId}}" class="dt-filter-form">
        {{-- Examples--}}
        @include('form.text',['var'=>['name'=>'name','label'=>'Name', 'class'=>'filter-input']])
        @include('mainframe.form.date-range',['var'=>['name'=>'created_at','label'=>'Created At', 'class'=>'filter-input']])
        @include('mainframe.form.datatable.submit-reset-btn')
    </form>
@endif

{{-- Section: Table --}}
@include('mainframe.form.datatable.table')

@section('js')
    @parent
    <script type="text/javascript">
		// Step.1 Enable Select2
        {{--$('#{{$formId}} select').select2();--}}

		// Step - Define filter form AJAX data
		var ajax = {
			url: "{!! $datatable->ajaxUrl() !!}",
			data: function (d) { // Step.2.1 Define AJAX data. Properly target to avoid conflict
				d.name = $('#{{$formId}} #name').val();
				d.created_at_from = $('#{{$formId}} #created_at_from').val(); // From date-range picker
				d.created_at_till = $('#{{$formId}} #created_at_till').val(); // From date-range picker
			}
		};
    </script>
    @include('mainframe.form.datatable.js')
@endsection

@unset($datatable, $dtName, $formId)
