<?php
/**
 */
?>

<article id="post-<?php the_ID(); ?>" >
 <a href="<?php the_permalink(); ?>" rel="bookmark"> 
	<div class="t">
	<div class="l">
<?php 
		$terms = wp_get_post_terms( get_the_ID(), 'kind', array("fields" => "names"));
		echo '<div class="news-kind">' . $terms[0] . '</div>';
		
		 ?>
	<h1 class="entry-title"><?php the_title(); ?></h1></div>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary --></div>
 </a>
</article><!-- #post-<?php the_ID(); ?> -->
