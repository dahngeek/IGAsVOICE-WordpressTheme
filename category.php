<?php
get_header();
?>
<section class="main">
			<h2>Articulos <?php echo single_cat_title("",false); ?> IGA's Voice</h2><br>
           		<section class="ib-container" id="ib-container">
           			<?php
			$id = get_cat_id( single_cat_title("",false) );
			//echo $id;
			$args = array ('cat' => $id);
			$the_query = new WP_Query($args);
			?>
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<article>
						<header>
							<h3><a target="_blank" href="<?php the_permalink(); ?>" alt="<?php the_title();?>"><?php the_title();?></a></h3>
							<span><?php setlocale(LC_TIME, "es_ES"); the_time('j \o\f F \/ Y'); ?></span>
						</header>
						<?php the_excerpt(); ?>
					</article>
			<?php endwhile; ?>
			<?php endif; ?>
			</section>
		<script type="text/javascript">
			jQuery(document).ready(function($) {

				var $container	= $('#ib-container'),
					$articles	= $container.children('article'),
					timeout;

				$articles.on( 'mouseenter', function( event ) {

					var $article	= $(this);
					clearTimeout( timeout );
					timeout = setTimeout( function() {

						if( $article.hasClass('active') ) return false;

						$articles.not( $article.removeClass('blur').addClass('active') )
								 .removeClass('active')
								 .addClass('blur');

					}, 65 );

				});

				$container.on( 'mouseleave', function( event ) {

					clearTimeout( timeout );
					$articles.removeClass('active blur');

				});

			});
		</script>
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
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
			</div>
		</aside>


<?php
get_footer();
?>
