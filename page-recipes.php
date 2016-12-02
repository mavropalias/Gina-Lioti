<?php get_header(); ?>

<?php
    $do_not_duplicate = array();
?>

<div class="column row">
    <h1 class="title">Recipes</h1>
</div>




<!-- A–TO–Z LIST -->
<!-- ======================================================================= -->

    <section class="section--mini section--with-separator">
        <ul class="list-view">
            <li class="list-item has-indicator"><a href="recipes-a-to-z">See A&ndash;to&ndash;Z list of all my recipes</a></li>
        </ul>
    </section>





<!-- RECIPE OF THE WEEK -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            'tag' => 'recipe-of-the-week',
            'posts_per_page' => 1
        );
        // The query
        $query = new WP_Query( $args );

        // The Loop ?>
        <?php 
        if ( $query->have_posts() ) { 
            $query->the_post(); 
            
            $do_not_duplicate[] = $post->ID;

            $recipeDescription = [];
            $recipeDescriptionTemp = explode("\r", apply_filters('get_the_content', get_the_content()));
            // Clean up the description array
            for ($i = 0; $i < count($recipeDescriptionTemp); $i++) {
                // Remove empty lines
                if (strlen($recipeDescriptionTemp[$i]) > 1) {
                    // Remove [wpurp] tag
                    if(($tagPos =  strpos($recipeDescriptionTemp[$i], "[wpurp")) !== false ) {
                        $recipeDescription[] = substr($recipeDescriptionTemp[$i], 0, $tagPos);
                    } else {
                        $recipeDescription[] = $recipeDescriptionTemp[$i];
                    }
                }
            }
            ?>
            
            <section class="recommended-item expanded">
                <div class="row">
                    <div class="shrink columns">
                        <img class="thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_advice.jpg">
                    </div>
                    <div class="columns">
                        <p>My recipe of the week is:</p>
                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                        <p class="lead">"<?php echo $recipeDescription[0]; ?>"</p>
                        <cite>Gina Lioti</cite>
                    </div>
                </div>

                <div class="row expanded">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail', array( 'class' => 'cover-photo' ))); ?>
                    </a>
                </div>
            </section>

    <?php } wp_reset_postdata(); ?>





<!-- FEATURED RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            'tag' => 'featured',
            'post__not_in' => $do_not_duplicate
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;

            set_query_var( 'recipesToPreviewTitle', "Featured recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- NEW RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "New recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- MAIN RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            // 'tag' => "",
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'name',
                    'terms'    => 'main',
                ),
            ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "Main-dish recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- VEGETARIAN RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            'tag' => "vegetarian",
            'post_status' => 'publish',
            // 'tax_query' => array(
            //     array(
            //         'taxonomy' => 'course',
            //         'field'    => 'name',
            //         'terms'    => 'main',
            //     ),
            // ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "Vegetarian recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- SWEET RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            // 'tag' => "",
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'name',
                    'terms'    => 'sweet',
                ),
            ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "Sweet recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- SAVOURY RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            // 'tag' => "",
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'name',
                    'terms'    => 'savoury',
                ),
            ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "Savoury recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- GLUTEN-FREE RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            'tag' => "gluten-free",
            'post_status' => 'publish',
            // 'tax_query' => array(
            //     array(
            //         'taxonomy' => 'course',
            //         'field'    => 'name',
            //         'terms'    => 'savoury',
            //     ),
            // ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "Gluten-free recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- MORE RECIPES -->
<!-- ======================================================================= -->

    <?php
        $args = array(
            'post_type' => 'recipe',
            // 'tag' => "gluten-free",
            'post_status' => 'publish',
            // 'tax_query' => array(
            //     array(
            //         'taxonomy' => 'course',
            //         'field'    => 'name',
            //         'terms'    => 'savoury',
            //     ),
            // ),
            'orderby' => 'rand',
            'post__not_in' => $do_not_duplicate,
            // 'posts_per_page' => 4,
        );

        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            foreach ($query->posts as $recipe) $do_not_duplicate[] = $recipe->ID;
            
            set_query_var( 'recipesToPreviewTitle', "More recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<?php get_template_part( 'partial--ingredients-preview' ); ?>
<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_footer(); ?>