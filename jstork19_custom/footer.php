<?php
	stk_hook_footer_before();
?>
<?php if(!is_page(array('thanks', 'contact', 'ondo-branding', 'zero-branding'))): ?>
<div class="contact-grad">
	<div class="top-contact-wrapper">
		<div class="headline_animate_wrapper">
			<h2 class="contents_headline">
				CONTACT
			</h2>
		</div>
		<div class="contact-text">
			プロジェクトに関するご相談やお見積依頼はこちらからご連絡ください。<br />
社内で検討されたい方のために事業紹介をまとめた資料をお送りすることも可能です。
		</div>
		<div class="contact_button_wrapper">
			<a  class="bc_contact_button" href="/branding-ceed/contact/">
				お問い合わせ
			</a>
		</div>
	</div>
</div>
<?php endif; ?>
<footer id="footer" class="footer">
	<div class="footer_buttons_wrapper">
		<!--<div class="button_two_lines">
			<div class="button_head">
				今だけ！法人設立感謝
			</div>
			<div class="bc_button">
				キャンペーン
			</div>
		</div>
		
		<div class="button_two_lines">
			<div class="button_head">
				＼ ブランディングチェックシート ／
			</div>
			<div class="bc_button">
				無料プレゼント中
			</div>
		</div>
-->
	</div>
	<div id="inner-footer" class="inner wrap cf">
		<?php stk_footerwidget(); ?>
		<div class="footer_sns">
			<div class="footer_sns_button">
				<a href="">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-facebook.png" />
				</a>
			</div>
			<div class="footer_sns_button">
				<a href="">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-instagram.png" />
				</a>
			</div>
		</div>
		<div id="footer-bottom">
			<?php
				stk_footerlinks();
				stk_snslinks('footer');
				//stk_footercopyright();
			?>
			© 2023 Branding C° inc.
		</div>
	</div>
</footer>
</div>
<div class="cookie-consent">
  <div class="cookie-text">当サイトでは快適なご利用をいただけるようCookieを使用しています。Cookieの使用に関する詳細は「<a href="https://branding-ceed.com/privacy-policy/">プライバシーポリシー</a>」をご覧ください。</div>
  <div class="cookie-agree">OK</div>
</div>
<script>
(function() {
	const expire = 365; // 有効期限（日）
	let cc = document.querySelector('.cookie-consent');
	let ca = document.querySelector('.cookie-agree');
	const flag = localStorage.getItem('popupFlag');
	if (flag != null) {
		const data = JSON.parse(flag);
		if (data['value'] == 'true') {
			popup();
		} else {
			const current = new Date();
			if (current.getTime() > data['expire']) {
				setWithExpiry('popupFlag', 'true', expire);
				popup();
			}      
		}
	} else {
		setWithExpiry('popupFlag', 'true', expire);
		popup();
	}
	ca.addEventListener('click', () => {
		cc.classList.add('cc-hide1');
		setWithExpiry('popupFlag', 'false', expire);
	});

	function setWithExpiry(key, value, expire) {
		const current = new Date();
		expire = current.getTime() + expire * 24 * 3600 * 1000;
		const item = {
			value: value,
			expire: expire
		};
		localStorage.setItem(key, JSON.stringify(item));
	}
  
	function popup() {
		cc.classList.add('is-show');
	}
}());
	/*
	
	*/
	function slideAnime(){
		//====左に動くアニメーションここから===
		jQuery('.headline_animate_wrapper').each(function(){ 
			var elemPos = jQuery(this).offset().top-50;
			var scroll = jQuery(window).scrollTop();
			var windowHeight = jQuery(window).height();
			if (scroll >= elemPos - windowHeight){
				//左から右へ表示するクラスを付与
				//テキスト要素を挟む親要素（左側）とテキスト要素を元位置でアニメーションをおこなう
				jQuery(this).addClass("slideToRight"); //要素を左枠外にへ移動しCSSアニメーションで左から元の位置に移動
				jQuery(this).children(".contents_headline").addClass("slideToLeft");  //子要素は親要素のアニメーションに影響されないように逆の指定をし元の位置をキープするアニメーションをおこなう
			}
		});
	}
	function slideAnimeKv(){
		//====左に動くアニメーションここから===
		jQuery('.kv_animate_wrapper').each(function(){ 
			var elemPos = jQuery(this).offset().top-50;
			var scroll = jQuery(window).scrollTop();
			var windowHeight = jQuery(window).height();
			if (scroll >= elemPos - windowHeight){
				//左から右へ表示するクラスを付与
				//テキスト要素を挟む親要素（左側）とテキスト要素を元位置でアニメーションをおこなう
				jQuery(this).addClass("slideToRightKv"); //要素を左枠外にへ移動しCSSアニメーションで左から元の位置に移動
				jQuery(this).children(".delay_two").addClass("slideToLeftKv");  //子要素は親要素のアニメーションに影響されないように逆の指定をし元の位置をキープするアニメーションをおこなう
			}
		});
	}
	function slideAnimeContact(){
		//====左に動くアニメーションここから===
		jQuery('.onload_animate_wrapper').each(function(){ 
			var elemPos = jQuery(this).offset().top-50;
			var scroll = jQuery(window).scrollTop();
			var windowHeight = jQuery(window).height();
			if (scroll >= elemPos - windowHeight){
				//左から右へ表示するクラスを付与
				//テキスト要素を挟む親要素（左側）とテキスト要素を元位置でアニメーションをおこなう
				jQuery(this).addClass("slideToRight"); //要素を左枠外にへ移動しCSSアニメーションで左から元の位置に移動
				jQuery(this).children(".onload_headline").addClass("slideToLeft");  //子要素は親要素のアニメーションに影響されないように逆の指定をし元の位置をキープするアニメーションをおこなう
			}
		});
	}
	jQuery(function($) {
		slideAnimeContact();
		slideAnimeKv();
		jQuery('.news_slider').slick({
			slidesToShow: 1,
			dots: false,
			prevArrow: '.newsPrevArrow',
			nextArrow: '.newsNextArrow',
		});
		jQuery('#custom_header_img').addClass(' first_view fadeUp delay_one');
		jQuery('.message_slider').slick({
			slidesToShow: 1,
			dots: false,
			prevArrow: '.messagePrevArrow',
			nextArrow: '.messageNextArrow',
		});
		jQuery(window).on('scroll', function(){
			var scrollTop = jQuery(window).scrollTop();
			var bgPosition = scrollTop / 8; //スクロール後のポジションを指定（値を大きくすると移動距離が小さくなる）

			if(bgPosition){
				jQuery('.blog-wrapper').css('background-position', 'center top -'+ bgPosition + 'px');
			}
		});
		jQuery('.bc_accordion_main_parts').on('click', function(){
			jQuery(this).next('div').slideToggle();
			jQuery(this).find('.icon').toggleClass('open_ac');
		});
		// 画面をスクロールをしたら動かしたい場合の記述
		jQuery(window).scroll(function (){
			slideAnime();/* アニメーション用の関数を呼ぶ*/
		});// ここまで画面をスクロールをしたら動かしたい場合の記述
	});
</script>
<?php wp_footer(); ?>
</body>
</html>