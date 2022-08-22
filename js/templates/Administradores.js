async function AgregarAdmin() {
  const id = document.getElementById("id").value;
  const login = document.getElementById("userName").value;
  const pass1 = document.getElementById("pass1").value;
  const pass2 = document.getElementById("pass2").value;
  const email = document.getElementById("email").value;
  const phareError = document.getElementById("adminErrorMessage");
  if (pass2 !== pass1 || pass1 === "" || pass2 === "") {
    phareError.innerText = "Verifique la contraseña";
  } else {
    await $.ajax({
      type: "POST",
      url: `http://localhost/app_School/WebService/ws_Administradores.php?id=${id}&login=${login}&password=${pass1}&email=${email}`,
      data: {},
      success: (data) => {
        verAdministradores();
      },
      error: (error) => {
        phareError.innerText = "Errror..";
      },
    });
  }
}

async function getInsertAdmin() {
  var htmlRenderAdmin = `
              <div>
              <h3>
                  Actualizar información de Administrador
              </h3>
              <p>
                  Actualice la información del administrador solicitada
              </p>
              <p id="adminErrorMessage"></p>
              <table class="table">
                  <tbody>
                      <tr>
                          <th>
                              Id
                          </th>
                          <td>
                              <input id="id" type="text" class="form-control" value="" >
                          </td>
                      </tr>
                      <tr>
                          <th>
                              Nombre de Usuario
                          </th>
                          <td>
                              <input id="userName" type="text" class="form-control" value="" placeholder="SGazo">
                          </td>
                      </tr>
                      <tr>
                          <th>
                              Contraseña
                          </th>
                          <td>
                              <input id="pass1" type="password" class="form-control" placeholder="contraseña">
                          </td>
                      </tr>
                      <tr>
                          <th>
                              Confirme contraseña
                          </th>
                          <td>
                              <input id="pass2" type="password" class="form-control" placeholder="contraseña">
                          </td>
                      </tr>
                      <tr>
                          <th>
                              Correo
                          </th>
                          <td>
                              <input id="email" type="email" class="form-control" value=""
                                  placeholder="ejemplo@email.com">
                          </td>
                      </tr>
                      <tr>
                      <td>
                      <button onclick="AgregarAdmin()" class="btn btn-success">
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
  $("#renderbody").html(htmlRenderAdmin);
}

async function BorrarAdmin(id) {
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
    await $.ajax({
      type: "DELETE",
      url: `http://localhost/app_School/WebService/ws_Administradores.php?id=${id}`,
      data: {},
      success: (data) => {
        verAdministradores();
      },
      error: (error) => {
        phareError.innerText = "Errror..";
      },
    });
  }
}

async function ActualizarAdmin() {
  const id = document.getElementById("id").value;
  const login = document.getElementById("userName").value;
  const pass1 = document.getElementById("pass1").value;
  const pass2 = document.getElementById("pass2").value;
  const email = document.getElementById("email").value;
  const phareError = document.getElementById("adminErrorMessage");
  if (pass2 !== pass1 || pass1 === "" || pass2 === "") {
    phareError.innerText = "Verifique la contraseña";
  } else {
    await $.ajax({
      type: "PUT",
      url: `http://localhost/app_School/WebService/ws_Administradores.php?id=${id}&login=${login}&password=${pass1}&email=${email}`,
      data: {},
      success: (data) => {
        verAdministradores();
      },
      error: (error) => {
        phareError.innerText = "Errror..";
      },
    });
  }
}

async function GetUpdateAdmin(id = 0) {
  id = id.toString();
  await $.ajax({
    type: "VIEW",
    url: `http://localhost/app_School/WebService/ws_Administradores.php?id=${id}`,
    data: {},
    success: (data) => {
      const result = JSON.parse(data);

      var htmlRenderAdmin = `
            <div>
            <h3>
                Actualizar información de Administrador
            </h3>
            <p>
                Actualice la información del administrador solicitada
            </p>
            <p id="adminErrorMessage"></p>
            <table class="table">
                <tbody>
                    <tr>
                        <th>
                            Id
                        </th>
                        <td>
                            <input id="id" type="text" class="form-control" value="${id.toString()}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nombre de Usuario
                        </th>
                        <td>
                            <input id="userName" type="text" class="form-control" value="${
                              result.login
                            }" placeholder="SGazo">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contraseña
                        </th>
                        <td>
                            <input id="pass1" type="password" class="form-control" placeholder="contraseña">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Confirme contraseña
                        </th>
                        <td>
                            <input id="pass2" type="password" class="form-control" placeholder="contraseña">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Correo
                        </th>
                        <td>
                            <input id="email" type="email" class="form-control" value="${
                              result.email
                            }"
                                placeholder="ejemplo@email.com">
                        </td>
                    </tr>
                    <tr>
                    <td>
                    <button onclick="ActualizarAdmin()" class="btn btn-success">
                            Actualizar
                        </button>
                    </td>                    
                    </tr>
                </tbody>
            </table>
        </div>    
        `;
      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderAdmin);
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });
}

async function verAdministradores() {
  var htmlRenderAdmin = `
        <div>
        <h3>
            Lista de Administradores del Sistema
        </h3>
        <p>
            A continuación se muestran todos los administradores del sistema existentes
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Identificador
                    </th>
                    <th>
                        Nombre de Usuario
                    </th>                
                    <th>
                        Correo
                    </th> 
                    <th colspan="2">
                    Acciones
                </th>                                                     
                </tr>
            </thead>
            <tbody>        
    
    `;

  await $.ajax({
    type: "GET",
    url: `http://localhost/app_School/WebService/ws_Administradores.php`,
    data: {},
    success: (data) => {
      var result = JSON.parse(data);
      console.table(result);
      for (let dsf = 0; dsf < result.length; dsf++) {
        const element = result[dsf];
        htmlRenderAdmin = `${htmlRenderAdmin} 
            <tr>
                <td>
                    ${element.id}
                </td>
                <td>
                    ${element.login}
                </td>
                <td>
                    ${element.email}
                </td>
                <td onclick="GetUpdateAdmin(${element.id})" class="btn btn-sm text-dark btn-primary" > 
                    <i class="bi bi-pencil-square"></i> 
                </td>
                <td onclick="BorrarAdmin(${element.id})" class="btn btn-sm text-dark btn-danger" > 
                    <i class="bi bi-trash3"></i> 
                </td>                                
            </tr>                
            `;
      }
    },
    error: (error) => {
      $("#renderbody").empty();
      $("#renderbody").html(error);
      console.error(error);
    },
  });

  htmlRenderAdmin = `${htmlRenderAdmin} 
              </tbody>
            </table>
        </div>
      `;

  // RENDERIZADO DE DATOS
  $("#renderbody").empty();
  $("#renderbody").html(htmlRenderAdmin);
}
