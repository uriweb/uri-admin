<?php
/**
 * Create admin settings menu
 *
 * @package uri-admin
 */


/**
 * Register settings
 */
function uri_admin_register_settings() {

	register_setting(
		'uri_admin',
		'uri_admin_notification_title',
		'sanitize_text_field'
	);

	register_setting(
		'uri_admin',
		'uri_admin_notification_message',
		'sanitize_text_field'
	);

	add_settings_section(
		'uri_admin_settings',
		__( 'Network-wide Dashboard Notification', 'uri' ),
		'uri_admin_settings_section',
		'uri_admin'
	);


	// register fields
	add_settings_field(
		'uri_admin_notification_title', // id: as of WP 4.6 this value is used only internally
		__( 'Notification Title', 'uri' ), // title
		'uri_admin_notification_title_field', // callback
		'uri_admin', // page
		'uri_admin_settings', //section
		array( //args
			'label_for' => 'uri-admin-field-notification-title',
			'class' => 'uri_admin_row',
		)
	);
	add_settings_field(
		'uri_admin_notification_message', // id: as of WP 4.6 this value is used only internally
		__( 'Notification Message', 'uri' ), // title
		'uri_admin_notification_message_field', // callback
		'uri_admin', // page
		'uri_admin_settings', //section
		array( //args
			'label_for' => 'uri-admin-field-notification-message',
			'class' => 'uri_admin_row',
		)
	);

}
add_action( 'admin_init', 'uri_admin_register_settings' );



/**
 * Callback for a settings section
 * @param arr $args has the following keys defined: title, id, callback.
 * @see add_settings_section()
 */
function uri_admin_settings_section( $args ) {
	$intro = 'URI Admin governs the look of individual site dashboards.';
	echo '<p id="' . esc_attr( $args['id'] ) . '">' . esc_html_e( $intro, 'uri' ) . '</p>';
}


/**
 * Add the settings page to the settings menu
 * @see https://developer.wordpress.org/reference/functions/add_submenu_page/
 */
function uri_admin_settings_page() {
	add_submenu_page(
		'settings.php',
		__( 'URI Admin Settings', 'uri' ),
		__( 'URI Admin', 'uri' ),
		'manage_network_options',
		'uri-admin-settings',
		'uri_admin_settings_page_html'
	);
}
add_action( 'network_admin_menu', 'uri_admin_settings_page' );



/**
 * callback to render the HTML of the settings page.
 * renders the HTML on the settings page
 */
function uri_admin_settings_page_html() {

	?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="edit.php?action=save" method="post">
				<?php
					// output security fields for the registered setting "uri_admin"
					settings_fields( 'uri_admin' );
					// output setting sections and their fields
					do_settings_sections( 'uri_admin' );
					// output save settings button
					submit_button( 'Save Settings' );
				?>
			</form>
		</div>
	<?php
}


/**
 * Field callback
 * outputs the field
 * @see add_settings_field()
 */
function uri_admin_notification_title_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_admin_notification_title' );
	// output the field
	?>
		<input type="text" class="regular-text" aria-describedby="uri-admin-field-notification-title" name="uri_admin_notification_title" id="uri-admin-field-notification-title" value="<?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?>">
		<p class="uri-admin-field-notification-title">
			<?php
				esc_html_e( 'Title', 'uri' );
			?>
		</p>
	<?php
}

/**
 * Field callback
 * outputs the field
 * @see add_settings_field()
 */
function uri_admin_notification_message_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_admin_notification_message' );
	// output the field
	?>
		<textarea class="regular-text" aria-describedby="uri-admin-field-notification-message" name="uri_admin_notification_message" id="uri-admin-field-notification-message"><?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?></textarea>
		<p class="uri-admin-field-notification-message">
			<?php
				esc_html_e( 'Message', 'uri' );
			?>
		</p>
	<?php
}


/**
* Save the Settings
*/

add_action('network_admin_edit_save', 'uri_admin_save_options');
function uri_admin_save_options() {

	update_site_option( 'uri_admin_notification_title', $_POST['uri_admin_notification_title'] );
	update_site_option( 'uri_admin_notification_message', $_POST['uri_admin_notification_message'] );

	wp_redirect( add_query_arg( array(
		'page' => 'uri-admin-settings',
		'updated' => true ), network_admin_url('settings.php')
	));
	exit;
}

/**
 * Add admin notice
 */

 add_action( 'network_admin_notices', 'uri_admin_custom_notices' );

function uri_admin_custom_notices(){

	if( isset($_GET['page']) && $_GET['page'] == 'uri-admin-settings' && isset( $_GET['updated'] )  ) {
		echo '<div id="message" class="updated notice is-dismissible"><p>Settings updated.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
	}

}
