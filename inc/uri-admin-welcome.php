<?php
function custom_admin_notice() {
    ?>
    <div class="custom-notice notice-<?php _e( get_site_option( 'uri_admin_color' ), 'uri' )?> ">
		<h2><?php _e( get_site_option( 'uri_admin_heading' ), 'uri' ); ?></h2>
        <p><?php _e( get_site_option( 'uri_admin_content' ), 'uri' ); ?></p>
    </div>
    <?php
}

if ( get_site_option( 'uri_admin_content' ) != '' ) {
	custom_admin_notice();
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

			<?php if ( current_user_can( 'customize' ) ): ?>
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
			<p>Get in touch with the Web Communications team by <?php printf( __( '<a href="%s" target="_blank">' . __( 'requesting support', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/?your_site_url=' . urlencode( home_url( '/' ) ) . '&your_email=' . urlencode( wp_get_current_user()->user_email ) ); ?> or emailing <a href="mailto:web-group@uri.edu">web-group@uri.edu</a>.</p>
		</div>

	</div><!-- .welcome-content -->

</div><!-- .custom-welcome-panel -->
