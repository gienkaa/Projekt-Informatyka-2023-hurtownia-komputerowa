$(document).ready(function() {
    var $firstSlide = $('.carousel li').first(),
      $lastSlide = $('.carousel li').last(),
      $slideWidth = $('.carousel-container').width(),
      $numOfSlides = $('.carousel li').length;
    $('.carousel-container').after('<ul class="thumbnails"></ul>');
  
    $('.carousel li').each(function(index) {
      $this = $(this);
      $this.addClass('slide-' + index);
      $this.clone().appendTo('.thumbnails');
    });
  
    function slideResize() {
      $slideWidth = $('.carousel-container').width();
      $('.carousel li').css('width', $slideWidth);
      $('.arrows').css('height', '100%');
    }
    
    $('.thumbnails li').first().addClass('active');
    slideResize();
  
    $firstSlide.addClass('active');
    $lastSlide.insertBefore($firstSlide);
  
    $('.carousel').css('margin-left', '-100%');
  
    $(window).on('resize', slideResize);
    
    function nextSlide(interval, iterations) {
      var howMany = 0;
  
      function goNext() {
        $firstSlide = $('.carousel li').first();
        $lastSlide = $('.carousel li').last();
        
        slideResize();
        $('.arrows').hide();
        $firstSlide.animate({
          width: "0"
        }, interval, function() {
  
          $firstSlide.insertAfter($lastSlide);
          $firstSlide.css('width', $slideWidth);
  
          $('.carousel li.active').next('li').addClass('active');
          $('.carousel li.active').first().removeClass('active');
  
          if ($('.thumbnails li').last().hasClass('active')) {
            $('.thumbnails li').removeClass('active');
            $('.thumbnails li').first().addClass('active');
          } else {
            $('.thumbnails li.active').next('li').addClass('active');
            $('.thumbnails li.active').first().removeClass('active');
          }
          howMany++;
          if (howMany < iterations) {
            goNext();
          } else {
          $('.arrows').show();
          }
        });
      }
      goNext();
    }
  
    function prevSlide(interval, iterations) {
      var howMany = 0;
  
      function goPrev() {
        $firstSlide = $('.carousel li').first();
        $lastSlide = $('.carousel li').last();
        
        slideResize();
        $('.arrows').hide();
        var $prevSlide = $('.active').prev();
        $lastSlide.css('width', '0');
        $lastSlide.insertBefore($firstSlide);
        $lastSlide.animate({
          width: $slideWidth
        }, interval, function() {
          $('.carousel li.active').prev('li').addClass('active');
          $('.carousel li.active').last().removeClass('active');
  
          if ($('.thumbnails li').first().hasClass('active')) {
            $('.thumbnails li').removeClass('active');
            $('.thumbnails li').last().addClass('active');
          } else {
            $('.thumbnails li.active').prev('li').addClass('active');
            $('.thumbnails li.active').last().removeClass('active');
          }
          howMany++;
          if (howMany < iterations) {
            goPrev();
          } else {
          $('.arrows').show();
          }
        });
      }
      goPrev();
    }
      $('.carousel-container').on('swipeleft', function() {
        if ($('li:animated').length === 0) {
      nextSlide(1000);
        } else {
          return;
        }
    });
  
    $('.carousel-container').on('swiperight', function() {
      if ($('li:animated').length === 0) {
      prevSlide(1000);
      } else {
        return;
      }
    });
    
    $('.r-arrow').on('click', function() {
      nextSlide(1000);
    });
  
    $('.l-arrow').on('click', function() {
      prevSlide(1000);
    });
  
    $('body').on('click', '.thumbnails li', function() {
  
      var $this = $(this),
        $desiredSlideIndex = $this.index(),
        $currentSlideIndex = $('ul.thumbnails li.active').index(),
        slideDifference = $desiredSlideIndex - $currentSlideIndex;
  
      console.log('desired slide: ' + $desiredSlideIndex);
      console.log('current slide: ' + $currentSlideIndex);
      console.log('slide difference: ' + slideDifference);
      if (slideDifference > 0) {
        nextSlide(500, slideDifference);
      } else if (slideDifference < 0) {
        slideDifference = slideDifference * -1;  
        prevSlide(500, slideDifference);
      } else {
        return;
      }
    });
  
  });
  