function verAlumno(id){
  prompt(id);
}




function fn_listar_alumnos(){
  $.ajax({
        type: "GET",
        url: 'http://localhost/app_School/WebService/ws_Alumno.php?tipo=lista',
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
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error editando datos</div>');
        }
      });

}

function UpdateAlumno() {
const input_id= document.getElementById('txtIdAlumno').value;
const input_nivel= document.getElementById('txtnivelid').value;
const input_login= document.getElementById('txtlogin').value;
const input_clave= document.getElementById('txtpass').value;
const input_nombre= document.getElementById('txtnombre').value;
const input_apellidos= document.getElementById('txtapellido').value;
console.log(input_id);
debugger;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Alumno.php?id=${input_id}&nivel_id=${input_nivel}&login=${input_login}&clave=${input_clave}&nombre=${input_nombre}&apellidos=${input_apellidos}`,
    data: {},
    success: (data) => {
    console.log(data);
    debugger;
    fn_listar_alumnos();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
