<?php
get_header();
?>
		<section class="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1><br>
			<div class="imagen">
				<?php
				if ( get_post_gallery() ) :
            	$gallery = get_post_gallery( get_the_ID(), false );
            	//var_dump($gallery);
            	$ides = explode(",", $gallery["ids"]);
            	//var_dump($ides);
            		/* Loop through all the image and output them one by one */
				foreach( $gallery['src'] AS $key => $src )
            		{
            		$identi = (int)$ides[$key];
            		$fullimage = wp_get_attachment_image_src( $identi, 'full');
            		//var_dump($fullimage);
                ?>
                <a href="<?php echo $fullimage[0];?>" alt="<?php echo the_title(); ?>-<?php echo $key; ?>">
                	<img class="zoom" src="<?php echo $src;  ?>" alt="<?php echo the_title(); ?>-<?php echo $key; ?>"/>
                </a>
                <?php
            	}
                ?>
                <small id="postInfo"><?php echo the_excerpt(); ?></small>
                <?php
                else:
                    the_content();
        		endif;
    			?>
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
