<?php
/**********************************************************
 *
 * File:         Pull Quote Block
 * Description:  ACF-based block for displaying a quote with optional image and attribution
 * Author:       Echo Web Solutions
 * Version:      v1.3
 * Modified:     18/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$image_id       = get_field( 'quote_image' );
$text           = get_field( 'quote_text' );
$name           = get_field( 'quote_name' );
$image_position = get_field( 'quote_image_position' ) === 'left' ? 'order-md-1' : 'order-md-2';
$content_order  = ( $image_position === 'order-md-1' ) ? 'order-md-2' : 'order-md-1';
?>

<section class="pull-quote-block py-0 bg-primary">
    <?php if ( $image_id ) : ?>
        <!-- With Image: Full-width row using container-fluid -->
            <div class="row w-100 no-gutters align-items-stretch">
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
                                ]
                            );
                        }
                        ?>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-md-6 d-flex align-items-center <?php echo esc_attr( $content_order ); ?>">
                    <div class="p-5 w-100">
                       

                        <?php if ( $text ) : ?>
                            <blockquote class="pull-quote-text mb-4">
                                <?php echo wp_kses_post( $text ); ?>
                            </blockquote>
                        <?php endif; ?>

                        <?php if ( $name ) : ?>
                            <p class="pull-quote-name mb-0">
                                <?php echo esc_html( $name ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    <?php else : ?>
        <!-- No Image: Centered content -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">

                    <?php if ( $text ) : ?>
                        <blockquote class="pull-quote-text mb-4">
                            <?php echo wp_kses_post( $text ); ?>
                        </blockquote>
                    <?php endif; ?>

                    <?php if ( $name ) : ?>
                        <p class="pull-quote-name mb-0">
                            <?php echo esc_html( $name ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
