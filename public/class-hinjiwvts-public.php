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
	public function __construct( $hinjiwvts, $version ) {

		$this->hinjiwvts = $hinjiwvts;
		$this->version = $version;

	}

	/**
	 * Determine whether the widget should be displayed based on time set by the user.
	 *
	 * @param array $instance The widget settings.
	 * @return array Settings to display or bool false to hide.
	 */
	public static function filter_widget( $instance ) {

		// return (= show widget) if no stored settings for this plugin
		if ( ! isset( $instance['hinjiwvts'] ) ) return $instance;
		if ( ! isset( $instance['hinjiwvts']['timestamps'] ) ) return $instance;
		if ( ! isset( $instance['hinjiwvts']['timestamps']['start'] ) ) return $instance;
		if ( ! isset( $instance['hinjiwvts']['timestamps']['end'] ) ) return $instance;

		$current_time = time(); // get current Unix timestamp
		
		// get and sanitize stored settings
		$start_time = (int) $instance['hinjiwvts']['timestamps']['start'];
		$end_time   = (int) $instance['hinjiwvts']['timestamps']['end'];

		// if current time is between set timepoints
		if ( $start_time <= $current_time && $current_time <= $end_time) {
			return $instance; // display widget
		} else {
			return false; // hide widget
		}

	}

}
