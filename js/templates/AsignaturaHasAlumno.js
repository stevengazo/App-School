/**
 * Trae elementos html a mostrar
 */
function ViewListaAsigHasAlum() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?tipo=HTML",
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
 * Muestra un AsignaturaHasAlumno en especifico
 */
function ViewAsignaturaHasAlumno(idAsignaturaHasAlumno) {
  debugger;
  $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?asigAlum_id=${idAsignaturaHasAlumno}`,
    data: {},
    success: (data) => {
      debugger;
      const objectJson = JSON.parse(data);
      const htmlRender = `
            <div>
                <div>
                    <h4>
                        Información Alumno - Asignatura
                    </h4>
                    <div class="d-flex flex-row justify-content-between">
                        <p>
                            A continuación se muestra la información de la nota a borrar
                        </p>
                        <button class="btn btn-sm btn-info text-light" onclick="ViewListaAsigHasAlum()">
                            Lista 
                        </button>
                    </div>        
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
                        ${objectJson.id}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Estudiante
                        </th>
                        <!--Estudiante-->
                        <td>
                        ${objectJson.alumnoNombre} ${objectJson.alumnoApellidos}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Asignatura
                        </th>
                        <!--Asignatura-->
                        <td>
                        ${objectJson.asignaturaNombre}
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
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

/**
 * Trae vista para insertar AsignaturaHasAlumno
 */
async function GetInsertAsignaturaHasAlumno() {
  let htmlRender = `
      <div>
        <h2>Matricular Alumno en asistencia</h2>
        <p>
          Esta vista permite realizar la matricula de un estudiante en una asignatura.
          Seleccione el estudiante que desee matricular en la asignatura          
        </p>
      </div>
      <div class="d-flex flex-column">
        <div class="form-group">
          <label>Alumno</label>
          <select id="select-alumno" class="form-control">
          </select>
        </div>
      <div class="form-group">
          <label>Asignatura</label>
          <select class="form-control" id="selectAsignaturas">          
          </select>
      </div>
      <div class="d-flex flex-row justify-content-around mt-2">
          <button onclick='PostInsertAsignaturaHasAlumno()' class="btn btn-sm btn-outline-success bg-white">Agregar</button>
          <button class="btn btn-sm btn-outline-info bg-white">Regresar</button>
      </div>
    </div>
    `;

  $("#renderbody").empty();
  $("#renderbody").html(htmlRender);

  let arrayObjectsAlumnos = [];

  await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Alumno.php?accion=listar&tipo=JSON",
    success: function (data) {
      arrayObjectsAlumnos.push(JSON.parse(data));
      arrayObjectsAlumnos = arrayObjectsAlumnos[0];
      // Construye elemento Option y los mueve a la vista con los datos resultantes
      for (let j = 0; j < arrayObjectsAlumnos.length; j++) {
        const element = arrayObjectsAlumnos[j];
        let tmpHTMl = document.createElement("option");
        tmpHTMl.innerText = `${element.apellidos} ${element.nombre}`;
        tmpHTMl.value = element.id;
        document.getElementById("select-alumno").appendChild(tmpHTMl);
      }
    },
    error: function (error) {
      console.error(error);
      arrayObjectsAlumnos = null;
    },
  });

  let arrayObjectsAsignaturas = [];
  await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php?tipo=Json",
    data: {},
    success: (data) => {
      // parsea los datos
      arrayObjectsAsignaturas.push(JSON.parse(data));
      arrayObjectsAsignaturas = arrayObjectsAsignaturas[0];
      // Construye elemento Option y los mueve a la vista con los datos resultantes
      for (let j = 0; j < arrayObjectsAsignaturas.length; j++) {
        const element = arrayObjectsAsignaturas[j];
        let tmpHTMl = document.createElement("option");
        tmpHTMl.innerText = element.nombre + " - " + element.nombreProfesor;
        tmpHTMl.value = element.id;
        document.getElementById("selectAsignaturas").appendChild(tmpHTMl);
      }
    },
    error: (error) => {
      console.error("no adquirio los datos");
      arrayObjectsAlumnos = null;
    },
  });
}

/**
 * Envia un AsignaturaHasAlumno a la DB y trae la vista ViewAsignaturaHasAlumno si lo agrega
 */
async function PostInsertAsignaturaHasAlumno() {
  const idAlumno = document.getElementById("select-alumno").value;
  const idAsignatura = document.getElementById("selectAsignaturas").value;
  var lastId = {};
  await $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?tipo=JSON&dato=ultimoId",
    data: {},
    success: (data) => {
      lastId = JSON.parse(data);
      lastId.id = lastId.id;
    },
    error: (error) => {
      console.error(error);
    },
  });

  lastId = parseInt(lastId.id);
lastId =  lastId +1;

  alert(`idAlumno ${idAlumno} - idAsignatura ${idAsignatura} - new id ${lastId}`);
  
  $.ajax({
    type: "POST",
    url: `http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?asigAlum_id=${lastId}&asignatura_id=${idAsignatura}&alumno_id=${idAlumno}`,
    data: {},
    success: (data) => {
      ViewAsignaturaHasAlumno(lastId);
    },
    error: (error) => {
      console.error(error);
    },
  });
}

/**
    Trae el objecto de la DB
    y muestra una vista
 */
function GetUpdateAsignaturaHasAlumno(id) {
 
$("#renderbody").empty();
$("#renderbody").html(htmlRender);

  alert("GetUpdateAsignaturaHasAlumno");
  // CARGA EL registro
  let asignatura= {};
  $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?asigAlum_id=${id}`,
    data: {},
    success: (data) => {
      asignatura= JSON.parse(data);      
    },
    error: (error) => {
      asignatura= null;
      console.error(error);    
    },
  });


}

/**
 * Envia vista modifiada
 */
function PostUpdateAsignaturaHasAlumno() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php",
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
function PostDeleteAsignaturaHasAlumno(id) {
  $.ajax({
    type: "DELETE",
    url: `http://localhost/app_School/WebService/ws_AsignaturaHasAlumno.php?asigAlum_id=${id}`,
    data: {},
    success: (data) => {
      ViewListaAsigHasAlum();
    },
    error: (error) => {
      const toast = document.getElementById("toast-base");
      toast.style.display = "block";
        const title = document.getElementById("toast-title").innerText= `Error!`;
        const message = document.getElementById("toast-message").innerText= `Este dato no puede ser borrado \nExisten dependencias      `;
    
        toast.style.display = "block";
      console.error(error);
    },
  });
}
