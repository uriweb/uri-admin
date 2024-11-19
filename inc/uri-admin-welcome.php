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
	$difference = $today - $from;
	?>
	<div class="custom-notice notice-yellow">
		<h2>This site's theme is going away in <?php echo floor($difference / 86400) * -1 ?> days.</h2>
		<h3>Why am I seeing this message?</h3>
		<p>This site is running a legacy URI WordPress theme, the regular maintenance of which ended in May 2018. In order to finish unifying the look and feel of URI's websites, meet ADA-compliance and responsiveness standards, and prepare for changes in underlying technologies, <strong>support for this theme will end on June 2, 2025</strong>.</p>
		<hr>
		<h3>What do I need to do?</h3>
		<p>In order to keep this site running, it will need to adopt the URI Modern theme by the end of May 2025.  Please <?php printf( __( '<a href="%s" target="_blank">' . __( 'contact Web Communications', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/legacy-theme-form/' ); ?> to start the process, either to migrate the site or archive it. In the coming weeks, we will also attempt to contact known site owners directly.</p>
		<p><strong>If you do not take action, the site will be archived on or shortly after June 2, 2025, and permanently deleted by January 9, 2026.</strong> We encourage you to let us know if the site is no longer needed so that we may archive it sooner.</p>
	</div>
	<?php
}

$current_theme = wp_get_theme();
$current_theme_name = $current_theme->get('Name');
if ( 'URI Responsive' == $current_theme_name || 'Themify Responz' == $current_theme_name || 'uri-department' == $current_theme_name ) {
	uri_admin_theme_deprecation_notice();
}

?>

<div class="custom-welcome-panel postbox">

	<div class="welcome-banner"></div>

	<div class="welcome-content">

		<h3 class="header"><?php _e( 'Don’t panic.', 'uri' ); ?> <span><?php _e( 'You’re using WordPress at URI.', 'uri' ); ?></span></h3>

		<p class="about-description"><?php _e( 'WordPress makes it easy and efficient to build websites for all our institutional needs.  We offer guides and documentation help to stay on-brand and deliver clear and useful content to our digital audience. And, we’re here to help when you need it.', 'uri' ); ?></p>

		<div class="welcome-cols">

			<div class="column">
				<h4><?php _e( 'Lay the groundwork', 'uri' ); ?></h4>
				<ul>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-wp-at-uri" target="_blank">' . __( 'About WordPress at URI', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/' ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-content-guide" target="_blank">' . __( 'URI Content Guide', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/' ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-components" target="_blank">' . __( 'Component Library', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/components/' ); ?></li>
					<li><?php printf( __( '<a href="%s" target="_blank">' . __( 'Get help', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/?your_site_url=' . urlencode( home_url( '/' ) ) . '&your_email=' . urlencode( wp_get_current_user()->user_email ) ); ?></li>
				</ul>
			</div>

			<div class="column">
				<h4><?php _e( 'Get started on your site', 'uri' ); ?></h4>
				<ul>
				<?php if ( 'page' !== get_option( 'show_on_front' ) ) : ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-get-started" target="_blank">' . __( 'Set up your front page', 'uri' ) . '</a>', 'https://wordpress.com/support/pages/front-page/' ); ?></li>
				<?php else: ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page', 'uri' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
				<?php endif; ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add a new page', 'uri' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site', 'uri' ) . '</a>', home_url( '/' ) ); ?></li>
			</div>

			<div class="column">
				<h4><?php _e( 'Using the media library', 'uri' ); ?></h4>
				<ul>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-images">' . __( 'Images', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/images/' ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'Documents', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/documents/' ); ?></li>
				</ul>
			</div>

			<?php if ( current_user_can( 'edit_theme_options' ) ): ?>
				
			<div class="column">
				<h4><?php _e( 'Advanced tasks', 'uri' ); ?></h4>
				<ul>
				<li class="hide-if-no-customize"><?php printf( '<a href="%s" class="welcome-icon welcome-customize">' . __( 'Customize your site', 'uri' ) . '</a>', admin_url( 'customize.php' ) ); ?></li>
					<li class="hide-if-no-customize"><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( '<a href="%s">Manage menus</a>' ) . '</div>', admin_url( 'nav-menus.php' ) ); ?></li>
					<!--li><?php printf( __( '<a href="%s" target="_blank">Learn about categories</a>' ), 'https://make.wordpress.org/support/user-manual/content/categories-and-tags/categories/' ); ?></li-->
				</ul>
			</div>
			<?php endif; ?>

		</div><!-- .welcome-cols -->

		<hr>

		<div class="disclaimer">
			<p>URI's web presence is directed by <a href="https://web.uri.edu/external-relations/contact-us/">Communications and Marketing</a>.</p>
			<p>Get in touch with the Web Communications team by <?php printf( __( '<a href="%s" target="_blank">' . __( 'requesting support', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/' ); ?> or emailing <a href="mailto:web-group@uri.edu">web-group@uri.edu</a>.</p>
		</div>

	</div><!-- .welcome-content -->

</div><!-- .custom-welcome-panel -->
