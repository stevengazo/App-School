<html>

<head>
    <!-- Bootstrap via jsDelivr-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Borrar</title>
</head>

<body class= "container">
    <div>
        <div>
            <h4>
               Borrar la información de la Falta en la Asistencia
            </h4>
            <p>
                A continuación se muestran la información de la falta Seleccionada
            </p>
        </div>
    </div>
    <div>
    <table class="table">
    <tbody>                  
            <tr>                 
                <th>
                    id Falta de Asistencia
                </th>               
                <!--id-->
                <td>
                    {$ObjetoFaltaAsistencia.id}
                </td>
           </tr>
           <tr>
                <th>
                    id Estudiante
                </th>        
                <!--id Estudiante-->
                <td>
                {$ObjetoFaltaAsistencia.alumno_id}
                </td>
           </tr>
           <tr>          
                <th>
                    Asignatura
                </th>              
                <!--Id Materia-->
                <td>
                {$ObjetoFaltaAsistencia.asignatura_id}
                </td>
           </tr>
           <tr>               
                <th>
                    Fecha
                </th>        
                <!--Dia-->
                <td>
                {$ObjetoFaltaAsistencia.fecha}
                </td>
           </tr>
           <tr>       
                <th>
                    Justificación
                </th>        
                <!--Motivo-->
                <td>
                {$ObjetoFaltaAsistencia.justificada}
                </td>
           </tr>          
    </tbody>
    </table>
    <div>
        <button class="btn btn-outline-danger">Eliminar Archivo</button>
        <button class="btn btn-outline-info" ><a href="index.php?action=ListaFaltaAsistencia">Volver Atras</a></button>
    </div>
    </div>

</body>

</html>