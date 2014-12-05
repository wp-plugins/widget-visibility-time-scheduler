<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://wordpress.org/plugins/widget-visibility-time-scheduler
 * @since      1.0.0
 *
 * @package    Hinjiwvts
 * @subpackage Hinjiwvts/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Hinjiwvts
 * @subpackage Hinjiwvts/admin
 * @author     Martin Stehle <m.stehle@gmx.de>
 */
class Hinjiwvts_Admin {

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
	 * Current day on server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $dd    current day
	 */
	private $dd;

	/**
	 * Current month on server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mm    current month
	 */
	private $mm;

	/**
	 * Current year on server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $yy    current year
	 */
	private $yy;

	/**
	 * Current hour on server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $hh    current hour
	 */
	private $hh;

	/**
	 * Current minute on server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mn    current minute
	 */
	private $mn;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $hinjiwvts       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $hinjiwvts, $version ) {

		$this->hinjiwvts = $hinjiwvts;
		$this->version = $version;

		// set current date and time vars
		$timestamp = time(); // get current local Unix timestamp
		$this->dd = idate( 'd', $timestamp ); // get day number as integer
		$this->mm = idate( 'm', $timestamp ); // get month number as integer
		$this->yy = idate( 'Y', $timestamp ); // get year as integer, 4 digits
		$this->hh = idate( 'H', $timestamp ); // get hour as integer, 24 hour format
		$this->mn = idate( 'i', $timestamp ); // get minute as integer
		$this->ss = 0; // set seconds to zero
		
		// not in use, just for the po-editor to display the translation on the plugins overview list
		$foo = __( 'Control the visibility of each widget based on date and time easily.', 'hinjiwvts' );

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->hinjiwvts, plugin_dir_url( __FILE__ ) . 'css/hinjiwvts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Print a message about the location of the plugin in the WP backend
	 * 
	 * @since    1.0.0
	 */
	public function display_activation_message () {
		$url  = admin_url( 'widgets.php' );
		$text = 'Widgets';
		$link = sprintf( '<a href="%s">%s</a>', $url, __( $text ) );
		$msg  = sprintf( __( 'Welcome to Widget Visibility Time Scheduler! You can set the time based visibility in each widget on the page %s.', 'hinjiwvts' ), $link );
		$html = sprintf( '<div class="updated"><p>%s</p></div>', $msg );
		print $html;
	}

	/**
	 * Add the widget conditions to each widget in the admin.
	 *
	 * @param $widget unused.
	 * @param $return unused.
	 * @param array $instance The widget settings.
	 */
	public function display_time_fields( $widget, $return, $instance ) {
		
		// prepare html elements ids
		$field_ids = array();
		foreach( array( 'mm', 'dd', 'hh', 'mn', 'yy', 'ss' ) as $field_name ) {
			foreach( array( 'start', 'end' ) as $boundary ) {
				$name = $boundary . '-' . $field_name;
				$field_ids[ $name ] = $widget->get_field_id( $name );
			}
		}

		// get saved settings of widget
		$settings = $widget->get_settings();
		$settings = array_shift( $settings ); // get first element of widget settings
		
		// check and sanitize stored settings; if not set: set them to current time
		$hinjiwvts = array();
		if ( isset( $settings[ 'hinjiwvts' ] ) ) {
			$hinjiwvts = $settings[ 'hinjiwvts' ];
		}

		if ( ! isset( $hinjiwvts[ 'is_active' ] ) ) {
			$hinjiwvts[ 'is_active' ] = '0';
		}
		if ( isset( $hinjiwvts[ 'timestamps' ] ) ) {
			foreach( array( 'start', 'end' ) as $boundary ) {
				if ( isset( $hinjiwvts[ 'timestamps' ][ $boundary ] ) ) {
					$timestamp = (int) $hinjiwvts[ 'timestamps' ][ $boundary ]; // get stored Unix timestamp
				} else {
					$timestamp = time(); // get current local Unix timestamp
				}
				$hinjiwvts[ $boundary . '-dd' ] = idate( 'd', $timestamp ); // get day number as integer
				$hinjiwvts[ $boundary . '-mm' ] = idate( 'm', $timestamp ); // get month number as integer
				$hinjiwvts[ $boundary . '-yy' ] = idate( 'Y', $timestamp ); // get year as integer, 4 digits
				$hinjiwvts[ $boundary . '-hh' ] = idate( 'H', $timestamp ); // get hour as integer, 24 hour format
				$hinjiwvts[ $boundary . '-mn' ] = idate( 'i', $timestamp ); // get minute as integer
			}
		} else {
			$timestamp = time(); // get current local Unix timestamp
			foreach( array( 'start', 'end' ) as $boundary ) {
				$hinjiwvts[ $boundary . '-dd' ] = idate( 'd', $timestamp ); // get day number as integer
				$hinjiwvts[ $boundary . '-mm' ] = idate( 'm', $timestamp ); // get month number as integer
				$hinjiwvts[ $boundary . '-yy' ] = idate( 'Y', $timestamp ); // get year as integer, 4 digits
				$hinjiwvts[ $boundary . '-hh' ] = idate( 'H', $timestamp ); // get hour as integer, 24 hour format
				$hinjiwvts[ $boundary . '-mn' ] = idate( 'i', $timestamp ); // get minute as integer
			}
		}

		// print additional input fields in widget
		include 'partials/hinjiwvts-fieldsets.php';
		
		// return null because new fields are added
		return null;
	}

	/**
	 * Print out HTML form date elements for editing widget publish date.
	 *
	 * Borrowed from WP-own function touch_time() in /wp-admin/includes/template.php
	 *
	 * @since 1.0.0
	 *
	 * @param int|bool $boundary The tabindex attribute to add. Default 0.
	 */
	private function touch_time( $boundary, $settings, $field_ids ) {
		global $wp_locale;
		
		// check and sanitize stored settings

		//  day
		$label = 'Day';
		$name = $boundary . '-dd';
		$var = isset( $settings[ $name ] ) ? absint( $settings[ $name ] ) : $this->dd;
		$hinjiwvts[ $name ] = ( 1 <= $var and $var <= 31 ) ? zeroise( $var, 2 ) : zeroise( $this->dd, 2 );
		$day = sprintf( '<label for="%s" class="screen-reader-text">%s</label><input type="text" id="%s" name="hinjiwvts[%s]" value="%s" size="2" maxlength="2" autocomplete="off" />', $field_ids[ $name ], __( $label ), $field_ids[ $name ], $name, $hinjiwvts[ $name ] );

		//  month
		$label = 'Month';
		$name = $boundary . '-mm';
		$var = isset( $settings[ $name ] ) ? absint( $settings[ $name ] ) : $this->mm;
		$hinjiwvts[ $name ] = ( 1 <= $var and $var <= 12 ) ? zeroise( $var, 2 ) : zeroise( $this->mm, 2 );
		$month = sprintf( '<label for="%s" class="screen-reader-text">%s</label><select id="%s" name="hinjiwvts[%s]">', $field_ids[ $name ], __( $label ), $field_ids[ $name ], $name );
		$label = '%1$s-%2$s';
		for ( $i = 1; $i < 13; $i = $i +1 ) {
			$monthnum = zeroise($i, 2); // add leading zero for values < 10
			#$month .= "\t\t\t";
			$month .= sprintf( '<option value="%s" %s>', $monthnum, selected( $monthnum, $hinjiwvts[ $name ], false ) );
			/* translators: 1: month number (01, 02, etc.), 2: month abbreviation */
			$month .= sprintf( __( $label ), $monthnum, $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) ) . '</option>';
		}
		$month .= '</select>';

		//  year
		$label = 'Year';
		$name = $boundary . '-yy';
		$var = isset( $settings[ $name ] ) ? absint( $settings[ $name ] ) : $this->yy;
		$hinjiwvts[ $name ] = ( 1970 <= $var and $var <= 2037 ) ? strval( $var ) : zeroise( $this->yy, 2 );
		$year   = sprintf( '<label for="%s" class="screen-reader-text">%s</label><input type="text" id="%s" name="hinjiwvts[%s]" value="%s" size="4" maxlength="4" autocomplete="off" />', $field_ids[ $name ], __( $label ), $field_ids[ $name ], $name, $hinjiwvts[ $name ] );

		//  hour
		$label = 'Hour';
		$name = $boundary . '-hh';
		$var = isset( $settings[ $name ] ) ? absint( $settings[ $name ] ) : $this->hh;
		$hinjiwvts[ $name ] = ( 0 <= $var and $var <= 23 ) ? zeroise( $var, 2 ) : zeroise( $this->hh, 2 );
		$hour = sprintf( '<label for="%s" class="screen-reader-text">%s</label><input type="text" id="%s" name="hinjiwvts[%s]" value="%s" size="2" maxlength="2" autocomplete="off" />', $field_ids[ $name ], __( $label ), $field_ids[ $name ], $name, $hinjiwvts[ $name ] );

		//  minute
		$label = 'Minute';
		$name = $boundary . '-mn';
		$var = isset( $settings[ $name ] ) ? absint( $settings[ $name ] ) : $this->mn;
		$hinjiwvts[ $name ] = ( 0 <= $var and $var <= 59 ) ? zeroise( $var, 2 ) : zeroise( $this->mn, 2 );
		$minute = sprintf( '<label for="%s" class="screen-reader-text">%s</label><input type="text" id="%s" name="hinjiwvts[%s]" value="%s" size="2" maxlength="2" autocomplete="off" />', $field_ids[ $name ], __( $label ), $field_ids[ $name ], $name, $hinjiwvts[ $name ] );

		#echo '<div class="timestamp-wrap">';
		/* translators: 1: month, 2: day, 3: year, 4: hour, 5: minute */
		$label = '%1$s %2$s, %3$s @ %4$s : %5$s';
		printf( __( $label ), $month, $day, $year, $hour, $minute ) . "\n";

		#echo '</div><!-- .timestamp -->';
		//  second
		$name = $boundary . '-ss';
		printf( '<input type="hidden" id="%s" name="hinjiwvts[%s]" value="00" maxlength="2" />', $field_ids[ $name ], $name ) . "\n";

	}
	
	/**
	 * On an AJAX update of the widget settings, sanitize and return the display conditions.
	 *
	 * @param	array	$new_instance	New settings for this instance as input by the user.
	 * @param	array	$old_instance	Old settings for this instance.
	 * @return	array	$instance		Processed settings.
	 */
	public static function widget_update( $instance, $new_instance, $old_instance ) {
		
		$datetime = array();
		$hinjiwvts = array();
		
		// set current date and time vars
		// (neccessary to write it once more instead of re-use $this->xx because we are here in a non-object context
		$timestamp = time(); // get current local Unix timestamp
		$dd = idate( 'd', $timestamp ); // get day number as integer
		$mm = idate( 'm', $timestamp ); // get month number as integer
		$yy = idate( 'Y', $timestamp ); // get year as integer, 4 digits
		$hh = idate( 'H', $timestamp ); // get hour as integer, 24 hour format
		$mn = idate( 'i', $timestamp ); // get minute as integer
		$ss = 0; // set seconds to zero
		// sanitize user input

		// activity
		$hinjiwvts[ 'is_active' ] = isset( $_POST[ 'hinjiwvts' ][ 'is_active' ] ) ? '1' : false;
		
		// if unchecked, save time and quit now without settings
		if ( ! $hinjiwvts[ 'is_active' ] ) {
			if ( isset( $instance[ 'hinjiwvts' ] ) ) {
				unset( $instance[ 'hinjiwvts' ] );
			}
			return $instance;
		}
		
		// else go on: if input is valid ? use it : else use current time

		foreach( array( 'start', 'end' ) as $boundary ) {
			// day
			$name = $boundary . '-dd';
			$var = isset( $_POST[ 'hinjiwvts' ][ $name ] ) ? absint( $_POST[ 'hinjiwvts' ][ $name ] ) : $dd;
			$datetime[ $name ] = ( 1 <= $var and $var <= 31 ) ? $var : $dd;
			// month
			$name = $boundary . '-mm';
			$var = isset( $_POST[ 'hinjiwvts' ][ $name ] ) ? absint( $_POST[ 'hinjiwvts' ][ $name ] ) : $mm;
			$datetime[ $name ] = ( 1 <= $var and $var <= 12 ) ? $var : $mm;
			// year
			$name = $boundary . '-yy';
			$var = isset( $_POST[ 'hinjiwvts' ][ $name ] ) ? absint( $_POST[ 'hinjiwvts' ][ $name ] ) : $yy;
			$datetime[ $name ] = ( 1970 <= $var and $var <= 2037 ) ? $var : $yy;
			// hour
			$name = $boundary . '-hh';
			$var = isset( $_POST[ 'hinjiwvts' ][ $name ] ) ? absint( $_POST[ 'hinjiwvts' ][ $name ] ) : $hh;
			$datetime[ $name ] = ( 0 <= $var and $var <= 23 ) ? $var : $hh;
			// minute
			$name = $boundary . '-mn';
			$var = isset( $_POST[ 'hinjiwvts' ][ $name ] ) ? absint( $_POST[ 'hinjiwvts' ][ $name ] ) : $mn;
			$datetime[ $name ] = ( 0 <= $var and $var <= 59 ) ? $var : $mn;
			// second
			$name = $boundary . '-ss';
			$datetime[ $name ] = 0;
			
			// get Unix timestamp for input values
			$hinjiwvts[ 'timestamps' ][ $boundary ] = mktime(
				$datetime[ $boundary . '-hh' ],
				$datetime[ $boundary . '-mn' ],
				$datetime[ $boundary . '-ss' ],
				$datetime[ $boundary . '-mm' ],
				$datetime[ $boundary . '-dd' ],
				$datetime[ $boundary . '-yy' ]
			);
		}

		// return sanitized user settings
		$instance[ 'hinjiwvts' ] = $hinjiwvts;
		return $instance;
	}

}
