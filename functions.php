<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/17
 * Time: 10:04
 */

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function poncho_enqueue_styles() {
//    wp_enqueue_style('roboto', get_template_directory_uri() . '/node_modules/argob-poncho/dist/css/roboto-fontface.css' );
//    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css' );
//    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.min.css' );
//    wp_enqueue_style('poncho', get_template_directory_uri() . '/node_modules/argob-poncho/dist/css/poncho.min.css' );
//    wp_enqueue_style('global', get_template_directory_uri() . '/dist/global.css' );

}
add_action( 'wp_enqueue_scripts', 'poncho_enqueue_styles' );

function poncho_enqueue_scripts() {

//    wp_enqueue_script('jquery', get_template_directory_uri().'/node_modules/jquery/dist/jquery.min.js', [], '1.0.0', true );
//    wp_enqueue_script('bootstrap', get_template_directory_uri().'/node_modules/bootstrap/dist/js/bootstrap.min.js', ['jquery'], '1.0.0', true );
//    wp_enqueue_script('app', get_template_directory_uri().'/dist/app.js', [], '1.0.0', true );
	wp_enqueue_script('bundle', get_template_directory_uri().'/dist/bundle.js', [], '1.0.0', false );


//	if(is_front_page()){
//
//		wp_enqueue_script('bundle', get_template_directory_uri().'/dist/bundle.js', [], '1.0.0', false );
//	} else {
//		wp_enqueue_script('bundle', get_site_url().'/wp-content/themes/poncho/dist/bundle.js', [], '1.0.0', false );
//
//	}

}
add_action( 'wp_enqueue_scripts', 'poncho_enqueue_scripts' );


add_theme_support( 'custom-logo', array(
	'height'      => 248,
	'width'       => 248,
	'flex-height' => true,
) );



add_action( 'customize_register', 'registrar_customizer' );
function registrar_customizer( WP_Customize_Manager $wp_customize ) {
	require_once get_stylesheet_directory() . '/inc/dropdown-categoria.php';
	$wp_customize->add_section( 'homepage', array(
		'title' => esc_html_x( 'Homepage Options', 'customizer section title', 'poncho' ),
	) );
	$wp_customize->add_setting( 'poncho_categoria_dropdown', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'poncho_categoria_dropdown', array(
		'section'       => 'homepage',
		'label'         => esc_html__( 'Categoría', 'poncho' ),
		'description'   => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );
}


function poncho_pagination($pages = '', $range = 2)
{
	$showitems = ($range * 2)+1;

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}

	if(1 != $pages)
	{
		echo '<div class="row"><div class="col-md-12 text-center">';
		echo '<ul class="pagination">';
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)." aria-label='Anterior''><span aria-hidden='true'>«</span></a>";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' aria-label='Siguiente'><span aria-hidden='true'>»</span></a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</ul>\n";
		echo '</div></div>';
	}
}

?>