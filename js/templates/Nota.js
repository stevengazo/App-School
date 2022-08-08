/**
 * Trae elementos html a mostrar
 */
function ViewListaNotas() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Nota.php?type=elements",
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
                        ${jsonNota["id"]}                        
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
      $("#renderbody").html(
        "Error del servidor... Estatus: " +
          error.status +
          "<br/> " +
          error.statusText
      );
      console.error(error);
    },
  });
}

/**
 * Trae vista para insertar Nota
 */
function GetInsertNota() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Nota.php?type=lastId",
    data: {},
    success: (data) => {
      const tmpData = JSON.parse(data);
      const numbertmp = parseInt(tmpData.id) + 1;
      const htmlRender = `
        <div>
        <h4>
            Insertar Nota
        </h4>
        <p>
            Por Favor seleccione la información e introduzca lo necesario.
        </p>
        <form action="index.php" method="post" id="frmInsertarNota" name="frmInsertarNota">
            <!--En Control redirige al controlador de Notas-->
            <input type="hidden" name="Controller" value="Notas" />        
            <input type="hidden" name="action" value="frmInsertarNota" />        
            <div class="form" >
                <div class="form-group">
                    <label>Id Nota</label>
                    <input type="text" class="form-control" name="id" id="id" value="${numbertmp}" readonly />
                </div>
                <div class="form-group">
                    <label>Asignatura</label>
                    <input type="text" list="listAsigAlum" name="asignatura_has_alumno_id"  class="form-control" id="asignatura_has_alumno_id" placeholder="Alumno - Asignatura" />
                    <datalist id="listAsigAlum">                      
                        <option value="">                        
                        </option>
                    </datalist>
                    <label id="AsignaturaMessage" class="text-danger"></label>            
                </div>           
                <div class="form-group">
                    <label>Trimestre</label>
                    <select type="number" class="form-control" name="trimestre"  id="trimestre" placeholder="Numero de Trimestre" > 
                     <option value="1">Primer Trimestre</option>
                        <option value="2">Segundo Trimestre</option>
                        <option value="2">Tercer Trimestre</option>
                    </select>
                    <label id="trimestreMessage" class="text-danger"></label>
                </div>
                <div class="form-group">
                    <label>Nota</label>
                    <input type="number" class="form-control" name="nota"  id="nota" placeholder="Nota" />
                    <label id="NotaMessage" class="text-danger"></label>
                </div>                                
            </div>
        </form>
        <div class="d-flex flex-row justify-content-space-around">
            <button type="text" class="btn btn-outline-success" onclick="onvalidation()" >Crear Nota</button>
            <button class="btn btn-outline-info" onclick="">Limpiar</button>
        </div>
    </div>
        `;
      $("#renderbody").empty();
      $("#renderbody").html(htmlRender);
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
function PostInsertNota(id,asignatura_has_alumno,trimestre,nota) {
  debugger;
  $.ajax({
    type: "POST",
    url: `http://localhost/app_School/WebService/ws_Nota.php?idNota=${id}&asignaturaHasAlumnoId=${asignatura_has_alumno}&trimestre=${trimestre}&nota=${nota}`,
    data: {},
    success: (data) => {
      debugger;
      ViewNota(id);
    },
    error: (error) => {
      debugger;
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

/**
 * Use it to Validate the data in the creating form
 */
function onvalidation() {
  const id = document.getElementById("id");
  const asignatura_has_alumno_id = document.getElementById(
    "asignatura_has_alumno_id"
  );
  const asignatura_id = document.getElementById("asignaturaId");
  const trimestre = document.getElementById("trimestre");
  const nota = document.getElementById("nota");

  let flagValid = false;

  // VALIDACIONES DE NULOS
  if (
    asignatura_has_alumno_id.value === null ||
    asignatura_has_alumno_id.value === ""
  ) {
    document.getElementById("AsignaturaMessage").innerText =
      "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("AsignaturaMessage").innerText = "";
    flagValid = true;
  }

  if (trimestre.value === null || trimestre.value === "") {
    document.getElementById("trimestreMessage").innerText =
      "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("trimestreMessage").innerText = "";
    flagValid = true;
  }
  if (nota.value === null || nota.value === "") {
    document.getElementById("NotaMessage").innerText =
      "El valor no puede ser nulo";
    flagValid = false;
  } else {
    document.getElementById("NotaMessage").innerText = "";
    flagValid = true;
  }

  if (flagValid) {
    debugger;
    PostInsertNota(id.value,asignatura_has_alumno_id.value,trimestre.value,nota.value);
  }
}

function onEdit() {
  const idInput = document.getElementById("id").value;
  const asignatura_has_alumnoInput = document.getElementById("asignatura_has_alumno_id").value;
  const trimestreInput = document.getElementById("trimestre").value;
  const notaInput = document.getElementById("nota").value;
  let flagValid = true;
  if (
    asignatura_has_alumnoInput === null ||
    asignatura_has_alumnoInput === ""
  ) {
    document.getElementById(
      "AsignaturaMessage"
    ).innerText = `Verifica el valor`;
    flagValid = false;
  } else {
    document.getElementById("AsignaturaMessage").innerText = ``;
    flagValid = true;
  }
  if (trimestreInput === null || trimestreInput === "") {
    document.getElementById("trimestreMessage").innerText = `Verifica el valor`;
    flagValid = false;
  } else {
    document.getElementById("trimestreMessage").innerText = ``;
    flagValid = true;
  }
  if (notaInput === null || notaInput === 0) {
    document.getElementById(
      "NotaMessage"
    ).innerText = `Verifique el valor existente`;
    flagValid = false;
  } else {
    document.getElementById("NotaMessage").innerText = ``;
    flagValid = true;
  }
  // send the data to the controller
  if (flagValid) {
    
  }
}
