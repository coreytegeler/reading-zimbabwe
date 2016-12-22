$(function() {
	$body = $('body')
	$main = $('main')
	$aside = $('aside')
	$shelf = $('#shelf')
	$filterLists = $('#filterLists')
	$filterTabsInner = $('#filterTabsInner')
	$subscribe = $('#subscribe')
	$search = $('.search form input[type="search"]').eq(0)
	patWidth = 30

	var loadCovers = function() {
		if(!$shelf.length) {return}
		$shelf.find('.book').each(function(i, book) {
			var $book = $(book)
			if($book.is('.hasCover')) {
				var $image = $book.find('img')
				var src = $image.data('source')
				var image = new Image()
				image.src = src
				$image.attr('src', src)
				imagesLoaded( $image, function( ) {
				  $book.addClass('loaded')
				  resizeBookPattern($book)
				})
			}
		})
	$shelf.addClass('show')
	}

	var toggle = function(e) {
		e.stopPropagation()
		e.preventDefault()
		if(isMobile()) {
			$(this).parents('.toggleWrap').toggleClass('toggled')
		}
	}

	var fitToPattern = function(e) {
		$bricks = $('.brick')
		$bricks.each(function(i, brick) {
			var $brick = $(brick)
			$brick.attr('style','')
			var textWidth = $brick.find('.title').innerWidth()
			var bricksWidth = $brick.parents('.bricks').width()
			if(!isMobile()) {
				textWidth = $brick.find('.title').innerWidth()
				var newBrickWidth = Math.ceil(textWidth/patWidth)*patWidth
			}
			$brick.css({
				width: newBrickWidth,
				maxWidth: bricksWidth
			})
		})


		if($subscribe.is('.open')) {
			var winWidth = $(window).innerWidth()
			var $form = $subscribe.find('form')
			var formWidth = $form.innerWidth()
			var formHeight = $form.innerHeight()
			var percentLeft = winWidth/10
			var newMarginLeft = Math.ceil(percentLeft/patWidth)*patWidth
			var newWidth = Math.ceil(winWidth/patWidth)*patWidth - newMarginLeft*2
			var maxWidth = patWidth*25
			if(newWidth > maxWidth) {
				newWidth = maxWidth
				newMarginLeft = (winWidth - newWidth)/2
				newMarginLeft = Math.ceil(newMarginLeft/patWidth)*patWidth
			}
			$form.css({
				width: newWidth,
				marginLeft: newMarginLeft
			})
			var winHeight = $(window).innerHeight()
			var $inner = $subscribe.find('.inner')
			var innerHeight = $inner.innerHeight()
			var percentTop = winHeight/10

			var percentTop = Math.floor(winHeight - formHeight)/2
			var newMarginTop = Math.ceil(percentTop/patWidth)*patWidth
			var newHeight = Math.ceil(winHeight/patWidth)*patWidth - newMarginTop*2
			if(newMarginTop < patWidth) newMarginTop = patWidth
			$inner.css({
				marginTop: newMarginTop,
				height: newHeight,
				maxHeight: formHeight
			})
		}
		
	}

	var resizeBooksPattern = function(e) {
		$books = $('#shelf .book')
		$books.each(function(i, book) {
			resizeBookPattern(book)
		})
	}

	var resizeBookPattern = function(book) {
		var $book = $(book)
		var bookHeight = $book.innerHeight()
		var patternHeight = 15
		var newBookHeight = Math.ceil(bookHeight/patternHeight)*patternHeight
		if(newBookHeight > bookHeight) {
			newBookHeight = newBookHeight - patternHeight
		}
		$book.find('.patterns').css({
			height: newBookHeight
		})
	}

	var clickSearch = function() {
		var scrollTop = $main.scrollTop()
		var bottom = $main[0].scrollHeight
		if($(this).is('.search')) {
			$aside.removeClass('toggled')
			var searchTop = $('footer .search').position().top
			if(isMobile()) {
				searchTop -= $('aside').innerHeight()
			}
			if($body.is('.search')) {
				bottom = 0
			}
			$main.animate({ scrollTop: scrollTop + searchTop }, 300)
			$search.addClass('hover')
			$search.focus()
		}
	}

	$search.on('blur', function() {
		$search.removeClass('hover')
	})

	var clickFilterTab = function(e) {
		e.stopPropagation()
		e.preventDefault()
		var $tab = $(this)
		var $filterTabs = $tab.parents('#filterTabs')
		var slug = this.dataset.slug
		$filterList = $('.filterList.'+slug)
		var $filterTabs = $('#filterTabs')
		var filterListsHeight = $(window).innerHeight() - $filterTabsInner.innerHeight()
		if(isMobile()) {
			filterListsHeight -= $aside.innerHeight()
		}
		if($tab.is('.selected')) {
			// $main.removeClass('noScroll')
			$tab.removeClass('selected')
			$filterLists.removeClass('show')
			$filterList.removeClass('show')
			$body.scroll()
		} else if($('.tab.selected').length) {
			$('.tab.selected').removeClass('selected')
			$('.filterList.show').removeClass('show')
			// $main.addClass('noScroll')
			$filterList.addClass('show')
			$filterLists.addClass('show')
			$filterLists.css({maxHeight:filterListsHeight})
			$tab.addClass('selected')
			fitToPattern()
		} else {
			$tab.addClass('selected')
			// $main.addClass('noScroll')
			$filterLists.addClass('show')
			$filterList.addClass('show')
			$filterLists.css({maxHeight:filterListsHeight})
			fitToPattern()
		}
	}

	var clickViewTab = function(e) {
		e.stopPropagation()
		e.preventDefault()
		var views = ['covers', 'list']
		var $tabs = $('#filterTabs')
		var curView = $shelf.attr('data-view')
		var curIndex = views.indexOf(curView)
		if(curIndex < views.length - 1) {
			var nextIndex = curIndex+1
		} else {
			var nextIndex = 0
		}
		var nextView = views[nextIndex]
		$shelf.attr('class', nextView+' show').attr('data-view', nextView)
	}

	var fixFilter = function(e) {
		var $filterTabs = $('#filterTabs')
		if(!$filterTabs.length) {return}
		var scrollTop = $main.scrollTop()
		if(scrollTop > 0) {
			$filterTabs.addClass('fixed')
		}
		var $groups = $('#shelf .group')
		var scrollPast = []
		$groups.each(function (i, group) {
			var scrollTop = $main.scrollTop()
			var groupTop = $(group).offset().top - $('#filterTabs').innerHeight() - 30
			var slug = group.dataset.slug
			if(groupTop <= 0)
				scrollPast.push(slug)
			if(!$main.is('.autoscroll') && scrollPast.length && i+1 == $groups.length) {
				var active = scrollPast.slice(-1)[0]
				$('.filterList .filter.selected').removeClass('selected')
				$('.filterList .filter[data-slug="'+active+'"]').addClass('selected')
			}
		})
		if($shelf.offset().top + $shelf.innerHeight() < $filterTabs.innerHeight()) {
			$('#filter').addClass('bottom')
		} else {
			$('#filter').removeClass('bottom')
		}
	}

	var loadMore = function(e) {
		if(!$body.is('.books')) {return}
		var scrollTop = $main.scrollTop()
		var shelfBottom = $shelf.offset().top + $shelf.innerHeight() - $(window).innerHeight()*3
		if(shelfBottom <= 0) {
			// $.ajax(function() {
			// 	url
			// })
		}
	}

	var openSubscribe = function(e) {
		e.stopPropagation()
		e.preventDefault()
		$subscribe.addClass('open')
		fitToPattern()
	}

	var closeSubscribe = function(e) {
		e.stopPropagation()
		e.preventDefault()
		$subscribe.removeClass('open')
	}

	var mapSetup = function() {
		if($('#map').length) {
			var map = L.map('map', {
			    center: [0, 0],
			    zoom: 2
			});
			L.tileLayer('https://api.mapbox.com/styles/v1/coreytegeler/ciwr3cdbs008f2qo7tsea52h0/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY29yZXl0ZWdlbGVyIiwiYSI6ImNpd25xNjU0czAyeG0yb3A3cjdkc2NleHAifQ.EJAjj38qZXzIylzax3EMWg', {
			    // attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
			    maxZoom: 18,
			}).addTo(map)
			setInterval(function() {
				panMap(map)
			}, 1000)
			panMap(map)
		}
		// if(citiesArray) {
		// 	for(var i = 0; i < citiesArray.length; i++) {
		// 		city = citiesArray[i]
		// 		console.log(city)
		// 	}
		// }
	}

	var panMap = function(map) {
		map.panTo([0, 55000], {
			animate: true,
			duration: 1000,
			easeLinearity: 1
		})	
	}

	var sizeCheck = function() {
		return $body.css('content').replace(/['"]+/g, '')
	}

	var isMobile = function() {
		if(sizeCheck() == 'small' || sizeCheck() == 'xSmall') {
			return true
		} else {
			return false
		}
	}

	if( $('#shelf.covers') && isMobile() ) {
		// var paddingTop = $filterTabsInner.innerHeight() + $aside.innerHeight();
		$shelf
			.attr('class', 'list show')
			.attr('data-view', 'list')
			// .css({
			// 	paddingTop: paddingTop
			// })
	}

	fitToPattern()
	resizeBooksPattern()
	loadCovers()
	mapSetup()

	$body.on('click touchend', '.button.search', clickSearch)
	$body.on('click touchend', '.tab.view', clickViewTab)
	$body.on('click touchend', '.tab:not(.view)', clickFilterTab)
	$body.on('click touchend', 'footer .row.subscribe a', openSubscribe)
	$body.on('click touchend', '#subscribe input.cancel', closeSubscribe)
	$body.on('click touchend', '.toggleWrap .toggle', toggle)

	$main.scroll(function(e) {
		fixFilter(e)
		loadMore(e)
	})

	$(window).resize(function(e) {
		fitToPattern()
		resizeBooksPattern()
		$main.scroll()
	}).resize()

})