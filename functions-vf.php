<?php

// FUNZIONI PER CSS E SCRIPT JQUERY
function load_theme_scripts() {
    if (!is_admin()) {

// CSS
wp_enqueue_style('all', get_template_directory_uri() . '/css/all.css');
wp_enqueue_style('style', get_stylesheet_uri());

wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css'); // STILE DI AOS (non è jquery)

//SCRIPTS
wp_deregister_script('jquery'); // DISABILITIAMO jQuery

wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js', array(), null, true);
wp_enqueue_script('jquery');

wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);

wp_enqueue_script('aos-script', 'https://unpkg.com/aos@2.3.1/dist/aos.js', null, true); // script di AOS (non è jquery)


    }
}
add_action('wp_enqueue_scripts', 'load_theme_scripts');

//TITLE (affianco alla favicon)
add_theme_support('title-tag');

//MENU
add_theme_support('menus');

//WIDGET  
add_theme_support('widgets');

//IMMAGINE IN EVIDENZA
add_theme_support('post-thumbnails');

//GUTENBERG
add_theme_support('align-wide');


//RIMUOVO BLOCCHI WIDGET
function tema_vf_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action('after_setup_theme', 'tema_vf_theme_support');


// ATTIVA MENU'
register_nav_menus(array(
'main-menu' => 'Menù principale del tema',
'footer-menu' => 'Menu per il piè di pagina'
));

// MODIFICO LE IMPOSTAZIONI DI EXCERPT PER IL TAGLIO DEL TESTO NEL BLOG PREVIEW (mi ritorna un max di 20 parole su 999)
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// MODIFICO LE IMPOSTAZIONI DI EXCERPT PER LA FINE DEL TAGLIO DEL TESTO NEL BLOG PREVIEW
function wpdocs_excerpt_more( $more ) { 
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' ); 


// FUNZIONE PER LA REGISTRAZIONE DELLA SIDEBAR
if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => 'Colonna blog',
        'id'            => 'sidebar-blog',
        'description'   => 'Colonna visibile nel blog',
        'before_widget' => '<div class="widget" id="%1$s">',
        'after_widget'  => '</ul></div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}


// FUNZIONE PER LA REGISTRAZIONE DI EVENTUALE SIDEBAR NEL FOOTER
if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'nome-tema' ),
        'id'            => 'footer-left',
        'description'   => esc_html__( 'Footer credits', 'nome-tema' ),
        'before_widget' => '<div class="widget" id="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}

if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'nome-tema' ),
        'id'            => 'footer-right',
        'description'   => esc_html__( 'Footer credits', 'nome-tema' ),
        'before_widget' => '<div class="widget" id="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}




// FUNZIONE PER INSERIRE IL PLACEHOLDER in un search con id=s

function aggiungi_placeholder_search() {
    ?>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('s');
        if (input) {
            input.setAttribute('placeholder', 'search...');
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'aggiungi_placeholder_search' );
