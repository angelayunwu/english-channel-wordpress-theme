<?php
/**
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >



<div class="entry-summary">
		

		<?php the_content(); ?>
		<div class="all-meta">
		<?php the_tags('<div class="meta-tags">Tags: ', ', ', '</div>'); ?> 

		<?php 

		$u = get_post_meta($post->ID, 'wpcf-url', true);
		if (!empty($u)) {
			echo "<div class='meta-url'>Website: <a href='" .  $u   . "' target='blank'> " . $u . "</a></div>"; 
		}

$s = get_post_meta($post->ID, 'wpcf-status', true);
		if (!empty($s)) {
			echo "<div class='meta-status'>Status: " . $s . "</div>"; 
		}
		?>
	</div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
