$(document ).ready(function() {


  $(window).on('load', function () {
      $("#splash").fadeOut('swing');
    });
  

  $(window).scroll(function(){

    //Menu sticky
    var sticky = $('.sticky'),
    scroll = $(window).scrollTop();
      if (scroll >= 907){
          sticky.addClass('fixed');
        } else { sticky.removeClass('fixed');}

        

    //Changement couleurs des liens au scroll 
    var color1 = $('.color1');
    var color2 = $('.color2');
    var color3 = $('.color3');
    var color4 = $('.color4');
    var color5 = $('.color5'),
  
    scroll_color = $(window).scrollTop();
    if ((scroll_color > 900) & (scroll_color < 2400)){color1.addClass('colour');}
        else color1.removeClass('colour');
    if ((scroll_color > 2400) & (scroll_color < 3300)){color2.addClass('colour');}
        else color2.removeClass('colour');
    if ((scroll_color > 3300) & (scroll_color < 4000)){color3.addClass('colour');}
        else color3.removeClass('colour');
    if ((scroll_color > 4000) & (scroll_color < 4500)){color4.addClass('colour');}
        else color4.removeClass('colour');
    if (scroll_color > 4500){color5.addClass('colour');}
        else color5.removeClass('colour');
    });

    //Animation texte 'typing'
    $("[data-typer]").attr("data-typer", function(i, txt) {

        var $typer = $(this),
          tot = txt.length,
          pauseMax = 300,
          pauseMin = 60,
          ch = 0;
      
        (function typeIt() {
          if (ch > tot) return;
          $typer.text(txt.substring(0, ch++));
          setTimeout(typeIt, ~~(Math.random() * (pauseMax - pauseMin + 1) + pauseMin));
        }());
      
      });

    //Animation flèches
    $('.fleches').delay(3000).fadeIn('swing');
    $('a.slideshow_arr').on('click', function() {
      $('html, body').animate({'scrollTop': $('.en-tete').innerHeight() });
    });

    //Animation barres compétences
    var skillsDiv = jQuery('#skills');

    jQuery(window).on('scroll', function() {
      var winT = jQuery(window).scrollTop(),
        winH = jQuery(window).height(),
        skillsT = skillsDiv.offset().top;
      if (winT + winH > skillsT) {
        jQuery('.skillbar').each(function() {
          jQuery(this).find('.skillbar-bar').animate({
            width: jQuery(this).attr('data-percent')
          }, 1000);
        });
      }
    });
});


