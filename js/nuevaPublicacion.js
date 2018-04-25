function initMap() {
    var myLatlng = {lat: -34.8970102, lng: -56.1736188};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: myLatlng
    });


    var marker;

    google.maps.event.addListener(map, "click", function (e) {
        var latLng = e.latLng;
        $("#latitud").val(latLng.lat());
        $("#longitud").val(latLng.lng());

        if (marker == null) {
            marker = new google.maps.Marker({
                position: latLng,
                map: map
            }); 
        } else {
            marker.setPosition(latLng); 
        }
    });
}

function especieSeleccionada() {
    $.ajax({
        url: "ajax.php",
        data: "accion=cargar-razas&especie="+$("#especie").val(),
        dataType: 'json',
        type: 'POST'
    }).done(function(data){
        var select = $("#raza").empty();
        for(var i=0;i<data.length;i++) {
            var option = $("<option />");
            option.attr("value", data[i].id);
            option.html(data[i].nombre);
            select.append(option);
        }

    });
}

$(document).ready(function() {
    especieSeleccionada();
    $("#especie").change(function(){
        especieSeleccionada()
    });
    $('.masImagenes').click(function(e){
        e.preventDefault();
        $(this).before("<input name='img[]' type='file'/> <br >");
    });
    $('.cancelar').click(function(e){
        $(location).attr('href','index.php');
    });
});