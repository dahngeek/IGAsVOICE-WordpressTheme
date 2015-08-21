<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/style_ie.css" />
<![endif]-->

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
<meta name="viewport" content="width=475px, initial-scale=1, maximum-scale=1">
	<style>
	/*Colores*/
		<?php $items = get_option('colores-bar'); ?>
			nav ul li a .color-1, .color-1 {
				background:<?php echo (!empty($items["1"]) ? $items["1"] : '')?>;
			}
			nav ul li a .color-2, .color-2 {
				background:<?php echo (!empty($items["2"]) ? $items["2"] : '')?>;
			}
			nav ul li a .color-3, .color-3 {
				background:<?php echo (!empty($items["3"]) ? $items["3"] : '')?>;
			}
			nav ul li a .color-4, .color-4 {
				background:<?php echo (!empty($items["4"]) ? $items["4"] : '')?>;
			}
			nav ul li a .color-5, .color-5 {
				background:<?php echo (!empty($items["5"]) ? $items["5"] : '')?>;
			}
		nav ul li a .color-6, .color-6 {
				background:<?php echo (!empty($items["6"]) ? $items["6"] : '')?>;
			}
		nav > ul > li > ul {
			background: <?php echo (!empty($items["sub"]) ? $items["sub"] : '')?>;
		}
		nav > ul {
			background: <?php echo (!empty($items["fondo"]) ? $items["fondo"] : '')?>;
		}
		.step img {
			width: 450px;
		}
		.jms-content {
			margin: 0px 470px 0px 20px;
		}
		.step  p{
			font-size: 25px;
		}
		.mejs-audiotheme-mark {
  display: none !important;
}
	</style>
</head>


<body <?php body_class(); ?>>
	<?php 
	$fondos =  get_option('fondos-arr');
	//debug($fondos);
	$fondo = 'http://www.igasvoice.net/wp-content/uploads/2015/06/beeple_tumblr_nd1uwdqMB61r20fq5o1_1280.jpg';
	if(is_page()) {
		foreach($fondos['page'] as $id => $link) {
			if (is_page($id)) {$fondo = $link;}
		}
	} else if(is_category()) {
		foreach($fondos['categ'] as $id => $link) {
			if (is_category($id)) {$fondo = $link;}
		}
	} else if(is_singular('galerias')) {
		global $post;
		global $wp_query;
		$post_id = $wp_query->post->ID;
		$slug = get_post( $post )->post_name;
		foreach($fondos['gallery'] as $id => $link) {
			if ($id == $slug || $id == $post_id ) {$fondo = $link;}
		}
	} else if(is_single()) {
		foreach($fondos['noticia'] as $id => $link) {
			if (is_single($id)) {$fondo = $link;}
		}
	} else if(is_post_type_archive( 'galerias' )) {
		if(isset($fondos['gal'])) {
			foreach($fondos['gal'] as $id => $val) {
				$fondo = $val;
			}
		}
	}
	else if(is_home()){
		if (isset($fondos['page']['noticias'])) {
			$fondo = $fondos['page']['noticias'];
		}
	}
	?>
<img id="bg" src="<?php echo $fondo;?>"  alt="background" />
<section class="contenido1">
	<span class="ir-arriba icon-arrow-up"></span>
	<script>
		jQuery(document).ready(function ($) {
		$('.ir-arriba').click(function(){
			$('body,html').animate({
				scrollTop:'0px'
			}, 300);
		});
		$(window).scroll(function(){
			if($(this).scrollTop() > 0){
				$('.ir-arriba').slideDown(300);
			} else {
				$('.ir-arriba').slideUp(300);
				}
		});

		});
	</script>
	<div id="caja_radio">
		<div class="home"><a href="<?php bloginfo('url'); ?>"><span class="home"><i class="icon icon-home"></i></span></a></div>
		<a id="igalogo" href="<?php bloginfo('url'); ?>"><img class="hvr-grow-rotate" id="IGA" src="<?php bloginfo('template_url');?>/7.png" alt=""></a>
		<div id="encabeza" style="  position: Absolute;  width: 54%;  height: 150px;  margin-top: -164px;  margin-left: 21%;  /* padding: 55px; */  7* border: 5px dashed #660000;*/">
  			<?php dynamic_sidebar( 'main-encabezado' ); ?>
		</div>
	</div>
	<div class="content2">

	<header>
		<div class="menu_bar">
			<script>
			jQuery(document).ready(function ($){

					function main(){
						$('.menu_bar').click(function(){
							if(contador == 1){
								$('nav').animate({
									left: '0'
								});
								contador = 0;
							} else {
								contador = 1;
								$('nav').animate({
									left: '-200%'
								});
							}

						});

					};
			});
		</script>
		</div>
		<div class="menuheader">
		<nav>

<?php
global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
		$locations = get_registered_nav_menus();
		$menus = wp_get_nav_menus();
		$menu_locations = get_nav_menu_locations();

$location_id = 'primario';
if (isset($menu_locations[ $location_id ])) {
foreach ($menus as $menu) {
	// If the ID of this menu is the ID associated with the location we're searching for
	if ($menu->term_id == $menu_locations[ $location_id ]) {
		// This is the correct menu

		// Get the items for this menu
		$menu_items = (array)wp_get_nav_menu_items($menu);
		$menuArr = array();
		$i = 0;
		foreach ($menu_items as $key => $menu_item) {
			//echo "<pre>";
			//var_dump($menu_item);
			//echo "</pre>";
			if ($menu_item->menu_item_parent == 0) {
				$i =  $menu_item->ID;
				$menuArr[$i]["titulo"] = $menu_item->title;
				$menuArr[$i]["id"] = $menu_item->object_id;
				$menuArr[$i]["url"] = $menu_item->url;
				$menuArr[$i]["icononame"] = $menu_item->attr_title;
			} else {
				$padre = $menu_item->menu_item_parent;
				$i =  $menu_item->ID;
				$menuArr[$padre]["h"][$i]["titulo"] = $menu_item->title;
				$menuArr[$padre]["h"][$i]["url"] = $menu_item->url;
			}
		}
		//echo "<pre>";
		//var_dump($menuArr);
		//echo "</pre>";
?>
<ul>
	<li class="quinto"><a href="Plantilla Inicio Periodico IGA.html"><i class="icon icon-home"></i></span></a>
<?php
$i = 1;
	foreach ($menuArr as $key => $itemdelmenu) {
		echo '<li class="item-'.$i;
		if ($itemdelmenu["id"] == $post_id) {
			echo " activo";
		}
		echo '">';
		echo '<a href="'.$itemdelmenu["url"].'"><span class="color-'.$i.'"><i class="icon '.$itemdelmenu["icononame"].'"></i></span>'.$itemdelmenu["titulo"].'</a>';
		if (isset($itemdelmenu["h"])) {
			echo "<ul>";
			foreach ($itemdelmenu["h"] as $key => $subitem) {
				echo '<li><a href="'.$subitem["url"].'">'.$subitem["titulo"].'</a></li>';
			}
			echo "</ul>";
		}
		echo "</li>";
		$i = $i+1;
	}
		?>
	</ul>
	<?php
		break;
	}
}
} else {
	//sinoooo
?>
<ul>
	<li class="quinto"><a href="Plantilla Inicio Periodico IGA.html"><i class="icon icon-home"></i></span></a>

	<li class="primero"><a href="#"><span class="segundo"><i class="icon icon-earth"></i></span>Artículos</a>
		<ul>
			<li><a href="articulos_nacionales.html">Nacionales</a></li>
			<li><a href="articulos_internacionales.html">Internacionales</a></li>
			<li><a href="articulos_deportes.html">Deportes</a></li>
			<li><a href="articulos_cultural.html">Cultural</a></li>
			<li><a href="articulos_economia.html">Economía</a></li>
		</ul>
	</li>
	<li class="segundo"><a href="galeria.html"><span class="tercero"><i class="icon icon-image"></i></span>Galería</a>
		<ul>
			<li><a href="articulos_nacionales.html">Nacionales</a></li>
			<li><a href="articulos_internacionales.html">Internacionales</a></li>
			<li><a href="articulos_deportes.html">Deportes</a></li>
			<li><a href="articulos_cultural.html">Cultural</a></li>
			<li><a href="articulos_economia.html">Economía</a></li>
		</ul>
	</li>
	<li class="tercero"><a href="editorial.html"><span class="cuarto"><i class="icon icon-accessibility"></i></span>Editorial</a>
	</li>
	<li class="cuarto"><a href="#"><span class="primero"><i class="icon icon-pacman"></i></span>Entretenimiento</a>
		<ul>
			<li><a href="juegos.html">Juegos</a></li>
			<li><a href="musica.html">Top 10 de Musica</a></li>
			<li><a href="seccioncomic.html">Comic</a></li>
		</ul>
	</li>
	<li class="segundo"><a href="para_padres.html"><span class="tercero"><i class="icon icon-github"></i></span>Padres</a></li>
</ul>
<?php
//termina sinooo
}
		?>
	</nav>
		</div>
		<div class="clearfix"></div>
	</header>
	</div>
	<div class="content">
