<?php
// Get selected category from ACF
$category = get_field('product_category');

// Build the query
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);

if ($category) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product-category',
            'field'    => 'term_id',
            'terms'    => $category->term_id,
        ),
    );
}

$query = new WP_Query($args);

if ($query->have_posts()): ?>
    <section class="product-feed echo-block <?php echo esc_attr($block['className'] ?? ''); ?>">
        <div class="py-5">
        <div class="container">
            <h2 class="section-title mb-5">
                <?php echo $category ? esc_html($category->name) : 'Our Products'; ?>
            </h2>
            <div class="row g-5">
                <?php while ($query->have_posts()):
                    $query->the_post();
                    $title     = get_the_title();
                    $post_id   = get_the_ID();
                    $image_url = get_the_post_thumbnail_url($post_id, 'medium'); ?>
                    
                    <div class="col-12 col-md-4 col-lg-3 product-feed__item">
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
        <?php if (have_rows('background_sections')) : ?>
            <?php while (have_rows('background_sections')) : the_row(); 
                $image = get_sub_field('image'); // image array
                $position = get_sub_field('background_position'); // select string like 'center center'

                if ($image) :
                    $url = esc_url($image['url']);
                    $alt = esc_attr($image['alt']);
                    $position_class = str_replace(' ', '-', strtolower($position)); // e.g. 'center-center'
            ?>
                    <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="echo-background position-<?php echo esc_attr($position_class); ?>" />
            <?php endif; endwhile; ?>
    <?php endif; ?>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>