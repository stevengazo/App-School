async function deleteHorario(id){
    await $.ajax({
        type: "DELETE",
        url: `http://localhost/app_School/WebService/ws_Horarios.php?idHorario=${id}`,
        data: {},
        success: (data) => {
            VerListaHorarios();
        },
        error: (error) => {
          console.error("NO LOGRO BORRAR LOS DATOS");
          arrayObjectsAlumnos = null;
        },
      });         
}

async function InsertarHorario(){
    const id = document.getElementById("id").value;
    const idAsignatura = document.getElementById("idAsignaturas").value;
    const dia = document.getElementById("dia").value;
    const horaInicio = document.getElementById("horainicio").value;
    const horafinal = document.getElementById("horafinal").value;
    await $.ajax({
        type: "GET",
        url: `http://localhost/app_School/WebService/ws_Horarios.php?idHorario=${id}&asignatura_id=${idAsignatura}&dia=${dia}&horaInicio=${horaInicio}&horaFin=${horafinal}`,
        data: {},
        success: (data) => {
            VerListaHorarios();
        },
        error: (error) => {
          console.error("no adquirio los datos");
          arrayObjectsAlumnos = null;
        },
      });     
}
async function getInsertHorario(){
          const htmlRenderHorarios = `
                <div>
                <h3>
                    Información del horario
                </h3>
                <p>
                    Actualice la información del administrador solicitada
                </p>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>
                                N°
                            </th>
                            <td>
                                <input id="id" type="text" class="form-control" value="" placeholder="Id" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Asignatura
                            </th>
                            <td>
                                <select id="idAsignaturas" type="text" class="form-control" value="" >
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Día
                            </th>
                            <td>
                                <input id="dia" type="date" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Hora Inicio
                            </th>
                            <td>
                                <input id="horainicio" type="time" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Hora Final
                            </th>
                            <td>
                                <input id="horafinal" type="time" class="form-control">
                            </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <button class="btn btn-success" onclick="InsertarHorario()">
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
          $("#renderbody").html(htmlRenderHorarios);

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
                document.getElementById("idAsignaturas").appendChild(tmpHTMl);
              }
            },
            error: (error) => {
              console.error("no adquirio los datos");
              arrayObjectsAlumnos = null;
            },
          }); 
          
          
          await $.ajax({
            type: "GET",
            url: "http://localhost/app_School/WebService/ws_Horarios.php?tipo=lastid",
            data: {},
            success: (data) => {
                const valor= JSON.parse(data);
                var numero = parseInt(valor.ultimoId);
                numero = numero+ 1;
                document.getElementById("id").value= numero;

            },
            error: (error) => {
              console.error("no adquirio los datos");
              arrayObjectsAlumnos = null;
            },
          });           

}


async function verHorario(id) {
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Horarios.php?idHorario=${id}`,
    data: {},
    success: (data) => {
      const results = JSON.parse(data);
      console.table(results);
      const htmlRenderHorarios = `
                <div>
                <h3>
                    Información del horario
                </h3>
                <p>
                    Actualice la información del administrador solicitada
                </p>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>
                                N°
                            </th>
                            <td>
                                ${results.id}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Asignatura
                            </th>
                            <td>
                                ${results.nombre}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Día
                            </th>
                            <td>
                            ${results.dia}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Hora Inicio
                            </th>
                            <td>
                            ${results.horaInicio}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Hora Final
                            </th>
                            <td>
                            ${results.horaFin}
                            </td>
                        </tr>                                                
                    </tbody>
                </table>
                </div>                            
                `;
      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderHorarios);
    },
    error: (error) => {
      console.log(error);
    },
  }); /*     */
}

/**
 * Trae la lista de horarios disponibles
 */
async function VerListaHorarios() {
  await $.ajax({
    type: "GET",
    url: `http://localhost/app_School/WebService/ws_Horarios.php?tipo=lista`,
    data: {},
    success: (data) => {
      console.log(JSON.parse(data));
      debugger;
      const results = JSON.parse(data);
      var htmlRenderHorarios = `
          <div>
          <h3>
              Información de Horarios
          </h3>
          <p>
              Información de los horarios disponibles
          </p>      
          <table class="table">
              <thead>
                  <tr>
                      <th>
                          N°
                      </th>
                      <th>
                          Asignatura
                      </th>
                      <th>
                          Día
                      </th>
                      <th>
                          Hora inicio
                      </th>          
                      <th>
                          Hora Final
                      </th>         
                      <th colspan="3">
                          Acciones
                      </th>                                       
                  </tr>
              </thead>
              <tbody>        
        `;
      for (let dsf = 0; dsf < results.length; dsf++) {
        const element = results[dsf];

        const row = `
          <tr>
              <td>
                  ${element.id}
              </td>
              <td>
                  ${element.nombre}
              </td>
              <td>
                  ${element.dia}
              </td>
              <td>
                  ${element.horaInicio}
              </td>
              <td>
                  ${element.horaFin}
              </td>
              <td onclick="verHorario(${element.id})" class="btn btn-sm text-dark btn-info mr-1" > 
                <i class="bi bi-info-circle"></i>
              </td>
              <td onclick="deleteHorario(${element.id})" class="btn btn-sm text-dark btn-danger" > 
                <i class="bi bi-trash3"></i> 
              </td>
          </tr>      
          `;
        htmlRenderHorarios = `${htmlRenderHorarios}  ${row}`;
      }
      htmlRenderHorarios = `${htmlRenderHorarios} 
              </tbody>
            </table>
        </div>
          `;

      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderHorarios);
    },
    error: (error) => {
      console.log(error);
    },
  });
}
