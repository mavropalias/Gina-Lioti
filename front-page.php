<?php get_header(); ?>

<!-- ABOUT GINA LIOTI -->
<section class="section--mini">
    <p>
        <a href="hello"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti.jpg"></a>
    </p>
    <div class="row columns">
        <p class="lead">&ldquo;I want to show you the absolute best of Greek cuisine. My recipes are delicious, simple and easy. &rdquo;<p>
        <a class="button secondary button--view-more" href="/hello">Hello</a>
    </div>
</section>

<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--ingredients-preview' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>


<?php get_footer(); ?>