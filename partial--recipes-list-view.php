<div class="column row">
    <h1><?php if (!empty($partialRecipesListViewTitle)) echo $partialRecipesListViewTitle; else echo "Recipes"; ?></h1>

    <a href="#"><label class="toggle-photos-label" for="showphotos">Hide/Show recipe photos <i class="ion-qr-scanner"></i></label></a>
</div>

<section class="section--mini section--with-separator"></section>

<input id="showphotos" class="hide" type="checkbox" checked>

<section>
    <ol class="list-view">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <li class="list-item has-indicator">
                <a class="recipe-preview recipe-preview--large"
                    href="<?php the_permalink(); ?>"
                    title="<?php the_title_attribute(); ?>">
                    <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail')); ?>
                    <span class="recipe-title"><?php the_title(); ?></span>

                    <?php 
                        // TAGS (Terms) 
                        $terms = get_the_terms($post->ID, 'post_tag');

                        if (! empty( $terms )) {
                    ?>
                            <span class="recipe-subtitle"><?php
                                $index = 0;
                                foreach ( $terms as $term ) {
                                    if ($index > 0) echo ', ';
                                    echo $term->name;
                                    $index++;
                                } 
                            ?></span>
                    <?php } ?>
                </a>
            </li>
        <?php endwhile; endif; ?>
    </ol>
</section>