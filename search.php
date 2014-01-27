<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : 
			$numR = $wp_query->found_posts;
			?>

				<header class="page-header">
					<h2 class="page-desc">
						<?php 
						echo 'Showing ' . $numR . ' result'. (($numR > 1) ? 's ' : ' ') . ' for: ' . '<span>' . get_search_query() . '</span>' ; 
						?>
					</h2>
				</header><!-- .page-header -->

				<?php emphaino_content_nav( 'nav-above' ); ?>

			

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>
	

				<?php emphaino_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>