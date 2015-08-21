<?php /* Template Name: Sin Barra Lateral */ ?>
<?php
get_header();
?>
		<section class="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php 
			$ocultar = get_post_meta( get_the_ID(), 'ocultar_titulo' );
			//debug($ocultar);
			if (!$ocultar[0]) {
		?>
			<h1><?php the_title(); ?></h1><br>
			<?php }?><br>
			<div class="imagen">
				<?php the_content(); ?>
			</div>
			<?php endwhile; else : ?>
					<p><?php _e( 'No se encontró nada.' ); ?></p>
				<?php endif; ?>
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
