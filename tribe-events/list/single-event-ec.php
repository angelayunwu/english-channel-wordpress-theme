<?php 
/**
 * List View Single Event -- for working groups
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *   <div class="event-body <?php echo (has_post_thumbnail() ? 'thumbtrue' : '') ?>">
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 
global $post;
// Setup an array of venue details for use later in the template
$venue_details = array();

$venue_name = tribe_get_meta( 'tribe_event_venue_name' );

$venue_address = tribe_get_meta( 'tribe_event_venue_address' );

?>


<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<!-- Event Image -->


<h3 class="tribe-events-list-event-title summary">
	<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
		<?php the_title() ?>&nbsp;<span class="meta-nav">&rarr;</span>
	</a>
</h3>
 <?php   
     $subtitle = types_render_field("subtitle", array("raw"=>"true"));
     if (!empty($subtitle)) {
        echo "<h4 class='subtitle'>$subtitle</h4>";
 		}
     ?>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>
<div class="event-thumb"><?php echo tribe_event_featured_image( null, 'medium' ) ?></div>	
<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta ">

	<!-- Schedule & Recurrence Details -->
	<div class="updated published time-details">
		 <?php
    echo '<time datetime="' . tribe_get_start_date($post->ID, false, 'Y-m-d') . '">';
  	
    echo '<span class="dayofweek">' .tribe_get_start_date($post->ID, false, 'l') . ',</span>';
    echo '<span class="mon">' .tribe_get_start_date($post->ID, false, 'F') . '</span>';
    echo '<span class="dayofmonth">' .tribe_get_start_date($post->ID, false, 'j') . '</span>';
    echo '<span class="time">'.  tribe_get_start_date($post->ID, false, 'g:i A')  . '</span>&mdash;'; 
    echo '<span class="time">'.  tribe_get_end_date($post->ID, false, 'g:i A')  . '</span></time>'; 
    ?>

		<?php echo tribe_events_event_recurring_info_tooltip() ?>
	</div>
	
	<?php if (!empty($venue_name) ) : ?>
		<!-- Venue Display Info -->
		<div class="tribe-events-venue-details">
			<?php echo $venue_name ; ?>
		</div> <!-- .tribe-events-venue-details -->
	<?php endif; ?>


</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>



<!-- Event Content -->
<?php //do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<?php the_excerpt() ?>
	
</div><!-- .tribe-events-list-event-description -->
<?php //do_action( 'tribe_events_after_the_content' ) ?>
