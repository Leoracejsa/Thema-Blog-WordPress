<?php get_header(); ?>

<img class="img-responsive" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

<div id="primary">
	<main id="main">
		<div class="container">
			<h2>Resultados de pesquisa para: <?php echo get_search_query(); ?> </h2>


			<?php 

			get_search_form();

			while(have_posts()): the_post(); 

			get_template_part('content','search');

			if(comments_open( ) || get_comments_number( )):

				comments_template();
			endif;
			
			endwhile;

			the_posts_pagination(array(

				'prev_text'  =>  'Anterior',
				'next_text'  =>  'Próximo'
				));

			?>

		</div>
	</main>
</div>

<?php get_footer(); ?>