<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://subliminalvisions.com/
 * @since      1.0.0
 *
 * @package    Sh_nyt_stories
 * @subpackage Sh_nyt_stories/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sh_nyt_stories
 * @subpackage Sh_nyt_stories/includes
 * @author     Stephen Harris <subliminalvisions@gmail.com>
 */
class Sh_nyt_stories_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sh_nyt_stories',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
