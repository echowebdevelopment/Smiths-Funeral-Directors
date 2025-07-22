<?php
/**********************************************************
 *
 * File:         Team Block (CPT)
 * Description:  Displays all team members from CPT with ACF fields
 * Author:       Echo Web Solutions
 * Version:      v1.4
 * Modified:     21/07/25
 *
 **********************************************************/

defined('ABSPATH') || exit;

// WP Query
$args = [
    'post_type'      => 'team',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
];

$team_query = new WP_Query($args);

if ($team_query->have_posts()): ?>
<section class="teams-block py-5">
    <div class="container">

        <!-- Optional Page Heading -->
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-8">
                <?php if ($heading = get_field('team_heading')): ?>
                    <h2 class="section-title"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>

                <?php if ($intro = get_field('team_intro')): ?>
                    <p class="lead text-muted"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Team Members -->
        <div class="row justify-content-center">
            <?php while ($team_query->have_posts()): $team_query->the_post();
                $post_id    = get_the_ID();
                $image_url  = get_the_post_thumbnail_url($post_id, 'medium');
                $title      = get_the_title();
                $position   = get_field('team_position', $post_id);
                $about_me   = get_field('about_me', $post_id);
                $modal_id   = 'teamModal-' . $post_id;
            ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="team-card h-100">
                    
                    <?php if ($image_url): ?>
                        <img loading="lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="mb-3 w-100" style="object-fit: cover; aspect-ratio: 1/1;">
                    <?php endif; ?>

                    <h3 class="mb-1 text-secondary team-card_title"><?php echo esc_html($title); ?></h3>
                    <p class="team-card_position mb-2">
                        <?php echo esc_html($position ?: 'Team Member'); ?>
                    </p>

                    <?php if ($about_me): ?>
                        <div class="mb-3">
                            <?php echo wp_kses_post(wp_trim_words($about_me, 25, '...')); ?>
                        </div>

                        <!-- Read Bio Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo esc_attr($modal_id); ?>">
                            Read Bio
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($about_me): ?>
            <!-- Bootstrap Modal -->
            <div class="modal fade" id="<?php echo esc_attr($modal_id); ?>" tabindex="-1" aria-labelledby="<?php echo esc_attr($modal_id); ?>Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content shadow p-4">
                        <div class="modal-body ">
                            <div class="row">
                                <div class="col-md-4 p-3">
                                    <?php if ($image_url): ?>
                                        <img loading="lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="mb-3" style="object-fit: cover; aspect-ratio: 1/1;">
                                    <?php endif; ?>
                                    <h3 class="mb-1 text-secondary team-card_title" id="<?php echo esc_attr($modal_id); ?>Label"><?php echo esc_html($title); ?></h3>
                                    <p class="team-card_position mb-3"><?php echo esc_html($position); ?></p>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-8 p-3">
                                    <div class="modal-text">
										<h3 class="mb-1 text-secondary team-card_title">My Biography</h3>
                                        <?php echo wp_kses_post(wpautop($about_me)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
