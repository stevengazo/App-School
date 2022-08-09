function fn_listar_nivel(){
  $.ajax({
        type: "GET",
        url: 'http://localhost/app_School/WebService/ws_Nivel.php?accion=listar',
        success: function(data) {
            $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}

function fn_borrar_nivel(id){
  $.ajax({
        type: "DELETE",
        url: 'http://localhost/app_School/WebService/ws_Nivel.php?idNivel='+id,
        success: function(data) {
          fn_listar_nivel();
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}

function fn_editar_nivel(id){

  $.ajax({
        type: "POST",
        url: 'http://localhost/app_School/WebService/ws_Nivel.php?idNivel='+id,
        success: function(data) {
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}
