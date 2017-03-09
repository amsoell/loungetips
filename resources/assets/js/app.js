
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
	$('img.hover').hover(function() {
		console.log('test');
		rel = $(this).attr('rel');
		src = $(this).attr('src');
		$(this).attr('src', rel).attr('rel', src);
	}, function() {
		rel = $(this).attr('rel');
		src = $(this).attr('src');
		$(this).attr('src', rel).attr('rel', src);
	});

	$('img.thumbs').click(function() {
		$isGood = ($(this).attr('class').indexOf('down')==-1);
		$thumb = $(this);
		$.ajax({
			url: '/ajax/report.php',
			dataType: 'json',
			data: 'tip='+$(this).parents('.tip').attr('rel')+'&value='+($isGood?1:0),
			success: function(o) {
				if (o.success) {
					$value = parseInt($thumb.parents('.tip').find('.detail .totalscore').attr('rel'));
					$value += ($isGood?1:-1);
					$thumb.parents('.tip').find('.detail .totalscore').attr('rel', $value).html(($value>=0?'+':'-')+$value);
				} else {
					$thumb.parents('.tip').find('.detail').addClass('error').html(o.errmsg);
				}
				$thumb.parents('.tip').find('.thumbs').fadeOut();
			}

		});
	});
});
