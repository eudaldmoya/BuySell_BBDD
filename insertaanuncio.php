<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inserta anuncio</title>
<link rel="stylesheet" href="css/estils.css">
</head>

<body>
<?php 
include 'navbar.php';
require_once("conexion_pdo.php");

// Creamos el objeto 
$db = new Conexion();

//Guardamos todos los datos pasados por POST
$titulo = $_POST["titulo"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$ip = $_SERVER['REMOTE_ADDR'];
$categoria = $_POST["categoria"];
$propietario = $_POST["propietario"];
$vendido = 0;
$fechahora = date ("Y-m-d H:i:s");
//Definimos conulta para insertar el anuncio
$consulta = "INSERT INTO P02anuncios (titulo, precio, descripcion, ip, vendido, fechahora, categoria, propietario) VALUES (:ti, :pr, :de, :ip, :ve, :fe, :ca, :prop)"; 
//Ejecutamos
$result = $db->prepare($consulta);

//Validamos resultados
if ($result->execute(array(":ti" => $titulo, ":pr" => $precio, ":de" => $descripcion, ":ip" => $ip, ":ve" => $vendido, ":fe" => $fechahora, ":ca" => $categoria, ":prop" => $propietario)))
 { 
    print("<br><br>");
 	print("<div class=\"di\">");
    print "<p class=\"t2\">Registro insertado correctamente.</p>\n"; 
    print ("</div>");
 } else {
	print "<p>Error al insertar el registro.</p>\n"; 
}
?>
<div class="di">
        <br><br>
<p><a href="index.php" class="bot">Volver al listado de anuncios</a></p>
    </div>
</body>
</html>