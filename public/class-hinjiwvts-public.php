<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wordpress.org/plugins/widget-visibility-time-scheduler
 * @since      1.0.0
 *
 * @package    Hinjiwvts
 * @subpackage Hinjiwvts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Hinjiwvts
 * @subpackage Hinjiwvts/public
 * @author     Martin Stehle <m.stehle@gmx.de>
 */
class Hinjiwvts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $hinjiwvts    The ID of this plugin.
	 */
	private $hinjiwvts;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $hinjiwvts       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->hinjiwvts = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Determine whether the widget should be displayed based on time set by the user.
	 *
	 * @since    1.0.0
	 * @param array $widget_settings The widget settings.
	 * @return array Settings to display or bool false to hide.
	 */
	public static function filter_widget( $widget_settings ) {

		// return (= show widget) if no stored settings for this plugin
		if ( ! isset( $widget_settings['hinjiwvts'] ) ) return $widget_settings;
		if ( ! isset( $widget_settings['hinjiwvts']['timestamps'] ) ) return $widget_settings;
		if ( ! isset( $widget_settings['hinjiwvts']['timestamps']['start'] ) ) return $widget_settings;
		if ( ! isset( $widget_settings['hinjiwvts']['timestamps']['end'] ) ) return $widget_settings;
		if ( ! isset( $widget_settings['hinjiwvts']['daysofweek'] ) ) return $widget_settings;

		$current_time = current_time( 'timestamp' ); // get current local blog timestamp
		$current_dayofweek = (int) date( 'N', $current_time ); // get ISO-8601 numeric representation of the day of the week; 1 (for Monday) through 7 (for Sunday)
		
		// get and sanitize stored settings
		$start_time  = (int) $widget_settings['hinjiwvts']['timestamps']['start'];
		$end_time    = (int) $widget_settings['hinjiwvts']['timestamps']['end'];
		$is_opposite = ( isset( $widget_settings['hinjiwvts']['is_opposite'] ) ) ? true : false;
		
		// if current time is between required timepoints and is required day of week
		if ( $start_time <= $current_time and $current_time <= $end_time and in_array( $current_dayofweek, $widget_settings['hinjiwvts']['daysofweek'] ) ) {
			return ( $is_opposite ) ? false : $widget_settings; // if functioning opposite hide widget else show widget
		} else {
			return ( $is_opposite ) ? $widget_settings : false; // if functioning opposite show widget else hide widget
		}

	}

}
