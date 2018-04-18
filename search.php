<?php get_header(); ?>
	<div class="container">

		<section>
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>

					<?php
					/*
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

					// End the loop.
				endwhile;

				// Previous/next page navigation.

				poncho_pagination();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</section>
	</div>
<?php get_footer(); ?>