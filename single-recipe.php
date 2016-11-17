<?php get_header(); ?>

<?php
  // init variables
  $meta = get_post_meta( get_the_ID() );
  $ingredients = unserialize($meta['recipe_ingredients'][0]);
  $directions = unserialize($meta['recipe_instructions'][0]);

  // Ingredient groups
  $ingredientGroups = array();
  $previous_group = null;
  foreach( $ingredients as $ingredient ) {
      $group = isset( $ingredient['group'] ) ? $ingredient['group'] : '';

      if( $group !== $previous_group ) {
          $ingredientGroups[] = $group;
          $previous_group = $group;
      }
  }

  // Direction groups
  $directionGroups = array();
  $previous_group = null;
  foreach( $directions as $direction ) {
      $group = isset( $direction['group'] ) ? $direction['group'] : '';

      if( $group !== $previous_group ) {
          $directionGroups[] = $group;
          $previous_group = $group;
      }
  }


?>

<div class="row column">
    <h1 class="title" itemprop="name"><?php the_title(); ?></h1>
    <p>
        <span itemprop="recipeCategory"><?php
        $courses = wp_get_post_terms($post->ID, 'course', array("fields" => "names"));
        if (count($courses) > 0) {
            echo "A ".($courses[0])."-dish";
        } else {
            echo "An original";
        }
        ?></span> recipe, by Gina Lioti.
    </p>
</div>

<div class="row hide">
    <div class="small-12 columns callout"><u>This is a healthy recipe! See why.</u></div>
</div>





<!-- PHOTO -->
<div class="row expanded">
    <?php
        // featured image
        $coverImage = get_post_thumbnail_id();

        $image_s  = wp_get_attachment_image_src( $coverImage, 's_nocrop' );
        $image_m = wp_get_attachment_image_src( $coverImage, 'm_nocrop' );
        $image_l  = wp_get_attachment_image_src( $coverImage, 'l_nocrop' );
        $image_xl  = wp_get_attachment_image_src( $coverImage, 'xl_nocrop' );

        $image_meta = wp_get_attachment($coverImage);
    ?>
    <img class="cover-photo"
        src="<?php echo esc_url( $image_xl[0] ); ?>"
        srcset="<?php echo esc_url( $image_xl[0] ); ?> 2304w"
        sizes="(min-width: 40em) calc(100vw - 348px), 100vw"
        alt="<?php echo $image_meta['alt']; ?>"
        title="<?php echo $image_meta['title']; ?>" />
</div>





<!-- RECIPE META -->
<section class="section--mini">
    <div class="row small-up-2 medium-up-4 meta-grid">
        <?php
            // Servings
            if ($meta['recipe_servings'][0]) {
                echo "<div class='column' itemprop='recipeYield'>".
                $meta['recipe_servings'][0]." ".
                $meta['recipe_servings_type'][0].
                "</div>";
            }

            // Prep time
            if ($meta['recipe_prep_time'][0]) {

                $prepTimeMinutes = (int)$meta['recipe_prep_time'][0];
                if (strrpos($meta['recipe_prep_time_text'][0], "min") === false) {
                    $prepTimeMinutes = (int)$meta['recipe_prep_time'][0] * 60;
                }
                $prepTime = time_to_iso8601_duration(strtotime(convertToHoursMins($prepTimeMinutes, '%02d hours %02d minutes'), 0));

                echo "<div class='column'>".
                "<time datetime='".$prepTime."' itemprop='prepTime'>".
                $meta['recipe_prep_time'][0]." ".
                $meta['recipe_prep_time_text'][0]."</time> prep".
                "</div>";
            }

            // Cooking time
            if ($meta['recipe_cook_time'][0]) {

                $cookTimeMinutes = (int)$meta['recipe_cook_time'][0];
                if (strrpos($meta['recipe_cook_time_text'][0], "min") === false) {
                    $cookTimeMinutes = (int)$meta['recipe_cook_time'][0] * 60;
                }

                $cookTime = time_to_iso8601_duration(strtotime(convertToHoursMins($cookTimeMinutes, '%02d hours %02d minutes'), 0));
                echo "<div class='column'>".
                    "<time datetime='".$cookTime."' itemprop='cookTime'>".
                    $meta['recipe_cook_time'][0]." ".
                    $meta['recipe_cook_time_text'][0]."</time> cooking".
                    "</div>";
            }

            // Passive time
            if ($meta['recipe_passive_time'][0]) {
                echo "<div class='column'>".
                $meta['recipe_passive_time'][0]." ".
                $meta['recipe_passive_time_text'][0]." wait".
                "</div>";
            }
        ?>

        <?php
        $totalTimeMinutes = $cookTimeMinutes + $prepTimeMinutes;
        $totalTime = time_to_iso8601_duration(strtotime(convertToHoursMins($totalTimeMinutes, '%02d hours %02d minutes'), 0));
        ?>
        <time hidden datetime="<?php echo $totalTime; ?>" itemprop="totalTime"></time>
    </div>
</section>





<?php
    // Split recipe description into parts
    $recipeDescription = [];
    $recipeDescriptionTemp = explode("\r", apply_filters('get_the_content', get_the_content()));

    // Clean up the array
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





<!-- GINA'S COMMENT -->
<section class="recommended-item expanded">
    <div class="row">
        <div class="shrink columns">
            <img class="thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_advice.jpg">
        </div>
        <div class="columns">
            <p class="lead">“<?php echo $recipeDescription[0]; ?>”</p>
            <cite>Gina Lioti</cite>
        </div>
    </div>
</section>





<!-- INTRODUCTION -->
<?php if (count($recipeDescription) > 1) { ?>
    <section>
        <div class="row column">
            <h2>Here’s why you’re going to love this</h1>

            <p class="lead"><?php echo $recipeDescription[1]; ?></p>

            <?php if (count($recipeDescription) > 2) {
                for ($i = 2; $i < count($recipeDescription); $i++) { ?>
                    <p><?php echo $recipeDescription[$i]; ?></p>
                <?php }
            } ?>
        </div>
    </section>
<?php } ?>





<!-- INGREDIENTS -->
<section>
    <div class="row column">
        <h2>Ingredients</h2>
        <p>Click on ingredients to discover recipes</p>
    </div>

    <ul class="ingredients-view">
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/greek-style-oyster-mushrooms-recipe-2-2304x1296.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Oyster mushrooms</span>
                    <small class="ingredient-meta">200 grams</small>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/turmeric-1200x630.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Extra virgin olive oil</span>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/lemon-1200x630.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">1/2 or 1/4 lemon</span>
                    <small class="ingredient-meta">Freshly squeezed</small>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/sea-salt-2304x1296.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Sea salt</span>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/black-pepper-2304x1296.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Black pepper</span>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/oregano-1-1200x630.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Oregano</span>
                </div>
            </a>
        </li>
        <li class="ingredient">
            <a class="ingredient-inner">
                <div class="ingredient-thumb">
                    <div class="hexagon-1">
                        <div class="hexagon-2" style="background-image: url(http://ginalioti.com/wp/wp-content/uploads/parsley-1200x630.jpg);"></div>
                    </div>
                </div>
                <div class="ingredient-details">
                    <span class="ingredient-name">Parsley</span>
                    <small class="ingredient-meta">Freshly chopped (optional)</small>
                </div>
            </a>
        </li>
    </ul>
</section>





<!-- INSTRUCTIONS -->
<section>
    <div class="row column">
        <h2>Instructions</h2>
        <ol class="recipe-instructions">
            <li tabindex="0">Rinse the mushrooms very well and dry them carefully.</li>
            <li>Preheat oven on the grill setting (or fan/grill combination) at medium heat.</li>
            <li>Place your mushrooms on a baking tray drizzled with a hint of olive oil, so that they do not stick. You can use a pastry brush to cover the tray.</li>
            <li>Line the mushrooms on the tray in a single layer, slightly spaced and place in the middle shelf of your oven.</li>
            <li>Halfway through cooking, turn them. When they are starting to become golden at their edges and they are tender, they are ready.</li>
            <li>Put them on a plate and drizzle with lemon juice and olive oil. Sprinkle with oregano, salt and black pepper and chop a little parsley on top of them. Serve immediately.</li>
        </ol>
    </div>
</section>





<!-- LOVE THIS RECIPE? -->
<section>
    <div class="row column">
        <a class="love-this">
            <i class="ion-android-favorite-outline"></i>
            Love this recipe?
        </a>
    </div>
</section>





<!-- RELATED COLLECTIONS -->
<section>
    <div class="row">
        <div class="large-12 columns">
            <h2>This recipe is part of these collections:</h2>
        </div>
    </div>
    <ul class="list-view">
        <li class="list-item has-indicator"><a>10 Summer sides</a></li>
        <li class="list-item"><a>Food you loved in Greece</a></li>
        <li class="list-item"><a>Traditionally Greek</a></li>
    </ul>
</section>




<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_template_part( 'partial--recipes-preview' ); ?>

<?php get_footer(); ?>