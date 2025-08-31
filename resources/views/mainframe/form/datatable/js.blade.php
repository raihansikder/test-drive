<script type="text/javascript">
	var {{$dtName}} = $('#{{$dtName}}').DataTable({
		ajax: ajax, // Define the ajax URL and form data
		columns: [{!! $datatable->columnsJson() !!}],
		processing: {!! $datatable->processing() !!},
		serverSide: {!! $datatable->serverSide() !!},
		searchDelay: {!! $datatable->searchDelay() !!},
		minLength: {!! $datatable->minLength() !!},
		lengthMenu: {!! $datatable->lengthMenu() !!},
		pageLength: {!! $datatable->pageLength()!!},
		order: {!! $datatable->order()!!},
		bLengthChange: {!! $datatable->bLengthChange() !!},
		bPaginate: {!! $datatable->bPaginate() !!},
		bFilter: {!! $datatable->bFilter() !!},
		bInfo: {!! $datatable->bInfo() !!},
		bDeferRender: {!! $datatable->bDeferRender() !!},
		"dom": '{!! $datatable->dom() !!}',
		"buttons": [
			{
				className: 'dt-refresh-btn btn btn-default no-border',
				text: '<i class="fa fa-refresh" name="reload"></i>',
				action: function (e, dt, node, config) {
					dt.search('').draw();
				}
			}
		],
		mark: {!! $datatable->mark() !!} // Mark/highlight the search results (in yellow)
	});

	// Step.3.1 Catch filter input change event and refresh datatable
    @if(!$datatable->filterOnSubmit())
	$('#{{$formId}} .filter-input').on('change blur', function () {
        {{$dtName}}Refresh();
	});

	$('.date-range-picker').on('apply.daterangepicker cancel.daterangepicker', function (ev, picker) {
        {{$dtName}}Refresh();
	});
    @endif

	// Step.3.2 Catch filter input change event and refresh datatable
	$('#{{$formId}} .submit-btn').on('click', function () {
        {{$dtName}}Refresh();
	});

	// Step.4 Reset the filters and reset datatable
	$('#{{$formId}} .reset-btn').on('click', function () {
		resetForm('{{$formId}}');
        {{$dtName}}Refresh();
	})

	/**
	 * Build the default module report URL based on selected parameters
	 */
	function {{$dtName}}Refresh() {
        {{$dtName}}.draw();

        @isset($module)
		setReportBtnUrl('{!! route($module->name.'.report') !!}' + '?' + $('#{{$formId}}').serialize());
        @endif
	}

	/*
    |--------------------------------------------------------------------------
    | Step.4.1 Handle date-range picker events (apply, cancel button click)
    |--------------------------------------------------------------------------
    */

</script>