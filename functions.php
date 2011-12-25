<?php # -*- coding: utf-8 -*-
/**
 * @package Fefe Tribute Theme
 */

add_action( 'after_setup_theme', 'ftt_setup' );
add_filter( 'the_content', 'ftt_strip_first_p', 11, 1 );
add_shortcode( 'searchform', 'ftt_searchform' );

/**
 * Runs on 'after_setup_theme'
 * @return void
 */
function ftt_setup()
{
	add_theme_support( 'automatic-feed-links' );
	add_action( 'widgets_init', 'ftt_widgets_setup' );
	locate_template( array ( 'class.Unfiltered_Text_Widget.php' ), TRUE, TRUE );
	add_action( 'widgets_init', array ( 'Unfiltered_Text_Widget', 'register' ), 20 );
}

/**
 * Removes the opening '<p>' to let the_content() run inline.
 *
 * @param  string $content
 * @return string
 */
function ftt_strip_first_p( $content )
{
	return 0 !== strpos( $content, '<p>' ) ? $content : substr( $content, 3 );
}

/**
 * Returns the search form.
 * Used by searchform.php and the shortcode.
 *
 * @return string
 */
function ftt_searchform()
{
	$query = esc_attr(
		apply_filters(
			'the_search_query'
		,	get_search_query( FALSE )
		)
	);
	$url   = home_url( '/' );
	// The original has no label.
	$label = __( 'Suchbegriff: ', 'theme_ftt' );
	return "<form method=GET action='$url'><label>$label<input name=s
	value='$query'><input type=submit></label></form>";
}


/**
 * Registers the sidebars.
 *
 * @return void
 */
function ftt_widgets_setup()
{
	$desc =  __( 'Nutze hierzu das Widget Unfiltered Text', 'theme_ftt' );
	register_sidebar(
		array (
			'name'          => __( 'Header-Untertitel', 'theme_ftt' )
		,	'id'            => 'head'
		,	'description'   => $desc
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
	register_sidebar(
		array (
			'name'          => __( 'Fußzeile', 'theme_ftt' )
		// You cannot name it just 'footer' or WordPress breaks in widgets.php.
		,	'id'            => 'foot'
		,	'description'   => $desc
		,	'before_widget' => ''
		,	'after_widget'  => ''
		,	'before_title'  => ''
		,	'after_title'   => ''
		)
	);
}

/*
 * favicon
 * langen loop testen
 * seitennavigation
 * rename to tribute, functions too
 * readme, hommage
 * sprachdateien
 */