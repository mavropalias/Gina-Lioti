<?php if ( !is_singular() ) { echo '<li>'; } ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class("content-width-limit"); ?>>
    <div class="row">
      <header class="large-12 columns">

          <?php if ( has_post_thumbnail() ) {
            $imageId = get_post_thumbnail_id();

            $image_s  = wp_get_attachment_image_src( $imageId, 's_nocrop' );
            $image_m = wp_get_attachment_image_src( $imageId, 'm_nocrop' );
            $image_l  = wp_get_attachment_image_src( $imageId, 'l_nocrop' );
            $image_xl  = wp_get_attachment_image_src( $imageId, 'xl_nocrop' );
            ?>
            <picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo esc_url( $image_xl[0] ); ?>" media="(min-width: 2304px)">
                <source srcset="<?php echo esc_url( $image_l[0] ); ?>" media="(min-width: 1200px)">
                <source srcset="<?php echo esc_url( $image_m[0] ); ?>" media="(min-width: 600px)">
                <source srcset="<?php echo esc_url( $image_s[0] ); ?>">
                <!--[if IE 9]></video><![endif]-->
                <img class="recipe-photo" srcset="<?php echo esc_url( $image_s[0] ); ?>">
            </picture>
          <?php } ?>

      </header>

      <div class="medium-12 large-9 columns">
        <?php if ( is_singular() ) { echo '<h1 class="page-title display2">'; } else { echo '<h2 class="entry-title">'; } ?><?php the_title(); ?><?php if ( is_singular() ) { echo '</h1>'; } else { echo '</h2>'; } ?>
      </div>

      <section class="medium-12 large-9 columns">
        <div class="entry-main">
          <?php if ( !is_search() && !is_page() ) get_template_part( 'entry', 'meta' ); ?>
          <?php
            if ( !is_singular() ) get_template_part( 'entry', 'summary' );
            else get_template_part( 'entry', 'content' );
          ?>

          <?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
        </div>
      </section>

      <?php get_sidebar(); ?>
    </div>
  </article>
<?php if ( !is_singular() ) { echo '</li>'; } ?>