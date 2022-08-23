

async function miInformación() {
  const idUsuario = sessionStorage.getItem("idUser");
  var Alumno = {};
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Alumno.php?id=${idUsuario}`,
    success: function (data) {
      Alumno = JSON.parse(data);      
      console.log("Alumno sucess: ");
      console.log(Alumno);
    },

    error: function (error) {
      $("#renderbody").html(
        '<div class="alert alert-warning" role="alert">error al mirar elemento</div>'
      );
    },
  });
  var htmlRender = `
  <div class="d-flex flex-column justify-content-center">
    <table class="table border-secondary rounded p-2">
      <body>
        <tr>
            <th>Nombre</th> <td> ${Alumno.nombre} </td>
        </tr>
        <tr>
            <th>Apellidos</th> <td>${Alumno.apellidos} </td>
        </tr>      
        <tr>
            <th>Cedula</th> <td>${Alumno.id} </td>
        </tr>
        <tr>
            <th>Title</th> <td> valor </td>
        </tr>                  
      </body>
    </table>
  </div>
  <hr/>
  `;

  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Alumno.php?id=${idUsuario}`,
    success: function (data) {
      Alumno = JSON.parse(data);
      console.log("Alumno sucess: ");
      console.log(Alumno);
    },
    error: function (error) {
      $("#renderbody").html(
        '<div class="alert alert-warning" role="alert">error al mirar elemento</div>'
      );
    },
  });



  /**
   * RENDERIZA LAS ASIGNATURAS
   */
  var htmlRenderAsignaturas = ` 
   <h4 class="h4">Asignaturas del Estudiante</h4>
   <p>
     Asignaturas en las cuales se encuentra matriculado el estudiante
   </p>
   <div class="d-flex"> `;
  for (let x = 0; x < Alumno.asignaturas.length; x++) {
    const element = Alumno.asignaturas[x];
    const card = `     
       <div class="card" style="width: 18rem;">
         <div class="card-body">
           <h5 class="card-title">${element.nombreAsignatura}</h5>
           <h6 class="card-subtitle mb-2 text-muted">Profesor ${element.profesorNombre} ${element.apellidos}</h6>
           <p class="card-text">Id del curso ${element.idAsignatura}. El nivel corresponde a ${element.nivel}, aula ${element.aula}</p>
           <button  onclick="ViewAsignatura(${element.idAsignatura})" class="btn btn-sm btn-info"> Ver curso</button>  
           <a href="#" class="card-link">Ver Profesor</a>
         </div>
       </div>    
     `;
    htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${card}`;
  }
  htmlRenderAsignaturas = `${htmlRenderAsignaturas} </div> <hr/>`;



  /**
   * RENDERIZA Las asuencias
   */
   var htmlRenderAusencias = ` 
   <h4 class="h4">Ausencias del Estudiante</h4>
   <p>
     lista de ausencias del estudiante
   </p>
   <table class="table table-bordered">
    <tbody>
   `;
   debugger;
  for (let x = 0; x < Alumno.ausencias.length; x++) {
    const element = Alumno.ausencias[x];
    const ROW = `     
        <tr>
          <td>
            ${element.faltaAsistenciaId}
          </td>

          <td>
          ${element.fecha}
          </td>
          <td>
          ${element.asignaturaNombre}
          </td>
          <td>
          ${element.NombreProfesor}
          </td>
        </tr>
     `;
    htmlRenderAusencias = `${htmlRenderAusencias} ${ROW}`;
  }
  htmlRenderAusencias = `${htmlRenderAusencias} 
    </tbody>
  </table>`;



  /**
   * RENDERIZA Las notas
   */
   var HTMLrENDERnOTAS = ` 
   <h4 class="h4">Notas del Estudiante</h4>
   <p>
     Lista de notas del estudiante
   </p>
   <table class="table table-bordered">
   <thead>
   <tr>
    <th>Trimestre</th>
    <th>Nota</th>
    <th>Asignatura</th>
   </tr>
   </thead>
    <tbody>
   `;
   debugger;
  for (let x = 0; x < Alumno.Notas.length; x++) {
    const element = Alumno.Notas[x];
    const ROW = `     
        <tr>
          <td>
            ${element.trimestre}
          </td>

          <td>
          ${element.nota}
          </td>
          <td>
          ${element.asignaturaNombre}
          </td>          
          <td class='btn btn-sm text-dark btn-primary'  onclick='ViewNota(${element.notaId})'> <i class='bi bi-info'></i> </td>          
        </tr>
     `;
    HTMLrENDERnOTAS = `${HTMLrENDERnOTAS} ${ROW}`;
  }
  HTMLrENDERnOTAS = `${HTMLrENDERnOTAS} 
    </tbody>
  </table>`;

  // RENDERIZADO
  $("#renderbody").empty();
  $("#renderbody").html(`${htmlRender} ${htmlRenderAsignaturas} ${htmlRenderAusencias} ${HTMLrENDERnOTAS}`);
}

async function verAlumno(id) {
  var Alumno = {};
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Alumno.php?id=${id}`,
    success: function (data) {
      Alumno = JSON.parse(data);
      console.log("Alumno sucess: ");
      console.log(Alumno);
    },
    error: function (error) {
      $("#renderbody").html(
        '<div class="alert alert-warning" role="alert">error al mirar elemento</div>'
      );
    },
  });
  var htmlRender = `
  <div class="d-flex flex-column justify-content-center">
    <table class="table border-secondary rounded p-2">
      <body>
        <tr>
            <th>Nombre</th> <td> ${Alumno.nombre} </td>
        </tr>
        <tr>
            <th>Apellidos</th> <td>${Alumno.apellidos} </td>
        </tr>      
        <tr>
            <th>Cedula</th> <td>${Alumno.id} </td>
        </tr>
        <tr>
            <th>Title</th> <td> valor </td>
        </tr>                  
      </body>
    </table>
  </div>
  <hr/>
  `;

  /**
   * RENDERIZA LAS ASIGNATURAS
   */
  var htmlRenderAsignaturas = ` 
  <h4 class="h4">Asignaturas del Estudiante</h4>
  <p>
    Asignaturas en las cuales se encuentra matriculado el estudiante
  </p>
  <div class="d-flex"> `;
  for (let x = 0; x < Alumno.asignaturas.length; x++) {
    const element = Alumno.asignaturas[x];
    debugger;
    const card = `     
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">${element.nombreAsignatura}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Profesor ${element.profesorNombre} ${element.apellidos}</h6>
          <p class="card-text">Id del curso ${element.idAsignatura}. El nivel corresponde a ${element.nivel}, aula ${element.aula}</p>
          <button  onclick="ViewAsignatura(${element.idAsignatura})" class="btn btn-sm btn-info"> Ver curso</button>  
          <button  onclick="verProfesor(${element.profesorId})" class="btn btn-sm btn-info"> Ver profesor</button>  
        </div>
      </div>    
    `;
    htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${card}`;

  }
  htmlRenderAsignaturas = `${htmlRenderAsignaturas} </div> <hr/>`;
  debugger;

  const tipoUsuario = sessionStorage.getItem("tipoUsuario");
  const idUsuario = sessionStorage.getItem("idUser");

  if (tipoUsuario != "Alumno") {
    /**
     * RENDERIZA LAS NOTAS
     */
    var htmlRenderNotas = ` 
      <h4 class="h4">Notas del Estudiante</h4>
      <p>
        Notas Registradas de ${Alumno.nombre}
      </p>
      <div class="d-flex">
        <table class="table table-hover">
        <thead>
          <tr>
            <th>N° Registro</th>
            <th>Trimestre</th>
            <th>Nota</th>
            <th>Asignatura</th>
            <th>Profesor</th>
            <th>Acciones </th>
          </tr>
        </thead>
        <tbody>
    `;
    for (let x = 0; x < Alumno.Notas.length; x++) {
      const element = Alumno.Notas[x];
      const row = `     
        <tr>
          <td>${element.notaId}</td>
          <td>${element.trimestre}</td>
          <td>${element.nota}</td>
          <td>${element.asignaturaNombre}</td>
          <td>${element.nombreProfesor}</td>
          <td><a class="btn btn-info" onclick="ViewNota(${element.notaId})">Ver Nota</a></td>
        </tr>
      `;
      htmlRenderNotas = `${htmlRenderNotas} ${row}`;
      debugger;
    }
    htmlRenderNotas = `${htmlRenderNotas} 
          </tbody>
        </table>
      </div>`;
    debugger;

    /**
     * RENDERIZA Faltas Asistencia
     */
    var htmlRenderAusencias = ` 
    <h4 class="h4">Ausencia</h4>
    <p>
      Ausencias de  de ${Alumno.nombre}
    </p>
    <div class="d-flex">
      <table class="table table-hover table-sm">
      <thead>
        <tr>
        <th>N° Registro</th>
        <th>Fecha</th>
        <th>Asignatura</th>
        <th>Profesor</th>       
        <th>Acciones </th>
        </tr>
      </thead>
      <tbody>
      `;
    for (let x = 0; x < Alumno.ausencias.length; x++) {
      const element = Alumno.ausencias[x];
      const row = `     
        <tr>
          <td>${element.faltaAsistenciaId}</td>
          <td>${element.fecha}</td>
          <td>${element.asignaturaNombre}</td>
          <td>${element.nombreProfesor}</td>
          <td><a class="btn btn-info" onclick=" ViewFaltaAsistencia(${element.faltaAsistenciaId})">Ver</a></td>
        </tr>
        `;
      htmlRenderAusencias = `${htmlRenderAusencias} ${row}`;
    }
    htmlRenderAusencias = `${htmlRenderAusencias} 
        </tbody>
      </table>
    </div>`;
    debugger;

    /* RENDERIZA LAS NOTAS */
    var htmlRenderNotas = ` 
      <h4 class="h4">Notas del Estudiante</h4>
      <p>
        Notas Registradas de ${Alumno.nombre}
      </p>
      <div class="d-flex">
      <table class="table table-hover">
      <thead>
        <tr>
          <th>N° Registro</th>
          <th>Trimestre</th>
          <th>Nota</th>
          <th>Asignatura</th>
          <th>Profesor</th>
          <th>Acciones </th>
        </tr>
      </thead>
      <tbody>
      `;
    for (let x = 0; x < Alumno.Notas.length; x++) {
      const element = Alumno.Notas[x];
      const row = `     
        <tr>
          <td>${element.notaId}</td>
          <td>${element.trimestre}</td>
          <td>${element.nota}</td>
          <td>${element.asignaturaNombre}</td>
          <td>${element.nombreProfesor}</td>
          <td><a class="btn btn-info" onclick="ViewNota(${element.notaId})">Ver Nota</a></td>
        </tr>
      `;
      htmlRenderNotas = `${htmlRenderNotas} ${row}`;
      debugger;
    }
    htmlRenderNotas = `${htmlRenderNotas} 
          </tbody>
        </table>
      </div>`;
  }

  // RENDERIZADO
  $("#renderbody").empty();
  htmlRender = `${htmlRender} ${htmlRenderAsignaturas} ${htmlRenderAusencias} ${htmlRenderNotas}`;
  $("#renderbody").html(htmlRender);
}

function fn_listar_alumnos() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Alumno.php?tipo=lista&formato=HTML",
    success: function (data) {
      $("#renderbody").html(data);
    },
    error: function (error) {
      $("#renderbody").html(
        '<div class="alert alert-warning" role="alert">Error Borrando datos</div>'
      );
    },
  });
}

function fn_borrar_alumno(id) {
  var isEditable = sessionStorage.getItem("editable");
  debugger;
  if (isEditable != "true") {
    const toast = document.getElementById("toast-base");
    toast.style.display = "block";
    const title = (document.getElementById("toast-title").innerText = `Error!`);
    const message = (document.getElementById(
      "toast-message"
    ).innerText = `No posees permisos para borrar esto`);

    toast.style.display = "block";
    console.error(error);
  } else {
    $.ajax({
      type: "DELETE",
      url:
        "http://localhost/app_School/WebService/ws_Alumno.php?idAlumno=" + id,
      success: function (data) {
        fn_listar_alumnos();
      },
      error: function (error) {
        $("#renderbody").html(
          '<div class="alert alert-warning" role="alert">Error Borrando datos</div>'
        );
      },
    });
  }
}

function fn_editar_alumno(id) {
  var isEditable = sessionStorage.getItem("editable");
  debugger;
  if (isEditable != "true") {
    const toast = document.getElementById("toast-base");
    toast.style.display = "block";
    const title = (document.getElementById("toast-title").innerText = `Error!`);
    const message = (document.getElementById(
      "toast-message"
    ).innerText = `No posees permisos para borrar esto`);
    toast.style.display = "block";
    console.error(error);
  } else {
    $.ajax({
      type: "POST",
      url:
        "http://localhost/app_School/WebService/ws_Alumno.php?idAlumno=" + id,
      success: function (data) {
        $("#renderbody").html(data);
      },
      error: function (error) {
        $("#renderbody").html(
          '<div class="alert alert-warning" role="alert">Error editando datos</div>'
        );
      },
    });
  }
}

function UpdateAlumno() {
  var isEditable = sessionStorage.getItem("editable");
    debugger;
  if (isEditable!= "true") {
    const toast = document.getElementById("toast-base");
    toast.style.display = "block";
    const title = (document.getElementById("toast-title").innerText = `Error!`);
    const message = (document.getElementById(
      "toast-message"
    ).innerText = `No posees permisos para borrar esto`);

    toast.style.display = "block";
    console.error(error);
  } else {


  const input_id = document.getElementById("txtIdAlumno").value;
  const input_nivel = document.getElementById("txtnivelid").value;
  const input_login = document.getElementById("txtlogin").value;
  const input_clave = document.getElementById("txtpass").value;
  const input_nombre = document.getElementById("txtnombre").value;
  const input_apellidos = document.getElementById("txtapellido").value;
  console.log(input_id);
  debugger;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Alumno.php?id=${input_id}&nivel_id=${input_nivel}&login=${input_login}&clave=${input_clave}&nombre=${input_nombre}&apellidos=${input_apellidos}`,
    data: {},
    success: (data) => {
      console.log(data);
      debugger;
      fn_listar_alumnos();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
}
