<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wordpress.org/plugins/widget-visibility-time-scheduler
 * @since             1.0.0
 * @package           Hinjiwvts
 *
 * @wordpress-plugin
 * Plugin Name:       Widget Visibility Time Scheduler
 * Plugin URI:        http://wordpress.org/plugins/widget-visibility-time-scheduler
 * Description:       Control the visibility of each widget based on date and time easily.
 * Version:           1.0.0
 * Author:            Martin Stehle
 * Author URI:        http://stehle-internet.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hinjiwvts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hinjiwvts-activator.php
 */
function activate_hinjiwvts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hinjiwvts-activator.php';
	Hinjiwvts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hinjiwvts-deactivator.php
 */
function deactivate_hinjiwvts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hinjiwvts-deactivator.php';
	Hinjiwvts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hinjiwvts' );
register_deactivation_hook( __FILE__, 'deactivate_hinjiwvts' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hinjiwvts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hinjiwvts() {

	$plugin = new Hinjiwvts();
	$plugin->run();

}
run_hinjiwvts();
