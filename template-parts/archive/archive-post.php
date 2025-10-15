<?php get_header(); ?>

<?php 
// get_template_part( 'templates/blocks/page-title-block/page-title', 'block', [ 
//     'title' => 'Community & News', // Or use get_post_type_archive_title()
// ] );
?>

<div class="page-title-block block py-5">
    <div class="text-block__header mb-0">
        <h1 class="text-block__heading">Community &amp; News</h1>
    </div>
    <img src="<?php echo get_template_directory_uri(); ?>/img/community-news-header.jpg" class="text-block__img img-fluid img-center" loading="lazy" alt="Community &amp; News">
</div>

<div class="container py-5">
    <?php
    // Ensure correct pagination
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    // Optional: Modify the query if needed (only if using a custom post type)
    $args = [
        'post_type'      => 'post', // Change to your post type slug, or 'post'
        'posts_per_page' => 6,
        'paged'          => $paged,
    ];
    $news_query = new WP_Query($args);
    ?>

    <?php if ($news_query->have_posts()) : ?>
        <div class="row g-4">
            <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card post-card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php 
                                    $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                                    the_post_thumbnail('full', [
                                        'class' => 'card-img-top',
                                        'loading' => 'lazy',
                                        'alt' => esc_attr($alt ?: get_the_title()),
                                    ]);
                                ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column p-4">
                            <h3 class="fw-light">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="card-text">
                                <?php echo wp_trim_words(strip_tags(get_the_excerpt()), 20); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between p-4 mt-auto">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                            <small class="post-date"><?php echo get_the_date(); ?></small>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="mt-5">
            <?php
            $pagination = paginate_links([
                'type'        => 'array',
                'mid_size'    => 2,
                'current'     => $paged,
                'total'       => $news_query->max_num_pages,
                'prev_next'   => false, // disables "Previous" and "Next"
            ]);

            if ($pagination) :
            ?>
                <nav aria-label="News pagination">
                    <ul class="pagination justify-content-center">
                        <?php foreach ($pagination as $page) : ?>
                            <li class="page-item<?php echo (strpos($page, 'current') !== false) ? ' active' : ''; ?>">
                                <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>



        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<div id="footer-image">
<img src="<?php echo esc_url( get_template_directory_uri() . '/img/footer-bg.jpg' ); ?>" alt="immaculate Limousines">
</div>

<?php get_footer(); ?>
