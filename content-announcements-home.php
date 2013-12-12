<?php
/**
 */
?>

<article id="post-<?php the_ID(); ?>" >
 
	<div class="t">
	<div class="l">
<?php 
		$terms = wp_get_post_terms( get_the_ID(), 'kind', array("fields" => "names"));
		echo '<div class="news-kind">' . $terms[0] . '</div>';
		
		 ?>
	</div>
	<div class="r">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_title(); ?> <span class="meta-nav">&rarr;</span></a></h1>
	</div><!-- .entry-summary -->
</div>
 
</article><!-- #post-<?php the_ID(); ?> -->
