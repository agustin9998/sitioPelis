var pagina = 1;
var pelicula;
function cargar() {
    pelicula = $("#idPelicula").val();

    $.ajax({
        url: "comentariosPag.php",
        data: {
            pagina: pagina,
            id_pelicula: pelicula
        },
        dataType: "html"
    }).done(function (resp) {
        $("#comPag").html(resp);

        $("#anterior").click(function () {
            pagina--;
            cargar();
        });

        $("#siguiente").click(function () { 
            pagina++;
            cargar();
        });
        
    }).fail(function () {
        alert("error al cargar la pagina");
    });
}

$(document).ready(function () {
    cargar();
});