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

<!-- Photos -->
<!-- ======================================================================= -->
<div class="photos">
  <div class="photo-carousel">
    <?php
        // featured image
        $imagesById = [get_post_thumbnail_id()];

        // parse extra feature images
        if ($meta['kd_featured-image-1_recipe_id']) $imagesById[] = $meta['kd_featured-image-1_recipe_id'][0];
        if ($meta['kd_featured-image-2_recipe_id']) $imagesById[] = $meta['kd_featured-image-2_recipe_id'][0];
        if ($meta['kd_featured-image-3_recipe_id']) $imagesById[] = $meta['kd_featured-image-3_recipe_id'][0];
        if ($meta['kd_featured-image-4_recipe_id']) $imagesById[] = $meta['kd_featured-image-4_recipe_id'][0];
        if ($meta['kd_featured-image-5_recipe_id']) $imagesById[] = $meta['kd_featured-image-5_recipe_id'][0];
        if ($meta['kd_featured-image-6_recipe_id']) $imagesById[] = $meta['kd_featured-image-6_recipe_id'][0];
        if ($meta['kd_featured-image-7_recipe_id']) $imagesById[] = $meta['kd_featured-image-7_recipe_id'][0];
        if ($meta['kd_featured-image-8_recipe_id']) $imagesById[] = $meta['kd_featured-image-8_recipe_id'][0];
        if ($meta['kd_featured-image-9_recipe_id']) $imagesById[] = $meta['kd_featured-image-9_recipe_id'][0];
        if ($meta['kd_featured-image-10_recipe_id']) $imagesById[] = $meta['kd_featured-image-10_recipe_id'][0];
        if ($meta['kd_featured-image-11_recipe_id']) $imagesById[] = $meta['kd_featured-image-11_recipe_id'][0];
        if ($meta['kd_featured-image-12_recipe_id']) $imagesById[] = $meta['kd_featured-image-12_recipe_id'][0];
        if ($meta['kd_featured-image-13_recipe_id']) $imagesById[] = $meta['kd_featured-image-13_recipe_id'][0];
        if ($meta['kd_featured-image-14_recipe_id']) $imagesById[] = $meta['kd_featured-image-14_recipe_id'][0];
        if ($meta['kd_featured-image-15_recipe_id']) $imagesById[] = $meta['kd_featured-image-15_recipe_id'][0];

        foreach ($imagesById as $imageId) {
          $image_s  = wp_get_attachment_image_src( $imageId, 's_nocrop' );
          $image_m = wp_get_attachment_image_src( $imageId, 'm_nocrop' );
          $image_l  = wp_get_attachment_image_src( $imageId, 'l_nocrop' );
          $image_xl  = wp_get_attachment_image_src( $imageId, 'xl_nocrop' );

          $image_meta = wp_get_attachment($imageId);
          ?>
          <img class="recipe-photo"
               src="<?php echo esc_url( $image_l[0] ); ?>"
               srcset="<?php echo esc_url( $image_xl[0] ); ?> 2304w,
                        <?php echo esc_url( $image_l[0] ); ?> 1200w,
                        <?php echo esc_url( $image_m[0] ); ?> 600w,
                        <?php echo esc_url( $image_s[0] ); ?> 300w"
               sizes="(min-width: 40em) calc(100vw - 348px), 100vw"
               alt="<?php echo $image_meta['alt']; ?>"
               title="<?php echo $image_meta['title']; ?>" />
    <?php
        }
    ?>
  </div> <!-- .photo-carousel -->

  <div class="inner-shadow show-for-medium-up"></div>

  <div class="info show-for-medium-up">
    <h1 class="display2" itemprop="name"><?php the_title(); ?></h1>
    <span class="subhead" itemprop="recipeCategory"><?php
      $courses = wp_get_post_terms($post->ID, 'course', array("fields" => "names"));
      echo ($courses[0]);
    ?></span>
  </div>

</div> <!-- .photos -->


<?php

 // print_r($meta);

?>





<!-- Tags & Description -->
<!-- ======================================================================= -->
<div class="recipe-introduction">
  <div class="show-for-small-only">
    <h1 itemprop="name"><?php the_title(); ?></h1>
    <p class="subhead" itemprop="recipeCategory"><?php
      $courses = wp_get_post_terms($post->ID, 'course', array("fields" => "names"));
      echo ($courses[0]);
    ?></p>
  </div>

  <div class="content-width-limit">
    <ul class="recipe-meta buttons">
      <?php
        if ($meta['recipe_cook_time'][0]) {

          $cookTimeMinutes = (int)$meta['recipe_cook_time'][0];
          if (strrpos($meta['recipe_cook_time_text'][0], "min") === false) {
            $cookTimeMinutes = (int)$meta['recipe_cook_time'][0] * 60;
          }
          $cookTime = time_to_iso8601_duration(strtotime(convertToHoursMins($cookTimeMinutes, '%02d hours %02d minutes'), 0));

          echo "<li><i class='icon ion-ios-clock-outline'></i>".
            "<time datetime='".$cookTime."' itemprop='cookTime'>".
            $meta['recipe_cook_time'][0]." ".
            $meta['recipe_cook_time_text'][0]."</time> cooking".
            "</li>";
        }
        if ($meta['recipe_prep_time'][0]) {

          $prepTimeMinutes = (int)$meta['recipe_prep_time'][0];
          if (strrpos($meta['recipe_prep_time_text'][0], "min") === false) {
            $prepTimeMinutes = (int)$meta['recipe_prep_time'][0] * 60;
          }
          $prepTime = time_to_iso8601_duration(strtotime(convertToHoursMins($prepTimeMinutes, '%02d hours %02d minutes'), 0));

          echo "<li><i class='icon ion-ios-clock-outline'></i>".
          "<time datetime='".$prepTime."' itemprop='prepTime'>".
          $meta['recipe_prep_time'][0]." ".
          $meta['recipe_prep_time_text'][0]."</time> prep".
          "</li>";
        }
        if ($meta['recipe_passive_time'][0]) {
          echo "<li><i class='icon ion-ios-clock-outline'></i>".
          $meta['recipe_passive_time'][0]." ".
          $meta['recipe_passive_time_text'][0]." wait".
          "</li>";
        }
        if ($meta['recipe_servings'][0]) {
          echo "<li><i class='icon ion-ios-people-outline'></i><span itemprop='recipeYield'>".
          $meta['recipe_servings'][0]." ".
          $meta['recipe_servings_type'][0].
          "</span></li>";
        }
      ?>
    </ul>

    <?php
      $totalTimeMinutes = $cookTimeMinutes + $prepTimeMinutes;
      $totalTime = time_to_iso8601_duration(strtotime(convertToHoursMins($totalTimeMinutes, '%02d hours %02d minutes'), 0));
    ?>
    <time hidden datetime="<?php echo $totalTime; ?>" itemprop="totalTime"></time>

    <div class="recipe-description" itemprop="description">
      <?php echo str_replace("\r", "<br />", get_the_content('')); ?>
    </div>

    <div class="social hide-for-small">
      <a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
      <!-- Please call pinit.js only once per page -->
      <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

      <a href="https://twitter.com/share" class="twitter-share-button" data-via="GinaLioti" data-related="GinaLioti" data-hashtags="ginalioti">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

      <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21&amp;appId=819730088048846" style="border:none; overflow:hidden; height:21px;"></iframe>
    </div>
  </div>
</div>




<!-- Ingredients -->
<!-- ======================================================================= -->

<div class="recipe-ingredients">
  <div class="content-width-limit">
    <h2 class="display1">Ingredients</h2>
    <div>
      <?php
        foreach( $ingredientGroups as $ingredientGroup ) {
      ?>
        <div>
          <?php if ($ingredientGroup != "") { ?><h3 class="subhead"><?php echo $ingredientGroup; ?></h3><?php } ?>
          <ul class="recipe-ingredients-list buttons small-block-grid-1 medium-block-grid-1 large-block-grid-2">
            <?php
              foreach( $ingredients as $ingredient ) {
                if ($ingredient['group'] == $ingredientGroup) {
                  $ingredientTerm = get_term( $ingredient['ingredient_id'], "ingredient" );

                  preg_match_all("/\[(.*?)\]/", $ingredient['unit'], $output);
                  $plural = $output[1][0];

                  $arr = explode("[", $ingredient['unit'], 2);
                  $unit = $arr[0];


            ?>
              <li class="ingredient-card">
                <a href="<?php echo get_term_link( $ingredient['ingredient_id'], 'ingredient' ); ?>"
                  class="recipe-ingredient">
                  <span class="ingredient-photo" style="background-image:url(http://ginalioti.com/wp/wp-content/uploads/<?php echo $ingredientTerm->slug; ?>-48x48.jpg);"></span>
                  <span class="ingredient-text" itemprop="ingredients">
                    <span><?php echo $ingredient['amount']." ".$unit; ?></span>
                    <span><?php echo $ingredient['ingredient'].$plural; ?></span>
                    <?php
                      if ($ingredient['notes']) {
                    ?>
                      <span class="ingredient-notes">&ndash; <?php echo $ingredient['notes']; ?></span>
                    <?php
                      }
                    ?>
                  </span>
                </a>
              </li>
            <?php
                }
              }
            ?>
          </ul>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>





<!-- Directions -->
<!-- ======================================================================= -->

<div class="recipe-directions">
  <div class="content-width-limit">
    <h2 class="display1">Directions</h2>
    <div itemprop="recipeInstructions">
      <?php
        foreach( $directionGroups as $directionGroup ) {
      ?>
        <div>
          <?php if ($directionGroup != "") { ?><h3 class="subhead"><?php echo $directionGroup; ?></h3><?php } ?>
          <ol class="recipe-directions-list">
            <?php
              $counter = 1;
              foreach( $directions as $direction ) {
                if ($direction['group'] == $directionGroup) {
            ?>
              <li class="recipe-direction body1">
                <span class="recipe-direction-number"><?php echo $counter; ?></span>
                <span class="recipe-direction-content"><?php echo $direction['description']; ?></span>
              </li>
            <?php
                  $counter++;
                }
              }
            ?>
          </ol>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>





<!-- Footer -->
<!-- ======================================================================= -->

<?php if ($meta['recipe_description'][0]) { ?>

  <div class="recipe-description-footer">
    <div class="content-width-limit">
      <h2 class="display1">Final notes</h2>
      <p class="body2"><?php echo $meta['recipe_description'][0]; ?></p>
    </div>
  </div>

<?php } ?>





<!-- Newsletter -->
<!-- ======================================================================= -->

<div class="recipe-newsletter">
  <div class="content-width-limit" id="mc_embed_signup">

    <h2 class="headline"><i class='icon ion-ios-email-outline'></i> Subsribe to my newsletter</h2>
    <span>Get my new recipes in your inbox – No spam, unsubscribe at any time.</span>

    <?php echo do_shortcode('[mc4wp_form]'); ?>
  </div>
</div>






<!-- Social -->
<!-- ======================================================================= -->

<div class="recipe-social hide-for-small">
  <div class="content-width-limit">
    <h2 class="headline">Share this recipe</h2>
      <a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
      <!-- Please call pinit.js only once per page -->
      <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

      <a href="https://twitter.com/share" class="twitter-share-button" data-via="GinaLioti" data-related="GinaLioti" data-hashtags="ginalioti">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

      <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21&amp;appId=819730088048846" style="border:none; overflow:hidden; height:21px;"></iframe>
  </div>
</div>





<!-- COMBINE IT WITH -->
<!-- ======================================================================= -->

<div class="related-recipes">
  <div class="content-width-limit">
    <h2 class="headline">This recipe goes well with:</h2>
    <?php echo do_shortcode( '[manual_related_posts]' ); ?>
  </div>
</div>





<!-- COMMENTS -->
<!-- ======================================================================= -->

<? /*<div class="recipe-comments">
  <div class="content-width-limit">
    <h2 class="headline">Comments</h2>
    <span class="comments-subhead body1">Did you try this recipe? Let me know what you think.</span>
    <div id="disqus">
      <?php comments_template(); ?>
    </div>
  </div>
</div> */ ?>

<span hidden itemprop="author" content="Gina Lioti">Gina Lioti</span>
<time hidden datetime="<?php the_date('Y-m-d', '', ''); ?>" itemprop="datePublished"><?php the_date('Y-m-d', '', ''); ?></time>