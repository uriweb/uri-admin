<?php
/**
 * Plugin Name: URI Admin
 * Plugin URI: https://www.uri.edu/wordpress/software/
 * Description: Customizations for the admin dashboard
 * Version: 2.1.2
 * Author: URI Web Communications
 * Author URI: https://web.uri.edu/external-relations/contact-us/#web
 *
 * @author: John Pennypacker <jpennypacker@uri.edu>
 * @author: Brandon Fuller <bjcfuller@uri.edu>
 * @package uri-admin
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'URI_ADMIN_PATH', plugin_dir_path( __FILE__ ) );

// include settings page

include( URI_ADMIN_PATH . 'inc/uri-admin-welcome-settings.php' );

// prevent the confirm admin email prompt from appearing
add_filter( 'admin_email_check_interval', '__return_false' );

// Remove the default welcome dashboard message
function remove_welcome_panel() {
remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

add_action( 'admin_init', 'remove_welcome_panel' );


/**
 * Load a custom stylesheet.
 */
function uri_admin_style() {
	if ( function_exists( 'get_plugin_data' ) ) {
		$values = get_plugin_data( __FILE__, false );
		$cache_buster = $values['Version'];
	} else {
		// cache for a day
		$cache_buster = gmdate( 'Ymd', strtotime( 'now' ) );
	}
  wp_enqueue_style( 'uri-admin-styles', plugins_url( 'uri-admin.css', __FILE__ ), [], $cache_buster );
}
add_action('admin_enqueue_scripts', 'uri_admin_style');


/**
 * Override the default "Thank you for using WordPress admin footer".
 */
function uri_admin_footer() {
	echo '<p class="footer-about-wp"><a href="https://www.uri.edu/wordpress/" target="_blank">Learn more about WordPress at URI</a>.</p>';
}
add_filter( 'admin_footer_text', 'uri_admin_footer' );


/**
 * Create custom dashboard widgets and resort the widgets to put URI on top.
 */
function uri_admin_dashboard_widgets() {

	// disable this widget for now, it's not being maintained... but maybe in the future
	return null;

	global $wp_meta_boxes;

	wp_add_dashboard_widget(
		'uri_admin_dashboard_updates_feed',
		__('URI WordPress Updates'),
		'uri_admin_dashboard_wordpress_updates_feed_output',
		NULL, // control callback
		NULL, // callback args
		'normal', // context
		'core' // priority
	);

	// Get the regular dashboard widgets array
	// (which already has our new widget but appended at the end).
	$default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

	// Backup and delete our new dashboard widget from the end of the array.
	$uri_widget_backup = array( 'uri_admin_dashboard_updates_feed' => $default_dashboard['uri_admin_dashboard_updates_feed'] );
	unset( $default_dashboard['uri_admin_dashboard_updates_feed'] );

	// Merge the two arrays together so our widget is at the beginning.
	$sorted_dashboard = array_merge( $uri_widget_backup, $default_dashboard );

	// Save the sorted array back into the original metaboxes.
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

}
add_action('wp_dashboard_setup', 'uri_admin_dashboard_widgets');


/**
 * Display the content of the RSS updates.
 */
function uri_admin_dashboard_wordpress_updates_feed_output() {
	echo '<div class="rss-widget uri-wordpress-updates">';
	wp_widget_rss_output(
		'https://www.uri.edu/wordpress/updates/feed/rss',
		array(
			'items' => 2,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
		)
	);
	echo '<p class="uri-admin-wp-updates-footer"><a href="https://www.uri.edu/wordpress/updates/">Previous updates »</a></p>';
	echo '</div>';
}



/**
 * Remove unwanted WP Admin Dashboard boxes
 * 
 * @see https://www.wpexplorer.com/customize-wordpress-admin-dashboard/
 */
function uri_admin_remove_boxes() {
	// Remove some widgets for users who are not administrators 
	if ( ! uri_admin_has_admin_privilages() ) {
		remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // what's on your mind?
	}

	// Remove other widgets for users who can't manage options
	if ( ! current_user_can( 'manage_options' ) ) {
		//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // # pages, #posts, theme
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); // wp events and news
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // activity
	}
}
add_action( 'admin_init', 'uri_admin_remove_boxes' );

// Display space usage in At a Glance widget
add_action( 'dashboard_glance_items', 'display_space_usage' );

/**
 * display a replacement for the welcome panel
 * @see https://developer.wordpress.org/reference/functions/wp_welcome_panel/
 */
function uri_admin_welcome_panel() {
	$screen = get_current_screen();
	if( $screen->base == 'dashboard' ) {
		ob_start();
		include 'inc/uri-admin-welcome.php';
		ob_end_flush();
	}
}
add_action('admin_notices', 'uri_admin_welcome_panel');

/**
 * Get user role
 */
function uri_admin_has_admin_privilages() {

	$admin = false;

	global $current_user;
	$role = array_shift( $current_user->roles );

	if ( 'administrator' == $role || 'webadmin' == $role ) {
		$admin = true;
	}
	return $admin;
}
