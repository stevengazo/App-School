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
      const id = parseInt(jsonObject["id"])   +1;      
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
                <a href="http://localhost/app_school/" class="btn btn-sm btn-info text-dark">Regresar a la lista</a>
              </div>

              <div>
                  <form action="index.php" method="post" id="frmInsercionAusencia" name="frmInsercionAusencia">
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
 * Envia vista modifiada
 */
function PostUpdateFaltaAsistencia() {
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
function GetDeleteFaltaAsistencia(idFaltaAsistencia) {
  const faltaAsistenciaId = idFaltaAsistencia;
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_FaltaAsistencia.php",
    data: {
      faltaAsistenciaId,
    },
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
    PostInsertFaltaAsistencia(id.value,alumno.value,asignatura.value,fecha.value,justificada.value);
  }
}

function onDeleteElement(event) {
  // creación de formulario
  const frm = document.createElement("form");
  frm.action = "index.php";

  const intPutmp1 = document.createElement("input");
  intPutmp1.name = "action";
  intPutmp1.value = "setBorrarFaltas";

  const inputId = document.createElement("input");
  inputId.name = "id";

  const valueId = document.getElementById("objId").innerText;
  console.log(`id ausencia: ${valueId}`);
  inputId.value = valueId;

  const valueController = document.createElement("input");
  valueController.name = "Controller";
  valueController.type = "hidden";
  valueController.value = "FaltaAsistencia";

  frm.appendChild(valueController);
  frm.appendChild(intPutmp1);
  frm.appendChild(inputId);
  frm.style.display = "none";
  document.body.appendChild(frm);
  frm.submit();
}

function editData() {
  const id = document.getElementById("id");
  const alumno = document.getElementById("alumno_id");
  const asignatura = document.getElementById("asignatura_id");
  const fecha = document.getElementById("fecha");
  const justificada = document.getElementById("justificada");

  let flag = false;

  console.log(
    ` - ${alumno.value} -${asignatura.value} -${fecha.value} - ${justificada.value}`
  );

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
  /* llama al servidor */
  if (!flag) {
    const frm = document.getElementById("frmEdicionAusencia");

    const valueController = document.createElement("input");
    valueController.name = "Controller";
    valueController.type = "hidden";
    valueController.value = "FaltaAsistencia";

    frm.appendChild(valueController);

    frm.submit();
  }
}
