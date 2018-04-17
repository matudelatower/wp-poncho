<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
	            <?php if ( has_custom_logo( 0 ) ) {
		            echo get_custom_logo( 0 );
	            } else {
		            ?>
                    <img class="image-responsive" alt="Argentina.gob.ar - Presidencia de la Nación"
                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/argentinagob.svg">
	            <?php } ?>
                <br>
                <p class="text-muted small">Los contenidos de <?php bloginfo( 'title' ); ?> están licenciados bajo <a
                            href="https://creativecommons.org/licenses/by/2.5/ar/">Creative Commons Reconocimiento
                        2.5 Argentina License</a></p>
            </div>
            <div class="col-md-3 col-sm-6">
                <ul>
                    <li><a href="http://argob.github.io/poncho/ejemplos/pagina.html">Página</a></li>
                    <li><a href="http://argob.github.io/poncho/ejemplos/pagina-area.html">Página de área</a></li>
                    <li><a href="http://argob.github.io/poncho/ejemplos/pagina-navegacion.html">Página con
                            navegación</a></li>
                    <li><a href="http://argob.github.io/poncho/ejemplos/noticia.html">Noticia</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6">
                <ul>
                    <li><a href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">Términos y
                            condiciones</a></li>
                    <li><a href="http://argob.github.io/poncho/ejemplos/pagina-area.html#">Mapa del sitio</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

<!--<script src="./node_modules/jquery/dist/jquery.min.js"></script>-->
<!--<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>-->


</body>
</html>