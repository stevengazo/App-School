function fn_listar_profesor(){
  $.ajax({
        type: "GET",
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?accion=listar',
        success: function(data) {
            $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
}

function fn_borrar_profesor(id){
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
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?idProfesor='+id,
        success: function(data) {
        fn_listar_profesor();
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error Borrando datos</div>');
        }
      });
    }
}

function fn_editar_profesor(id){
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
        url: 'http://localhost/app_School/WebService/ws_Profesor.php?idProfesor='+id,
        success: function(data) {
          $("#renderbody").empty();
          $("#renderbody").html(data);
        },
        error: function(error) {
            $("#renderbody").html('<div class="alert alert-warning" role="alert">Error editando datos</div>');
        }
      });
    }
}

function PostUpdateProfesor() {
const input_id= document.getElementById('txtIdProfesor').value;
const input_usuario= document.getElementById('txtusuario').value;
const input_clave= document.getElementById('txtpass').value;
const input_nombre= document.getElementById('txtnombre').value;
const input_apellidos= document.getElementById('txtap').value;
const input_email= document.getElementById('txtemail').value;
const input_especialista= document.getElementById('espe').value;                    
alert(`El valor es: ${input_especialista}`);
console.log(input_usuario);
debugger;

  $.ajax({
    type: "PUT",
    url: `http://localhost/app_School/WebService/ws_Profesor.php?id=${input_id}&login=${input_usuario}&clave=${input_clave}&nombre=${input_nombre}&apellidos=${input_apellidos}&email=${input_email}&especialista=${input_especialista}`,
    data: {},
    success: (data) => {
    console.log(data);
    fn_listar_profesor();
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}


async function verProfesor(id){
  $Profesor= {};
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Profesor.php?id=${id}`,
    data: {},
    success: (data) => {
    console.log(data);
      Profesor = JSON.parse(data);
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
  var htmlRender = `
  <div>
  <h4>
      Información de Profesor
  </h4>

  <p>
      Información existente del profesor
  </p>
  <hr/>
  <table class="table">
      <tbody>
          <tr>
              <th>
                  Cedula
              </th>
              <td>
              ${Profesor.id}
              </td>
          </tr>
          <tr>
              <th>
                  Nombre
              </th>
              <td>
              ${Profesor.nombre}                  
              </td>
          </tr>
          <tr>
              <th>
                  Apellidos
              </th>
              <td>
                  ${Profesor.apellidos}
              </td>
          </tr>
          <tr>
              <th>
                  Correo
              </th>
              <td>
                  ${Profesor.email}
              </td>
          </tr>                                    
      </tbody>
  </table>
  <hr/>

  <h5>
      Lista de Cursos
  </h5>
  <div class="d-flex">

  
  `;

for (let dsf = 0; dsf < Profesor.Asignaturas.length; dsf++) {
  const element =Profesor.Asignaturas[dsf];
  const card = `
    <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">${element.nombre}</h5>
      <h6 class="card-subtitle mb-2 text-muted">Asignatura Impartida</h6>
      <p class="card-text"> Aula: ${element.aula} - Curso ${element.curso}.</p>
      <button class="btn btn-" onclick="ViewAsignatura(${element.id})">
        Ver Curso
      </button>
    </div>
  </div>  
  `;
  htmlRender=`  ${htmlRender} ${card}`;  
}
htmlRender=`  ${htmlRender} 
  </div>
  </div>
`;
  $("#renderbody").empty();
  $("#renderbody").html(htmlRender);
}
