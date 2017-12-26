(function ($) {
    $(window).scroll(function () {
        
      if ($(window).scrollTop() > 0) {
          $('.navbar').removeClass('navbar-fat');
      } else {
          $('.navbar').addClass('navbar-fat');
          
      }
      $('.jumbotron').css({
   //       'background-position': '0pt ' + ($(window).scrollTop() * 0.2) + 'pt'
      })
     
  }); 
  $(window).on('load', function () {
      var $body = $('.body');
      $('.body').fadeIn(100);
      $('#spinner').fadeOut();
  });
  function performPageTransition(href) {
      $('#spinner').fadeIn();
      
      $(document.body).fadeOut(500, function () {
          window.location = href;
      });
  }
  $(document).on('click', 'a', function (e) {
        if (e.target.getAttribute('href') != null && e.target.getAttribute('href').length > 0 && e.target.getAttribute('href').indexOf('#') != 0) {
         e.preventDefault();
        
        performPageTransition(e.target.getAttribute('href'));
        }
    });

}(jQuery));