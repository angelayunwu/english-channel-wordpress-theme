<?php
/**
 */
?>

    <?php

// Setup an array of venue details for use later in the template
$venue_details = array();

if ( $venue_name = tribe_get_venue()) {
    $venue_details[] = $venue_name;
}
 if ( $venue_address = tribe_get_full_address() ) {
    $venue_details[] = $venue_address;
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard': '';
$has_venue_address = ( $venue_address ) ? ' location': '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'brick type-events' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php  the_post_thumbnail(); ?>
			</a>
		</div>
		<?php endif; // featured image ?>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><span class="info">Event: &nbsp;</span><?php the_title(); ?></a></h1>
		<?php
$subtitle = types_render_field( "subtitle", array( "raw"=>"true" ) );
if ( !empty( $subtitle ) ) {
	echo "<h2 class='subtitle'>$subtitle</h2>";
}
?>
	</header><!-- .entry-header -->
	<div class="tribe-events-event-meta <?php echo $has_venue . $has_venue_address; ?>">
        <?php if ( $venue_details ) : ?>
        <!-- Venue Display Info  -->
        <div class="tribe-events-venue-details">
            <?php echo implode( ', ', $venue_details ) ; ?>
        </div> <!-- .tribe-events-venue-details -->
    <?php endif; ?>
	<!-- Schedule & Recurrence Details -->
	<div class="updated published time-details">
		<?php echo tribe_events_event_schedule_details() ?>
		<?php echo tribe_events_event_recurring_info_tooltip() ?>
	</div>

	
</div><!-- .tribe-events-event-meta -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
