
/**
 * Swiper hero
 */
const swiper = new Swiper('.swiper.swiper-hero', {
  slidesPerView: 'auto',
  spaceBetween: 10,
  // loop:true,
  autoplay: {
    delay: 3000,
  },
  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

/**
 * Swiper productos home
 */
const swiper_home_products = new Swiper('.swiper.swiper-home-product', {
  slidesPerView: 4,
  spaceBetween: 25,
  loop:true,
  autoplay: {
    delay: 3000,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
      spaceBetween: 10
    },
    430: {
      slidesPerView: 2,
      spaceBetween: 15
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 20
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 20
    }
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
