<?php get_header();

    global $wp_query;
    $term = $wp_query->get_queried_object();

?>




<!-- Photos -->
<!-- ======================================================================= -->
<div class="photos">
  <div class="photo-carousel">
    <?php
        // featured image
        $image_s  = z_taxonomy_image_url($ingredient->term_id, 's');
        $image_m = z_taxonomy_image_url($ingredient->term_id, 'm');
        $image_l  = z_taxonomy_image_url($ingredient->term_id, 'l');
        $image_xl  = z_taxonomy_image_url($ingredient->term_id, 'xl');

        if ($image_s == "") $image_s = "http://ginalioti.com/wp/wp-content/uploads/gina-lioti-placeholder-300x157.jpg";
        if ($image_m == "") $image_m = "http://ginalioti.com/wp/wp-content/uploads/gina-lioti-placeholder-600x315.jpg";
        if ($image_l == "") $image_l = "http://ginalioti.com/wp/wp-content/uploads/gina-lioti-placeholder-1200x630.jpg";
        if ($image_xl == "") $image_xl = "http://ginalioti.com/wp/wp-content/uploads/gina-lioti-placeholder-2304x1296.jpg";
        ?>
        <picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo esc_url( $image_xl ); ?>" media="(min-width: 2304px)">
            <source srcset="<?php echo esc_url( $image_l ); ?>" media="(min-width: 1200px)">
            <source srcset="<?php echo esc_url( $image_m ); ?>" media="(min-width: 600px)">
            <source srcset="<?php echo esc_url( $image_s ); ?>">
            <!--[if IE 9]></video><![endif]-->
            <img class="recipe-photo" srcset="">
        </picture>
  </div> <!-- .photo-carousel -->

  <div class="inner-shadow"></div>

  <div class="info">
    <h3 class="display2"><?php echo $term->name; ?></h3>
    <span class="subhead"><?php
        if ($term->count > 1) {
          echo $term->count; echo " recipes";
        } else {
          echo $term->count; echo " recipe";
        }
    ?></span>
  </div>

</div> <!-- .photos -->





<!-- Description -->
<!-- ======================================================================= -->
<div class="recipe-introduction">
  <div class="content-width-limit">
  <?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '' . category_description() . '' ); ?>

    <div class="social">
      <a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
      <!-- Please call pinit.js only once per page -->
      <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

      <a href="https://twitter.com/share" class="twitter-share-button" data-via="GinaLioti" data-related="GinaLioti" data-hashtags="ginalioti">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

      <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo get_term_link( $term ); ?> &amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21&amp;appId=819730088048846" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
    </div>
  </div>
</div>





<!-- RECIPES WITH THIS INGREDIENT -->
<!-- ======================================================================= -->

<div class="related-recipes">
  <div class="content-width-limit">
    <h2 class="headline">Recipes with <?php echo $term->name; ?></h2>
    <ul id="content-articles" role="main" class="small-block-grid-1 medium-block-grid-1 large-block-grid-2">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
          <?php get_template_part( 'entry-preview' ); ?>
      </li>
      <?php endwhile; endif; ?>
    </ul>
  </div>
</div>





  <?php get_template_part( 'nav', 'below' ); ?>



<?php //get_sidebar(); ?>
<?php get_footer(); ?>