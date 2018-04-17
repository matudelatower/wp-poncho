<?php get_header(); ?>

    <main role="main">
		<?php
		if ( is_front_page() ) {
                echo '<span>frontpage</span>';

		} else {
			echo '<span>no</span>';
//			get_page_template();
		}
		?>
    </main>

<?php get_footer(); ?>