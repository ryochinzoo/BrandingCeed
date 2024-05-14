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

		<section class="entry-content cf page_company_wrapper">
			<!--<div class="bg_tree">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tree.png" />
			</div>-->
			<?php the_content(); ?>
			<div class="company-contents-block">
				<div class="bc_accordion">
					<div class="accordion_wrapper">
						<div class="bc_accordion_main_parts">
							<div class="sub_title">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/VISION.png" />
							</div>
							<div class="bc_accordion_label">好循環が生まれることで未来をより豊かに</div>
							<div class="icon-wrap"><span class="icon"></span></div>
						</div>
						<div class="ac_content">
							まず強いブランドを創り、その成長する過程を隣で伴走することで、<br />
							豊かなサイクルを実現できる未来創りに貢献します。
						</div>
					</div>
					<div class="accordion_wrapper">
						<div class="bc_accordion_main_parts">
							<div class="sub_title">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/MISSION.png" />
							</div>
							<div class="bc_accordion_label">未来の温度をあげよう</div>
							<div class="icon-wrap"><span class="icon"></span></div>
						</div>
						<div class="ac_content">
							人は何かを食べると、体温が上ります。<br />
							気持ちがあがると、体温が上がります。<br />
							会社も、社員も、顧客も、熱をあげファンになる<br />
							応援したくなる良い企業を創出し、循環を生み出します。
						</div>
					</div>
					<div class="accordion_wrapper">
						<div class="bc_accordion_main_parts">
							<div class="sub_title">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/VALUE.png" />
							</div>
							<div class="bc_accordion_label">大切にしたいこと</div>
							<div class="icon-wrap"><span class="icon"></span></div>
						</div>
						<div class="ac_content">
							<div class="ac_wrapper">
								<div class="ac_title">
									課題を捉える
								</div>
								会社によって課題は様々。先入観や過去の経験から決めつけることなく向き合おう。<br />
							</div>
							<div class="ac_wrapper">
								<div class="ac_title">
									プロであろう
								</div>
								仕事には責任をもって接し、立場や多様性を理解しながら自ら進んで行動しよう。<br />
							</div>
							<div class="ac_wrapper">
								<div class="ac_title">
									楽しみ前向きに挑戦する
								</div>
								何事も楽しんで取り組み、常に挑戦していく気持ちを大切にしよう。<br />
							</div>
							<div class="ac_wrapper">
								<div class="ac_title">
									信頼し誠実であろう
								</div>
								仲間を信頼し、人生を尊重し、誠実な行動をしよう。遠慮は必要ないが、配慮を大切にしよう。<br />
							</div>
							<div class="ac_wrapper">
								<div class="ac_title">
									お互いを肯定し共創する
								</div>
								お互いをリスペクトし、肯定することで歩み寄り共に創造しよう。<br />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="company-info" class="company-contents-block">
				<div class="headline_animate_wrapper">
					<div class="contents_headline">
						<p class="has-text-align-center">
								会社概要
						</p>
					</div>
				</div>
				<figure class="wp-block-table is-style-stk-table-border">
					<table>
						<tbody>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">商号</td>
								<td class="has-text-align-left" data-align="left">合同会社ブランディングシード（Branding C° inc.）</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">所在地</td>
								<td class="has-text-align-left" data-align="left">東京都中央区銀座6丁目13番16号 銀座Wallビル　UCF5階</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">資本金</td>
								<td class="has-text-align-left" data-align="left">1,000,000円</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">設立</td>
								<td class="has-text-align-left" data-align="left">2023年1月6日</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">代表社員</td>
								<td class="has-text-align-left" data-align="left">上野　藍</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">取引銀行</td>
								<td class="has-text-align-left" data-align="left">りそな銀行</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">事業内容</td>
								<td class="has-text-align-left" data-align="left">ブランディング事業<br />クリエイティブ事業</td>
							</tr>
							<tr>
								<td class="has-text-align-center bc_table_head" data-align="center">所属団体</td>
								<td class="has-text-align-left" data-align="left">東京商工会議所<br />一般社団法人 経営実践研究会</td>
							</tr>
						</tbody>
					</table>
				</figure>

			</div>
			<div class="company-contents-block">
				<div class="headline_animate_wrapper">
					<div class="contents_headline">
						<p class="has-text-align-center">
								環境への取り組み
						</p>
					</div>
				</div>	
				<div class="company-actions-wrapper">
					<div class="company-action">
						<div class="company-action-headline">
							SDGs
						</div>
						<div class="company-action-body">
							弊社では、目標17 「パートナーシップでの目標達成」にコミットいたします。<br />
							国や企業をはじめとした全世界の人々がパートナーシップを組むことで持続可能な社会を作り上げる未来を目標とし、ご賛同いただける企業様、個人事業主やフリーランス様とのパートナーシップを積極的に取り組みます。
						</div>
					</div>
					<div class="company-action">
						<div class="company-action-headline">
							地球環境への配慮
						</div>
						<div class="company-action-body">
							弊社では、人や未来といった精神的・経済的な温度はあげたいですが、地球温暖化問題は深刻に捉えています。<br />
							売上の一部をWWF（世界自然保護基金）に寄付することで、地球温暖化防止や、生物多様性の豊かさの回復を支援します。<br />
							※創業以前から、代表が10年間支援してきた団体になります。
						</div>
					</div>

				</div>
			</div>
		</section>

		<?php endif; ?>

	</article>


	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>