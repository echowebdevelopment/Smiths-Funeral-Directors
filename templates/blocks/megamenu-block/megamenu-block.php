<?php

// Set default structure
$defaults = array(
    'data' => array()
);

// Merge with incoming arguments
$args = wp_parse_args($args, $defaults);
$data = $args['data'];

// Extract values with default fallbacks
$title = isset($data['title']) ? $data['title'] : '';
$desc = isset($data['short_description']) ? $data['short_description'] : '';
$menu = isset($data['menu']) ? $data['menu'] : '';

// Generate ID-safe string
$parent = $title;
$strippedparent = function_exists('clean') ? clean($parent) : sanitize_title($parent);

?>

<div class="position-relative echo-mega-menu padding w-100">
    <div class="container-fluid py-3">
        <div class="row">
            <div class="main-title col-12 col-xl-3">
                <h3 class="text-secondary"><?php echo esc_html($title); ?></h3>
                <div class="short-intro d-none d-xl-block"><?php echo $desc; ?></div>
            </div>
            <div class="col-12 col-xl-9">
                <div class="row" id="<?php echo esc_attr($strippedparent); ?>">
                    <?php echo $menu; // Trusted HTML, so direct output ?>
                </div>
            </div>
        </div>
    </div>
</div>
