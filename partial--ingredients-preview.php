<?php
    $max_ingredients = 6;

    // Get ingredients with images
    $ingredients_with_photos = apply_filters( 'taxonomy-images-get-terms', '', array(
        'taxonomy' => 'ingredient'
    ) );

    // Shuffle ingredient list every time
    shuffle($ingredients_with_photos);

    // Limit the number of ingredients to be displayed
    $ingredients = array_slice($ingredients_with_photos, 0, $max_ingredients);

?>

<!-- INGREDIENTS PREVIEW -->
<section>
    <div class="row column">
        <h2>Featured ingredients</h2>
        <p>Discover recipes based on an ingredient.</p>
    </div>

    <ul class="ingredients-view">
        <?php foreach( $ingredients as $ingredient ) { ?>
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
    <?php if (!is_page(['ingredients'])) { ?>
        <div class="row columns">
            <a class="button secondary button--view-more" href="/ingredients">More ingredients</a>
        </div>
    <?php } ?>
</section>