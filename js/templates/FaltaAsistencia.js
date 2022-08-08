/**
 * Trae elementos html a mostrar
 */
function ViewListaAusencia() {
  /* AUSENCIA LSITA */
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php?type=Elements",
    data: {},
    success: (data) => {
      $("#renderbody").empty();
      $("#renderbody").html(data);
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
  $.ajax({
    type: "VIEW",
    url:
      "http://localhost/app_School/WebService/ws_FaltaAsistencia.php?faltaAsistenciaId=" +
      idFaltaAsistencia,
    success: (data) => {
      console.log(data);
      $("#renderbody").empty();
      $("#renderbody").html(data);
    },
    error: (error) => {
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

/**
 * Trae vista para insertar FaltaAsistencia
 */
function GetInsertFaltaAsistencia() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php?type=lastId",
    data: {},
    success: (data) => {
      const jsonObject = JSON.parse(data);
      const id = parseInt(jsonObject["id"]) + 1;
      const htmlElements = `
        <div>
          <div>
              <h4>
                  Insertar Falta de Asistencia
              </h4>
              <p>
                  Por Favor seleccione la información e introduzca lo necesario.
              </p>
              <div>
                  <form action="index.php" method="post" id="frmInsercionAusencia" name="frmInsercionAusencia">
                      <div class="from-group">
                          <label>Id </label>
                          <input id="id" type="number" name="id" class="form-control" readonly value="${id}"}>
                          <label id="idMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Id de Alumno</label>
                          <input id="alumno_id" type="text" name="alumno_id" list="lista-Estudiantes" class="form-control">
                          <datalist id="lista-Estudiantes">
                          <option value="0">Seleccione</option>
                              <option value=""></option>
                          </datalist>
                          <label id="alumnoMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Id de Asignatura </label>
                          <input type="text" id="asignatura_id" name="asignatura_id" list="lista-asignatura"
                              class="form-control">
                          <datalist id="lista-asignatura">
                              <option value=""></option>
                              {/section}
                          </datalist>
                          <label id="asignaturaMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Fecha </label>
                          <input type="date" id="fecha" name="fecha" class="form-control">
                          <label id="FechaMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Justificacion </label>
                          <textarea id="justificada" name="justificada" class="form-control"></textarea>
                          <label id="JustificadaMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group row">
                          <button type="button" onclick="onvalid()" class="col-sm-5 col-md-6 btn-outline-info btn">
                              Agregar</button>
                          <button type="button" onclick="onclickClean()" class="col-sm-5 col-md-6 btn-outline-success btn">
                              Limpiar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
        `;
      $("#renderbody").empty();
      $("#renderbody").html(htmlElements);
    },
    error: (error) => {},
  });
}

/**
 * Envia un FaltaAsistencia a la DB y trae la vista ViewFaltaAsistencia si lo agrega
 */
function PostInsertFaltaAsistencia(
  id,
  idAlumno,
  idAsignatura,
  fecha,
  justificacion
) {
  debugger;
  $.ajax({
    type: "POST",
    url: `http://localhost/app_School/WebService/ws_FaltaAsistencia.php?faltaAsistenciaId=${id}&alumno_id=${idAlumno}&asignatura_id=${idAsignatura}&fecha=${fecha}&justificada=${justificacion}`,
    data: {},
    success: (data) => {
      console.log("sucesss");
      debugger;
      ViewFaltaAsistencia(id);
    },
    error: (error) => {
      console.error(error + "No se inserto el elemento");
      $("#renderbody").empty();
      $("#renderbody").html(error);
      debugger;
    },
  });
}

/**
 * Trae vista para modificar
 */
function GetUpdateFaltaAsistencia(id) {
  $.ajax({
    type: "GET",
    url: `http://localhost/app_School/WebService/ws_FaltaAsistencia.php?type=elementById&id=${id}`,
    data: {},
    success: (data) => {
      const objectElement = JSON.parse(data);
      const htmlElements = `
        <div>
          <div>
              <h4>
                  Actualizar Falta de Asistencia
              </h4>
              <div class="d-flex flex-row justify-content-between">
                <p>
                    Por Favor seleccione la información e introduzca lo necesario.
                </p>
                <button type="text" onclick="ViewListaAusencia()" class="btn btn-sm btn-info text-dark">Regresar a la lista</button>
              </div>

              <div>
                  <form action="index.php"  id="frmInsercionAusencia" name="frmInsercionAusencia">
                      <div class="from-group">
                          <label>Id </label>
                          <input id="id" type="number" name="id" class="form-control" readonly value="${objectElement.id}"}>
                          <label id="idMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Id de Alumno</label>
                          <input id="alumno_id" type="text" name="alumno_id" list="lista-Estudiantes" class="form-control" value="${objectElement.alumno_id}"></input>
                          <datalist id="lista-Estudiantes">
                          <option value="0">Seleccione</option>
                              <option value=""></option>
                          </datalist>
                          <label id="alumnoMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Id de Asignatura </label>
                          <input type="text" id="asignatura_id" name="asignatura_id" list="lista-asignatura" value="${objectElement.asignatura_id}"
                              class="form-control">
                          <datalist id="lista-asignatura">
                              <option value=""></option>                              
                          </datalist>
                          <label id="asignaturaMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Fecha </label>
                          <input type="date" id="fecha" name="fecha" class="form-control" value="${objectElement.fecha}" >
                          <label id="FechaMessage" class="text-danger"></label>
                      </div>
                      <div class="from-group">
                          <label>Justificacion </label>
                          <textarea id="justificada" name="justificada" class="form-control" >${objectElement.justificada}</textarea>
                          <label id="JustificadaMessage" class="text-danger"></label>
                      </div>
                  </form>
                  <div class="form-group row">
                    <button type="text" onclick="editData()" class="col-sm-5 col-md-6 btn-outline-info btn">Editar</button>
                    <button type="text onclick="" class="col-sm-5 col-md-6 btn-outline-success btn"> Limpiar</button>
                  </div>                  
              </div>
          </div>
      </div>
        `;
      $("#renderbody").empty();
      $("#renderbody").html(htmlElements);
    },
    error: (error) => {},
  });
}

/**
 * Envia vista modifiada
 */
function PostUpdateFaltaAsistencia(id, alumno, asignatura, fecha, justificada) {
  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_FaltaAsistencia.php?faltaAsistenciaId=${id}&alumno_id=${alumno}&asignatura_id=${asignatura}&fecha=${fecha}&justificada=${justificada}`,
    data: {},
    success: (data) => {
      ViewFaltaAsistencia(id);
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
function GetDeleteFaltaAsistencia(idFaltaAsistencia) {
  const faltaAsistenciaId = idFaltaAsistencia;
  $.ajax({
    type: "GET",
    url: `http://localhost/app_School/WebService/ws_FaltaAsistencia.php?type=elementById&id=${idFaltaAsistencia}`,
    data: {},
    success: (data) => {
      const jsonObject = JSON.parse(data);
      const htmlRender = `
          <div>
          <div>
            <h4>Borrar la información de la Falta en la Asistencia</h4>
            <p>
              A continuación se muestran la información de la falta Seleccionada
            </p>
          </div>
        </div>
        <div>
          <table class="table">
            <tbody>
            
              <tr>
                <th>id Falta de Asistencia</th>
                <!--id-->
                <td id="objId"> ${jsonObject['id']}</td>
              </tr>
              <tr>
                <th>id Estudiante</th>
                <!--id Estudiante-->
                <td>  ${jsonObject['nombre']} ${jsonObject['apellidos']} </td>            
              </tr>
              <tr>
                <th>Asignatura</th>
                <!--Id Materia-->
                <td>${jsonObject['asignatura']}</td>
              </tr>
              <tr>
                <th>Fecha</th>
                <!--Dia-->
                <td>${jsonObject['fecha']}</td>
              </tr>
              <tr>
                <th>Justificación</th>
                <!--Motivo-->
                <td>${jsonObject['justificada']}</td>
              </tr>
            </tbody>
          </table>
          <div>
            <button
              class="btn btn-outline-danger"
              type="text"
              onclick="PostDeleteFaltaAsistencia(${jsonObject['id']})"
            >
              Eliminar Archivo
            </button>
              <button onclick="ViewListaAusencia()" type="text" class="btn btn-info " >Volver Atras</button>
          </div>
        </div>
      </body>
    
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
 * confirma la eliminación
 */
function PostDeleteFaltaAsistencia(id) {
  $.ajax({
    type: "DELETE",
    url: `http://localhost/app_School/WebService/ws_FaltaAsistencia.php?faltaAsistenciaId=${id}`,
    data: {},
    success: (data) => {
      // RETORNA LISTA DE AUSENCIAS EXISTENTES
      ViewListaAusencia();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

/*
  Descripciòn: limpia los valores en el formulario
 */
function onclickClean() {
  document.getElementById("alumno_id").value = "";
  document.getElementById("asignatura_id").value = "";
  document.getElementById("fecha").value = "";
  document.getElementById("justificada").value = "";
}

function Prueba() {
  alert("sample");
  console.log("sample");
}

/*
    Descripciòn: Valida la informaciòn en los inputs 
    y envia el formulario al servidor.
  */
function onvalid() {
  const id = document.getElementById("id");
  const alumno = document.getElementById("alumno_id");
  const asignatura = document.getElementById("asignatura_id");
  const fecha = document.getElementById("fecha");
  const justificada = document.getElementById("justificada");

  let flag = false;

  /* valudaciones de nulos */
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  if (asignatura.value == "" || asignatura.value == null) {
    document.getElementById("asignaturaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("asignaturaMessage").innerText = "";
  }
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("alumnoMessage").innerText = "";
  }
  if (fecha.value == "" || fecha.value == null) {
    document.getElementById("FechaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  /* llama al web service */
  if (!flag) {
    // envia el formulario al servidor
    debugger;
    PostInsertFaltaAsistencia(
      id.value,
      alumno.value,
      asignatura.value,
      fecha.value,
      justificada.value
    );
  }
}



function editData() {
  const id = document.getElementById("id");
  const alumno = document.getElementById("alumno_id");
  const asignatura = document.getElementById("asignatura_id");
  const fecha = document.getElementById("fecha");
  const justificada = document.getElementById("justificada");

  let flag = false;
  /* valudaciones de nulos */
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  if (asignatura.value == "" || asignatura.value == null) {
    document.getElementById("asignaturaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("asignaturaMessage").innerText = "";
  }
  if (alumno.value == "" || alumno.value == null) {
    document.getElementById("alumnoMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  } else {
    document.getElementById("alumnoMessage").innerText = "";
  }
  if (fecha.value == "" || fecha.value == null) {
    document.getElementById("FechaMessage").innerText =
      "El valor no puede ser nulo";
    flag = true;
  }
  /* ENVIO INFORMACIÒN */
  if (!flag) {
    PostUpdateFaltaAsistencia(
      id.value,
      alumno.value,
      asignatura.value,
      fecha.value,
      justificada.value
    );
  }
}
