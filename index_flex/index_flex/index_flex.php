<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Exercici</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="estils.css">
</head>

<body>
<?PHP

//require_once 'conexion_pdo.php';
require("../conexion_pdo.php");

//Obertura de connexió
$db = new Conexion();

//Definir consulta SQL
$consulta = "SELECT * FROM P02categorias";
//Executar consulta
$result = $db->query($consulta);

if (!$result){
	print "<p> Error en la consulta. </p>\n";
}else{
	//Menu de https://getbootstrap.com/docs/4.5/components/navbar/#nav
	
	//Menu categories
	print("<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">\n");
    print("<a class=\"navbar-brand\" href=\"#\">Navbar</a>\n");
	print("<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n");
    print("<span class=\"navbar-toggler-icon\"></span>\n");
	print("</button>\n");
	print("<div class=\"collapse navbar-collapse\" id=\"navbarNav\">\n");
    print("\t<ul class=\"navbar-nav\">\n");
	
	
	//Items menu
	foreach($result as $fila){
		print ("\t\t<li class=\"nav-item\"><a class=\"nav-link\" href=\"categoria.php?idcategoria=".$fila["id"]."\">".$fila["nombre"]."</a></li>\n");		  
	}
	
	print("\t</ul>\n</div>\n</nav>\n");
}

//Link a nou anunci, situeu-lo a la part de la interficie que considereu millor
print("<h2><a href=\"nuevoanuncio.php\">Nou anunci</a></h2>");


//Anuncis
//Model de card utilitzat: https://getbootstrap.com/docs/4.5/components/card/#titles-text-and-links

//Definir consulta SQL
$consulta = "SELECT titulo, precio, P02categorias.nombre AS categoria, P02usuarios.nombre, P02anuncios.id
FROM P02categorias, P02usuarios, P02anuncios
WHERE vendido=0 AND email=propietario AND categoria=P02categorias.id
ORDER BY fechahora DESC";

//Executar consulta
$result = $db->query($consulta);

//Validar consulta
if (!$result){
	print "<p> Error en la consulta. </p>\n";
}else{
	
	$hoy = date("d-m-Y H:i:s");
	print("<h1>Articles a la venda - $hoy</h1>\n");
		
	//Obertura de contenidor flex
	print("\t<div class=\"flex-container\">\n");
	
	//Processament de resultats de la consulta SQL
	foreach($result as $fila){
		//Print card amb dades anunci
		print("\t\t<article>\n");
		print("\t\t<div>\n");
		//print("<h2 class=\"card-title\">".$fila["titulo"]."</h2>\n");
		print("\t\t<h2><a href=\"anuncio.php?idanuncio=".$fila["id"]."\">".$fila["titulo"]."</a></h2>\n");
		//print("<h2><a href=\"detallnoticia.php?id=".$fila["id"]."\">".$fila["titulo"]."</a></h2>\n");
		print("\t\t<h2>".$fila["categoria"]."</h2>\n");
		print("\t\t<h3>".$fila["nombre"]."</h3>\n");
		print("\t\t<h3>".$fila["precio"]."</h3>\n");
		print("\t\t</div>\n");
		print("\t\t</article>\n");
	}
	//Tancament de contenidor flex
	print("\t</div>\n");
}

//Tancament de connexió
$db = NULL;

?>

</body>
</html>