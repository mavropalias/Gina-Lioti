<?php get_header(); ?>

  <ul id="content-articles" role="main" class="small-block-grid-1 medium-block-grid-1 large-block-grid-2">
  <?php query_posts('post_type=recipe');
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <li>
      <?php get_template_part( 'entry-preview' ); ?>
    </li>
  <?php endwhile; endif; ?>
  </ul>
  <?php get_template_part( 'nav', 'below' ); ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>