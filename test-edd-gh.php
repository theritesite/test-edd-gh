<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.theritesites.com
 * @since             1.0.0
 * @package           Test_EDD_GH
 *
 * @wordpress-plugin
 * Plugin Name:       Test EDD Github Updater
 * Plugin URI:        https://www.theritesites.com/plugins/test-edd-gh
 * Description:       This plugin does awesome things!
 * Version:           1.0.12.1
 * Author:            TheRiteSites
 * Author URI:        https://www.theritesites.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       test-edd-gh
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'TEST_EDD_GH_VERSION', '1.0.12.1' );

define( 'TEST_EDD_GH_UPDATER_URL', 'https://test-theritesites.pantheonsite.io' );

define( 'TEST_EDD_GH_ITEM_ID', 1562 );

define( 'TEST_EDD_GH_LICENSE_PAGE', 'the_rite_plugins_settings' );

define( 'TEST_EDD_GH_ITEM_NAME', 'Test EDD Github Updater' );

define( 'TEST_EDD_GH_LICENSE_KEY', 'test_edd_gh_license_key' );

define( 'TEST_EDD_GH_LICENSE_STATUS', 'test_edd_gh_license_status' );

if ( file_exists( __DIR__ . '/cmb2/init.php' ) ) {
	require_once __DIR__ . '/cmb2/init.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-test-edd-gh-activator.php
 */
function activate_test_edd_gh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-test-edd-gh-activator.php';
	Test_EDD_GH_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-test-edd-gh-deactivator.php
 */
function deactivate_test_edd_gh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-test-edd-gh-deactivator.php';
	Test_EDD_GH_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_test_edd_gh' );
register_deactivation_hook( __FILE__, 'deactivate_test_edd_gh' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-test-edd-gh.php';


/**
 * Inits updater class to talk to https://www.theritesites.com for updates
 * 
 * @since 1.0.0
 */
function trs_test_edd_gh_update_check() {

	if( !class_exists( 'Test_EDD_GH_Settings' ) ) {
		// load our custom updater
		include( plugin_dir_path( __FILE__ ) . '/includes/class-test-edd-gh-settings.php' );
	}

	if( !class_exists( 'Test_EDD_GH_Plugin_Updater' ) ) {
		// load our custom updater
		include( plugin_dir_path( __FILE__ ) . '/includes/class-test-edd-gh-plugin-updater.php' );
	}

	if( class_exists( 'Test_EDD_GH_Settings' ) ) {
		$license_key = Test_EDD_GH_Settings::get_value(TEST_EDD_GH_LICENSE_KEY);
	}
	
	else {
		$opts = trim(get_option('the_rite_plugins_settings', false));

		$key = TEST_EDD_GH_LICENSE_KEY;
		if ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$license_key = $opts[ $key ];
		}
	}
	
	if( !class_exists( 'Test_EDD_GH_Plugin_Updater' ) ) {
		return;
	}

	$plugin_updater = new Test_EDD_GH_Plugin_Updater( TEST_EDD_GH_UPDATER_URL, __FILE__, array(
						'version'	=> TEST_EDD_GH_VERSION,
						'license'	=> $license_key,
						'item_id'	=> TEST_EDD_GH_ITEM_ID,
						'author'	=> 'TheRiteSites',
						'url'		=> home_url()
			)
	);

}
add_action( 'plugins_loaded', 'trs_test_edd_gh_update_check');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_test_edd_gh() {

	$plugin = new Test_EDD_GH();
	$plugin->run();

}
run_test_edd_gh();
