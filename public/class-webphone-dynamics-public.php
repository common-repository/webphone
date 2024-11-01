<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webphone.net
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Webphone_Dynamics
 * @subpackage Webphone_Dynamics/public
 * @author     Webphone <webphone@ipglobal.es>
 */
class WPHD_Webphone_Dynamics_Public {

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
	 * Webphone config parameters array
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
  private $config_webphone_params_arr = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webphone-dynamics-public.css', array(), $this->version, 'all' );

    $followButtonWebphone = new WPHD_Webphone_Dynamics_Follow_Button();
    if ($followButtonWebphone->getObjectIdWph() && is_numeric($followButtonWebphone->getObjectIdWph())) {
      wp_enqueue_style('wph_button_styles', plugin_dir_url(__FILE__) . 'css/wph-button-styles.css', array(), WPHD_WEBPHONE_DYNAMICS_VERSION, 'all');
    }

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webphone-dynamics-public.js', array( 'jquery' ), $this->version, false );

    $configWebphone = new WPHD_Webphone_Dynamics_Webphone();
    if ($configWebphone->isLoadedScriptActive() && $configWebphone->getUrlScript()) {
      $loadScriptInFooter = ($configWebphone->getScriptLoadLocation() == 'BODY') ? true : false;
      wp_enqueue_script('wph_js_webphone', $configWebphone->getUrlScript(), array(), false, $loadScriptInFooter );

      $this->config_webphone_arr = $configWebphone->get_webphone_config();
      add_action('wp_footer', array($this, 'load_webphone_config_parameters_js'));
    }

    $followButtonWebphone = new WPHD_Webphone_Dynamics_Follow_Button();
    if ($followButtonWebphone->getObjectIdWph() && is_numeric($followButtonWebphone->getObjectIdWph())) {
      wp_enqueue_script('webphone_script', 'https://app.webphone.net/script/script.js', array(), false, false);
      add_action('the_content', array($this, 'webphone_add_object'));
    }

  }

	/**
	 * Load Json Webphone custom script configuration parameters on front page </body>
	 * @since    1.0.0
	 */
  public function load_webphone_config_parameters_js() {
    echo '<script id="webphoneConfigPluginWP" type="text/javascript"> var wphPluginWPCustomScriptParameters = '.json_encode($this->config_webphone_arr).'; </script>';
  }


  /**
   * Add Webphone object to follow button
   * @since    1.0.0
   */
  public function webphone_add_object() {
    $followButtonWebphone = new WPHD_Webphone_Dynamics_Follow_Button();
    echo '<div id="div-' . $followButtonWebphone->getObjectPosWph() . '"><object id="' . $followButtonWebphone->getObjectIdWph() . '" type="button/webphone" classid="webphone" style="display: none;"></object></div>';
  }

}
