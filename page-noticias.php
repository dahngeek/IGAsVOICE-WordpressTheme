<?php
get_header();
?>
<section class="main">
	<div class="container">
	<h1>Articulos y Noticias de IGA's Voice</h1><br>
	<!-- <section id="jms-slideshow" class="jms-slideshow">
		<?php
		/* Get all Sticky Posts */
		$sticky = get_option( 'sticky_posts' );

		/* Sort Sticky Posts, newest at the top */
		rsort( $sticky );

		/* Get top 5 Sticky Posts */
		$sticky = array_slice( $sticky, 0, 5 );

		/* Query Sticky Posts */
		$query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1, 'posts_per_page' =>  ) );
		$i = 1;
		?>
		<?php if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="step" data-color="color-<?php echo $i;?>" data-x="<?php echo 800*$i;?>" data-y="<?php echo 800*$i;?>" data-rotate-x="<?php echo mt_rand(0, 180);?>">
			<div class="jms-content">
				<h3><?php the_title(); ?></h3>
			<p><?php the_excerpt(); ?></p>
				<a class="jms-link" href="<?php the_permalink(); ?>">Read more</a>
			</div>
			<img src="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
echo($thumb['0']); ?>" />
		</div>
		<?php $i = $i + 1;?>
	<?php endwhile; ?>
	<?php endif; ?>

	</section>
		</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		var jmpressOpts	= {
			animation		: { transitionDuration : '0.8s' }
		};

		$( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
			autoplay	: true,
			bgColorSpeed: '0.8s',
			arrows		: false
		}));

	});
</script> -->

<?php
$args = array(
'hide_empty'=> 1,
'orderby' => 'name',
'order' => 'ASC'
);
$categories = get_categories($args);
foreach($categories as $category) {
?>
<div class="clearfix"></div>
	<br><h2><? echo $category->name;?></h2><a href="<?php echo get_category_link( $category->term_id ); ?>"><p>VER MÁS</p></a><br>
	<?php
	$the_query = new WP_Query(
		array( 'posts_per_page' => 2,
					 'category_name' => $category->slug
				 ) );
	?>
	<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="contenedor">
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
<?php
}

?>
</section>


		<aside>
			<div class="flexsearch">
				<div class="flexsearch--wrapper">
					<form class="flexsearch--form" action="#" method="post">
						<div class="flexsearch--input-wrapper">
							<input class="flexsearch--input" type="search" placeholder="search">
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
