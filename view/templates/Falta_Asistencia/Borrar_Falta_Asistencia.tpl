<html>
  <head>
    <!-- Bootstrap via jsDelivr-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Borrar</title>
  </head>

  <body class="container">
    <!--SIMPLE NAV VAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php?">App_School</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link active"
                href="index.php?action=ListaFaltaAsistencia"
                >Ausencias</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
            <td>{$ObjetoFaltaAsistencia.id}</td>
          </tr>
          <tr>
            <th>id Estudiante</th>
            <!--id Estudiante-->
            <td>{$ObjetoFaltaAsistencia.alumno_id}</td>
          </tr>
          <tr>
            <th>Asignatura</th>
            <!--Id Materia-->
            <td>{$ObjetoFaltaAsistencia.asignatura_id}</td>
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
          action="BorrarAsistencia"
          idAsistencia="{$ObjetoFaltaAsistencia.id}"
        >
          Eliminar Archivo
        </button>
        <button class="btn btn-outline-info">
          <a class="nav-link active" href="index.php?action=ListaFaltaAsistencia">Volver Atras</a>
        </button>
      </div>
    </div>
  </body>
</html>
