
$(function(){
	var time = 5;

	var $body = $('.art-Sheet-body');

	$('a.ajax').click(function(){
		var $el = $(this);
		var href = $el.attr('href');
		
		var $annotation = $('<div class="annotation" />').text('Ładuję');
		
		$annotation.css({
			top: $el.offset().top + 10,
			left: 750,
		})
		.click(function() {
			$annotation.stop().remove();
		});
		$body.prepend($annotation);
		
		$.ajax({
			url: href,
			cache: false,
			success: function(data, textStatus, XMLHttpRequest) {
				if(!$annotation.filter(':visible').length)
				{
					$body.prepend($annotation);
				}
				
				$annotation.text('Dodano').animate({
					opacity: 0
				}, time*1000, function(){
					$annotation.remove();
				});
			}
		});
		
		return false;
	});
});