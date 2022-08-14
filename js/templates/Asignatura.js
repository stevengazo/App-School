function fn_listar_asig(){
  $.ajax({
      type: "GET",
      url: 'http://localhost/app_School/WebService/ws_Asignatura.php?tipo=listaHtml',
      success: function(data) {
          $("#renderbody").html(data);
      },
      error: function(error) {
          $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
      }
    });
}

function fn_borrar_asig(id ){
  $.ajax({
        type: "DELETE",
        url: 'http://localhost/app_School/WebService/ws_Asignatura.php?id='+id ,
        success: function(data) {
        fn_listar_asig();
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}

function fn_editar_asignatura(id){
  $.ajax({
        type: "POST",
        url: 'http://localhost/app_School/WebService/ws_Asignatura.php?id='+id,
        success: function(data) {
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}

function PostUpdateAsignatura() {
const input_id= document.getElementById('txtIdAsig').value;
const input_nivel= document.getElementById('txtnivel').value;
const input_profesor= document.getElementById('txtprof').value;
const input_nombre= document.getElementById('txtnombre').value;


  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Asignatura.php?id=${input_id}&nivel_id=${input_nivel}&profesor_id=${input_profesor}&nombre=${input_nombre}`,
    data: {},
    success: (data) => {
    fn_listar_asig();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
