<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'echo_container_type' );
$phone = get_field( 'phone', 'option' );
?>
<div class="top-nav">
	<div class="container-fluid d-flex justify-content-between align-items-center">
		<!-- Your site branding in the menu -->
		<?php get_template_part( 'global-templates/navbar-branding' ); ?>
		<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'top-menu',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav d-none d-sm-flex',
					'fallback_cb'     => '',
					'menu_id'         => '',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
		?>
		<div class="phone-number d-none d-lg-block">
			<span>24 Hours Service</span>
			<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
		</div>
		<a class="btn btn-primary" href="/contact-us/">
			Contact Us
		</a>
	</div>
</div>
<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-primary" aria-labelledby="main-nav-label">

	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</h2>


	<div class="container-fluid">
		<div class="phone-number d-block d-lg-none">
			<span>Call us on</span>
			<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
		</div>
			
		<button
			class="navbar-toggler"
			type="button"
			data-bs-toggle="offcanvas"
			data-bs-target="#navbarNavOffcanvas"
			aria-controls="navbarNavOffcanvas"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
		>
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="navbarNavOffcanvas">

			<div class="offcanvas-header justify-between">
				<button class="btn btn-secondary btn-close-mega" type="button" data-bs-dismiss="dropdown" aria-label="Close menu"><i class="icon-chevron_left"></i> Back</button>
				<button
					class="btn btn-primary text-reset"
					type="button"
					data-bs-dismiss="offcanvas"
					aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>"
				>Close</button>
			</div><!-- .offcancas-header -->

			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'offcanvas-body',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav justify-content-center flex-grow-1 pe-3',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div><!-- .offcanvas -->

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->
