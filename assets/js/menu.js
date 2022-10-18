
//Abrir carrito
$( '.user-link-photo' ).on( 'click', function () {
  $( '.close-session' ).toggleClass( 'open' );
} );


//Abrir menu
$( '#open-menu-mobile' ).on( 'click', function () {
  console.log('abrir');
  $( '.menu-mobile' ).addClass( 'open' );
} );

$( '#close-menu-mobile' ).on( 'click', function () {
  $( '.menu-mobile' ).removeClass( 'open' );
} );


//Al hacer scroll el menu se hace mas pequeño
jQuery(window).scroll(function() {

  let altura = jQuery(window).scrollTop();
  let altura_navegacion = jQuery('.menu-section').height();

  if(!jQuery('.menu-section').hasClass('scroll') && altura > altura_navegacion){
    jQuery('.menu-section').toggleClass('scroll');
  }
  
  if(jQuery('.menu-section').hasClass('scroll')  && altura <= altura_navegacion){
    jQuery('.menu-section').toggleClass('scroll');
  }
  
});
