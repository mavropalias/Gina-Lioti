<section class="entry-meta">
  <span class="cat-links caption"><strong><?php _e( '', 'ginalioti' ); ?><?php the_category( ', ' ); ?></strong></span>
  <span class="meta-sep caption"> – </span>

  <?php if ( comments_open() ) {
  echo '<span class="comments-link caption"><a href="' . get_comments_link() . '"><i class="fa fa-comment-o"></i> ' . get_comments_number() . '</a></span>';
  } ?>

  <span class="tag-links caption"><?php the_tags("<span class=\"meta-sep caption\"> – </span> "); ?></span>
  <span class="meta-sep caption"> – </span>
  <span class="entry-date caption"><?php the_time( get_option( 'date_format' ) ); ?></span>
</section>