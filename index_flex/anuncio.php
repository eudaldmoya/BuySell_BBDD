<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Detall noticia</title>
<link rel="stylesheet" href="css/estils.css">
</head>

<body>
<?php 
include ('navbar.php');
require_once("conexion_pdo.php");
// Creamos el objeto 
$db = new Conexion();
$idanu = $_GET['idanuncio']; 
$ip = $_SERVER['REMOTE_ADDR'];
$fechahora = date("Y-m-d H:i:s");
$usag = $_SERVER['HTTP_USER_AGENT'];

$dbTabla='P02anuncios'; 
    
$consulta = "INSERT INTO P02visualizaciones (ip, fechahora, useragent, anuncio) VALUES (:ip, :fe, :us, :an)";
$result = $db->prepare($consulta);
if ($result->execute(array(":ip" => $ip, ":fe" => $fechahora, ":us" => $usag, ":an" => $idanu))) {
    
} else{
    print "<p>Error al insertar el registro.</p>\n"; 
}

$consulta1 = "SELECT titulo, precio, descripcion, P02categorias.nombre AS categoria, P02usuarios.nombre AS propietario, P02anuncios.id
FROM P02categorias, P02usuarios, P02anuncios
WHERE email=propietario AND categoria=P02categorias.id AND P02anuncios.id=:an";
$result1 = $db->prepare($consulta1);
$result1->execute(array(":an" => $idanu));
if (!$result) { 
	print "<p>Error en la consulta.</p>\n";
}else{
   
        $fila = $result1->fetchObject();
        print "<h1>".$fila->titulo."</h1>";
        print "<h2>".$fila->categoria."</h2>";
        print "<h2>".$fila->precio."</h2>";
        print "<h2>".$fila->descripcion."</h2>";
        print "<h2>".$fila->propietario."</h2>";
        print("<h2><a href='estadoanuncio.php?idanuncio=".$idanu."'>Comprar</a></h2>");
}

//Cerramos conexión
$db=NULL;
?>
</body>
</html>
