jQuery.fn.autohide = function(time) {
	var $el = $(this);
	time = time || 3000;
	animation = 250;

	var timeoutID = window.setTimeout(function() {
										$el.trigger('click');
									}, time);

	$el.click(function() {
		window.clearTimeout(timeoutID);
		$el.animate({
			opacity: 0,
		}, animation, function () {
			$el.hide(animation);
		});
	});
};