<?php

/**
 * Load Webphone parametres config
 *
 * @link       https://webphone.net
 * @since      1.0.0
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/includes
 */

/**
 * Register data field Webphone configuration parameters
 *
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/includes
 * @author     Webphone <webphone@ipglobal.es>
 */
class WPHD_Webphone_Dynamics_Webphone {

  /**
   * The array of all settings Webphone
   *
	 * @since    1.0.0
	 * @access   protected
   * @var array|mixed|object
   */
  protected $webphone_setting_parameters = array();


  /**
   * The array of config Webphone
   *
   * @since    1.0.0
	 * @access   protected
   * @var array $webphone_config
   */
  protected $webphone_config = array();


	/**
	 * webphone_settings get_option
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

    if (get_option('webphone_settings')) {
      $webphone_settings_plugin = get_option('webphone_settings');

      if (isset($webphone_settings_plugin) && isset($webphone_settings_plugin['wph_setting_parameters_field'])) {

        if (is_string($webphone_settings_plugin['wph_setting_parameters_field']) && is_array(json_decode($webphone_settings_plugin['wph_setting_parameters_field'], true)) && (json_last_error() == JSON_ERROR_NONE)) {

          $webphone_settings_plugin_parameters_arr = json_decode($webphone_settings_plugin['wph_setting_parameters_field'], true);

          $this->webphone_setting_parameters = $webphone_settings_plugin_parameters_arr;
          if (isset($webphone_settings_plugin_parameters_arr['webphone_config']) && $webphone_settings_plugin_parameters_arr['webphone_config']) {
            $this->webphone_config = $webphone_settings_plugin_parameters_arr['webphone_config'];
            $this->translateFollowButtonTexts();
          }
        }
      }
    }
	}

	public function get_webphone_setting_parameters() {
	  return $this->webphone_setting_parameters;
	}


	public function get_webphone_config() {
	  return $this->webphone_config;
	}


	public function isLoadedScriptActive() {
	  if (!empty($this->webphone_config) && isset($this->webphone_config['load_script']) && $this->webphone_config['load_script'] == true) {
      return true;
	  }
	  return false;
	}


	public function getUrlScript() {
	  if (!empty($this->webphone_config) && isset($this->webphone_config['script_url'])) {
      return $this->webphone_config['script_url'];
	  }
	  return '';
	}

	public function getScriptLoadLocation() {
	  if (!empty($this->webphone_config) && isset($this->webphone_config['script_load_location'])) {
      return $this->webphone_config['script_load_location'];
	  }
	  return '';
	}

  /**
   * Translate texts of follow button
   */
  public function translateFollowButtonTexts() {
    if (!empty($this->webphone_config) && isset($this->webphone_config['follow_button']) && isset($this->webphone_config['follow_button']['texts'])) {
      if (isset($this->webphone_config['follow_button']['texts']['title']) && $this->webphone_config['follow_button']['texts']['title']) {
        $this->webphone_config['follow_button']['texts']['title'] == __($this->webphone_config['follow_button']['texts']['title'], 'webphone-dynamics-plugin');
      }
    }
  }


}
