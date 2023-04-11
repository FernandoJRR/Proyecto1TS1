<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'PUT':
    echo "Error";
    break;
  case 'POST':
    echo "Error";
    break;
  case 'GET':
    if ($_GET["atributo"] != null) {
      $atributo = $_GET["atributo"];
      switch ($atributo) {
        case 'secciones':
          $response = getSecciones();  
          echo $response;
          break;
        default:
          echo "Otra";
          break;
      }
    } else {
      echo "else";
    }
    break;
  default:
    //Error
    echo "Error";
    break;
}

function getSecciones() {
  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "SELECT * FROM seccion";

  if ($connection->connect_error) {
    return json_encode("Error de la conexion a la base de datos");
  } else {
    $resultado = $connection->query($sql_query);
    $secciones_array = array();
    if ($resultado->num_rows>0) {
      while ($row = $resultado->fetch_assoc()) {
        array_push($secciones_array, $row["nombre"]);
      }
    }
    return json_encode($secciones_array);
  }
}

?>
