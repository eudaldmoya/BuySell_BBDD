<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Confirmación de compra</title>
<link rel="stylesheet" href="css/estils.css">
</head>

<body>
<?php 
//Se añade el menu con un include y iniciamos conexión
include ('navbar.php');
require_once("conexion_pdo.php");
// Creamos el objeto 
$db = new Conexion();
//Pasamos por GET la id del anuncio
$idanu = $_GET['idanuncio']; 

//Hacemos la consulta
$consulta = "UPDATE P02anuncios 
SET vendido=1 
WHERE id=:an";
$result = $db->prepare($consulta);
$result->execute(array(":an" => $idanu));
//Validamos los resultados
if(!result){
    print ("<p>Error al insertar el registro.</p>\n");
    
} else{
    print "<p>La compra se ha realizado con éxito</p>\n"; 
}

//Link para volver al inicio
?>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>
