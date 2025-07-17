<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Displays the page title and optional image with breadcrumbs
 * Author:       Echo Web Solutions
 * Version:      v0.3
 * Modified:     17/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

// Get heading size or default to 'h1'
$heading_size = get_field( 'heading_size' ) ?: 'h1';

// Get ACF heading or fallback to page title
$acf_heading = get_field( 'heading_page_title' );
$heading_text = $acf_heading ?: get_the_title();

// Generate heading HTML
$heading = sprintf(
	'<%1$s class="text-block__heading">%2$s</%1$s>',
	esc_attr( $heading_size ),
	esc_html( $heading_text )
);

// Get ACF image or fallback to attachment ID 70
$acf_image_id = get_field( 'image_page_title' );
$acf_image_id = $acf_image_id ?: 70;

// Get image position class (e.g. left, right, center)
$position_image = get_field( 'position_image_page_title' );
$image_position_class = $position_image ? 'img-' . sanitize_html_class( $position_image ) : '';

// Optional layout classes
$auxCenter = '';     // Add 'text-center' if needed
$auxaMargin = 'mb-0';
?>

<div class="page-title-block block py-5">

		<?php if ( $heading ) : ?>
			<div class="text-block__header <?php echo esc_attr( trim( "$auxCenter $auxaMargin" ) ); ?>">
				<?php echo $heading; ?>
			</div>
		<?php endif; ?>

		<?php
		// ✅ Display Image
		if ( $acf_image_id ) {
			echo wp_get_attachment_image(
				$acf_image_id,
				'full',
				false,
				[
					'class'   => "text-block__img img-fluid $image_position_class",
					'loading' => 'lazy',
					'alt'     => esc_attr( $heading_text ),
				]
			);
		}
		?>
</div>
<div class="bg-gray py-3">
	<div class="container-fluid">
		<?php
			// ✅ Yoast Breadcrumbs
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div id="breadcrumbs" class="text-secondary">', '</div>' );
			}
		?>
	</div>
</div>
