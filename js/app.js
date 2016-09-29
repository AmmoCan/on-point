$(document).foundation();

// Smooth scroll onClick
$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});

// Anchor highlighting on scroll
var sections = $('.skroll');
var nav = $('nav');
var nav_height = nav.outerHeight();

$(window).on('scroll', function () {
  var cur_pos = $(this).scrollTop();
  var docElement = $(document)[0].documentElement;
  var winElement = $(window)[0];
  
  sections.each(function() {
    var top = $(this).offset().top - nav_height;
    var bottom = top + $(this).outerHeight();
    // Check if section is at the top,
    // if so remove highlight from previous anchor and add highlight to that anchor
    if (cur_pos >= top && cur_pos <= bottom) {
      nav.find('a').removeClass('nav-active');
      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('nav-active');
    }
    // Check if user has scrolled to the bottom,
    // if so add anchor highlighting to last anchor
    if ((docElement.scrollHeight - winElement.innerHeight) === winElement.pageYOffset) {
      nav.find('a').removeClass('nav-active');
      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('nav-active');
    }
  });
  
});