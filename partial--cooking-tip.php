<!-- COOKING TIP -->
<section>
    <div class="row column">
        <h2>Cooking tip</h2>
        <p class="tip">
        <?php
            $args = array(
                'category_name' => 'cooking-tip',
                'posts_per_page' => 1,
            );
            // The query
            $query = new WP_Query( $args );

            // The Loop
            if ( $query->have_posts() ) { ?>
                <?php while ( $query->have_posts() ) : $query->the_post() ; ?>

                    <em><a style="display: inline;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></em> &mdash; <?php echo wp_strip_all_tags( get_the_content() ); ?>

                <?php endwhile; ?>
            
            <?php }
                /* Restore original Post Data */
                wp_reset_postdata();
        ?>
        </p>
    </div>
</section>