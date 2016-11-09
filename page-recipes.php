<?php get_header(); ?>

<div class="column row">
    <h1 class="title">Recipes</h1>
</div>





<section class="section--mini section--with-separator">
    <ul class="list-view">
        <li class="list-item has-indicator"><a href="recipes-a-to-z">See A&ndash;to&ndash;Z list of all recipes</a></li>
    </ul>
</section>





<section class="recommended-item expanded">
    <div class="row">
        <div class="shrink columns">
            <img class="thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_advice.jpg">
        </div>
        <div class="columns">
            <p>My recipe of the week is:</p>
            <a href="recipe"><h2>Greek style oyster mushrooms</h2></a>
            <p class="lead">"They are delicious and healthy."</p>
            <cite>Gina Lioti</cite>
        </div>
    </div>

    <div class="row expanded">
        <a href="recipe.html">
            <img class="cover-photo" src="http://ginalioti.com/wp/wp-content/uploads/greek-style-oyster-mushrooms-recipe-1-2304x1296.jpg">
        </a>
    </div>
</section>

<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--recipes-preview' ); ?>
<?php get_template_part( 'partial--recipes-preview' ); ?>

<?php get_template_part( 'partial--cooking-tip' ); ?>
<?php get_template_part( 'partial--cooking-club-preview' ); ?>
<?php get_template_part( 'partial--ingredients-preview' ); ?>

<?php get_footer(); ?>