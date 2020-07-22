// Nav.js
// Mobile nav
var breakpoint = 992; //$md var

$(document).ready(function() {
  var trigger = $('#js-nav-toggle');
  var isClosed = false;
  trigger.click(function() {
    $('#js-nav-mobile').toggleClass('nav-open');
    $('body').toggleClass('nav-open');
    $('#js-nav-toggle').toggleClass('active');
  });
});





// Desktop Drop down nav
var nav_parent = $('.nav-primary li.menu-item-has-children:has(ul)');

nav_parent.on({
  mouseenter: function() {
    if ($(window).width() >= breakpoint) {
      $('body').addClass('nav-dropdown-open');
      $('.nav-dropdown').addClass('active');
      $(this).find('ul.sub-menu').addClass('active-flex-wrap');
    }
  }
});
nav_parent.on({
  mouseleave: function() {
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
  mouseover: function() {
    $('body').addClass('nav-dropdown-open');
    $('.nav-dropdown').addClass('active');
    $('.search-wrap').addClass('active');
    $('.search-field').focus();
  }
});
search_icon.on({
  mouseleave: function() {
    $('body').removeClass('nav-dropdown-open');
    $('.nav-dropdown').removeClass('active');
    $('.search-wrap').removeClass('active');
  }
});

// Mobile Nav
var parent = $('.nav-mobile li.menu-item-has-children:has(ul)');
parent.append('<i></i>');
parent.on('click', function(e) {
  e.preventDefault();
  $(this).find('ul > li').toggle();
  $(this).find('i').toggleClass('is-open');
});

var child = $('.nav-mobile li.menu-item-has-children:has(ul)').find('ul > li');
child.on('click', function(e) {
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
