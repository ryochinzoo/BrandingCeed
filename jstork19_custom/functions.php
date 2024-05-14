<?php

// 子テーマのstyle.cssを後から読み込む
add_action( 'wp_enqueue_scripts', 'stk_add_child_stylesheet' );
function stk_add_child_stylesheet() {
	wp_enqueue_style( 'stk_child-style',
					 get_stylesheet_directory_uri() . '/style.css',
					 array('stk_style')
					);
}


// カスタマイズでコードを追記する場合はここよりも下に記載してください


add_action('stk_hook_header_after', 'home_header_kv_wrapper', 4); //5は既存。４と９で全部囲む。
add_action('stk_hook_header_after', 'home_header_kv_logo_and_parts', 6);
add_action('stk_hook_header_after', 'home_promotion_button', 7);
//add_action('stk_hook_header_after', 'home_news_slider', 8);
add_action('stk_hook_header_after', 'home_close_div_tag', 9);

add_shortcode('add_part', function($attr){
	ob_start();
	get_template_part($attr['temp']);
	return ob_get_clean();
});
add_shortcode('add_works_temp', function($attr){
	ob_start();
	$filter = $attr['filter'] === 'true' ? true : false;
	$args = ['filter' => $filter, 'num' => $attr['num'], 'defaultCategory' => $attr['default_category']];
	get_template_part($attr['temp'], null, $args);
	return ob_get_clean();
});
global $wp_query;

// ajaxを使用する際に取得するURLをグローバル変数に渡す
function my_ajax_url() {
	
?>
  <script>var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
<?php
}
add_action('wp_head', 'my_ajax_url', 1);
function select_category_ajax_php(){

	$paged = $_POST['page'] ? $_POST['page'] : 1;
	if ($_POST['cat'] == 'all') { // 全件表示
		$taxqueryArr[] = array(
			'taxonomy' => 'works_cat',
			'field' => 'slug',
			'terms' => array( 'enterprise_brandings', 'experience_designs', 'recruitment_branding', 'other_works' ),
			'include_children' => true,
			'operator' => 'AND'
		);
		$works = new WP_Query( array(
			'post_type' => 'works',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => -1,
		));
	} else { // カテゴリー表示
		$taxqueryArr[] = array(
			'taxonomy' => 'works_cat',
			'field' => 'slug',
			'terms' => $_POST['cat'],
			'include_children' => true,
			'operator' => 'AND'
		);
		$works = new WP_Query( array(
			'post_type' => 'works',
			'tax_query' => $taxqueryArr,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => -1,
		));
	}
	$GLOBALS['wp_query'] = $works;
	$max_num_pages = $works->max_num_pages;
	if ( $works->have_posts() ) :
	while ( $works->have_posts() ) :
	$works->the_post();
?>
<?php
	$category = get_the_terms($my_query->ID, 'works_cat');
?>
<div class="work_list_element_wrapper">
		<a href="<?php the_permalink() ?>" class="works_element_link">
		<div class="work_element_image">
			<?php the_post_thumbnail('full'); ?>
		</div>
		<div class="work_element_title">
			<?php the_title(); ?>
		</div>
		<div class="work_element_company_name">
			<?php the_field("company_name"); ?>
		</div>
		<div class="work_element_category">
			<?php if($category[0]): ?>
			<span class="work_category">
				<?php echo $category[0]->name; ?>
			</span>
			<?php endif; ?>
		</div>
		</a>
	</div>

<?php
	endwhile;
	wp_reset_postdata();
	endif;
	die();
}
add_action('wp_ajax_select_category_ajax_php', 'select_category_ajax_php');
add_action('wp_ajax_nopriv_select_category_ajax_php', 'select_category_ajax_php');
function wp_custom_sort_get_terms_args( $args, $taxonomies ) 
{
    $args['orderby'] = 'slug';
    $args['order']   = 'ASC';

    return $args;
}
add_filter( 'get_terms_args', 'wp_custom_sort_get_terms_args', 10, 2 );

function home_header_kv_wrapper() {
	if (is_home()) {
		echo '<div class="kv_wrapper">';
	}
}
add_theme_support('post-thumbnails');
function home_header_kv_logo_and_parts() {
	if (is_home()) {
		echo '<div class="kv_scroll_ui first_view fadeUp delay_three"><img src="'.get_stylesheet_directory_uri().'/images/scroll.gif" /></div>';
		echo '<div class="kv_logo_parts">';
		echo '<div class="kv_logo_center first_view fadeUp"><img src="'.get_stylesheet_directory_uri().'/images/kv-logo.svg" /></div>';
		echo '<div class="kv_animate_wrapper"><div class="kv_copy first_view delay_two">未来の温度を変えよう</div></div>';
		echo '</div>';
		home_news_slider();
	}
}
function home_promotion_button() {
	if (is_home()) {
		//echo '<div class="kv_promotion first_view fadeUp delay_three"><img src="'.get_stylesheet_directory_uri().'/images/kv-present.png" /></div>';
	}
}
function home_close_div_tag() {
	echo '</div>';
}
function home_news_slider() {
	if (is_home()) {
		echo '<div class="news_slider_component first_view fadeUp delay_three">';
		echo '<div class="news_slider_wrapper">';
		echo '<div class="newsPrevArrow"></div>';
		echo '<div class="news_slider">';
		$args = array(
			//'numberposts' => 10, 表示する記事の数
			'post_type' => 'news', //投稿タイプ名
			'posts_per_page' => 3,
			'order' => 'DESC',
			// 条件を追加する場合はここに追記
		);
		//$customPosts = get_posts($args);
		$my_query = new WP_Query($args);

		if ($my_query->have_posts()) {
			while ($my_query->have_posts()) {
				$my_query->the_post();
?>
<div class="news-slide">
	<!--<a class="news_link" href="<?php the_permalink(); ?>" >-->
		<div class="news-slide-wrapper">
			<div class="news-date">
				<?php echo get_the_date( 'Y/m/d' ); ?>
			</div>
			<div class="news-title">
				<?php the_title(); ?>
			</div>
		</div>
	<!--</a>-->
</div>
<?php 
			}
		}
		echo '</div>';
		echo '<div class="newsNextArrow"></div>';
		echo '</div>';
		//echo '<div class="more-news">NEWS一覧</div>';
		echo '</div>';
	}
}
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'news', /* カスタム投稿タイプスラッグ */
					   array(
						   'labels' => array( /* 表示させる文字 */
							   'name' => 'お知らせ',
							   'singular_name' => 'お知らせ投稿',
							   'all_items' => 'お知らせ投稿一覧',
							   'add_new' => 'お知らせ投稿追加',
							   'add_new_item' => 'お知らせ投稿の追加',
							   'edit_item' => 'お知らせ投稿の編集',
							   'new_item' => 'お知らせ投稿追加',
							   'view_item' => 'お知らせ投稿を表示',
							   'search_items' => 'お知らせ投稿を検索',
							   'not_found' =>  'お知らせ投稿が見つかりません',
							   'not_found_in_trash' => 'ゴミ箱内にお知らせ投稿が見つかりませんでした。',
							   'parent_item_colon' => ''
						   ),
						   'public' => true, /* 管理画面にメニューを作る */
                           'show_in_rest' => true,
						   'show_ui' => true, /* 管理画面にメニューを作る */
						   'query_var' => true,
						   'hierarchical' => true, /* 固定ページみたいに記事間の親子関係をつくる */
						   'supports' => array('title','editor','thumbnail'), /* 管理画面で登録できる項目 */
						   'menu_position' => 6, /* 管理画面のメニューの位置（5,10,15・・・） */
						   'has_archive' => true, /* アーカイブページを持つ */
						   'rewrite' => array( /* slug:スラッグ名　with_front:アーカイブページURLに/archive/をつける */
							   'slug' => 'news','with_front' => false)
					   )
					  );
	register_taxonomy('news_cat','news', array(
		'hierarchical' => true,
		'labels' => array( /* 表示させる文字 */
			'name' => 'お知らせカテゴリ',
			'singular_name' => 'お知らせカテゴリ',
			'search_items' =>  'お知らせカテゴリを検索',
			'all_items' => 'すべてのお知らせカテゴリ',
			'parent_item' => '親分類',
			'parent_item_colon' => '親分類：',
			'edit_item' => '編集',
			'update_item' => '更新',
			'add_new_item' => 'お知らせカテゴリを追加',
			'new_item_name' => '名前',
		),
		'show_ui' => true, /* 管理画面にメニューを作る */
		'rewrite' => array(
			'slug' => 'news','with_front' => true,'hierarchical' => true)
	));
	register_post_type( 'service', /* カスタム投稿タイプスラッグ */
					   array(
						   'labels' => array( /* 表示させる文字 */
							   'name' => 'サービス',
							   'singular_name' => 'サービス投稿',
							   'all_items' => 'サービス投稿一覧',
							   'add_new' => 'サービス投稿追加',
							   'add_new_item' => 'サービス投稿の追加',
							   'edit_item' => 'サービス投稿の編集',
							   'new_item' => 'サービス投稿追加',
							   'view_item' => 'サービス投稿を表示',
							   'search_items' => 'サービス投稿を検索',
							   'not_found' =>  'サービス投稿が見つかりません',
							   'not_found_in_trash' => 'ゴミ箱内にサービス投稿が見つかりませんでした。',
							   'parent_item_colon' => ''
						   ),
						   'public' => true, /* 管理画面にメニューを作る */
                           'show_in_rest' => true,
						   'show_ui' => true, /* 管理画面にメニューを作る */
						   'query_var' => true,
						   'hierarchical' => true, /* 固定ページみたいに記事間の親子関係をつくる */
						   'supports' => array('title','editor','thumbnail'), /* 管理画面で登録できる項目 */
						   'menu_position' => 7, /* 管理画面のメニューの位置（5,10,15・・・） */
						   'has_archive' => true, /* アーカイブページを持つ */
						   'rewrite' => array( /* slug:スラッグ名　with_front:アーカイブページURLに/archive/をつける */
							   'slug' => 'service','with_front' => false)
					   )
					  );
	register_taxonomy('service_cat','service', array(
		'hierarchical' => true,
		'labels' => array( /* 表示させる文字 */
			'name' => 'サービスカテゴリ',
			'singular_name' => 'サービスカテゴリ',
			'search_items' =>  'サービスカテゴリを検索',
			'all_items' => 'すべてのサービスカテゴリ',
			'parent_item' => '親分類',
			'parent_item_colon' => '親分類：',
			'edit_item' => '編集',
			'update_item' => '更新',
			'add_new_item' => 'サービスカテゴリを追加',
			'new_item_name' => '名前',
		),
		'show_ui' => true, /* 管理画面にメニューを作る */
		'rewrite' => array(
			'slug' => 'service','with_front' => true,'hierarchical' => true)
	));
	register_post_type( 'works', /* カスタム投稿タイプスラッグ */
					   array(
						   'labels' => array( /* 表示させる文字 */
							   'name' => '実績',
							   'singular_name' => '実績投稿',
							   'all_items' => '実績投稿一覧',
							   'add_new' => '実績投稿追加',
							   'add_new_item' => '実績投稿の追加',
							   'edit_item' => '実績投稿の編集',
							   'new_item' => '実績投稿追加',
							   'view_item' => '実績投稿を表示',
							   'search_items' => '実績投稿を検索',
							   'not_found' =>  '実績投稿が見つかりません',
							   'not_found_in_trash' => 'ゴミ箱内に実績投稿が見つかりませんでした。',
							   'parent_item_colon' => ''
						   ),
						   'show_in_rest' => true,
						   'public' => true, /* 管理画面にメニューを作る */
						   'show_ui' => true, /* 管理画面にメニューを作る */
						   'query_var' => true,
						   'hierarchical' => true, /* 固定ページみたいに記事間の親子関係をつくる */
						   'supports' => array('title','editor','thumbnail'), /* 管理画面で登録できる項目 */
						   'menu_position' => 9, /* 管理画面のメニューの位置（5,10,15・・・） */
						   'has_archive' => true, /* アーカイブページを持つ */
						   'rewrite' => array( /* slug:スラッグ名　with_front:アーカイブページURLに/archive/をつける */
							   'slug' => 'works','with_front' => false)
					   )
					  );
	register_taxonomy('works_cat','works', array(
		'hierarchical' => true,
		'labels' => array( /* 表示させる文字 */
			'name' => '実績カテゴリ',
			'singular_name' => '実績カテゴリ',
			'search_items' =>  '実績カテゴリを検索',
			'all_items' => 'すべてのサービスカテゴリ',
			'parent_item' => '親分類',
			'parent_item_colon' => '親分類：',
			'edit_item' => '編集',
			'update_item' => '更新',
			'add_new_item' => '実績カテゴリを追加',
			'new_item_name' => '名前',
		),
		'show_in_rest' => true,
		'show_ui' => true, /* 管理画面にメニューを作る */
		'rewrite' => array(
			'slug' => 'works','with_front' => true,'hierarchical' => true)
	));
	register_taxonomy('works_tag','works', array(
		'hierarchical' => true,
		'labels' => array( /* 表示させる文字 */
			'name' => '実績タグ',
			'singular_name' => '実績タグ',
			'search_items' =>  '実績タグを検索',
			'all_items' => 'すべてのサービスタグ',
			'parent_item' => '親分類',
			'parent_item_colon' => '親分類：',
			'edit_item' => '編集',
			'update_item' => '更新',
			'add_new_item' => '実績タグを追加',
			'new_item_name' => '名前',
		),
		'show_in_rest' => true,
		'show_ui' => true, /* 管理画面にメニューを作る */
		'rewrite' => array(
			'slug' => 'works','with_front' => true,'hierarchical' => false)
	));
register_post_type( 'commitment', /* カスタム投稿タイプスラッグ */
					   array(
						   'labels' => array( /* 表示させる文字 */
							   'name' => 'コミットメント',
							   'singular_name' => 'コミットメント投稿',
							   'all_items' => 'コミットメント投稿一覧',
							   'add_new' => 'コミットメント投稿追加',
							   'add_new_item' => 'コミットメント投稿の追加',
							   'edit_item' => 'コミットメント投稿の編集',
							   'new_item' => 'コミットメント投稿追加',
							   'view_item' => 'コミットメント投稿を表示',
							   'search_items' => 'コミットメント投稿を検索',
							   'not_found' =>  'コミットメント投稿が見つかりません',
							   'not_found_in_trash' => 'ゴミ箱内にコミットメント投稿が見つかりませんでした。',
							   'parent_item_colon' => ''
						   ),
						   'public' => true, /* 管理画面にメニューを作る */
						   'show_in_rest' => true,
						   'show_ui' => true, /* 管理画面にメニューを作る */
						   'query_var' => true,
						   'hierarchical' => true, /* 固定ページみたいに記事間の親子関係をつくる */
						   'supports' => array('title','editor','thumbnail'), /* 管理画面で登録できる項目 */
						   'menu_position' => 8, /* 管理画面のメニューの位置（5,10,15・・・） */
						   'has_archive' => true, /* アーカイブページを持つ */
						   'rewrite' => array( /* slug:スラッグ名　with_front:アーカイブページURLに/archive/をつける */
							   'slug' => 'commitment','with_front' => false)
					   )
					  );
	register_taxonomy('commitment_cat','commitment', array(
		'hierarchical' => true,
		'labels' => array( /* 表示させる文字 */
			'name' => 'コミットメントカテゴリ',
			'singular_name' => 'コミットメントカテゴリ',
			'search_items' =>  'コミットメントカテゴリを検索',
			'all_items' => 'すべてのコミットメントカテゴリ',
			'parent_item' => '親分類',
			'parent_item_colon' => '親分類：',
			'edit_item' => '編集',
			'update_item' => '更新',
			'add_new_item' => 'コミットメントカテゴリを追加',
			'new_item_name' => '名前',
		),
		'show_in_rest' => true,
		'show_ui' => true, /* 管理画面にメニューを作る */
		'rewrite' => array(
			'slug' => 'commitment','with_front' => true,'hierarchical' => true)
	));
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );
function add_google_fonts() {
	wp_enqueue_style( ' add_google_fonts ', 'https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap', false );
}
//サンクスページ用コード
add_action('wp_footer', 'redirect_to_thanks_page');
function redirect_to_thanks_page() {
  $homeUrl = home_url();
  echo <<< EOD
    <script>
      document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = '{$homeUrl}/thanks/';
      }, false );
    </script>
  EOD;
}
function init_scripts()
{
	wp_enqueue_script("jquery");
	wp_register_style('slick-css', get_stylesheet_directory_uri() .'/css/slick.css');
	wp_register_style('slick-theme-css', get_stylesheet_directory_uri() .'/css/slick-theme.css');
	wp_enqueue_script('slick-min-js', get_template_directory_uri().'/js/slick.min.js');	
	wp_enqueue_script('mousestalker-js', get_stylesheet_directory_uri().'/js/mousestalker.js');
	wp_enqueue_script('gsap-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.1/TweenMax.min.js', array(), false, true );
	wp_enqueue_style('slick-css');
	wp_enqueue_style('slick-theme-css');
	wp_enqueue_script('slick-min-js');
	wp_enqueue_script('mousestalker-js');
	wp_enqueue_script('gsap-min-js');
}
add_action('wp_enqueue_scripts', 'init_scripts');

//blog抜粋文字数の上限設定
function custom_excerpt_length( $length ) {
     return 58;	//表示したい文字数
}	
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );