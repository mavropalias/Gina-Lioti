<?php get_header(); ?>

<section id="content-article-single" itemscope itemtype="http://schema.org/Recipe" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'entry-recipe' ); ?>
  <?php endwhile; endif; ?>

  <?php get_template_part( 'nav', 'below-single' ); ?>

</section>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>