<?php
/**
 * Fashionly Theme Functions v2.0
 */

/* ============================================================
   1. ENQUEUE PARENT + CHILD STYLES & SCRIPTS
   ============================================================ */
add_action( 'wp_enqueue_scripts', 'fashionly_enqueue_assets' );
function fashionly_enqueue_assets() {
    $theme   = wp_get_theme();
    $version = $theme->get('Version');

    // Parent Storefront style
    wp_enqueue_style(
        'storefront-style',
        get_template_directory_uri() . '/style.css',
        array(),
        $theme->parent()->get('Version')
    );

    // Fashionly child style
    wp_enqueue_style(
        'fashionly-style',
        get_stylesheet_uri(),
        array( 'storefront-style' ),
        $version
    );

    // Custom JS (footer)
    wp_enqueue_script(
        'fashionly-js',
        get_stylesheet_directory_uri() . '/custom.js',
        array(),
        $version,
        true
    );
}

/* ============================================================
   2. REMOVE STOREFRONT HOMEPAGE WIDGETS (we use front-page.php)
   ============================================================ */
add_action( 'init', 'fashionly_remove_storefront_widgets' );
function fashionly_remove_storefront_widgets() {
    remove_action( 'homepage', 'storefront_homepage_content',      10 );
    remove_action( 'homepage', 'storefront_product_categories',    20 );
    remove_action( 'homepage', 'storefront_recent_products',       30 );
    remove_action( 'homepage', 'storefront_featured_products',     40 );
    remove_action( 'homepage', 'storefront_popular_products',      50 );
    remove_action( 'homepage', 'storefront_on_sale_products',      60 );
    remove_action( 'homepage', 'storefront_best_selling_products', 70 );
}

/* ============================================================
   3. DECLARE WC SUPPORT
   ============================================================ */
add_action( 'after_setup_theme', 'fashionly_wc_setup' );
function fashionly_wc_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

/* ============================================================
   4. IMPROVE DOCUMENT TITLE
   ============================================================ */
add_filter( 'pre_get_document_title', 'fashionly_page_title' );
function fashionly_page_title( $title ) {
    if ( is_front_page() ) return 'Fashionly — A Premium Fashion Experience';
    return $title;
}

/* ============================================================
   5. ADD CUSTOM BODY CLASS FOR FRONT PAGE
   ============================================================ */
add_filter( 'body_class', 'fashionly_body_class' );
function fashionly_body_class( $classes ) {
    if ( is_front_page() ) $classes[] = 'fashionly-home';
    return $classes;
}

/* ============================================================
   6. REMOVE STOREFRONT HEADER WIDGET AREA (cleaner look)
   ============================================================ */
add_action( 'widgets_init', 'fashionly_remove_header_widget', 11 );
function fashionly_remove_header_widget() {
    unregister_sidebar( 'header-1' );
}
