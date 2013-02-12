<?php

// Set up some constants
define("RBBA_SCHEDULE_PATH", get_bloginfo('stylesheet_directory') . "/static/schedule.html");

/**
 * Override defaults from parent theme.
 */
function twentyeleven_setup() {

        /* Make Twenty Eleven available for translation.
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Twenty Eleven, use a find and replace
         * to change 'twentyeleven' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
                require_once( $locale_file );

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Load up our theme options page and related code.
        require( get_template_directory() . '/inc/theme-options.php' );
        // Grab Twenty Eleven's Ephemera widget.
        require( get_template_directory() . '/inc/widgets.php' );

        // Add default posts and comments RSS feed links to <head>.
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

        // Add support for a variety of post formats
        add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

        // Add support for custom backgrounds
        add_custom_background();

        // The default header text color
        define( 'HEADER_TEXTCOLOR', '000' );
}

function javascript_init() {
  wp_deregister_script('jquery');

  wp_register_script('jquery',
    get_bloginfo('stylesheet_directory') .
      '/scripts/jquery-1.9.0.min.js',
      '',
      '1.9.0');

  wp_register_script('jquery_ui',
    get_bloginfo('stylesheet_directory') .
      '/scripts/jquery-ui-1.10.0.custom.min.js',
      array('jquery'),
      '1.10.0');

  // For Fancybox mouse wheel support
  wp_register_script('jquery_mousewheel',
    get_bloginfo('stylesheet_directory') .
      '/scripts/jquery.mousewheel-3.0.6.pack.js',
      array('jquery'),
      '3.0.6');

  wp_register_script('jquery_fancybox',
    get_bloginfo('stylesheet_directory') .
      '/scripts/fancybox/jquery.fancybox.pack.js',
      array('jquery', 'jquery_mousewheel'),
      '2.1.4');

  wp_register_script('rbba',
    get_bloginfo('stylesheet_directory') .
      '/scripts/rbba.js',
      array('jquery_ui'),
      '0.1.0');

  wp_register_script('rbba_faq',
    get_bloginfo('stylesheet_directory') .
      '/scripts/rbba_faq.js',
      array('rbba', 'jquery_ui'),
      '0.1.0');

  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery_ui');
  wp_enqueue_script('jquery_mousewheel');
  wp_enqueue_script('jquery_fancybox');
  wp_enqueue_script('rbba');
  wp_enqueue_script('rbba_faq');

  wp_enqueue_style('jquery_ui', get_bloginfo('stylesheet_directory') . '/css/jquery-ui-1.10.0.custom.min.css');
  wp_enqueue_style('fancybox', get_bloginfo('stylesheet_directory') . '/scripts/fancybox/jquery.fancybox.css');
}

if (!is_admin()) {
  add_action('init', 'javascript_init');
}

?>
