=== Widget Visibility Time Scheduler ===
Contributors: Hinjiriyo
Tags: brazilian, control, date, day, deutsch, display, español, farsi, forever, future, german, hide, hour, hungarian, jetpack, magyar, minute, month, period, persian, plan, português do brasil, portuguese, schedule, scheduler, show, time, unlimited, visibility, weekdays, widget, widgets, year
Requires at least: 3.5
Tested up to: 4.3.1
Stable tag: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Control the visibility of each widget based on date, time and weekday easily.

== Description ==

The plugin is available in English, Spanish (Español), German (Deutsch), Brazilian Portuguese (Português do Brasil), Persian (Farsi) and Hungarian (Magyar).

= Show and hide widgets within a desired period and at given weekdays =

The Widget Visibility Time Scheduler enables you to set the period and weekdays of the visibility of each widget easily. You can set to show or to hide the widget during schedule. It is available in english, german, spanish, brazilian portuguese, persian and hungarian language.

= Daytime version available =

If you want to schedule the visibility based on the daytime of each weekday please contact the author at m.stehle@gmx.de and ask for the premium version of the plugin.

= What users said =

**"The plugin is perfect for seasonal widgets, temporary sales/promotions, events, live chat buttons, and any other time/date-dependent content."** in [Control the Visibility of WordPress Widgets Based on Time and Date](http://wptavern.com/control-the-visibility-of-wordpress-widgets-based-on-time-and-date) by Sarah Gooding on January 5, 2015.

= Compatibility with Jetpack =

This plugin works perfectly with Jetpack's "Widget Visibility" module. Both plugins enhance each other to give you great control about when and where to display which widget on your website.

= Languages =

The user interface is available in

* English
* German (Deutsch)
* Spanish (Español), kindly drawn up by [Eduardo Larequi](https://profiles.wordpress.org/elarequi)
* Brazilian Portuguese (Português do Brasil), kindly drawn up by [Christiano Albano P.](https://profiles.wordpress.org/cristianoalbanop)
* Persian (Farsi), kindly drawn up by [Sajjad Panahi](https://profiles.wordpress.org/asreelm)
* Hungarian (Magyar), kindly drawn up by [V.A.Lucky](https://wordpress.org/support/profile/valucky)

Further translations are welcome. If you want to give in your translation please leave a notice in the [plugin's support forum](https://wordpress.org/support/plugin/widget-visibility-time-scheduler).

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Widget Visibility Time Scheduler'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard
5. Go to 'Widgets', set the visibility period in each widget

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `widget-visibility-time-scheduler.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard
6. Go to 'Widgets', set the visibility period in each widget

= Using FTP =

1. Download `widget-visibility-time-scheduler.zip`
2. Extract the `widget-visibility-time-scheduler` directory to your computer
3. Upload the `widget-visibility-time-scheduler` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard
5. Go to 'Widgets', set the visibility period in each widget

== Frequently Asked Questions ==

= How to use? =

1. Go to the Widget page in the WordPress backend. Every widget is enhanced by easy-to-use fields for time data.
2. Set comfortably the start point of time, the end point of time and the weekdays when to display or to hide the widget. With the "unlimited" option the widget is displayed "forever" in the future. If you want to hide the widget during schedule, activate the Hide option.
3. After you have define the time data just save the widget settings. Done!

= Is there an option page? =

No. That is not neccessary. You set the visibility in each widget on the Widgets page in the backend.

= Do the scheduler settings effect cached pages? =

No. This plugin has no site effects to cache plugins. So it can happen that a cached page shows a widget although the scheduler settings says to hide it, and vice versa.

It is up to your cache settings how the visibility of a widget is considered. Maybe it is helpful to empty the cache automatically once a day.

= How can I set the daytime for each weekday? =

Purchase the Pro version of that plugin. That version is like the free plugin version, enhanced with the ability to schedule the visibility based on the time of each weekday. The Pro version is also available in german, spanish, brazilian portuguese and persian. Please contact the author at m.stehle@gmx.de for more informations about the Pro version.

= Does removing the plugin delete the settings in the database? =

Up to now: no. But you can remove the settings in the database easily with two possibilities:

* Either deactivate (uncheck) the visibility time scheduler in each widget and save the widget settings.
* Or remove the widget out of the widget area.

= Does the plugin work with Jetpack's Widget Visibility module? =

Yes. Both plugins work together perfectly and enhance each other to give you great control about when and where to display which widget.

= Why is the highest year number 2037? =

Most servers are 32-bit systems, either the hardware or the software WordPress uses: Apache, PHP, MySQL. The technical maximum time a 32-bit system can handle is 03:14:07 on Tuesday, 19 January 2038. If a user would type in a date after 19 January 2038 a strange behaviour would occur.

So to have safe values I have set deliberately the maximum valid year value to 2037. That allowed the latest point of time at 23:59:00 on December 31, 2037. And that avoids a more complicated, unsafe check for a date like “January 19, 2039 03:14:07″.

You can find a detailed and understandable explanation at [Wikipedia: Year 2038 problem](http://en.wikipedia.org/wiki/Year_2038_problem). That text also explains why the lowest year number is 1970.

= Where is the *.pot file for translating the plugin in any language? =

If you want to contribute a translation of the plugin in your language it would be great! You would find the *.pot file in the 'languages' directory of this plugin. If you would send the *.po file to me I would include it in the next release of the plugin.

== Screenshots ==

1. English interface of the premium plugin Widget Visibility Time Scheduler Pro in the Search Widget
2. German interface of the Widget Visibility Time Scheduler in the Search Widget
3. Spanish interface of the Widget Visibility Time Scheduler in the Search Widget
4. Brazilian portuguese interface of the Widget Visibility Time Scheduler in the Search Widget
5. Persian (farsi) interface of the Widget Visibility Time Scheduler in the Search Widget
6. Hungarian (magyar) interface of the Widget Visibility Time Scheduler in the Search Widget

== Changelog ==

= 4.1 =
* Added hungarian translation. Thank you very much, [V.A.Lucky](https://wordpress.org/support/profile/valucky)
* Tested successfully with WordPress 4.3.1

= 4.0.1 =
* Tested successfully with WordPress 4.3
* Updated persian translation
* Updated persian screenshot

= 4.0 =
* Changed: Simplified interface; your former settings will be adopted
* Changed: If not changed formerly all weekdays are checked by default
* Added styles for right-to-left languages
* Added styles for widget form in WP customizer
* Added in readme.txt: screenshot and informations about the premium version for scheduling based on daytime
* Updated screenshots
* Updated *.pot file and translations

= 3.1 =
* Added persian translation (Farsi). Thank you very much [Sajjad Panahi](https://profiles.wordpress.org/asreelm)
* Added screenshot of widget in persian language
* Fixed typo in german translation

= 3.0 =
* Added option: hide during schedule, else show the widget
* Updated screenshots
* Updated *.pot file and translations

= 2.2 =
* Added brazilian portuguese translation. Thank you very much [Christiano Albano P.](https://profiles.wordpress.org/cristianoalbanop)
* Added screenshot of the widget in brazilian portuguese language

= 2.1.1 =
Fixed typo in the spanish translation 

= 2.1 =
* Added spanish translation. Thank you very much [Eduardo Larequi](https://profiles.wordpress.org/elarequi)!
* Revised the description of the plugin
* Added screenshots of the widget in german and spanish language
* Updated *.pot file and german translation

= 2.0 =
* **Important advice: You must readjust each scheduler settings once!** The plugin is revised and extended fundamentally to consider user requests
* Changed timezone: The time based on the timezone set on the blog's General Settings page is used instead of UTC
* Added days of week as options
* Added infinite end as option
* Updated *.pot file and german translation
* Extended FAQ
* Updated screenshot
* Added header image for WP repository
* Added icon image for WP plugin search

= 1.1 =
Fixed bug which did not show settings correctly in backend

= 1.0.1 =
Successfully tested with WordPress 4.1

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 4.1 =
Added hungarian translation, tested successfully with WordPress 4.3.1

= 4.0.1 =
Updated persian translation, tested successfully with WordPress 4.3

= 4.0 =
Simplified interface, weekdays are set by default, updated translations except Persian

= 3.1 =
Added persian (Farsi) translation

= 3.0 =
Added inversed action option

= 2.2 =
Added brazilian portuguese translation

= 2.1.1 =
Fixed typo in the spanish translation 

= 2.1 =
Added spanish translation, revised the description of the plugin

= 2.0 =
Important advice: You must readjust each scheduler settings once! The plugin is revised and extended fundamentally.

= 1.1 =
Fixed display bug

= 1.0.1 =
Successfully tested with WordPress 4.1

= 1.0.0 =
Initial release.