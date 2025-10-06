<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'echo_container_type' );
$company_name = get_field( 'company_name', 'option' );
$phone = get_field( 'phone', 'option' );
$email = get_field( 'email', 'option' );
$address = get_field( 'address', 'option' );
$directions = get_field( 'directions', 'option' );
$facebook = get_field( 'facebook', 'option' );
$instagram = get_field( 'instagram', 'option' );
$x = get_field( 'x', 'option' );
$linkedin = get_field( 'linkedin', 'option' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div id="main-footer">
		<div class="row">
			<div class="col-lg-3 bg-white p-5" id="footer-branding">
				<?php the_custom_logo(); ?>
				<div class="nap">
					<?php if( $phone ) : ?>
						<div class="phone-number">
							<span>Call us on</span>
							<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
						</div>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<div class="email-address">
							<span>Email us</span>
							<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
						</div>
					<?php endif; ?>
				</div>
					<ul class="social-icons list-unstyled d-flex">
						<?php if ( $facebook ) : ?>
							<li>
								<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer">
									<i class="icon-Facebook"></i>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $instagram ) : ?>
							<li>
								<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer">
									<i class="icon-instagram"></i>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $x ) : ?>
							<li>
								<a href="<?php echo esc_url( $x ); ?>" target="_blank" rel="noopener noreferrer">
									<i class="icon-X_logo"></i>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $linkedin ) : ?>
							<li>
								<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer">
									<i class="icon-LinkedIn"></i>
								</a>
							</li>
						<?php endif; ?>			
					</ul>
			</div>
			<div class="col-lg-9 bg-gray p-5" id="footer-menus">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<h3 class="footer-title">Quick links</h3>
						<?php
							wp_nav_menu(array(
								'theme_location' => 'quick-links',
								'menu_class'     => 'menu quick-links-menu',
							));

						?>
					</div>
					<div class="col-lg-3 col-sm-6">
						<h3 class="footer-title">Support</h3>
						<?php
							wp_nav_menu(array(
								'theme_location' => 'support',
								'menu_class'     => 'menu support-menu',
							));
						?>
					</div>
					<div class="col-lg-3 col-sm-6">
						<h3 class="footer-title">Information</h3>
						<?php
							wp_nav_menu(array(
								'theme_location' => 'information',
								'menu_class'     => 'menu information-menu',
							));
						?>
					</div>
					<div class="col-lg-3 col-sm-6">
						<h3 class="footer-title">How to find us</h3>
						<?php if ( $company_name ) : ?>
							<div class="company-name">
								<?php echo esc_html( $company_name ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $address ) : ?>
							<div class="address">
								<?php echo  $address; ?>
							</div>
						<?php endif; ?>
						<?php if ( $directions ) : ?>
							<div class="directions">
								<a href="<?php echo esc_url( $directions ); ?>" target="_blank" rel="noopener noreferrer">
									Get Directions
								</a>			
							</div>
						<?php endif; ?>
					</div>
				</div>

				<hr class="my-5 text-secondary">

				<div class="row align-items-center">
					<div class="col-12 col-xl-6 row align-items-center">
						<div class="col-sm-3 col-6 text-center">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/golden-charter-logo.png' ); ?>" alt="Golden Charter Logo" class="golden-charter-logo">
						</div>
						<div class="col-sm-3 col-6 text-center">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/saif-new.png' ); ?>" alt="SAIF Logo">
						</div>
						<div class="col-sm-3 col-6 text-center">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/bielogo.png' ); ?>" alt="Golden Charter Logo" class="Bie Logo">
						</div>
						<div class="col-sm-3 col-6 text-center">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/iso-logo.svg' ); ?>" alt="ISO Logo">
						</div>
					</div>
					<div class="col-12 col-xl-6 row">
						<div class="col-12">
							Peterborough Funeral Services Ltd trading as Smiths Funeral Directors, is an appointed representative of Golden Charter Limited trading as Golden Charter Funeral Plans which is authorised and regulated by the Financial Conduct Authority (FRN:965279).
						</div>
					</div>
				</div>
			</div>	
		</div>
</div>
<div class="wrapper bg-secondary text-white" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info py-3 text-center">

						© Peterborough Funeral Services Ltd <?php echo date('Y') ?>. Website Design by <a href="https://www.echowebsolutions.co.uk/web-design-peterborough/"><img class="echo-logo" src="<?php echo get_template_directory_uri() .'/img/echo-logo.svg' ?>" alt="Echo"><br>
						The content on this website is owned by us and our licensors. Do not copy any content (including images) without our consent.

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!-- col -->

		</div><!-- .row -->

	</div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

