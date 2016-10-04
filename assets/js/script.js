$(function() {
	$body = $('body')
	$main = $('main')
	$shelf = $('#shelf')
	$filterLists = $('#filterLists')

	var resizeBricks = function(e) {
		$bricks = $('.brick')
		$bricks.each(function(i, brick) {
			var $brick = $(brick)
			var textWidth = $brick.find('.title').innerWidth()
			var patWidth = 30
			var newBrickWidth = Math.ceil(textWidth/patWidth)*patWidth
			bricksWidth = $brick.parents('.bricks').width()
			$brick.css({
				width: newBrickWidth,
				maxWidth: bricksWidth
			})
		})
	}
	resizeBricks()
	var clickButton = function() {
		var scrollTop = $main.scrollTop()
		var bottom = $main[0].scrollHeight
		if($(this).is('.search')) {
			$search = $('.search form').eq(0)
			if($body.is('.search')) {
				bottom = 0
			}
			$main.animate({ scrollTop: bottom }, 300)
			$search.find('input[type="search"]').focus()
		} else if($(this).is('.down')) {
			var catTop = $('#categories').position().top
			if($('.fixed').length) {
				catTop -= $('.fixed').innerHeight()
			}
			$main.animate({ scrollTop: scrollTop + catTop }, 300)
		}
	}

	var clickFilterTab = function(e) {
		var $tab = $(this)
		var $tabs = $tab.parents('.tabs:not(.dummy)')
		var $dummy = $tab.parents('.tabs.dummy')
		var slug = this.dataset.slug
		$filterList = $('.page.'+slug)
		$filterLists = $filterList.parents('#filterLists')
		if($tab.is('.selected')) {
			$main.removeClass('noScroll')
			$tab.removeClass('selected')
			$filterLists.removeClass('show')
			$filterList.removeClass('show')
			$body.scroll()
		} else if($('.filter.tab.selected').length) {
			$('.filter.tab.selected').removeClass('selected')
			$('.filterList.show').removeClass('show')
			$tab.addClass('selected')
			$filterList.addClass('show')
			if($tabs.innerHeight() >= $(window).innerHeight()) { $main.addClass('noScroll') }
			resizeBricks()
		} else {
			$tab.addClass('selected')
			$filterLists.addClass('show')
			$filterList.addClass('show')
			if($tabs.innerHeight() >= $(window).innerHeight()) { $main.addClass('noScroll') }
			resizeBricks()
		}
	}

	var clickViewTab = function(e) {
		var views = ['grid', 'list']
		var $tabs = $('#filterButtons')
		var curView = $shelf.attr('class')
		var curIndex = views.indexOf(curView)
		if(curIndex < views.length - 1) {
			var nextIndex = curIndex+1
		} else {
			var nextIndex = 0
		}
		var nextView = views[nextIndex]
		$shelf.attr('class', nextView)
	}

	var fixFilter = function(e) {
		var $tabs = $('#filterButtons')
		if(!$tabs.length) {return}
		var $dummy = $('.tabs.dummy')
		var dummyTop = $dummy.offset().top
		var scrollTop = $(window).scrollTop()
		if(dummyTop <= 0) {
			$tabs.addClass('fixed')
		} else if(!$main.is('.noScroll')) {
			$tabs.removeClass('fixed')
		}
		var $groups = $('#shelf .group')
		var scrollPast = []
		$groups.each(function (i, group) {
			var scrollTop = $main.scrollTop()
			var groupTop = $(group).offset().top - $('#filterButtons').innerHeight() - 15
			var slug = group.dataset.slug
			if(groupTop <= 0) {
				scrollPast.push(slug)
			}
			if(scrollPast.length && i+1 == $groups.length) {
				var active = scrollPast.slice(-1)[0] 
				$('.filterList .filter.selected').removeClass('selected')
				$('.filterList .filter[data-slug="'+active+'"]').addClass('selected')
			}
		})
		if($shelf.offset().top + $shelf.innerHeight() < $tabs.innerHeight()) {
			$('#filter').addClass('bottom')
			$shelf.css({
				marginTop: $('#filter').innerHeight()
			})
		} else {
			$('#filter').removeClass('bottom')
			$shelf.css({
				marginTop: 0
			})
		}
	}

	var clickFilter = function(e) {
		e.preventDefault()
		var slug = $(this).data('slug')
		var type = $(this).parents('.filterList').data('type')
		$filter = $(this).parents('.filter')
		$filterList = $(this).parents('.filterList')
		if($filter.is('.selected')) {
			$filter.removeClass('selected')
			slug = 'null';
		} else {
			$('.filterList .selected').removeClass('selected')
			$filter.addClass('selected')
		}
		order(type)
		var $group = $shelf.find('.group.'+type+'[data-slug="'+slug+'"]')
		if($group.length) {
			var groupTop = $group.offset().top - $('#filterButtons').innerHeight() - 15
			var scrollTop = $main.scrollTop()
			console.log(scrollTop, groupTop)
			$main.scrollTop(scrollTop + groupTop)
		}
		$body.scroll()
	}
	
	if($('#filterButtons').length) {
		var labels = {
			'year': {},
			'location': allRegions
		}

		var firstYear = 1950
		var decade = firstYear
		for (var year = firstYear; year <= (new Date().getFullYear()); year++) {
			if(year % 10 === 0  ) {
		  	decade = year
		  }
			if(!labels.year[decade+'s']) {labels.year[decade+'s'] = []}
		  labels.year[decade+'s'].push([year, year])
		}
	}
	
	var order = function(type) {
		var $books = $('#shelf .books')
		var $booksArray = $books.find('.book');
		var $sortedBooks = $booksArray.sort(sortIt)
		$books.html('')
		var allSublabels = labels[type]
		var sortedSublabels = Object.keys(allSublabels)
		if(type == 'year') {
			sortedSublabels = sortedSublabels.reverse()
		}
		for(i in sortedSublabels) {
			label = sortedSublabels[i]
			var sublabels = allSublabels[label];
			$group = $('<div class="group '+type+'" data-slug="'+label+'"></div>')
			for(j in sublabels) {
				var sublabel = sublabels[j]
				var sublabelSlug = sublabel[0]
				var sublabelTitle = sublabel[1]
				var $sublabel = $('<div class="sublabel '+type+'"><span>' + sublabelTitle + '</span></div>')
				var length = $sortedBooks.filter('[data-'+type+'="'+sublabelSlug+'"]').length
				if(!length) {
					$sublabel.addClass('empty')
					if(j != sublabels.length - 1) {
						$sublabel.addClass('comma')
					}
				}
				$group.append($sublabel)
				$subgroup = $('<div class="subgroup"></div>')
				$sortedBooks.each(function(l, book) {
					var $book = $(book)
					var bookType = $book.data(type)
					if(bookType == sublabelSlug) {
						$book.removeClass('hide')
						$sortedBooks.splice(l, 1)
						$subgroup.append($book)
					}
				})
				if(length) {
					$group.append($subgroup)
				}
			}
			$books.append($group)
		}
		$sortedBooks.each(function(i, book) {
			var $book = $(book)
			var sortedIndex = $book.data('index')
			$book.addClass('hide')
			$('.books').append($book)
		})
	}

	var styleLabel = function(label) {
		switch(label) {
			case 'africa':
				return 'Africa'
			case 'europe':
				return 'Europe'
			case 'north-america':
				return 'North America'
			case 'asia':
				return 'Asia'
			case 'australia':
				return 'Australia'
			default:
				return label
		}
	}

	var sortIt = function(a, b) {
		var valA = $(a).attr('data-year');
		var valB = $(b).attr('data-year');
		if (valA < valB) {
	    return -1;
	  }
	  if (valA > valB) {
	    return 1;
	  }
	  return 0;
	}

	$('.filterList a').click(clickFilter)
	$('.button').click(clickButton)
	$('.tab.view').click(clickViewTab)
	$('.tab.filter').click(clickFilterTab)

	$main.scroll(function(e) {
		fixFilter(e)
	})

	$(window).resize(function(e) {
		resizeBricks()
		$main.scroll()
	}).resize()

})