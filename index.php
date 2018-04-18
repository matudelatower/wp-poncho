<?php get_header(); ?>

    <main role="main">
		<?php
		if ( is_front_page() ) {
                echo '<span>frontpage</span>';

		} else { ?>

            <section id="primary" class="content-area">
                <div id="content" class="site-content" role="main">

					<?php if ( have_posts() ) : ?>


						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>

                        result

					<?php else : ?>
                        no result

						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; ?>

                </div><!-- #content .site-content -->
            </section><!-- #primary .content-area -->

		<?php }?>
    </main>

<?php get_footer(); ?>