(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// get JSON
	function getJson(jsonInputValue) {
		try {
			return JSON.parse(jsonInputValue);
		} catch (e) {
			console.error('Wrong JSON Format: ' + e);
		}
	}

	function validateJson(jsonString) {
		try {
			if (JSON.parse(jsonString)) {
				return true;
			}
			else {
				return false;
			}
		} catch (e) {
			console.error('Wrong JSON Format: ' + e);
			return false;
		}
	}


	$(document).ready(function () {

		if ($('.webphone-dynamics-admin-plugin.useJson').length) {

			let options = {editable: false};
			var jsonEditorDefault = new JsonEditor('#cs_jsonDefaultSettingParametersField', getJson(JSON.stringify(wphdynamics_default_config_parameters_json, null, "\t")), options);

			//let csSettingParametersFieldObject = (jQuery('.setting_parameters_field').val().trim() != '') ? getJson(jQuery('.setting_parameters_field').val()): {};
			let csSettingParametersFieldObject = (jQuery('.setting_parameters_field').val().trim() != '') ? getJson(jQuery('.setting_parameters_field').val()): jsonEditorDefault.get();
			var jsonEditor = new JsonEditor('#cs_jsonSettingParametersField', csSettingParametersFieldObject);

		}

		$('.wphdynamics_reset_paremeters').on('click', function(e) {
			try {
				let jsonDefaultParams = jsonEditorDefault.get();
				let jsonFieldString = JSON.stringify(jsonDefaultParams, null, "\t");
				if (validateJson(jsonFieldString)) {
					jsonEditor.load(jsonDefaultParams);
					showAlertMessage(wphdynamics_success_message_reset_default_remember_save, '.webphone_dynamics_settings_changes_notice', 'success');
				} else {
					cs_notify_msg.error(wphdynamics_error_message_wrong_json_format);
					showAlertMessage(wphdynamics_error_message_wrong_json_format, '.webphone_dynamics_settings_changes_notice', 'error');
				}
			}
			catch (e) {
				console.error('Wrong JSON Format: ' + e);
				cs_notify_msg.error(wphdynamics_error_message_wrong_json_format);
				showAlertMessage(wphdynamics_error_message_wrong_json_format, '.webphone_dynamics_settings_changes_notice', 'error');
			}
		});

		$('.webphone_dynamics_update_json_field').on('click', function(e) {
			try {
				e.preventDefault();
				let jsonFieldFormEditor = {};
				if ($('#cs_jsonSettingParametersField').text() != '') {
					jsonFieldFormEditor = jsonEditor.get();
				}
				let jsonFieldString = JSON.stringify(jsonFieldFormEditor, null, "\t");

				if (validateJson(jsonFieldString)) {
					jsonFieldString = (!jQuery.isEmptyObject(jsonFieldFormEditor)) ? jsonFieldString : '';
					$('.setting_parameters_field').val(jsonFieldString);
					$('.setting_parameters_field').text(jsonFieldString);
					$('.webphone_dynamics_save_form').submit();
				} else {
					//myAdminNotice('error', wphdynamics_error_message_wrong_json_format, 'wphDynamicsSettingsPageButtonsContainer', 'before');
					cs_notify_msg.error(wphdynamics_error_message_wrong_json_format);
					showAlertMessage(wphdynamics_error_message_wrong_json_format, '.webphone_dynamics_settings_changes_notice', 'error');
				}
			}
			catch (e) {
				console.error('Wrong JSON Format: ' + e);
				cs_notify_msg.error(wphdynamics_error_message_wrong_json_format);
				showAlertMessage(wphdynamics_error_message_wrong_json_format, '.webphone_dynamics_settings_changes_notice', 'error');
				//myAdminNotice('error', wphdynamics_error_message_wrong_json_format, 'wphDynamicsSettingsPageButtonsContainer', 'after');
			}
		});


		$('.webphone_dynamics_save_form').submit(function(e){

			//var submit_action=$('#cli_update_action').val();
			var submit_action = $(this).attr('id');

			if(submit_action=='delete_all_settings') {
				//return;
			}
			e.preventDefault();
			var data=$(this).serialize();

			var url=$(this).attr('action');
			var spinner=$(this).find('.spinner');
			//var submit_btn=$(this).find('input[type="submit"]');
			var submit_btn=$(this).find('.webphone_dynamics_submit_btn');
			spinner.css({'visibility':'visible'});
			submit_btn.css({'opacity':'.5','cursor':'default'}).prop('disabled',true);
			$.ajax({
				url:url,
				type:'POST',
				data:data+'&wphdynamics_admin_ajax_update='+submit_action,
				success:function(data) {
					spinner.css({'visibility':'hidden'});
					submit_btn.css({'opacity':'1','cursor':'pointer'}).prop('disabled',false);
					if(submit_action=='delete_all_settings') {
						cs_notify_msg.success(wphdynamics_success_message_update_data);
						setTimeout(function(){
							window.location.reload(true);
						},1000);
					} else {
						cs_notify_msg.success(wphdynamics_success_message_update_data);
						showAlertMessage(wphdynamics_success_message_update_data, '.webphone_dynamics_settings_changes_notice', 'success');
					}
				},
				error:function () {
					spinner.css({'visibility':'hidden'});
					submit_btn.css({'opacity':'1','cursor':'pointer'}).prop('disabled',false);
					if(submit_action=='delete_all_settings') {
						cs_notify_msg.error(wphdynamics_error_message_update_data);
					} else {
						cs_notify_msg.error(wphdynamics_error_message_update_data);
					}
				}
			});
		});

		$('#loadWebphoneScript').on('click', function(){
			var url = $('.webphone_dynamics_save_form').attr('action');
			var submit_action = 'load_webphone_script';
			var spinner = $('.spinner');
			var submit_btn = $(this);

			$.ajax({
				url:url,
				type:'POST',
				data:'wphdynamics_admin_ajax_update='+submit_action,
				success:function(data) {
					spinner.css({'visibility':'hidden'});
					submit_btn.css({'opacity':'1','cursor':'pointer'}).prop('disabled',false);
					if(submit_action=='delete_all_settings') {
						cs_notify_msg.success(wphdynamics_success_message_update_data);
						setTimeout(function(){
							window.location.reload(true);
						},1000);
					} else {
						cs_notify_msg.success(wphdynamics_success_message_update_data);
						showAlertMessage(wphdynamics_success_message_update_data, '.webphone_dynamics_settings_changes_notice', 'success');
					}
				},
				error:function () {
					spinner.css({'visibility':'hidden'});
					submit_btn.css({'opacity':'1','cursor':'pointer'}).prop('disabled',false);
					if(submit_action=='delete_all_settings') {
						cs_notify_msg.error(wphdynamics_error_message_update_data);
					} else {
						cs_notify_msg.error(wphdynamics_error_message_update_data);
					}
				}
			});

		});


	});

})( jQuery );

var cs_notify_msg=
{
	error:function(message)
	{
		var er_elm=jQuery('<div class="notify_msg" style="background:#dd4c27; border:solid 1px #dd431c;">'+message+'</div>');
		this.setNotify(er_elm);
	},
	success:function(message)
	{
		var suss_elm=jQuery('<div class="notify_msg" style="background:#1de026; border:solid 1px #2bcc1c;">'+message+'</div>');
		this.setNotify(suss_elm);
	},
	setNotify:function(elm)
	{
		jQuery('body').append(elm);
		elm.stop(true,true).animate({'opacity':1,'top':'50px'},1000);
		setTimeout(function(){
			elm.animate({'opacity':0,'top':'100px'},1000,function(){
				elm.remove();
			});
		},3000);
	}
};
/*
function cs_store_settings_btn_click(vl)
{
	document.getElementById('cs_update_action').value=vl;
}
*/

/**
 * Triggers an alert box message.
 *
 * @param message The message
 * @param elementBoxSelector The selector of the message box
 * @param type The type of message. This can be: alert, info, warning, error, success.
 */
function showAlertMessage(message, elementBoxSelector, type) {

	let typeMessage = (typeof type != 'undefined' && (type == 'info' || type == 'success' || type == 'warning' || type == 'error')) ? type : 'info';

	if (!(jQuery(elementBoxSelector + ' .notice-' + typeMessage).is(':visible') && jQuery(elementBoxSelector + ' .notice-' + typeMessage +' p').text() == message)) {
		hideAlertMessage(elementBoxSelector);
	}

	let noticeBoxContent = '<div class="notice notice-' + typeMessage + ' is-dismissible">' +
		'<p>' + message + '</p>' +
		'<button type="button" class="notice-dismiss" onclick="event.preventDefault(); hideAlertMessage(\''+elementBoxSelector+'\');"></button>' +
	'</div>';
	// Do the trick
	jQuery(elementBoxSelector)
		.html(noticeBoxContent)
		.slideDown();
}

/**
 * Hides an alert box message.
 * @param messageBox The selector of the message box
 */
function hideAlertMessage(messageBox) {
	jQuery(messageBox).slideUp();
}


/**
 * Create and show a dismissible admin notice
 */
function myAdminNotice( type, msg, referenceElementId, positionElementInsert) {

	/* create notice div */
	let div = document.createElement( 'div' );
	div.classList.add( 'notice', 'is-dismissible', 'notice-admin-custom', 'notice-'+type );

	/* create paragraph element to hold message */

	let p = document.createElement( 'p' );

	/* Add message text */

	p.appendChild( document.createTextNode( msg ) );

	// Optionally add a link here

	/* Add the whole message to notice div */

	div.appendChild( p );

	/* Create Dismiss icon */

	let b = document.createElement( 'button' );
	b.setAttribute( 'type', 'button' );
	b.classList.add( 'notice-dismiss' );

	/* Add screen reader text to Dismiss icon */

	let bSpan = document.createElement( 'span' );
	bSpan.classList.add( 'screen-reader-text' );
	bSpan.appendChild( document.createTextNode( 'Dismiss this notice' ) );
	b.appendChild( bSpan );

	/* Add Dismiss icon to notice */

	div.appendChild( b );

	/* Insert notice after the first h1 */
	/*let h1 = document.getElementsByTagName( 'h1' )[0];
	h1.parentNode.insertBefore( div, h1.nextSibling);*/

	/* Insert notice before or after referenceElementId  */
	let referenceElement = document.getElementById(referenceElementId);
	(positionElementInsert == 'before') ? referenceElement.parentNode.insertBefore( div, referenceElement) : referenceElement.parentNode.insertBefore( div, null)

	/* Make the notice dismissable when the Dismiss icon is clicked */
	b.addEventListener( 'click', function () {
			div.parentNode.removeChild( div );
	});
}

