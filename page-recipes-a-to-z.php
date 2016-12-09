<?php get_header(); ?>

<div class="column row">
    <h1 class="title">Recipes a-to-z</h1>

    <a href="#"><label class="toggle-photos-label" for="showphotos">Hide/Show recipe photos <i class="ion-qr-scanner"></i></label></a>
</div>

<section class="section--mini section--with-separator"></section>

<input id="showphotos" class="hide" type="checkbox">

<section>
    <ol class="no-bullet">
        <?php
            $args = array(
                'post_type' => 'recipe',
                'orderby' => 'title',
                'order' => 'ASC'
            );
            // The query
            $query = new WP_Query( $args );

            // The Loop
            if ( $query->have_posts() ) { ?>
                <?php while ( $query->have_posts() ) : $query->the_post() ; ?>

                    <?php $do_not_duplicate[] = $post->ID; ?>

                    <li>
                        <a class="recipe-preview recipe-preview--large"
                            href="<?php the_permalink(); ?>"
                            title="<?php the_title_attribute(); ?>">
                            <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail')); ?>
                            <span class="recipe-title"><?php the_title(); ?></span>
                            <span class="recipe-subtitle"><?php
                                // TAGS (Terms) 
                                // the_terms( $post->ID, 'post_tag', '', ', ' );
                                $terms = get_the_terms($post->ID, 'post_tag');
                                $index = 0;
                                foreach ( $terms as $term ) {
                                    if ($index > 0) echo ', ';
                                    echo $term->name;
                                    $index++;
                                } 
                            ?></span>
                        </a>
                    </li>

                <?php endwhile; ?>

            <?php }
            /* Restore original Post Data */
            wp_reset_postdata();
        ?>
    </ol>
</section>

<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_footer(); ?>