$(document).ready(function() {
    /*Funcion para enviar datos de formularios con ajax*/
    $('.FormCatElec').submit(function(e){
        e.preventDefault();
        var data=$(this).serialize(); 
        var type=$(this).attr('method');
        var url=$(this).attr('action');
        var formType=$(this).attr('data-form');
        if(formType=="login"){
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend: function(){
                    $(".ResForm").html('Iniciando sesión<br><img src="assets/img/loading.gif" class="center-all-contens">');
                },
                error: function() {
                    $(".ResForm").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResForm").html(data);
                }
            });
            return false;
        }else{
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend: function(){
                    $(".ResForm").html('Procesando... <br><img src="assets/img/enviando.gif" class="center-all-contens">');
                },
                error: function() {
                    $(".ResForm").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResForm").html(data);
                }
            });
            return false;
        }
    });
});
