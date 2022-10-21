jQuery(function() {

  function Utils() { }
  
  Utils.prototype = {
      constructor: Utils,
      isElementInView: function (element, fullyInView) {
        var pageTop = $(window).scrollTop();
        var pageBottom = pageTop + $(window).height();
        var elementTop = $(element).offset().top;
        var elementBottom = elementTop + $(element).height();

        if (fullyInView === true) {
            return ((pageTop < elementTop) && (pageBottom > elementBottom));
        } else {
            return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
        }
      }
  };
  
  var Utils = new Utils();

  var amount = 0;
  var lastScrollTop = 0;
  jQuery(window).scroll(function(event) {
    
    var isElementInView = Utils.isElementInView( jQuery('#moving-brands'), false );
    
    if( jQuery(window).width() > 1024 ){
      if (isElementInView) {
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
          amount += 5;
          $("#moving-brands").css( 'transform', 'translateX(' + amount + 'px)' );
        } else {
          amount -= 5;
          $("#moving-brands").css( 'transform', 'translateX(' + amount + 'px)' );
        }
        lastScrollTop = st;
      } else {
        $("#moving-brands").css( 'transform', 'translateX(' + amount + 'px)' );
      }
    }
    
      
  });

});