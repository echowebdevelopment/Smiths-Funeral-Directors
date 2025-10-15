<div class="row justify-content-center">
    <div class="col-12 col-lg-12">
        <?php the_content() ?>
        <div id="footer-image">
            <?php
                if ( get_field( 'footer_image', get_the_ID() ) ) {
                    echo wp_get_attachment_image( get_field( 'footer_image', get_the_ID() )['ID'] , 'full', false, array(
                        'loading' => 'lazy',
                        'alt'     => get_the_title(),
                    ));
                } else {
                    echo '<img src="' . esc_url( get_template_directory_uri() . '/img/footer-bg.jpg' ) . '" alt="immaculate Limousines">';
                }
            ?>
        </div>
    </div>
</div>