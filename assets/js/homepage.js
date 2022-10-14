

const swiper = new Swiper('.swiper.swiper-hero', {
  slidesPerView: 'auto',
  spaceBetween: 10,
  loop:true,
  autoplay: {
    delay: 3000,
  },
  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});


jQuery('.anchor').click(function (e) {
  var puntero = $(this).data('content');
  var distancia = $('div[id^="' + puntero + '"]').offset();
  e.preventDefault();
  
  if ($(this).data('go-to-content') !== "all") {
    $('body,html').animate({
      scrollTop: distancia.top - 60 + 'px'
    }, 600);
  }
});
