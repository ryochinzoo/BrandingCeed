<?php get_header(); ?>
<div class="onload_animate_wrapper">
		<div class="onload_headline">
			<h1 class="onload_animate_wrapper has-text-align-center is-style-stylenone has-black-color has-text-color">
				<div class="onload_headline">WORKS</div></h1>
		</div>
	</div>
<div class="works_page_wrapper">
	<?php 
	$args = ['filter' => true, 'num' => 15, 'defaultCategory' => 'all'];
	get_template_part("works_list_parts", null, $args); 
	?>
</div>
<?php get_footer(); ?>