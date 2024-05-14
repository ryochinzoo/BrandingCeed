<?php get_header(); ?>
<div id="content">
	<div class="rotate_logo">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rolling_bklogo.svg" />
	</div>
	<div class="company_vision_top first_view fadeUp delay_three">
		<div class="headline_animate_wrapper">
			<h2 class="contents_headline">
				About
			</h2>
		</div>
		<div>
		BrandingC°は、新しい時代の未来を創造したい企業・団体を支援するブランディングファームです。<br />
		根底にある想いが違うからこそ、生み出される商品も体験も違ってきます。<br />
		未来の姿を言語化し、一貫した「視覚化」と「設計」をすることで、ブランド価値を育み<br />
		会社・社員・顧客も熱をあげてファンになる、実り豊かな未来を共に創ります。<br />
		戦略、コンサルティング、CI、Web、デザイン、DX、採用など、<br />
		身近な企業課題、地域課題、社会課題から未来創造に繋げるパートナーです。
		</div>
	</div>
	<div class="commitment_slider">
			<div class="commitment-slider-wrapper">
				<?php
				$args = array(
					//'numberposts' => 10, 表示する記事の数
					'post_type' => 'commitment', //投稿タイプ名
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
				?>
				<div class="commitment-slide">
					<div class="commitment-image">
						<img src="<?php the_field('icon'); ?>" />
					</div>
					<div class="commitment-subtitle">
						COMMITMENT0<?php echo $index; ?>
					</div>
					<div class="commitment-title">
						<?php the_title(); ?>
					</div>
					<div class="service-summary">
						<?php the_content(); ?>
					</div>
				</div>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>

	<div class="top_branding">
		<div class="headline_animate_wrapper">
			<h2 class="contents_headline">
				BRANDING-SERVICE
			</h2>
		</div>
		<?php get_template_part("branding_service_parts"); ?>
		
		<!--
		<div class="top_branding_contents_wrapper">
			<div class="top_branding_img">
				<img src="https://branding-ceed.com/wp-content/uploads/2023/01/Rechteck-31.png" />
			</div>
			<div class="top_branding_contents">
				<div class="headline_animate_wrapper">
					<h2 class="contents_headline" style="text-align: left">
						BRANDING
					</h2>
				</div>
				<div class="top_branding_description">
					ブランディングで「ほかにはない、あなただけの魅力」を引き出し、自社やお客様が熱をあげ「ファン」になる活動を共に創ります。
				</div>
				<a class="top_branding_button" href="/branding-ceed/branding/">
					MORE
				</a>
			</div>
		</div>
		<div class="headline_animate_wrapper">
			<h2 class="contents_headline">
				キャンペーン
			</h2>
		</div>
		<div>
			<?php echo do_shortcode( '[pickupcontent]' ); ?>
		</div>-->
	</div>
<!--
	<div class="top_service">
		<div class="service_clickarea_left"></div>
		<div class="headline_animate_wrapper">
			<h2 class="contents_headline">
				BRANDINGの一部を紹介
			</h2>
		</div>
		<div class="service_slider">
			<div class="service-slider-wrapper">
				<?php
				$args = array(
					//'numberposts' => 10, 表示する記事の数
					'post_type' => 'service', //投稿タイプ名
					'posts_per_page' => -1,
					'order' => 'ASC',
					// 条件を追加する場合はここに追記
				);
				//$customPosts = get_posts($args);
				$my_query = new WP_Query($args);

				if ($my_query->have_posts()) :
				while ($my_query->have_posts()) :
				$my_query->the_post();
				?>
				<div class="service-slide">
					<div class="service-image">
						<?php the_post_thumbnail('thumbnail'); ?>
					</div>
					<div class="service-title">
						<?php the_title(); ?>
					</div>
					<div class="service-summary">
						<?php the_content(); ?>
					</div>
				</div>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="service_clickarea_right"></div>
	</div>-->
	<!--一時的に非表示<div class="blog-wrapper">
		<div class="blog-position-centering">
			<div class="headline_animate_wrapper">
				<h2 class="contents_headline">
					BLOG
				</h2>
			</div>
			<div class="blog-contents-wrapper">
				<?php 
				$args = array(
					'post_type' => 'post', //投稿タイプ名
					'posts_per_page' => 3,
					'order' => 'DESC',
					// 条件を追加する場合はここに追記
				);
				//$customPosts = get_posts($args);
				$my_query = new WP_Query($args);

				if ($my_query->have_posts()) :
				while ($my_query->have_posts()) :
				$my_query->the_post();
				$category = get_the_category();
				?>
				
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="blog_link">
				<div class="blog-card">
					<div class="blog-image">
						<figure class="eyecatch of-cover">
							<?php
							echo skt_oc_post_thum();
							?>
						</figure>
					</div>
					<div><span class="blog-data"><?php the_date();//stk_postdate is in parts -> mainparts ?></span>
					<?php if($category[0]): ?>
						<span class="cat-name cat-id-4">
							<?php echo $category[0]->cat_name; ?>
						</span>
					<?php endif; ?>
					</div>
					<div class="blog-title">
						<?php
							if(mb_strlen($post->post_title)>27) {
	 							$title= mb_substr($post->post_title,0,27) ;
								echo $title . '...';
								} else {
									echo $post->post_title;
								  }
						?>
					</div>
					<div class="blog-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
					
</a>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>			
	</div>
</div>-->

<div class="page-links-wrapper">
	<div class="page-banner">
		<a href="/branding-ceed/branding/">
			<div class="page-banner-deco"></div>
			<div class="page-banner-title">
				BRANDING
			</div>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/branding-img.png" />
		</a>
	</div>
	<div class="page-banner">
		<a href="/branding-ceed/message/">
			<div class="page-banner-deco"></div>
			<div class="page-banner-title">
				MESSAGE
			</div>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/message-img.png" />
		</a>
	</div>
	<div class="page-banner">
		<a href="/branding-ceed/company/#company-info">
			<div class="page-banner-deco"></div>
			<div class="page-banner-title">
				会社概要
			</div>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/company-img.png" />
		</a>
	</div>
</div>
<?php get_footer(); ?>