<?php
/**********************************************************
 *
 * File:         Testimonial Slider
 * Description:  Displays testimonial CPT entries in a slick slider
 * Author:       Echo Web Solutions
 * Version:      1.0
 * Modified:     18/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$section_title      = get_field( 'testimonial_section_title' );
$show_google_rating = get_field( 'show_google_rating' );

// Query testimonials CPT
$testimonials = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => 3,
    'post_status'    => 'publish'
]);
?>

<section class="testimonial-slider-section <?php echo esc_attr($block['className']); ?>">
    <div class="container py-5">
        <?php if ( $section_title ) : ?>
            <div class="text-center">
                <h2 class="section-title fw-light"><?php echo esc_html( $section_title ); ?></h2>
            </div>
        <?php endif; ?>

        <?php if ( $show_google_rating ) : ?>
            <?php echo do_shortcode( '[trustindex no-registration=google]' ); ?>
        <?php endif; ?>

        <?php if ( $testimonials->have_posts() ) : ?>
            <div class="testimonial-slider slick-slider mt-5">
                <?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
                    <div class="testimonial-item position-relative">
                        <i class="icon-speech-mark-open"></i>
                        <div class="testimonial-content mb-3">
                            <?php the_content(); ?>
                        </div>
                        <div class="testimonial-author">
                            <?php the_title(); ?>
                        </div>
                        <i class="icon-speech-mark-close"></i>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p class="text-center text-muted">No testimonials available.</p>
        <?php endif; ?>
    </div>
</section>
