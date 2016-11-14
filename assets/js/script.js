$(function() {
	$body = $('body')
	$main = $('main')
	$shelf = $('#shelf')
	$filterLists = $('#filterLists')
	$subscribe = $('#subscribe')

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
				setTimeout(function() {
					imagesLoaded( $image, function( ) {
					  $book.addClass('loaded')
					  resizeBookPattern($book)
					}, i*5)
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
		var $filterTabs = $tab.parents('#filterTabs')
		// var $dummy = $tab.parents('.tabs.dummy')
		var slug = this.dataset.slug
		$filterList = $('.filterList.'+slug)
		if($tab.is('.selected')) {
			$tab.removeClass('selected')
			// $filterLists.removeClass('show')
			$filterList.removeClass('show')
			$body.scroll()
		} else if($('.filter.tab.selected').length) {
			$('.filter.tab.selected').removeClass('selected')
			$('.filterList.show').removeClass('show')
			$filterList.addClass('show')
			// $filterLists.addClass('show')
			$tab.addClass('selected')
			resizeBricks()
		} else {
			$tab.addClass('selected')
			// $filterLists.addClass('show')
			$filterList.addClass('show')
			resizeBricks()
		}
	}

	var clickViewTab = function(e) {
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
			orderBooks(type, slug)
		}
	}
	
	if($('#filterTabs').length) {
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
	
	var orderBooks = function(type, slug) {
		var $books = $('#shelf .books')
		var $booksArray = $books.find('.book');
		var $sortedBooks = $booksArray.sort(sortYear)
		$main.addClass('autoscroll')
		$books.html('')
		if(type=='decade')
			type = 'year'

		if(!labels)
			return
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
		if(slug) {
			var $group = $shelf.find('.group.'+type+'[data-slug="'+slug+'"]')
			if($group.length) {
				var groupTop = $group.offset().top - $('#filterTabs').innerHeight() - 30
				var scrollTop = $main.scrollTop()
				$main.stop().animate({ scrollTop: scrollTop + groupTop }, 300)
			}
			$body.scroll()
			$main.removeClass('autoscroll')
		}
		$shelf.addClass('show')
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
		$main.removeClass('autoscroll')
	}

	var openSubscribe = function(e) {
		e.preventDefault()
		$subscribe.addClass('open')
	}

	var closeSubscribe = function(e) {
		e.preventDefault()
		$subscribe.removeClass('open')
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
		  if(type && slug && ['location', 'decade', 'publisher', 'sort'].indexOf(type) >= 0) {
		  	if(type == 'sort') {
		  		type = slug
		  		slug = null
		  	}
				$('.tabs .filter.selected').removeClass('selected')
				$('.tab.filter[data-slug="'+type+'"]').addClass('selected')
				$('.filterList.'+type).addClass('show')
				$('.filter[data-slug="'+type+'"]').addClass('selected')
				$('.filter[data-slug="'+slug+'"]').addClass('selected')
				setTimeout(function() {
					orderBooks(type, slug)
				},10)
			} else {
				$shelf.addClass('show')
			}
		} else {
			$shelf.addClass('show')
		}
	}

	var touchCheck = function() {
		var touch = 'ontouchstart' in document.documentElement
	    || (navigator.MaxTouchPoints > 0)
	    || (navigator.msMaxTouchPoints > 0)

		if (touch) {
	    try {
        for (var si in document.styleSheets) {
          var styleSheet = document.styleSheets[si];
          if (!styleSheet.rules) continue;
          for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
            if (!styleSheet.rules[ri].selectorText) continue;
            if (styleSheet.rules[ri].selectorText.match(':hover')) {
              styleSheet.deleteRule(ri);
            }
          }
        }
	    } catch (ex) {

	    }
		}
	}

	resizeBricks()
	resizeBooksPattern()
	loadCovers()
	getQuery()
	touchCheck()

	window.onpopstate = function(event) {
  	getQuery()
	}

	$body.on('click', '.filterList a', clickFilter)
	$body.on('click', '.button', clickButton)
	$body.on('click', '.tab.view', clickViewTab)
	$body.on('click', '.tab.filter', clickFilterTab)
	$body.on('click', 'footer .row.subscribe a', openSubscribe)
	$body.on('click', '#subscribe input.cancel', closeSubscribe)

	$main.scroll(function(e) {
		fixFilter(e)
	})

	$(window).resize(function(e) {
		resizeBricks()
		resizeBooksPattern()
		$main.scroll()
		if( $body.is('.books') && (sizeCheck() === 'small' || sizeCheck() === 'xSmall') ) {
			$shelf.attr('class', 'list show').attr('data-view', 'list')
		}
	}).resize()

})