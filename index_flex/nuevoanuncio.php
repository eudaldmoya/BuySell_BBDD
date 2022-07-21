<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nuevo anuncio</title>
    <link rel="stylesheet" href="css/estils.css">
</head>

<body>
    <?PHP include 'navbar.php';?>
    <br><br>
    <h1 class="tit">Introduzca los siguientes campos:</h1>
    <br><br>


    <form action="insertaanuncio.php" method="post" name="form1" class="formc">
        <label for="titulo" class="Input-label">Título: </label><input name="titulo" id="titulo" type="text" autofocus placeholder="Camara antigua" required maxlength="50" class="Input-text"><br><br>
        <label for="precio" class="Input-label">Precio: </label><input name="precio" class="Input-text" id="precio" type="number" min="0" max="9999999" required><br><br>
        <label for="descripcion" class="Input-label">Descripción: </label><input name="descripcion" id="descripcion" type="text" required maxlength="1000" class="Input-text"><br><br>
        <?PHP

//require_once 'conexion_pdo.php';
require_once("conexion_pdo.php");

//Iniciamos conexión
$db = new Conexion();
//Defini consulta para crear el select con las categorias
$consulta = "SELECT * FROM P02categorias";
//Ejecutamos consulta
$result = $db->query($consulta);
//Comprovamos resultados
if (!$result){
	print "<p> Error en la consulta. </p>\n";
}else{
    print("<label for=\"categoria\">Categoria: </label>");
    print("<select class=\"select\" name=\"categoria\" id=\"categoria\">");
    foreach($result as $fila) {	  
        print("\t<option value=\"".$fila["id"]."\">".$fila["nombre"]."</option>\n");

    }
        print("</select>"); 
 }
        
        
//Definir consulta para crear el select con los emails de los usuarios
$consulta = "SELECT * FROM P02usuarios";
//Ejecutar consulta
$result = $db->query($consulta);
//Comprovar resultados
if (!$result){
	print "<p> Error en la consulta. </p>\n";
}else{
    print("<br><label for=\"propietario\">Usuario: </label>");
    print("<select class=\"select\" name=\"propietario\" id=\"propietario\">");
    foreach($result as $fila) {	  
        print("\t<option value=\"".$fila["email"]."\">".$fila["email"]."</option>\n");

    }
        print("</select>"); 
 }
        

//Cierre de conexión
$db = NULL;
//Botón de insertar
?>
        <br>
        <input name="botonnuevo" type="submit" value="Insertar">
    </form>

</body>

</html>
