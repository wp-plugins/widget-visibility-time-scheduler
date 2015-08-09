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
	 * The slug of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_slug    The slug of this plugin.
	 */
	private $plugin_slug;

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
	public function __construct( $plugin_slug, $version ) {

		$this->plugin_slug = $plugin_slug;
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

		$plugin_slug = 'hinjiwvts';

		// return (= show widget) if no stored settings for this plugin
		if ( ! isset( $widget_settings[ $plugin_slug ] ) ) return $widget_settings;
		if ( ! isset( $widget_settings[ $plugin_slug ][ 'timestamps' ] ) ) return $widget_settings;
		if ( ! isset( $widget_settings[ $plugin_slug ][ 'timestamps' ][ 'start' ] ) ) return $widget_settings;
		if ( ! isset( $widget_settings[ $plugin_slug ][ 'timestamps' ][ 'end' ] ) ) return $widget_settings;
		if ( ! isset( $widget_settings[ $plugin_slug ][ 'daysofweek' ] ) ) return $widget_settings;

		$current_timestamp = (int) current_time( 'timestamp' ); // get current local blog timestamp
		$current_day_num = (int) date( 'N', $current_timestamp ); // get ISO-8601 numeric representation of the day of the week; 1 (for Monday) through 7 (for Sunday)
		
		// get and sanitize stored settings
		$widget_start_time  = (int) $widget_settings[ $plugin_slug ][ 'timestamps' ][ 'start' ];
		$widget_end_time    = (int) $widget_settings[ $plugin_slug ][ 'timestamps' ][ 'end' ];
		// convert from plugin version < 4.0
		$is_opposite = false;
		if ( isset( $widget_settings[ $plugin_slug ][ 'is_opposite' ] ) ) {
			$is_opposite = true;
		}
		// since 4.0
		if ( isset( $widget_settings[ $plugin_slug ][ 'mode' ] ) ) {
			$is_opposite = ( 'Hide' == $widget_settings[ $plugin_slug ][ 'mode' ] ) ? true : false;
		}

		// if current time is between required timepoints and is required day of week
		if ( $widget_start_time <= $current_timestamp
			and $current_timestamp <= $widget_end_time
			and in_array( $current_day_num, $widget_settings[ $plugin_slug ][ 'daysofweek' ] ) ) {
			return ( $is_opposite ) ? false : $widget_settings; // if functioning opposite hide widget else show widget
		} else {
			return ( $is_opposite ) ? $widget_settings : false; // if functioning opposite show widget else hide widget
		}
	}
}
