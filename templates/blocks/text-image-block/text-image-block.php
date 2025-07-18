<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Page Header
 * Author:       Echo Web Solutions
 * Version:      v0.3
 * Modified:     18/07/25
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// ACF Fields
$heading_size     = get_field( 'heading_size_image' );
$subheading_size  = get_field('subheading_size_image');
$text_align       = get_field( 'text_alignment_image' ); // New text alignment field
$acf_heading      = get_field( 'heading_text_image' );
$acf_subheading   = get_field('subheading_text_image');
$lead_paragraph   = get_field( 'lead_paragraph_text_image' );
$content          = get_field( 'content_text_image' );
$acf_image        = get_field( 'image_text_image' );
$position_image   = get_field( 'position_image_text_image' );

// Layout helpers
$has_image     = !empty($acf_image);
$auxClass      = $has_image ? "flex-wrap" : "";
$auxCenter     = $text_align ? 'text-' . $text_align : ''; // text-left, text-center, text-right
$auxaMargin    = $content ? '' : 'mb-0';

if ($position_image === "left") {
    $auxClass = "flex-row-reverse";
}

// Format heading & subheading
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', esc_attr($heading_size), esc_html($acf_heading)) : '';
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading">%2$s</%1$s>', esc_attr($subheading_size), esc_html($acf_subheading)) : '';
?>

<div class="text-block text-image-block block block--margin">
	<div class="container">
		<div class="row justify-content-center align-items-center g-5 <?php echo esc_attr($auxClass); ?>">

			<div class="col-12 <?php echo $has_image ? 'col-xl-6 order-2 order-xl-0 mt-5 mt-xl-0' : 'col-xl-12'; ?>">
				<?php if( $heading || $subheading ) : ?>
					<div class="text-block__header <?php echo esc_attr($auxCenter . ' ' . $auxaMargin); ?>">
						<?php echo $heading; ?>
						<?php echo $subheading; ?>
					</div>
				<?php endif; ?>

				<?php if( $content ) : ?>
					<?php echo $content; ?>
				<?php endif; ?>
				<?php if ( have_rows('buttons_text_image') ) : ?>
						<div class="block-buttons <?php echo esc_attr($auxCenter . ' ' . $auxaMargin); ?>">
							<?php while ( have_rows('buttons_text_image') ) : the_row(); 
								$link  = get_sub_field('link');
								$theme = get_sub_field('theme');

								if ( empty($link) ) continue;

								echo sprintf(
									'<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>',
									esc_attr($theme),
									esc_url($link['url']),
									esc_attr($link['target']),
									esc_html($link['title'])
								);
							endwhile; ?>
						</div>
					<?php endif; ?>
			</div>

			<?php if ( $has_image ) : ?>
				<div class="col-12 col-xl-6 order-1 order-xl-0">
					<?php
						$alt = get_post_meta($acf_image, '_wp_attachment_image_alt', true);
						echo wp_get_attachment_image($acf_image, 'full', false, array(
							'class' => 'text-block__img img-fluid',
							'loading' => 'lazy',
							'alt' => esc_attr($alt)
						));
					?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>
