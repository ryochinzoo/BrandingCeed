<?php get_header(); ?>
<?php 
	$category =  get_the_terms($post->ID, 'works_cat');
	$cat = $category[0];

	//カテゴリー名
	$cat_name = $cat->name;

	//カテゴリーID
	$cat_id = $cat->cat_ID;

	//カテゴリースラッグ
	$cat_slug = $cat->slug;

	$tags = get_the_terms($post -> ID, 'works_tag');

?>
<div class="works_page_wrapper">
	<div class="works_single_title">
		<?php the_title(); ?>
	</div>
	<div class="works_single_company_name">
		<?php the_field("company_name"); ?>
	</div>
	<div class="works_category_tag_wrapper">
		<span class="work_category">
			<?php echo $cat_name; ?>
		</span>
		<?php
			if ($tags) {
				foreach ($tags as $tag) {
					echo('<span class="work_tag">');
					echo "#".esc_html($tag->name);
					echo('</span>');
				}
			}
		?>
	</div>
	<div class="work_single_image">
		<?php the_post_thumbnail('full'); ?>
	</div>
	<div class="work_single_contents_wrapper">
		<div class="work_single_left_column">
			<div class="head_of_left_column">
				<div>
					PROJECT MEMBERS
				</div>
				<div>
				ー
				</div>
			</div>
			<?php	
				$project_members = SCF::get('work_members');
				foreach ($project_members as $member) {
			?>
				<div class="member_element">
					<div class="member_el_head">
						<?php echo $member['position']; ?>
					</div>
					<div class="member_el_name">
						<?php echo $member['name']; ?>
					</div>
					<div class="member_el_companyname">
						<?php echo $member['business_name']; ?>
					</div>
				</div>
			<?php
				}
			?>
		</div>
		<div class="work_single_right_column">
			<div class="work_single_detail_info">
				<div class="work_single_detail_info_contents_wrapper">
					<div class="work_single_detail_info_contents">
						<div class="detail_info_head">
							<span>クライアント　｜　CLIENT</span>
						</div>
						<div class="detail_info_contents">
							<?php the_field('client'); ?>
						</div>
					</div>
					<div class="work_single_detail_info_contents">
						<div class="detail_info_head">
							<span>エリア　｜　AREA</span>
						</div>
						<div class="detail_info_contents">
							<?php the_field('area'); ?>
						</div>
					</div>
					<div class="work_single_detail_info_contents">
						<div class="detail_info_head">
							<span>業種　｜　INDUSTRY</span>
						</div>
						<div class="detail_info_contents">
							<?php the_field('industry'); ?>
						</div>
					</div>
					<div class="work_single_detail_info_contents">
						<div class="detail_info_head">
							<span>期間　｜　DATE</span>
						</div>
						<div class="detail_info_contents">
							<?php the_field('startdate'); ?> - <?php the_field('enddate'); ?>
						</div>
					</div>
					<div class="work_single_detail_info_contents">
						<div class="detail_info_head">
							<span>ホームページ　｜　WEBSITE</span>
						</div>
						<div class="detail_info_contents">
							<?php the_field('website'); ?>
						</div>
					</div>
				</div>
			</div>
			<?php the_content(); ?>
		</div>
	</div>
	<div class="headline_animate_wrapper">
		<h2 class="contents_headline" style="text-align: center">
			最新の事例
		</h2>
	</div>
	<?php 
	$args = ['filter' => false, 'num' => 3, 'defaultCategory' => $cat_slug];
	get_template_part("works_list_parts", null, $args); 
	?>
</div>
<?php get_footer(); ?>