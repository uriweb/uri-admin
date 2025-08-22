<?php
/**
 * Display a custom notice set in the network settings
 */
function uri_admin_custom_admin_notice() {
    ?>
    <div class="custom-notice notice-<?php _e( get_site_option( 'uri_admin_color' ), 'uri' )?> ">
		<h2><?php _e( get_site_option( 'uri_admin_heading' ), 'uri' ); ?></h2>
        <p><?php _e( get_site_option( 'uri_admin_content' ), 'uri' ); ?></p>
    </div>
    <?php
}

if ( get_site_option( 'uri_admin_content' ) != '' ) {
	uri_admin_custom_admin_notice();
}

/**
 * Display a deprecation notice on sites running legacy themes
 */
function uri_admin_theme_deprecation_notice() {
	date_default_timezone_set('America/New_York');
	$from = strtotime('2025-06-02');
	$today = time();
	$remaining = floor( ($today - $from) / 86400) * -1;
	$text = "This site's theme has reached end of life. The site will be archived shortly.";
	if ( 0 < $remaining ) {
		$text = "This site's theme is going away " . ($remaining == 1 ? "tomorrow" : "in $remaining days") . ".";
	}
	?>
	<div class="custom-notice notice-red">
		<h2><?php echo $text ?></h2>
		<h3>Why am I seeing this message?</h3>
		<p>This site is running a legacy URI WordPress theme, the regular maintenance of which ended in May 2018. In order to finish unifying the look and feel of URI's websites, meet ADA-compliance and responsiveness standards, and prepare for changes in underlying technologies, <strong>support for this theme <?php echo ($remaining < 0 ? "ended" : "will end"); ?> on June 2, 2025</strong>.</p>
		<hr>
		<h3>What do I need to do?</h3>
		<p>In order to keep this site running, it will need to adopt the URI Modern theme by the end of May 2025.  Over the past several months, Web Communications has attempted to contact site owners to determine how best to handle each site. Please <?php printf( __( '<a href="%s" target="_blank">' . __( 'contact Web Communications', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/legacy-theme-form/' ); ?> if you are unsure or have questions about what will happen to this site after June 2, 2025.</p>
		<p><strong>If you do not take action, the site will be archived on or shortly after June 2, 2025, and permanently deleted by January 9, 2026.</strong> Note that, even after the site is archived, it may not be fully recoverable. We encourage you to let us know if the site is no longer needed so that we may archive it sooner.</p>
	</div>
	<?php
}

$current_theme = wp_get_theme();
$current_theme_name = $current_theme->get('Name');
if ( 'URI Responsive' == $current_theme_name || 'Themify Responz' == $current_theme_name || 'uri-department' == $current_theme_name ) {
	uri_admin_theme_deprecation_notice();
}

?>

<div class="custom-welcome-panel postbox <?php echo uri_admin_get_season()?>-background">

	<div class="welcome-banner <?php echo uri_admin_get_season()?>-banner"></div>

	<div class="welcome-content">

		<h3 class="header"><?php _e( 'Welcome to Wordpress at URI', 'uri' ); ?> </h3>

		<p class="about-description"><?php _e( 'We\'ve assembled some guides and documentation to help you stay on-brand and deliver clear and useful content to our digital audience. And, we’re here to help when you need it.', 'uri' ); ?></p>

		<div class="welcome-cols">

			<div class="column-admin">
				<h4 class="column-head"><?php _e( 'Start Here', 'uri' ); ?></h4>
				<ul>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-wp-at-uri" target="_blank">' . __( 'About WordPress at URI', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/' ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-content-guide" target="_blank">' . __( 'URI Content Guide', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/' ); ?></li>
</ul>
			</div>

			<div class="column-admin">
				<h4 class="column-head"><?php _e( 'How To', 'uri' ); ?></h4>
				<ul>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-accessibility" target="_blank">' . __( 'Make Your Site Accessible', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/accessibility/' ); ?></li>
			
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-components" target="_blank">' . __( 'Use URI Components', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/components/' ); ?></li>
</ul>
				</div>

			<div class="column-admin">
				<h4 class="column-head"><?php _e( 'Using the Media Library', 'uri' ); ?></h4>
				<ul>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-images">' . __( 'Images', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/images/' ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'Documents', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/documents/' ); ?></li>
				</ul>
			</div>

</div><!-- .welcome-cols -->

		<div class="support-column">
		<h4 class="column-head"><?php _e( 'Get Help', 'uri' ); ?></h4>
		<ul>
			<li class="support-link"><?php printf( '<a href="%s" class="welcome-icon welcome-common-issues">' . __( 'Troubleshoot Common Issues', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/request/support/' ); ?></li>
			<li class="support-link"><?php printf( '<a href="%s" class="welcome-icon welcome-support">' . __( 'Request Support', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/request/' ); ?></li>
		</ul>
			</div>


		<hr>

		<div class="disclaimer">
			<p>URI's web presence is directed by <a href="https://web.uri.edu/external-relations/contact-us/">Communications and Marketing</a>.</p>
			<p>Get in touch with the Web Communications team by <?php printf( __( '<a href="%s" target="_blank">' . __( 'requesting support', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/' ); ?> or emailing <a href="mailto:web-group@uri.edu">web-group@uri.edu</a>.</p>
		</div>

	</div><!-- .welcome-content -->

</div><!-- .custom-welcome-panel -->
