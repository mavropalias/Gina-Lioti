<?php
    $max_ingredients = 6;
    $args = array(
        'taxonomy' => 'ingredient',
        'hide_empty' => true
    );

    // Get all ingredients
    $ingredients_raw = get_terms( $args );

    // Keep only ingredients with photos
    $ingredients_with_photos = [];
    foreach( $ingredients_raw as $ingredient ) {
        if (strlen(z_taxonomy_image_url($ingredient->term_id)) > 0) $ingredients_with_photos[] = $ingredient; 
    }

    shuffle($ingredients_with_photos);

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
                    href="<?php echo get_category_link($ingredient->term_id); ?>">
                    <div class="ingredient-thumb">
                        <div class="hexagon-1">
                            <div class="hexagon-2" title="<?php echo ucfirst($ingredient->name); ?>" style="background-image: url(<?php 
                                if (function_exists('z_taxonomy_image_url')) {
                                    echo(z_taxonomy_image_url($ingredient->term_id, 'ingredient-thumb' )); 
                                }?>);"></div>
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