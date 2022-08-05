/**
 * Trae elementos html a mostrar
 */
 function ViewListaAusencia() {  
  /* AUSENCIA LSITA */
  const title = document.createElement("h2").innerText= "Lista Ausencias";
  alert("ViewListaMethods");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
      data: {},      
      success: (data) => {        
        $("#renderbody").empty();
        $("#renderbody").append(title);
        for (let index = 0; index < data.length; index++) {
          var tmp = JSON.stringify(data[index]);
          $("#renderbody").append(tmp);
          console.log(data[index]);
        }
        
        //$("#renderbody").html(data);
        
      },
      error: (error) => {
          console.log("erroor");
          $("#renderbody").empty();        
          $("#renderbody").html(error);
          console.error(error);
      },
    });
  }
  
  /**
   * Muestra un FaltaAsistencia en especifico
   */
  function ViewFaltaAsistencia(idFaltaAsistencia) {
    alert("View");    
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
      data: {},
      success: (data) => {
        console.log("sucess");
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
   * Trae vista para insertar FaltaAsistencia
   */
  function GetInsertFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
   * Envia un FaltaAsistencia a la DB y trae la vista ViewFaltaAsistencia si lo agrega
   */
  function PostInsertFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
  function GetUpdateFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
  function PostUpdateFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
  function GetDeleteFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
  function PostDeleteFaltaAsistencia() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
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
  