/**
 * Trae elementos html a mostrar
 */
 function ViewListaNotas() {
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
      data: {},
      success: (data) => {
        debugger;
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
   * Muestra un Nota en especifico
   */
  function ViewNota(idNota) {    
    $.ajax({
      type: "VIEW",
      url: `http://localhost/app_School/WebService/ws_Nota.php?idNota=${idNota}`,
      data: {},
      success: (data) => {
        debugger;
        const jsonNota = JSON.parse(data);
        const htmlRender = `
                <div>
                <div>
                    <h4>
                        Información de la Nota
                    </h4>
                    <p>
                        A continuación se muestra la información de la nota
                    </p>
                </div>
            </div>
            <hr />
            
            <table class="table">
                <tbody>
                    <tr>
                        <th>
                            N° de Registro
                        </th>
                        <!--id-->
                        <td>
                        ${jsonNota['id']}                        
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Estudiante
                        </th>
                        <!--Estudiante-->
                        <td>
                          ${jsonNota.nombre} ${jsonNota.apellidos}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Asignatura
                        </th>
                        <!--Asignatura-->
                        <td>
                        ${jsonNota.asignaturaNombre}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Trimestre
                        </th>
                        <!--Trimestre-->
                        <td>                        
                        ${jsonNota.trimestre}                        
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nota
                        </th>
                        <!--Nota-->
                        <td>
                        ${jsonNota.nota}
                        </td>
                    </tr>
                </tbody>
            </table>            
        `;
        $("#renderbody").empty();
        $("#renderbody").html(htmlRender);
      },
      error: (error) => {
          debugger;
          $("#renderbody").empty();        
          $("#renderbody").html("Error del servidor... Estatus: "+ error.status + "<br/> "  +error.statusText);
          console.error(error);
      },
    });
  }
  
  /**
   * Trae vista para insertar Nota
   */
  function GetInsertNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
      data: {},
      success: (data) => {
        const htmlRender = `

        `;
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
   * Envia un Nota a la DB y trae la vista ViewNota si lo agrega
   */
  function PostInsertNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
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
  function GetUpdateNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
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
  function PostUpdateNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
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
  function GetDeleteNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
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
  function PostDeleteNota() {
    alert("View");
    $.ajax({
      type: "GET",
      url: "http://localhost/app_School/WebService/ws_Nota.php",
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
  