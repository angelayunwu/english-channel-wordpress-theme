<?php
/**
 * Sidebar
 *
 */
?>
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( is_active_sidebar( 'the-sidebar' ) ) : ?>
		<div class="widget-area sidebar" role="complementary">
			<div id="the-sidebar">
				<?php dynamic_sidebar( 'the-sidebar' ); ?>
			</div>
		</div><!-- .widget-area.sidebar -->
	<?php endif; // end sidebar ?>
