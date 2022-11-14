<div class="custom-warning postbox">
<h2><?php _e( 'Notice: Content Freeze 11/28 - 11/29', 'uri' ); ?></h2>
<p class="notice-description"><?php _e( 'Due to a scheduled server migration, there will be a content freeze from November 28 - 29. This means that any changes made to the website during this period will dissapear on November 30, and we ask that content editors plan accordingly.', 'uri' ); ?></p>
</div>

<div class="custom-welcome-panel postbox">

	<h3><?php _e( 'You’re using URI WordPress.', 'uri' ); ?></h3>

	<p class="about-description"><?php _e( 'Don’t Panic.', 'uri' ); ?></p>

	<div class="welcome-cols">

		<div class="column">
			<h4><?php _e( 'Let\'s get started', 'uri' ); ?></h4>
			<ul>
			<?php if ( 'page' !== get_option( 'show_on_front' ) ) : ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-get-started" target="_blank">' . __( 'Set up your front page', 'uri' ) . '</a>', 'https://wordpress.com/support/pages/front-page/' ); ?></li>
			<?php else: ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page', 'uri' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
			<?php endif; ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add a new page', 'uri' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site', 'uri' ) . '</a>', home_url( '/' ) ); ?></li>
			<li><?php printf( __( '<a href="%s" target="_blank">How to create content</a>' ), 'https://make.wordpress.org/support/user-manual/content/' ); ?></li>
		</div>

		<?php if ( current_user_can( 'customize' ) ): ?>
		<div class="column">
			<h4><?php _e( 'Next steps', 'uri' ); ?></h4>
			<ul>
				<li class="hide-if-no-customize"><?php printf( '<a href="%s" class="welcome-icon welcome-customize">' . __( 'Customize your site', 'uri' ) . '</a>', admin_url( 'customize.php' ) ); ?></li>
				<li class="hide-if-no-customize"><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( '<a href="%s">Manage menus</a>' ) . '</div>', admin_url( 'nav-menus.php' ) ); ?></li>
				<li class="hide-if-no-customize"><?php printf( '<div class="welcome-icon welcome-widgets">' . __( '<a href="%s">Manage widgets</a>' ) . '</div>', admin_url( 'widgets.php' ) ); ?></li>
				<li class="hide-if-no-customize"><?php printf( __( '<a href="%s">Edit your site settings</a>' ), admin_url( 'options-general.php' ) ); ?></li>
				<!--li><?php printf( __( '<a href="%s" target="_blank">About categories</a>' ), 'https://make.wordpress.org/support/user-manual/content/categories-and-tags/categories/' ); ?></li-->
			</ul>
		</div>
		<?php endif; ?>

		<div class="column">
			<h4><?php _e( 'WordPress at URI', 'uri' ); ?></h4>
			<ul>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-wp-at-uri" target="_blank">' . __( 'About WordPress at URI', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/' ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-content-guide" target="_blank">' . __( 'URI Content Guide', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/content-guide/' ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-components" target="_blank">' . __( 'About URI components', 'uri' ) . '</a>', 'https://www.uri.edu/wordpress/components/' ); ?></li>
				<li><?php printf( __( '<a href="%s" target="_blank">' . __( 'Get help', 'uri' ) . '</a>' ), 'https://www.uri.edu/wordpress/request/support/?your_site_url=' . urlencode( home_url( '/' ) ) . '&your_email=' . urlencode( wp_get_current_user()->user_email ) ); ?></li>
			</ul>
		</div>

	</div><!-- .welcome-cols -->

</div><!-- .custom-welcome-panel -->
