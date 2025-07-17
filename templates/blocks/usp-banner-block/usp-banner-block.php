<?php
/**********************************************************
 *
 * File:         USP Banner
 * Description:  Displays a row of USP items (image + title + description)
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     17/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

if ( have_rows( 'usp_items' ) ) : ?>
	<section class="usp-banner py-5 bg-gray">
		<div class="container">
			<div class="usp-slider text-center">
				<?php while ( have_rows( 'usp_items' ) ) : the_row();

					$image_id   = get_sub_field( 'usp_image' );
					$title      = get_sub_field( 'usp_title' );
					$desc       = get_sub_field( 'usp_description' );
					$image_html = '';

					if ( $image_id ) {
						$image_url = wp_get_attachment_url( $image_id );
						$file_type = pathinfo( $image_url, PATHINFO_EXTENSION );

						if ( strtolower( $file_type ) === 'svg' ) {
							$svg_path = get_attached_file( $image_id );
							if ( file_exists( $svg_path ) ) {
								$image_html = file_get_contents( $svg_path );
							}
						} else {
							$image_html = wp_get_attachment_image(
								$image_id,
								'medium',
								false,
								[
									'class'   => 'mb-3 img-fluid usp-icon',
									'loading' => 'lazy',
									'alt'     => esc_attr( $title ),
								]
							);
						}
					}
				?>
					<div class="usp-item px-3">
						<?php if ( $image_html ) : ?>
							<div class="usp-image mb-3">
								<?php echo $image_html; ?>
							</div>
						<?php endif; ?>

						<?php if ( $title ) : ?>
							<h3 class="usp-title h5"><?php echo esc_html( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $desc ) : ?>
							<p class="usp-description text-muted"><?php echo $desc; ?></p>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
