<?php get_header(); ?>

<?php 
get_template_part( 'templates/blocks/page-title-block/page-title', 'block', [ 
    'title' => 'Latest News',
] );

?>
<div class="container py-5">

    <?php if (have_posts()) : ?>
        <div class="row g-4">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card post-card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column p-4">
                            <h3 class="fw-light">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="card-text">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between p-4">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-auto">Read More</a> <small class="post-date"><?php echo get_the_date(); ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="mt-5">
            <?php
            $pagination = paginate_links([
                'type'      => 'array',
                'mid_size'  => 2,
                'prev_text' => __('« Previous', 'textdomain'),
                'next_text' => __('Next »', 'textdomain'),
                'current'   => max(1, get_query_var('paged')), // <== this line ensures correct current page
                'total'     => $wp_query->max_num_pages       // optional, helps with accuracy
            ]);

            if ($pagination) :
            ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php foreach ($pagination as $page) : ?>
                            <li class="page-item <?php echo strpos($page, 'current') !== false ? 'active' : ''; ?>">
                                <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
