<?php get_header(); ?>

<img class="img-responsive" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

<div id="primary">
	<main id="main">
		<div class="container">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 

				while(have_posts()): the_post(); 

				get_template_part('content','single');

				?>

				<div class="row">
					<div class="paginacao text-left col-md-6 col-sm-6 col-xs-6"><?php previous_post_link(); ?>
					</div>

					<div class="paginacao text-right col-md-6 col-sm-6 col-xs-6"><?php next_post_link(); ?>
					</div>
				</div>

				<?php

				if(comments_open( ) || get_comments_number( )):

					comments_template();
				endif;


				
				endwhile;

				?>
			</div>

		</div>
	</main>
</div>

<?php get_footer(); ?>