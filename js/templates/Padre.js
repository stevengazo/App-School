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
            <td onclick="" class="btn btn-sm text-dark btn-primary" > 
                <i class="bi bi-pencil-square"></i> 
            </td>
            <td onclick="" class="btn btn-sm text-dark btn-danger" > 
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

