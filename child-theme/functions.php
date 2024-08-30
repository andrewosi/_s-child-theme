<?php
// styles
function s_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 's_child_theme_styles' );

// cpt registration
function create_post_type() {
    register_post_type( 'news',
        array(
            'labels' => array(
                'name' => __( 'Новости' ),
                'singular_name' => __( 'Новость' ),
                'add_new'       => 'Добавить шедевр',
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array ( 'title', 'editor', 'thumbnail', 'custom-fields', 'comments', 'author', 'excerpt'),
            'taxonomies'          => array( 'category' ),
            'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #fff;"><path d="M415.4 512h-95.1L212.1 357.5v91.1L125.7 512H28V29.8L68.5 0h108.1l123.7 176.1V63.5L386.7 0h97.7v461.5zM38.8 35.3V496l72-52.9V194l215.5 307.6h84.8l52.4-38.2h-78.3L69 13zm82.5 466.6l80-58.8v-101l-79.8-114.4v220.9L49 501.9h72.3zM80.6 10.8l310.6 442.6h82.4V10.8h-79.8v317.6L170.9 10.8zM311 191.7l72 102.8V15.9l-72 53v122.7z"/></svg>'),
        )
    );
}
add_action( 'init', 'create_post_type' );

// shortcodes registration
function news_short($par){
    $params = shortcode_atts( array(
        'category' => '',
        'number' => ''
    ), $par, 'news_short' );
    ob_start();
    include 'shortcodes/news.php';
    return ob_get_clean();
}
add_shortcode('news', 'news_short');

