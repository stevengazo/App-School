<?php

$metodo = $_SERVER['REQUEST_METHOD'];
//$accion = $_REQUEST['accion'];


switch ($metodo) {
  case 'GET':
    header("HTTP/1.1 200 SUCCESSFUL");
    fn_listar_nivel();
    break;
    case 'DELETE':
      header("HTTP/1.1 200 SUCCESSFUL");
      fn_borrar_nivel();
      break;
      case 'POST':
        header("HTTP/1.1 200 SUCCESSFUL");
        fn_mortrar_frm_nivel_edicion();
        break;
  default:
    // code...
    break;
}



function fn_mortrar_frm_nivel_edicion(){
  $idNivel = $_REQUEST['idNivel'];
  $linkConect = mysqli_connect("localhost","root","","testingdb");

  $sql = "select nivel,id,curso,AULA from nivel where id=".$idNivel;
  $rs = $linkConect->query($sql);


  $idNivel = "";
  $nivel = "";
  $curso = "";
  $AULA = "";
    while($fila = $rs->fetch_assoc()){

      $idNivel = $fila['id'];
      $nivel = $fila['nivel'];
      $curso = $fila['curso'];
      $AULA = $fila['AULA'];

    }

    $salida = '<div class="container mt-3">';
      $salida .= '<h2>Edicion de Niveles</h2>';
        $salida .= '<form  method="post"  >';
       $salida .= '<input type="hidden" id="txtIdNivel" value="'.$idNivel.'">';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Nivel:</label>';
            $salida .= '<input type="text" class="form-control" id="txtnivel" name="txtnivel" value="'.$nivel.'" placeholder="Ingrese un nivel" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Curso:</label>';
            $salida .= '<input type="text" class="form-control" id="txtcurso" name="txtcurso" value="'.$curso.'" placeholder="Ingrese un curso" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3">';
          $salida .= '<label for="text">Aula:</label>';
          $salida .= '<input type="text" class="form-control" id="txtaula" name="txtaula" value="'.$AULA.'" placeholder="Ingrese un aula" required>';
        $salida .= '</div>';
        $salida .= '<div class="mb-3 mt-3">';



          $salida .= '<button type="button" class="btn btn-primary" onclick="fn_editar_nivel();">Actualizar Nivel</button>';
        $salida .= '</form>';
      $salida .= '</div>';

  echo $salida;
}


/*

function agregar_nivel()
{
  $salida = '<div class="container mt-3">';
    $salida .= '<h2>Edicion de Niveles</h2>';
      $salida .= '<form  method="post"  >';
        $salida .= '<label for="text">Id:</label>';
        $salida .= '<input type="text" id="txtIdNivel">';
        $salida .= '<div class="mb-3 mt-3">';
          $salida .= '<label for="text">Nivel:</label>';
          $salida .= '<input type="text" class="form-control" id="txtnivel" name="txtnivel" placeholder="Ingrese un nivel" required>';
        $salida .= '</div>';
        $salida .= '<div class="mb-3 mt-3">';
          $salida .= '<label for="text">Curso:</label>';
          $salida .= '<input type="text" class="form-control" id="txtcurso" name="txtcurso" placeholder="Ingrese un curso" required>';
        $salida .= '</div>';
        $salida .= '<div class="mb-3">';
        $salida .= '<label for="text">Aula:</label>';
        $salida .= '<input type="text" class="form-control" id="txtaula" name="txtaula" placeholder="Ingrese un aula" required>';
      $salida .= '</div>';
      $salida .= '<div class="mb-3 mt-3">';

        $salida .= '<button type="button" class="btn btn-primary" onclick="fn_agregar_nivel();">Agregar Nivel</button>';
      $salida .= '</form>';
    $salida .= '</div>';

echo $salida;

$idNivel = $_REQUEST['txtIdNivel'];
$nivel = $fila['txtnivel'];
$curso = $fila['txtcurso'];
$AULA = $fila['txtaula'];

$linkConnection =  mysqli_connect("localhost","root","","testingdb");
# CODIGO SQL
$sqlQuery = " INSERT INTO nivel (id,nivel,curso,AULA)";
$sqlQuery .= " VALUES ('$idNivel','$nivel','$curso','$AULA') ";
#EJECUCIÓN CONSULTA
$sqlResult = $linkConnection->query($sqlQuery);

}

*/
function fn_borrar_nivel(){
  $idNivel = $_REQUEST['idNivel'];
  $linkConect = mysqli_connect("localhost","root","","testingdb");
  $sql = "delete from nivel where id =".$idNivel;
  $rs = $linkConect->query($sql);
  echo "Nivel Borrado!";
}
function fn_listar_nivel(){
  $linkConect = mysqli_connect("localhost","root","","testingdb");
  $sql = "select count(*) canti_reg from nivel";
  $rs = $linkConect->query($sql);
  $cantidad_nivel = 0;
  $salida = "";
    while($fila = $rs->fetch_assoc()){
      $cantidad_nivel = $fila['canti_reg'];
    }
    if($cantidad_nivel>0){

        $sql = "select id,nivel,curso,AULA from nivel";
        $rs = $linkConect->query($sql);

        $salida = "<table class='table'>";
          $salida .= "<tr>";
          $salida .= "<th>Id Nivel</th>";
          $salida .= "<th>Nivel</th>";
          $salida .= "<th>Curso</th>";
          $salida .= "<th>Aula</th>";
          $salida .= "<th>Acciones</th>";
          $salida .= "</tr>";
          while($fila = $rs->fetch_assoc()){
            $salida .= "<tr>";
            $salida .= "<td>".$fila['id']."</td>";
            $salida .= "<td>".$fila['nivel']."</td>";
            $salida .= "<td>".$fila['curso']."</td>";
            $salida .= "<td>".$fila['AULA']."</td>";
            $salida .= "<td><img src='images/lapiz.png' title='Editar Nivel'
             onclick='fn_editar_nivel(".$fila['id'].");'>
                            <img src='images/delete.png' title='Borrar Nivel'
                            onclick='fn_borrar_nivel(".$fila['id'].");'></td>";

            $salida .= "</tr>";
          }
        $salida .= "</table>";
    }else{
        $salida .= "No existen datos para mostrar";
    }

echo $salida;
}







?>
