<?php
/**
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >



<div class="entry-content">
		

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

		$ptype_list = wp_get_object_terms($post->ID, 'project-types');
		if(!empty($ptype_list)){
  			if(!is_wp_error( $ptype_list )){
				echo '<div class="project-kind">Kind: <ul>';
				foreach($ptype_list as $p){
		  			echo '<li><a href="' . get_term_link($p->slug, 'project-types') . '">' . $p->name .'</a></li>'; 
				}
				echo '</ul></div>';
  			}	
		}
?>
	
	</div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
