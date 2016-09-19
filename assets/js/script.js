var resizeCategories = function(e) {
	$categories = $('#categories .category')
	$categories.each(function(i, category) {
		var $category = $(category)
		var catWidth = $category.innerWidth()
		var patWidth = 30
		var newCatWidth = Math.ceil(catWidth/patWidth)*patWidth
		$category.css({
			width: newCatWidth
		})
	})
}

var resizeHeights = function(e) {
	$elems = $('.matchHeight')
	$elems.each(function(i, elem) {
		var $elem = $(elem)
		var elemHeight = $elem.innerHeight()
		var patHeight = 15
		var newElemHeight = Math.ceil(elemHeight/patHeight)*patHeight
		$elem.css({
			height: newElemHeight
		})
	})
}

$(function() {
	$main = $('main')
	$side = $('aside')

	$(document).scroll(function(e) {
		var mainTop = $main.offset().top
		if(mainTop <= 0) {
			$side.addClass('fixed')
		} else {
			$side.removeClass('fixed')
		}
	})

	$(window).resize(function(e) {
		resizeCategories()
		resizeHeights()
	}).resize()

	$('.filter select').change(function(e) {
		var val = this.value
		var type = this.id
		var attr = this.dataset.attr
		$('.book').each(function() {
			var bookVal = this.dataset[attr]
			if(val == 'null') {
				$(this).removeClass('hide')
			} else if(type == 'decade') {
				if(!(bookVal > val && bookVal < val+10)) {
					$(this).addClass('hide')
				}
			} else if(type == 'category') {
				bookVal = bookVal.split(',')
				if($.inArray(val, bookVal) < 0) {
					$(this).addClass('hide')
				} else {
					$(this).removeClass('hide')
				}
			} 
		})
	})
})
