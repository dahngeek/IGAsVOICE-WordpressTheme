<?php
get_header();
?>
<section class="main">
	<h1>Galería IGA's Voice</h1><br>
		<div class="grid">
			<?php
				if (isset($_GET['ver'])) {
					global $query_string;
					switch ($_GET['ver']) {
						case 'infografias':
							 query_posts( $query_string . '&tag=infografias' );
							 $busca = "infografias";
							break;
						case 'videos':
								 query_posts( $query_string . '&tag=videos' );
								 $busca = "videos";
								break;
						case 'todo':
								 $busca = "todo";
								break;
						case 'fotos':
									$busca = "fotos";
									$fotosid = get_term_by('slug','videos', 'post_tag');
									$infosid = get_term_by('slug','infografias', 'post_tag');
									//var_dump($fotosid);
									//var_dump($infosid);
									global $wp_query;
									$args = array_merge( $wp_query->query_vars, array( 'tag__not_in' => array($infosid->term_id, $fotosid->term_id), 'posts_per_page' => 100) );
									//var_dump($args);
									query_posts( $args );
								break;
						default:
							# code...
							break;
					}
				} else {
					$busca = "todo";
				}
			?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<figure class="effect-goliath">
				<!-- 367 x 273 -->
				<?php
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(367, 273) );
				if ($thumb) {
					$imagen = $thumb['0'];
				} else {
					if ( get_post_gallery() ) :
	            	$gallery = get_post_gallery( get_the_ID(), false );
	            	//var_dump($gallery);
	            	$ides = explode(",", $gallery["ids"]);
	            	//var_dump($ides);
								$identi = (int)$ides[0];
								$fullimage = wp_get_attachment_image_src( $identi, array(367, 273));
								$imagen = $fullimage['0'];
					  else:
	                    $imagen = get_bloginfo('template_url')."/img/".mt_rand(6, 32).".jpg";
	        	endif;
				}
				?>
				<img src="<?php echo $imagen; ?>" alt=""/>
				<figcaption>
					<h2><?php the_title(); ?><span></span></h2>
					<p><?php echo substr(get_the_excerpt(), 0, 30)." [...]"; ?></p>
					<a href="<?php the_permalink(); ?>">Ver más</a>
				</figcaption>
			</figure>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
</section>
<aside>
	<div class="setsnav">
			<nav class="codrops-demos">
			<a class="<?php if($busca == "todo") {echo "current-demo";} else {echo "none";} ?>" href="?ver=todo">TODO</a>
			<a class="<?php if($busca == "fotos") {echo "current-demo";} else {echo "none";} ?>" href="?ver=fotos">FOTOS</a>
			<a class="<?php if($busca == "videos") {echo "current-demo";} else {echo "none";} ?>" href="?ver=videos">VIDEOS</a>
			<a class="<?php if($busca == "infografias") {echo "current-demo";} else {echo "none";} ?>" href="?ver=infografias">INFOGRAFÍAS</a>
			</nav>
		</div>
<div class="flexsearch">
		<div class="flexsearch--wrapper">
			<form class="flexsearch--form" action="/" method="get">
				<div class="flexsearch--input-wrapper">
					<input class="flexsearch--input" type="search" name="s" placeholder="search">
				</div>
				<input class="flexsearch--submit" type="submit" value="&#10140;"/>
			</form>
		</div>
</div>
<?php dynamic_sidebar( 'main-footerbar' ); ?>
</aside>
<?php
get_footer();
?>
