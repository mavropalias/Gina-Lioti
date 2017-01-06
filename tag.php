<?php get_header(); ?>

<?php 
    set_query_var( 'recipesToPreviewTitle', ucfirst(single_term_title("", false))." recipes" );
    set_query_var( 'recipesToPreviewDescription', term_description() );
    set_query_var( 'recipesToPreview', $wp_query->posts );
    get_template_part( 'partial--recipes-preview' );
?>

<?php get_template_part( 'partial--cooking-club-preview' ); ?>

<?php get_footer(); ?>