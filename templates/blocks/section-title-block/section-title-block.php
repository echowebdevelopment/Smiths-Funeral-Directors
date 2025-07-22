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
$align_class = 'text-' . esc_attr($alignment);

// Output
?>
<section class="section-title-block block block--margin">
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
</section>
