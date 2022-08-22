<?php

$metodo = $_SERVER['REQUEST_METHOD'];
//$accion = $_REQUEST['accion'];

switch ($metodo) {
  case 'GET':
    if (isset($_REQUEST['tipo'])) {
      switch ($_REQUEST['tipo']) {
        case 'elemento':
          getAlumno();
          break;
        case 'lista':
          if (isset($_REQUEST['formato'])) {
            switch ($_REQUEST['formato']) {
              case 'JSON':
                LISTAJSON();
                break;
              case 'HTML':
                fn_listar_alumnos();
                break;
            }
          } else {
            lanzarJson("FORMATO NO DEFINIDO (HTML O JSON)", true, 500);
          }
          break;
        default:
          lanzarJson("tipo no definido (lista o elemento)", true, 500);
          break;
      }
    } else {
      lanzarJson("tipo no definido", true, 500);
    }
    break;
  case 'DELETE':
    header("HTTP/1.1 200 SUCCESSFUL");
    fn_borrar_alumno();
    break;
  case 'POST':
    header("HTTP/1.1 200 SUCCESSFUL");
    fn_mortrar_frm_alumno_edicion();
    break;
  case 'PUT':
    header("HTTP/1.1 200 SUCCESSFUL");
    PostUpdateAlumno();
    break;
  case 'VIEW':
    getAlumno();
    break;
  default:
    // code...
    break;
}

function LISTAJSON()
{
  $linkConect = mysqli_connect("localhost", "root", "", "testingdb");
  $sql = "select id,nivel_id,nombre,apellidos from alumno";
  $rs = $linkConect->query($sql);
  $arregloAlumnos = array();
  while ($fila = $rs->fetch_assoc()) {
    $tmpObjecto = new stdClass();
    $tmpObjecto->id =$fila['id'];
    $tmpObjecto->nivelId =$fila['nivel_id'];
    $tmpObjecto->nombre =$fila['nombre'];
    $tmpObjecto->apellidos =$fila['apellidos'];                            
    array_push($arregloAlumnos,$tmpObjecto);
  }
  lanzarJson($arregloAlumnos,false,200);
}




/**
 * Trae la información de un alumno
 */
function getAlumno()
{
  $id = $_REQUEST['id'];
  $AlumnoObjeto = new stdClass();
  $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
  $localQuery = '
  select * from alumno where id = ' . $id . '
  ';
  $Resultado = $linkConnection->query($localQuery);
  while ($fila = $Resultado->fetch_assoc()) {
    $AlumnoObjeto->id = $fila['id'];
    $AlumnoObjeto->nombre = $fila['nombre'];
    $AlumnoObjeto->apellidos = $fila['apellidos'];
  }
  $AlumnoObjeto->asignaturas = getAsignaturas($id);
  $AlumnoObjeto->ausencias = getFaltasAsistencia($id);
  $AlumnoObjeto->Notas = getNotas($id);
  lanzarJson($AlumnoObjeto, false, 200);
  exit;
}

/**
 * Trae asignaturas de alumno
 */
function getAsignaturas($id)
{
  $ArregloAsignaturas = array();
  if ($id == 0) {
    return $ArregloAsignaturas;
  } else {
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    $localQuery = '
    select 
      Asignatura.*, 
      Profesor.apellidos, 
      Profesor.Nombre as profesorNombre,
      Nivel.nivel,
      Nivel.Curso,
      Nivel.Aula
    from Asignatura
    inner join (SELECT asignatura_id FROM ASIGNATURA_HAS_ALUMNO
    where alumno_id = ' . $id . ') as TmpTable
      on Asignatura.id = TmpTable.asignatura_id
    inner join Profesor on Profesor.id = Asignatura.profesor_id
    inner join Nivel on Nivel.id = Asignatura.nivel_id
    ';
    $Resultado = $linkConnection->query($localQuery);

    while ($fila = $Resultado->fetch_assoc()) {
      $tmpAsignatura = new stdClass();
      $tmpAsignatura->idAsignatura = $fila['id'];
      $tmpAsignatura->nivelId = $fila['nivel_id'];
      $tmpAsignatura->profesorId = $fila['profesor_id'];
      $tmpAsignatura->nombreAsignatura = $fila['nombre'];
      $tmpAsignatura->apellidos = $fila['apellidos'];
      $tmpAsignatura->profesorNombre = $fila['profesorNombre'];
      $tmpAsignatura->nivel = $fila['nivel'];
      $tmpAsignatura->curso = $fila['Curso'];
      $tmpAsignatura->aula = $fila['Aula'];
      array_push($ArregloAsignaturas, $tmpAsignatura);
    }
    return $ArregloAsignaturas;
    exit;
  }
}


/**
 * Trae asignaturas de alumno
 */
function getNotas($id)
{
  $ArregloNotas = array();
  if ($id == 0) {
    return $ArregloNotas;
  } else {
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    $localQuery = '
        SELECT 
        Nota.id as NotaId ,
        Nota.trimestre,
        Nota.nota ,
        Asig.id as AsignaturaId,
        Asig.nombre as AsignaturaNombre,
        Profesor.nombre as NombreProfesor, 
        Profesor.Apellidos as ProfesorApellidos,
        Alumno.nombre  as NombreAlumno, 
        Alumno.apellidos as NombreApellidos
      FROM NOTA
      INNER JOIN (SELECT asignatura_id, alumno_id, id AS AsigAlum FROM ASIGNATURA_HAS_ALUMNO where alumno_id = ' . $id . ') AS tmpRelacion 
        on NOTA.asignatura_has_alumno_id = tmpRelacion.AsigAlum
      inner join Asignatura as Asig on Asig.id = tmpRelacion.asignatura_id
      inner Join Profesor on Asig.Profesor_id = Profesor.id
      inner Join Alumno on Alumno.id = tmpRelacion.alumno_id
    ';
    $Resultado = $linkConnection->query($localQuery);

    while ($fila = $Resultado->fetch_assoc()) {
      $tmpNota = new stdClass();
      $tmpNota->notaId = $fila['NotaId'];
      $tmpNota->trimestre = $fila['trimestre'];
      $tmpNota->nota = $fila['nota'];
      $tmpNota->asignaturaNombre = $fila['AsignaturaNombre'];
      $tmpNota->nombreProfesor = $fila['NombreProfesor'] . ' ' . $fila['ProfesorApellidos'];
      array_push($ArregloNotas, $tmpNota);
    }
    return $ArregloNotas;
    exit;
  }
}



function getFaltasAsistencia($id)
{
  $ArregloAusencias = array();
  if ($id == 0) {
    return $ArregloAusencias;
  } else {
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    $localQuery = '
        select 
        FA.id as FaltaAsistenciaId,
          FA.alumno_id as AlumnoId,
          FA.Fecha,
          FA.Justificada,
        Asig.id as AsignaturaId,
          Asig.nombre as AsignaturaNombre,
          Prof.id as ProfesorId,
          Prof.nombre as NombreProfesor,
          Prof.Apellidos as ApellidosProfesor,
          FA.alumno_id as AlumnoId
      from falta_asistencia as FA
      inner join asignatura as Asig on Asig.id = FA.asignatura_id
      inner Join Profesor as Prof on Prof.id = Asig.profesor_id
      Where FA.Alumno_id = ' . $id . '
      order by FA.fecha asc 
    ';
    $Resultado = $linkConnection->query($localQuery);

    while ($fila = $Resultado->fetch_assoc()) {
      $tmpAusencia = new stdClass();
      $tmpAusencia->faltaAsistenciaId = $fila['FaltaAsistenciaId'];
      $tmpAusencia->fecha = $fila['Fecha'];
      $tmpAusencia->justificada = $fila['Justificada'];
      $tmpAusencia->asignaturaId = $fila['AsignaturaId'];
      $tmpAusencia->asignaturaNombre = $fila['AsignaturaNombre'];
      $tmpAusencia->ProfesorId = $fila['ProfesorId'];
      $tmpAusencia->NombreProfesor =  $fila['NombreProfesor'] . ' ' . $fila['ApellidosProfesor'];
      array_push($ArregloAusencias, $tmpAusencia);
    }
    return $ArregloAusencias;
    exit;
  }
}

function PostUpdateAlumno()
{
  # CADENA DE CONEXIÓN
  $flag = true;
  $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
  # VALIDACIONES
  if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
  } else {
    $rtn = array("id", "3", "error", "Id no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if (isset($_REQUEST['nivel_id'])) {
    $nivel_id = $_REQUEST['nivel_id'];
  } else {
    $rtn = array("id", "3", "error", "nivel_id no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if (isset($_REQUEST['login'])) {
    $login = $_REQUEST['login'];
  } else {
    $rtn = array("id", "3", "error", "login no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if (isset($_REQUEST['clave'])) {
    $clave = $_REQUEST['clave'];
  } else {
    $rtn = array("id", "3", "error", "clave no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if (isset($_REQUEST['nombre'])) {
    $nombre = $_REQUEST['nombre'];
  } else {
    $rtn = array("id", "3", "error", "nombre no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if (isset($_REQUEST['apellidos'])) {
    $apellidos = $_REQUEST['apellidos'];
  } else {
    $rtn = array("id", "3", "error", "apellidos no especificado");
    http_response_code(500);
    print json_encode($rtn);
    $flag = false;
    exit;
  }
  if ($flag) {
    # CODIGO SQL
    $sqlQuery = "UPDATE alumno ";
    $sqlQuery = $sqlQuery . "set nivel_id='$nivel_id',login= '$login',clave = '$clave',nombre ='$nombre',apellidos = '$apellidos'";
    $sqlQuery = $sqlQuery . " WHERE id = '$id' ";
    $sqlResults = $linkConnection->query($sqlQuery);
    /* RETORNA JSON */
    header("Content-Type: application/json");
    http_response_code(200);
    echo json_encode($sqlResults);
  }
}

function fn_mortrar_frm_alumno_edicion()
{
  $idAlumno = $_REQUEST['idAlumno'];
  $linkConect = mysqli_connect("localhost", "root", "", "testingdb");

  $sql = "select id,nivel_id,login,clave, nombre, apellidos from alumno where id=" . $idAlumno;
  $rs = $linkConect->query($sql);

  $idAlumno = "";
  $idNivel = "";
  $login = "";
  $clave = "";
  $nombre = "";
  $apellidos = "";

  while ($fila = $rs->fetch_assoc()) {
    $idAlumno = $fila['id'];
    $idNivel = $fila['nivel_id'];
    $login = $fila['login'];
    $clave = $fila['clave'];
    $nombre = $fila['nombre'];
    $apellidos = $fila['apellidos'];
  }
  $salida = '<div class="container mt-3">';
  $salida .= '<h2>Edición de Alumno</h2>';
  $salida .= '<form  method="post"  >';
  $salida .= '<input type="hidden" id="txtIdAlumno" value="' . $idAlumno . '">';
  $salida .= '<div class="mb-3 mt-3">';
  $salida .= '<label for="text">Nivel:</label>';
  $salida .= '<input type="text" class="form-control" id="txtnivelid" name="txtnombre" value="' . $idNivel . '" placeholder="Ingrese el id de su nivel" required>';
  $salida .= '</div>';
  $salida .= '<div class="mb-3 mt-3">';
  $salida .= '<label for="text">Login:</label>';
  $salida .= '<input type="text" class="form-control" id="txtlogin" name="txtnombre" value="' . $login . '" placeholder="Ingrese su nombre de usuario" required>';
  $salida .= '</div>';
  $salida .= '<div class="mb-3 mt-3">';
  $salida .= '<label for="text">Contraseña:</label>';
  $salida .= '<input type="password" class="form-control" id="txtpass" name="txtpass" value="' . $clave . '" placeholder="Ingrese su contraseña" required>';
  $salida .= '</div>';
  $salida .= '<div class="mb-3 mt-3">';
  $salida .= '<label for="text">Nombre:</label>';
  $salida .= '<input type="text" class="form-control" id="txtnombre" name="txtUsuario" value="' . $nombre . '" placeholder="Ingrese su nombre" required>';
  $salida .= '</div>';
  $salida .= '<div class="mb-3 mt-3">';
  $salida .= '<label for="text">Apellido:</label>';
  $salida .= '<input type="text" class="form-control" id="txtapellido" name="txtUsuario" value="' . $apellidos . '" placeholder="Ingrese su apellido" required>';
  $salida .= '</div>';
  $salida .= '<div class="mb-3">';

  $salida .= '<button type="button" class="btn btn-primary" onclick="UpdateAlumno();" >Actualizar Alumno</button>';
  $salida .= '</form>';
  $salida .= '</div>';

  echo $salida;
}

function fn_borrar_alumno()
{
  $idAlumno = $_REQUEST['idAlumno'];
  $linkConect = mysqli_connect("localhost", "root", "", "testingdb");
  $sql = "delete from alumno where id=" . $idAlumno;
  $rs = $linkConect->query($sql);
  echo "Alumno Borrado!";
}
function fn_listar_alumnos()
{
  $linkConect = mysqli_connect("localhost", "root", "", "testingdb");
  $sql = "select count(*) canti_reg from alumno";
  $rs = $linkConect->query($sql);
  $cantidad_alumno = 0;
  $salida = "";
  while ($fila = $rs->fetch_assoc()) {
    $cantidad_alumno = $fila['canti_reg'];
  }
  if ($cantidad_alumno > 0) {

    $sql = "select id,nivel_id,login,nombre,apellidos from alumno";
    $rs = $linkConect->query($sql);

    $salida = "<table class='table'>";
    $salida .= "<tr>";
    $salida .= "<th>Id Alumno</th>";
    $salida .= "<th>Id Nivel</th>";
    $salida .= "<th>Login</th>";
    $salida .= "<th>Nombre</th>";
    $salida .= "<th>Apellidos</th>";
    $salida .= "<th>Acciones</th>";
    $salida .= "</tr>";
    while ($fila = $rs->fetch_assoc()) {
      $salida .= "<tr>";
      $salida .= "<td>" . $fila['id'] . "</td>";
      $salida .= "<td>" . $fila['nivel_id'] . "</td>";
      $salida .= "<td>" . $fila['login'] . "</td>";
      $salida .= "<td>" . $fila['nombre'] . "</td>";
      $salida .= "<td>" . $fila['apellidos'] . "</td>";
      $salida .= " <td class='btn btn-sm text-dark btn-primary'  onclick='verAlumno(" . $fila['id'] . ")'> <i class='bi bi-info'></i> </td> ";
      $salida .= " <td class='btn btn-sm text-dark btn-primary'  onclick='fn_editar_alumno(" . $fila['id'] . ")'> <i class='bi bi-pencil-square'></i> </td> ";
      $salida .= " <td class='btn btn-sm text-dark btn-danger' onclick='fn_borrar_alumno(" . $fila['id'] . ")'> <i class='bi bi-trash3'></i> </td> ";
      $salida .= "</tr>";
    }
    $salida .= "</table>";
  } else {
    $salida .= "No existen datos para mostrar";
  }
  header("HTTP/1.1 200 SUCCESSFUL");
  echo $salida;
  exit;
}


/**
 * Lanza una respuesta en formato JSON
 */
function lanzarJson($DataCodificar, $error = true, $CodigoError)
{
  if ($error) {
    $rtn = array("id", "1", "error", $DataCodificar);
    http_response_code($CodigoError);
    print json_encode($rtn);
  } else {
    http_response_code($CodigoError);
    print json_encode($DataCodificar);
  }
}
