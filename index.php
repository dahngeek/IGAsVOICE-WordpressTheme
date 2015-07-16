<?php
get_header();
?>

<section class="main">
	<div class="container">
	<h1>Articulos y Noticias de IGA's Voice</h1><br>


<?php
$args = array(
'hide_empty'=> 1,
'orderby' => 'name',
'order' => 'ASC',
'exclude' => '1',
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
