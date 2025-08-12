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
$cta_title           = get_field( 'cta_title' );
$cta_blurb           = get_field( 'cta_blurb' );
$buttons             = get_field( 'buttons' );
?>

<?php if ( $cards ) : ?>
<section class="card-block echo-block <?php echo esc_attr($block['className'] ?? ''); ?>">
    <div class="py-5">
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
            <?php if ( $cta_title  ) : ?>
                <h3 class="text-center mt-5 mb-3"><?php echo esc_html( $cta_title  ); ?></h3>
            <?php endif; ?>

            <?php if ( $cta_blurb ) : ?>
                <div class="text-blurb-container text-center mb-3">
                    <?php echo wp_kses_post( $cta_blurb ); ?>
                </div>
            <?php endif; ?>
            <?php if (have_rows('buttons')) : ?>
                <div class="block-buttons text-center">
                    <?php while (have_rows('buttons')) : the_row();
                    $link  = get_sub_field('link');
                    if (empty($link)) continue;
                        echo sprintf(
                            '<a class="btn btn-primary" href="%1$s" target="%2$s">%3$s</a>',
                            esc_url($link['url']),
                            esc_attr($link['target']),
                            esc_html($link['title'])
                        );
                    endwhile; ?>
                </div>
            <?php endif; ?>
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

    </div>
</section>
<?php endif; ?>
