<?php

/**
 * Webphone
 *
 * @package           Webphone_Dynamics
 * @author            Webphone <webphone@ipglobal.es>
 * @copyright         2024 Webphone - Ipglobal
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Webphone
 * Plugin URI:        https://wordpress.org/plugins/webphone/
 * Description:       Set Webphone setting parameters
 * Version:           2.1.8
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Webphone | Ipglobal
 * Author URI:        https://webphone.net/en
 * Text Domain:       webphone-dynamics-plugin
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Currently plugin version.
 */
define( 'WPHD_WEBPHONE_DYNAMICS_VERSION', '2.1.8' );


/**
 * Constant definitions
 */
define ( 'WPHD_PLUGIN_NAME', 'Webphone' );
define ( 'WPHD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define ( 'WPHD_POST_TYPE', 'webphonedynamicsplugin' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webphone-dynamics-activator.php
 */
function WPHD_activate_webphone_dynamics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webphone-dynamics-activator.php';
	WPHD_Webphone_Dynamics_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webphone-dynamics-deactivator.php
 */
function WPHD_deactivate_webphone_dynamics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webphone-dynamics-deactivator.php';
	WPHD_Webphone_Dynamics_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'WPHD_activate_webphone_dynamics' );
register_deactivation_hook( __FILE__, 'WPHD_deactivate_webphone_dynamics' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webphone-dynamics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function WPHD_run_webphone_dynamics() {

	$plugin = new WPHD_Webphone_Dynamics();
	$plugin->run();

  global $pagenow;
	if ($pagenow == 'admin.php' && stristr($_GET['page'], $plugin->get_plugin_name()) !== false) {
	  // Remove 'thank you for creating with wordpress' and wordpress version in admin footer plugin pages only
    add_action( 'admin_init', 'WPHD_edit_footer' );
    add_action( 'admin_init', 'WPHD_edit_version_footer' );
  }

}
WPHD_run_webphone_dynamics();

// Remove 'thank you for creating with wordpress' and wordpress version in admin footer plugin pages
function WPHD_edit_text($content) {
  return '';
}
function WPHD_edit_footer() {
  add_filter( 'admin_footer_text', 'wpse_edit_text', 10 );
}
function WPHD_edit_version_footer() {
  add_filter( 'update_footer', 'WPHD_edit_text', 10 );
}
