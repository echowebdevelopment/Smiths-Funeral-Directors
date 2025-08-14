<?php
/**********************************************************
 *
 * File:         Section Title Block
 * Description:  Outputs a section title with optional subheading and text
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     22/07/25
 *
 **********************************************************/

defined('ABSPATH') || exit;

// ACF Fields
$headings         = get_field('heading');
$subheading      = get_field('subheading');
$lead_text       = get_field('lead_text');
$alignment       = get_field('alignment') ?: 'center'; // default to center
$heading_tag     = get_field('heading_tag') ?: 'h2';
$subheading_tag  = get_field('subheading_tag') ?: 'h4';

// Class for text alignment
$align_class = 'text-left text-sm-' . esc_attr($alignment);

// Output
?>
<section id="<?php echo esc_attr($block['anchor'] ?? ''); ?>" class="section-title-block echo-block <?php echo esc_attr($block['className'] ?? ''); ?>" >
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-block__header <?php echo $align_class; ?>">
				<?php if ($subheading): ?>
					<<?php echo esc_attr($subheading_tag); ?> class="text-block__subheading">
						<?php echo esc_html($subheading); ?>
					</<?php echo esc_attr($subheading_tag); ?>>
				<?php endif; ?>

				<?php if ($headings): ?>
					<<?php echo esc_attr($heading_tag); ?> class="text-block__heading">
						<?php echo esc_html($headings); ?>
					</<?php echo esc_attr($heading_tag); ?>>
				<?php endif; ?>

				<?php if ($lead_text): ?>
					<div class="lead"><?php echo $lead_text; ?></div>
				<?php endif; ?>
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
