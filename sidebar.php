<aside id="sidebar" role="complementary" class="medium-12 large-3 columns">
  <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
      <ul class="xoxo">
        <?php dynamic_sidebar( 'primary-widget-area' ); ?>
      </ul>
  <?php endif; ?>
</aside>