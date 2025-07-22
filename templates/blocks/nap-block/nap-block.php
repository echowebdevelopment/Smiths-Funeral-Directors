<?php
/**********************************************************
 *
 * File:         NAP + Map Block
 * Description:  Displays Name, Address, Phone with Google Map
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     22/07/25
 *
 **********************************************************/

defined('ABSPATH') || exit;

// ACF fields
$business_name = get_field('company_name', 'option');
$address       = get_field('address', 'option');
$phone         = get_field('phone', 'option');
$email         = get_field('email', 'option');
$map           = get_field('google_map');
$alignment     = get_field('alignment') ?: 'left'; // default

// Alignment helper
$align_class = 'text-' . esc_attr($alignment);

// Map check
$has_map = !empty($map);
$company_name = get_field( 'company_name', 'option' );
$phone = get_field( 'phone', 'option' );
$email = get_field( 'email', 'option' );
$address = get_field( 'address', 'option' );
$directions = get_field( 'directions', 'option' );
?>

<section class="nap-map-block block">
		<div class="row g-5 align-items-start">
			<div class="col-12 <?php echo $has_map ? 'col-lg-3 col-md-4 col-sm-5' : 'col-lg-12'; ?> p-5 <?php echo $align_class; ?>">
                    
                        <p class="nap-title">How to find us</p>
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
                        <div class="nap mt-5">
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
				
			</div>

			<?php if ($has_map): ?>
				<div class="col-12 col-lg-9 col-md-8 col-sm-7 nap-map">
                    <?php echo $map  ?>
				</div>
			<?php endif; ?>
		</div>
</section>
