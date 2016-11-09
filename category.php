<?php get_header(); ?>

<section id="content-articles" role="main" class="medium-12 large-9 columns">

  <h1 class="display1 home-headline"><?php single_cat_title(); ?></h1>
  <?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>

  <ul role="main" class="small-block-grid-1 medium-block-grid-1 large-block-grid-2">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'entry' ); ?>
    <?php endwhile; endif; ?>
  </ul>

  <?php get_template_part( 'nav', 'below' ); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>