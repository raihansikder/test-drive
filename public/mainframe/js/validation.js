/**
 *   Function enables the js to run front-end validation.
 * @param {string} formName Form name/id
 * @param {*} callbackSuccess function to execute on success
 * @param {*} callbackFail function to execute on fail
 *
 * @alias enableAjaxFormSubmission
 * @depricated Use the fluent alias enableAjaxFormSubmission instead with the same signature
 */
function enableValidation(formName, callbackSuccess = false, callbackFail = false) {

    addRequiredIconsToLabels(); // Add required mark in fields

    let $form = resolveForm(formName); // Resolve the form element based on name/id
    let $btn = $form.find('button[type=submit]');
    $btn.attr('type', 'button'); // Change the button type from submitting to button to stop submission
    setRetToJson($form); // inject 'ret=json' input to enforce JSON return.

    // Instantiate validationEngine
    $form.validationEngine({prettySelect: true, promptPosition: "topLeft", scroll: true});

    // Run validation on submit button click.
    $btn.on('click', function () {

        $form.find('.collapse').collapse('show'); // Un-collapse accordions under that form.
        let btnText = $(this).html(); // Preserve initial button
        $(this).addClass('disabled').attr('disabled', true);

        // Check front-end validations first
        if ($form.validationEngine('validate') === false) {
            $(this).html(btnText).removeClass('disabled').attr('disabled', false);
            return; // Note: exit validation logic here.
        }

        // If all frontend validations are passed, then only execute AJAX save which automatically triggers BE validation
        $form.validationEngine('hideAll'); // Hide all front-end validation errors

        handleAjaxFormSubmission($form, $btn, callbackSuccess, callbackFail);
    });
}

/**
 * Handle ajax form submission
 * @param $form
 * @param $btn
 * @param callbackSuccess
 * @param callbackFail
 */
function handleAjaxFormSubmission($form, $btn, callbackSuccess, callbackFail) {

    $.ajax({
        datatype: 'json',
        method: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize()
    }).done(function (response) {
        response = parseJson(response);

        if (response.status === 'success') {
            if (callbackSuccess) {
                callbackSuccess(response);
            } else {
                $('.modal').modal('hide');
                if (responseHasRedirect(response)) {
                    handleRedirectWithModal(response, default_modal_timeout);
                } else {
                    showMsgModal(response, default_modal_timeout);
                }
            }
        }

        if (response.status === 'fail') {
            showFieldValidationPrompts(response, false);
            if (callbackFail) {
                callbackFail(response);
            } else {
                showMsgModal(response);
            }
        }

    }).error(function (response, textStatus, errorThrown) {
        showAlert(response.responseJSON.message);
    }).always(function (ret, textStatus, errorThrown) {
        $btn.removeClass('disabled').attr('disabled', false);
    });
}

/**
 * Check if response has redirect
 * @param response
 * @returns {*|boolean}
 */
function responseHasRedirect(response) {
    return v.count(response.redirect) && response.redirect !== '#';
}


/**
 * Handle redirect with modal notification
 * @param {Object} response - The response object containing redirect information
 * @param timeout
 */
function handleRedirectWithModal(response, timeout = null) {

    if (!timeout) {
        timeout = default_modal_timeout;
    }

    showMsgModal(response);
    msgModalDisableClosing();
    msgModalAddMsg('Redirecting. Please wait ...');
    setTimeout(function () {
        window.location.replace(response.redirect);
    }, timeout);
}


/**
 * Enable ajax form processing.
 * @param form Form name/id
 * @param onSuccess function to execute on success
 * @param onFail function to execute on fail
 *
 * @alias enableValidation
 */
function enableAjaxFormSubmission(form, onSuccess = false, onFail = false) {
    enableValidation(form, onSuccess, onFail)
}


/**
 * Inject 'ret=json' input to enforce JSON return.
 * @param {*|jQuery|HTMLElement} form
 */
function setRetToJson(form) {
    if (form.find('input[name=ret]').length) {
        form.find('input[name=ret]').val('json');
    } else {
        // Force-append a 'ret' field.
        // form.append('<input type="hidden" name="ret" value="json">');
        console.log("Param 'ret' not found in form:" + form.attr('name') + " " + form.attr('id'));
    }
}

/**
 * Resolve the form element based on name/id
 * @param name
 * @returns {*}
 */
function resolveForm(name) {
    var form = $('form[name=' + name + ']');
    if (!form.length) {
        form = $('form[id=' + name + ']'); // Find by id
    }
    return form;
}

/**
 * Add a message to modal
 * @param msg
 */
function msgModalAddMsg(msg) {
    $("#msgModal").find('#msgMessage').append(msg);
}

/**
 * Disable the close button and other close actions.
 */
function msgModalDisableClosing() {
    $('#msgModal').modal({
        backdrop: 'static',   // Prevents closing on clicking outside the modal
        keyboard: false      // Prevents closing on pressing ESC key
    });

    $('#msgModal .close').prop('disabled', true); // Disable close button
    $('#msgModal .close-btn').hide(); // or hide it
}

/**
 * Enable the close button and show the modal.
 */
function msgModalEnableClosing() {

    $('#msgModal').modal({
        backdrop: true,     // Enables closing on clicking outside the modal
        keyboard: true      // Enables closing on pressing ESC key
    });

    $('#msgModal .close').prop('disabled', false); // To re-enable later
    $('#msgModal .close-btn').show(); // or show it again
}

/**
 * show validation red boxes against each field
 * Fields are targeted based on ID. So they should have the id field that is same
 * as the name field
 * @param response
 * @param showAlert
 */
function showFieldValidationPrompts(response, showAlert = false) {
    let str = '';
    if (response.hasOwnProperty('validation_errors')) {
        $.each(response.validation_errors, function (k, v) {
            str += "\n" + k + ": " + v;
            // $("#label_" + k).validationEngine('showPrompt', v, 'error');
            $("*[id=" + k + "]").validationEngine('showPrompt', v, 'error');

        });
    }
    if (showAlert) {
        alert(response.status + " - " + response.message + "\n" + str);
    }
}


/**
 * Show the response in modal
 * @param response
 * @param timeout milliseconds
 * @alias showMsgModal
 */
function showResponseModal(response, timeout = null) {

    // if (!timeout) {
    //     timeout = default_response_modal_timeout;
    // }

    // $('.modal').modal('hide'); // Have to think if hiding is a good idea
    msgModalEnableClosing();

    // Load response and show modal
    loadResponseInModal(response);
    $('#msgModal').modal('show');

    // Auto close modal after some time
    if (timeout) {
        setTimeout(function () {
            $('#msgModal').modal('hide');
        }, timeout);
    }
}

/**
 * Show the response in modal
 * Alias function
 * @param response
 * @param timeout
 */
function showMsgModal(response, timeout) {
    return showResponseModal(response, timeout);
}

/**
 * Hide the msg modal
 * @param timeout
 */
function hideMsgModal(timeout = 0) {
    setTimeout(function () {
        $('#msgModal').modal('hide');
    }, timeout);
}

/**
 * Hide the response modal
 * @param timeout
 * @alias hideMsgModal
 */
function hideResponseModal(timeout) {
    hideMsgModal(timeout)
}

/**
 * Alias function
 * @param response
 */
function loadResponseInModal(response) {
    return loadMsg(response);
}

/*
 *  Clears and loads all new error, message and success
 *  note in the  modal that shows just after ajax submit.
 */
function loadMsg(response) {
    $('.ajaxMsg').empty().hide(); // first hide all blocks

    var hasError = false;
    var hasSuccess = false;
    var hasMessage = false;

    if (response.status === 'fail') {
        hasError = true;
        // $('div#msgError').append('<h4 class="text-red">Error - ' + (response.message ?? '') + '</h4>');
        $('div#msgError').append('<h4 class="text-red">Error</h4>');
    } else if (response.status === 'success') {
        hasSuccess = true;
        // $('div#msgSuccess').append('<h4 class="text-green">Success - ' + (response.message ?? '') + '</h4>');
        $('div#msgSuccess').append('<h4 class="text-green">Success</h4>');
    }

    if (response.hasOwnProperty('errors')) {
        $.each(response.errors, function (k, v) {
            if (v.length) {
                hasError = true;
                $('div#msgError').append(v + '<br/>');
            }
        });
    }

    if (response.hasOwnProperty('message')) {
        if (response.message != null) {
            hasMessage = true;
            $('div#msgMessage').append(response.message + '<br/>');
        }
    }

    if (response.hasOwnProperty('messages')) {
        $.each(response.messages, function (k, v) {
            if (v.length) {
                hasMessage = true;
                $('div#msgMessage').append(v + '<br/>');
            }
        });
    }
    if (response.hasOwnProperty('warnings')) {
        $.each(response.warnings, function (k, v) {
            if (v.length) {
                hasMessage = true;
                $('div#msgMessage').append(v + '<br/>');
            }
        });
    }
    if (response.hasOwnProperty('debug')) {
        $.each(response.debug, function (k, v) {
            if (v.length) {
                hasMessage = true;
                $('div#msgMessage').append(v + '<br/>');
            }
        });
    }

    //$('div#msgSuccess, div#msgError,div#msgMessage').show();
    if (hasError) $('div#msgError').show()
    if (hasSuccess) $('div#msgSuccess').show()
    if (hasMessage) $('div#msgMessage').show()
}

/**
 * Show message in modal. Thi is helpful to notify users
 * @param  msg string
 * @param timeout int milliseconds
 */
function showAlert(msg, timeout = null) {
    $('.ajaxMsg').empty().hide(); // first hide all blocks
    $('div#msgMessage').append(msg).show();
    $('#msgModal').modal('show');

    if (timeout) {
        setTimeout(() => {
            $('#msgModal').modal('hide');
        }, timeout);
    }
}

/**
 * Auto close message modal after some time
 */
function autoCloseMsgModal(timeout = null) {

    if (!timeout) {
        timeout = default_modal_timeout; // Default timeout
    }

    setTimeout(() => {
        $('#msgModal').modal('hide');
    }, timeout);
}

/**
 * Add span to show required icons
 * @alias addRequiredIconsToLabels
 * @deprecated Use addRequiredIconsToLabels
 */
function showRequiredIcons() {
    addRequiredIconsToLabels();
}

/**
 * Adds a "required" indicator to labels associated with fields
 * that are marked as required by a "validate[required]" class.
 *
 * This method identifies all fields with the "validate[required]" class,
 * retrieves their associated labels based on the "for" attribute,
 * and applies the "required" class to those labels.
 *
 * @return {void} This function does not return a value.
 */
function addRequiredIconsToLabels() {
    const requiredFields = Array.from(document.getElementsByClassName("validate[required]"));

    requiredFields.forEach(field => {
        const $field = $(field);
        const fieldId = $field.attr('id');
        $field.siblings(`label[for=${fieldId}]`).addClass('required');
    });
}

