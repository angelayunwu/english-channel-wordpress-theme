<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/tribe-events-bar.class.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */
?>

<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

global $wp;
$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );

 ?>

<?php do_action('tribe_events_bar_before_template') ?>
<div id="tribe-events-bar">

	<form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">

		<!-- Mobile Filters Toggle -->

		<div id="tribe-bar-collapse-toggle" <?php if ( count( $views ) == 1 ) { ?> class="tribe-bar-collapse-toggle-full-width"<?php } ?>>
			<?php _e( 'Find Events', 'tribe-events-calendar' ) ?><span class="tribe-bar-toggle-arrow"></span>
		</div>

		<!-- Views -->
		<?php if ( count( $views ) > 1 ) { ?>
		<div id="tribe-bar-views">
			<div class="tribe-bar-views-inner tribe-clearfix">
				<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Views Navigation', 'tribe-events-calendar' ) ?>zzzz</h3>
				<label><?php _e( 'View As', 'tribe-events-calendar' ); ?></label>
				<select class="tribe-bar-views-select tribe-no-param" name="tribe-bar-view">
					<?php foreach ( $views as $view ) : ?>
						<option <?php echo tribe_is_view($view['displaying']) ? 'selected' : 'tribe-inactive' ?> value="<?php echo $view['url'] ?>" data-view="<?php echo $view['displaying'] ?>">
							<?php echo $view['anchor'] ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div><!-- .tribe-bar-views-inner -->
		</div><!-- .tribe-bar-views -->
		<?php } // if ( count( $views ) > 1 ) ?>


	</form><!-- #tribe-bar-form -->

</div><!-- #tribe-events-bar -->
<?php do_action('tribe_events_bar_after_template') ?>
