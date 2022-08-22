"Use strict";
async function ViewAsignatura(id) {
  let ObjectoAsignatura = {};
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Asignatura.php?id=${id}`,
    success: function (data) {
      ObjectoAsignatura = JSON.parse(data);
    },
    error: function (error) {
      $("#renderbody").html(
        '<div class="alert alert-danger" role="alert">Error al cargar datos</div>'
      );
    },
  });

  const tipoUsuario = sessionStorage.getItem("tipoUsuario");
  debugger;
  if (ObjectoAsignatura.length == 0) {
    $("#renderbody").html(
      '<div class="alert alert-danger" role="alert">Error al cargar datos</div>'
    );
  } else {
    console.log(ObjectoAsignatura);
    // Declaración de tabla inicial
    let htmlRenderAsignaturas = `
      <h4>Información de Asignatura</h4>    
      <p>
        Información respectiva a la asignatura
      </p>
      <br />
      <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <th>Identificador</th><td>${ObjectoAsignatura.id}</td>
        </tr>
        <tr>
          <th>Nombre</th><td>${ObjectoAsignatura.nombreAsignatura}</td>
        </tr>
        <tr>
          <th>Profesor</th><td>${ObjectoAsignatura.nombreProfesor}</td>
        </tr>
        <tr>
          <th>Nivel</th><td>${ObjectoAsignatura.nivel}</td>
        </tr>                
        <tr>
          <th>Curso</th><td>${ObjectoAsignatura.Curso}</td>
        </tr>                
        <tr>
          <th>Aula</th><td>${ObjectoAsignatura.Aula}</td>
        </tr>                
      </tbody>
      </table>

    `;
    // Renderizado de Alumnos
    htmlRenderAsignaturas = `${htmlRenderAsignaturas}
    <hr>
    <h5>
      Alumnos
    </h5>

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th> Cedula </th>
        <th> Nombre </th>
        <th> Acciones </th>                      
      </tr>
    </thead>
    <tbody>    
    `;

    // Renderizado de Alumnos
    for (let xc = 0; xc < ObjectoAsignatura.Alumnos.length; xc++) {
      const element = ObjectoAsignatura.Alumnos[xc];
      const row = `
        <tr>
          <td>${element.Id}</td>
          <td>${element.nombreAlumno} ${element.apellidosAlumno} </td>
          <td><button onclick="verAlumno(${element.Id})"  class="btn btn-info btn-sm" >Ver</button></td>
        </tr>
      `;
      htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${row}`;
    }
    htmlRenderAsignaturas = `${htmlRenderAsignaturas}
        </tbody>
      </table>
    `;

    if (tipoUsuario !== "Alumno") {
      // Renderizado de Ausencias
      htmlRenderAsignaturas = `${htmlRenderAsignaturas}
    <hr>
    <h5>
      Ausencias
    </h5>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>  N°</th>
          <th>  Fecha </th>
          <th>  Alumno </th>                      
          <th> Acciones </th>                              
        </tr>
      </thead>
      <tbody>    
      `;
      // Renderizado de Alumnos
      for (let jx = 0; jx < ObjectoAsignatura.Ausencias.length; jx++) {
        const element = ObjectoAsignatura.Ausencias[jx];
        const row = `
        <tr>
          <td>${element.Id}</td>
          <td>${element.fecha}</td>
          <td>${element.alumnoNombre} ${element.alumnoApellidos}</td>
          <td><button onclick="ViewFaltaAsistencia(${element.id})"  class="btn btn-info btn-sm" >Ver</button></td>
        </tr>
      `;
        htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${row}`;
      }
      htmlRenderAsignaturas = `${htmlRenderAsignaturas}
      </tbody>
    </table>
    `;
      // Renderizado de Notas
      htmlRenderAsignaturas = `${htmlRenderAsignaturas}
      <hr>
      <h5>
        Notas
      </h5>
      <p>
        Lista de Notas Registradas. A continuación se muestran las notas asociadas a esta asignatura.
      </p>      

      <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>  N°</th>
          <th>  Trimestre </th>
          <th>  Alumno </th>                      
          <th>  Nota </th>                              
          <th>  Acciones </th>                                        
        </tr>
      </thead>
      <tbody>    
    `;
      // Renderizado de Alumnos
      for (let fx = 0; fx < ObjectoAsignatura.Notas.length; fx++) {
        const element = ObjectoAsignatura.Notas[fx];
        const row = `
        <tr>
          <td>${element.notaId}</td>
          <td>${element.trimestre}</td>
          <td>${element.nombreAlumno}</td>
          <td>${element.nota}</td>                                      
          <td><button onclick="ViewNota(${element.notaId})"  class="btn btn-info btn-sm" >Ver</button></td>
        </tr>
      `;
        htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${row}`;
      }
      htmlRenderAsignaturas = `${htmlRenderAsignaturas}
      </tbody>
    </table>
    `;
    }

    // Renderizado de Horarios
    htmlRenderAsignaturas = `${htmlRenderAsignaturas}
      <hr>
      <h5>
        Horarios
      </h5>
      <p>
        Lista de Horarios de la asignatura
      </p>
      <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>  N°</th>
          <th>  Día </th>
          <th>  Hora Inicio </th>                      
          <th>  Hora Final </th>                              
        </tr>
      </thead>
      <tbody>    
    `;
    // Renderizado de Horarios
    for (let gs = 0; gs < ObjectoAsignatura.Horarios.length; gs++) {
      const element = ObjectoAsignatura.Horarios[gs];
      const row = `
        <tr>
          <td>${element.id}</td>                    
          <td>${element.dia}</td>                              
          <td>${element.horaInicio}</td>                                        
          <td>${element.horaFin}</td>                                                  
        </tr>
      `;
      htmlRenderAsignaturas = `${htmlRenderAsignaturas} ${row}`;
    }
    htmlRenderAsignaturas = `${htmlRenderAsignaturas}
    </tbody>
    </table>
    `;

    // RENDERIZADO DEL BODY
    $("#renderbody").html(htmlRenderAsignaturas);
  }
}

function fn_listar_asig() {
  $.ajax({
    type: "GET",
    url: "http://localhost/app_School/WebService/ws_Asignatura.php?tipo=listaHtml",
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

function fn_borrar_asig(id) {
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
    $.ajax({
      type: "DELETE",
      url: "http://localhost/app_School/WebService/ws_Asignatura.php?id=" + id,
      success: function (data) {
        fn_listar_asig();
      },
      error: function (error) {
        $("#renderbody").html(
          '<div class="alert alert-warning" role="alert">Error Borrando datos</div>'
        );
      },
    });
  }
}

function fn_editar_asignatura(id) {
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
    $.ajax({
      type: "POST",
      url: "http://localhost/app_School/WebService/ws_Asignatura.php?id=" + id,
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
}

function PostUpdateAsignatura() {
  const input_id = document.getElementById("txtIdAsig").value;
  const input_nivel = document.getElementById("txtnivel").value;
  const input_profesor = document.getElementById("txtprof").value;
  const input_nombre = document.getElementById("txtnombre").value;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Asignatura.php?id=${input_id}&nivel_id=${input_nivel}&profesor_id=${input_profesor}&nombre=${input_nombre}`,
    data: {},
    success: (data) => {
      fn_listar_asig();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}
