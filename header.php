<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Meta -->
    <!-- ======================================================================= -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">
    <link rel="alternate" type="application/rss+xml" title="Gina Lioti Cooking" href="<?php echo site_url()."/feed/recipes" ?>" />
    <meta name="p:domain_verify" content="35207d07bacab562b77eca9b1f27ad02"/>
    <meta property="fb:pages" content="349519068543688" />

    <!-- THEME COLOR -->
    <!-- ======================================================================= -->
    <meta name="theme-color" content="#B3213D"> <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="msapplication-navbutton-color" content="#B3213D"> <!-- Windows Phone -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> <!-- iOS Safari -->

    <!-- APP TAGS -->
    <!-- ======================================================================= -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Icons -->
    <!-- ======================================================================= -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
    <link rel="icon" sizes="152x152" href="/apple-touch-icon-152x152.png">

    <!-- Styling -->
    <!-- ======================================================================= -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

    <!-- WP Head -->
    <!-- ======================================================================= -->
    <?php wp_head(); ?>
    <!-- /wp_head END -->

    <!-- Google Analytics HEAD -->
    <!-- ======================================================================= -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-749229-27']);
        _gaq.push(['_trackPageview']);
    </script>

</head>

<body <?php body_class(); ?>>
    <aside class="cooking-club-preview-mini hide-for-large">
        <div class="row columns">
            <?php echo do_shortcode('[mc4wp_form]'); ?>
        </div>
    </aside>
    <header class="expanded">
        <div class="row">
            <div class="columns inner">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'ginalioti' ); ?>" rel="home">
                    <img class="app-logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/gina_lioti_chef_logo.svg" alt="Gina Lioti Cooking" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?> – <?php bloginfo( 'description' ); ?>">
                </a>

                <label class="toggle-navigation-label hide-for-medium" for="show-navigation-input"><i class="ion-navicon"></i></label>

                <input id="show-navigation-input" class="hide" type="checkbox">

                <nav class="show-for-medium">
                    <ul>
                        <li class="show-for-large">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon ion-home <?php if(is_front_page()) echo('active'); ?>" title="Home"></a>
                        </li>
                        <li>
                            <a href="/search" class="icon ion-search <?php if(is_page('search')) echo('active'); ?>" title="Search">
                                <span class="show-for-small-only">Search</span>
                            </a>
                        </li>
                        <li>
                            <a href="/recipes" title="Recipes" class="<?php if(is_page('recipes')) echo('active'); ?>">Recipes</a>
                        </li>
                        <li>
                            <a href="/ingredients" title="Ingredients" class="<?php if(is_page('ingredients')) echo('active'); ?>">Ingredients</a>
                        </li>
                        <li>
                            <a href="/hello" class="<?php if(is_page('hello')) echo('active'); ?>">
                                Gina <span class="show-for-large">Lioti</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <a class="button show-for-large" href="/cooking-club" class="<?php if(is_page('cooking-club')) echo('active'); ?>">COOKING CLUB</a>
            </div>
        </div>
    </header>

    <main>





