<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://wordpress.org/plugins/widget-visibility-time-scheduler
 * @since      1.0.0
 *
 * @package    Hinjiwvts
 * @subpackage Hinjiwvts/admin/partials
 */
$label = 'General Settings';
$text = current_user_can( 'manage_options' ) ? sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php' ), __( $label ) ) : sprintf( '<em>%s</em>', __( $label ) );
?>
<div class="hinji-visibility-time-scheduler">
	<h4><?php _e( 'Visibility Time Scheduler', 'hinjiwvts' ); ?></h4>
<?php $field_id = $widget->get_field_id( 'is-active' ); ?>
	<p>
		<input class="checkbox" type="checkbox" <?php checked( $this->scheduler[ 'is_active' ], 1 ); ?> id="<?php echo $field_id; ?>" name="hinjiwvts[is_active]" value="1" />
		<label for="<?php echo $field_id; ?>"><?php _e( 'Show widget within the given period only?', 'hinjiwvts' ); ?></label>
	</p>
	<p><?php printf( __( 'The timezone as set in %s takes effect.', 'hinjiwvts' ), $text ); ?></p>
	<fieldset>
		<legend><?php _e( 'Start time of widget visibility', 'hinjiwvts' ); ?></legend>
		<p><?php $this->touch_time( 'start' ); ?></p>
	</fieldset>
	<fieldset>
		<legend><?php _e( 'End time of widget visibility', 'hinjiwvts' ); ?></legend>
<?php $field_id = $widget->get_field_id( 'end-infinite' ); ?>
		<p><?php $this->touch_time( 'end' ); ?></p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $this->scheduler[ 'end_infinite' ], 1 ); ?> id="<?php echo $field_id; ?>" name="hinjiwvts[end_infinite]" value="1" />
			<label for="<?php echo $field_id; ?>"><?php _e( 'Show widget for an unlimited time?', 'hinjiwvts' ); ?></label>
		</p>
		<p><?php _e( 'Why only up to end of 2037? Read <a href="http://en.wikipedia.org/wiki/Year_2038_problem" lang="en">Wikipedia: Year 2038 problem</a>.', 'hinjiwvts' ); ?></p>
	</fieldset>
	<fieldset>
		<legend><?php _e( 'Weekdays of widget visibility', 'hinjiwvts' ); ?></legend>
		<p><?php _e( 'Check at least one weekday to activate the scheduler.', 'hinjiwvts' ); ?></p>
		<p>
<?php
		foreach ( $daysofweek as $dayname => $value ) {
			$field_id = $widget->get_field_id( $dayname );
?>
			<input class="checkbox" type="checkbox" <?php checked( in_array( $value, $this->scheduler[ 'daysofweek' ] ) ); ?> id="<?php echo $field_id; ?>" name="hinjiwvts[daysofweek][]" value="<?php echo $value; ?>" />
			<label for="<?php echo $field_id; ?>"><?php _e( $dayname ); ?></label><br />
<?php
		}
?>
		</p>
	</fieldset>
</div><!-- .hinji-visibility-time-scheduler -->

