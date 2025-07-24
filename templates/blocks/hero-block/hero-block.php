<?php
/**********************************************************
 *
 * File:         Hero Slider
 * Description:  Hero block with multiple slides, each with heading, image, button, rating
 * Author:       Echo Web Solutions
 * Version:      v0.8
 * Modified:     23/07/25
 *
 **********************************************************/

defined('ABSPATH') || exit;

$slides = get_field('hero_slides');

if (!$slides) {
    return;
}
// Rating toggle
$show_rating = get_field('hero_show_rating');
?>
<section class="<?php echo esc_attr($block['className'] ?? ''); ?>">
<div id="heroCarousel" class="carousel slide hero-slider" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php foreach ($slides as $index => $slide):
            // Heading setup
            $heading_size = in_array($slide['heading_size'], ['h1','h2','h3','h4','h5','h6']) ? $slide['heading_size'] : 'h1';
            $heading = $slide['heading'] ?: get_the_title();

            // Image
            $image_url = $slide['image']
                ? wp_get_attachment_image_url($slide['image'], 'full')
                : get_template_directory_uri() . '/img/banner-default.jpg';

            // Button
            $button = $slide['button'];

        ?>

        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="page-title-block block py-5 text-white position-relative">
				<div class="text-block__header mb-0">
                    <<?php echo esc_attr($heading_size); ?> class="text-block__heading">
                        <?php echo esc_html($heading); ?>
                    </<?php echo esc_attr($heading_size); ?>>

                    <?php if ($button): ?>
                        <div class="mt-3">
                            <a 
                                href="<?php echo esc_url($button['url']); ?>" 
                                class="btn btn-primary"
                                <?php echo $button['target'] ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                                <?php echo esc_html($button['title']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
					</div>

                    <?php if ( $image_url ) : ?>
						<img 
							src="<?php echo esc_url( $image_url ); ?>"
							class="text-block__img img-fluid"
							loading="eager"
						/>
					<?php endif; ?>
                </div>
        </div>

        <?php endforeach; ?>
    </div>

    <?php if ($show_rating): ?>
		<div class="mt-3 hero-rating">
			<?php echo do_shortcode('[trustindex no-registration=google]') ?>
		</div>
	<?php endif; ?>
</div>
</section>