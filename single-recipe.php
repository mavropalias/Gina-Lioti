<?php get_header(); ?>

<?php
  // init variables
  $meta = get_post_meta( get_the_ID() );
  $ingredients = unserialize($meta['recipe_ingredients'][0]);
  $directions = unserialize($meta['recipe_instructions'][0]);
  $primaryIngredient = "";

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





<!-- TITLE -->
<!-- ======================================================================= -->

    <div class="row column">
        <h1 class="title" itemprop="name"><?php the_title(); ?></h1>
        <p>
            <span itemprop="recipeCategory"><?php
            $courses = wp_get_post_terms($post->ID, 'course', array("fields" => "names"));
            if (count($courses) > 0) {
                echo "A ".($courses[0])."-dish";
            } else {
                echo "An original";
                $course[0] = "";
            }
            ?></span> recipe, by Gina Lioti.
        </p>
    </div>

    <div class="row hide">
        <div class="small-12 columns callout"><u>This is a healthy recipe! See why.</u></div>
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
            src="<?php echo esc_url( $image_m[0] ); ?>"
            srcset="<?php echo esc_url( $image_xxl[0] ); ?> 3200w,
                    <?php echo esc_url( $image_xl[0] ); ?> 2400w,
                    <?php echo esc_url( $image_l[0] ); ?> 1600w,
                    <?php echo esc_url( $image_m[0] ); ?> 1200w,
                    <?php echo esc_url( $image_s[0] ); ?> 800w,
                    <?php echo esc_url( $image_xs[0] ); ?> 400w,
                    <?php echo esc_url( $image_xxs[0] ); ?> 200w"
            sizes="100vw"
            alt="<?php echo $image_meta['alt']; ?>"
            title="<?php echo $image_meta['title']; ?>" />-->
        <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail', array( 'class' => 'cover-photo' ))); ?>
    </div>





<!-- META INFO -->
<!-- ======================================================================= -->

    <section class="section--mini">
        <?php
            // Count how many grid items will be displayed
            $gridCount = 0;
            if (!empty($meta['recipe_servings']) && $meta['recipe_servings'][0]) $gridCount++;
            if (!empty($meta['recipe_prep_time']) && $meta['recipe_prep_time'][0]) $gridCount++;
            if (!empty($meta['recipe_cook_time']) && $meta['recipe_cook_time'][0]) $gridCount++;
            if (!empty($meta['recipe_passive_time']) && $meta['recipe_passive_time'][0]) $gridCount++;
        ?>
        <div class="row small-up-2 medium-up-<?php echo $gridCount; ?> meta-grid">
            <?php
                // Servings
                if (!empty($meta['recipe_servings']) && $meta['recipe_servings'][0]) {
                    echo "<div class='column' itemprop='recipeYield'>".
                    $meta['recipe_servings'][0]." ".
                    $meta['recipe_servings_type'][0].
                    "</div>";
                }

                // Prep time
                if (!empty($meta['recipe_prep_time']) && $meta['recipe_prep_time'][0]) {

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
                if (!empty($meta['recipe_cook_time']) && $meta['recipe_cook_time'][0]) {

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
                if (!empty($meta['recipe_passive_time']) && $meta['recipe_passive_time'][0]) {
                    echo "<div class='column'>".
                    $meta['recipe_passive_time'][0]." ".
                    $meta['recipe_passive_time_text'][0]." wait".
                    "</div>";
                }
            ?>

            <?php
                $totalTimeMinutes = 0;
                if (!empty($cookTimeMinutes)) $totalTimeMinutes += $cookTimeMinutes;
                if (!empty($prepTimeMinutes)) $totalTimeMinutes += $prepTimeMinutes;
                $totalTime = time_to_iso8601_duration(strtotime(convertToHoursMins($totalTimeMinutes, '%02d hours %02d minutes'), 0));
            ?>
            <time hidden datetime="<?php echo $totalTime; ?>" itemprop="totalTime"></time>
        </div>
    </section>





<?php
// Split recipe description into parts
// ========================================================================

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
<!-- ======================================================================= -->

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





<!-- DESCRIPTION -->
<!-- ======================================================================= -->

    <?php if (count($recipeDescription) > 1) { ?>
        <section>
            <div class="row column">
                <h2>Here’s why you’re going to love this</h2>

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
<!-- ======================================================================= -->

    <section>
        <div class="row column">
            <h2>Ingredients</h2>
            <p>Tip: Click on ingredients to discover more recipes!</p>
        </div>

        <?php
            foreach( $ingredientGroups as $ingredientGroup ) {
        ?>
            <?php if ($ingredientGroup != "") { ?>
                <div class="row column">
                    <h3><?php echo $ingredientGroup; ?>:</h3>
                </div>
            <?php } ?>
            <ul class="ingredients-view">
                <?php
                    foreach( $ingredients as $ingredient ) {
                        if ($ingredient['group'] == $ingredientGroup) {
                            // initialize $primaryIngredient, if empty
                            if (strlen($primaryIngredient) == 0) $primaryIngredient = $ingredient['ingredient'];

                            $ingredientTerm = get_term( $ingredient['ingredient_id'], "ingredient" );

                            $plural = "";
                            preg_match_all("/\[(.*?)\]/", $ingredient['unit'], $output);
                            if (!empty($output[1])) $plural = $output[1][0];

                            $arr = explode("[", $ingredient['unit'], 2);
                            $unit = $arr[0];
                        ?>
                        <li class="ingredient">
                            <a class="ingredient-inner" href="<?php echo get_term_link( $ingredient['ingredient_id'], 'ingredient' ); ?>">
                                <div class="ingredient-thumb">
                                    <div class="hexagon-1">
                                        <div class="hexagon-2" style="background-image: url(<?php echo content_url(); ?>/uploads/<?php echo $ingredientTerm->slug; ?>-600x315.jpg);"></div>
                                    </div>
                                </div>
                                <div class="ingredient-details" itemprop="ingredients">
                                    <span class="ingredient-name"><?php echo $ingredient['ingredient'].$plural; ?></span>
                                    <small class="ingredient-meta">
                                        <?php
                                            if ($ingredient['notes']) {
                                        ?>
                                                <span class="ingredient-notes"><?php echo $ingredient['notes']; ?></span>
                                        <?php
                                                if (!empty($ingredient['amount'])) echo "&nbsp;&mdash;&nbsp;";
                                            }
                                        ?>
                                        <?php echo $ingredient['amount']." ".$unit; ?>
                                    </small>
                                </div>
                            </a>
                        </li>
                        <?php
                        }
                    }
                ?>
            </ul>
        <?php
            }
        ?>
    </section>





<!-- INSTRUCTIONS -->
<!-- ======================================================================= -->

    <section>
        <div class="row column">
            <h2>Instructions</h2>
            <?php
                foreach( $directionGroups as $directionGroup ) {
            ?>
                <?php if ($directionGroup != "") { ?><h3><?php echo $directionGroup; ?></h3><?php } ?>
                <ol class="recipe-instructions">
                <?php
                    foreach( $directions as $direction ) {
                        if ($direction['group'] == $directionGroup) {
                ?>
                        <li itemprop="recipeInstructions">
                            <?php echo $direction['description']; ?>
                        </li>
                <?php
                        }
                    }
                ?>
                </ol>
            <?php
                }
            ?>

            <!-- FINAL NOTES -->
            <?php if (!empty($meta['recipe_description']) && $meta['recipe_description'][0]) { ?>
                <br>
                <h3>Final notes</h3>
                <p><?php echo $meta['recipe_description'][0]; ?></p>
            <?php } ?>
        </div>
    </section>





<!-- LOVE AND SHARE -->
<!-- ======================================================================= -->

    <section class="hide">
        <div class="row column">
            <a class="love-this">
                <i class="ion-android-favorite-outline"></i>
                Love this recipe?
            </a>
        </div>
    </section>





<!-- COOKING CLUB -->
<!-- ======================================================================= -->

    <?php get_template_part( 'partial--cooking-club-preview' ); ?>





<!-- COMPLEMENTARY RECIPES -->
<!-- ======================================================================= -->

    <?php
        if (count(bawmrp_get_related_posts($post->ID)) > 0) {
            set_query_var( 'recipesToPreviewTitle', "Hand–picked complementary recipes" );
            set_query_var( 'recipesToPreviewDescription', "These dishes go great with ".get_the_title()."." );
            set_query_var( 'recipesToPreview', bawmrp_get_all_related_posts($post) );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- SIMILAR RECIPES -->
<!-- ======================================================================= -->

    <?php
        $_recipesToPreview = [];
        $args = array(
            'post_type' => 'recipe',
            'posts_per_page' => 4,
            'post__not_in' => [$post->ID],
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'name',
                    'terms'    => $courses,
                ),
            ),
        );
        // The query
        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            set_query_var( 'recipesToPreviewTitle', "More ".$courses[0]."-dish recipes" );
            set_query_var( 'recipesToPreviewDescription', null );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<!-- SAME INGREDIENT -->
<!-- ======================================================================= -->

    <?php
        $_recipesToPreview = [];
        $args = array(
            'post_type' => 'recipe',
            'posts_per_page' => 4,
            'post__not_in' => [$post->ID],
            'orderby' => 'rand',
            's' => $primaryIngredient,
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'name',
                    'terms'    => $courses,
                ),
            ),
        );
        // The query
        $query = new WP_Query( $args );

        if ($query->found_posts > 0) {
            $message = "Here's one more recipe with ".$primaryIngredient." as an ingredient.";
            if( $query->found_posts > 1 ) $message = "Here are ".$query->post_count." more recipes with ".$primaryIngredient." as an ingredient."; 

            set_query_var( 'recipesToPreviewTitle', ucfirst($primaryIngredient)." recipes" );
            set_query_var( 'recipesToPreviewDescription', "Love ".$primaryIngredient."? ".$message );
            set_query_var( 'recipesToPreview', $query->posts );
            get_template_part( 'partial--recipes-preview' );
        }
    ?>





<?php get_footer(); ?>