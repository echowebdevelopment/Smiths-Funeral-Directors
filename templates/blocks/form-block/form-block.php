<?php
/**********************************************************
 *
 * File:         Contact Form 7 Select Block
 * Description:  Renders a CF7 form selected via ACF field
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     22/07/25
 *
 **********************************************************/

defined('ABSPATH') || exit;

// Get the selected form
$form_id = get_field('select_cf7_form');

if (!$form_id) return;

// Optional: alignment or title
$form_title  = get_field('form_title') ?: '';
$alignment   = get_field('alignment') ?: 'left';
$align_class = 'text-' . esc_attr($alignment);
?>

<section class="cf7-block <?php echo esc_attr($block['className']); ?>">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 <?php echo esc_attr($align_class); ?>">

				<?php if ($form_title): ?>
					<h2 class="cf7-block__title"><?php echo esc_html($form_title); ?></h2>
				<?php endif; ?>

				<?php echo do_shortcode('[contact-form-7 id="' . intval($form_id) . '"]'); ?>

			</div>
		</div>
	</div>
</section>
