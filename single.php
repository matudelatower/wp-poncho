<?php get_header(); ?>
    <main role="main">
        <!-- Articulo Principal -->

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
                <section class="jumbotron jumboarticle" style="background-image:url(&#39;img/modernizacion.jpg&#39;);">
                    <div class="jumbotron_bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <ol class="breadcrumb pull-left">

<!--                                        <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#">Argentina</a></li>-->
<!--                                        <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#">Ministerio de Modernización</a></li>-->
<!--                                        <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#">Noticias</a></li>-->
<!--                                        <li class="active"><span>Pondrán en 1circulación billetes de 200 y 500 pesos</span></li>-->
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 overlap">
                            <div class="title-description">
                                <?php the_title( '<h1>', '</h1>' ); ?>

                                <div class="row">
                                    <div class="section-actions social-share">
                                        <p>Compartir en <br> redes sociales</p>
                                        <ul class="list-inline">
                                            <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-twitter "></i></a></li>
                                            <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-md-6 additional_data">
                                        <time class="text-muted"><?php echo get_the_date(); ?></time>
                                    </div>
                                </div>
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
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-actions social-share">
                                <p>Compartir en <br> redes sociales</p>
                                <ul class="list-inline">
                                    <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-twitter "></i></a></li>
                                    <li><a href="https://argob.github.io/poncho/ejemplos/noticia.html#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>

        <!-- Noticias Relacionadas/Ultimas -->

        <section class="container related-news">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 section-title">Últimas noticias del área</h2>

                    <div class="row panels-row">
                        <div class="col-md-3">
                            <a href="https://argob.github.io/poncho/ejemplos/noticia.html#" class="panel panel-default">
                                <div class="panel-heading" style="background-image:url(&#39;img/placeholder.png&#39;);"></div>
                                <header class="panel-body">
                                    <time class="text-muted">10 de Diciembre de 2015</time>
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                                </header>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="https://argob.github.io/poncho/ejemplos/noticia.html#" class="panel panel-default">
                                <div class="panel-heading" style="background-image:url(&#39;img/placeholder.png&#39;);"></div>
                                <header class="panel-body">
                                    <time class="text-muted">09 de Diciembre de 2015</time>
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                                </header>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="https://argob.github.io/poncho/ejemplos/noticia.html#" class="panel panel-default">
                                <div class="panel-heading" style="background-image:url(&#39;img/placeholder.png&#39;);"></div>
                                <header class="panel-body">
                                    <time class="text-muted">08 de Diciembre de 2015</time>
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                                </header>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="https://argob.github.io/poncho/ejemplos/noticia.html#" class="panel panel-default">
                                <div class="panel-heading" style="background-image:url(&#39;img/placeholder.png&#39;);"></div>
                                <header class="panel-body">
                                    <time class="text-muted">07 de Diciembre de 2015</time>
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                                </header>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>