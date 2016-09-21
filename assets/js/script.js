var resizeBricks = function(e) {
	$bricks = $('.brick')
	$bricks.each(function(i, brick) {
		var $brick = $(brick)
		var brickWidth = $brick.innerWidth()
		var patWidth = 30
		var newRectWidth = Math.ceil(brickWidth/patWidth)*patWidth
		$brick.css({
			width: newRectWidth
		})
	})
}

var resizeHeights = function(e) {
	$elems = $('.matchHeight')
	$elems.each(function(i, elem) {
		var $elem = $(elem)
		var elemHeight = $elem.innerHeight()
		var patHeight = 15
		var newElemHeight = Math.round(elemHeight/patHeight)*patHeight
		console.log(newElemHeight)
		$elem.css({
			height: newElemHeight
		})
	})
}

$(function() {
	$body = $('body')
	$main = $('main')
	$shelf = $('#shelf')
	$filterLists = $('#filterLists')

	$main.scroll(function(e) {
		$('.folder').each(function() {			
			$folder = $(this)
			scrollTop = $folder.scrollTop()
			$tabs = $folder.find('.tabs')
			var folderTop = $folder.offset().top
			var folderBottom = folderTop + $folder.innerHeight()
			if(folderBottom - $tabs.innerHeight() <= 0) {
				$tabs.removeClass('fixed').addClass('bottom')
			} else if(folderTop <= 0) {
				$tabs.removeClass('bottom').addClass('fixed')
			} else if(!$main.is('.noScroll')) {
				$tabs.removeClass('bottom').removeClass('fixed')
			}
		})
	})

	$(window).resize(function(e) {
		resizeBricks()
		resizeHeights()
	}).resize()

	$('.tab').click(function(e) {
		$tab = $(this)
		$tabs = $tab.parents('.tabs')
		type = this.dataset.type
		$page = $('.page.'+type)
		$pages = $page.parents('.pages')
		if($pages.is('#filterLists')) {
			var pagesTop = $page.parents('.pages').offset().top
			$main.scrollTop(pagesTop)
			$page.scrollTop(0)
		}
		if($tab.is('.selected')) {
			$main.removeClass('noScroll')
			$tabs.removeClass('top')
			$tab.removeClass('selected')
			$pages.removeClass('show')
			$page.removeClass('show')
			$body.scroll()
		} else if($('.tab.selected').length) {
			$('.tab.selected').removeClass('selected')
			$tab.addClass('selected')
			$('.page.show').removeClass('show')
			$page.addClass('show')
			resizeBricks()
		} else {
			if($pages.is('#filterLists')) {
				$main.addClass('noScroll')
				$tabs.addClass('fixed').addClass('top')
			}
			$tab.addClass('selected')
			$pages.addClass('show')
			$page.addClass('show')
			resizeBricks()
		}
	});

	$('.filterList a').click(function(e) {
		e.preventDefault()
		var val = $(this).data('slug')
		var type = $(this).parents('.filterList').data('type')
		$filterRect = $(this).parents('.brick')
		$filterList = $(this).parents('.filterList')
		if($filterRect.is('.selected')) {
			$filterRect.removeClass('selected')
			val = 'null';
		} else {
			$('.filterList .brick.selected').removeClass('selected')
			$filterRect.addClass('selected')
		}
		$('.book').each(function() {
			var bookVal = this.dataset[type]
			$(this).removeClass('hide')
			if(val == 'null') {
				$(this).removeClass('hide')
			} else if(type == 'year') {
				if(!(bookVal > val && bookVal < val+10)) {
					$(this).addClass('hide')
				}
			} else if(type == 'category') {
				if(bookVal) {
					bookVal = bookVal.split(',')
					if($.inArray(val, bookVal) < 0) {
						$(this).addClass('hide')
					} else {
						$(this).removeClass('hide')
					}
				} else {
					$(this).addClass('hide')
				}
			} 
		})
		$('.tab.selected').removeClass('selected')
		var shelfTop = $shelf[0].offsetTop
		$tabs.removeClass('top')
		$filterLists.removeClass('show')
		$filterList.removeClass('show')
		$filterList.scrollTop(0)
		$main.removeClass('noScroll')
		$main.scrollTop(shelfTop)
		$body.scroll()
	})
})
