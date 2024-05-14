<?php get_header(); ?>

<div class="page_head">
	<div class="page_head_title">
		<?php the_field('page_head_title'); ?>
	</div>
	<img src="<?php the_field('page_head_img'); ?>" />
</div>

<div id="content">
	<div class="onload_animate_wrapper">
		<div class="onload_headline">
			<h1 class="onload_animate_wrapper has-text-align-center is-style-stylenone has-black-color has-text-color"><div class="onload_headline">無料相談</div></h1>
		</div>
	</div>
	<div class="contact-description">
		無料相談専用フォームです。<br />お仕事のご相談、料金の見積もり依頼など、お気軽にお問い合わせください。<br />
3営業日以内に弊社担当から日程調整のご返信をさせていただきます。<br />もしお急ぎの場合はその旨お伝えください。
	</div>
	<div class="annotation_for_required">
		＊マークは必須事項です。
	</div>
	<?php echo do_shortcode( '[contact-form-7 id="475" title="無料相談"]' ); ?>
</div>
<?php get_footer(); ?>