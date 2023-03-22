<?php

function init_template(){
    add_theme_support('post-thumbnails');
    add_theme_support( 'title-tag');

    register_nav_menus( array('top_menu' => 'Menú principal') );
};

add_action('after_setup_theme', 'init_template');

function assets(){

    wp_register_style( 'bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', '', '5.3.0', 'all');

    wp_register_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap', '' , '1.0', 'all' );

    wp_enqueue_style( 'estilos', get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.0', 'all');
    
    wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', '', '2.11.6', true );

    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('popper'), '5.2.3', true);
    
    wp_enqueue_script('custom',get_template_directory_uri().'/assets/js/custom.js','','1.0.0',true);
}

add_action( 'wp_enqueue_scripts', 'assets');

function sidebar(){

    register_sidebar( array(
        'name' => 'Pie de pagina',
        'id' => 'footer',
        'descrption' => 'Zona de widgets para pie de pagina',
        'before_title' => '<p>',
        'after_title' => '</p>',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</di>'
    ) );
};
add_action( 'widgets_init','sidebar');

function lugares_type(){
    $labels = array(
        'name' => 'Lugares',
        'singular_name' => 'Lugar',
        'menu_name' => 'Lugares'
    );
    $args = array(
        'label' => 'Lugares',
        'description' => 'Lugares para visitar',
        'labels' =>  $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revision'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-post',
        'can_export' => true,
        'publicly_querable' => true,
        'rewrite' => true,
        'show_in_rest' => true

    );
    register_post_type( 'lugar', $args);
};

add_action('init', 'lugares_type' );