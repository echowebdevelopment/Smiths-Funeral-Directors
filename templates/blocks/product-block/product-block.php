<?php
$args = array(
    'post_type'      => 'product', // your custom post type
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);

$query = new WP_Query($args);

if ($query->have_posts()): ?>
    <div class="product-feed block block--margin">
        <div class="container">
            <div class="row">
                <?php while ($query->have_posts()):
                    $query->the_post();
                    $title = get_the_title();
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
                    
                    <div class="col-6 col-md-4 col-lg-3 product-feed__item">
                        <div class="product-card">
                            <?php if ($image_url): ?>
                                <div class="product-card__image">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="product-card__title bg-primary p-4 fw-normal">
                                <h4><?php echo esc_html($title); ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
