function fn_listar_alumnos(){
  $.ajax({
        type: "GET",
        url: 'http://localhost/app_School/WebService/ws_Alumno.php?accion=listar',
        success: function(data) {
            $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}

function fn_borrar_alumno(id){
  $.ajax({
        type: "DELETE",
        url: 'http://localhost/app_School/WebService/ws_Alumno.php?idAlumno='+id,
        success: function(data) {
          fn_listar_alumnos();
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}

function fn_editar_alumno(id){
  $.ajax({
        type: "POST",
        url: 'http://localhost/app_School/WebService/ws_Alumno.php?idAlumno='+id,
        success: function(data) {
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}
