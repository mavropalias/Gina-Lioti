<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

  <!-- Title -->
  <!-- ======================================================================= -->
  <title><?php wp_title( ' | ', true, 'right' ); ?></title>

  <!-- Meta -->
  <!-- ======================================================================= -->
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=yes">
  <link rel="alternate" type="application/rss+xml" title="Gina Lioti Cooking" href="<?php echo site_url()."/feed/recipes" ?>" />
  <meta name="p:domain_verify" content="35207d07bacab562b77eca9b1f27ad02"/>
  <meta property="fb:pages" content="349519068543688" />
  <meta name="theme-color" content="#AF1E40">

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
  <link href='//fonts.googleapis.com/css?family=RobotoDraft:regular,bold,italic,thin,light,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
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
<!-- Sidebar -->
<!-- ======================================================================= -->
<header class="header" role="banner">
  <!-- Branding -->
  <div id="branding">
    <div id="site-title">
      <?php if ( ! is_singular() ) { echo '<h1>'; } ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'ginalioti' ); ?>" rel="home">
          <img class="app-logo" src="<?php echo get_template_directory_uri(); ?>/images/gina-lioti-logo.svg" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?> logo" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?> – <?php bloginfo( 'description' ); ?>">
        </a>
      <?php if ( ! is_singular() ) { echo '</h1>'; } ?>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="menu" role="navigation">

    <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

    <!-- Search -->
    <form action="/" method="get">
       <div class="row collapse postfix-round search">
        <div class="small-9 columns">
          <input type="text" name="s" id="search" placeholder="Search…" value="<?php the_search_query(); ?>" />
        </div>
        <div class="small-3 columns">
          <input type="submit" id="searchsubmit" value="Go" class="button postfix" />
        </div>
      </div>
    </form>

  </nav>

  <div class="row hide-for-small-only">
    <div class="large-12 columns">
      <a href="/newsletter/" title="Subscribe to my newsletter">
        <i class="ion-ios-email-outline social-icon newsletter"></i>
      </a>
      <a href="https://www.facebook.com/ginalioticooking" target="_blank" title="Like my page on Facebook">
        <i class="ion-social-facebook social-icon facebook"></i>
      </a>
      <a href="https://twitter.com/GinaLioti" target="_blank" title="Follow me on Twitter">
        <i class="ion-social-twitter social-icon twitter"></i>
      </a>
      <a href="https://www.pinterest.com/ginalioti/" target="_blank" title="Follow me on Pinterest">
        <i class="ion-social-pinterest social-icon pinterest"></i>
      </a>
    </div>
  </div>

</header>

<div class="row main-section">
  <div class="large-12 columns content">





