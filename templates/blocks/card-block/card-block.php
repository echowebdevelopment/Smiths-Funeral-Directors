<?php
/**********************************************************
 *
 * File:         Card Block
 * Description:  ACF-based block that shows a section of cards
 * Author:       Echo Web Solutions
 * Version:      v1.0
 * Modified:     18/07/25
 *
 **********************************************************/

defined( 'ABSPATH' ) || exit;

$section_title       = get_field( 'section_title' );
$section_description = get_field( 'section_description' );
$cards               = get_field( 'cards' );
?>

<?php if ( $cards ) : ?>
<section class="card-block <?php echo esc_attr($block['className']); ?>">
    <div class="container">
        <?php if ( $section_title ) : ?>
            <h2 class="text-center mb-3"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <?php if ( $section_description ) : ?>
            <div class="text-center mb-5 text-muted">
                <?php echo wp_kses_post( $section_description ); ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <?php foreach ( $cards as $card ) :
                $title = $card['card_title'];
                $image = $card['card_image'];
                $link  = $card['card_link'];
                $image_url = $image ? wp_get_attachment_image_url( $image, 'medium' ) : '';
                $image_alt = $image ? get_post_meta( $image, '_wp_attachment_image_alt', true ) : '';
                $url = $link['url'] ?? '#';
                $target = $link['target'] ?? '_self';
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                     <?php if ( $link ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>" class="" target="<?php echo esc_attr( $target ); ?>">
                    <?php endif; ?>
                        <div class="card h-100 border-0 bg-white p-0">

                            <div class="card-body d-flex flex-column">
                                <?php if ( $title ) : ?>
                                    <h3 class="card-title"><?php echo esc_html( $title ); ?></h3>
                                <?php endif; ?>
                            </div>
                            <?php if ( $image_url ) : ?>
                                <div class="card-img-wrapper">
                                    <img src="<?php echo esc_url( $image_url ); ?>" class="card-img-top img-fluid" alt="<?php echo esc_attr( $image_alt ); ?>" />
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php if ( $link ) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
