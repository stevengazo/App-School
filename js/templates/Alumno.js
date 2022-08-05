/**
 * Trae elementos html a mostrar
 */
 function ViewLista() {
    alert("ViewLista");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
   * Muestra un Alumno en especifico
   */
  function ViewAlumno(idAlumno) {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
   * Trae vista para insertar Alumno
   */
  function GetInsertAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
   * Envia un Alumno a la DB y trae la vista ViewAlumno si lo agrega
   */
  function PostInsertAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
  function GetUpdateAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
  function PostUpdateAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
  function GetDeleteAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
  function PostDeleteAlumno() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Alumno.php",
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
  