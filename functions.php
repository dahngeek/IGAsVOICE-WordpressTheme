<?php

/*QUITAMOS LA BARRA DE ADMINISTRACION DEL FRONTEND*/
add_filter( 'show_admin_bar', '__return_false' );

/*SOPORTES DEL TEMA*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 180, true ); // Normal post thumbnails
add_image_size( 'single-post-thumbnail', 300, 180 ); // Permalink thumbnail size


/*ACTIONS*/
add_action('wp_head', 'setIECompatibility', 1);
add_action('wp_head', 'setUpdateMode');
add_action('wp_head', 'setPageTitle');
add_action('wp_head', 'blogFavicon');
/*INIT SCRIPTS*/
add_action('get_header', 'get_the_scripts');
/*INIT STYLES*/
add_action('get_header', 'get_the_styles');
add_action('wp_head', 'setFacebookMetas');
add_action("login_head", "myLoginHead");
add_filter('login_headerurl', 'cambiarURLLogin');
add_filter('login_headertitle', 'cambiarTituloLogin');


function get_the_styles() {
    global $post;


    wp_enqueue_style('themeStyle', get_bloginfo( 'stylesheet_url' ), array());
	wp_enqueue_style('fuentes', get_bloginfo( 'stylesheet_directory' ).'/css/fonts.css', array("themeStyle"));
	wp_enqueue_style('temaestilo', get_bloginfo( 'stylesheet_directory' ).'/css/style.css', array("themeStyle"));
    wp_enqueue_style('fuenteGoogle', 'http://fonts.googleapis.com/css?family=Federo', array("themeStyle"));
	wp_enqueue_style('styleslide', get_bloginfo( 'stylesheet_directory' ).'/css/styleslide.css', array("themeStyle"));
	wp_enqueue_style('temaestilo', get_bloginfo( 'stylesheet_directory' ).'/css/style.css', array("themeStyle"));
 wp_enqueue_style('fuenteGoogle2', 'http://fonts.googleapis.com/css?family=Open+Sans', array("themeStyle"));

    //SPECIFIC STYLES
    if (isset($post->ID)) {
        switch ($post->ID) {

        }
    }
    if (is_category() || is_search()) {
        wp_enqueue_style('temaarticulos', get_bloginfo( 'stylesheet_directory' ).'/css/stylearticulos.css', array("themeStyle"));
        wp_enqueue_style('temablur', get_bloginfo( 'stylesheet_directory' ).'/css/demoblur.css', array("themeStyle"));
        wp_enqueue_style('styleblur', get_bloginfo( 'stylesheet_directory' ).'/css/styleblur.css', array("themeStyle"));
    }
    if (is_singular( 'galerias' ) || is_page_template('page_sin-barra.php')) {
        wp_enqueue_style('stylegaleria', get_bloginfo( 'stylesheet_directory' ).'/css/stylegalery.css', array("themeStyle"));
        wp_enqueue_style('stylegalery', get_bloginfo( 'stylesheet_directory' ).'/css/stylegaleria.css', array("themeStyle"));
        wp_enqueue_style('stylezoom', get_bloginfo( 'stylesheet_directory' ).'/css/stylezoom.css', array("themeStyle"));
    }
    if (is_post_type_archive( 'galerias' )) {
        wp_enqueue_style('stylegalery', get_bloginfo( 'stylesheet_directory' ).'/css/stylegaleria.css', array("themeStyle"));
        wp_enqueue_style('set2', get_bloginfo( 'stylesheet_directory' ).'/css/set2.css', array("themeStyle"));
    }
}

function get_the_scripts() {
    global $post;

    //GENERAL SCRIPTS
    wp_enqueue_script("cssBrowserSelector", get_bloginfo( 'stylesheet_directory' ).'/js/libs/css_browser_selector.js', array(), false, true);
    wp_enqueue_script("general", get_template_directory_uri()."/js/functions/general.js", array("jquery"), false, true);
	wp_enqueue_script("stilos", get_template_directory_uri()."/style.js", array("jquery"), false, true);
	wp_enqueue_script("masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js", array("jquery"), false, true);
	wp_enqueue_script("jmpress", get_template_directory_uri()."/js/jmpress.min.js", array("jquery"), false, false);
	wp_enqueue_script("jmslideshow", get_template_directory_uri()."/js/jquery.jmslideshow.js", array("jquery", "jmpress"), false, false);
	wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.custom.48780.js", array("jquery"), false, true);


    //SPECIFIC SCRIPTS
    if (isset($post->ID)) {
        switch ($post->ID) {

        }
    }
}

//cambiamos la imagen del login
function myLoginHead() {
	echo "
	<style>
            body.login #login h1 a {
                    background: url('".get_bloginfo('template_url')."/media/imagenes/generales/login_logo.png') no-repeat scroll center top transparent;
                    width: 390px;
                    height: 227px;
                    margin-left: -35px;
                    background-size: 390px 227px;
            }
	</style>
	";
}

//Barra LAteral
// Register Sidebar
function custom_sidebar() {

    $args = array(
        'id'            => 'right-sidebar',
        'name'          => __( 'Barra Lateral Articulos', 'text_domain' ),
        'description'   => __( 'Barra que mostrará contenido a un lado de los articulos', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    );
    register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_sidebar' );

function custom_sidebar_main() {

    $args = array(
        'id'            => 'main-sidebar',
        'name'          => __( 'Barra Lateral Principal', 'text_domain' ),
        'description'   => __( 'Barra que mostrará contenido a un lado de la página principal', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    );
    register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_sidebar_main' );

function custom_footerbar() {

    $args = array(
        'id'            => 'main-footerbar',
        'name'          => __( 'Barra Pié de Página', 'text_domain' ),
        'description'   => __( 'Barra que mostrará contenido abajo de las galerías', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    );
    register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_footerbar' );

function custom_foot() {

    $args = array(
        'id'            => 'main-footer',
        'name'          => __( 'Contenido Pie de Página', 'text_domain' ),
        'description'   => __( 'contenido que irá en el pie de página.', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    );
    register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_foot' );
//Cambiamos el largo de excerpt
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Cambiamos el link de el logo del login
function cambiarURLLogin(){
    return ('http://dahngeek.com/');
}

//Cambiamos el titulo del link
function cambiarTituloLogin(){
    return ('Dahngeek');
}

//set favicon
function blogFavicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_url').'/media/imagenes/generales/favicon.ico" />';
}

function setUpdateMode() {
    global $user_email;

    $update = false;

    if ($update) {

        if ((!is_user_logged_in() && $user_email != "me@dahngeek.com") && !is_home() && !is_front_page()) {
            wp_redirect(home_url());
            exit;
        }
    }
}

function setFacebookMetas() {
    global $post, $category;

    if ( is_home() || is_front_page() || is_search() || is_404()) {
        ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_bloginfo('url '); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else if (is_category()) {
        ?>
            <meta property="og:title" content="<?php echo get_cat_name($category->cat_ID); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_category_link($category->cat_ID); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else {
        $image_to_show = array();
        if (has_post_thumbnail( $post->ID )) {
            $image_to_show = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        } else {
            $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
            $attachments = get_posts($args);


            foreach($attachments as $attachs) {
                if (wp_attachment_is_image($attachs->ID)) {
                    $image_to_show = wp_get_attachment_image_src( $attachs->ID, 'medium' );
                }
            }
        }

        if (count($image_to_show) == 0) {
            $image_to_show = array(get_template_directory_uri()."/7.png", 0, 0);
        }
        ?>
            <meta property="og:title" content="<?php echo $post->post_title; ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
            <meta property="og:image" content="<?php echo $image_to_show[0]; ?>" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    }

}

function setIECompatibility() {
    echo '<meta http-equiv="X-UA-Compatible" content="IE=9" />';
}

function setPageTitle() {
    global $post, $category;

    echo '<title>';



    // Add the blog description for the home/front page.
    if ( is_home() || is_front_page()) {

    } else if (is_search()) {
        echo "Búsqueda";
        echo ' .::. ';
    } else if (is_404()) {
        echo "No encontrada";
        echo ' .::. ';
    } else if (is_category()) {
        $category = end(get_the_category());
        echo get_cat_name($category->cat_ID);
        echo ' .::. ';
    } elseif (is_post_type_archive( 'galerias' )) {
        echo 'Galerías';
        echo ' .::. ';
    }else {
        echo $post->post_title;
        echo ' .::. ';
    }
    echo get_bloginfo('name');
    echo '</title>';
}

/*FUNCIONES DE TEMA*/


/*FUNCIONES GENERALES*/

//$s -> texto
//$l -> numero de caracteres
function truncate($s, $l, $e = '...', $isHTML = false){
    $i = 0;
    $tags = array();
    if($isHTML){
            preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach($m as $o){
                    if($o[0][1] - $i >= $l)
                            break;
                    $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                    if($t[0] != '/')
                            $tags[] = $t;
                    elseif(end($tags) == substr($t, 1))
                            array_pop($tags);
                    $i += $o[1][1] - $o[0][1];
            }
    }
    return substr($s, 0, $l = min(strlen($s),  $l + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . (strlen($s) > $l ? $e : '');
}

function debug($variable, $mensaje="", $die=false) {
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    if ($die) {
        die();
    }
}
 function create_my_cat() {
    /* CREACIÓN DE LAS CATEGORÍAS */
    //echo "error no hayt";
    $categories = array("Cultural", "Deportes", "Economia", "Internacionales", "Nacionales");
    //debug($categories);
    require_once (ABSPATH.'/wp-admin/includes/taxonomy.php');
    foreach ($categories as $key => $value) {
        //echo "categ";
        if ( ! get_cat_ID( $value ) ) {
            //echo "categaaahh";
            $id = wp_create_category( $value );
            //var_dump($id);
            $string = "categ-".strtolower($value);
            //echo $string;
            $opcionGuardada = add_option($string , $id);
            //var_dump($opcionGuardada);
        }
    }
 }
 add_action ( 'after_setup_theme', 'create_my_cat' );

// Register Custom Post Type
function galleria() {

    $labels = array(
        'name'                => 'Galerías',
        'singular_name'       => 'Galería',
        'menu_name'           => 'Galerías',
        'name_admin_bar'      => 'Galerías',
        'parent_item_colon'   => 'Galería Padre:',
        'all_items'           => 'Todas las Galerías',
        'add_new_item'        => 'Nueva Galería',
        'add_new'             => 'Añadir nueva',
        'new_item'            => 'Nueva Galería',
        'edit_item'           => 'Editar Galería',
        'update_item'         => 'Actualizar Galería',
        'view_item'           => 'Ver Galería',
        'search_items'        => 'Buscar Galería',
        'not_found'           => 'No encontrado.',
        'not_found_in_trash'  => 'no encontrado en la papelera.',
    );
    $args = array(
        'label'               => 'galerias',
        'description'         => 'Galerías de Imágenes , Infografías o Imágenes',
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'          => array( 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-image',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true
        );
    register_post_type( 'galerias', $args );

}

// Hook into the 'init' action
add_action( 'init', 'galleria', 0 );

add_filter( 'embed_defaults', 'modify_embed_defaults' );
function modify_embed_defaults() {
    if (is_singular('galerias')) {
        return array(
        'width'  => 780,
        'height' => 460
        );
    } else{
      return array(
      'width'  => 570,
      'height' => 360
      );
    }
}

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primario', 'Menu principal' );
}

?>
<?php
// Customise the footer in admin area
function wpfme_footer_admin () {
	echo 'Tema Diseñado y Desarrollado por el equipo de Diagramación IGAsVOICE con colaboración de <a href="http://dahngeek.com" target="_blank">dahngeek</a> en base <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');

// Disable the theme / plugin text editor in Admin
define('DISALLOW_FILE_EDIT', true);

?>
