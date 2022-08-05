/**
 * Trae elementos html a mostrar
 */

function ViewLista() {
  alert("ViewLista");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
 * Muestra un administrador en especifico
 */
function ViewAdministrador(idAdministrador) {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
 * Trae vista para insertar administrador
 */
function GetInsertAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
 * Envia un administrador a la DB y trae la vista ViewAdministrador si lo agrega
 */
function PostInsertAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
function GetUpdateAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
function PostUpdateAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
function GetDeleteAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
function PostDeleteAdministrador() {
  alert("View");
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Administradores.php",
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
