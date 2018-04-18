<?php get_header(); ?>
    <main role="main">
        <!-- Articulo Principal -->

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>

	            <?php if ( has_post_thumbnail() ) { ?>
                    <section class="jumbotron jumboarticle"
                             style="background-image:url('<?php the_post_thumbnail_url( 'thumbnail' ); ?>');">

                    </section>
	            <?php } else { ?>
                    <section class="jumbotron jumboarticle"
                             style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/modernizacion.jpg');">

                    </section>
	            <?php } ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 overlap">
                            <div class="title-description">
								<?php the_title( '<h1>', '</h1>' ); ?>

                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="content_format">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
							<?php while ( have_posts() ) :
								the_post();
								/*
								 * Include the post format-specific template for the content. If you want to
								 * use this in a child theme, then include a file called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
//                                get_template_part( 'content', get_post_format() );
								// Previous/next post navigation.
								the_content();

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile;
							?>
                        </div>

                    </div>
                </div>
            </section>
        </article>

        <!-- Noticias Relacionadas/Ultimas -->

        <section class="container related-news">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 section-title">Artículos relacionados</h2>

                    <div class="row panels-row">

						<?php

						$categories = get_the_category( get_the_ID() );
						if ( $categories ) {
							$category_ids = array();
							foreach ( $categories as $individual_category ) {
								$category_ids[] = $individual_category->term_id;
							}

							$args = array(
								'category__in'     => $category_ids,
								'post__not_in'     => array( get_the_ID() ),
								'posts_per_page'   => 4, // Number of related posts that will be shown.
								'caller_get_posts' => 1
							);

							$my_query = new wp_query( $args );
							if ( $my_query->have_posts() ) {

								while ( $my_query->have_posts() ) {
									$my_query->the_post();
									?>

                                    <div class="col-md-3">
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"
                                           class="panel panel-default">
											<?php if ( has_post_thumbnail() ) { ?>
                                                <div class="panel-heading"
                                                     style="background-image:url('<?php the_post_thumbnail_url( 'thumbnail' ); ?>');"></div>
											<?php } else { ?>
                                                <div class="panel-heading"
                                                     style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"></div>
											<?php } ?>

                                            <header class="panel-body">
                                                <time class="text-muted"><?php the_time( 'M j, Y' ) ?></time>
                                                <h3><?php the_title(); ?></h3>
                                            </header>
                                        </a>
                                    </div>

									<?php
								}

							}
						}
						$post = $orig_post;
						wp_reset_query();

						?>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>