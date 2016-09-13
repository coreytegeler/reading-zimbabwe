// $(function() {
// 	$main = $('main')
// 	$side = $('aside')
// 	$('#masonry .books').masonry({
// 		itemSelector: '.tile',
// 		gutterWidth: '5px'
// 	})
// 	$(document).on('click', '.category a', openPagePopUp)
// 	$(document).scroll(function(e) {
// 		var mainTop = $main.offset().top
// 		if(mainTop <= 0) {
// 			$side.addClass('fixed')
// 		} else {
// 			$side.removeClass('fixed')
// 		}
// 	})
// })
// var openPagePopUp = function(e) {
// 	e.preventDefault()
// 	closePagePopUp()
// 	$category = $(e.target).parents('.category')
// 	$category.addClass('selected')
// 	$category.find('.pageWrap').addClass('opened')
// 	$(document).on('click', closePagePopUp(e))
// }
// var closePagePopUp = function(e) {
// 	if(!$(e.target).is('.page') && !$(e.target).parents('.page').length) {
// 		$('.pageWrap').removeClass('opened')
// 		$('.category.selected').removeClass('selected')
// 		$(document).off('click', closePagePopUp)
// 	}
// }