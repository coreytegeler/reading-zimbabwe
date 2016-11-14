$(function() {
	$body = $('body')
	$main = $('main')
	$shelf = $('#shelf')
	$filterLists = $('#filterLists')

	var loadCovers = function() {
		if(!$shelf.length) {return}
		$shelf.find('.book').each(function(i, book) {
			var $book = $(book)
			if($book.is('.hasCover')) {
				var $image = $book.find('img')
				var src = $image.data('src')
				var image = new Image()
				image.src = src
				$image.attr('src', src)
				setTimeout(function() {
					imagesLoaded( $image, function( ) {
					  $book.addClass('loaded')
					}, 1)
				})
			}
		})
	}

	var resizeBricks = function(e) {
		$bricks = $('.brick')
		$bricks.each(function(i, brick) {
			var $brick = $(brick)
			$brick.attr('style','')
			var textWidth = $brick.find('.title').innerWidth()
			var patWidth = 30
			var bricksWidth = $brick.parents('.bricks').width()
			if( sizeCheck() == 'xSmall' ) {
				var newBrickWidth = bricksWidth
			} else {
				var newBrickWidth = Math.ceil(textWidth/patWidth)*patWidth
			}
			$brick.css({
				width: newBrickWidth,
				maxWidth: bricksWidth
			})
		})
	}

	var clickButton = function() {
		var scrollTop = $main.scrollTop()
		var bottom = $main[0].scrollHeight
		if($(this).is('.search')) {
			$search = $('.search form').eq(0)
			var searchTop = $('footer .search').position().top
			if($('.fixed').length) {
				// searchTop -= $('.fixed').innerHeight()
			}
			if($body.is('.search')) {
				bottom = 0
			}
			$main.animate({ scrollTop: scrollTop + searchTop }, 300)
			$search.find('input[type="search"]').focus()
		}
	}

	var clickFilterTab = function(e) {
		var $tab = $(this)
		var $tabs = $tab.parents('.tabs:not(.dummy)')
		var $dummy = $tab.parents('.tabs.dummy')
		var slug = this.dataset.slug
		$filterList = $('.filterList.'+slug)
		if($tab.is('.selected')) {
			$tab.removeClass('selected')
			$filterLists.removeClass('show')
			$filterList.removeClass('show')
			$body.scroll()
		} else if($('.filter.tab.selected').length) {
			$('.filter.tab.selected').removeClass('selected')
			$('.filterList.show').removeClass('show')
			$filterList.addClass('show')
			$filterLists.addClass('show')
			$tab.addClass('selected')
			resizeBricks()
		} else {
			$tab.addClass('selected')
			$filterLists.addClass('show')
			$filterList.addClass('show')
			resizeBricks()
		}
	}

	var clickViewTab = function(e) {
		var views = ['grid', 'list', 'covers']
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
		var dummyTop = $dummy.offset().top - parseInt($main.css('paddingTop'))
		var scrollTop = $(window).scrollTop()
		if(dummyTop <= 0) {
			$tabs.addClass('fixed')
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
		} else {
			$('#filter').removeClass('bottom')
		}
	}

	var clickFilter = function(e) {
		e.preventDefault()
		var slug = $(this).data('slug')
		var type = $(this).parents('.filterList').data('type')
		var url = $(this).attr('href').replace('/')
		$filter = $(this).parents('.filter')
		$filterList = $(this).parents('.filterList')
		if($filter.is('.selected')) {
			url = window.location.href.split('?')[0]
			history.pushState({}, window.title, url)
			$filter.removeClass('selected')
			slug = 'null';
			clearOrder()
		} else {
			history.pushState({}, window.title, url)
			$('.filterList .selected').removeClass('selected')
			$filter.addClass('selected')
			order(type, slug)
		}
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
	
	var order = function(type, slug) {
		var $books = $('#shelf .books')
		var $booksArray = $books.find('.book');
		var $sortedBooks = $booksArray.sort(sortYear)
		$books.html('')
		if(type=='decade')
			type = 'year'
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
			if(!$group.html()) {
				$group.html('<div class="no">No books from <span>'+label+'</span></div>')
			}
			$books.append($group)
		}
		$sortedBooks.each(function(i, book) {
			var $book = $(book)
			var sortedIndex = $book.data('index')
			$book.addClass('hide')
			$('#shelf .books').append($book)
		})
		var $group = $shelf.find('.group.'+type+'[data-slug="'+slug+'"]')
		if($group.length) {
			var groupTop = $group.offset().top - $('#filterButtons').innerHeight() - 15
			var scrollTop = $main.scrollTop()

			$main.scrollTop(scrollTop + groupTop)
		}
		$body.scroll()
	}

	var clearOrder = function() {
		var $books = $('#shelf .books')
		var $booksArray = $books.find('.book');
		var $sortedBooks = $booksArray.sort(sortIndex)
		$books.html('');
		$main.scrollTop(0)
		$booksArray.each(function(i, book) {
			$(book).removeClass('hide')
			$books.append(book)
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

	var sortYear = function(a, b) {
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

	var sortIndex = function(a, b) {
		var valA = $(a).attr('data-index');
		var valB = $(b).attr('data-index');
		if (valA < valB) {
	    return -1;
	  }
	  if (valA > valB) {
	    return 1;
	  }
	  return 0;
	}

	var sizeCheck = function() {
		return $body.css('content').replace(/['"]+/g, '')
	}

	var getQuery = function() {
		var params = {};
		if (window.location.search.length > 1) {
		  for (var aItKey, nKeyId = 0, pair = window.location.search.substr(1).split("&"); nKeyId < pair.length; nKeyId++) {
		    aItKey = pair[nKeyId].split("=");
		    params[unescape(aItKey[0])] = aItKey.length > 1 ? unescape(aItKey[1]) : "";
		  }
		  var type = Object.keys(params)[0]
		  var slug = params[type]
		  if(type, slug) {
				$('.tabs .filter.selected').removeClass('selected')
				$('.tab.filter[data-slug="'+type+'"]').addClass('selected')
				$('.filter[data-slug="'+slug+'"]').addClass('selected')
				$('#filterLists').addClass('show')
				$('.filterList.'+type).addClass('show')
				$('.filter[data-slug="'+type+'"]').addClass('selected')
				setTimeout(function() {
					order(type, slug)
				},10)
			}
		}
	}

	resizeBricks()
	loadCovers()
	getQuery()

	window.onpopstate = function(event) {
  	getQuery()
	}

	$body.on('click', '.filterList a', clickFilter)
	$body.on('click', '.button', clickButton)
	$body.on('click', '.tab.view', clickViewTab)
	$body.on('click', '.tab.filter', clickFilterTab)

	$main.scroll(function(e) {
		fixFilter(e)
	})

	$(window).resize(function(e) {
		resizeBricks()
		$main.scroll()
	}).resize()

})