

/**
 * Trae elementos html a mostrar
 */
 function ViewLista() {
  alert("ViewLista");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * Muestra un Asignatura en especifico
 */
function ViewAsignatura(idAsignatura) {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * Trae vista para insertar Asignatura
 */
function GetInsertAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}
/**
 * Envia un Asignatura a la DB y trae la vista ViewAsignatura si lo agrega
 */
function PostInsertAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * Trae vista para modificar
 */
function GetUpdateAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * Envia vista modifiada
 */
function PostUpdateAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * modificar
 */
function GetDeleteAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

/**
 * confirma la eliminación
 */
function PostDeleteAsignatura() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
        $("#renderbody").empty();
        $("#renderbody").html(error);
        console.error(error);
    },
  });
}

function fn_listar_asig(){
  $.ajax({
      type: "GET",
      url: 'http://localhost/app_School/WebService/ws_Asignatura.php?accion=listar',
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
        url: `http://localhost/app_School/WebService/ws_Asignatura.php?id=${id}`,
        success: function(data) {
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });

}
