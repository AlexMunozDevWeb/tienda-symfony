
//Abrir carrito
$( '.cart-icon-container' ).on( 'click', function () {
  $( '.cart-content' ).toggleClass( 'open' );
} );

//Cerrar carrito cuando se pincha fuera
$('body').on('click',function(event){
  if( $(event.target ).is( '.cart-content' ) || $( event.target ).is( '.cart-icon-container' ) || $( event.target ).is( '.icon-cart' ) 
      || $( event.target ).is( '.quantity' ) ){
  }else{
    $( '.cart-content' ).removeClass( 'open' );
  }
});

//Abrir menu
$( '#open-menu-mobile' ).on( 'click', function () {
  console.log('abrir');
  $( '.menu-mobile' ).addClass( 'open' );
} );

$( '#close-menu-mobile' ).on( 'click', function () {
  $( '.menu-mobile' ).removeClass( 'open' );
} );
