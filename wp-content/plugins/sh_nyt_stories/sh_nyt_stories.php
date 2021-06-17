<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://subliminalvisions.com/
 * @since             1.0.0
 * @package           Sh_nyt_stories
 *
 * @wordpress-plugin
 * Plugin Name:       NYT Top Stories
 * Plugin URI:        http://subliminalvisions.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Stephen Harris
 * Author URI:        http://subliminalvisions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sh_nyt_stories
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
  die();
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define("SH_NYT_STORIES_VERSION", "1.0.0");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sh_nyt_stories-activator.php
 */
function activate_sh_nyt_stories()
{
  require_once plugin_dir_path(__FILE__) .
    "includes/class-sh_nyt_stories-activator.php";
  Sh_nyt_stories_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sh_nyt_stories-deactivator.php
 */
function deactivate_sh_nyt_stories()
{
  require_once plugin_dir_path(__FILE__) .
    "includes/class-sh_nyt_stories-deactivator.php";
  Sh_nyt_stories_Deactivator::deactivate();
}

register_activation_hook(__FILE__, "activate_sh_nyt_stories");
register_deactivation_hook(__FILE__, "deactivate_sh_nyt_stories");

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . "includes/class-sh_nyt_stories.php";

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sh_nyt_stories()
{
  $plugin = new Sh_nyt_stories();
  $plugin->run();
}
run_sh_nyt_stories();
