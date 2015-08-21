<?php /* Template Name: Sin Barra Lateral */ ?>
<?php
get_header();
?>
		<section class="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1><br>
			<div class="imagen">
				<?php the_content(); ?>
			</div>
			<?php endwhile; else : ?>
					<p><?php _e( 'No se encontró nada.' ); ?></p>
				<?php endif; ?>
		</section>
<section id="posts-70" class="clearfix" style="padding-top: 35px;padding-left: 27px;">
<?php
			$the_query = new WP_Query( array('category_name' => 'iga-70-a', 'post__not_in' => get_option( 'sticky_posts' )));
			?>
			<?php if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="contenedor" style="float:left;margin-left: -2%;">
				<div class="elemento">
				<div class="imagCont" style="background:url(<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); if ($thumb) {echo($thumb['0']);} else { bloginfo('template_url'); echo "/img/".mt_rand(6, 32).".jpg";} ?>);background-size: cover;">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title();?>">
						<h2><?php the_title();?></h2>
					</a>
				</div>
				<?php the_excerpt(); ?>
				</div>
			</div>
				<?php endwhile; ?>
			<?php endif; ?>
	<div class="clearfix"></div>
		</section>
<section class="grid">
<?php $loop = new WP_Query( array( 'post_type' => 'galerias', 'posts_per_page' => -1, 'tag'=>'iga70' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
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
				<div class="img" style="background:url(<?php echo $imagen; ?>);background-size:cover;"></div>
				
				<figcaption>
					<h2><?php the_title(); ?><span></span></h2>
					<p><?php echo substr(get_the_excerpt(), 0, 30)." [...]"; ?></p>
					<a href="<?php the_permalink(); ?>">Ver más</a>
				</figcaption>
			</figure>
			
<?php endwhile; wp_reset_query(); ?>
</section>
		<aside>
		<!--<div class="setsnav">
				<nav class="codrops-demos">
				<a class="current-demo" href="galeria.html">Set 1</a>
				<a href="galeria2.html">Set 2</a>
				</nav>
			</div> -->
			<?php dynamic_sidebar( 'main-footerbar' ); ?>
		<!--<div class="flexsearch">
				<div class="flexsearch--wrapper">
					<form class="flexsearch--form" action="#" method="post">
						<div class="flexsearch--input-wrapper">
							<input class="flexsearch--input" type="search" placeholder="search">
						</div>
						<input class="flexsearch--submit" type="submit" value="&#10140;"/>
					</form>
				</div>
		</div>-->
		</aside>
<?php
get_footer();
?>
