<?php
/**********************************************************
 *
 * File:         Photo Divider (Single Image)
 * Description:  Displays one full-width image as a divider
 * Author:       Echo Web Solutions
 * Version:      v0.3
 * Modified:     17/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$image_id = get_field( 'divider_image' );

if ( $image_id ) :

    $image_url  = wp_get_attachment_url( $image_id );
    $file_type  = pathinfo( $image_url, PATHINFO_EXTENSION );
    $image_html = '';

    if ( strtolower( $file_type ) === 'svg' ) {
        $svg_path = get_attached_file( $image_id );
        if ( file_exists( $svg_path ) ) {
            $image_html = file_get_contents( $svg_path );
        }
    } else {
        $image_html = wp_get_attachment_image(
            $image_id,
            'full',
            false,
            [
                'class'   => 'img-fluid w-100 d-block',
                'loading' => 'lazy',
                'alt'     => '',
            ]
        );
    }
?>

    <section class="photo-divider">
            <div class="photo-divider-image text-center">
                <?php echo $image_html; ?>
            </div>
    </section>

<?php endif; ?>
