<?php
/**********************************************************
 *
 * File:         Text Block Section with Repeater
 * Description:  Displays a section title and multiple image-text blocks
 * Author:       Echo Web Solutions
 * Version:      v0.3.2
 * Modified:     23/07/25
 *
 **********************************************************/
defined('ABSPATH') || exit;

$section_title = get_field('page_section_title');
?>

<section class="text-block text-image-block echo-block <?php echo esc_attr($block['className'] ?? ''); ?>">
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
<div class="py-5">
<?php if ($section_title) : ?>
    <div class="section-title text-center">
        <h2><?php echo esc_html($section_title); ?></h2>
    </div>
<?php endif; ?>

<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row();

        // Sub Fields inside repeater
        $heading_size     = get_sub_field('heading_size_image');
        $subheading_size  = get_sub_field('subheading_size_image');
        $text_align       = get_sub_field('text_alignment_image');
        $acf_heading      = get_sub_field('heading_text_image');
        $acf_subheading   = get_sub_field('subheading_text_image');
        $lead_paragraph   = get_sub_field('lead_paragraph_text_image');
        $content          = get_sub_field('content_text_image');
        $acf_image        = get_sub_field('image_text_image');
        $image_label      = get_sub_field('image_label');
        $position_image   = get_sub_field('position_image_text_image');

        // Layout helpers
        $has_image     = !empty($acf_image);
        $auxClass      = $has_image ? 'flex-wrap' : '';
        $auxCenter     = $text_align ? 'text-' . $text_align : '';
        $auxaMargin    = $content ? '' : 'mb-0';
        $paddClass     = 'pe-4';

        if ($position_image === 'left') {
            $auxClass .= ' flex-row-reverse';
            $paddClass     = 'pe-4';
        }

        // Format heading & subheading
        $heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', esc_attr($heading_size), esc_html($acf_heading)) : '';
        $subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading">%2$s</%1$s>', esc_attr($subheading_size), esc_html($acf_subheading)) : '';
        $has_heading = $heading || $subheading;
        ?>

            <div class="container py-3 py-md-5">
                <div class="row justify-content-center align-items-center gx-5 <?php echo esc_attr($auxClass); ?>">

                    <div class="col-12 <?php echo $has_image ? 'col-xl-6 order-2 order-xl-0' : 'col-xl-12'; ?>">
                        <div class="pe-4">
                            <?php if ($has_heading) : ?>
                                <div class="text-block__header text-secondary <?php echo esc_attr(trim("$auxCenter $auxaMargin")); ?>">
                                    <?php echo $heading; ?>
                                    <?php echo $subheading; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($content) : ?>
                                <div class="text-secondary <?php echo esc_attr(trim("$auxCenter")); ?>">
                                    <?php echo wp_kses_post($content); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (have_rows('buttons_text_image')) : ?>
                            <div class="block-buttons <?php echo esc_attr(trim("$auxCenter $auxaMargin")); ?>">
                                <?php while (have_rows('buttons_text_image')) : the_row();
                                    $link  = get_sub_field('link');
                                    $theme = get_sub_field('theme');

                                    if (empty($link)) continue;

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

                    <?php if ($has_image) : ?>
                        <div class="col-12 col-xl-6 order-1 order-xl-0 mt-0 mb-3 mb-md-0 text-center">
                            <?php
                            $alt = get_post_meta($acf_image, '_wp_attachment_image_alt', true);
                            if (!$alt) {
                                $attachment = get_post($acf_image);
                                $alt = $attachment ? $attachment->post_title : '';
                            }

                            echo wp_get_attachment_image($acf_image, 'full', false, array(
                                'class'   => 'text-block__img img-fluid',
                                'loading' => 'lazy',
                                'alt'     => esc_attr($alt),
                            ));

                            echo '<p class="mt-2">'.$image_label.'</p>';
                            ?>
                        </div>
                    <?php endif; ?>

            </div>
        </div>

    <?php endwhile; ?>
<?php endif; ?>
</div>
</section>
