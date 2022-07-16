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

    <title>Lista Falta Asistencia</title>
</head>

<body class="container">
    <div>
        <div>
            <h4>
                Lista de Faltas de asistencia
            </h4>
            <p>
                A continuación se muestran las faltas realizadas por los estudiantes
            </p>
            <a href="index.php?action=InsertarAusencia">Agregar Nueva Ausencia</a>
        </div>
    </div>
    <table class="table">
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
        <tbody>
            {assign var='counter' value={0}}
            {section name=item loop=$ListaFaltasAsistencia}
            <tr>
                <!--id-->
                <td>
                    {$ListaFaltasAsistencia[$counter].id}
                </td>
                <!--id Estudiante-->
                <td>
                    {$ListaFaltasAsistencia[$counter].alumno_id}
                </td>
                <!--Id Materia-->
                <td>
                    {$ListaFaltasAsistencia[$counter].asignatura_id}
                </td>
                <!--Dia-->
                <td>
                    {$ListaFaltasAsistencia[$counter].fecha}
                </td>
                <!--Motivo-->
                <td>
                    {$ListaFaltasAsistencia[$counter].justificada}
                </td>
                <!--Botton ver-->
                <td>
                    <button type="button" class="btn btn-primary">
                        <a class="text-light"
                            href="index.php?action=verInfoFaltas&idFalta={$ListaFaltasAsistencia[$counter].id}">Ver
                            Detalles</a>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-success">
                        <a class="text-light"
                            href="index.php?action=verInfoFaltas&idFalta={$ListaFaltasAsistencia[$counter].id}">Ver
                            Editar</a>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger">
                        <a class="text-light"
                            href="index.php?action=verInfoFaltas&idFalta={$ListaFaltasAsistencia[$counter].id}">Ver
                            Eliminar</a>
                    </button>
                </td>
            </tr>
            {assign var='counter' value=$counter+1}
            {/section}
        </tbody>
    </table>
</body>

</html>