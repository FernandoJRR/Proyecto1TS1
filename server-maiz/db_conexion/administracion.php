<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'PUT':
    echo "Error";
    break;
  case 'POST':
    break;
  case 'GET':
    if ($_GET["articulos"] != null) {
      $usuario = $_GET["articulos"];
      $articulos = getArticulosUsuario($usuario);
      echo $articulos;
    } else if ($_GET["ultimos"] != null) {
      echo getUltimosArticulos();
    } else if ($_GET["seccion"] != null) {
      $seccion = $_GET["seccion"];
      echo getArticulosSeccion($seccion);
    }
    break;
  default:
    //Error
    echo "Error";
    break;
}

function getArticulosUsuario($usuario){
  header('access-control-allow-origin: *');
  header('content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "select * from articulo where autor = ?";

  if ($connection->connect_error) {
    return json_encode("error de la conexion a la base de datos");
  } else {
    $resultado = $connection->execute_query($sql_query, [$usuario]);
    $articulosarray = array();
    if ($resultado->num_rows>0) {
      while ($row = $resultado->fetch_assoc()) {
        array_push($articulosarray, array('titulo' => $row["titulo"], 'seccion' => $row["seccion"]));
      }
    }
    header("http/1.1 200 ok");
    return json_encode($articulosarray);
  }
}

function getUltimosArticulos() {
  header('access-control-allow-origin: *');
  header('content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "SELECT * FROM articulo ORDER BY fecha DESC LIMIT 10";

  if ($connection->connect_error) {
    return json_encode("error de la conexion a la base de datos");
  } else {
    $resultado = $connection->execute_query($sql_query);
    $articulosarray = array();
    if ($resultado->num_rows>0) {
      while ($row = $resultado->fetch_assoc()) {
        array_push($articulosarray, array(
          'titulo' => $row["titulo"], 
          'slug' => $row["slug"],
          'seccion' => $row["seccion"],
          'fecha' => $row["fecha"],
          'autor' => $row["autor"],
          'imagen' => $row["imagen"],
        ));
      }
    }
    header("http/1.1 200 ok");
    return json_encode($articulosarray);
  }
}

function getArticulosSeccion($seccion){
  header('access-control-allow-origin: *');
  header('content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "select * from articulo where seccion = ? ORDER BY fecha DESC";

  if ($connection->connect_error) {
    return json_encode("error de la conexion a la base de datos");
  } else {
    $resultado = $connection->execute_query($sql_query, [$seccion]);
    $articulosarray = array();
    if ($resultado->num_rows>0) {
      while ($row = $resultado->fetch_assoc()) {
        array_push($articulosarray, array(
          'titulo' => $row["titulo"], 
          'slug' => $row["slug"],
          'seccion' => $row["seccion"],
          'fecha' => $row["fecha"],
          'autor' => $row["autor"],
          'imagen' => $row["imagen"],
        ));
      }
    }
    header("http/1.1 200 ok");
    return json_encode($articulosarray);
  }
}
?>
