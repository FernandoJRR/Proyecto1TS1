<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'PUT':
    echo "Error";
    break;
  case 'POST':
    $llaves = array_keys($_POST);
    $postData = json_decode($llaves[0]);

    if ($postData->tipo!=null) {
      if ($postData->tipo="publicacion") {
        $respuesta = publicarArticulo(
          str_replace("_", " ", $postData->titulo),
          $postData->slug,
          $postData->seccion,
          str_replace("_", " ", $postData->contenido),
          $postData->autor
        );
      }
    } else {
      echo "error post";
    }
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
    } else if ($_GET["articulo"] != null) {
      $articulo = $_GET["articulo"];
      echo getInformacionArticulo($articulo);
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
function getInformacionArticulo($articulo) {
  header('access-control-allow-origin: *');
  header('content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "select * from articulo where slug = ?";

  if ($connection->connect_error) {
    return json_encode("error de la conexion a la base de datos");
  } else {
    $resultado = $connection->execute_query($sql_query, [$articulo]);
    $articulosarray = array();
    if ($resultado->num_rows>0) {
      $row = $resultado->fetch_assoc();
      $articulosarray = array(
        'titulo' => $row["titulo"], 
        'slug' => $row["slug"],
        'seccion' => $row["seccion"],
        'fecha' => $row["fecha"],
        'autor' => $row["autor"],
        'imagen' => $row["imagen"],
        'contenido' => $row["contenido"]
      );
    }
    header("http/1.1 200 ok");
    return json_encode($articulosarray);
  }
}

function publicarArticulo($titulo, $slug, $seccion, $contenido, $autor) {
  header('access-control-allow-origin: *');
  header('content-type: application/json');

  $servidor = "localhost";
  $username = "root";
  $password = "";
  $nombredb = "proyecto_maiz_db";

  $connection = new mysqli($servidor, $username, $password, $nombredb);
  $sql_query = "INSERT INTO articulo (titulo, slug, seccion, fecha, autor, imagen, contenido) VALUES ( ?, ?, ?, CURRENT_TIMESTAMP(), ?, null, ? )";

  if ($connection->connect_error) {
    return json_encode("error de la conexion a la base de datos");
  } else {
    try {
      $resultado = $connection->execute_query($sql_query, [$titulo, $slug, $seccion, $autor, $contenido]);
      echo "aqui";
      if($resultado === TRUE){
        header("http/1.1 200 ok");
        return json_encode(array("ok" => "Publicacion exitosa"));
      } else {
        header("http/1.1 200 ok");
        return json_encode(array("error" => "Error al publicar, verifique la informacion ingresada"));
      }
    } catch (\Throwable $th) {
      echo $th;
    }
  }
}
?>
