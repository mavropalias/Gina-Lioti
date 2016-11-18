<?php























// OLD FUNCTIONS
// =======================================================

add_action( 'after_setup_theme', 'ginalioti_setup' );
function ginalioti_setup()
{
  load_theme_textdomain( 'ginalioti', get_template_directory() . '/languages' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'post-thumbnails' );
  global $content_width;
  if ( ! isset( $content_width ) ) $content_width = 640;
  register_nav_menus(
    array( 'main-menu' => __( 'Main Menu', 'ginalioti' ) )
    );
}
add_action( 'wp_enqueue_scripts', 'ginalioti_load_scripts' );
function ginalioti_load_scripts()
{
  wp_deregister_script('jquery');
  // wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"), false, '2.1.1', true);

  // wp_enqueue_script( 'jquery' );
  // wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/app-min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app-min.js', array(), '1.0.0', false );
}
add_action( 'comment_form_before', 'ginalioti_enqueue_comment_reply_script' );
function ginalioti_enqueue_comment_reply_script()
{
  if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'ginalioti_title' );
function ginalioti_title( $title ) {
  if ( $title == '' ) {
    return '&rarr;';
  } else {
    return $title;
  }
}
add_filter( 'wp_title', 'ginalioti_filter_wp_title' );
function ginalioti_filter_wp_title( $title )
{
  return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'ginalioti_widgets_init' );
function ginalioti_widgets_init()
{
  register_sidebar( array (
    'name' => __( 'Sidebar Widget Area', 'ginalioti' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<div id="%1$s" class="row widget-container %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

  register_sidebar( array (
    'name' => __( 'Header Widget Area', 'ginalioti' ),
    'id' => 'header-widget-area',
    'before_widget' => '<div id="%1$s" class="row widget-container %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
}
function ginalioti_custom_pings( $comment )
{
  $GLOBALS['comment'] = $comment;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
  <?php
}
add_filter( 'get_comments_number', 'ginalioti_comments_number' );
function ginalioti_comments_number( $count )
{
  if ( !is_admin() ) {
    global $id;
    $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
    return count( $comments_by_type['comment'] );
  } else {
    return $count;
  }
}

function new_excerpt_more( $more ) {
  return ' …';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
  return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wp_get_attachment( $attachment_id ) {
  $attachment = get_post( $attachment_id );
  return array(
      'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
      'caption' => $attachment->post_excerpt,
      'description' => $attachment->post_content,
      'href' => get_permalink( $attachment->ID ),
      'src' => $attachment->guid,
      'title' => $attachment->post_title
  );
}





// =============================================================================
// remove wordpress autoformatting
// =============================================================================

  function get_rid_of_wpautop(){
    remove_filter ('the_content', 'wpautop');
    remove_filter ('the_excerpt', 'wpautop');
  }
  // add_action( 'template_redirect', 'get_rid_of_wpautop' );





// =============================================================================
// set custom image sizes
// =============================================================================

  add_image_size( 'medium', 150, 150, true );
  add_image_size( 'xxs', 48, 48, true );
  add_image_size( 'xs', 96, 96, true );
  add_image_size( 's', 300, 157, true );
  add_image_size( 'm', 600, 315, true );
  add_image_size( 'l', 1200, 630, true );
  add_image_size( 'xl', 2304, 1296, true );

  add_image_size( 's_nocrop', 600, 315, false );
  add_image_size( 'm_nocrop', 600, 315, false );
  add_image_size( 'l_nocrop', 1200, 630, false );
  add_image_size( 'xl_nocrop', 2304, 1296, false );





// =============================================================================
// Enable featured images
// =============================================================================

  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 600, 315, true );

  // Also enable multiple feature images plugin
  // ---------------------------------------------------------------------------
  if( class_exists( 'kdMultipleFeaturedImages' ) ) {

    for($n = 1; $n <= 15; $n++) {
      $args = array(
              'id' => 'featured-image-'.$n,
              'post_type' => 'recipe',      // Set this to post or page
              'labels' => array(
                  'name'      => 'Featured image '.$n,
                  'set'       => 'Set featured image '.$n,
                  'remove'    => 'Remove featured image '.$n,
                  'use'       => 'Use as featured image '.$n,
              )
      );

      new kdMultipleFeaturedImages( $args );
    }
  }





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

    // remove Open Sans font
    add_action( 'wp_enqueue_scripts', 'my_deregister_styles', 100 );
    function my_deregister_styles() {
      wp_deregister_style( 'open-sans' );
    }

    // add custom fonts
    // add_action( 'wp_enqueue_scripts','highwind_add_myfonts');

    // function highwind_add_myfonts() {
    // wp_enqueue_style( 'my-fonts', 'http://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Alegreya:700' );
    //  //add your own fonts here.
    // }
