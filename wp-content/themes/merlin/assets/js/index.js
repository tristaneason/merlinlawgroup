//import 'jquery';
require ('../scss/style.scss'); //require stylesheet

// vendors
require('./nav.js'); //main, dropdown, & mobile navigation
require('./attorney.js'); //attorney directory filtering
require('./latest-tweet.js'); //homepage resource twitter api
require('./carousel.js'); //carousel & testimonial module
require('./accordion.js'); //accordion module

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
var img_longterm= $('#link-longterm');
var img_longterm_src = template_dir + '/assets/img/img-longterm.jpg';

$(img_res).on({
    mouseenter: function () {
      img_el.attr('src', img_res_src);
      $(this).addClass('active');
    },
    mouseleave: function () {
      img_el.attr('src', img_res_src);
      $(this).removeClass('active');
    },
});
$(img_comm).on({
    mouseenter: function () {
      img_el.attr('src', img_comm_src);
      $(this).addClass('active');
    },
    mouseleave: function () {
      img_el.attr('src', img_res_src);
      $(this).removeClass('active');
    },
});
$(img_health).on({
    mouseenter: function () {
      img_el.attr('src', img_health_src);
      $(this).addClass('active');
    },
    mouseleave: function () {
      img_el.attr('src', img_res_src);
      $(this).removeClass('active');
    },
});
$(img_disability).on({
    mouseenter: function () {
      img_el.attr('src', img_disability_src);
      $(this).addClass('active');
    },
    mouseleave: function () {
      img_el.attr('src', img_res_src);
      $(this).removeClass('active');
    },
});
$(img_longterm).on({
    mouseenter: function () {
      img_el.attr('src', img_longterm_src);
      $(this).addClass('active');
    },
    mouseleave: function () {
      img_el.attr('src', img_res_src);
      $(this).removeClass('active');
    },
});


// Scrolling for anchor links// scroll on click of anchor link (a href="#")
$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 100
        }, 900);
        return false;
      }
    }
  });
});
