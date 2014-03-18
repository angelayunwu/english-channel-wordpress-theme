<?php
/**
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" >
	<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'emphaino' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
</article><!-- #post-<?php the_ID(); ?> -->
