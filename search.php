<?php get_header(); ?>
<?php 
    global $query_string;
?>

    <section>
        <div class="row column">
            <h1 class="title">Search recipes</h1>
        </div>

        <form action="/" method="get">
            <div class="row column">
                <label>Type a recipe or ingredient name:
                    <div class="input-group">
                        <input id="search"
                            class="input-group-field"
                            type="text"
                            name="s"
                            placeholder="e.g. tzatziki or beef"
                            value="<?php the_search_query(); ?>"
                            autofocus>
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Search">
                        </div>
                    </div>
                </label>
            </div>
        </form>
    </section>

<!-- SEARCH RESULTS -->
<!-- ======================================================================= -->

    <?php
        if(strlen($query_string) > 0) {
            // default search parameters
            $search_term = "";
            $search_tag = "";
            $search_taxonomy = ["main", "side", "dessert"];


            $search_parameters = explode("&", $query_string);
            foreach ( $search_parameters as $seach_param ) {
                $param_label = explode("=", $seach_param)[0];
                $param_value = urldecode(explode("=", $seach_param)[1]);

                switch ($param_label) {
                    case "s":
                        $search_term = $param_value;
                        break;
                    case "tag":
                        $search_tag = $param_value;
                        break;
                    case "course":
                        $search_taxonomy = $param_value;
                        break;
                    default:
                        break;
                }
            } 

            if (strlen($search_term) > 0 || strlen($search_tag) > 0) {
                $search_query_args = array(
                    'post_type' => 'recipe',
                    's' => $search_term,
                    'posts_per_page' => 20,
                    'tag' => $search_tag,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'course',
                            'field'    => 'name',
                            'terms'    => $search_taxonomy,
                        ),
                    ),
                );

                // print_r($search_query_args);

                $custom_search_query = new WP_Query($search_query_args);

                if ($custom_search_query->found_posts > 0) {
                    set_query_var( 'recipesToPreviewTitle', $custom_search_query->found_posts." recipes with ".$search_term.":" );
                    set_query_var( 'recipesToPreviewDescription', null );
                    set_query_var( 'recipesToPreview', $custom_search_query->posts );
                    get_template_part( 'partial--recipes-preview' );
                } else { ?>
                    <section>
                        <div class="row column">
                            <h2>No recipes widh <?php echo $search_term; ?>, yet :(</h2>
                            <p class="lead">Subscribe to get my updates:</p>
                        </div>
                    </section>
                    <?php get_template_part( 'partial--cooking-club-preview' ); ?>
                <? }                
            }
        }
    ?>

<?php get_footer(); ?>