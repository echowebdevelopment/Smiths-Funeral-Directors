<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Displays the page title and optional image with breadcrumbs
 * Author:       Echo Web Solutions
 * Version:      v0.4
 * Modified:     17/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

// Get heading size or default to 'h1'
$valid_headings = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
$heading_size = get_field( 'heading_size' );
$heading_size = in_array( $heading_size, $valid_headings ) ? $heading_size : 'h1';

// Get ACF heading or fallback to page title

$acf_heading = get_field( 'heading_page_title' );
$heading_text = $acf_heading
    ?: ( $args['title'] ?? null )
    ?: get_the_title();

// Generate heading HTML
$heading = sprintf(
	'<%1$s class="text-block__heading">%2$s</%1$s>',
	esc_attr( $heading_size ),
	esc_html( $heading_text )
);

// Get ACF image or fallback to theme image
$acf_image_id = get_field( 'image_page_title' );
$image_url = '';

if ( $acf_image_id ) {
	$image_url = wp_get_attachment_image_url( $acf_image_id, 'full' );
} else {
	// Fallback image path inside your theme folder
	$image_url = get_template_directory_uri() . '/img/banner-default.jpg';
}

// Get image position class (e.g. left, right, center)
$position_image = get_field( 'position_image_page_title' );
$image_position_class = $position_image ? 'img-' . sanitize_html_class( $position_image ) : 'img-center';

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

	<?php if ( $image_url ) : ?>
		<img 
			src="<?php echo esc_url( $image_url ); ?>"
			class="text-block__img img-fluid <?php echo esc_attr( $image_position_class ); ?>"
			loading="lazy"
			alt="<?php echo esc_attr( $heading_text ); ?>"
		/>
	<?php endif; ?>
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

<script>
	jQuery(function($) {
		function moveHeader() {
			var $header = $('.text-block__header.mb-0'); // Target regardless of position

			if ($(window).width() < 576) {
				if ($header.parent().is('.page-title-block')) {
					$header.insertAfter('.page-title-block');
				}
			} else {
				if (!$header.parent().is('.page-title-block')) {
					$header.prependTo('.page-title-block');
				}
			}
		}

		moveHeader(); // Run on page load
		$(window).on('resize', moveHeader); // Run on resize
	});
</script>