<?php get_header(); ?>

<!-- ABOUT GINA LIOTI -->
<section class="section--mini text-center">
    <a href="hello"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti.jpg"></a>
</section>

<section class="row section--mini">
    <div class="small-12 medium-expand columns">
        <p>I mastered the Greek cuisine at its origin. I brought my experience with me to Ireland and I infused it with artisanal Irish ingredients to create deliciously healthy, gourmet, dishes.<p>
    </div>
    <div class="small-12 shrink columns align-middle">
        <a href="cooking-club"><strong>Join my Cooking Club</strong></a>
    </div>
</section>

<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>
<?php get_template_part( 'partial--ingredients-preview' ); ?>


<?php get_footer(); ?>