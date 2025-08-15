<?php
/**********************************************************
 *
 * File:         Advert Feature Block
 * Description:  ACF-based block for advertising a feature
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     17/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$image_id       = get_field( 'advert_image' );
$heading        = get_field( 'advert_heading' );
$text           = get_field( 'advert_text' );
$button         = get_field( 'advert_button' );
$image_position = get_field( 'image_position' ) === 'left' ? 'order-md-1' : 'order-md-2';
$content_order  = ( $image_position === 'order-md-1' ) ? 'order-md-2' : 'order-md-1';
?>

<section class="advert-feature-block echo-block <?php echo esc_attr($block['className'] ?? ''); ?>">
    <?php if ( $image_id ) : ?>
        <!-- With Image: Full-width row using container-fluid -->
         
            <div class="row no-gutters align-items-stretch">
                <!-- Image Column -->
                <div class="col-md-6 <?php echo esc_attr( $image_position ); ?> p-0">
                    <div class="h-100 w-100 image-container">
                        <?php
                        $image_url = wp_get_attachment_url( $image_id );
                        $file_type = pathinfo( $image_url, PATHINFO_EXTENSION );

                        if ( strtolower( $file_type ) === 'svg' ) {
                            $svg_path = get_attached_file( $image_id );
                            if ( file_exists( $svg_path ) ) {
                                echo '<div class="h-100 d-flex align-items-center justify-content-center">';
                                echo file_get_contents( $svg_path );
                                echo '</div>';
                            }
                        } else {
                            echo wp_get_attachment_image(
                                $image_id,
                                'full',
                                false,
                                [
                                    'class'   => 'img-cover w-100 h-100 object-fit-cover',
                                    'loading' => 'lazy',
                                    'alt'     => esc_attr( $heading ),
                                ]
                            );
                        }
                        ?>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-md-6 d-flex align-items-center <?php echo esc_attr( $content_order ); ?>">
                    <div class="px-3 p-sm-5 py-5 w-100">
                        <?php if ( $heading ) : ?>
                            <h2 class="advert-heading mb-3"><?php echo esc_html( $heading ); ?></h2>
                        <?php endif; ?>

                        <?php if ( $text ) : ?>
                            <div class="advert-text mb-4">
                                <?php echo wp_kses_post( $text ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $button ) : ?>
                            <a href="<?php echo esc_url( $button['url'] ); ?>"
                               class="btn btn-primary"
                               target="<?php echo esc_attr( $button['target'] ?: '_self' ); ?>">
                                <?php echo esc_html( $button['title'] ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <!-- No Image: Standard content width -->
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <?php if ( $heading ) : ?>
                        <h2 class="advert-heading mb-3"><?php echo esc_html( $heading ); ?></h2>
                    <?php endif; ?>

                    <?php if ( $text ) : ?>
                        <div class="advert-text">
                            <?php echo wp_kses_post( $text ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <?php if ( $button ) : ?>
                        <a href="<?php echo esc_url( $button['url'] ); ?>"
                           class="btn btn-primary btn-lg"
                           target="<?php echo esc_attr( $button['target'] ?: '_self' ); ?>">
                            <?php echo esc_html( $button['title'] ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
    <?php endif; ?>
</section>
