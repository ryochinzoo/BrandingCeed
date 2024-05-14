<div class="branding-service-wrapper">
	<?php
		$args = array(
			'numberposts' => 4, //表示する記事の数
			'post_type' => 'service', //投稿タイプ名
			'posts_per_page' => -1,
			'meta_key' => 'contentsOrder',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			// 条件を追加する場合はここに追記
		);
		//$customPosts = get_posts($args);
		$my_query = new WP_Query($args);

		if ($my_query->have_posts()) :
			while ($my_query->have_posts()) :
				$my_query->the_post();
				$index = $my_query->current_post + 1;
				$link = get_field('service_page_link');
		?>
		<div class="branding-service-contents-wrapper">
			
		<?php if ($link): ?>
			<a class="branding-service-link" href="<?php the_field('service_page_link'); ?>">
		<?php endif; ?>
		<?php 
			$branding_service_class_name = ($index % 2) ? "-left" : "-right";
			$branding_filter = ($index >= 3) ? "-green" : "";
			$open_ball_class_name = ($index % 2) ? "open-ball" : "open-ball-right";
			$branding_class_name_additional = ($index >= 3) ? $branding_service_class_name.'2' : $branding_service_class_name;
		?>
			<div class="branding-service<?php echo $branding_class_name_additional; ?>">
				<div class="background-filter<?php echo $branding_filter; ?>"></div>
				<div class="branding-service-contents">
					<div class="branding-service-title">
						<?php the_title(); ?>
					</div>
					<div class="branding-serivice-description">
						<?php the_content(); ?>
					</div>
					<ul class="branding-service-categories">
					<?php
						$target_taxonomy = 'service_cat';
						$categories = get_field('service_category');
						$sorted_terms = get_terms( array(
							'taxonomy' => $target_taxonomy,
							'include' => $categories,
							'hide_empty' => false,
							'oderby' => 'slug',
							'oder' => 'asc'
						));
						//foreach ( $categories as $category ) {
						//	$term = get_term($category, $target_taxonomy);
						//	echo '<li class="bs-category">'.$term->name.'</li>';
						//}
						foreach ( (array)$sorted_terms as $term ) {
							echo '<li class="bs-category">'.$term->name.'</li>';
						}
					?>
					</ul>
				</div>
			</div>
			<div class="<?php echo $open_ball_class_name; ?>">
				<div class="ball_opened_wrapper">
					<div class="ball_opened">
						OPEN
					</div>
				</div>
			</div>
				
			<?php if (isset($link)): ?>
				</a>
			<?php endif; ?>
		</div>
				
		<?php endwhile; ?>
				<?php endif; ?>
	
</div>