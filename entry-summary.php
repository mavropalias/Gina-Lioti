<section class="entry-summary body1">
  <?php the_excerpt(); ?>
  <p>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">Continue reading <i class="fa fa-long-arrow-right"></i></a>
  </p>
  <?php if( is_search() ) { ?><div class="entry-links"><?php wp_link_pages(); ?></div><?php } ?>
</section>