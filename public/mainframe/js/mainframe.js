// noinspection JSUnusedGlobalSymbols
var default_modal_timeout = 3000;
var delete_form_name = 'deleteForm';

/*
|--------------------------------------------------------------------------
| Code- CKEditor configurations
|--------------------------------------------------------------------------
| Following config variables and functions are used to initialize CKEditor
|
*/
/**
 * Basic CKEditor configuration
 * @type json
 */
var editor_config_basic = {
	toolbarGroups: [{"name": "basicstyles", "groups": ["basicstyles"]}],
	removeButtons: 'CreateDiv,Styles,Format,Font',
	enterMode: CKEDITOR.ENTER_BR,
	shiftEnterMode: CKEDITOR.ENTER_P,
	autoParagraph: false // stop from automatically adding <p></p> tag.
};


/**
 * Extended CKEditor configuration
 * @type json
 */
var editor_config_extended = {

	// Define the toolbar groups as it is a more accessible solution.
	toolbarGroups: [
		{"name": "basicstyles", "groups": ["basicstyles"]},
		{"name": "links", "groups": ["links"]},
		{"name": "paragraph", "groups": ["list", "blocks"]},
		{"name": "document", "groups": ["mode"]},
		{"name": "insert", "groups": ["insert"]},
		{"name": "styles", "groups": ["styles"]}, //{"name": "about", "groups": ["about"]}
	],
	// removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar', // Remove the redundant buttons from toolbar groups defined above.
	// readOnly: true, // make editor readonly
	// width: 730,
	allowedContent: true, // Allows div and other
	enterMode: CKEDITOR.ENTER_BR,
	shiftEnterMode: CKEDITOR.ENTER_P,
	autoParagraph: false // stop from automatically adding <p></p> tag
	/******************************
	 * extra plugins
	 ******************************/
	//extraPlugins: 'autogrow',
	//autoGrow_onStartup: true,
	//autoGrow_minHeight: 250,
	//autoGrow_maxHeight: 600

};

/**
 * Minimal CKEditor configuration
 * @type json
 */
var editor_config_minimal = {
	// readOnly: true, // make editor readonly
	toolbarGroups: [
		{"name": "basicstyles", "groups": ["basicstyles"]},
		{"name": "links", "groups": ["links"]},
		{"name": "paragraph", "groups": ["list", "blocks"]},
		//{"name": "document", "groups": ["mode"]},
		{"name": "insert", "groups": ["insert"]},
		{"name": "styles", "groups": ["styles"]},
		//{"name": "about", "groups": ["about"]}
	],
	removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Image,Flash,Smiley,HorizontalRule,SpecialChar,Format,Font,Iframe,PageBreak',
	enterMode: CKEDITOR.ENTER_BR,
	shiftEnterMode: CKEDITOR.ENTER_P,
	autoParagraph: false // stop from automatically adding <p></p> tag
	// readOnly: true, // make editor readonly
	// width: 730,
	/******************************
	 * extra plugins
	 ******************************/
	//extraPlugins: 'autogrow',
	//autoGrow_onStartup: true,
	//autoGrow_minHeight: 250,
	//autoGrow_maxHeight: 600

};

/**
 * Instantiates CKEditor textarea.
 * Instantiates a text area so that it is compatible with ajax based form submission
 * This function checks for any change in the editor and when changes is found
 * it updates the hidden input with the changed value in the editor
 *
 * @param id
 * @param config
 */
function initEditor(id, config = null) {

	if (!config) {
		config = editor_config_basic;
	}

	if ($('textarea#' + id).length) {
		CKEDITOR.replace(id, config);
		// update textarea as soon as something is updated in CKEditor
		CKEDITOR.instances[id].on('change', function () {
			CKEDITOR.instances[id].updateElement()
		});
	}
}

/**
 * Re-initialize CKEditor instance
 * @param id
 * @param config
 */
function reInitEditor(id, config = null) {
	CKEDITOR.instances[id].destroy();
	initEditor(id, config)
}


/**
 * jquery function to get outerHTML
 * @param s
 * @returns {*}
 */
jQuery.fn.outerHTML = function (s) {
	return s ? this.before(s).remove() : jQuery("<p>").append(this.eq(0).clone()).html();
};


/**
 * Get selected values as array from a multi-select select
 * @param selector
 * @param attr
 * @returns {Array}
 */
function getMultiSelectAsArray(selector, attr = null) {
	var arr = [];
	$(selector + ' :selected').each(function (i, selected) {
		if (attr) {
			val = $(selected).attr(attr);
		} else {
			val = $(selected).val();
		}

		arr[i] = val;
	});
	return arr;
}

/**
 * Get selected values as array
 * @param selector
 * @returns {Array}
 */
function getInputAsArray(selector) {
	var arr = [];
	$(selector).each(function (i, input) {
		arr[i] = $(input).val();
	});
	return arr;
}

/**
 * Get selected CSV values as array
 * @param str
 */
function csvToArray(str) {
	return v(str).words(/[^\s,]+/g);
}

/**
 * Reloads the data of a DataTable instance by re-fetching the data from the server.
 *
 * @param {string} id - The ID of the HTML element containing the DataTable to be reloaded.
 * @return {void} This method does not return a value.
 */
function reloadDatatable(id) {
	$('#' + id).DataTable().ajax.reload();
}

/**
 * Reloads the data of a DataTable instance by re-fetching the data from the server.
 * @param id
 * @alias reloadDatatable
 */
function refreshDatatable(id) {
	reloadDatatable(id);
}

/**
 * Disables the redirect on success functionality for a given form by setting the value of the
 * `redirect_success` input field to `#`.
 *
 * @param {string} form_name - The name of the form whose redirect on success functionality will be disabled.
 * @return {void} This function does not return a value.
 */
function disableRedirectOnSuccess(form_name) {
	$('form[name=' + form_name + ']').find('input[name=redirect_success]').val('#');
}

/**
 * Disables the redirect on fail functionality for a given form by setting the value of the
 * @param form_name
 */
function disableRedirectOnFail(form_name) {
	$('form[name=' + form_name + ']').find('input[name=redirect_fail]').val('#');
}

/**
 * Disable redirect on success and fail for a given form.
 * @param form_name
 */
function disableRedirectOnFormSubmit(form_name) {
	disableRedirectOnSuccess(form_name);
	disableRedirectOnFail(form_name);
}

/*
|--------------------------------------------------------------------------
| Generic Mainframe delete feature
|--------------------------------------------------------------------------
|
|
*/


/**
 * Get the delete form Jquery object.
 * @returns {*|jQuery|HTMLElement}
 */
function deleteForm(name = null) {
	if (!name) {
		name = delete_form_name;
	}
	return $('form[name=' + name + ']');
}

/**
 * Set the form values for the delete modal form based on the attributes of the delete button.
 * @param $btn Jquery object
 */
function setupDeleteFormForBtn($btn) {

	let $form = deleteForm(); // Get the universal delete form

	// $form.trigger('reset'); // Should not reset as it clears out some essential fields i.e., _method, _token, etc.

	// Set form values from the button data attributes
	$form.attr('action', $btn.attr('data-route')); // set action route

	// Custom fields
	$form.find('input[name=redirect_success]').val($btn.attr('data-redirect_success')); // set redirect on success
	$form.find('input[name=redirect_fail]').val($btn.attr('data-redirect_fail')); // set redirect on fail
	$form.find('input[class=refresh_datatable_id]').val($btn.attr('data-refresh_datatable_id')); // set redirect on fail
	$form.find('input[class=hide_class]').val($btn.attr('data-hide_class')); // set redirect on fail
}

/**
 * Function to prepare the form that will POST to delete route.
 * Make the delete button responsive to context. Click on the delete button loads a modal
 * and a form with relevant values required for delete. These values include
 * the route that will trigger the delete action. Also determines the redirect
 * path on successful delete and delete failure.
 */
function initGenericDeleteBtn() {

	// When the delete button is clicked, show the modal and fill the form
	$('button[name=genericDeleteBtn]').on('click', function () {
		showDeleteModalForBtn($(this));
	});

	// When to delete submit is clicked, submit the form
	$('#deleteSubmit').on('click', function () {
		$('#deleteModal').modal('hide');
	});
}

/**
 * Prepare the delete modal form. Add input values to the form.
 * @param $btn Jquery object
 *
 */
function showDeleteModalForBtn($btn) {
	setupDeleteFormForBtn($btn);
	enableAjaxFormSubmission(delete_form_name);
}

/**
 * Checks if a value is a valid object
 * @param val
 * @returns {*}
 */
function parseJson(val) {
	if (typeof val === 'object') {
		return val;
	}

	// else convert to json object
	return JSON.parse(val);
}


/**
 * Disable all inputs in a form except for the ones that are specified in the exclude array.
 */
function makeAllInputReadonly() {
	$('input, textarea, select').attr('readonly', 'readonly'); // make everything readonly
	$('button[name=genericDeleteBtn]').hide(); // hide delete buttons
	$('option:not(:selected)').attr('disabled', true).remove(); // remove all options that are not selected
	$("select").prop("disabled", true);
}

/**
 * Hide empty/non-value options from a select. Only keep the options that has a value.
 */
function hideEmptySelectOptions() {
	$('select option')
		.filter(function () {
			return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
		})
		.remove();
}


/**
 * Init checkbox functionality
 */
function initCheckbox() {

	$('.mf-checkbox').each(function () {
		var checkbox = $(this);
		var checked_val = checkbox.attr('data-checked-val');

		if (checkbox.val() == checked_val) {
			checkbox.prop('checked', true);
		} else {
			checkbox.prop('checked', false);
		}
		checkbox.trigger('change')
	});

	$('.mf-checkbox').change(function () {
		var checkbox = $(this);
		var checked_val = checkbox.attr('data-checked-val');
		var unchecked_val = checkbox.attr('data-unchecked-val');
		var id = $(this).attr('data-checkbox-id');

		if (checkbox.is(':checked')) {
			$('input[class=' + id + ']').val(checked_val);
			checkbox.val(checked_val);
		} else {
			$('input[class=' + id + ']').val(unchecked_val);
			checkbox.val(unchecked_val);
		}
	});
	// Activate iCheck checkbox style
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue'
	});
}

/**
 * initUploader function initiates the generic uploader used commonly in modules
 *
 * documentations http://hayageek.com/docs/jquery-upload-file.php#doc
 * @param id : root div container of the uploader
 * @param url : url where uploader will post the data
 */
function initUploader(id, url) {
	$("#" + id + " .file-uploader").uploadFile({

		url: url,
		method: "POST",
		fileName: "file",
		returnType: 'json',

		// allowedTypes: "", // Extensions i.e. "jpeg,png,jpg"
		// acceptFiles: "audio/*", // Shows these files in Windows explorer. http://stackoverflow.com/questions/11832930/html-input-file-accept-attribute-file-type-csv
		// maxFileSize: 8,
		// maxFileCount: 1,
		multiple: true,

		uploadStr: "Select",
		uploadButtonClass: 'btn btn-default btn-transparent btn-upload',
		autoSubmit: true,

		dragDrop: true,
		dragDropStr: "<span style='margin-left: 5px'> -OR- Drop Here</span>",
		dragdropWidth: '100%',

		showStatusAfterSuccess: true,
		statusBarWidth: '100%',

		showPreview: true,
		previewHeight: "100px",
		previewWidth: "auto",
		showDone: true,
		doneStr: '✔️', //
		// dynamicFormData: function () {
		//     // Note - Older implementation that doesn't use serialize()
		//     return {
		//         "ret": "json",
		//         "_token": $("#" + id + " input[name=_token]").val(),
		//         "tenant_id": $("#" + id + " input[name=tenant_id]").val(),
		//         "module_id": $("#" + id + " input[name=module_id]").val(),
		//         "element_id": $("#" + id + " input[name=element_id]").val(),
		//         "element_uuid": $("#" + id + " input[name=element_uuid]").val(),
		//         "type": $("#" + id + " input[name=type]").val()
		//     };
		// },
		dynamicFormData: function () { // New implementation using serialization
			return $('div#' + id).find("select, textarea, input").serialize();
			// return $('#' + id + ' form').serialize(); // Serialize everything in form. Nah! no wise.
		},
		onSuccess: function (files, ret, xhr) {
			if (ret.status == 'fail') {
				$('div.ajax-file-upload-green').hide();
				$('div.ajax-file-upload-statusbar:first').hide();
				showResponseModal(parseJson(ret), default_modal_timeout);
			}
			// var path = ret.message.path;
		},
		onError: function (files, status, errMsg) {
			$("#status").html("<span style='color: green;'>Something Wrong</span>");
		}
	});
}

/**
 * Instantiate image file uploader
 */
function initImageUploader(id, url) {
	$("#" + id + " .file-uploader").uploadFile({
		url: url,
		method: "POST", //
		fileName: "file",
		returnType: 'json',

		allowedTypes: "jpg,jpeg,png", // Extensions i.e. "jpeg,png,jpg"
		acceptFiles: "image/*", // Shows these files in Windows explorer. http://stackoverflow.com/questions/11832930/html-input-file-accept-attribute-file-type-csv
		// maxFileSize: 8,
		// maxFileCount: 1,
		multiple: false,

		uploadStr: "Select",
		uploadButtonClass: 'btn btn-default btn-transparent btn-upload',
		autoSubmit: true,

		dragDrop: true,
		dragDropStr: "<span style='margin-left: 5px'> -OR- Drop Here</span>",
		dragdropWidth: '100%', //maxFileSize: 8,

		showStatusAfterSuccess: true,
		statusBarWidth: '100%',

		showPreview: true,
		previewHeight: "100px",
		previewWidth: "auto",
		showDone: true,
		doneStr: '✔️',
		dynamicFormData: function () {
			return $('div#' + id).find("select, textarea, input").serialize();
		},
		onSuccess: function (files, ret) {
			if (ret.status == 'fail') {
				$('div.ajax-file-upload-green').hide();
				$('div.ajax-file-upload-statusbar:first').hide();
				showResponseModal(parseJson(ret), 3000);
			}
		},
		onError: function () {
			$("#status").html("<span style='color: green;'>Something Wrong</span>");
		}
	});
}


/**
 * Instantiate an uploader for single file
 */
function initSingleFileUploader(id, url) {
	$("#" + id + " .file-uploader").uploadFile({
		url: url,
		method: "POST",
		fileName: "file",
		returnType: 'json',
		// allowedTypes: "", // Extensions i.e. "jpeg,png,jpg"
		// acceptFiles: "audio/*", // Shows these files in Windows explorer. http://stackoverflow.com/questions/11832930/html-input-file-accept-attribute-file-type-csv
		// maxFileSize: 8,
		// maxFileCount: 1,
		multiple: false,
		showFileCounter: false,
		uploadStr: "Select",
		uploadButtonClass: 'btn btn-default btn-transparent btn-upload',
		autoSubmit: true,
		dragDrop: true,
		dragDropStr: "<span style='margin-left: 5px'> -OR- Drop Here</span>",
		dragdropWidth: '100%', //
		showStatusAfterSuccess: true,
		statusBarWidth: '100%',
		showPreview: true, // showDelete: true,
		previewHeight: "100px",
		previewWidth: "auto",
		showDone: true,
		doneStr: '✔️',
		dynamicFormData: function () { // New implementation using serialization
			return $('div#' + id).find("select, textarea, input").serialize();
		},
		onSuccess: function (files, ret, xhr, pd) {
			if (ret.status == 'fail') {
				$('div.ajax-file-upload-green').hide();
				$('div.ajax-file-upload-statusbar:first').hide();
				showResponseModal(parseJson(ret), 3000);
			} else {
				// Hide all the upload previews except for the last one
				$('#' + id).find('.ajax-file-upload-statusbar:not(:first)').hide();
			}
		},
		onError: function () {
			$("#status").html("<span style='color: green;'>Something Wrong</span>");
		}
	});
}


/**
 * Function to check if a key exists in a nested json return.
 * https://stackoverflow.com/questions/2631001/javascript-test-for-existence-of-nested-object-key
 *
 * var test = {level1:{level2:{level3:'level3'}} };
 * checkNested(test, 'level1', 'level2', 'level3'); // true
 * checkNested(test, 'level1', 'level2', 'foo'); // false
 *
 * @param obj
 * @returns {boolean}
 */
function hasNestedKey(obj /*, level1, level2, ... levelN*/) {
	var args = Array.prototype.slice.call(arguments, 1);

	for (var i = 0; i < args.length; i++) {
		if (!obj || !obj.hasOwnProperty(args[i])) {
			return false;
		}
		obj = obj[args[i]];
	}
	return true;
}


/**
 * Resolve datepicker conflict
 */
if (!$.fn.bootstrapDatepicker && $.fn.datepicker && $.fn.datepicker.noConflict) {
	var datepicker = $.fn.datepicker.noConflict();
	$.fn.bootstrapDatepicker = datepicker;
}

/**
 * Init bootstrap datepicker
 * @param selector
 * @param format
 * @returns {jQuery|undefined}
 */
function initBootstrapDatepicker(selector, format = 'dd-mm-yyyy') {
	return $(selector + '_formatted').bootstrapDatepicker({
		todayBtn: true, todayHighlight: true, format: format, autoclose: true, clearBtn: true
	}).on('clearDate', function (ev) {
		$(selector).val(null);
	}).on('changeDate', function (ev) {
		var validDate = null;
		var formattedDate = $(this).val();      // '01-04-2020'

		if (formattedDate.length) {
			var formatParts = format.split('-');   // ['01','04','2020']
			var dateParts = formattedDate.split('-');   // ['01','04','2020']

			var map = [];
			for (var i = 0; i < formatParts.length; i++) {
				map[formatParts[i]] = dateParts[i];
			}

			var day = map['dd']; // '01'
			var month = map['mm']; // '04'
			var year = map['yyyy']; // '2020'
			// console.log(year.length + " " + month.length + " " + day.length);
			if (year.length === 4 && month.length === 2 && day.length === 2) {
				validDate = year + '-' + month + '-' + day;
			}
		}
		$(selector).val(validDate);
	});
}

/**
 * Init Jquery datepicker
 * @param selector
 * @param format
 * @returns {jQuery|undefined}
 */
function initJQueryDatePicker(selector, format = 'dd-mm-yy') {
	return $(selector + '_formatted').datepicker({
		dateFormat: format, altFormat: "yy-mm-dd", // Standard datetime format
		altField: selector, changeMonth: true, changeYear: true
	});
}

/**
 * JS based api_token re-generator
 * @param len
 * @param charSet
 * @returns {string}
 */
function randomString(len, charSet) {
	charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var randomString = '';
	for (var i = 0; i < len; i++) {
		var randomPoz = Math.floor(Math.random() * charSet.length);
		randomString += charSet.substring(randomPoz, randomPoz + 1);
	}
	return randomString;
}

/**
 * Format a text area that contains JSON data.
 * @param css
 */
function initJsonTextarea(css) {

	if (!css) {
		css = 'json';
	}

	// console.log(css);
	$('textarea.' + css).each(function (i, el) {
		var elem = $(el);
		$(elem).bind('change', () => {
			var ugly = elem.val();
			if (ugly) {
				// console.log(elem);
				var obj = JSON.parse(ugly);
				var pretty = JSON.stringify(obj, undefined, 4);
				elem.val(pretty);
			}
		});
		elem.trigger('change');
	});

}

/**
 * Float the main CTA section. If this is called then the main CTA will show in a relative
 * position in the form and scroll up and down. This will no longer place the CTA at
 * the bottom of the page in a static position.
 */

function ctaFloat() {
	$(".delete-cta").css({"margin-right": 0});
	$(".cta-block").css({"position": "relative", "border-top": "none"});
}

/**
 * Change default module CTA text. You can target other elements using
 * Jquery selector.
 *
 * @param text
 * @param target By default target the main module-form CTA (.module-save-btn)
 */
function ctaText(text, target = ".module-save-btn") {
	$(target).html(text);
}

/**
 * Print page
 */
function printPage(buttonId = "btnPrint") {
	var printButton = document.getElementById(buttonId);
	printButton.style.visibility = 'hidden';
	window.print();
	printButton.style.visibility = 'visible';
}

/**
 * Generate uuid
 * @returns {string}
 */
function uuid() {
	// noinspection SpellCheckingInspection
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'
		.replace(/[xy]/g, function (c) {
			const r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
			return v.toString(16);
		});
}

/**
 * Set Select input style based on a selected value.
 * If an OPTION='Lorem Ipsum', then when it is selected the CSS 'selected-{cssClass}-lorem-ipsum' is appended
 * to the <SELECT> element
 *
 * @param cssClass
 * @param prefix
 */
function setStyleBasedOnSelectedValue(cssClass = 'class', prefix = 'selected-') {
	$('select.' + cssClass).on('change', function () {


		// Step 1 - Add the new class 'selected-{cssClass}-lorem-ipsum'
		var select = $(this);
		var select_val = select.val();
		var add_class = prefix + cssClass + '-' + v.kebabCase(select_val);
		select.addClass(add_class);

		// Step 2 - Remove non-selected option classes
		$(this).find('option').each(function () {
			var option = $(this);
			var option_val = option.val();
			if (option_val != select_val) {
				var remove_class = prefix + cssClass + '-' + v.kebabCase(option_val);
				select.removeClass(v.kebabCase(remove_class));
			}
		});

	}).trigger('change');
}

/*
|--------------------------------------------------------------------------
| Datatable related helper functions
|--------------------------------------------------------------------------
*/

/**
 * Generate a report URl from a form based filter inputs
 * @param form
 * @param reportBaseUrl
 * @param btnClass
 */
function buildReportUrlFromFilterParams(form = 'FilterForm', reportBaseUrl = '/', btnClass = 'report-btn') {

	// Resolve form
	let $form = form;
	if (typeof form === 'string') {
		$form = resolveForm(form);
	}

	// Build URL from params
	let params = $form.serialize();
	let url = reportBaseUrl + '?' + params;

	// Assign URL
	$('a.' + btnClass).attr('href', url);
}


/**
 * Reset datatable filter form
 * @param formId
 */
function resetDatatableFilter(formId) {
	resetForm(formId)
}

/**
 * Set report button url
 * @param url
 */
function setReportBtnUrl(url){
	$('a.module-report-btn').attr('href', url);
}


/**
 * Reset a form
 * @param form
 */
function resetForm(form) {

	let $form = form;
	if (typeof form === 'string') {
		$form = resolveForm(form)
	}

	$form.trigger('reset');
	$form.find('text').val('');
	$form.find('input').val('');
	$form.find('select').select2('val', '');
	$form.find('.select2').trigger('change');
	$form.find('#ajax_select2_input_id').prop('selectedIndex', -1);
	$form.find('.date-range-picker').html('-');

}


/**
 * Dynamically show/hide HTML divs based on selection value
 * @param selectId
 * @param optionAttr
 */
function showDivsBasedOnSelect(selectId, optionAttr) {
	$('#' + selectId).on('change', function () {

		// 1- Get the selected value(s)
		var values = getMultiSelectAsArray('#' + selectId, optionAttr);

		// 2- Force hide conditional divs
		$('.depends-on-' + selectId).hide();

		// 3- Show the divs with matching class(kebab-case)
		_(values).forEach(function (value) {
			$('div.' + selectId + '-' + v.kebabCase(value)).show(); // _() is a low-dash function.See: https://lodash.com/docs/2.4.2#forEach
		});
	}).trigger('change');
}

/**
 * Hide all modals
 */
function hideModals() {
	$('.modal').modal('hide');
}

/**
 * Enable a button
 * @param $btn
 * @param btnText
 */
function enableBtn($btn, btnText = null) {
	if (btnText) {
		$btn.html(btnText);
	}

	$btn.removeClass('disabled').attr('disabled', false);
}

/**
 * Disable a button
 * @param $btn
 */
function disableBtn($btn) {
	$btn.addClass('disabled').attr('disabled', true);
}

/**
 *
 * Show a collapsed HTML (i.e. accordion) under an element
 * @param $element
 */
function showCollapsedSections($element) {
	$element.find('.collapse').collapse('show');
}