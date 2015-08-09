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
	<h4><?php _e( 'Visibility Time Scheduler', $this->plugin_slug ); ?></h4>
<?php $field_id = $widget->get_field_id( 'mode' ); ?>
	<p>
		<label for="<?php echo $field_id; ?>"><?php $text = 'Schedule'; _e( $text );?>:</label>
		<select id="<?php echo $field_id; ?>" name="<?php echo $this->plugin_slug; ?>[mode]">
			<option value=""><?php $text = '&mdash; Select &mdash;'; _e( $text );?></option>
<?php
foreach ( $this->modes as $mode ) {
?>
			<option value="<?php echo $mode; ?>"<?php selected( $mode, $this->scheduler[ 'mode' ] );?>><?php _e( $mode );?></option>
<?php
}
?>
		</select>
	</p>
	<fieldset>
		<legend><?php _e( 'from', $this->plugin_slug ); ?></legend>
		<p><?php $this->touch_time( 'start' ); ?></p>
	</fieldset>
	<fieldset>
		<legend><?php _e( 'to', $this->plugin_slug ); ?></legend>
		<p><?php $this->touch_time( 'end' ); ?></p>
<?php
// show advice and delete flag if user typed in an end year later than 2037
if ( false !== get_transient( $this->plugin_slug ) ) {
?>
		<p><?php _e( 'Why only up to end of 2037? Read <a href="http://en.wikipedia.org/wiki/Year_2038_problem" lang="en">Wikipedia: Year 2038 problem</a>.', $this->plugin_slug ); ?></p>
<?php
	delete_transient( $this->plugin_slug );
}
?>
	</fieldset>
	<fieldset>
		<legend><?php _e( 'on', $this->plugin_slug ); ?></legend>
		<p>
<?php
		foreach ( $this->weekdays as $dayname => $value ) {
			$field_id = $widget->get_field_id( $dayname );
?>
			<input class="checkbox" type="checkbox" <?php checked( in_array( $value, $this->scheduler[ 'daysofweek' ] ) ); ?> id="<?php echo $field_id; ?>" name="<?php echo $this->plugin_slug; ?>[daysofweek][]" value="<?php echo $value; ?>" />
			<label for="<?php echo $field_id; ?>"><?php _e( $dayname ); ?></label><br />
<?php
		}
?>
		</p>
	</fieldset>
</div><!-- .hinji-visibility-time-scheduler -->
