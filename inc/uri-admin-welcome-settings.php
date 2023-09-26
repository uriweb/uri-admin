<?php
/**
 * Create admin settings menu for the URI Admin Plugin
 *
 * @package uri-admin
 */

 /**
 * Register settings
 */
function uri_admin_register_settings() {

    register_setting(
        'uri_admin',
        'uri_admin_heading',
        'sanitize_text_field'
    );

    register_setting(
        'uri_admin',
        'uri_admin_content',
        'sanitize_text_field'
    );

    register_setting(
        'uri_admin',
        'uri_admin_color'
    );

    add_settings_section(
        'uri_admin_settings',
        __( 'URI Admin Settings', 'uri' ),
        'uri_admin_settings_section',
        'uri_admin'
    );

    // register field
    add_settings_field(
        'uri_admin_heading', // id: as of WP 4.6 this value is used only internally
		__( 'Heading', 'uri' ), // title
		'uri_admin_heading_field', // callback
		'uri_admin', // page
		'uri_admin_settings', //section
		array( //args
			'label_for' => 'uri-admin-field-heading',
			'class' => 'uri_admin_row',
		)
	);
    
    add_settings_field(
        'uri_admin_content', // id: as of WP 4.6 this value is used only internally
		__( 'Content', 'uri' ), // title
		'uri_admin_content_field', // callback
		'uri_admin', // page
		'uri_admin_settings', //section
		array( //args
			'label_for' => 'uri-admin-field-content',
			'class' => 'uri_admin_row',
		)
	);

    add_settings_field(
        'uri_admin_color', // id: as of WP 4.6 this value is used only internally
		__( 'Color', 'uri' ), // title
		'uri_admin_color_field', // callback
		'uri_admin', // page
		'uri_admin_settings', //section
		array( //args
			'label_for' => 'uri-admin-field-color',
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
	$intro = 'URI Admin can display information.';
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
    // check user capabilities
	// on web.uri, we have to leave this pretty loose
	// because web com doesn't have admin privileges.
	if ( ! current_user_can( 'manage_options' ) ) {
		echo '<div id="setting-message-denied" class="updated settings-error notice is-dismissible">
<p><strong>You do not have permission to save this form.</strong></p>
<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		return;
	}
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
function uri_admin_heading_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_admin_heading' );
	// output the field
	?>
		<input type="text" class="regular-text" aria-describedby="uri-admin-field-heading" name="uri_admin_heading" id="uri-admin-field-heading" value="<?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?>">
		<p class="uri-admin-field-heading">
			<?php
				esc_html_e( 'Provide a heading for the message', 'uri' );
			?>
		</p>
	<?php
}

function uri_admin_content_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_admin_content' );
	// output the field
	?>
		<textarea class="regular-text" aria-describedby="uri-admin-field-content" name="uri_admin_content" id="uri-admin-field-content" value="<?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?>"></textarea>
		<p class="uri-admin-field-content">
			<?php
				esc_html_e( 'Provide the content for the message', 'uri' );
			?>
		</p>
	<?php
}

function uri_admin_color_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_admin_color' );
	// output the field
	?>
		<select class="regular-select" aria-describedby="uri-admin-field-color" name="uri_admin_color" id="uri-admin-field-color" value="<?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?>">
	<option value="no_color">--No color--</option>
		<option value="red">Red</option>
	<option value="yellow">Yellow</option>
	<option value="red">Green</option>
</select>
		<p class="uri-admin-field-color">
			<?php
				esc_html_e( 'Select the border color for the message', 'uri' );
			?>
		</p>
	<?php
}
 /**
* Save the Settings
*/


/**
 * Add admin notice
 */

