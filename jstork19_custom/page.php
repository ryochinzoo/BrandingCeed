<?php get_header(); ?>

<div class="page_head">
	<div class="page_head_title">
		<?php the_field('page_head_title'); ?>
	</div>
	<img src="<?php the_field('page_head_img'); ?>" />
</div>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( get_option( 'front_page_ttl_display', 'off' ) == 'on' && !is_home() || !is_front_page() ) : ?>

<section class="entry-content cf page_wrapper">
<?php the_content(); ?>
</section>

<?php endif; ?>

</article>


<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>