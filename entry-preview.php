<a href="<?php the_permalink(); ?>"
  title="<?php the_title_attribute(); ?>"
  rel="bookmark"
  id="post-<?php the_ID(); ?>" <?php post_class("entry-preview"); ?>
  style="background-image: url(<?php
    //Get the Thumbnail URL
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'l', false, '' );
    echo $src[0];
  ?>);">

  <h3 class="headline"><?php the_title(); ?></h3>
  <span class="subhead"><?php
    $test = wp_get_post_terms($post->ID, 'course', array("fields" => "names"));
    echo ($test[0]);
  ?></span>
</a>