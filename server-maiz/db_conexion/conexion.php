<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'PUT':
    echo "Error";
    break;
  case 'POST':
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    $llaves = array_keys($_POST);
    $postData = json_decode($llaves[0]);

    if ($postData->tipo != null) {
      $tipoRequest = $postData->tipo;
      switch ($tipoRequest) {
        case 'login':
          $respuesta = comprobarCredenciales($postData->username, $postData->password);
          echo $respuesta;
          break;
        default:
          break;
      }
    } else {
      echo "error post";
    }
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
    } else if ($_GET["hash"] != null) {
      $message = $_GET["hash"];
      echo json_encode(hasher($message));
    } else if ($_GET["user"] != null) {
      $user = $_GET["user"];
      echo comprobarCredenciales($user, "");
    }
    break;
  default:
    //Error
    echo "Error";
    break;
}

function getSecciones() {
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

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

function comprobarCredenciales($user, $pass){
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "SELECT * FROM usuario WHERE username = ?";

  if ($connection->connect_error) {
    return json_encode("Error de la conexion a la base de datos");
  } else {
    // Se comprueba si el username existe
    $resultado = $connection->execute_query($sql_query, [$user]);
    if ($resultado->num_rows>0) {
      //Si existe se comprueba si el password ingresado corresponde al usuario
      $row = $resultado->fetch_assoc();
      $passProcesado = hasher($pass);
      $passUsername = $row["password"];
      if ($passProcesado == $passUsername) {
        header("HTTP/1.1 200 OK");
        return json_encode(array('tipo' => $row["tipo"]));
      } else {
        header("HTTP/1.1 200 OK");
        return json_encode(array('error' => "Password incorrecto"));
      }
    } else {
      header("HTTP/1.1 200 OK");
      return json_encode(array('error' => "Username no existe"));
    }
    return json_encode($secciones_array);
  }
}

function hasher($message){
  return hash('sha256', $message);
}

?>
