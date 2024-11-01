<?php


/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webphone.net
 * @since      1.0.0
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/admin
 * @author     Webphone <webphone@ipglobal.es>
 */
class WPHD_Webphone_Dynamics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


  /**
	 * Webphone settings array.
	 *
	 * @since    1.0.0
	 * @access   private
   * @var array
   */
  private $webphoneSettingsArr = array(
    "default_widget_id" => "3315",
    "custom_widget_ids" => array(
      "generic_button" => "3315",
      "generic_form" => "3315",
      "full_popup_call_schedule" => "3316",
      "full_popup_out_schedule" => "3317"
    ),
    "abandonment_inactivity" => array(
      "active" => false,
      "widget_id" => ""
    ),
    "follow_button" => array(
      "active" => true,
      "type" => "",
      "widget_id" => "3315",
      "texts" => array(
        "title" => "Need help? <br>Call free right now!",
        "bubble1" => "Need help?",
        "bubble2" => "Call free right now!"
      )
    ),
    "traffic_active" => false,
    "privacy_check_format" => "SIMPLE_CHECK"
  );


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPHD_Webphone_Dynamics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPHD_Webphone_Dynamics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webphone-dynamics-admin.css', array(), $this->version, 'all' );
    //wp_enqueue_style('wph_admin_stylesheet', plugin_dir_url(__FILE__) . 'css/AdminWphstyles.css', array(), WPHD_WEBPHONE_DYNAMICS_VERSION, 'all');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPHD_Webphone_Dynamics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPHD_Webphone_Dynamics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webphone-dynamics-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'_query.json-editor', plugin_dir_url( __FILE__ ) . 'js/jquery.json-editor.min.js', array( 'jquery' ), $this->version, false );

    global $pagenow, $hook_suffix;
    if ($pagenow == 'admin.php' && stristr($hook_suffix, $this->plugin_name) !== false) {
      wp_enqueue_script( 'webphone-dinamics-script', 'https://llamamegratis.es/webphone-site/js/webphone.dinamics.js', array( 'jquery' ));
      add_action('admin_footer', array($this, 'load_webphone_config_parameters_js_in_plugin_admin_pages'));
    }
	}


  /**
	 * Load Json Webphone custom script configuration parameters on front page </body>
	 *
	 * @since    1.0.0
	 */
  public function load_webphone_config_parameters_js_in_plugin_admin_pages() {

    $this->webphoneSettingsArr['follow_button']['texts']['title'] = __('Need help? <br>Call free right now!', 'webphone-dynamics-plugin');
    $this->webphoneSettingsArr['follow_button']['texts']['bubble1'] = __('Need help?', 'webphone-dynamics-plugin');
    $this->webphoneSettingsArr['follow_button']['texts']['bubble2'] = __('Call free right now!', 'webphone-dynamics-plugin');

    echo '<script id="webphoneConfigPluginWP" type="text/javascript"> var $ = jQuery.noConflict(); var wphPluginWPCustomScriptParameters = '.json_encode($this->webphoneSettingsArr).'; </script>';
  }


  /**
   * Add menu separator
   * @param $position
   */
  protected function add_admin_menu_separator( $position ) {
    global $menu;
    $menu[ $position ] = array(
      0	=>	'',
      1	=>	'read',
      2	=>	'separator' . $position,
      3	=>	'',
      4	=>	'wp-menu-separator'
    );
  }

  /**
	 * Registers menu options
	 * Hooked into admin_menu
	 */
	public function admin_menu() {
		global $submenu;

    //add_action( 'admin_init', array($this, 'add_admin_menu_separator') );
    //$this->add_admin_menu_separator( 199 );
    add_menu_page(
      __('Webphone Dynamics', 'webphone-dynamics-plugin'),
      __('Webphone', 'webphone-dynamics-plugin'),
      'manage_options',
      'webphone-dynamics-plugin-settings',
      //'admin_webphone_dynamics_settings_page',
      array($this, 'admin_webphone_dynamics_settings_page'),
      //'dashicons-hammer',
      plugin_dir_url( __FILE__ ).'img/wph-icon_white.svg'
      //'200'
    );
    //$this->add_admin_menu_separator( 201 );

		add_submenu_page(
			'webphone-dynamics-plugin-settings',
			__('Webphone Dynamics', 'webphone-dynamics-plugin'),
			__('Webphone Dynamics', 'webphone-dynamics-plugin'),
			'manage_options',
			'webphone-dynamics-plugin-settings',
			array($this, 'admin_webphone_dynamics_settings_page')
		);

		add_submenu_page(
			'webphone-dynamics-plugin-settings',
			__('Webphone Button', 'webphone-dynamics-plugin'),
			__('Webphone Button', 'webphone-dynamics-plugin'),
			'manage_options',
			'webphone-dynamics-plugin-button',
			array($this, 'admin_webphone_dynamics_button_page')
		);

		//rearrange settings menu
		if(isset($submenu) && !empty($submenu) && is_array($submenu)) {
			$out=array();
			$back_up_settings_menu=array();
			if(isset($submenu['edit.php?post_type='.WPHD_POST_TYPE]) && is_array($submenu['edit.php?post_type='.WPHD_POST_TYPE])) {
				foreach ($submenu['edit.php?post_type='.WPHD_POST_TYPE] as $key => $value) {

					//if($value[2]=='webphone-dynamics-plugin') {
					if($value[2]=='webphone-dynamics-plugin-settings') {
						$back_up_settings_menu=$value;
					} else {
						$out[$key]=$value;
					}
				}
				array_unshift($out,$back_up_settings_menu);
				$submenu['edit.php?post_type='.WPHD_POST_TYPE]=$out;
			}
		}
	}

  /**
   * Webphone Dynamics Settings page
   */
  public function admin_webphone_dynamics_settings_page() {
    wp_enqueue_style($this->plugin_name);
    wp_enqueue_script($this->plugin_name);

    // Lock out non-admins:
		if (!current_user_can('manage_options'))  {
      wp_die(__('You do not have sufficient permission to perform this operation', 'webphone-dynamics-plugin'));
		}
		// Set options
		$options = array('wph_setting_parameters_field');
    // Get options:
    $stored_options = get_option('webphone_settings', array('wph_setting_parameters_field' => '',));

    // Check if form has been set (normal php submit OR ajax submit)
    if (isset($_POST['wphdynamics_update_admin_settings_form']) || isset($_POST['wphdynamics_admin_ajax_update'])) {

      if ($_POST['wphdynamics_admin_ajax_update'] == 'load_webphone_script') {

      }
      else {
        // Check nonce:
        check_admin_referer('webphone-update-settingssite');

        foreach ($options as $key) {
          if (isset($_POST[$key])) {
            // Store sanitised values only:
            $stored_options[$key] = wp_unslash($_POST[$key]);
          }
        }
        update_option('webphone_settings', $stored_options);

        echo '<div class="updated"><p><strong>';
        echo __('Settings Updated', 'webphone-dynamics-plugin');
        echo '</strong></p></div>';

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
          exit();
        }
      }
    }
    $stored_options = get_option('webphone_settings', array('wph_setting_parameters_field'=> '',));

    require_once plugin_dir_path( __FILE__ ).'views/admin_webphone_dynamics_settings_page.php';
	}


  /**
   * Webphone button follow button
   */
  function admin_webphone_dynamics_button_page() {
    //wp_enqueue_style($this->plugin_name);
    //wp_enqueue_script($this->plugin_name);

    // Lock out non-admins:
		if (!current_user_can('manage_options'))  {
      wp_die(__('You do not have sufficient permission to perform this operation', 'webphone-dynamics-plugin'));
		}

    wp_enqueue_style('wph_admin_stylesheet', plugin_dir_url(__FILE__) . 'css/AdminWphstyles.css', array(), WPHD_WEBPHONE_DYNAMICS_VERSION, 'all');
    global $wp_styles;
    $srcs = array_map('basename', (array)wp_list_pluck($wp_styles->registered, 'src'));
    if (!in_array('font-awesome.css', $srcs) || !in_array('font-awesome.min.css', $srcs)) {
      wp_enqueue_style('wph_admin_stylesheet_fontawesome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css', array(), WPHD_WEBPHONE_DYNAMICS_VERSION, 'all');
    }

    wp_enqueue_script('wph_admin_stylesheet_custom_js', plugin_dir_url(__FILE__) . 'js/functions.js', array(), WPHD_WEBPHONE_DYNAMICS_VERSION, false);

    require_once plugin_dir_path( __FILE__ ).'views/admin_webphone_dynamics_button_page.php';

    add_action('plugins_loaded', array($this, 'webphone_init_button'));

  }


  /**
   * Register widget
   */
  public function webphone_init_button() {
    wp_register_widget_control('webphone-button', 'Webphone', array($this, 'webphone_widget_menu'));
  }


  /**
   * Widget menu sidebar
   */
  public function webphone_widget_menu(){

    $followButtonWebphone = new WPHD_Webphone_Dynamics_Follow_Button();
    ?>
    <p><label>Title: <input name="gphone_title" type="text" value="<?php echo $followButtonWebphone->getGPhoneTitle(); ?>"/></label></p>
    <?php

    if (isset($_POST['gphone_title'])) {
      $data['gtitle'] = esc_attr($_POST['gphone_title']);
      update_option('gphone_title', $data);
    }
  }

}