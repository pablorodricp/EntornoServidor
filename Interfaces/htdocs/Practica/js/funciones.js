function anadido(value) {

    $.ajax({
        data: {producto : value},
        url:   'php/ajax/anadirProducto.php',
        method:  'POST',
        success:  function () {
            alert("Producto añadido");
        }
    });
};

function anadir(value) {

  
    var url = 'ajax/actualizarProducto.php';

    $.ajax({
        data: {anadir:value},
        url: url,
        method: 'POST',

        success: function() {
            $.get("carrito.php", function(data, status){
            $(".contenido").html(data);
            });
        }
    });
};

function reducir(value) {

    $.ajax({
        data: {reducir:value},
        url : 'ajax/reducirProducto.php',
        method : 'POST',
        success: function() {
            $.get("carrito.php", function(data, status){
            $(".contenido").html(data);
            });
        }
    })
}

function eliminado(value) {
    
    $.ajax({
        data: {quita:value},
        url : 'ajax/quitarProducto.php',
        method : 'POST',
        success: function() {
            $.get("carrito.php", function(data, status){
            $(".contenido").html(data);
            alert("Producto eliminado");
            });
        }
    })
}
    


$( document ).ready(function() {
    console.log( "listo!" );

    function func1(){
        $('div').css('backgroundColor', 'black');    
        setTimeout( func1 , 1 );
    }

    function func2(){
        $('div').css('backgroundColor', 'white');    
        setTimeout( func2 , 2000 );
    }

    //setTimeout( func1 , 1000 );
    //setTimeout( func2 , 2000 );

});




