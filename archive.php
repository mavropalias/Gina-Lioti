<?php get_header(); ?>
  <?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>


  <ul id="content-articles" role="main" class="small-block-grid-1 medium-block-grid-1 large-block-grid-2">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <li>
        <?php get_template_part( 'entry-preview' ); ?>
    </li>
    <?php endwhile; endif; ?>
  </ul>

  <?php get_template_part( 'nav', 'below' ); ?>



<?php //get_sidebar(); ?>
<?php get_footer(); ?>