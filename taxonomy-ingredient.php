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
            print apply_filters( 'taxonomy-images-queried-term-image', '', array(
                'attr'       => array(
                    'alt'   => ucfirst(single_term_title("", false)),
                    'class' => 'cover-photo',
                    'title' => ucfirst(single_term_title("", false)),
                    ),
                'image_size' => 'post-thumbnail'
            ) );
            ?>
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
                <p class="lead">“I have prepared <?php echo $query->found_posts; ?> recipe<?php if( $query->found_posts > 1 ) echo "s"; ?> with <?php single_term_title(); ?>. I want you to enjoy <?php if( $query->found_posts > 1 ) echo "them"; else echo "it"; ?> and think you will.”</p>
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
            $plural = "";
            if( $query->found_posts > 1 ) $plural = "s";

            set_query_var( 'recipesToPreviewTitle', "My ".$query->found_posts." recipe".$plural." with ".single_term_title(null, false) );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- COOKING CLUB -->
<!-- ======================================================================= -->

    <?php get_template_part( 'partial--cooking-club-preview' ); ?>





<?php get_footer(); ?>