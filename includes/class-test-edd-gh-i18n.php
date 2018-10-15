<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.theritesites.com
 * @since      1.0.0
 *
 * @package    Test_EDD_GH
 * @subpackage Test_EDD_GH/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Test_EDD_GH
 * @subpackage Test_EDD_GH/includes
 * @author     TheRiteSites <contact@theritesites.com>
 */
class Test_EDD_GH_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'test-edd-gh',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
