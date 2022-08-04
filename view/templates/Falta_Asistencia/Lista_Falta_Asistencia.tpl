
<div>
        <div>
            <h4>
                Lista de Faltas de asistencia
            </h4>
            <p>
                A continuación se muestran las faltas realizadas por los estudiantes
            </p>            
        </div>
    </div>
    <table class="table" id="faltaAsistenciasList">
        <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Id Estudiante
                </th>
                <th>
                    Id Materia
                </th>
                <th>
                    Día
                </th>
                <th>
                    Motivo
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody  >            
        </tbody>
    </table>
</body>
<script>

    $.ajax({
        type:  'GET',
        url: 'http://localhost/app_School/WebService/ws_FaltaAsistencia.php',
        data: {},
        success: (data)=>{
            /*
                data es un arreglo de objetos 
             */
            for (let i = 0; i < data.length; i++) {
                console.log(data[i]);                
                /*atributos*/
                // CREACIÒN DE FILA
                const row = document.createElement("tr");                
                // CREACIÒN DE CELDA
                const celdaId = document.createElement("td");
                celdaId.innerText = data[i].id;
                // AÑADIDO DE CELDA A LA FILA
                row.appendChild(celdaId);
                // CREACIÒN DE CELDA
                const celdaAlumno = document.createElement("td");
                celdaAlumno.innerText =  data[i].apellidos + " " + data[i].nombre;
                // AÑADIDO DE CELDA A LA FILA                
                row.appendChild(celdaAlumno)
                // CREACIÒN DE CELDA
                const celdaAsignatura = document.createElement("td");
                celdaAsignatura.innerText =  " "+  data[i].asignatura;
                // AÑADIDO DE CELDA A LA FILA                
                row.appendChild(celdaAsignatura);
                // CREACIÒN DE CELDA
                const celdaFecha = document.createElement("td");
                celdaFecha.innerText =  data[i].fecha;    
                // AÑADIDO DE CELDA A LA FILA                
                row.appendChild(celdaFecha);            
                // CREACIÒN DE CELDA            
                const celdaJustificada = document.createElement("td");
                celdaJustificada.innerText =  data[i].justificada;
                // AÑADIDO DE CELDA A LA FILA
                row.appendChild(celdaJustificada);

                /*
                    botones
                */

                const anchorVer = document.createElement("a");
                // AÑADIDO DE URL                        
                    anchorVer.href="index.php?action=verInfoFaltas&Controller=FaltaAsistencia&idFalta=" + data[i].id;
                // AÑADIDO DE ESTILO
                    anchorVer.className= "btn btn-info text-dark";
                // AÑADIDO DE TEXTO
                    anchorVer.innerText= "Ver";
                // AÑADIDO DE ANCHOR A LA FILA                
                row.appendChild(anchorVer);

                const anchorEditar = document.createElement("a");
                // AÑADIDO DE URL                        
                    anchorEditar.href="index.php?action=EditarInfoFaltas&Controller=FaltaAsistencia&idFalta=" + data[i].id;
                // AÑADIDO DE ESTILO
                    anchorEditar.className= "btn btn-success text-dark";
                // AÑADIDO DE TEXTO
                    anchorEditar.innerText= "Editar";
                // AÑADIDO DE ANCHOR A LA FILA                                
                    row.appendChild(anchorEditar);

                const anchorEliminar = document.createElement("a");
                // AÑADIDO DE URL                        
                    anchorEliminar.href="index.php?action=EditarInfoFaltas&Controller=FaltaAsistencia&idFalta=" + data[i].id;
                // AÑADIDO DE ESTILO
                    anchorEliminar.className= "btn btn-danger text-dark";
                // AÑADIDO DE TEXTO
                    anchorEliminar.innerText= "Eliminar";
                // AÑADIDO DE ANCHOR A LA FILA                                
                    row.appendChild(anchorEliminar);

                $('#faltaAsistenciasList').find('tbody').append(row);
            }
            

        },
        error: (error)=>{
            console.error(error);
        }
    });

    
</script>