/*
|--------------------------------------------------------------------------
| After loader js
|--------------------------------------------------------------------------
| This js loads once all the scrips have been loaded. This usually
| handles common js features that needs to be activated through
| the application.
|
*/

initAfterLoader();

function initAfterLoader() {
	initPopup();
	initTooltip();
	initDatepicker();
	initGenericDeleteBtn();
	initSlimscroll(); // Todo: Fix required
	initDatatable();
	initSelect2();
	initCheckbox();
	initAutosizeTextarea();
	initJsonTextarea(); // Format Json Text area
	initSortable(); // Format Json Text area
	initDatatableErrorHandler();
	initImagelightbox();
	initPanelToggle();
	initDynamicModalTrigger();
}

/*
|--------------------------------------------------------------------------
| Activate pop ups for links that has 'popup' class
|--------------------------------------------------------------------------
|
| This function binds a link with a popup action. If a link has class .
| popup then it will open up in a popup window of the configuration
| defined below.
|
*/
function initPopup() {
	$('.popup').on('click', function () {

		var height = 600;
		var width = 800;
		var NWin = window.open($(this).prop('href'), '', 'scrollbars=1,height=' + height + ',width=' + width);
		if (window.focus) {
			NWin.focus();
		}
		return false;
	});
}


/*
|--------------------------------------------------------------------------
| Activate pop-over tooltip
|--------------------------------------------------------------------------
| https://getbootstrap.com/docs/4.0/components/popovers/
|
*/
function initTooltip() {
	$('[data-toggle="popover"]').popover();
	setTimeout(function () {
		$('[data-toggle="tooltip-open"]').tooltip('show');
	}, 2000)
}

/*
|--------------------------------------------------------------------------
| Enable date-picker for fields with 'datepicker' class
|--------------------------------------------------------------------------
|
|
*/
function initDatepicker() {
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd', autoclose: true, clearBtn: true
	});
}

/*
|--------------------------------------------------------------------------
| Init generic delete button
|--------------------------------------------------------------------------
| Clicking Delete button shows up a confirmation modal.
|
*/
// initGenericDeleteBtn();


/*
|--------------------------------------------------------------------------
| Enable slim scroller
|--------------------------------------------------------------------------
| enable slim scroll for all HTML element with class 'slimscroll'
| https://github.com/kamlekar/slim-scroll?tab=readme-ov-file
| https://rawgit.com/venkateshwar/slim-scroll/master/tests/test1/index.html
|
*/
function initSlimscroll() {
	$('.slimscroll').each((i, el) => {
		new slimScroll(el, {
			// 'wrapperClass': 'scroll-wrapper unselectable mac',
			// 'scrollBarContainerClass': 'scrollBarContainer',
			// 'scrollBarContainerSpecialClass': 'animate',
			// 'scrollBarClass': 'scroll',
			// 'keepFocus': true
		});
	});
}

/*
|--------------------------------------------------------------------------
| Init datatables
|--------------------------------------------------------------------------
| Instantiate datatable for tables with following class. These
| datatables have pre-defined configurations
| .datatable-min
| .datatable-min-no-pagination
|
*/
// $('.datatable').dataTable({
//     "bPagination": false,
//     "bFilter": false,
//     "bPaginate": false,
//     "bLengthChange": false,
//     "bInfo": false,
//     "bPageLength": 10,
//     "aaSorting": [[0, "asc"]]
//     'mark': true
// });

var datatableMinConfig = {
	"bPagination": false,
	"bFilter": false,
	//"bPaginate": false,
	"bLengthChange": false,
	"bInfo": false,
	"bPageLength": 10,
	"aaSorting": [[0, "asc"]],
	'mark': true
};

var datatableMinNoPaginationConfig = {
	"bPagination": false,
	"bFilter": false,
	"bPaginate": false,
	"bLengthChange": false,
	"bInfo": false,
	"bPageLength": 10,
	"aaSorting": [[0, "asc"]],
	'mark': true
};

function initDatatable() {
	$('.datatable-min').dataTable(datatableMinConfig);
	$('.datatable-min-no-pagination').dataTable(datatableMinNoPaginationConfig);
}

/*
|--------------------------------------------------------------------------
| Activate select2
|--------------------------------------------------------------------------
|
| Activate select2 for all <select>
| Not a good idea to activate select
*/

function initSelect2() {
	$('select.select2').select2(); // Causes issue with vue
}


// init mainframe checkbox with checked_val and unchecked_val
// initCheckbox();

/*---------------------------------
| Auto resize all text area
|---------------------------------*/
function initAutosizeTextarea() {
	autosize(document.querySelectorAll('textarea'));
}


/*
|--------------------------------------------------------------------------
| Enable sortable list
|--------------------------------------------------------------------------
*/
function initSortable() {
	$('.sortable').sortable();
}


function initDatatableErrorHandler() {
	$.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
		console.log(message);
		alert("Data could not be loaded. It can be because of your session has expired. Please refresh the page.");
	};
}

/*
|--------------------------------------------------------------------------
| Activate imagelightbox https://github.com/marekdedic/imagelightbox
|--------------------------------------------------------------------------
*/
function initImagelightbox() {
	$('a[data-load="imagelightbox"]')
		.imageLightbox({
			activity: true, arrows: true, button: true, caption: true, // navigation: true,
			overlay: true, quitOnDocClick: true
		});
}


/*
|--------------------------------------------------------------------------
| Button to show hide panel
|--------------------------------------------------------------------------
*/
function initPanelToggle() {
	$('.click-show-panels').on('click', function () {
		$('.panel-collapse').collapse('show');
	});

	$('.click-hide-panels').on('click', function () {
		$('.panel-collapse').collapse('hide');
	});
}

/*
|--------------------------------------------------------------------------
| Init dynamic modal trigger
|--------------------------------------------------------------------------
*/
function initDynamicModalTrigger() {

	// Correct way - using event delegation
	$(document).on('click', '.dynamic-modal-trigger', function () {
		let url = $(this).data('url');
		let width = $(this).data('width');
		if (url === '#') {
			console.log('No URL provided for dynamic modal');
			return false;
		}

		$('#dynamicModal .modal-dialog').css('width', width); // Set modal width

		axios.get(url).then(function (response) { // Axios' response is wrapped in response.data
			$('#dynamicModal .modal-content').html(response.data); // Load content from partial
		}).catch(function (error) {
			console.log(error);
		});
	});


	// Dynamic modal close event
	$('#dynamicModal').on('hidden.bs.modal', function (e) {
		// console.log('Dynamic modal has been closed');
		// Clear modal content when closed
		$('#dynamicModal .modal-content').empty();
	});
}

/**
 * Force clear padding on modal close.
 * When modal is completely hidden, remove padding-right from body.
 * Otherwise the 15 px padding that gets added automatically impacts
 * datatable layout. A scroll gets added.
 */
$('.modal').on('hidden.bs.modal', function (e) {
	$('body').css('padding-right', '0px');
	console.log('Modal has been completely hidden!');
});