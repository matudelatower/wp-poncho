<?php get_header(); ?>

    <main role="main">
		<?php $seccion_header_imagen_fondo = get_theme_mod( 'seccion_header_imagen_fondo' ); ?>
		<?php $seccion_header_titulo = get_theme_mod( 'seccion_header_titulo' ); ?>
		<?php $seccion_header_descripcion = get_theme_mod( 'seccion_header_descripcion' ); ?>
		<?php if ( $seccion_header_imagen_fondo ): ?>
        <section class="jumbotron" style="background-image: url('<?php $seccion_header_imagen_fondo; ?>');">
			<?php else: ?>
            <section class="jumbotron"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/modernizacion.jpg');">
				<?php endif ?>
                <div class="jumbotron_bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <ul class="list-inline pull-right">
                                    <li>
                                        <a href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">Institucional</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jumbotron_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
                                <h1><?php echo $seccion_header_titulo; ?></h1>
                                <p><?php echo $seccion_header_descripcion; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay"></div>
            </section>

			<?php $seccion_acercade_activo = get_theme_mod( 'seccion_acercade_activo' ); ?>
			<?php $seccion_acercade_titulo = get_theme_mod( 'seccion_acercade_titulo' ); ?>
			<?php $seccion_acercade_descripcion = get_theme_mod( 'seccion_acercade_descripcion' ); ?>

			<?php if ( $seccion_acercade_activo ) { ?>
                <section>
                    <article class="container content_format">
                        <div class="col-md-8 col-md-offset-2">


                            <h2><?php echo $seccion_acercade_titulo; ?></h2>

							<?php echo $seccion_acercade_descripcion; ?>

							<?php $seccion_que_hacemos_activo = get_theme_mod( 'seccion_que_hacemos_activo' ); ?>
							<?php $seccion_que_hacemos_titulo = get_theme_mod( 'seccion_que_hacemos_titulo' ); ?>
							<?php $seccion_que_hacemos_descripcion = get_theme_mod( 'seccion_que_hacemos_descripcion' ); ?>

							<?php if ( $seccion_que_hacemos_activo ) { ?>
                                <h2><?php echo $seccion_que_hacemos_titulo; ?></h2>

								<?php echo $seccion_que_hacemos_descripcion; ?>

							<?php } ?>

                        </div>
                    </article>
                </section>
			<?php } ?>

			<?php $seccion_servicios_activo = get_theme_mod( 'seccion_servicios_activo' ); ?>
			<?php $seccion_servicios_titulo_seccion = get_theme_mod( 'seccion_servicios_titulo_seccion' ); ?>
			<?php $seccion_servicios_titulo = get_theme_mod( 'seccion_servicios_titulo' ); ?>

			<?php if ( $seccion_servicios_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <h2><?php echo $seccion_servicios_titulo_seccion; ?></h2>
                            <div class="row">
								<?php for ( $i = 1; $i <= 3; $i ++ ) { ?>
									<?php $seccion_servicios_widget_icono_ = get_theme_mod( "seccion_servicios_widget_icono_$i" ); ?>
									<?php $seccion_servicios_widget_titulo_ = get_theme_mod( "seccion_servicios_widget_titulo_$i" ); ?>
									<?php $seccion_servicios_widget_descripcion_ = get_theme_mod( "seccion_servicios_widget_descripcion_$i" ); ?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="icon-item">
                                            <i class="<?php echo $seccion_servicios_widget_icono_; ?>"></i>
                                            <h3><?php echo $seccion_servicios_widget_titulo_; ?></h3>
                                            <p><?php echo $seccion_servicios_widget_descripcion_; ?></p>
                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                        </div>

                    </div>
                </section>
			<?php } ?>


			<?php $seccion_links_no_destacados_activo = get_theme_mod( 'seccion_links_no_destacados_activo' ); ?>
			<?php $seccion_links_no_destacados_titulo_seccion = get_theme_mod( 'seccion_links_no_destacados_titulo_seccion' ); ?>


			<?php if ( $seccion_links_no_destacados_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_no_destacados_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
							<?php


							$category_id_links_no_destacados = get_theme_mod( 'seccion_links_no_destacados_categoria' );

							// Get the URL of this category
							$category_link_links_no_destacados = get_category_link( $category_id_links_no_destacados );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_no_destacados
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">

                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-primary" href="<?php echo $category_link_links_no_destacados; ?>">Ver
                                    Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_no_destacados_con_descripcion_activo = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_activo' ); ?>
			<?php $seccion_links_no_destacados_con_descripcion_titulo_seccion = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_titulo_seccion' ); ?>


			<?php if ( $seccion_links_no_destacados_con_descripcion_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_no_destacados_con_descripcion_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
							<?php

							$category_id_links_no_destacados_con_descripcion = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_categoria' );

							// Get the URL of this category
							$category_link_links_no_destacados_con_descripcion = get_category_link( $category_id_links_no_destacados_con_descripcion );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_no_destacados_con_descripcion
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">

                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                            <p class="text-muted">
												<?php
												$text           = strip_shortcodes( $recent["post_content"] );
												$text           = apply_filters( 'the_content', $text );
												$text           = str_replace( ']]>', ']]&gt;', $text );
												$excerpt_length = apply_filters( 'excerpt_length', 10 );
												$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
												$text           = wp_trim_words( $text,
													$excerpt_length,
													$excerpt_more );
												echo $text;
												?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo $category_link_links_no_destacados_con_descripcion; ?>"
                                   class="btn btn-primary">Ver Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_destacados_con_icono_descripcion_activo = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_activo' ); ?>
			<?php $seccion_links_destacados_con_icono_descripcion_titulo_seccion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_titulo_seccion' ); ?>


			<?php if ( $seccion_links_destacados_con_icono_descripcion_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_destacados_con_icono_descripcion_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">

							<?php

							$category_id_links_destacados_con_icono_descripcion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_categoria' );

							// Get the URL of this category
							$category_link_links_destacados_con_icono_descripcion = get_category_link( $category_id_links_destacados_con_icono_descripcion );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_destacados_con_icono_descripcion
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default panel-icon"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
                                        <div class="panel-heading"><i class="fa fa-file"></i></div>
                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                            <p class="text-muted">
												<?php
												$text           = strip_shortcodes( $recent["post_content"] );
												$text           = apply_filters( 'the_content', $text );
												$text           = str_replace( ']]>', ']]&gt;', $text );
												$excerpt_length = apply_filters( 'excerpt_length', 10 );
												$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
												$text           = wp_trim_words( $text,
													$excerpt_length,
													$excerpt_more );
												echo $text;
												?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>


                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo $category_link_links_destacados_con_icono_descripcion; ?>"
                                   class="btn btn-primary">Ver Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_destacados_con_fotos_activo = get_theme_mod( 'seccion_links_destacados_con_fotos_activo' ); ?>
			<?php $seccion_links_destacados_con_fotos_titulo_seccion = get_theme_mod( 'seccion_links_destacados_con_fotos_titulo_seccion' ); ?>


			<?php if ( $seccion_links_destacados_con_fotos_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_destacados_con_fotos_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
	                        <?php

	                        $category_id_links_destacados_con_icono_descripcion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_categoria' );

	                        // Get the URL of this category
	                        $category_link_links_destacados_con_icono_descripcion = get_category_link( $category_id_links_destacados_con_icono_descripcion );

	                        $args         = array(
		                        'numberposts' => '4',
		                        'category'    => $category_id_links_destacados_con_icono_descripcion
	                        );
	                        $recent_posts = wp_get_recent_posts( $args );
	                        foreach ( $recent_posts as $recent ) {
		                        ?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
	                                    <?php
	                                    if ( has_post_thumbnail( $recent["ID"] ) ) {
		                                    ?>
                                            <div style="background-image:url('<?php echo get_the_post_thumbnail_url( $recent["ID"],
			                                    'thumbnail' ); ?>');"
                                                 class="panel-heading"></div>
		                                    <?php
	                                    } else {
		                                    ?>
                                            <div style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"
                                                 class="panel-heading"></div>
		                                    <?php
	                                    }
	                                    ?>
                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>

                                        </div>
                                    </a>
                                </div>
		                        <?php
	                        }
	                        wp_reset_query();
	                        ?>
                        </div>
                    </div>
                </section>
			<?php } ?>

			<?php $seccion_noticias_activo = get_theme_mod( 'seccion_noticias_activo' ); ?>
			<?php $seccion_noticias_titulo_seccion = get_theme_mod( 'seccion_noticias_titulo_seccion' ); ?>


			<?php if ( $seccion_noticias_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_noticias_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">

							<?php
							$category_id = get_cat_ID( 'Noticias' );

							// Get the URL of this category
							$category_link = get_category_link( $category_id );

							$args         = array( 'numberposts' => '4', 'category' => $category_id );
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default panel-md"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
										<?php
										if ( has_post_thumbnail( $recent["ID"] ) ) {
											?>
                                            <div style="background-image:url('<?php echo get_the_post_thumbnail_url( $recent["ID"],
												'thumbnail' ); ?>');"
                                                 class="panel-heading"></div>
											<?php
										} else {
											?>
                                            <div style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"
                                                 class="panel-heading"></div>
											<?php
										}
										?>

                                        <div class="panel-body">
                                            <time><?php echo date( get_option( 'date_format' ),
													strtotime( $recent['post_date'] ) ); ?></time>
                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>


                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-primary" href="<?php echo $category_link; ?>">Ver todas las
                                    noticias</a>
                            </div>
                        </div>
                    </div>
                </section>
			<?php } ?>

            <section class="bg-gray modulo-mapaestado">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Ministro</h2>
                        </div>
                    </div>

                    <div class="row margin-20">
                        <div class="col-xs-12 col-sm-3 col-md-2">
                            <img class="img-responsive img-rounded" alt=""
                                 src="<?php echo get_stylesheet_directory_uri(); ?>/images/ministro_placeholder.jpg">
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <h2>Juan Perez<br>
                                <small>Lorem ipsum dolor sit amet</small>
                            </h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, nihil maiores, rem
                                itaque
                                laborum voluptas temporibus quod vel recusandae ab repudiandae nesciunt corrupti
                                incidunt,
                                in. Veniam sit voluptate quisquam culpa?</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Secretarios</h2>
                        </div>
                    </div>

                    <div class="row panels-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-disabled">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Subsecretarios</h2>
                        </div>
                    </div>

                    <div class="row panels-row">
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-disabled">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-disabled">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="panel panel-default"
                               href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">
                                <div class="panel-body">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>


			<?php $seccion_contacto_activo = get_theme_mod( 'seccion_contacto_activo' ); ?>
			<?php $seccion_contacto_titulo_seccion = get_theme_mod( 'seccion_contacto_titulo_seccion' ); ?>
			<?php $seccion_contacto_titulo_formulario = get_theme_mod( 'seccion_contacto_titulo_formulario' ); ?>


            <section class="modulo-contacto">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h2 class="h3 section-title"><?php echo $seccion_contacto_titulo_seccion; ?></h2>
                            <div>
                                <!--						<h5>Lorem ipsum dolor sit amet.</h5>-->
                                <p class="margin-40">
									<?php $poncho_telefono = get_theme_mod( 'poncho_telefono' ); ?>
									<?php $poncho_celular = get_theme_mod( 'poncho_celular' ); ?>
									<?php $poncho_mail = get_theme_mod( 'poncho_mail' ); ?>
									<?php $poncho_direccion = get_theme_mod( 'poncho_direccion' ); ?>
                                    <strong>Dirección:</strong> <?php echo $poncho_direccion ?><br>
									<?php if ( $poncho_celular ) : ?>
                                        <strong>Celular:</strong> <?php echo $poncho_celular ?><br>
									<?php endif; ?>
                                    <strong>Teléfono:</strong> <?php echo $poncho_telefono ?><br>
                                    <strong>Correo electrónico:</strong> <a
                                            href="mailto:<?php echo $poncho_mail ?>"><?php echo $poncho_mail ?></a>
                                </p>
                                <h5>Redes sociales</h5>
								<?php $poncho_facebook_text = get_theme_mod( 'poncho_facebook_text' ); ?>
								<?php $poncho_twitter_text = get_theme_mod( 'poncho_twitter_text' ); ?>
								<?php $poncho_instagram_text = get_theme_mod( 'poncho_instagram_text' ); ?>

                                <div class="social-share">
                                    <ul class="list-inline">
                                        <li><a target="_blank" href="<?php echo $poncho_facebook_text; ?>"><i
                                                        class="fa fa-facebook"></i></a></li>
                                        <li><a target="_blank" href="<?php echo $poncho_twitter_text; ?>"><i
                                                        class="fa fa-twitter "></i></a></li>
                                        <li><a target="_blank" href="<?php echo $poncho_instagram_text; ?>"><i
                                                        class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div>
                                <h2 class="h3 section-title"><?php echo $seccion_contacto_titulo_formulario; ?></h2>
                                <form>
                                    <div class="form-group">
                                        <label class="text-muted">Escribí tu mensaje o consulta para el Ministerio de
                                            Modernización</label>
                                        <textarea class="form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Enviar mi consulta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


    </main>
<?php get_footer(); ?>