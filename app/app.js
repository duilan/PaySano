// FUNCION PARA CREAR LOS PRODUCTOS
function carga_productos(){
    var nombre,
    description,
    precio,
    imagen;

    var datalength = 0,
    productos_html = "";
    //YOUR REMOTE API URL OR LOCAL
    var API = 'http://paysano.hol.es/api/productos';
    $.ajax({
        url: API ,
        type: 'GET',
        dataType: 'json'
    })
    .done(function(data) {
        //Se hace la iteracion de cada objeto en el array de datos
        for (var i = data.length - 1; i >= 0; i--) {
            productos_html+=  '<div class="col-md-6 col-xs-12 col-sm-12 col-lg-4  gallery-grid glry-one animated zoomIn"> \
            <!-- <a href="http://paysano.hol.es/api/productos/'+ data[i].id_producto +'"> --> \
            <img src="images/'+ data[i].imagen+'" class="img-responsive" alt=""/> \
            </a> \
            <div class="gallery-info"> \
            <p>'+data[i].descripcion+'</p> \
            <div class="clearfix"> </div> \
            </div> \
            <div class="galy-info"> \
            <div class="galry"> \
            <div class="description"> \
            <p>'+data[i].nombre+'</p> \
            </div> \
            <div class="prices"> \
            <h5 class="item_price">$'+data[i].precio+'</h5> \
            </div> \
            <div class="clearfix"></div> \
            </div> \
            </div> \
            </div> \
            ';
        };
        $('#contenedor_productos').html('');
        $('#contenedor_productos').html(productos_html);
    })
    .fail(function(data) {
        console.log(data);
    });
}
