async function DeletePadre(id){
    var isEditable = sessionStorage.getItem("editable");
    debugger;
    if(isEditable){    
    await $.ajax({
        type: "DELETE",
        url: `http://localhost/app_School/WebService/ws_Padre.php?id=${id}`,
        data: {},
        success: (data) => {    
            verPadres();
        },
        error: (error) => {                
            const toast = document.getElementById("toast-base");
            toast.style.display = "block";
            const title = document.getElementById("toast-title").innerText= `Error!`;
            const message = document.getElementById("toast-message").innerText= `Este dato no puede ser borrado \nExisten dependencias      `;
            toast.style.display = "block";
            console.error(error);            

        },
    });    }else{
        const toast = document.getElementById("toast-base");
        toast.style.display = "block";
          const title = document.getElementById("toast-title").innerText= `Error!`;
          const message = document.getElementById("toast-message").innerText= `Este dato no puede ser borrado \nExisten dependencias      `;
      
          toast.style.display = "block";
        console.error(error);
    }
}

async function GetUpdatePadre(id){
    var Padre ={};
    await $.ajax({
        type: "VIEW",
        url: `http://localhost/app_School/WebService/ws_Padre.php?id=${id}`,
        data: {},
        success: (data) => {    
            var result = JSON.parse(data);
            console.table(result);
            Padre = result;
        },
        error: (error) => {
          $("#renderbody").empty();
          $("#renderbody").html(error);
          console.error(error);
        },
      });    
    var htmlRenderizado = `
    <div>
    <h5 class="h5">
        Modificar Usuario
    </h5>
    <p>
        Ingrese la información solicitada
    </p>
    <p class="text-danger" id="ErrorMessagePadre"><p>
    <form>
    <table class="table">
        <tbody>
            <tr>
                <th>Cedula</th>
                <td>
                    <input id="id" type="text" class="form-control" placeholder="111111111" value="${Padre.idUser}" readonly required>
                </td>
            </tr>
            <tr>
                <th>Nombre de Usuario</th>
                <td>
                    <input id="login" type="text" class="form-control" placeholder="Ejemplo"  value="${Padre.login}" required>
                </td>
            </tr>
            <tr>
                <th>Correo</th>
                <td>
                    <input id="correo" type="email" class="form-control" placeholder="sample@uh.com"  value="${Padre.email}" required>
                </td>
            </tr>
            <tr>
                <th>Contraseña</th>
                <td>
                    <input id="pass1" type="password" class="form-control" placeholder="Contraseña"  required>
                </td>
            </tr>                                    
            <tr>
                <th>Confirmar contraseña</th>
                <td>
                    <input id="pass2" type="password" class="form-control" placeholder="Confirmar Contraseña" required>
                </td>
            </tr>    
            <tr>
                <th>Nombre</th>
                <td>
                    <input id="nombre" type="text" class="form-control" placeholder="Nombre"  value="${Padre.nombre}" required>
                </td>
            </tr>    
            <tr>
                <th>Apellidos</th>
                <td>
                    <input id="apellidos" type="text" class="form-control" placeholder="Apellidos" ${Padre.apellidos} required>
                </td>
            </tr>    
        </tbody>
    </table>
    </form>
    <div>
        <button onclick="ActualizarPadre()" class="btn btn-success">
            Actualizar
        </button>
        <button onclick="" class="btn btn-success">
            Limpiar
        </button>
    </div>
</div>    

`;
  // RENDERIZADO DE DATOS
  $("#renderbody").empty();
  $("#renderbody").html(htmlRenderizado);      
}

async function ActualizarPadre() {
    const id= document.getElementById("id").value;
    const login = document.getElementById("login").value;
    const email = document.getElementById("correo").value;
    const pass1 = document.getElementById("pass1").value;
    const pass2 = document.getElementById("pass2").value;
    const nombre = document.getElementById("nombre").value;
    const apellidos = document.getElementById("apellidos").value;
    const errormessage = document.getElementById("ErrorMessagePadre");
    debugger;
    if(pass2 !== pass1 || pass1 === "" || pass2 === "" ){
        errormessage.innerText ="Las contraseñas no coinciden o se encuentran vacias";
    }else{
        errormessage.innerText ="Las contraseñas no coinciden";
        await $.ajax({
            type: "PUT",
            url: `http://localhost/app_School/WebService/ws_Padre.php?id=${id}&login=${login}&clave=${pass1}&email=${email}&nombre=${nombre}&apellidos=${apellidos}`,
            data: {},
            success: (data) => {    
                verPadre(id)
            },
            error: (error) => {        
                errormessage.innerText = error;
                console.error(error);
            },
          });    
    }
}

async function GetAgregarPadre(id){
    var htmlRenderizado = `

        <div>
        <h5 class="h5">
            Agregar Usuario
        </h5>
        <p>
            Ingrese la información solicitada
        </p>
        <p class="text-danger" id="ErrorMessagePadre"><p>
        <form>
        <table class="table">
            <tbody>
                <tr>
                    <th>Cedula</th>
                    <td>
                        <input id="id" type="text" class="form-control" placeholder="111111111" required>
                    </td>
                </tr>
                <tr>
                    <th>Nombre de Usuario</th>
                    <td>
                        <input id="login" type="text" class="form-control" placeholder="Ejemplo" required>
                    </td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td>
                        <input id="correo" type="email" class="form-control" placeholder="sample@uh.com" required>
                    </td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td>
                        <input id="pass1" type="password" class="form-control" placeholder="Contraseña" required>
                    </td>
                </tr>                                    
                <tr>
                    <th>Confirmar contraseña</th>
                    <td>
                        <input id="pass2" type="password" class="form-control" placeholder="Confirmar Contraseña" required>
                    </td>
                </tr>    
                <tr>
                    <th>Nombre</th>
                    <td>
                        <input id="nombre" type="text" class="form-control" placeholder="Nombre" required>
                    </td>
                </tr>    
                <tr>
                    <th>Apellidos</th>
                    <td>
                        <input id="apellidos" type="text" class="form-control" placeholder="Apellidos" required>
                    </td>
                </tr>    
            </tbody>
        </table>
        </form>
        <div>
            <button onclick="ValidarInfo()" class="btn btn-success">
                Agregar
            </button>
            <button onclick="" class="btn btn-success">
                Limpiar
            </button>
        </div>
    </div>    
    
    `;
      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderizado);      
}

async function ValidarInfo(){
    const id= document.getElementById("id").value;
    const login = document.getElementById("login").value;
    const email = document.getElementById("correo").value;
    const pass1 = document.getElementById("pass1").value;
    const pass2 = document.getElementById("pass2").value;
    const nombre = document.getElementById("nombre").value;
    const apellidos = document.getElementById("apellidos").value;
    const errormessage = document.getElementById("ErrorMessagePadre");

    if(pass2 !== pass1 || pass1 === "" || pass2 === "" ){
        errormessage.innerText ="Las contraseñas no coinciden o se encuentran vacias";
    }else{
        errormessage.innerText ="Las contraseñas no coinciden";
        await $.ajax({
            type: "POST",
            url: `http://localhost/app_School/WebService/ws_Padre.php?id=${id}&login=${login}&clave=${pass1}&email=${email}&nombre=${nombre}&apellidos=${apellidos}`,
            data: {},
            success: (data) => {    
                verPadre(id)
            },
            error: (error) => {        
                errormessage.innerText = error;
              console.error(error);
            },
          });    
    }
}

async function verPadre(id){
    var Padre ={};
    await $.ajax({
        type: "VIEW",
        url: `http://localhost/app_School/WebService/ws_Padre.php?id=${id}`,
        data: {},
        success: (data) => {    
            var result = JSON.parse(data);
            console.table(result);
            Padre = result;
        },
        error: (error) => {
          $("#renderbody").empty();
          $("#renderbody").html(error);
          console.error(error);
        },
      });    

      var htmlRenderizado =`
        <div>
            <h5 class="h5">
                Información del Padre
            </h5>
            <p>
                A continuación se muestra la información existente del padre
            </p>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Cedula</th>
                        <td>${Padre.idUser}</td>
                    </tr>
                    <tr>
                        <th>Nombre de Usuario</th>
                        <td>${Padre.login}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>${Padre.email}</td>
                    </tr>                    
                    <tr>
                        <th>Nombre</th>
                        <td>${Padre.nombre}</td>
                    </tr>
                    <tr>
                        <th>Apellidos</th>
                        <td>${Padre.apellidos}</td>
                    </tr>                                    
                </tbody>
            </table>
            <hr />  
            <h6 class="h6">
                Información del Padre
            </h6>
            <p>
                A continuación se muestra la información existente del padre
            </p>
            <div class="container d-flex">                      
      `;
      if(Padre.Alumnos.length >0){
        for (let fxG = 0; fxG < Padre.Alumnos.length; fxG++) {
            const element = Padre.Alumnos[fxG];
            var Card = `
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Alumno</h5>
                        <h6 class="card-subtitle mb-2 text-muted">${element.nombre}</h6>
                        <p class="card-text">
                            Hijo Registrado. Identificador ${element.id}, <br/>
                            Nombre Completo ${element.apellidos} ${element.nombre}
                        </p>
                        <button type="button" class="btn btn-light" onclick="verAlumno(${element.id})">Ver Información</button>
                    </div>
                </div>                    
            `;
            htmlRenderizado = `${ htmlRenderizado} ${Card}`;            
        }
        htmlRenderizado = `
        ${ htmlRenderizado}
            </div>
        </div>
        `;            
      }else{
        htmlRenderizado = `
        ${ htmlRenderizado}
            </div>
        </div>
        `;            
      }
      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderizado);      
}

async function verPadres(){
    let htmlRenderizado = `
    <div>
        <h4>
            Lista de Padres Registrados
        </h4>
        <p>
            Lista de padres registrados en el sistema
        </p>
    </div>    
    `;
    var ArregloPadres = [];
    await $.ajax({
        type: "GET",
        url: "http://localhost/app_School/WebService/ws_Padre.php?tipo=lista",
        data: {},
        success: (data) => {
            debugger;
            var result = JSON.parse(data);
            console.table(result);
            ArregloPadres=result;
            console.log(ArregloPadres);
        },
        error: (error) => {
          $("#renderbody").empty();
          $("#renderbody").html(error);
          console.error(error);
        },
      });    
      debugger;
      htmlRenderizado = `${htmlRenderizado } 
        <table class="table table-hover">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>`;
        debugger;
      for (let gs = 0; gs < ArregloPadres.length; gs++) {
        const element = ArregloPadres[gs];
        var row = `
        <tr>
            <td> ${element.idUser}</td>
            <td> ${element.nombre} ${element.apellidos}</td>
            <td> ${element.email}</td>
            <td onclick="verPadre(${element.idUser})" class="btn btn-sm text-dark btn-info mr-1" > 
                <i class="bi bi-info-circle"></i>
            </td>
            <td onclick="GetUpdatePadre(${element.idUser})" class="btn btn-sm text-dark btn-primary" > 
                <i class="bi bi-pencil-square"></i> 
            </td>
            <td onclick="DeletePadre(${element.idUser})" class="btn btn-sm text-dark btn-danger" > 
                <i class="bi bi-trash3"></i> 
            </td>
        </tr>        
        `;
        htmlRenderizado = `${htmlRenderizado }  ${row}`;                  
      }
      htmlRenderizado = `${htmlRenderizado } 
        </tbody>
      </table>`;
      debugger;

      // RENDERIZADO DE DATOS
      $("#renderbody").empty();
      $("#renderbody").html(htmlRenderizado);
}

