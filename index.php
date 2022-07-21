<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Exercici</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="css/estils.css">
</head>

<body>
<?PHP

//require_once 'conexion_pdo.php';
require("conexion_pdo.php");

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
	print("<nav class=\"navbar navbar-expand-lg navbar-light bg-light justify-content-center\">\n");
    print("<a class=\"navbar-brand\" href=\"index.php\">Home</a>\n");
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
	
	 print("<br><br>");
	print("<h1 class=\"tit\">Articulos a la venta</h1>\n");
	print ("<br><br>");
	print("<div class=\"di\">");
    //Link a nou anunci
print("<h2><a href=\"nuevoanuncio.php\" class=\"bot\">Publicar anuncio</a></h2>");
    print("</div>");
    print("<br><br>");
    
	//Contador per rows bootstrap
	$i=0;

	//Processament de resultats de la consulta SQL	
	foreach($result as $fila){
		//Printat de fila bootstrap només si múltiple de 3
		if(($i%3)==0){
			print("<div class=\"row\">\n");
		}		
		
			//Print column de 4, per situar-hi card
			print("\t<div class=\"col-sm-4\">\n");			
				
				//Print card amb dades anunci
				print("\t\t<article class=\"card\">\n");
				print("\t\t<div class=\"card-body\">\n");
			
				print("\t\t<h2 class=\"t1\" ><a href=\"anuncio.php?idanuncio=".$fila["id"]."\">".$fila["titulo"]."</a></h2>\n");
		
				print("\t\t<h2 class=\"t2 mb-2 text-muted\">".$fila["categoria"]."</h2>\n");
				print("\t\t<h3 class=\"t3\">".$fila["nombre"]."</h3>\n");
				print("\t\t<h3 class=\"t3\">".$fila["precio"]." €</h3>\n");
				print("\t\t</div>\n");
				print("\t\t</article>\n");
			
			//Tancament de column
			print("\t</div>\n");
		
		$i++;
		
		//Printat de tancament de fila bootstrap només si múltiple de 3
		if(($i%3)==0){
			print("</div>\n");
            print ("<br>");
		}
		
	}
	if(($i%3)!=0){
		print("</div>\n");
	}
	
		
}

//Tancament de connexió
$db = NULL;

?>

</body>
</html>