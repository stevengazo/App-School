
    <div>
      <div>
        <h4>Borrar la información de la Falta en la Asistencia</h4>
        <p>
          A continuación se muestran la información de la falta Seleccionada
        </p>
      </div>
    </div>
    <div>
      <table class="table">
        <tbody>
          <tr>
            <th>id Falta de Asistencia</th>
            <!--id-->
            <td id="objId">{$ObjetoFaltaAsistencia.id}</td>
          </tr>
          <tr>
            <th>id Estudiante</th>
            <!--id Estudiante-->
            <td>{$ObjetoFaltaAsistencia.apellidos} {$ObjetoFaltaAsistencia.nombre} </td>            
          </tr>
          <tr>
            <th>Asignatura</th>
            <!--Id Materia-->
            <td>{$ObjetoFaltaAsistencia.asignatura}</td>
          </tr>
          <tr>
            <th>Fecha</th>
            <!--Dia-->
            <td>{$ObjetoFaltaAsistencia.fecha}</td>
          </tr>
          <tr>
            <th>Justificación</th>
            <!--Motivo-->
            <td>{$ObjetoFaltaAsistencia.justificada}</td>
          </tr>
        </tbody>
      </table>
      <div>
        <button
          class="btn btn-outline-danger"
          type="text"
          onclick="onDeleteElement()"
        >
          Eliminar Archivo
        </button>
        <button class="btn btn-outline-info">
          <a class="nav-link active" href="index.php?action=ListaFaltaAsistencia&Controller=FaltaAsistencia">Volver Atras</a>
        </button>
      </div>
    </div>
  </body>
