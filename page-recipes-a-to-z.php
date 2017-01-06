<?php get_header(); ?>

<?php
    $args = array(
        'post_type' => 'recipe',
        'orderby' => 'title',
        'order' => 'ASC'
    );
    // The query
    $wp_query = new WP_Query( $args );

    set_query_var( 'partialRecipesListViewTitle', "Recipes a-to-z" );
    get_template_part( 'partial--recipes-list-view' ); 
?>


<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_footer(); ?>