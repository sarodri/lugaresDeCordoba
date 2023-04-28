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

    wp_enqueue_script('jquery');

    wp_localize_script('custom', 'lg', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'apiurl' => home_url('/wp-json/lg/v1/')
    ));
};

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
    $label1 = array(
        'name' => 'Lugares',
        'singular_name' => 'Lugar',
        'menu_name' => 'Lugares'
    );
    $args = array(
        'label' => 'Lugares',
        'description' => 'Lugares de Córdoba',
        'labels' =>  $label1,
        'supports' => array('title', 'editor', 'thumbnail', 'revision'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-category',
        'can_export' => true,
        'publicly_querable' => true,
        'rewrite' => true,
        'show_in_rest' => true

    );
    register_post_type( 'lugar', $args);
};
add_action('init', 'lugares_type' );

function RegisterTax() {
    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name'=> 'Tipos de Lugares',
            'singular_name' => 'Tipo de Lugares'
        ),
        'show_in_nav_menu' => true,
        'show_admin_column' => true,
        'rewrite' => array(
            'slug' => 'lugar'
        )
    );
    register_taxonomy('lugar', array('lugar'), $args);
};

add_action('init', 'RegisterTax');

// Para filtros de búsqueda:

add_action('wp_ajax_nopriv_lgFiltroLugares', 'lgFiltroLugares');
add_action('wp_ajax_lgFiltroLugares', 'lgFiltroLugares');

function lgFiltroLugares(){
    
    $args= array(
        'post_type'=> 'lugar',
        'post_per_page'=> -1,
        'order'=> 'ASC',
        'order_by'=> 'title',
        'tax_query'=> array(
                array(
                    'taxonomy'=> 'lugar',
                    'field' => 'slug',
                    'terms' => $_POST['categoria'],
                )
                )
    );
      
    $lugares = new WP_Query($args);
    $return = array();
    if ($lugares->have_posts()) {
        while($lugares->have_posts()):
            $lugares->the_post();
            $return[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title()
            );  endwhile;
        }   else {
            $response = 'empty';
          }
  

    wp_send_json($return);
    exit;  
}
// Uso de REST API:

add_action('rest_api_init', function(){
    register_rest_route(
        'lg/v1', 
        '/noticias/(?P<cantidad>\d+)', 
        array(
            'methods' => 'GET',
            'callback' => 'noticiasAPI',
        )
    );
});

function noticiasAPI($data){
    $args= array(
            'post_type'=> 'post',
            'post_per_page'=> $data['cantidad'],
            'order'=> 'ASC',
            'orderby'=> 'title',
        );
              
        $noticias = new WP_Query($args);

        if ($noticias->have_posts()){
            $return = array();
            while($noticias->have_posts()){
                $noticias->the_post();
                $return[] = array(
                    'imagen' => get_the_post_thumbnail(get_the_ID(), 'large'),
                    'link' => get_permalink(),
                    'titulo' => get_the_title(),
                );
            }
        }
            else {
                return null;
            }
           
            return $return;
}
