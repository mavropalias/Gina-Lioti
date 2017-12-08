<?php get_header(); ?>

<div class="row column">
    <h1 class="title">Hello</h1>
</div>

<?php
$id = get_page_by_path( 'hello' );;
$post = get_page($id);

$content = wptexturize($post->post_content);
$content = convert_chars($content);
$content = wpautop($content);
$content = prepend_attachment($content);
?>

<div class="row">
    <div class="small-12 medium-8 columns">
        <?php echo $content; ?>
    </div>
    <div class="small-12 medium-4 columns">
        <?php echo(get_the_post_thumbnail($post->ID, 'post-thumbnail', array( 'class' => '' ))); ?>
        <div class="margin-top-1">
            <?php echo do_shortcode( '[contact-form-7 id="442" title="Contact Gina Lioti"]' ); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>