<?php
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Poncho 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function poncho_customize_register( $wp_customize ) {
	$color_scheme = poncho_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'poncho_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'poncho_customize_partial_blogdescription',
		) );
	}

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'poncho_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'poncho' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => poncho_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add custom header and sidebar text color setting and control.
	$wp_customize->add_setting( 'sidebar_textcolor', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_textcolor', array(
		'label'       => __( 'Header and Sidebar Text Color', 'poncho' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'poncho' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add custom header and sidebar background color setting and control.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header and Sidebar Background Color', 'poncho' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'poncho' ),
		'section'     => 'colors',
	) ) );

	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'poncho' );
}
add_action( 'customize_register', 'poncho_customize_register', 10 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Poncho 1.0
 * @see poncho_customize_register()
 *
 * @return void
 */
function poncho_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Poncho 1.0
 * @see poncho_customize_register()
 *
 * @return void
 */
function poncho_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Register color schemes for Poncho.
 *
 * Can be filtered with {@see 'poncho_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Poncho 1.0
 *
 * @return array An associative array of color scheme options.
 */
function poncho_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Poncho.
	 *
	 * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
	 *
	 * @since Poncho 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters( 'poncho_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'poncho' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'poncho' ),
			'colors' => array(
				'#111111',
				'#202020',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'poncho' ),
			'colors' => array(
				'#f4ca16',
				'#ffdf00',
				'#ffffff',
				'#111111',
				'#111111',
				'#f1f1f1',
			),
		),
		'pink'    => array(
			'label'  => __( 'Pink', 'poncho' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'purple'  => array(
			'label'  => __( 'Purple', 'poncho' ),
			'colors' => array(
				'#674970',
				'#2e2256',
				'#ffffff',
				'#2e2256',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'poncho' ),
			'colors' => array(
				'#e9f2f9',
				'#55c3dc',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
			),
		),
	) );
}

if ( ! function_exists( 'poncho_get_color_scheme' ) ) :
/**
 * Get the current Poncho color scheme.
 *
 * @since Poncho 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function poncho_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = poncho_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // poncho_get_color_scheme

if ( ! function_exists( 'poncho_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Poncho.
 *
 * @since Poncho 1.0
 *
 * @return array Array of color schemes.
 */
function poncho_get_color_scheme_choices() {
	$color_schemes                = poncho_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // poncho_get_color_scheme_choices

if ( ! function_exists( 'poncho_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Poncho 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function poncho_sanitize_color_scheme( $value ) {
	$color_schemes = poncho_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // poncho_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Poncho 1.0
 *
 * @see wp_add_inline_style()
 */
function poncho_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = poncho_get_color_scheme();

	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = poncho_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = poncho_hex2rgb( $color_scheme[4] );
	$colors = array(
		'background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1],
		'box_background_color'        => $color_scheme[2],
		'textcolor'                   => $color_scheme[3],
		'secondary_textcolor'         => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_textcolor_rgb ),
		'border_color'                => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_textcolor_rgb ),
		'border_focus_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_textcolor_rgb ),
		'sidebar_textcolor'           => $color_scheme[4],
		'sidebar_border_color'        => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_sidebar_textcolor_rgb ),
		'sidebar_border_focus_color'  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_sidebar_textcolor_rgb ),
		'secondary_sidebar_textcolor' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_textcolor_rgb ),
		'meta_box_background_color'   => $color_scheme[5],
	);

	$color_scheme_css = poncho_get_color_scheme_css( $colors );

	wp_add_inline_style( 'poncho-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'poncho_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Poncho 1.0
 */
function poncho_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', poncho_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'poncho_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Poncho 1.0
 */
function poncho_customize_preview_js() {
	wp_enqueue_script( 'poncho-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'poncho_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Poncho 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function poncho_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
	) );

	$css = <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Sidebar Background Color */
	body:before,
	.site-header {
		background-color: {$colors['header_background_color']};
	}

	/* Box Background Color */
	.post-navigation,
	.pagination,
	.secondary,
	.site-footer,
	.hentry,
	.page-header,
	.page-content,
	.comments-area,
	.widecolumn {
		background-color: {$colors['box_background_color']};
	}

	/* Box Background Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.sticky-post {
		color: {$colors['box_background_color']};
	}

	/* Main Text Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.page-links a,
	.sticky-post {
		background-color: {$colors['textcolor']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	a,
	.dropdown-toggle:after,
	.image-navigation a:hover,
	.image-navigation a:focus,
	.comment-navigation a:hover,
	.comment-navigation a:focus,
	.widget-title,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.comment-list .reply a:hover,
	.comment-list .reply a:focus,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['textcolor']};
	}

	/* Main Text Color */
	.entry-content a,
	.entry-summary a,
	.page-content a,
	.comment-content a,
	.pingback .comment-body > a,
	.author-description a,
	.taxonomy-description a,
	.textwidget a,
	.entry-footer a:hover,
	.comment-metadata a:hover,
	.pingback .edit-link a:hover,
	.comment-list .reply a:hover,
	.site-info a:hover {
		border-color: {$colors['textcolor']};
	}

	/* Secondary Text Color */
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	a:hover,
	a:focus,
	.main-navigation .menu-item-description,
	.post-navigation .meta-nav,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.image-navigation,
	.image-navigation a,
	.comment-navigation,
	.comment-navigation a,
	.widget,
	.author-heading,
	.entry-footer,
	.entry-footer a,
	.taxonomy-description,
	.page-links > .page-links-title,
	.entry-caption,
	.comment-author,
	.comment-metadata,
	.comment-metadata a,
	.pingback .edit-link,
	.pingback .edit-link a,
	.post-password-form label,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.no-comments,
	.site-info,
	.site-info a,
	.wp-caption-text,
	.gallery-caption,
	.comment-list .reply a,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	.logged-in-as a:hover,
	.comment-author a:hover {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['secondary_textcolor']};
	}

	/* Border Color */
	hr,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	/* Border Color */
	pre,
	abbr[title],
	table,
	th,
	td,
	input,
	textarea,
	.main-navigation ul,
	.main-navigation li,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.comment-navigation,
	.widget li,
	.widget_categories .children,
	.widget_nav_menu .sub-menu,
	.widget_pages .children,
	.site-header,
	.site-footer,
	.hentry + .hentry,
	.author-info,
	.entry-content .page-links a,
	.page-links > span,
	.page-header,
	.comments-area,
	.comment-list + .comment-respond,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-list .reply a,
	.no-comments {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	/* Border Focus Color */
	a:focus,
	button:focus,
	input:focus {
		outline-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['border_focus_color']};
	}

	input:focus,
	textarea:focus {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_focus_color']};
	}

	/* Sidebar Link Color */
	.secondary-toggle:before {
		color: {$colors['sidebar_textcolor']};
	}

	.site-title a,
	.site-description {
		color: {$colors['sidebar_textcolor']};
	}

	/* Sidebar Text Color */
	.site-title a:hover,
	.site-title a:focus {
		color: {$colors['secondary_sidebar_textcolor']};
	}

	/* Sidebar Border Color */
	.secondary-toggle {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_color']};
	}

	/* Sidebar Border Focus Color */
	.secondary-toggle:hover,
	.secondary-toggle:focus {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_focus_color']};
	}

	.site-title a {
		outline-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['sidebar_border_focus_color']};
	}

	/* Meta Background Color */
	.entry-footer {
		background-color: {$colors['meta_box_background_color']};
	}

	@media screen and (min-width: 38.75em) {
		/* Main Text Color */
		.page-header {
			border-color: {$colors['textcolor']};
		}
	}

	@media screen and (min-width: 59.6875em) {
		/* Make sure its transparent on desktop */
		.site-header,
		.secondary {
			background-color: transparent;
		}

		/* Sidebar Background Color */
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			color: {$colors['header_background_color']};
		}

		/* Sidebar Link Color */
		.secondary a,
		.dropdown-toggle:after,
		.widget-title,
		.widget blockquote cite,
		.widget blockquote small {
			color: {$colors['sidebar_textcolor']};
		}

		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a {
			background-color: {$colors['sidebar_textcolor']};
		}

		.textwidget a {
			border-color: {$colors['sidebar_textcolor']};
		}

		/* Sidebar Text Color */
		.secondary a:hover,
		.secondary a:focus,
		.main-navigation .menu-item-description,
		.widget,
		.widget blockquote,
		.widget .wp-caption-text,
		.widget .gallery-caption {
			color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget button:hover,
		.widget button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget blockquote {
			border-color: {$colors['secondary_sidebar_textcolor']};
		}

		/* Sidebar Border Color */
		.main-navigation ul,
		.main-navigation li,
		.widget input,
		.widget textarea,
		.widget table,
		.widget th,
		.widget td,
		.widget pre,
		.widget li,
		.widget_categories .children,
		.widget_nav_menu .sub-menu,
		.widget_pages .children,
		.widget abbr[title] {
			border-color: {$colors['sidebar_border_color']};
		}

		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.widget hr {
			background-color: {$colors['sidebar_border_color']};
		}

		.widget input:focus,
		.widget textarea:focus {
			border-color: {$colors['sidebar_border_focus_color']};
		}

		.sidebar a:focus,
		.dropdown-toggle:focus {
			outline-color: {$colors['sidebar_border_focus_color']};
		}
	}
CSS;

	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since Poncho 1.0
 */
function poncho_color_scheme_css_template() {
	$colors = array(
		'background_color'            => '{{ data.background_color }}',
		'header_background_color'     => '{{ data.header_background_color }}',
		'box_background_color'        => '{{ data.box_background_color }}',
		'textcolor'                   => '{{ data.textcolor }}',
		'secondary_textcolor'         => '{{ data.secondary_textcolor }}',
		'border_color'                => '{{ data.border_color }}',
		'border_focus_color'          => '{{ data.border_focus_color }}',
		'sidebar_textcolor'           => '{{ data.sidebar_textcolor }}',
		'sidebar_border_color'        => '{{ data.sidebar_border_color }}',
		'sidebar_border_focus_color'  => '{{ data.sidebar_border_focus_color }}',
		'secondary_sidebar_textcolor' => '{{ data.secondary_sidebar_textcolor }}',
		'meta_box_background_color'   => '{{ data.meta_box_background_color }}',
	);
	?>
	<script type="text/html" id="tmpl-poncho-color-scheme">
		<?php echo poncho_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'poncho_color_scheme_css_template' );



function poncho_extra_customize_register( $wp_customize ) {

//	Secciones
	$wp_customize->add_panel( 'poncho_secciones_panel',
		array(
			'priority'   => 600,
			'capability' => 'edit_theme_options',
			'title'      => __( 'Secciones', 'poncho' )
		) );

	//	seccion header
	$wp_customize->add_section(
		'poncho_seccion_header',
		array(
			'title'         => __( 'Header', 'poncho' ),
			'priority'      => 610,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_header_titulo',
		array(
			'default'           => 'Lorem ipsum dolor sit amet',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_header_titulo',
		array(
			'label'   => __( 'Título', 'poncho' ),
			'section' => 'poncho_seccion_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_header_descripcion',
		array(
			'default'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis exercitationem reprehenderit dolor vel ducimus voluptate eaque quo suscipit, iste placeat quos facere. Consequuntur praesentium aliquam rerum! Totam aut dolorem velit!',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_header_descripcion',
		array(
			'label'   => __( 'Descripción', 'poncho' ),
			'section' => 'poncho_seccion_header',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting( 'seccion_header_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_header_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'poncho_seccion_header',
			'settings' => 'seccion_header_imagen_fondo',
		) ) );

	$wp_customize->add_setting(
		'seccion_header_boton_texto',
		array(
			'default'           => 'Learn More',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_header_boton_texto',
		array(
			'label'   => __( 'Texto Botón', 'poncho' ),
			'section' => 'poncho_seccion_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_header_boton_url',
		array(
			'default'           => '#about',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_header_boton_url',
		array(
			'label'   => __( 'URL Botón', 'poncho' ),
			'section' => 'poncho_seccion_header',
			'type'    => 'text',
		)
	);


	//	seccion acerca de
	$wp_customize->add_section(
		'poncho_seccion_acercade',
		array(
			'title'         => __( 'Acerca de', 'poncho' ),
			'priority'      => 620,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_acercade_activo',
		array(
			'default'           => true,
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_acercade_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_acercade',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_acercade_titulo',
		array(
			'default'           => 'Lorem ipsum dolor sit amet',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_acercade_titulo',
		array(
			'label'   => __( 'Título', 'poncho' ),
			'section' => 'poncho_seccion_acercade',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_acercade_descripcion',
		array(
			'default'           => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
					labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
					laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
					voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
					non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<blockquote>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit quia illo iusto recusandae
						rerum rem ipsum ratione dolores sed ab, nostrum iste saepe, ducimus ex esse quaerat quasi a
						dolorem.</p>
					<small>Juan Perez</small>
				</blockquote>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
					labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
					laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
					voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
					non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_acercade_descripcion',
		array(
			'label'   => __( 'Descripción', 'poncho' ),
			'section' => 'poncho_seccion_acercade',
			'type'    => 'textarea',
		)
	);

	//	seccion que hacemos
	$wp_customize->add_section(
		'poncho_seccion_que_hacemos',
		array(
			'title'         => __( 'Qué hacemos?', 'poncho' ),
			'priority'      => 630,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_que_hacemos_activo',
		array(
			'default'           => true,
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_que_hacemos_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_que_hacemos',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_que_hacemos_titulo',
		array(
			'default'           => 'Qué hacemos?',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_que_hacemos_titulo',
		array(
			'label'   => __( 'Título', 'poncho' ),
			'section' => 'poncho_seccion_que_hacemos',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_que_hacemos_descripcion',
		array(
			'default'           => '<ul>
					<li>Et harum quidem rerum facilis est et <strong>expedita</strong> distinctio.</li>
					<li>Non enim ipsa genuit hominem, sed accepit a <strong>natura</strong> inchoatum.</li>
					<li>An est aliquid per se ipsum flagitiosum, etiamsi <strong>nulla</strong> comitetur infamia?
					</li>
					<li>Nonne videmus quanta perturbatio rerum omnium <strong>consequatur</strong>, quanta confusio?
					</li>
					<li>Etenim semper illud extra est, quod arte <strong>comprehenditur</strong>.</li>
				</ul>',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_que_hacemos_descripcion',
		array(
			'label'   => __( 'Descripción', 'poncho' ),
			'section' => 'poncho_seccion_que_hacemos',
			'type'    => 'textarea',
		)
	);

//	seccion servicios

	$wp_customize->add_section(
		'poncho_seccion_servicios',
		array(
			'title'         => __( 'Servicios', 'poncho' ),
			'priority'      => 640,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_servicios_activo',
		array(
			'default'           => true,
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_servicios_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_servicios',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_servicios_titulo_seccion',
		array(
			'default'           => 'Lorem ipsum dolor sit amet',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_servicios_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_servicios',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_servicios_titulo',
		array(
			'default'           => 'What we do.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_servicios_titulo',
		array(
			'label'   => __( 'Título', 'poncho' ),
			'section' => 'poncho_seccion_servicios',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_servicios_descripcion',
		array(
			'default'           => 'Lorem ipsum Elit ut consequat veniam eu nulla nulla reprehenderit reprehenderit sit velit in cupidatat ex aliquip ut cupidatat Excepteur tempor id irure sed dolore sint sunt voluptate ullamco nulla qui Duis qui culpa voluptate enim ea aute qui veniam in irure et nisi nostrud deserunt est officia minim.',
			'sanitize_callback' => 'esc_textarea',
		)
	);
	$wp_customize->add_control(
		'seccion_servicios_descripcion',
		array(
			'label'   => __( 'Descripción', 'poncho' ),
			'section' => 'poncho_seccion_servicios',
			'type'    => 'textarea',
		)
	);

	for ( $i = 1; $i <= 3; $i ++ ) {

		$wp_customize->add_setting(
			"seccion_servicios_widget_icono_$i",
			array(
				'default'           => 'fa fa-users',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"seccion_servicios_widget_icono_$i",
			array(
				'label'   => __( 'Icono', 'poncho' ),
				'section' => 'poncho_seccion_servicios',
				'type'    => 'text',
			)
		);
		$wp_customize->add_setting(
			"seccion_servicios_widget_titulo_$i",
			array(
				'default'           => 'Quid',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"seccion_servicios_widget_titulo_$i",
			array(
				'label'   => __( 'Título', 'poncho' ),
				'section' => 'poncho_seccion_servicios',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"seccion_servicios_widget_descripcion_$i",
			array(
				'default'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
				'sanitize_callback' => '',
			)
		);
		$wp_customize->add_control(
			"seccion_servicios_widget_descripcion_$i",
			array(
				'label'   => __( 'Descripción', 'poncho' ),
				'section' => 'poncho_seccion_servicios',
				'type'    => 'textarea',
			)
		);
	}




	//	seccion links no destacados

	$wp_customize->add_section(
		'poncho_seccion_links_no_destacados',
		array(
			'title'         => __( 'Links no destacados', 'poncho' ),
			'priority'      => 650,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_links_no_destacados_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_no_destacados_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_links_no_destacados',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_links_no_destacados_titulo_seccion',
		array(
			'default'           => 'Links no destacados',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_no_destacados_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_links_no_destacados',
			'type'    => 'text',
		)
	);

//	$dropdown_args =
//		array(
//			'taxonomy'          => 'category',
//			'show_option_none'  => ' ',
//			'selected'          => null,
//			'show_option_all'   => '',
//			'orderby'           => 'id',
//			'order'             => 'ASC',
//			'show_count'        => 1,
//			'hide_empty'        => 1,
//			'child_of'          => 0,
//			'exclude'           => '',
//			'hierarchical'      => 1,
//			'depth'             => 0,
//			'tab_index'         => 0,
//			'hide_if_empty'     => false,
//			'option_none_value' => 0,
//			'value_field'       => 'term_id',
//		);

    $aCategorias = [];

	foreach ( get_categories() as $categories => $category ){
		$aCategorias[$category->term_id] = $category->name;
	}

	$wp_customize->add_setting(
		'seccion_links_no_destacados_categoria',
		array(
			'default'           => '',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_links_no_destacados_categoria',
		array(
			'label'   => __( 'Categoría', 'poncho' ),
			'section' => 'poncho_seccion_links_no_destacados',
			'type'    => 'select',
            'choices'=> $aCategorias
		)
	);

	require_once get_stylesheet_directory() . '/inc/dropdown-categoria.php';

//	$wp_customize->add_setting( 'seccion_links_no_destacados_categoria_dropdown', array(
//		'default'           => '',
//		'sanitize_callback' => 'absint',
//	) );
//	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'seccion_links_no_destacados_categoria_dropdown', array(
//		'section'       => 'poncho_seccion_links_no_destacados',
//		'label'         => esc_html__( 'Categoría', 'poncho' ),
//		'description'   => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
//		// Uncomment to pass arguments to wp_dropdown_categories()
//		//'dropdown_args' => array(
//		//	'taxonomy' => 'post_tag',
//		//),
//	) ) );

	//	seccion links no destacados con descripcion

	$wp_customize->add_section(
		'poncho_seccion_links_no_destacados_con_descripcion',
		array(
			'title'         => __( 'Links no destacados con descripción', 'poncho' ),
			'priority'      => 660,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_links_no_destacados_con_descripcion_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_no_destacados_con_descripcion_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_links_no_destacados_con_descripcion',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_links_no_destacados_con_descripcion_titulo_seccion',
		array(
			'default'           => 'Links no destacados con descripción',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_no_destacados_con_descripcion_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_links_no_destacados_con_descripcion',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'seccion_links_no_destacados_con_descripcion_categoria', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'seccion_links_no_destacados_con_descripcion_categoria', array(
		'section'       => 'poncho_seccion_links_no_destacados_con_descripcion',
		'label'         => esc_html__( 'Categoría', 'poncho' ),
		'description'   => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );


	//	seccion links destacados con icono y descripcion

	$wp_customize->add_section(
		'poncho_seccion_links_destacados_con_icono_descripcion',
		array(
			'title'         => __( 'Links destacados con icono y descripción', 'poncho' ),
			'priority'      => 670,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_links_destacados_con_icono_descripcion_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_destacados_con_icono_descripcion_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_links_destacados_con_icono_descripcion',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_links_destacados_con_icono_descripcion_titulo_seccion',
		array(
			'default'           => 'Links destacados con icono y descripción',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_destacados_con_icono_descripcion_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_links_destacados_con_icono_descripcion',
			'type'    => 'text',
		)
	);

//	$wp_customize->add_setting(
//		'seccion_links_destacados_con_icono_descripcion_categoria',
//		array(
//			'default'           => '',
//			'sanitize_callback' => '',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_links_destacados_con_icono_descripcion_categoria',
//		array(
//			'label'   => __( 'Categoría', 'poncho' ),
//			'section' => 'poncho_seccion_links_destacados_con_icono_descripcion',
//			'type'    => 'select',
//			'choices'=> $aCategorias
//		)
//	);

	$wp_customize->add_setting( 'seccion_links_destacados_con_icono_descripcion_categoria', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'seccion_links_destacados_con_icono_descripcion_categoria', array(
		'section'       => 'poncho_seccion_links_destacados_con_icono_descripcion',
		'label'         => esc_html__( 'Categoría', 'poncho' ),
		'description'   => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );

	//	seccion Links destacados con fotos

	$wp_customize->add_section(
		'poncho_seccion_links_destacados_con_fotos',
		array(
			'title'         => __( 'Links destacados con fotos', 'poncho' ),
			'priority'      => 680,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_links_destacados_con_fotos_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_destacados_con_fotos_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_links_destacados_con_fotos',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_links_destacados_con_fotos_titulo_seccion',
		array(
			'default'           => 'Links destacados con fotos',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_links_destacados_con_fotos_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_links_destacados_con_fotos',
			'type'    => 'text',
		)
	);

//	$wp_customize->add_setting(
//		'seccion_links_destacados_con_fotos_categoria',
//		array(
//			'default'           => '',
//			'sanitize_callback' => '',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_links_destacados_con_fotos_categoria',
//		array(
//			'label'   => __( 'Categoría', 'poncho' ),
//			'section' => 'poncho_seccion_links_destacados_con_fotos',
//			'type'    => 'select',
//			'choices'=> $aCategorias
//		)
//	);

	$wp_customize->add_setting( 'seccion_links_destacados_con_fotos_categoria', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'seccion_links_destacados_con_fotos_categoria', array(
		'section'       => 'poncho_seccion_links_destacados_con_fotos',
		'label'         => esc_html__( 'Categoría', 'poncho' ),
		'description'   => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.', 'poncho' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );

	//	seccion Noticias

	$wp_customize->add_section(
		'poncho_seccion_noticias',
		array(
			'title'         => __( 'Noticias Destacadas', 'poncho' ),
			'priority'      => 690,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_noticias_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_noticias_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_noticias',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_noticias_titulo_seccion',
		array(
			'default'           => 'Noticias Destacadas',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_noticias_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_noticias',
			'type'    => 'text',
		)
	);




//
//	//	seccion los clientes dicen
//	$wp_customize->add_section(
//		'poncho_seccion_clientesdicen',
//		array(
//			'title'         => __( 'Los clientes dicen', 'poncho' ),
//			'priority'      => 650,
//			'capability'    => 'edit_theme_options',
//			'theme_support' => '',
//			'panel'         => 'poncho_secciones_panel'
//		)
//	);
//
//	$wp_customize->add_setting(
//		'seccion_clientesdicen_activo',
//		array(
//			'default'           => true,
//			'sanitize_callback' => 'sanitize_text_field',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_clientesdicen_activo',
//		array(
//			'label'   => __( 'Activo', 'poncho' ),
//			'section' => 'poncho_seccion_clientesdicen',
//			'type'    => 'checkbox',
//		)
//	);
//
//	$wp_customize->add_setting(
//		'seccion_clientesdicen_titulo',
//		array(
//			'default'           => 'What They Say About Us.',
//			'sanitize_callback' => 'sanitize_text_field',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_clientesdicen_titulo',
//		array(
//			'label'   => __( 'Título', 'poncho' ),
//			'section' => 'poncho_seccion_clientesdicen',
//			'type'    => 'text',
//		)
//	);

//	seccion contacto

	$wp_customize->add_section(
		'poncho_seccion_contacto',
		array(
			'title'         => __( 'Contacto', 'poncho' ),
			'priority'      => 700,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_contacto_activo',
		array(
			'default'           => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_contacto_activo',
		array(
			'label'   => __( 'Activo', 'poncho' ),
			'section' => 'poncho_seccion_contacto',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'seccion_contacto_titulo_seccion',
		array(
			'default'           => 'Datos de Contacto',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_contacto_titulo_seccion',
		array(
			'label'   => __( 'Título Sección', 'poncho' ),
			'section' => 'poncho_seccion_contacto',
			'type'    => 'text',
		)
	);

//	$wp_customize->add_setting(
//		'seccion_contacto_titulo',
//		array(
//			'default'           => 'Get In Touch.',
//			'sanitize_callback' => 'sanitize_text_field',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_contacto_titulo',
//		array(
//			'label'   => __( 'Título', 'poncho' ),
//			'section' => 'poncho_seccion_contacto',
//			'type'    => 'text',
//		)
//	);
//
//	$wp_customize->add_setting(
//		'seccion_contacto_descripcion',
//		array(
//			'default'           => 'Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.',
//			'sanitize_callback' => 'esc_textarea',
//		)
//	);
//	$wp_customize->add_control(
//		'seccion_contacto_descripcion',
//		array(
//			'label'   => __( 'Descripción', 'poncho' ),
//			'section' => 'poncho_seccion_contacto',
//			'type'    => 'textarea',
//		)
//	);

	$wp_customize->add_setting(
		'seccion_contacto_titulo_formulario',
		array(
			'default'           => 'Envianos tu Consulta',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_contacto_titulo_formulario',
		array(
			'label'   => __( 'Título Formulario', 'poncho' ),
			'section' => 'poncho_seccion_contacto',
			'type'    => 'text',
		)
	);


//	Contacto / Social
	$wp_customize->add_panel( 'poncho_contact_social_panel',
		array(
			'priority'   => 710,
			'capability' => 'edit_theme_options',
			'title'      => __( 'Contacto / Redes Sociales', 'poncho' )
		) );

	$wp_customize->add_section(
		'poncho_social_icon',
		array(
			'title'         => __( 'Redes Sociales', 'poncho' ),
			'priority'      => 720,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_contact_social_panel'
		)
	);

	$social_links = array(
		'Facebook'   => 'poncho_facebook_text',
		'Twitter'    => 'poncho_twitter_text',
		'GooglePlus' => 'poncho_googleplus_text',
		'Pinterest'  => 'poncho_pinterest_text',
		'YouTube'    => 'poncho_youtube_text',
		'Vimeo'      => 'poncho_vimeo_text',
		'Linked'     => 'poncho_linkedin_text',
		'Flickr'     => 'poncho_flickr_text',
		'Tumblr'     => 'poncho_tumblr_text',
		'RSS'        => 'poncho_rss_text'
	);
	foreach ( $social_links as $key => $value ) {
		$wp_customize->add_setting(
			$value,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$value,
			array(
				'label'   => __( $key, 'poncho' ),
				'section' => 'poncho_social_icon',
				'type'    => 'text',
			)
		);
	}

	$wp_customize->add_section(
		'poncho_contacto',
		array(
			'title'         => __( 'Contacto', 'poncho' ),
			'priority'      => 730,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_contact_social_panel'
		)
	);

	$wp_customize->add_setting(
		'poncho_telefono',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'poncho_telefono',
		array(
			'label'   => __( 'Teléfono', 'poncho' ),
			'section' => 'poncho_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'poncho_celular',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'poncho_celular',
		array(
			'label'   => __( 'Celular', 'poncho' ),
			'section' => 'poncho_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'poncho_mail',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'poncho_mail',
		array(
			'label'   => __( 'Mail', 'poncho' ),
			'section' => 'poncho_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'poncho_direccion',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'poncho_direccion',
		array(
			'label'   => __( 'Direccion', 'poncho' ),
			'section' => 'poncho_contacto',
			'type'    => 'text',
		)
	);

	//	seccion Footer
	$wp_customize->add_section(
		'poncho_seccion_footer',
		array(
			'title'         => __( 'Footer', 'poncho' ),
			'priority'      => 820,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'poncho_secciones_panel'
		)
	);

	for ( $i = 1; $i <= 3; $i ++ ) {

		$wp_customize->add_setting(
			"seccion_footer_titulo_$i",
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			"seccion_footer_titulo_$i",
			array(
				'label'   => __( 'Título', 'poncho' ),
				'section' => 'poncho_seccion_footer',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			"seccion_footer_descripcion_$i",
			array(
				'default'           => '',
				'sanitize_callback' => '',
			)
		);
		$wp_customize->add_control(
			"seccion_footer_descripcion_$i",
			array(
				'label'   => __( 'Descripción', 'poncho' ),
				'section' => 'poncho_seccion_footer',
				'type'    => 'textarea',
			)
		);
	}

}

add_action( 'customize_register', 'poncho_extra_customize_register' );
