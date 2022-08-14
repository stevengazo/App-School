    <div>
        <div>
            <h4>
                Información de la Falta en la Asistencia
            </h4>
            <p>
                A continuación se muestran la información de la falta Seleccionada
            </p>
            <p>
                <!-- Error Messge-->
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
                        Estudiante
                    </th>
                    <!--id Estudiante-->
                    <td>
                        {$ObjetoFaltaAsistencia.apellidos}
                        {$ObjetoFaltaAsistencia.nombre}
                    </td>
                </tr>
                <tr>
                    <th>
                        Asignatura
                    </th>
                    <!--Id Materia-->
                    <td>
                        {$ObjetoFaltaAsistencia.asignatura}
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
        <button class="btn btn-outline-info"> <a class=" nav-link active"
                href="index.php?action=ListaFaltaAsistencia&Controller=FaltaAsistencia">Volver Atras</a></button>
    </div>
</body>
