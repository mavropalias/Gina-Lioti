<!-- RECIPES -->
<section>
    <div class="row column">
        <?php if(is_front_page()) { ?>
            <h2>My recipes</h2>
            <p>I use artisanal Irish ingredients to create deliciously healthy, gourmet, dishes.</p>
        <?php } else { ?>
            <h2><?php if (!empty($recipesToPreviewTitle)) echo $recipesToPreviewTitle; else echo "My Recipes"; ?></h2>
            <?php if (!empty($recipesToPreviewDescription)) {
                echo "<p>".$recipesToPreviewDescription."</p>";
            } 
        } ?>
    </div>

    <!-- RECIPE GRID -->
    <div class="row small-up-1 medium-up-2">
    <?php
        if(is_front_page()) {

            $do_not_duplicate = array();
            
            // ----------------------------------------------------------------
            // FEATURED RECIPES
            // ----------------------------------------------------------------

                $args = array(
                    'post_type' => 'recipe',
                    'tag' => 'featured'
                );
                // The query
                $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) { ?>
                    <?php while ( $query->have_posts() ) : $query->the_post() ; ?>

                        <?php $do_not_duplicate[] = $post->ID; ?>

                        <a class="column recipe-preview"
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

                    <?php endwhile; ?>
                
            <?php }
                /* Restore original Post Data */
                wp_reset_postdata();





            // ----------------------------------------------------------------
            // RECIPE OF THE WEEK
            // ----------------------------------------------------------------

                $args = array(
                    'post_type' => 'recipe',
                    'post__not_in' => $do_not_duplicate,
                    'tag' => 'recipe-of-the-week'
                );
                // The query
                $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) { ?>
                    <?php while ( $query->have_posts() ) : $query->the_post() ; ?>

                        <?php $do_not_duplicate[] = $post->ID; ?>

                        <a class="column recipe-preview"
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

                <?php endwhile; ?>
                
            <?php }
                /* Restore original Post Data */
                wp_reset_postdata();





            // ----------------------------------------------------------------
            // NEW RECIPES
            // ----------------------------------------------------------------

                $args = array(
                    'post_type' => 'recipe',
                    'post__not_in' => $do_not_duplicate,
                    'posts_per_page' => ((count($do_not_duplicate) & 1) ? 3 : 4),
                );
                // The query
                $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) { ?>
                    <?php while ( $query->have_posts() ) : $query->the_post() ; ?>

                        <?php $do_not_duplicate[] = $post->ID; ?>

                        <a class="column recipe-preview"
                            href="<?php the_permalink(); ?>"
                            title="<?php the_title_attribute(); ?>">
                            <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail')); ?>
                            <span class="recipe-title"><?php the_title(); ?></span>
                            <span class="recipe-subtitle">New recipe<?php
                                // TAGS (Terms) 
                                // the_terms( $post->ID, 'post_tag', '', ', ' );
                                $terms = get_the_terms($post->ID, 'post_tag');
                                $index = 0;
                                if ( $terms && ! is_wp_error( $terms ) ) {
                                    echo ", ";
                                    foreach ( $terms as $term ) {
                                        if ($index > 0) echo ', ';
                                        echo $term->name;
                                        $index++;
                                    } 
                                }
                            ?></span>
                        </a>

                <?php endwhile; ?>
                
            <?php }
                /* Restore original Post Data */
                wp_reset_postdata();

        } // if(is_front_page())

        // Else, parse the $recipesToPreview array
        else {
            foreach ($recipesToPreview as $recipe) { ?>
                <a class="column recipe-preview"
                    href="<?php echo get_permalink($recipe->ID); ?>"
                    title="<?php echo $recipe->post_title; ?>">
                    
                    <?php echo(get_the_post_thumbnail($recipe->ID, 'post-thumbnail')); ?>
                    <span class="recipe-title"><?php echo $recipe->post_title; ?></span>
                    <span class="recipe-subtitle">
                    <?php 
                        $terms = get_the_terms($recipe->ID, 'post_tag');
                        $index = 0;
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                if ($index > 0) echo ', ';
                                echo $term->name;
                                $index++;
                            } 
                        }
                    ?>
                    </span>
                </a>

            <?php }
        }
    ?>
    </div>

    <?php if(is_front_page()) { ?>
        <a class="button secondary button--view-more" href="/recipes">More recipes</a>
    <?php } ?>
</section>