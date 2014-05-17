<?php
/**
 * This file contains any and all output for the admin settings page for this
 * plugin.
 */

if ( !class_exists( 'ABD_Admin_Views' ) ) {
	class ABD_Admin_Views {
		/**
		 * This function outputs all content for the main plugin page in the 
		 * correct order.
		 */
		public static function output_main() {
			self::header();
			self::body();
			self::sidebar();
			self::footer();
		}
		
		protected static function header() {
			?>
			<div class='wrap'>
				<?php screen_icon(); ?>
				<h2>Ad Blocking Detector</h2>
				
				<div id='ABD_content'>
					<div id='ABD_notification'></div>
			<?php
		}

		protected static function footer() {
			?>
				</div><!-- end <div id='ABD_content'> -->
				<?php
				self::sidebar();
				self::footer_content();
				?>
			</div><!-- end <div class='wrap'> -->
			<?php
		}
			protected static function footer_content() {
				?>
				<div id='ABD_footer'>
					Developed By: 
					<a target="_blank" href="http://jtmorris.net">John Morris</a>
				</div>
				<?php
			}
		protected static function sidebar() {
			?>
			<div id='ABD_sidebar'>
				<div class='ABD_sidebar_box ABD_highlight'>
					<h3>Support This Plugin</h3>
					<p>
						Is this plugin useful for you?  If so, please help
						support its ongoing development and improvement 
						with a donation.
					</p>
					<table id='ABD_donations'>							
						<tr>
							<!--Flattr-->
							<td>
								<script id='fbpydtc'>(function(i){var f,s=document.getElementById(i);f=document.createElement('iframe');f.src='//api.flattr.com/button/view/?uid=jtmorris&url='+encodeURIComponent(document.URL);f.title='Flattr';f.height=62;f.width=55;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})('fbpydtc');</script>
							</td>
							<!--PayPal-->
							<td>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
									<input type="hidden" name="cmd" value="_s-xclick">
									<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
									<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
							</td>
						</tr>
					</table>

					<br />

					<p>
						Or, if you are short on funds, there are other ways you can help out:
					</p>
					<ul>
						<li>Leave us a positive review on the plugin's <a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/ad-blocking-detector">WordPress listing</a></li>
						<li>Vote "Works" on the plugin's <a target="_blank" href="http://wordpress.org/plugins/ad-blocking-detector/#compatibility">WordPress listing</a></li>
						<li><a target="_blank" href="http://twitter.com/home?status=I%20love%20this%20WordPress%20plugin!%20http://wordpress.org/plugins/ad-blocking-detector/">Share your thoughts on Twitter</a> and other social sites</li>
						<li>Improve this plugin on <a target="_blank" href='https://github.com/jtmorris/adblock-detector'>GitHub</a></li>
					</ul>						
				</div>

				<div class='ABD_sidebar_box'>
					<h3>Example, Tips, &amp; Ideas</h3>
					<p>
						If you're having trouble figuring out this 
						plugin, or want to see some cool ways to use it, check
						out these links:
					</p>
					<ul>
						<li>
							<a target="_blank" href="http://adblockingdetector.jtmorris.net/using-ad-blocking-detector/">How To Use Ad Blocking Detector</a>: A basic, step-by-step tutorial, of how to use this plugin.  Includes screenshots.
						</li>
						<li>
							<a target="_blank" href="http://adblockingdetector.jtmorris.net/display-rotating-ads/">Display Rotating Ads</a>: Explains how to combine the power of an ad rotation plugin with Ad Blocking Detector.
						</li>
						<li>
							Combine The Power of This Plugin With Others <em>(coming soon)</em>
						</li>
					</ul>
				</div>

				<div class='ABD_sidebar_box'>
					<h3>Get Help / Report a Bug</h3>
					<p>
						If you're encountering a problem, have a question, or would like to suggest an improvement, be sure to let me know!
					</p>						
					<p> 
						You can start a thread on this plugin's <a target="_blank" href='http://wordpress.org/support/plugin/ad-blocking-detector'>WordPress support page</a>, open an "issue"
						in the <a target="_blank" href='https://github.com/jtmorris/adblock-detector/issues'>GitHub</a> repository, or <a target="_blank" href='http://jtmorris.net/contact-me/'>contact the 
						developer directly</a>.
					</p>
					<ul>
						<li>Open a thread on the <a target="_blank" href="http://wordpress.org/support/plugin/ad-blocking-detector">plugin support page</a>.</li>
						<li><a target="_blank" href="http://adblockingdetector.jtmorris.net/contact/">Contact the developer</a> privately.</li>
						<li>Open an <a target="_blank" href="https://github.com/jtmorris/adblock-detector/issues">"issue" on GitHub</a>.</li>
					</ul>
				</div>
			</div>
			<?php
		}
		protected static function body() {
			?>
			<div class='ABD_logical_block'>
				<h3>Your Ad Block Detector Shortcodes</h3>
				<a class='ABD_button ABD_new_button ABD_alternate_color'>New Shortcode</a>
				<br /><br />
				<table id='ABD_shortcode_list' class='ABD_shortcode_list'>
					<tr>
						<th>Name</th>
						<th>Shortcode</th>
						<th>Actions</th>
					</tr>
					<tr>
						<td id='ABD_shortcode_list_message' colspan='3'>Initializing...</td>
					</tr>						
				</table>
			</div>					


			<div id='ABD_new_input_form_wrapper' class='ABD_logical_block ABD_input_form_wrapper'>
				<h3 id='ABD_input_form_header'>Add a New Shortcode</h3>
				<form id='ABD_new_input_form' method='post'>
					<table class='ABD_form_layout'>
						<tr>
							<td><label for='ABD_new_input_form_name'>Name / Description:</label></td>
							<td><input type='text' name='ABD_new_input_form_name' id='ABD_new_input_form_name' /></td>
							<td><span id='ABD_new_input_form_name_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
						<tr>
							<td><label for='ABD_new_input_form_noadblock'>No Ad Blocker <em>(optional)</em></label></td>
							<td><textarea name='ABD_new_input_form_noadblock' id='ABD_new_input_form_noadblock'></textarea></td>
							<td><span id='ABD_new_input_form_noadblock_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
						<tr>
							<td><label for='ABD_new_input_form_adblock'>Ad Blocker</label></td>
							<td><textarea name='ABD_new_input_form_adblock' id='ABD_new_input_form_adblock'></textarea></td>
							<td><span id='ABD_new_input_form_adblock_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
					</table>

					<?php wp_nonce_field( 'ABD_new_input_form' ); ?>

					<a id='ABD_new_input_form_submit' class='ABD_button ABD_submit_button'>Save Shortcode</a>
				</form>
			</div>

			<div id='ABD_edit_input_form_wrapper' class='ABD_logical_block ABD_input_form_wrapper'>
				<h3 id='ABD_input_form_header'>Edit a Shortcode</h3>
				<form id='ABD_edit_input_form' method='post'>
					<table class='ABD_form_layout'>
						<tr>
							<td><label for='ABD_edit_input_form_name'>Name / Description:</label></td>
							<td><input type='text' name='ABD_edit_input_form_name' id='ABD_edit_input_form_name' /></td>
							<td><span id='ABD_edit_input_form_name_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
						<tr>
							<td><label for='ABD_edit_input_form_noadblock'>No Ad Blocker <em>(optional)</em></label></td>
							<td><textarea name='ABD_edit_input_form_noadblock' id='ABD_edit_input_form_noadblock'></textarea></td>
							<td><span id='ABD_edit_input_form_noadblock_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
						<tr>
							<td><label for='ABD_edit_input_form_adblock'>Ad Blocker</label></td>
							<td><textarea name='ABD_edit_input_form_adblock' id='ABD_edit_input_form_adblock'></textarea></td>
							<td><span id='ABD_edit_input_form_adblock_feedback' class='ABD_input_form_feedback'></span></td>
						</tr>
					</table>

					<input type='hidden' name='ABD_edit_input_form_id' id='ABD_edit_input_form_id' value='-1' />
					
					<?php wp_nonce_field( 'ABD_edit_input_form' ); ?>

					<a id='ABD_edit_input_form_submit' class='ABD_button ABD_submit_button'>Save Shortcode</a>
				</form>
			</div>
			<?php
		}

		protected static function body_js() {
			?>
			<script type='text/javascript'>
				(function($) {
					var settings = {
						logLevel: 2,	//	0 = no logging, 1 = log important only, 2 = log everything
					}

					
					/********************************
					**** Make Access Easier *********
					********************************/
					 // Create some variables pointing to the jQuery selectors
					 // that are accessible in every scope beneath this point.
					 
					//	Get all the form fields
					var newForm = $('#ABD_new_input_form');
					var newFormWrapper = $('#ABD_new_input_form_wrapper');
					var newNameField = $('#ABD_new_input_form_name');
					var newAdblockField = $('#ABD_new_input_form_adblock');
					var newNoAdblockField = $('#ABD_new_input_form_noadblock');
					var editForm = $('#ABD_edit_input_form');
					var editFormWrapper = $('#ABD_edit_input_form_wrapper');
					var editNameField = $('#ABD_edit_input_form_name');
					var editAdblockField = $('#ABD_edit_input_form_adblock');
					var editNoAdblockField = $('#ABD_edit_input_form_noadblock');
					var editIdField = $('#ABD_edit_input_form_id');

					//	Get Feedback Fields
					var globalFeedback = $('#ABD_notification');
					var newNameFeedback = $('#ABD_new_input_form_name_feedback');
					var newAdblockFeedback = $('#ABD_new_input_form_adblock_feedback');
					var newNoAdblockFeedback = $('#ABD_new_input_form_noadblock_feedback');
					var editNameFeedback = $('#ABD_edit_input_form_name_feedback');
					var editAdblockFeedback = $('#ABD_edit_input_form_adblock_feedback');
					var editNoAdblockFeedback = $('#ABD_edit_input_form_noadblock_feedback');
					

					//	Get Buttons
					var newSubmitButton = $('#ABD_new_input_form_submit');
					var editSubmitButton = $('#ABD_edit_input_form_submit');
					var createNewButton = $('.ABD_new_button');

					//	Get Display Table
					var shortcodeTable = $('#ABD_shortcode_list');
					var shortcodeTableMsg = $('#ABD_shortcode_list_message');

					/**********************************************
					***********************************************
					***********************************************/


					/**************************************
					*** Shortcode Table Manip Functions ***
					**************************************/

					/**
					 * Delete a row from the shortcode table.
					 * @param  {int} id The ID of the shortcode whose row we 
					 * are to remove.
					 */
					function deleteRow(id) {
						log("Request to delete a row from the shortcode table.");

						var cSel = 'tr[data-id="' + id + '"]';
						var row = shortcodeTable.find(cSel);

						if (row) {
							row.hide(1000, function() {
								$(this).remove();
								log("Row deletion complete.");
							});
						}
					}

					/**
					 * Add a row to the shortcode table.
					 * @param {int} id The ID of the shortcode we are adding a
					 * row for.
					 * @param {string} name The name/description of the 
					 * shortcode we are adding a row for.
					 */
					function addRow(id, name) {
						var row = $("<tr class='ABD_shortcode' data-id='" + id + "'><td>" + name + "</td><td>[adblockdetector id=\"" + id + "\"]</td><td><a id='ABD_edit_button_" + id + "' class='ABD_button ABD_edit_button' data-id='" + id + "'>Edit</a> &nbsp; | &nbsp; <a id='ABD_delete_button_" + id + "' class='ABD_button ABD_delete_button' data-id='" + id + "'>Delete</a></td></tr>");
						
						shortcodeTable.append(row);

						//	Setup click listeners for new row.
						$('#ABD_edit_button_' + id).click({id: id}, clickEditButton);
						$('#ABD_delete_button_' + id).click({id: id}, clickDeleteButton);

						row.hide().show(1000);	
					}

					/**
					 * Clear all rows from the shortcode table.
					 */
					function clearTable() {
						shortcodeTable.find('tr.ABD_shortcode').each(function() {
							$(this).hide(1000, function() {
								$(this).remove();
							});
						});
					}


					/**
					 * Clears shortcode table and reloads all shortcodes from 
					 * the database using AJAX.
					 * @param  {boolean} initial Whether this is the initial
					 * table population (first load), or a reload. True = first,
					 * False = reload
					 */
					function populateTable(initial) {
						log("Request to populate the shortcode table with all existing shortcodes.");

						if (!initial) {
							clearTable();			
							shortcodeTableMsg.text('Reloading shortcodes... please wait...');
						}

						$.post(ajaxurl, {action: 'abd_ajax', abd_action: 'get_all_shortcodes'}, function(response) {
							var data = $.parseJSON(response);

							log("Retrieve all shortcodes AJAX completed.  Result: " + var_dump(data));

							if (typeof(data) == 'object') {	//	then loop through array and output rows in table
								$.each(data, function(index, value) {
									shortcodeTableMsg.hide();
									addShortcodeListRow(value.id, value.name);						
								});
							}
							else {	//	Something went wrong... no shortcodes or error
								shortcodeTableMsg.text("No shortcodes found!");
							}
						});
					}

					/**********************************************
					***********************************************
					***********************************************/
					

					/*******************************
					*** Click Listener Handlers ***
					*******************************/

					/**
					 * Setup click listeners on global buttons (form submit and
					 * new buttons)
					 */
					function initialClickListeners() {
						newSubmitButton.click({form: 'new'}, clickSubmitButton);
						editSubmitButton.click({form: 'edit'}, clickSubmitButton);

						createNewButton.click(clickCreateNew);
					}
					
					/**
					 * Handler for "New Shortcode" buttons.
					 * @param  {object} event Standard event object passed by
					 * click listener.
					 */
					function clickCreateNew (event) {
						log("Create new shortcode button click event caught. Event handler function fired.");

						event.preventDefault();

						//	Clear any old form values from new shortcode form
						resetForm(newForm);

						//	If the form is hidden, show it
						newFormWrapper.show(1000);

						//	Scroll the page to the new form
						scrollTo(newFormWrapper);
					}

					/**
					 * Handler for "Edit Shortcode" buttons.
					 * @param  {object} event Standard event object passed by
					 * click listener. Must also include a data object with the
					 * ID of the shortcode: ___.click({id: ID#}, clickEditButton);
					 */
					function clickEditButton (event) {
						event.preventDefault();

						var passedData = event.data;
						var retrievedData;

						log("Edit existing shortcode button clicked (ID# = " + 
							passedData.id + "). Event handler function fired.");

						displayNotification('notice', 'Loading...');
						$.post(
							ajaxurl, 
							{
								action: 'abd_ajax', 
								abd_action: 'get_shortcode_by_id', 
								id: passedData.id
							}, 
							function(response) {
								retrievedData = $.parseJSON(response);

								log("Edit button AJAX request completed.  Result: " + 
									var_dump(retrievedData));


								//	Fill in the fields in the edit form with the 
								//	retrieved data
								editNameField.val(retrievedData.name);
								editAdblockField.val(retrievedData.adblock);
								editNoAdblockField.val(retrievedData.noadblock);
								editIdField.val(passedData.id);

								//	Clear any old feedback messages
								clearFeedbackMessages();

								//	If any of the fields are empty, display a 
								//	notice so that we don't look like we didn't 
								//	do anything.
								if ($.trim(retrievedData.name) == '') {
									editNameFeedback.text(
										'No stored value for this field!');
								}

								if ($.trim(retrievedData.adblock) == '') {
									editAdblockFeedback.text(
										'No stored value for this field!');
								}

								if ($.trim(retrievedData.noadblock) == '') {
									editNoAdblockFeedback.text(
										'No stored value for this field!');
								}


								hideNotification(function() {
									scrollTo(editFormWrapper);
								});

								editFormWrapper.show(1000);

								//	If a "Add Shortcode" section is open, clear 
								//	the form and close it.
								resetForm(newForm);
								newFormWrapper.hide();
							}	//	end function(response) {
						);	//	end $.post(
					}	//	end function clickEditButton (...

					/**
					 * Handler for "Delete Shortcode" buttons.
					 * @param  {object} event Standard event object passed by
					 * click listener. Must also include a data object with the
					 * ID of the shortcode: ___.click({id: ID#}, clickEditButton);
					 */
					function clickDeleteButton (event) {
						event.preventDefault();

						var passedData = event.data;

						log("Delete existing shortcode button clicked (ID# = " + 
							passedData.id + "). Event handler function fired.");

						displayNotification('notice', 'Deleting shortcode...');
						$.post(
							ajaxurl, 
							{
								action: 'abd_ajax', 
								abd_action: 'delete_shortcode_by_id', 
								id: passedData.id
							}, 
							function(response) {
								retrievedData = $.parseJSON(response);

								log("Delete button AJAX request completed.  Result: " + 
								var_dump(retrievedData), true);	//	true = important


								if (retrievedData.status == false) {
									displayNotification( 
										'error', 
										'Uh oh. Something went wrong. Try deleting the item again or refreshing the page.',
										'<strong>Failed Action:</strong> ' + 
											retrievedData.action + 
											'<br /><strong>Failure Reason:</strong> ' + 
											retrievedData.reason + 
											'<br /><strong>Contextual Data:</strong> ' + 
											retrievedData.data
									);
									scrollTo(globalFeedback);
								}
								else {
									displayNotification('success', 
										'Shortcode deleted!');
									setTimeout(function() {
										hideNotification();
									}, 3000);

									//	Remove applicable row from table
									deleteRow(passedData.id);
								}
							}	//	end function(response) {
						);	//	end $.post(...
					}	//	end function clickDeleteButton (...


					/**
					 * Handler for "Submit Shortcode" buttons.
					 * @param  {object} event Standard event object passed by
					 * click listener. Must also include a data object with the
					 * type of form (new or edit): ___.click({form: 'new/edit'}, clickEditButton);
					 */
					function clickSubmitButton (event) {
						event.preventDefault();

						var passedData = event.data;

						//	This function handles the submit button for both the new and edit forms
						//	To allow this abstraction, we must decide which form to pull the field
						//	data from.  Fortunately, this information should have been passed by the
						//	click handler.
						if (passedData.form == 'new') {
							log("Submit button clicked on new shortcode form.  Event handler fired.");

							//	Let's abstract this a little and get the fields
							//	and feedback fields as a more generic name.
							//	Otherwise we'll have to keep checking whether
							//	we're in the edit form or the new form.
							var theForm = newForm;
							var theFormName = newNameField;
							var theFormNoAdblock = newNoAdblockField;
							var theFormAdblock = newAdblockField;
							var theFormNameFeedback = newNameFeedback;
							var theFormNoAdblockFeedback = newNoAdblockFeedback;
							var theFormAdblockFeedback = newAdblockFeedback;

							var id = null;

							var abd_action = 'submit_new_shortcode';
						}
						else if (passedData.form == 'edit') {
							log("Submit button clicked on edit shortcode form.  Event handler fired.");

							//	Let's abstract this a little and get the fields
							//	and feedback fields as a more generic name.
							//	Otherwise we'll have to keep checking whether
							//	we're in the edit form or the new form.
							var theForm = editForm;
							var theFormName = editNameField;
							var theFormNoAdblock = editNoAdblockField;
							var theFormAdblock = editAdblockField;
							var theFormNameFeedback = editNameFeedback;
							var theFormNoAdblockFeedback = editNoAdblockFeedback;
							var theFormAdblockFeedback = editAdblockFeedback;
							
							var id = editIdField.val();

							var abd_action = 'submit_edit_shortcode_by_id';
						}
						else {
							log("Submit button click handler called without necessary data. Please provide an event data object with a 'form' value of 'new' or 'edit'.", true);
							return;
						}


						//	Now let's do some basic validation.
						//	First, let's make sure we remove any old validation messages.			
						clearFeedbackMessages();

						//	Now run the validation
						var e = false;	//	a flag to indicate whether something didn't validate
						
						//	The name field is required, make sure it isn't empty.
						if ($.trim(theFormName.val()).length < 1) {
							theFormNameFeedback.text('You must provide a name!');
							theFormName.addClass('ABD_input_form_highlight');
							e = true;
						}
						//	Now let's put some max length limits on the name.
						if (theFormName.val().length > 40) {
							theFormNameFeedback.text('This name is too long! It must be 40 characters or less.');				
							theFormName.addClass('ABD_input_form_highlight');
							e = true;
						}

						//	Now, if something did not validate, log it, throw a notification, and quit.
						if (e) {
							log("Errors detected in submission.");
							displayNotification(
								'error',
								'Uh oh! I found some problems with your submission. Please resolve the errors and try again.'
							);
							return;
						}

						//	If we're here, then the fields are okay to submit.
						//	Okay, we have our form fields and context, now 
						//	encode the form values for sending to AJAX handler
						encodedData = theForm.serialize();


						//	Notify everyone
						log("Submitting the following data via AJAX: " + encodedData);
						displayNotification('notice', 'Saving shortcode...', function() {
							scrollTo('top');
						});

						//	Submit that bad boy!
						$.post(
							ajaxurl, 
							{
								action: 'abd_ajax', 
								abd_action: abd_action, 
								id: id, 
								data: encodedData
							}, 
							function(response) {
								retrievedData = $.parseJSON(response);

								log("Submit button AJAX request completed.  Result: " + 
									var_dump(retrievedData));

								if ( retrievedData.status === false ) {
									//	The operation failed.  Throw up a notification.
									displayNotification( 
										'error', 
										'Uh oh. Something went wrong. Try submitting again or refreshing the page.',
										'<strong>Failed Action:</strong> ' + 
											retrievedData.action + 
											'<br /><strong>Failure Reason:</strong> ' + 
											retrievedData.reason + 
											'<br /><strong>Contextual Data:</strong> ' + 
											retrievedData.data
									);
									scrollTo(globalFeedback);
								}
								else {
									//	Refresh the table
									populateTable();

									//	Clear and hide forms
									resetForm(newForm);
									resetForm(editForm);
									newFormWrapper.hide(1000);
									editFormWrapper.hide(1000);

									//	Hide tips too
									tips.hide(1000);

									//	Scroll back to the table
									scrollTo('top');
									displayNotification(
										'success', 
										'Shortcode saved successfully!', 
										function() {
											setTimeout(function() {
												hideNotification();
											}, 
											5000
										);				
									});
								}		
							}	//	end function(response) {
						);	//	end $.post(...		
					}	//	end function clickSubmitButton(...


					/**********************************************
					***********************************************
					***********************************************/
					

					/****************************************
					*** Feedback & Notification Functions ***
					****************************************/
					
					/**
					 * Show a notification message
					 * @param  {string} type         'error', 'warning', 
					 * 'success' all style the box appropriately, otherwise it 
					 * gets a generic notice style
					 * @param  {string} msg          HTML or text to display in the box.
					 * @param  {string} data         Optional additional data to display.
					 * @param  {function} runAfterShow A function to execute 
					 * once notice is displayed.
					 */
					function displayNotification(type, msg, data, runAfterShow) {
						//	Remove any old remnants
						globalFeedback.removeClass('ABD_notification_error ABD_notification_warning ABD_notification_success ABD_notification_notice');				
						globalFeedback.html('');

						//	Style the notification box based on new type
						if (type == 'error') {
							globalFeedback.addClass('ABD_notification_error');
						}
						else if (type =='warning') {
							globalFeedback.addClass('ABD_notification_warning');
						}
						else if (type == 'success') {
							globalFeedback.addClass('ABD_notification_success');
						}
						else {
							globalFeedback.addClass('ABD_notification_notice');
						}

						//	Create HTML to input into display
						var html = '<span class="ABD_notification_message">' + msg + '</span>';
						if ( typeof(data) == 'string' ) {
							html += '<span class="ABD_notification_supplemental">' + data + '</span>';
						}

						//	Put the message in the box and show the box
						globalFeedback.html(html);
						globalFeedback.show(1000, function() {
							if (typeof(runAfterShow) == 'function') {
								runAfterShow();
							}
						});
					}

					/**
					 * Hide the notification box and remove its contents.
					 * @param  {[type]} runAfterHide A function to execute once
					 * notification is hidden.
					 */
					function hideNotification(runAfterHide) {
						globalFeedback.hide(1000, function() {
							//	Remove the contents
							globalFeedback.removeClass('ABD_notification_error ABD_notification_warning ABD_notification_success ABD_notification_notice');
							globalFeedback.html('');

							//	Run the function.
							if (typeof(runAfterHide) == 'function') {
								runAfterHide();
							}
						});
					}

					/**
					 * Remove all feedback from new and edit forms.
					 */
					function clearFeedbackMessages() {
						newNameField.removeClass('ABD_input_form_highlight');
						newAdblockField.removeClass('ABD_input_form_highlight');
						newNoAdblockField.removeClass('ABD_input_form_highlight');
						editNameField.removeClass('ABD_input_form_highlight');
						editAdblockField.removeClass('ABD_input_form_highlight');
						editNoAdblockField.removeClass('ABD_input_form_highlight');

						newNameFeedback.text('');
						newAdblockFeedback.text('');
						newNoAdblockFeedback.text('');
						editNameFeedback.text('');
						editAdblockFeedback.text('');
						editNoAdblockFeedback.text('');
					}



					/**********************************************
					***********************************************
					***********************************************/
					

					/******************************
					****** HELPER FUNCTIONS *******
					******************************/

					/**
					 * Writes log message to console.
					 * @param  {string} msg       The message to write to 
					 * console.
					 * @param  {boolean} important Whether to ignore log 
					 * level setting and log anyway.
					 */
					function log(msg, important) {
						//	Is this important?  Are we logging everything?
						if (important !== true && settings.logLevel < 2) {
							return;
						}
						else if (settings.logLevel == 0) {
							return;
						}

						//	Okay, since we are here, we do want to log this message
						//	Let's format it a little, then write it to the console.
						console.log("Ad Blocking Detector Log Message:   " + 
							msg);
					}

					/**
					 * Scrolls the user's browser window to a specific location.
					 * @param  {int | string} "top" scrolls to the top of page.
					 * Otherwise, specify a number to be offset from top.
					 */
					function scrollTo(x) {
						if (x == 'top') {
							$('html, body').animate({
								scrollTop: 0
							}, 1000);

							return;
						}

						$('html, body').animate({
							scrollTop: x.offset().top - 75
						}, 1000);
					}

					/**
					 * Rough equivalent to PHP function print_r().
					 * @param  {} varToDump The variable you wish to dump.
					 * @return {string} A string representation of varToDump's
					 * contents.
					 */
					function var_dump(varToDump) {
						return JSON.stringify(varToDump);
					}

					/**
					 * Clears all input values from a form's fields.
					 * @param  {jQuery object} form The form selected as a 
					 * jQuery object.
					 */
					function resetForm(form) {
						form.find('input:text, input:password, input:file, select, textarea').val('');
		    			form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
					}

					/**********************************************
					***********************************************
					***********************************************/
					

					/********************************
					***** Initialize Everything *****
					********************************/
					populateTable(true);
					initialClickListeners();

					newFormWrapper.hide();
					editFormWrapper.hide();
					globalFeedback.hide();					

				}(jQuery))
			</script>
			<?php
		}

	}	//	end class
}	//	end if ( !class_exists( ...