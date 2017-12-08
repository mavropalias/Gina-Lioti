<?php get_header(); ?>

<?php
    $max_ingredients = 12;
    $args = array(
        'taxonomy' => 'ingredient',
        'hide_empty' => true
    );

    // Get all ingredients
    $ingredients_raw = apply_filters( 'taxonomy-images-get-terms', '', array(
        'taxonomy' => 'ingredient',
        'having_images' => false
    ) );

    // Get ingredients with images
    $ingredients_with_photos = apply_filters( 'taxonomy-images-get-terms', '', array(
        'taxonomy' => 'ingredient'
    ) );

    // Shuffle ingredient list every time
    shuffle($ingredients_with_photos);

    // Shuffle ingredient list every time
    $ingredients = array_slice($ingredients_with_photos, 0, $max_ingredients);

    // print_r($ingredients);
?>

<div class="column row">
    <h1 class="title">Ingredients</h1>
</div>





<!-- INGREDIENT OF THE WEEK -->
<!-- ======================================================================= -->

    <?php
        // print_r($ingredients[0]);
    ?>
    <section class="recommended-item expanded">
        <div class="row">
            <div class="shrink columns">
                <img class="thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_advice.jpg">
            </div>
            <div class="columns">
                <p class="lead">&ldquo;I want to make you appreciate the seasonality, locality, variability and quality of cooking ingredients.&rdquo;</p>
                <cite>Gina Lioti</cite><br>
            </div>
        </div>
        <div class="row column">
            <a href="<?php echo get_term_link($ingredients[0]->term_id); ?>"><h2><?php echo ucfirst($ingredients[0]->name); ?></h2></a>
        </div>
        <div class="row expanded">
            <a href="<?php echo get_term_link($ingredients[0]->term_id); ?>">
                <?php
                    echo wp_get_attachment_image ($ingredients[0]->image_id, 'post-thumbnail', '', array(
                        'class' => 'cover-photo',
                        'alt' => $ingredients[0]->name,
                        'title' => "Click to see recipes made with ".$ingredients[0]->name
                    ));
                ?>
            </a>
        </div>
    </section>





<!-- FEATURED INGREDIENTS -->
<!-- ======================================================================= -->

    <?php get_template_part( 'partial--ingredients-preview' ); ?>





<!-- ALL INGREDIENTS A–TO–Z -->
<!-- ======================================================================= -->

    <section>
        <div class="row column">
            <h2>Alphabetical list of all ingredients</h2>
            <p>Find your favourite one and discover tasty and healthy recipes.</p>
        </div>
        <ul class="ingredients-view">
            <?php foreach( $ingredients_raw as $ingredient ) { ?>
                <li class="ingredient">
                    <a class="ingredient-inner"
                        title="<?php echo ucfirst($ingredient->name); ?> recipes"
                        href="<?php echo get_term_link($ingredient->term_id); ?>">
                        <div class="ingredient-thumb">
                            <div class="hexagon-1">
                                <div class="hexagon-2" title="<?php echo ucfirst($ingredient->name); ?>" style="background-image: url(<?php echo wp_get_attachment_image_url($ingredient->image_id, 'ingredient-thumb'); ?>); background-image: -webkit-image-set(url(<?php echo wp_get_attachment_image_url($ingredient->image_id, 'ingredient-thumb'); ?>) 1x, url(<?php echo wp_get_attachment_image_url($ingredient->image_id, 'ingredient-thumb-2x'); ?>) 2x, url(<?php echo wp_get_attachment_image_url($ingredient->image_id, 'ingredient-thumb-3x'); ?>) 3x);"></div>
                            </div>
                        </div>
                        <div class="ingredient-details">
                            <span class="ingredient-name"><?php echo ucfirst($ingredient->name); ?></span>
                            <small class="ingredient-meta"><?php echo $ingredient->count; ?> recipe<?php if($ingredient->count > 1) echo "s"; ?></small>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </section>





<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_footer(); ?>