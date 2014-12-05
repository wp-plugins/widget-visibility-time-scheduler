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
?>
<div class="hinji-visibility-time-scheduler">
	<h4><?php _e( 'Visibility Time Scheduler', 'hinjiwvts' ); ?></h4>
	<p><input class="checkbox" type="checkbox" <?php checked( $hinjiwvts[ 'is_active' ], '1' ); ?> id="<?php echo $widget->get_field_id( 'is-active' ); ?>" name="hinjiwvts[is_active]" value="1" />
	<label for="<?php echo $widget->get_field_id( 'is-active' ); ?>"><?php _e( 'Show Widget within the given period only?', 'hinjiwvts' ); ?></label></p>
	<p><?php _e( 'The time on the server takes effect, not the time of the place where you are at the moment.', 'hinjiwvts' ); ?></p>
	<fieldset>
		<legend><?php _e( 'Start time of widget visibility', 'hinjiwvts' ); ?></legend>
		<p><?php $this->touch_time( 'start', $hinjiwvts, $field_ids ); ?></p>
	</fieldset>
	<fieldset>
		<legend><?php _e( 'End time of widget visibility', 'hinjiwvts' ); ?></legend>
		<p><?php $this->touch_time( 'end', $hinjiwvts, $field_ids ); ?></p>
	</fieldset>
</div><!-- .hinji-visibility-time-scheduler -->

