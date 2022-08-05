/**
 * Trae elementos html a mostrar
 */
 function ViewLista() {
    alert("ViewLista");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
   * Muestra un Horarios en especifico
   */
  function ViewHorarios(idHorarios) {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
   * Trae vista para insertar Horarios
   */
  function GetInsertHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
   * Envia un Horarios a la DB y trae la vista ViewHorarios si lo agrega
   */
  function PostInsertHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
  function GetUpdateHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
  function PostUpdateHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
  function GetDeleteHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
  function PostDeleteHorarios() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Horarios.php",
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
  