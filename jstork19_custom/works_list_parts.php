<div class="works_parts_wrapper">
<?php if($args['filter'] === true): ?>
<div class="works_filter_parts">
	<div class="filter_wrapper">
		<div class="filter_label">
			絞り込み
		</div>
		<div id="works_all" class="work_category filter_button" data-slug="all">
			ALL
		</div>
		<div id="enterprise_brandings" class="work_category filter_button" data-slug="enterprise_brandings">
			企業ブランディング
		</div>
		<div id="experience_designs" class="work_category filter_button" data-slug="experience_designs">
			体験設計ブランディング
		</div>
		<div id="recruitment_branding" class="work_category filter_button" data-slug="recruitment_branding">
			採用ブランディング
		</div>
		<div id="other_works" class="work_category filter_button" data-slug="other_works">
			その他
		</div>
	</div>
</div>
<?php endif; ?>
<div class="works_list_wrapper">
	<div id="overlay">
		<div class="cv-spinner">
			<span class="spinner"></span>
		</div>
	</div>
	<div id="works_ajax" class="works_ajax" data-show="<?php echo $args['num']; ?>" data-default_category="<?php echo $args['defaultCategory']; ?>" data-filter="<?php echo $args['filter']; ?>">
		<?php wp_reset_postdata(); //クエリのリセット ?>
	</div>
</div>
</div>
<script>

jQuery(function($) {
	const show = jQuery("#works_ajax").data("show");
	const defaultCategory = jQuery("#works_ajax").data("default_category");
	const filter_bool = jQuery("#works_ajax").data("filter");
	const contents = jQuery("#works_ajax");
	const more_button = '<div class="more_button_wrapper"><div class="more_button">MORE</div><div class="plus_icon_wrapper"><div class="arrow_icon"></div><div class="plus_icon"></div></div></div>';
	jQuery(document).ajaxSend(function() {
		jQuery("#overlay").fadeIn(300);　
	});
	jQuery("#works_all").addClass('active');
	jQuery("#enterprise_brandings").removeClass('active');
	jQuery("#experience_designs").removeClass('active');
	jQuery("#recruitment_branding").removeClass('active');
	jQuery("#other_works").removeClass('active');
	$.ajax({
		type: 'post',
		url: ajaxUrl,//ajaxpagination.ajaxurl // functions.phpで指定した admin-ajax.php のURLが格納された変数
		cache: false,
		dataType: 'html',
		data: {
			'action': 'select_category_ajax_php', // 登録したアクション名
			'cat': defaultCategory,
			'paged': 1,
		},
		success: function(data) {
			$('.works_ajax').html(data);
			const contentsLength = contents.children().length;
			const target = '.works_ajax .work_list_element_wrapper';
			jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
			if (filter_bool && contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
				$('.works_parts_wrapper').append(more_button);
			} else if (!filter_bool) {
				const link_button = "<a href='/works/' style='text-decoration: none;'>" + more_button + "</a>";
				$('.works_parts_wrapper').append(link_button);
			}
			$('.more_button_wrapper').on("click", function() {
				if(filter_bool) {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				}
			});
		}
	}).done(function() {
      setTimeout(function(){
        $("#overlay").fadeOut(300);
      },500);
    });
	jQuery("#enterprise_brandings").on("click", function(){
		jQuery("#works_all").removeClass('active');
		jQuery("#experience_designs").removeClass('active');
		jQuery("#recruitment_branding").removeClass('active');
		jQuery("#other_works").removeClass('active');
		
		$(this).addClass('active');
		let cat = $(this).data('slug');
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': 1,
			},
			success: function(data) {
				$('.works_ajax').html(data);
				const contentsLength = contents.children().length;
				const target = '.works_ajax .work_list_element_wrapper';
				jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
				if (contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
					$('.works_page_wrapper').append(more_button);
				}
				$('.more_button_wrapper').on("click", function() {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				});
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(300);
      },500);
    });
	});
	jQuery("#experience_designs").on("click", function(){
		jQuery("#works_all").removeClass('active');
		jQuery("#enterprise_brandings").removeClass('active');
		jQuery("#recruitment_branding").removeClass('active');
		jQuery("#other_works").removeClass('active');
		$(this).addClass('active');
		let cat = $(this).data('slug');
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': 1,
			},
			success: function(data) {
				$('.works_ajax').html(data);
				const contentsLength = contents.children().length;
				const target = '.works_ajax .work_list_element_wrapper';
				jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
				if (contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
					$('.works_page_wrapper').append(more_button);
				}
				$('.more_button_wrapper').on("click", function() {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				});
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
		});
	});
	jQuery("#recruitment_branding").on("click", function(){
		jQuery("#works_all").removeClass('active');
		jQuery("#enterprise_brandings").removeClass('active');
		jQuery("#experience_designs").removeClass('active');
		jQuery("#other_works").removeClass('active');
		$(this).addClass('active');
		let cat = $(this).data('slug');
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': 1,
			},
			success: function(data) {
				$('.works_ajax').html(data);
				const contentsLength = contents.children().length;
				const target = '.works_ajax .work_list_element_wrapper';
				jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
				if (contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
					$('.works_page_wrapper').append(more_button);
				}
				$('.more_button_wrapper').on("click", function() {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				});
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
		});
	});
	jQuery("#other_works").on("click", function(){
		jQuery("#works_all").removeClass('active');
		jQuery("#enterprise_brandings").removeClass('active');
		jQuery("#experience_designs").removeClass('active');
		jQuery("#recruitment_branding").removeClass('active');
		$(this).addClass('active');
		let cat = $(this).data('slug');
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': 1,
			},
			success: function(data) {
				$('.works_ajax').html(data);
				const contentsLength = contents.children().length;
				const target = '.works_ajax .work_list_element_wrapper';
				jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
				if (contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
					$('.works_page_wrapper').append(more_button);
				}
				$('.more_button_wrapper').on("click", function() {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				});
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
		});
	});
	jQuery("#works_all").on("click", function(){
		jQuery("#enterprise_brandings").removeClass('active');
		jQuery("#experience_designs").removeClass('active');
		jQuery("#recruitment_branding").removeClass('active');
		jQuery("#other_works").removeClass('active');
		$(this).addClass('active');
		let cat = $(this).data('slug');
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': 1,
			},
			success: function(data) {
				$('.works_ajax').html(data);
				const contentsLength = contents.children().length;
				const target = '.works_ajax .work_list_element_wrapper';
				jQuery(target + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
				if (contentsLength > show && $('.works_page_wrapper').find('.more_button').length === 0) {
					$('.works_page_wrapper').append(more_button);
				}
				$('.more_button_wrapper').on("click", function() {
					jQuery(target + ':nth-child(n + ' + (show + 1) + ')').removeClass('is-hidden');
					$('.more_button_wrapper').remove();
				});
			}
		}).done(function() {
			setTimeout(function(){
        $("#overlay").fadeOut(300);
      },500);
    });
	});
	function find_page_number( element, current ) {
		if (element.find('span').data('is-number')) {
			element.find('span').remove();
			return parseInt( element.html() );
		} else {
			if (element.find('span').data('direction') === 'first') {
				return 1;
			} else if (element.find('span').data('direction') === 'next') {
				return current + 1;
			} else if (element.find('span').data('direction') === 'prev') {
				return current - 1;
			} else if (element.find('span').data('direction') === 'last') {
				return parseInt(element.find('span').data('max-num'));
			}
		}
	}
	function find_current_number( element ) {
		element.find('span').remove();
		return parseInt( element.html() );
	}
	jQuery(document).on('click', '.page-numbers', function(event) {
		event.preventDefault();
		$('html,body').animate({
			scrollTop: jQuery('#interviews_reload').offset().top
		});
		let cat = $(this).children(".page_value").data('cat');
		let current = find_current_number( $(this).parent().find(".current").clone() );
		let page = find_page_number( $(this).clone(), current );
		$.ajax({
			type: 'post',
			url: ajaxUrl, // functions.phpで指定した admin-ajax.php のURLが格納された変数
			cache: false,
			dataType: 'html',
			data: {
				'action': 'select_category_ajax_php', // 登録したアクション名
				'cat': cat, // functions.phpでPOST値として渡す
				'page': page,
			},
			success: function(data) {
				$('.works_ajax').html(data);
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
    });
	});
})
</script>