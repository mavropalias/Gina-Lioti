<?php get_header(); ?>

<?php
    // Create query for recipes with current ingredient
    $args = array(
        'post_type' => 'recipe',
        'posts_per_page' => 100,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'ingredient',
                'field'    => 'name',
                'terms'    => [single_term_title(null, false)],
            ),
        ),
    );
    // The query
    $query = new WP_Query( $args );
?>





<!-- TITLE -->
<!-- ======================================================================= -->

    <div class="row column">
        <h1 class="title" itemprop="name"><?php echo ucfirst(single_term_title("", false)); ?> recipes</h1>
        <p>
            Learn more about <?php single_term_title(); ?> as an ingredient in traditional and moden recipes. Explore my curated list of original recipes with <?php single_term_title(); ?>.
        </p>
    </div>





<!-- PHOTO -->
<!-- ======================================================================= -->

    <div class="row expanded">
        <?php
            // featured image
            // $coverImage = get_post_thumbnail_id();

            // $image_xxs  = wp_get_attachment_image_src( $coverImage, 'xxs' );
            // $image_xs  = wp_get_attachment_image_src( $coverImage, 'xs' );
            // $image_s  = wp_get_attachment_image_src( $coverImage, 's' );
            // $image_m = wp_get_attachment_image_src( $coverImage, 'm' );
            // $image_l  = wp_get_attachment_image_src( $coverImage, 'l' );
            // $image_xl  = wp_get_attachment_image_src( $coverImage, 'xl' );
            // $image_xxl  = wp_get_attachment_image_src( $coverImage, 'xxl' );

            // $image_meta = wp_get_attachment_image($coverImage);
        ?>
        <!--<img class="cover-photo"
            src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>"
            alt="<?php echo $image_meta['alt']; ?>"
            title="<?php echo $image_meta['title']; ?>" />-->
            <?php 
            if (function_exists('z_taxonomy_image')) {
                echo(z_taxonomy_image(get_cat_ID(), 'post-thumbnail', array( 'class' => 'cover-photo' ))); 
            }?>
    </div>
    
    



<!-- GINA'S COMMENT -->
<!-- ======================================================================= -->

    <section></section>
    <section class="recommended-item expanded">
        <div class="row">
            <div class="shrink columns">
                <img class="thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_advice.jpg">
            </div>
            <div class="columns">
                <p class="lead">“I have prepared <?php echo $query->found_posts; ?> recipes with <?php single_term_title(); ?>. I want you to enjoy them and think you will.”</p>
                <cite>Gina Lioti</cite>
            </div>
        </div>
    </section>





<!-- DESCRIPTION -->
<!-- ======================================================================= -->

    <?php if ( strlen(term_description()) > 0 ) { ?>
    <section>
        <div class="row column">
            <h2>A little bit about <?php single_term_title(); ?></h2>

            <?php echo term_description(); ?>
        </div>
    </section>
    <?php } ?>





<!-- RECIPES WITH THIS INGREDIENT -->
<!-- ======================================================================= -->

    <?php
        if ($query->found_posts > 0) {
            set_query_var( 'recipesToPreviewTitle', "My ".$query->found_posts." recipes with ".single_term_title(null, false) );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- COOKING CLUB -->
<!-- ======================================================================= -->

    <?php get_template_part( 'partial--cooking-club-preview' ); ?>





<?php get_footer(); ?>