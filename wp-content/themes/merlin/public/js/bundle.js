/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


(function ($) {
    // to set first item to active
    //$('.accordion > li:eq(0) a').addClass('active').next().slideDown();

    $('.accordion a, #attorney-filter-search').click(function (e) {
        var dropDown = $(this).closest('li').find('.accordion-answer');
        var dropDownDiv = $('.attorney-filter-cats');

        $(dropDownDiv).toggleClass('block');
        $(this).closest('.accordion').find('.accordion-answer').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        e.preventDefault();
    });
})(jQuery);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// Attorney filtering
// Collect & send filter data; call on click of apply button

var sendFilterData = function sendFilterData() {

  // initialize all the variables to be used as an empty array.
  $('#results').html("");
  var state = [];
  var specialty = [];
  var term_id = $('#cat_id').text();

  // loop through all checked check boxes; take the items and push into an empty array
  $(".filter-wrap.state input.ios8-switch:checked").each(function () {
    var state_title = $(this).attr('name');
    state.push(state_title);
  });

  $(".filter-wrap.specialty input.ios8-switch:checked").each(function () {
    var specialty_title = $(this).attr('name');
    specialty.push(specialty_title);
  });

  // collect all the data.
  // ex: {state: Array(3), specialty: Array(0)}
  var filter_data = {
    'state': state,
    'specialty': specialty
    //console.log(filter_data);
  };$.ajax({
    url: ajaxreq.ajaxurl,
    type: 'POST',
    data: {
      action: 'query_attorneys',
      filter_data: filter_data
    },
    error: function error(xhr, status, errorThrown) {
      console.log("Request failed: " + status);
    },
    success: function success(result) {
      $('#results').html(result);
      $('#loading').hide(); //remove loading div
      //console.log(result);
    }
  });
}; //close function

$('#attorney-filter-search').on('click', function (e) {
  $('#loading').show(); //show loading div
  sendFilterData();
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/* ========================================================================
 * Bootstrap: transition.js v3.3.5
 * https://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

+function ($) {
  'use strict';

  function transitionEnd() {
    var el = document.createElement('bootstrap');

    var transEndEventNames = {
      WebkitTransition: 'webkitTransitionEnd',
      MozTransition: 'transitionend',
      OTransition: 'oTransitionEnd otransitionend',
      transition: 'transitionend'
    };

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] };
      }
    }

    return false; // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false;
    var $el = this;
    $(this).one('bsTransitionEnd', function () {
      called = true;
    });
    var callback = function callback() {
      if (!called) $($el).trigger($.support.transition.end);
    };
    setTimeout(callback, duration);
    return this;
  };

  $(function () {
    $.support.transition = transitionEnd();

    if (!$.support.transition) return;

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function handle(e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments);
      }
    };
  });
}(jQuery);

/* ========================================================================
 * Bootstrap: carousel.js v3.3.5
 * https://getbootstrap.com/javascript/#carousel
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

+function ($) {
  'use strict';

  // CAROUSEL CLASS DEFINITION
  // =========================

  var Carousel = function Carousel(element, options) {
    this.$element = $(element);
    this.$indicators = this.$element.find('.carousel-indicators');
    this.options = options;
    this.paused = null;
    this.sliding = null;
    this.interval = null;
    this.$active = null;
    this.$items = null;

    this.options.keyboard && this.$element.on('keydown.bs.carousel', $.proxy(this.keydown, this));

    this.options.pause == 'hover' && !('ontouchstart' in document.documentElement) && this.$element.on('mouseenter.bs.carousel', $.proxy(this.pause, this)).on('mouseleave.bs.carousel', $.proxy(this.cycle, this));
  };

  Carousel.VERSION = '3.3.5';

  Carousel.TRANSITION_DURATION = 600;

  Carousel.DEFAULTS = {
    interval: 5000,
    pause: 'hover',
    wrap: true,
    keyboard: true
  };

  Carousel.prototype.keydown = function (e) {
    if (/input|textarea/i.test(e.target.tagName)) return;
    switch (e.which) {
      case 37:
        this.prev();break;
      case 39:
        this.next();break;
      default:
        return;
    }

    e.preventDefault();
  };

  Carousel.prototype.cycle = function (e) {
    e || (this.paused = false);

    this.interval && clearInterval(this.interval);

    this.options.interval && !this.paused && (this.interval = setInterval($.proxy(this.next, this), this.options.interval));

    return this;
  };

  Carousel.prototype.getItemIndex = function (item) {
    this.$items = item.parent().children('.item');
    return this.$items.index(item || this.$active);
  };

  Carousel.prototype.getItemForDirection = function (direction, active) {
    var activeIndex = this.getItemIndex(active);
    var willWrap = direction == 'prev' && activeIndex === 0 || direction == 'next' && activeIndex == this.$items.length - 1;
    if (willWrap && !this.options.wrap) return active;
    var delta = direction == 'prev' ? -1 : 1;
    var itemIndex = (activeIndex + delta) % this.$items.length;
    return this.$items.eq(itemIndex);
  };

  Carousel.prototype.to = function (pos) {
    var that = this;
    var activeIndex = this.getItemIndex(this.$active = this.$element.find('.item.active'));

    if (pos > this.$items.length - 1 || pos < 0) return;

    if (this.sliding) return this.$element.one('slid.bs.carousel', function () {
      that.to(pos);
    }); // yes, "slid"
    if (activeIndex == pos) return this.pause().cycle();

    return this.slide(pos > activeIndex ? 'next' : 'prev', this.$items.eq(pos));
  };

  Carousel.prototype.pause = function (e) {
    e || (this.paused = true);

    if (this.$element.find('.next, .prev').length && $.support.transition) {
      this.$element.trigger($.support.transition.end);
      this.cycle(true);
    }

    this.interval = clearInterval(this.interval);

    return this;
  };

  Carousel.prototype.next = function () {
    if (this.sliding) return;
    return this.slide('next');
  };

  Carousel.prototype.prev = function () {
    if (this.sliding) return;
    return this.slide('prev');
  };

  Carousel.prototype.slide = function (type, next) {
    var $active = this.$element.find('.item.active');
    var $next = next || this.getItemForDirection(type, $active);
    var isCycling = this.interval;
    var direction = type == 'next' ? 'left' : 'right';
    var that = this;

    if ($next.hasClass('active')) return this.sliding = false;

    var relatedTarget = $next[0];
    var slideEvent = $.Event('slide.bs.carousel', {
      relatedTarget: relatedTarget,
      direction: direction
    });
    this.$element.trigger(slideEvent);
    if (slideEvent.isDefaultPrevented()) return;

    this.sliding = true;

    isCycling && this.pause();

    if (this.$indicators.length) {
      this.$indicators.find('.active').removeClass('active');
      var $nextIndicator = $(this.$indicators.children()[this.getItemIndex($next)]);
      $nextIndicator && $nextIndicator.addClass('active');
    }

    var slidEvent = $.Event('slid.bs.carousel', { relatedTarget: relatedTarget, direction: direction }); // yes, "slid"
    if ($.support.transition && this.$element.hasClass('slide')) {
      $next.addClass(type);
      $next[0].offsetWidth; // force reflow
      $active.addClass(direction);
      $next.addClass(direction);
      $active.one('bsTransitionEnd', function () {
        $next.removeClass([type, direction].join(' ')).addClass('active');
        $active.removeClass(['active', direction].join(' '));
        that.sliding = false;
        setTimeout(function () {
          that.$element.trigger(slidEvent);
        }, 0);
      }).emulateTransitionEnd(Carousel.TRANSITION_DURATION);
    } else {
      $active.removeClass('active');
      $next.addClass('active');
      this.sliding = false;
      this.$element.trigger(slidEvent);
    }

    isCycling && this.cycle();

    return this;
  };

  // CAROUSEL PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this);
      var data = $this.data('bs.carousel');
      var options = $.extend({}, Carousel.DEFAULTS, $this.data(), (typeof option === 'undefined' ? 'undefined' : _typeof(option)) == 'object' && option);
      var action = typeof option == 'string' ? option : options.slide;

      if (!data) $this.data('bs.carousel', data = new Carousel(this, options));
      if (typeof option == 'number') data.to(option);else if (action) data[action]();else if (options.interval) data.pause().cycle();
    });
  }

  var old = $.fn.carousel;

  $.fn.carousel = Plugin;
  $.fn.carousel.Constructor = Carousel;

  // CAROUSEL NO CONFLICT
  // ====================

  $.fn.carousel.noConflict = function () {
    $.fn.carousel = old;
    return this;
  };

  // CAROUSEL DATA-API
  // =================

  var clickHandler = function clickHandler(e) {
    var href;
    var $this = $(this);
    var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')); // strip for ie7
    if (!$target.hasClass('carousel')) return;
    var options = $.extend({}, $target.data(), $this.data());
    var slideIndex = $this.attr('data-slide-to');
    if (slideIndex) options.interval = false;

    Plugin.call($target, options);

    if (slideIndex) {
      $target.data('bs.carousel').to(slideIndex);
    }

    e.preventDefault();
  };

  $(document).on('click.bs.carousel.data-api', '[data-slide]', clickHandler).on('click.bs.carousel.data-api', '[data-slide-to]', clickHandler);

  $(window).on('load', function () {
    $('[data-ride="carousel"]').each(function () {
      var $carousel = $(this);
      Plugin.call($carousel, $carousel.data());
    });
  });
}(jQuery);

$('.carousel').carousel({
  //interval: 3000,
  pause: false
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// Latest Tweet

__webpack_require__(7);

// Get latest tweet & write to a HTML el
var configProfile = {
  "profile": { "screenName": 'merlinlawgroup' },
  "domId": 'latest-tweet',
  "maxTweets": 1,
  "enableLinks": true,
  "showUser": false,
  "showTime": false,
  "showImages": false,
  "lang": 'en'
};
twitterFetcher.fetch(configProfile);

function handleTweets(tweets) {
  var x = tweets.length;
  var n = 0;
  var element = document.getElementById('latest-tweet');
  var html = '<ul>';
  while (n < x) {
    html += '<li>' + tweets[n] + '</li>';
    n++;
  }
  html += '</ul>';
  element.innerHTML = html;
}

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// Nav.js
// Mobile nav
var breakpoint = 992; //$md var

$(document).ready(function () {
  var trigger = $('#js-nav-toggle');
  var isClosed = false;
  trigger.click(function () {
    $('#js-nav-mobile').toggleClass('nav-open');
    $('body').toggleClass('nav-open');
    $('#js-nav-toggle').toggleClass('active');
  });
});

// Desktop Drop down nav
var nav_parent = $('.nav-primary li.menu-item-has-children:has(ul)');

nav_parent.on({
  mouseenter: function mouseenter() {
    if ($(window).width() >= breakpoint) {
      $('body').addClass('nav-dropdown-open');
      $('.nav-dropdown').addClass('active');
      $(this).find('ul.sub-menu').addClass('active-flex-wrap');
    }
  }
});
nav_parent.on({
  mouseleave: function mouseleave() {
    if ($(window).width() >= breakpoint) {
      $('body').removeClass('nav-dropdown-open');
      $('.nav-dropdown').removeClass('active');
      $(this).find('ul.sub-menu').removeClass('active-flex-wrap');
    }
  }
});

$('.nav-icon-search a').append('<div class="search-icon" id="js-search-icon"><svg class="svg-icon search-svg" viewBox="0 0 105 105" xmlns="http://www.w3.org/2000/svg"><path d="M105 99.766l-29.11-29.06c14.284-16.965 13.56-42.234-2.35-58.117-16.814-16.786-44.115-16.786-60.93 0-16.814 16.785-16.814 44.04 0 60.824C20.93 81.717 32.138 86.05 43.167 86.05c9.944 0 19.707-3.43 27.843-10.11L100.117 105 105 99.766zM17.673 68.36c-13.92-13.897-13.92-36.64 0-50.537 7.05-7.04 16.092-10.468 25.312-10.468 9.22 0 18.442 3.43 25.312 10.468 13.922 13.898 13.922 36.64 0 50.538-13.92 13.898-36.702 13.898-50.624 0z" fill-rule="nonzero" fill="currentColor"/></svg></div>');

// Search icon
var search_icon = $('#js-search-icon, .search-wrap');
search_icon.on({
  mouseover: function mouseover() {
    $('body').addClass('nav-dropdown-open');
    $('.nav-dropdown').addClass('active');
    $('.search-wrap').addClass('active');
    $('.search-field').focus();
  }
});
search_icon.on({
  mouseleave: function mouseleave() {
    $('body').removeClass('nav-dropdown-open');
    $('.nav-dropdown').removeClass('active');
    $('.search-wrap').removeClass('active');
  }
});

// Mobile Nav
var parent = $('.nav-mobile li.menu-item-has-children:has(ul)');
parent.append('<i></i>');
parent.on('click', function (e) {
  e.preventDefault();
  $(this).find('ul > li').toggle();
  $(this).find('i').toggleClass('is-open');
});

var child = $('.nav-mobile li.menu-item-has-children:has(ul)').find('ul > li');
child.on('click', function (e) {
  e.stopPropagation();
});

// Header on scroll
/*
$(window).on('scroll', function() {
  var el = $('.header');
  var scroll = $(window).scrollTop();
  var heroHeight = $('#js-header-scroll-to').outerHeight();
  //var breakpoint = 768;
  //if ( scroll >= heroHeight && $(window).width() >= breakpoint) {
  if (scroll >= heroHeight) {
    el.addClass('is-fixed');
  } else {
    el.removeClass('is-fixed');
  }
});
*/

/***/ }),
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


//import 'jquery';
__webpack_require__(5); //require stylesheet

// vendors
__webpack_require__(4); //main, dropdown, & mobile navigation
__webpack_require__(1); //attorney directory filtering
__webpack_require__(3); //homepage resource twitter api
__webpack_require__(2); //carousel & testimonial module
__webpack_require__(0); //accordion module

//template_dir is echo'd to footer for global usage
var img_el = $('#js-img-change');
var img_res = $('#link-res');
var img_res_src = template_dir + '/assets/img/img-res.jpg';
var img_comm = $('#link-comm');
var img_comm_src = template_dir + '/assets/img/img-comm.jpg';
var img_health = $('#link-health');
var img_health_src = template_dir + '/assets/img/img-health.jpg';
var img_disability = $('#link-disability');
var img_disability_src = template_dir + '/assets/img/img-disability.jpg';
var img_longterm = $('#link-longterm');
var img_longterm_src = template_dir + '/assets/img/img-longterm.jpg';

$(img_res).on({
  mouseenter: function mouseenter() {
    img_el.attr('src', img_res_src);
    $(this).addClass('active');
  },
  mouseleave: function mouseleave() {
    img_el.attr('src', img_res_src);
    $(this).removeClass('active');
  }
});
$(img_comm).on({
  mouseenter: function mouseenter() {
    img_el.attr('src', img_comm_src);
    $(this).addClass('active');
  },
  mouseleave: function mouseleave() {
    img_el.attr('src', img_res_src);
    $(this).removeClass('active');
  }
});
$(img_health).on({
  mouseenter: function mouseenter() {
    img_el.attr('src', img_health_src);
    $(this).addClass('active');
  },
  mouseleave: function mouseleave() {
    img_el.attr('src', img_res_src);
    $(this).removeClass('active');
  }
});
$(img_disability).on({
  mouseenter: function mouseenter() {
    img_el.attr('src', img_disability_src);
    $(this).addClass('active');
  },
  mouseleave: function mouseleave() {
    img_el.attr('src', img_res_src);
    $(this).removeClass('active');
  }
});
$(img_longterm).on({
  mouseenter: function mouseenter() {
    img_el.attr('src', img_longterm_src);
    $(this).addClass('active');
  },
  mouseleave: function mouseleave() {
    img_el.attr('src', img_res_src);
    $(this).removeClass('active');
  }
});

// Scrolling for anchor links// scroll on click of anchor link (a href="#")
$(function () {
  $('a[href*="#"]:not([href="#"])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 100
        }, 900);
        return false;
      }
    }
  });
});

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*********************************************************************
*  #### Twitter Post Fetcher v17.0.2 ####
*  Coded by Jason Mayes 2015. A present to all the developers out there.
*  www.jasonmayes.com
*  Please keep this disclaimer with my code if you use it. Thanks. :-)
*  Got feedback or questions, ask here:
*  http://www.jasonmayes.com/projects/twitterApi/
*  Github: https://github.com/jasonmayes/Twitter-Post-Fetcher
*  Updates will be posted to this site.
*********************************************************************/
(function (root, factory) {
  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else if ((typeof exports === 'undefined' ? 'undefined' : _typeof(exports)) === 'object') {
    module.exports = factory();
  } else {
    factory();
  }
})(undefined, function () {
  var domNode = '';var maxTweets = 20;var parseLinks = true;var queue = [];var inProgress = false;var printTime = true;var printUser = true;var formatterFunction = null;var supportsClassName = true;var showRts = true;var customCallbackFunction = null;var showInteractionLinks = true;var showImages = false;var useEmoji = false;var targetBlank = true;var lang = 'en';var permalinks = true;var dataOnly = false;var script = null;var scriptAdded = false;function handleTweets(tweets) {
    if (customCallbackFunction === null) {
      var x = tweets.length;var n = 0;var element = document.getElementById(domNode);var html = '<ul>';while (n < x) {
        html += '<li>' + tweets[n] + '</li>';n++;
      }
      html += '</ul>';element.innerHTML = html;
    } else {
      customCallbackFunction(tweets);
    }
  }
  function strip(data) {
    return data.replace(/<b[^>]*>(.*?)<\/b>/gi, function (a, s) {
      return s;
    }).replace(/class="(?!(tco-hidden|tco-display|tco-ellipsis))+.*?"|data-query-source=".*?"|dir=".*?"|rel=".*?"/gi, '');
  }
  function targetLinksToNewWindow(el) {
    var links = el.getElementsByTagName('a');for (var i = links.length - 1; i >= 0; i--) {
      links[i].setAttribute('target', '_blank');
    }
  }
  function getElementsByClassName(node, classname) {
    var a = [];var regex = new RegExp('(^| )' + classname + '( |$)');var elems = node.getElementsByTagName('*');for (var i = 0, j = elems.length; i < j; i++) {
      if (regex.test(elems[i].className)) {
        a.push(elems[i]);
      }
    }
    return a;
  }
  function extractImageUrl(image_data) {
    if (image_data !== undefined && image_data.innerHTML.indexOf('data-srcset') >= 0) {
      var data_src = image_data.innerHTML.match(/data-srcset="([A-z0-9%_\.-]+)/i)[0];return decodeURIComponent(data_src).split('"')[1];
    }
  }
  var twitterFetcher = { fetch: function fetch(config) {
      if (config.maxTweets === undefined) {
        config.maxTweets = 20;
      }
      if (config.enableLinks === undefined) {
        config.enableLinks = true;
      }
      if (config.showUser === undefined) {
        config.showUser = true;
      }
      if (config.showTime === undefined) {
        config.showTime = true;
      }
      if (config.dateFunction === undefined) {
        config.dateFunction = 'default';
      }
      if (config.showRetweet === undefined) {
        config.showRetweet = true;
      }
      if (config.customCallback === undefined) {
        config.customCallback = null;
      }
      if (config.showInteraction === undefined) {
        config.showInteraction = true;
      }
      if (config.showImages === undefined) {
        config.showImages = false;
      }
      if (config.useEmoji === undefined) {
        config.useEmoji = false;
      }
      if (config.linksInNewWindow === undefined) {
        config.linksInNewWindow = true;
      }
      if (config.showPermalinks === undefined) {
        config.showPermalinks = true;
      }
      if (config.dataOnly === undefined) {
        config.dataOnly = false;
      }
      if (inProgress) {
        queue.push(config);
      } else {
        inProgress = true;domNode = config.domId;maxTweets = config.maxTweets;parseLinks = config.enableLinks;printUser = config.showUser;printTime = config.showTime;showRts = config.showRetweet;formatterFunction = config.dateFunction;customCallbackFunction = config.customCallback;showInteractionLinks = config.showInteraction;showImages = config.showImages;useEmoji = config.useEmoji;targetBlank = config.linksInNewWindow;permalinks = config.showPermalinks;dataOnly = config.dataOnly;var head = document.getElementsByTagName('head')[0];if (script !== null) {
          head.removeChild(script);
        }
        script = document.createElement('script');script.type = 'text/javascript';if (config.list !== undefined) {
          script.src = 'https://syndication.twitter.com/timeline/list?' + 'callback=__twttrf.callback&dnt=false&list_slug=' + config.list.listSlug + '&screen_name=' + config.list.screenName + '&suppress_response_codes=true&lang=' + (config.lang || lang) + '&rnd=' + Math.random();
        } else if (config.profile !== undefined) {
          script.src = 'https://syndication.twitter.com/timeline/profile?' + 'callback=__twttrf.callback&dnt=false' + '&screen_name=' + config.profile.screenName + '&suppress_response_codes=true&lang=' + (config.lang || lang) + '&rnd=' + Math.random();
        } else if (config.likes !== undefined) {
          script.src = 'https://syndication.twitter.com/timeline/likes?' + 'callback=__twttrf.callback&dnt=false' + '&screen_name=' + config.likes.screenName + '&suppress_response_codes=true&lang=' + (config.lang || lang) + '&rnd=' + Math.random();
        } else {
          script.src = 'https://cdn.syndication.twimg.com/widgets/timelines/' + config.id + '?&lang=' + (config.lang || lang) + '&callback=__twttrf.callback&' + 'suppress_response_codes=true&rnd=' + Math.random();
        }
        head.appendChild(script);
      }
    }, callback: function callback(data) {
      if (data === undefined || data.body === undefined) {
        inProgress = false;if (queue.length > 0) {
          twitterFetcher.fetch(queue[0]);queue.splice(0, 1);
        }
        return;
      }
      if (!useEmoji) {
        data.body = data.body.replace(/(<img[^c]*class="Emoji[^>]*>)|(<img[^c]*class="u-block[^>]*>)/g, '');
      }
      if (!showImages) {
        data.body = data.body.replace(/(<img[^c]*class="NaturalImage-image[^>]*>|(<img[^c]*class="CroppedImage-image[^>]*>))/g, '');
      }
      if (!printUser) {
        data.body = data.body.replace(/(<img[^c]*class="Avatar"[^>]*>)/g, '');
      }
      var div = document.createElement('div');div.innerHTML = data.body;if (typeof div.getElementsByClassName === 'undefined') {
        supportsClassName = false;
      }
      function swapDataSrc(element) {
        var avatarImg = element.getElementsByTagName('img')[0];avatarImg.src = avatarImg.getAttribute('data-src-2x');return element;
      }
      var tweets = [];var authors = [];var times = [];var images = [];var rts = [];var tids = [];var permalinksURL = [];var x = 0;if (supportsClassName) {
        var tmp = div.getElementsByClassName('timeline-Tweet');while (x < tmp.length) {
          if (tmp[x].getElementsByClassName('timeline-Tweet-retweetCredit').length > 0) {
            rts.push(true);
          } else {
            rts.push(false);
          }
          if (!rts[x] || rts[x] && showRts) {
            tweets.push(tmp[x].getElementsByClassName('timeline-Tweet-text')[0]);tids.push(tmp[x].getAttribute('data-tweet-id'));if (printUser) {
              authors.push(swapDataSrc(tmp[x].getElementsByClassName('timeline-Tweet-author')[0]));
            }
            times.push(tmp[x].getElementsByClassName('dt-updated')[0]);permalinksURL.push(tmp[x].getElementsByClassName('timeline-Tweet-timestamp')[0]);if (tmp[x].getElementsByClassName('timeline-Tweet-media')[0] !== undefined) {
              images.push(tmp[x].getElementsByClassName('timeline-Tweet-media')[0]);
            } else {
              images.push(undefined);
            }
          }
          x++;
        }
      } else {
        var tmp = getElementsByClassName(div, 'timeline-Tweet');while (x < tmp.length) {
          if (getElementsByClassName(tmp[x], 'timeline-Tweet-retweetCredit').length > 0) {
            rts.push(true);
          } else {
            rts.push(false);
          }
          if (!rts[x] || rts[x] && showRts) {
            tweets.push(getElementsByClassName(tmp[x], 'timeline-Tweet-text')[0]);tids.push(tmp[x].getAttribute('data-tweet-id'));if (printUser) {
              authors.push(swapDataSrc(getElementsByClassName(tmp[x], 'timeline-Tweet-author')[0]));
            }
            times.push(getElementsByClassName(tmp[x], 'dt-updated')[0]);permalinksURL.push(getElementsByClassName(tmp[x], 'timeline-Tweet-timestamp')[0]);if (getElementsByClassName(tmp[x], 'timeline-Tweet-media')[0] !== undefined) {
              images.push(getElementsByClassName(tmp[x], 'timeline-Tweet-media')[0]);
            } else {
              images.push(undefined);
            }
          }
          x++;
        }
      }
      if (tweets.length > maxTweets) {
        tweets.splice(maxTweets, tweets.length - maxTweets);authors.splice(maxTweets, authors.length - maxTweets);times.splice(maxTweets, times.length - maxTweets);rts.splice(maxTweets, rts.length - maxTweets);images.splice(maxTweets, images.length - maxTweets);permalinksURL.splice(maxTweets, permalinksURL.length - maxTweets);
      }
      var arrayTweets = [];var x = tweets.length;var n = 0;if (dataOnly) {
        while (n < x) {
          arrayTweets.push({ tweet: tweets[n].innerHTML, author: authors[n] ? authors[n].innerHTML : 'Unknown Author', author_data: { profile_url: authors[n] ? authors[n].querySelector('[data-scribe="element:user_link"]').href : null, profile_image: authors[n] ? authors[n].querySelector('[data-scribe="element:avatar"]').getAttribute('data-src-1x') : null, profile_image_2x: authors[n] ? authors[n].querySelector('[data-scribe="element:avatar"]').getAttribute('data-src-2x') : null, screen_name: authors[n] ? authors[n].querySelector('[data-scribe="element:screen_name"]').title : null, name: authors[n] ? authors[n].querySelector('[data-scribe="element:name"]').title : null }, time: times[n].textContent, timestamp: times[n].getAttribute('datetime').replace('+0000', 'Z').replace(/([\+\-])(\d\d)(\d\d)/, '$1$2:$3'), image: extractImageUrl(images[n]), rt: rts[n], tid: tids[n], permalinkURL: permalinksURL[n] === undefined ? '' : permalinksURL[n].href });n++;
        }
      } else {
        while (n < x) {
          if (typeof formatterFunction !== 'string') {
            var datetimeText = times[n].getAttribute('datetime');var newDate = new Date(times[n].getAttribute('datetime').replace(/-/g, '/').replace('T', ' ').split('+')[0]);var dateString = formatterFunction(newDate, datetimeText);times[n].setAttribute('aria-label', dateString);if (tweets[n].textContent) {
              if (supportsClassName) {
                times[n].textContent = dateString;
              } else {
                var h = document.createElement('p');var t = document.createTextNode(dateString);h.appendChild(t);h.setAttribute('aria-label', dateString);times[n] = h;
              }
            } else {
              times[n].textContent = dateString;
            }
          }
          var op = '';if (parseLinks) {
            if (targetBlank) {
              targetLinksToNewWindow(tweets[n]);if (printUser) {
                targetLinksToNewWindow(authors[n]);
              }
            }
            if (printUser) {
              op += '<div class="user">' + strip(authors[n].innerHTML) + '</div>';
            }
            op += '<p class="tweet">' + strip(tweets[n].innerHTML) + '</p>';if (printTime) {
              if (permalinks) {
                op += '<p class="timePosted"><a href="' + permalinksURL[n] + '">' + times[n].getAttribute('aria-label') + '</a></p>';
              } else {
                op += '<p class="timePosted">' + times[n].getAttribute('aria-label') + '</p>';
              }
            }
          } else {
            if (tweets[n].textContent) {
              if (printUser) {
                op += '<p class="user">' + authors[n].textContent + '</p>';
              }
              op += '<p class="tweet">' + tweets[n].textContent + '</p>';if (printTime) {
                op += '<p class="timePosted">' + times[n].textContent + '</p>';
              }
            } else {
              if (printUser) {
                op += '<p class="user">' + authors[n].textContent + '</p>';
              }
              op += '<p class="tweet">' + tweets[n].textContent + '</p>';if (printTime) {
                op += '<p class="timePosted">' + times[n].textContent + '</p>';
              }
            }
          }
          if (showInteractionLinks) {
            op += '<p class="interact"><a href="https://twitter.com/intent/' + 'tweet?in_reply_to=' + tids[n] + '" class="twitter_reply_icon"' + (targetBlank ? ' target="_blank">' : '>') + 'Reply</a><a href="https://twitter.com/intent/retweet?' + 'tweet_id=' + tids[n] + '" class="twitter_retweet_icon"' + (targetBlank ? ' target="_blank">' : '>') + 'Retweet</a>' + '<a href="https://twitter.com/intent/favorite?tweet_id=' + tids[n] + '" class="twitter_fav_icon"' + (targetBlank ? ' target="_blank">' : '>') + 'Favorite</a></p>';
          }
          if (showImages && images[n] !== undefined && extractImageUrl(images[n]) !== undefined) {
            op += '<div class="media">' + '<img src="' + extractImageUrl(images[n]) + '" alt="Image from tweet" />' + '</div>';
          }
          if (showImages) {
            arrayTweets.push(op);
          } else if (!showImages && tweets[n].textContent.length) {
            arrayTweets.push(op);
          }
          n++;
        }
      }
      handleTweets(arrayTweets);inProgress = false;if (queue.length > 0) {
        twitterFetcher.fetch(queue[0]);queue.splice(0, 1);
      }
    } };window.__twttrf = twitterFetcher;window.twitterFetcher = twitterFetcher;return twitterFetcher;
});

/***/ })
/******/ ]);
