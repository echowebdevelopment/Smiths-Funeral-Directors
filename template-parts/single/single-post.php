<div class="bg-gray py-3">
	<div class="container-fluid">
		<?php
		// ✅ Yoast Breadcrumbs
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div id="breadcrumbs" class="text-secondary">', '</div>' );
		}
		?>
	</div>
</div>
<?php
    $post_details = array(
        "ID"        => get_the_ID(),
        "image"     => get_the_post_thumbnail_url( null, 'full' ),
        "tag"       => get_the_terms( get_the_ID(), "category" ),
        "title"     => get_the_title(),
        "button"    => array(
            "title"     => "Read Article",
            "target"    => "_self",
            "url"       => get_the_permalink()
                    ),
        "author"    => array(
            "name"      => get_the_author_meta( "display_name" ),
        ),
        "date"      => get_the_date( "d M Y" )
    );
?>
           
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-12 text-center mb-5">
            <h1 class="fw-light post_title mb-3"><?php echo $post_details["title"] ?></h1>
            <p class="fw-normal"><?php echo $post_details["date"] ?></p>
        </div>
        <?php if($post_details["image"]) { ?>
            <div class="col-6 col-lg-6">
        <?php } else { ?> 
            <div class="col-12 col-lg-12">
        <?php } ?>
           <?php the_content() ?>
        </div>
        <?php if($post_details["image"]) { ?>
            <div class="col-6 col-lg-6 align-items-center d-flex justify-content-center">
                <img src="<?php echo $post_details["image"] ?>">
            </div>
        <?php } ?>
    </div>
<div class="container text-center footer-btn mt-5">
    <div class="btn-container">
        <a href="/community-news/" class="btn btn-primary">See more articles</a>
    </div>
</div>
</div>
