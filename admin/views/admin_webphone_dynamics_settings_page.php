<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}
?>

<?php
$wt_wphdynamics_setting_parameters_field =  isset($stored_options['wph_setting_parameters_field']) ? $stored_options['wph_setting_parameters_field'] : '';
?>

<script type="text/javascript">
  let wphdynamics_success_message_update_data='<?php echo __('Settings saved successfully.', 'webphone-dynamics-plugin');?>';
  let wphdynamics_error_message_update_data='<?php echo __('Error saving settings.', 'webphone-dynamics-plugin');?>';
  let wphdynamics_error_message_wrong_json_format='<?php echo __('Wrong JSON format, please review it.', 'webphone-dynamics-plugin');?>';
  let wphdynamics_success_message_reset_default_remember_save='<?php echo __('Webphone configuration parameters will be reset to the default empty value. You can undo this action clicking on <em>Undo reset to Default</em>.<br>For changes to take effect, remember click in <strong>Save changes</strong> when you finish the edition.', 'webphone-dynamics-plugin');?>';

  let wphdynamics_default_config_parameters_json = {
    "webphone_config": {
      "load_script": false,
      "script_url": "",
      "script_load_location": "HEAD",
      "default_widget_id": "",
      "abandonment_inactivity": {
        "active": false,
        "widget_id": ""
      },
      "follow_button": {
        "active": false,
        "type": "",
        "widget_id": "",
        "texts": {
          "title": "",
          "bubble1": "",
          "bubble2": ""
        }
      },
      "traffic_active": false,
      "privacy_check_format": "SIMPLE_CHECK"
    },
  };
</script>


<div class="wrap webphone-dynamics-admin-plugin useJson">
  <div class="webphone-dynamics-form-container">
      <div class="wphdynamics-wphplugin-toolbar top">
        <h1><span class="img_icon_header"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>../img/wph-icon_dark_blue.svg"/></span> <?php echo __('Webphone Dynamics', 'webphone-dynamics-plugin'); ?></h1>
        <br>
        <p><?php echo __('Welcome to Webphone Dynamics!', 'webphone-dynamics-plugin'); ?></p>
        <p><?php echo __('This plugin is a complement for Webphone customers that will make it easier to use the tool on your Wordpress website.', 'webphone-dynamics-plugin'); ?></p>
        <p><?php echo __('If you are not a customer yet, you can <a href="https://dashboard.webphone.net/create-account/" target="_blank">create a new account</a>, know about <a href="https://www.webphone.net/en/#solutions" target="_blank">our solutions</a> or if you prefer, <a href="https://www.webphone.net/en/contact/" target="_blank">request a demo</a> to test the product.', 'webphone-dynamics-plugin'); ?></p>
        <p><?php echo __('If you need help or want more information', 'webphone-dynamics-plugin'); ?> &nbsp;&nbsp;<span class="button-primary btn-custom btn-ctc" onclick="openWebphoneFullscreen(3316, 3317);"><?php echo __('we will contact you right now', 'webphone-dynamics-plugin'); ?> <span class="dashicons-before dashicons-phone icon-button-admin icon-after icon-button-custom"></span> </span></p>
        <br>
        <h2><?php echo __('Webphone config', 'webphone-dynamics-plugin'); ?></h2>
      </div>
      <form method="post" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>" id="wphdynamics_sitesettings_form" class="webphone_dynamics_save_form">
        <?php
          // Set nonce:
          if (function_exists('wp_nonce_field')) {
            wp_nonce_field('webphone-update-settingssite');
          }
        ?>


        <label for="wph_setting_parameters_field" class="text-cursor"><?php echo __('Insert or update your <strong>Webphone</strong> config settings parameters in a well JSON format. For changes to take effect, remember click in <strong>Save changes</strong> when you finish the edition', 'webphone-dynamics-plugin');?></label>
          <textarea id="cs_settingParametersFormField" autocomplete="off" name="wph_setting_parameters_field" class="vvv_textbox setting_parameters_field" style="display: none;">
            <?php echo apply_filters('format_to_edit', stripslashes($wt_wphdynamics_setting_parameters_field)); ?>
          </textarea>

          <pre id="cs_jsonSettingParametersField" class="wphdynamics_json_container"></pre>

          <div class="webphone_dynamics_settings_changes_notice"></div>

          <div id="wphDynamicsSettingsPageButtonsContainer" class="wphdynamics-toolbar bottom">
            <div class="float-left">
              <div title="<?php _e('Reset parameters to default values', 'webphone-dynamics-plugin'); ?>" class="button-primary wphdynamics_reset_paremeters"><span class="dashicons-before dashicons-update-alt icon-button-admin icon-before"></span> <?php _e('Reset parameters', 'webphone-dynamics-plugin'); ?></div>
              <span class="horizontal-separator"></span>
              <div onclick="window.location.reload();" title="<?php _e('Undo reset setting parameters to default values', 'webphone-dynamics-plugin'); ?>" class="button-primary wphdynamics_undo_reset_paremeters"><span class="dashicons-before dashicons-undo icon-button-admin icon-before"></span> <?php _e('Undo reset parameters', 'webphone-dynamics-plugin'); ?></div>
            </div>

            <div class="float-right">
              <input type="hidden" name="wphdynamics_admin_ajax_update" value="1">
              <button id="wphDynamicsUpdateAdminSettingsForm" type="submit" name="wphdynamics_update_admin_settings_form" class="button-primary webphone_dynamics_submit_btn webphone_dynamics_update_json_field float-right" title="<?php _e('Warning!, this action can not be undone', 'webphone-dynamics-plugin'); ?>"><span class="dashicons-before dashicons-upload icon-button-admin icon-before"></span> <?php _e('Save changes', 'webphone-dynamics-plugin'); ?></button>
              <span class="spinner"></span>
              <?php /*<div id="loadWebphoneScript" class="button-primary load_webphone_script float-right"><span class="dashicons-before dashicons-upload icon-button-admin icon-before"></span> <?php _e('Load script', 'webphone-dynamics-plugin'); ?></div> */ ?>

            </div>
          </div>

          <div class="separator"></div>
          <div class="separator"></div>

          <label for="cs_jsonDefaultSettingParametersField" class="text-cursor"><?php echo __(' <strong>Default </strong>Webphone setting parameters in a well JSON format', 'webphone-dynamics-plugin');?></label>
          <pre id="cs_jsonDefaultSettingParametersField" name="cs_jsonDefaultSettingParametersField" class="wphdynamics_json_container wphdynamics_default_example_json_params"></pre>

          <div class="separator"></div>

          <div class="wphdynamics_json_default_fields_description">
            <p><strong><span class="dashicons dashicons-info icon-button-admin icon-before"></span></strong> <?php echo __('<strong>Default</strong> fields notes:', 'webphone-dynamics-plugin');?></p>
            <ul class="fields_description_list">
              <li><?php echo __('<strong>webphone_config</strong>:', 'webphone-dynamics-plugin');?>
                <ul>
                  <li><?php echo __('<strong><em>load_script</em></strong> *required. (boolean value): true is required to work', 'webphone-dynamics-plugin');?></li>
                  <li><?php echo __('<strong><em>script_url</em></strong> *required', 'webphone-dynamics-plugin');?></li>
                  <li><?php echo __('<strong><em>script_load_location</em></strong>. Webphone script load location in your website, allow values: HEAD | BODY. Default: HEAD', 'webphone-dynamics-plugin');?></li>
                  <li><?php echo __('<strong><em>default_widget_id</em></strong>: id widget will be used if others ids are not defined', 'webphone-dynamics-plugin');?></li>
                  <li><?php echo __('<strong><em>privacy_check_format</em></strong> allow values: NO_CHECK | SIMPLE_CHECK | DOUBLE_CHECK. Default: SIMPLE_CHECK', 'webphone-dynamics-plugin');?></li>
                </ul>
            </ul>
          </div>
      </form>
  </div>
</div>