<?php get_header(); ?>

<ul id="content-articles" role="main" class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
<?php
$main_ingredients = get_terms('ingredient');




$main_ingredients = apply_filters( 'taxonomy-images-setup-terms', $main_ingredients );

foreach($main_ingredients as $ingredient) {
  $dishes = new WP_Query(array(
    'post_type' => 'recipe',
    'post_per_page'=>-1,
    'taxonomy'=>'ingredient',
    'term' => $ingredient->slug,
  ));


  $link = get_term_link(intval($ingredient->term_id),'ingredient');
  $img = z_taxonomy_image_url($ingredient->term_id, 'm');
  if ($img == "") {
    $img = "http://ginalioti.com/wp/wp-content/uploads/gina-lioti-placeholder-600x315.jpg";
  }
  ?>
    <li>
      <a href="<?php echo $link ?>"
        rel="bookmark"
        class="entry-preview"
        style="background-image: url(<?php echo $img ?>);">

        <h3 class="headline"><?php echo $ingredient->name; ?></h3>
        <span class="subhead"><?php
        if ($ingredient->count > 1) {
          echo $ingredient->count; echo " recipes";
        } else {
          echo $ingredient->count; echo " recipe";
        }
        ?></span>
      </a>
    </li>
  <?php
  // echo '<ul>';
  // while ( $dishes->have_posts() ) {
  //   $dishes->the_post();
  //   $link = get_permalink($post->ID);
  //   $title = get_the_title();
  //   echo "<li><a href=\"{$link}\">{$title}</a></li>";
  // }
  // echo '</ul>';
}
?>
</ul>




  <?php get_template_part( 'nav', 'below-single' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>