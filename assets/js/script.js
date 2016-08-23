$(function() {
	$main = $('main')
	$side = $('aside')
	$('#masonry .books').masonry({
		itemSelector: '.tile',
		gutterWidth: '5px'
	})
	$('.category').click(function(e) {
		e.preventDefault()
		$(this).toggleClass('opened')
	})
	$('body').scroll(function(e) {
		var mainTop = $main.offset().top
		if(mainTop <= 0) {
			$side.addClass('fixed')
		} else {
			$side.removeClass('fixed')
		}
	})
})