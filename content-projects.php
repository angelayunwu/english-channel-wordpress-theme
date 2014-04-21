<?php
/**
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('brick'); ?>>
	<?php if( has_post_thumbnail() ): ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php 
					the_post_thumbnail();
					
				?>
			</a>
		</div>
		<?php endif; // featured image ?>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'emphaino' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php
		$subtitle = types_render_field("subtitle", array("raw"=>"true"));
     if (!empty($subtitle)) {
        echo "<h2 class='subtitle'>$subtitle</h2>";
 		}
 		?>
	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<footer>

	</footer>
	
</article><!-- #post-<?php the_ID(); ?> -->
