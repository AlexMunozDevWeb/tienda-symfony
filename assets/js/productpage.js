
const swiper = new Swiper('.swiper.swiper-single-product', {
  slidesPerView: 4,
  spaceBetween: 25,
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

$('#quantity').on('keyup', function () {
  var max_value = parseInt($( '#quantity' ).attr( 'max' ));
  var quantity = parseInt($('#quantity').val()); 
  if ( quantity > max_value ) {
    $('#quantity').val( max_value );
  }
  if ( quantity < 0 ) {
    $('#quantity').val( 0 );
  }
  if ( quantity == '' ) {
    $('#quantity').val( 1 );
  }
})

$('#minus').on('click', function () {
  if ( $('#quantity').val() > 0 ) {
    $('#quantity').val( $('#quantity').val() - 1 );
  }
})

$('#sum').on('click', function () {
  var max_value = parseInt($( '#quantity' ).attr( 'max' ));
  var quantity = parseInt($('#quantity').val()); 
  if ( quantity >= 0 && quantity < max_value ) {
    quantity++;
    $('#quantity').val( quantity );
  }
})
