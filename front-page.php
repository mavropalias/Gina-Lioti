<?php get_header(); ?>

<!-- ABOUT GINA LIOTI -->
<section class="section--mini">
    <a href="hello"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti.jpg"></a>
    <div class="row columns">
        <p class="lead">&ldquo;I mastered the Greek cuisine at its origin. I brought my experience with me to Ireland and I infused it with artisanal Irish ingredients to create deliciously healthy, gourmet, dishes.&rdquo; <a style="display:inline;" href="hello"><i class="ion-chevron-right"></i></a><p>
    </div>
</section>

<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--ingredients-preview' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>


<?php get_footer(); ?>