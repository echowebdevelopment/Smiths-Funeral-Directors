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
        <div class="row g-5">
            <div class="main-title col-12 col-xl-3">
                <h3 class="text-secondary"><?php echo esc_html($title); ?></h3>
                <div class="short-intro d-none d-xl-block"><?php echo $desc; ?></div>
            </div>
            <div class="col-12 col-xl-9">
                <?php if ( $data['use_grouped_menus'] == false ) : ?>
                <div class="row" id="<?php echo esc_attr($strippedparent); ?>">
                    <?php echo $menu; // Trusted HTML, so direct output ?>
                </div>
                <?php else : ?>
                <div class="row g-3 grouped-menus">
                    <?php foreach ( $data['grouped_menus'] as $menu_arr ) : ?>
                    <div class="col-12 col-md-6 col-xl-4" id="menu-<?php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $menu_arr['title']))); ?>">
                        <p class="menu-label h5 text-secondary fw-normal mb-3"><?php echo $menu_arr['title'] ?></p>
                        <?php echo $menu_arr['menu']; // Trusted HTML, so direct output ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    #menu-memorial .menu-label {
        cursor: pointer;
    }

    #menu-memorial .acf-nav-menu {
        display: none;
    }
</style>

<script>
    jQuery(function($) {
        $('#menu-our-service-room')
            .insertAfter('#menu-funeral-costs > .acf-nav-menu')
            .removeClass('col-12 col-md-6 col-xl-4')
            .addClass('mt-4 mt-xl-5');

        $('#menu-memorial')
            .insertAfter('#menu-our-service-room')
            .removeClass('col-12 col-md-6 col-xl-4')
            .addClass('mt-4 mt-xl-5');
        
        $('#menu-memorial .menu-label').on('click', function() {
            location.href="/memorials";
        });
    });
</script>