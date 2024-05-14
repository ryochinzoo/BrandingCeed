jQuery (function($) {
	var cursor = jQuery("#cursor");
	var follower = jQuery("#follower");
	var delay = 10;
	var cWidth = 8;
	var fWidth = 40;
	var mouseX = 0;
	var mouseY = 0;
	var posX = 0;
	var posY = 0;
	var leftScrollPosition = 0;

	TweenMax.to({}, .001, {
		repeat: -1,
		onRepeat: function() {
			posX += (mouseX - posX) / delay;
			posY += (mouseY - posY) / delay;

			TweenMax.set(follower, {
				css: {
					left: posX - (fWidth / 2),
					top: posY - (fWidth / 2)
				}
			});

			TweenMax.set(cursor, {
				css: {    
					left: mouseX - (cWidth / 2),
					top: mouseY - (cWidth / 2)
				}
			});
		}
	});

	//マウス座標を取得
	jQuery(document).on("mousemove", function(e) {
		mouseX = e.pageX;
		mouseY = e.pageY;
	});
	jQuery(document).on("mouseenter", "a:not(.anchor), .read_more, .page_button, input[type='submit'], input[type='checkbox'], .wpcf7-form-control-wrap, .newsPrevArrow, .newsNextArrow, .button_two_lines, .bc_accordion_main_parts", function() {
		cursor.addClass("is-active");
		follower.addClass("is-active");
	});
	jQuery(document).on("mouseleave", "a:not(.anchor), .read_more, .page_button, input[type='submit'], input[type='checkbox'], .wpcf7-form-control-wrap, .newsPrevArrow, .newsNextArrow, .button_two_lines, .bc_accordion_main_parts", function() {
		cursor.not(".anchor").removeClass("is-active");
		follower.not(".anchor").removeClass("is-active");
	});
	jQuery(document).on("mouseenter", ".service_clickarea_left", function() {
		cursor.addClass("is-active");
		follower.addClass("is-active");
		follower.addClass("is-holizontal-scroll");
		follower.append("<div style='font-size: 5px; color: #fff;'>前へ</div>");
	});
	jQuery(document).on("mouseleave", ".service_clickarea_left", function() {
		cursor.not(".anchor").removeClass("is-active");
		follower.not(".anchor").removeClass("is-active");
		follower.not(".anchor").removeClass("is-holizontal-scroll");
		follower.children().remove();
	});
	jQuery(document).on("mouseenter", ".service_clickarea_right", function() {
		cursor.addClass("is-active");
		follower.addClass("is-active");
		follower.addClass("is-holizontal-scroll");
		follower.append("<div style='font-size: 5px; color: #fff;'>次へ</div>");
	});
	jQuery(document).on("mouseleave", ".service_clickarea_right", function() {
		cursor.not(".anchor").removeClass("is-active");
		follower.not(".anchor").removeClass("is-active");
		follower.not(".anchor").removeClass("is-holizontal-scroll");
		follower.children().remove();
	});
	jQuery(document).on("click", ".service_clickarea_left", function() {
		leftScrollPosition = jQuery(".service-slider-wrapper").scrollLeft() - 250;
		jQuery(".service-slider-wrapper").animate({scrollLeft: leftScrollPosition}, 400);
	});
	jQuery(document).on("click", ".service_clickarea_right", function() {
		leftScrollPosition = jQuery(".service-slider-wrapper").scrollLeft() + 250;
		var browserWidth = jQuery(window).width();
		jQuery(".service-slider-wrapper").animate({scrollLeft: leftScrollPosition}, 400);
	});
	
	jQuery.prototype.mousedragscrollable = function () {
		let target;
		$(this).each(function (i, e) {
			$(e).mousedown(function (event) {
				event.preventDefault();
				target = $(e);
				$(e).data({
					down: true,
					move: false,
					x: event.clientX,
					y: event.clientY,
					scrollleft: $(e).scrollLeft(),
					scrolltop: $(e).scrollTop(),
				});
				return false;
			});
			$(e).click(function (event) {
				if ($(e).data("move")) {
					return false;
				}
			});
		});
		$(document)
			.mousemove(function (event) {
			if ($(target).data("down")) {
				event.preventDefault();
				let move_x = $(target).data("x") - event.clientX;
				let move_y = $(target).data("y") - event.clientY;
				if (move_x !== 0 || move_y !== 0) {
					$(target).data("move", true);
				} else {
					return;
				}
				$(target).scrollLeft($(target).data("scrollleft") + move_x);
				//$(target).scrollTop($(target).data("scrolltop") + move_y);
				return false;
			}
		})
			.mouseup(function (event) {
			$(target).data("down", false);
			return false;
		});
	};
	$(".service-slider-wrapper").mousedragscrollable();
});
