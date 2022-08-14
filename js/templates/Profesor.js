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

function fn_editar_profesor(id){
  $.ajax({
        type: "POST",
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?idProfesor='+id,
        success: function(data) {
          $("#renderbody").empty();
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error editando datos</div>');
        }
      });
}

function PostUpdateProfesor() {
const input_id= document.getElementById('txtIdProfesor').value;
const input_usuario= document.getElementById('txtusuario').value;
const input_clave= document.getElementById('txtpass').value;
const input_nombre= document.getElementById('txtnombre').value;
const input_apellidos= document.getElementById('txtap').value;
const input_email= document.getElementById('txtemail').value;
const input_especialista= 0;
console.log(input_usuario);
debugger;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Profesor.php?id=${input_id}&login=${input_usuario}&clave=${input_clave}&nombre=${input_nombre}&apellidos=${input_apellidos}&email=${input_email}&especialista=0`,
    data: {},
    success: (data) => {
    console.log(data);
    fn_listar_profesor();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
