
function especieSeleccionada() {
    $.ajax({
        url: "ajax.php",
        data: "accion=cargar-razas&especie="+$("#especie").val(),
        dataType: 'json',
        type: 'POST'
    }).done(function(data){
        var select = $("#raza").empty();
        var option_vacia = $("<option />");
        option_vacia.attr("value", -1);
        option_vacia.html('');
        select.append(option_vacia);
        for(var i=0;i<data.length;i++) {
            var option = $("<option />");
            option.attr("value", data[i].id);
            option.html(data[i].nombre);
            select.append(option);
        }
    });
}

function search() {
    var pagina = $(".paginationPage").val(1);
    $(".anterior").attr("disabled", true);

    $(".cargaInicial").val(0);

    $(".savedEspecie").val($("#especie").val());
    if($(".savedEspecie").val() == -1) {
        $(".savedEspecie").val("");
    }

    $(".savedRaza").val($("#raza").val());
    if($(".savedRaza").val() == -1) {
        $(".savedRaza").val("");
    }

    $(".savedBarrio").val($("#barrio").val());
    if($(".savedBarrio").val() == -1) {
        $(".savedBarrio").val("");
    }
    
    $(".savedText").val($("#searchText").val());

    $(".savedEstado").val($("#searchEstado").val());
    if($(".savedEstado").val() == -1) {
        $(".savedEstado").val("");
    }

    mostrarPublicaciones();
}

function mostrarPublicaciones() {
    if($(".cargaInicial").val() == 1) {
        $.ajax({
            url: "ajax.php",
            dataType: 'json',
            type: 'POST',
            data: 'accion=allPublicaciones'
        }).done(function(data){
            print(data);
        });
    } else {
        $.ajax({
            url: "ajax.php",
            data: "accion=realizar-busqueda&especie="+$(".savedEspecie").val()+"&raza="+$(".savedRaza").val()+
            "&barrio="+$(".savedBarrio").val()+"&searchText="+$(".savedText").val()+"&estado="+$(".savedEstado").val(),
            dataType: 'json',
            type: 'POST'
        }).done(function(data){
            print(data);
        });
    }
}

function print(data) {
    var elementos = data.length;

    var pub = $("#publicaciones").empty();
    var table = $("<table />");

    var show = $(".paginationValue").val();
    var pagina = $(".paginationPage").val();
    if(pagina == 1) {
        $(".anterior").attr("disabled", true);
        $(".primera").attr("disabled", true);
    } else {
        $(".anterior").attr("disabled", false);
        $(".primera").attr("disabled", false);
    }

    var inicio = (pagina-1)*show;
    var ultimo = pagina * show;
    if (show == -1) {
        ultimo = elementos;
        inicio = 0;
        $(".siguiente").attr("disabled", true);
        $(".ultima").attr("disabled", true);
    } else if (elementos <= ultimo) {
        ultimo = elementos;
        $(".siguiente").attr("disabled", true);
        $(".ultima").attr("disabled", true);
    } else {
        $(".siguiente").attr("disabled", false);
        $(".ultima").attr("disabled", false);
    }

    for (var i=inicio;i<ultimo;i++){
        var option = $("<tr />");
        var span = $("<span />");
        span.attr('class', 'itemPublicacion');

        var img = $("<img />");

        var fotos = $(".carpetaFotos").val();
        img.attr('src', fotos+"/"+data[i].id+"/0.png");
        span.append(img)

        var link = $("<a />");
        link.attr('href', './publicacion.php?id='+data[i].id);
        link.attr('target', '_blank');
        link.html(data[i].titulo);

        var spanTxt = $("<span />");
        spanTxt.attr('class', 'txtPublicacion');

        spanTxt.append(link);

        spanTxt.append("</br>"+data[i].descripcion.substring(0,149));
        if (data[i].descripcion.length > 150) {
            spanTxt.append("...");
        }

        var tipo = $("<p />");
        if(data[i].tipo == 'E') {
            tipo.attr('class', 'encontrada');
            tipo.append("ENCONTRADA");
        } else {
            tipo.attr('class', 'perdida');
            tipo.append("PERDIDA");
        }
        spanTxt.append(tipo);

        span.append(spanTxt);

        option.append(span);
        table.append(option);
    }
    pub.append(table);

    if(show != -1) {
        var maxPaginas = Math.ceil(elementos/show);
        $(".totalPages").val(maxPaginas);
        $(".paginado").html($(".paginationPage").val()+"/"+maxPaginas);
    } else {
        $(".paginado").html("1/1");
    }
}

function updateButtons() {
    $(".pagination10").prop("disabled", $(".paginationValue").val()==10);
    $(".pagination20").prop("disabled", $(".paginationValue").val()==20);
    $(".pagination50").prop("disabled", $(".paginationValue").val()==50);
    $(".paginationAll").prop("disabled", $(".paginationValue").val()==-1);
}

$(document).ready(function() {
    $("#especie").change(function(){
        especieSeleccionada()
    });
    $("#button").click(function(){
        search();
    });
    $(".siguiente").click(function(){
        var pagina = $(".paginationPage").val();
        $(".paginationPage").val(parseInt(pagina)+1);
        mostrarPublicaciones();
    });
    $(".anterior").click(function(){
        var pagina = $(".paginationPage").val();
        $(".paginationPage").val(parseInt(pagina)-1);
        mostrarPublicaciones();
    });
    $(".primera").click(function(){
        $(".paginationPage").val(1);
        mostrarPublicaciones();
    });
    $(".ultima").click(function(){
        $(".paginationPage").val($(".totalPages").val());
        mostrarPublicaciones();
    });

    $(".pagination10").click(function(){
        $(".paginationValue").val(10);
        $(".paginationPage").val(1);
        updateButtons();
        mostrarPublicaciones();
    });

    $(".pagination20").click(function(){
        $(".paginationValue").val(20);
        $(".paginationPage").val(1);
        updateButtons();
        mostrarPublicaciones();
    });

    $(".pagination50").click(function(){
        $(".paginationValue").val(50);
        $(".paginationPage").val(1);
        updateButtons();
        mostrarPublicaciones();
    });

    $(".paginationAll").click(function(){
        $(".paginationValue").val(-1);
        $(".paginationPage").val(1);
        updateButtons();
        mostrarPublicaciones();
    });
    
    mostrarPublicaciones()
 });
