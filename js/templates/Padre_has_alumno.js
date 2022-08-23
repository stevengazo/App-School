async function deletePadre(id){
    await $.ajax({
        type: "Delete",
        url: `http://localhost/app_School/WebService/ws_Padre_has_alumno.php?id=${id}`,
        data: {},
        success: (data) => {
         verListaPadresAlumnos();
        },
        error: (error) => {
          $("#renderbody").empty();
          $("#renderbody").html(error);
          console.error(error);
        },
      });
}

async function GuardarRegistro(){
    var _numero = 0;
    await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Padre_has_alumno.php?tipo=ultimoid",
    data: {},
    success: (data) => {
      var result = JSON.parse(data);
      _numero = parseInt( result.lastId);  
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
    });
    const idPadre = document.getElementById("idPadre").value;
    const idAlumno = document.getElementById("idAlumno").value;
    _numero = _numero +1;
    _numero = _numero.toString();
    debugger;
  await $.ajax({
    type: "POST",
    url: `http://localhost/app_School/WebService/ws_Padre_has_alumno.php?id=${_numero}&idPadre=${idPadre}&idAlumno=${idAlumno}`,
    data: {},
    success: (data) => {
      verPadreaAlumno(_numero);
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

async function GetinsertPadreAlumno() {
  htmlRenderizado = `
    <div>
    <h3>
        Asociar Padre - Hijo
    </h3>
    <p>
        Este espacio le permite asociar un padre a un alumno existente.<br/>
        Tome en cuenta que el padre podrá ver la información correspondiente al hijo
    </p>
    <table class="table">
        <tbody>
            <tr>
                <th>
                    Padre
                </th>
                <td>
                    <select id="idPadre"  class="form-control">
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    Alumno
                </th>
                <td>
                    <select id="idAlumno"  class="form-control">
                    </select>
                </td>
            </tr>      
            <tr>
                <td colspan="2">
                    <button onclick="GuardarRegistro()" class="btn btn-success">
                        Agregar
                    </button>
                </td>
            </tr>      
        </tbody>
    </table>
</div>    
`;
  // RENDERIZADO DE DATOS
  $("#renderbody").empty();
  $("#renderbody").html(htmlRenderizado);
  /* PADRES */
  var ArregloPadres = [];
  await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Padre.php?tipo=lista",
    data: {},
    success: (data) => {
      var result = JSON.parse(data);
      ArregloPadres = result;
      for (let dfg = 0; dfg < ArregloPadres.length; dfg++) {
        const element = ArregloPadres[dfg];
        const option = document.createElement("option");
        option.value = element.idUser;
        option.innerText = `${element.nombre} ${element.apellidos}`;
        document.getElementById("idPadre").appendChild(option);
      }
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });

  await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Alumno.php?tipo=lista&formato=JSON",
    success: function (data) {
      var result = JSON.parse(data);
      console.table(result);
      ArregloAlumnos = result;
      for (let dfg = 0; dfg < ArregloAlumnos.length; dfg++) {
        const element = ArregloAlumnos[dfg];
        const option = document.createElement("option");
        option.value = element.id;
        option.innerText = `${element.nombre} ${element.apellidos}`;
        document.getElementById("idAlumno").appendChild(option);
      }
    },
    error: function (error) {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

async function verPadreaAlumno(id) {
  var ObjectoTemporal = {};
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Padre_has_alumno.php?id=${id}`,
    data: {},
    success: (data) => {
      result = JSON.parse(data);
      debugger;
      const htmlRenderizado = `
            <div >
                <h4>
                    Información Padre y Alumnos
                </h4>
                <p>
                    A continuación se muestra la información
                </p>
            </div>            
            <table>
                <tbody>
                    <tr>
                        <th>
                            N°
                        </th>    
                        <td>
                            ${result.id}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cedula
                        </th>    
                        <td>
                            ${result.padreId}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Padre
                        </th>    
                        <td>
                            ${result.padreNombre}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cédula
                        </th>    
                        <td>
                            ${result.alumnoId}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nombre
                        </th>    
                        <td>
                            ${result.alumnoNombre}
                        </td>
                    </tr>                    
                </tbody>
            </table>                
            `;
      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderizado);
    },
    error: (error) => {
      debugger;
      console.error(error);
    },
  });
}

async function verListaPadresAlumnos() {
  var htmlRenderizado = `
    <div>
        <h4>
            Lista de Padres y Alumnos
        </h4>
        <p>
            A continuación se muestran los padres y alumnos asociados
        </p>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Cedula Padre</th>
                <th>Nombre Padre</th>
                <th>Cedula Padre</th>
                <th>Nombre Padre</th>
                <th>Nombre Padre</th>         
            </tr>        
        </thead>
        <tbody>
    `;
  var lista = [];
  await $.ajax({
    type: "GET",
    url: `http://localhost/app_School/WebService/ws_Padre_has_alumno.php?tipo=lista`,
    data: {},
    success: (data) => {
      result = JSON.parse(data);
      console.table(result);
      lista = result;
    },
    error: (error) => {
      console.error(error);
    },
  });

  debugger;
  for (let fsx = 0; fsx < lista.length; fsx++) {
    const element = lista[fsx];
    debugger;
    const row = `        
            <tr>
                <td>${element.id}</td>
                <td>${element.padreId}</td>
                <td>${element.padreNombre}</td>
                <td>${element.alumnoId}</td>
                <td>${element.alumnoNombre}</td>
                <td onclick="verPadreaAlumno(${element.id})" class="btn btn-sm text-dark btn-info mr-1" > 
                    <i class="bi bi-info-circle"></i>
                </td>
                <td onclick="deletePadre(${element.id})" class="btn btn-sm text-dark btn-danger" > 
                    <i class="bi bi-trash3"></i> 
                </td>            
            </tr>
        `;
    htmlRenderizado = ` ${htmlRenderizado}  ${row}`;
  }

  htmlRenderizado = ` ${htmlRenderizado} 
        </tbody>
    </table>
    `;

  // RENDERIZADO DE DATOS
  $("#renderbody").empty();
  $("#renderbody").html(htmlRenderizado);
}
