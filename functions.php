<?php

// =============================================================================
// Theme actions & filters
// =============================================================================

    // after_setup_theme
    add_action( 'after_setup_theme', 'ginalioti_setup' );
    function ginalioti_setup()
    {
        // add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        add_theme_support( 'title-tag' );
        
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 675, true );
    }

    // wp_enqueue_scripts
    add_action( 'wp_enqueue_scripts', 'ginalioti_load_scripts' );
    function ginalioti_load_scripts()
    {
        wp_deregister_style( 'open-sans' );
        wp_deregister_script('jquery');
        //wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app-min.js', array(), '1.0.0', false );
    }

    // get_rid_of_wpautop
    add_action( 'template_redirect', 'get_rid_of_wpautop' );
    function get_rid_of_wpautop() {
        remove_filter ('the_content', 'wpautop');
        remove_filter ('the_excerpt', 'wpautop');
        remove_filter ('term_description','wpautop');
    }

    // REMOVE WP CODE FROM <HEAD>
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );





// =============================================================================
// Set custom image sizes
// =============================================================================

    // remove_image_size( 'medium');
    // remove_image_size( 'xxs');
    // remove_image_size( 'xs');
    // remove_image_size( 'ingredient-thumb');
    // remove_image_size( 's');
    // remove_image_size( 'm');
    // remove_image_size( 'l');
    // remove_image_size( 'xl');
    // remove_image_size( 's_nocrop');
    // remove_image_size( 'm_nocrop');
    // remove_image_size( 'l_nocrop');
    // remove_image_size( 'xl_nocrop');

    add_image_size( 'ingredient-thumb', 100, 116, true );
    add_image_size( 'ingredient-thumb-2x', 200, 232, true );
    add_image_size( 'ingredient-thumb-3x', 300, 348, true );
    add_image_size( 'xxs', 48, 48, true );//add_image_size( 'xxs', 200, 112, true );
    add_image_size( 'xs', 96, 96, true );//add_image_size( 'xs', 400, 225, true );
    add_image_size( 's', 300, 157, true );//add_image_size( 's', 800, 450, true );
    add_image_size( 'm', 600, 315, true );//add_image_size( 'm', 1200, 675, true );
    add_image_size( 'l', 1200, 630, true );//add_image_size( 'l', 1600, 900, true );
    add_image_size( 'xl', 2304, 1296, true );//add_image_size( 'xl', 2400, 1250, true );
    add_image_size( 'xxl', 3200, 1800, true );





// =============================================================================
// Enable taxonomy search
// =============================================================================

  function atom_search_where($where){
    global $wpdb;
    if (is_search())
      $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
    return $where;
  }

  function atom_search_join($join){
    global $wpdb;
    if (is_search())
      $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
    return $join;
  }

  function atom_search_groupby($groupby){
    global $wpdb;

    // we need to group on post ID
    $groupby_id = "{$wpdb->posts}.ID";
    if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

    // groupby was empty, use ours
    if(!strlen(trim($groupby))) return $groupby_id;

    // wasn't empty, append ours
    return $groupby.", ".$groupby_id;
  }

  add_filter('posts_where','atom_search_where');
  add_filter('posts_join', 'atom_search_join');
  add_filter('posts_groupby', 'atom_search_groupby');





// =============================================================================
// Custom RSS feed
// =============================================================================

  // add_action('init', 'customRSS');
  // function customRSS() {
  //         add_feed('gina-lioti-recipes', 'customRSSFunc');
  // }
  // function customRSSFunc() {
  //         get_template_part('rss', 'recipes');
  // }





// =============================================================================
// Helpers
// =============================================================================

    function convertToHoursMins($time, $format = '%d:%d') {
        settype($time, 'integer');
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    function time_to_iso8601_duration($time) {
        $units = array(
            "Y" => 365*24*3600,
            "D" =>     24*3600,
            "H" =>        3600,
            "M" =>          60,
            "S" =>           1,
        );

        $str = "P";
        $istime = false;

        foreach ($units as $unitName => &$unit) {
            $quot  = intval($time / $unit);
            $time -= $quot * $unit;
            $unit  = $quot;
            if ($unit > 0) {
                if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
                    $str .= "T";
                    $istime = true;
                }
                $str .= strval($unit) . $unitName;
            }
        }

        return $str;
    }



    // add custom fonts
    // add_action( 'wp_enqueue_scripts','highwind_add_myfonts');

    // function highwind_add_myfonts() {
    // wp_enqueue_style( 'my-fonts', 'http://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Alegreya:700' );
    //  //add your own fonts here.
    // }
