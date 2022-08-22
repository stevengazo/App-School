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
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error editando datos</div>');
        }
      });
}

function PostUpdateNivel() {
const input_id= document.getElementById('txtIdNivel').value;
const input_nivel= document.getElementById('txtnivel').value;
const input_curso= document.getElementById('txtcurso').value;
const input_aula= document.getElementById('txtaula').value;
console.log(input_id);
debugger;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Nivel.php?id=${input_id}&nivel=${input_nivel}&curso=${input_curso}&AULA=${input_aula}`,
    data: {},
    success: (data) => {
    console.log(data);
    fn_listar_nivel();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
