<?php /* Template Name: Plantilla con Barra lateral */ ?>
<?php
get_header();
?>

		<section class="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1><br>
			<small id="postInfo"><?php setlocale(LC_TIME, "es_ES"); ?><?php echo strftime("%d de %B de %Y"); ?></small>

			<div class="contenidoNoticia" style="margin-top:10px;">
			 <?php the_content(); ?>
			</div>

				<?php endwhile; else : ?>
					<p><?php _e( 'No se encontró nada.' ); ?></p>
				<?php endif; ?>

		</section>

		<aside>
			<div class="flexsearch">
				<div class="flexsearch--wrapper">
					<form class="flexsearch--form" action="/" method="get">
						<div class="flexsearch--input-wrapper">
							<input class="flexsearch--input" name="s" type="search" placeholder="search">
						</div>
						<input class="flexsearch--submit" type="submit" value="&#10140;"/>
					</form>
				</div>
		</div>
		<div id="barraLat">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</div>
		</aside>
<?php
get_footer();
?>
