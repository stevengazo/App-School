function fn_listar_profesor(){
  $.ajax({
        type: "GET",
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?accion=listar',
        success: function(data) {
            $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}

function fn_borrar_profesor(id){
  $.ajax({
        type: "DELETE",
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?idProfesor='+id,
        success: function(data) {
        fn_listar_profesor();
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}

function fn_editar_profesor(id){ debugger;
  $.ajax({
        type: "POST",
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?idProfesor='+id,
        success: function(data) {
        $("#renderbody").html(data);
        },
        error: function(error) { debugger;
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}
