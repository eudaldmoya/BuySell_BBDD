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
include 'navbar.php';
//require_once 'conexion_pdo.php';
require_once("conexion_pdo.php");

//Obertura de connexió
$db = new Conexion();
$idcat = $_GET['idcategoria'];



//Link a nou anunci, situeu-lo a la part de la interficie que considereu millor
//print("<h2><a href=\"nuevoanuncio.php\">Nou anunci</a></h2>");


//Anuncis
//Model de card utilitzat: https://getbootstrap.com/docs/4.5/components/card/#titles-text-and-links

//Definir consulta SQL
$consulta = "SELECT titulo, precio, P02categorias.nombre AS categorias, P02usuarios.nombre AS nombre, P02anuncios.id
FROM P02categorias, P02usuarios, P02anuncios
WHERE vendido=0 AND email=propietario AND P02categorias.id=:ca AND 
ORDER BY fechahora DESC";

//Executar consulta
$result = $db->prepare($consulta);
$result->execute(array(":ca"=>$idcat));
    
$consulta2 = "SELECT titulo, precio, P02categorias.nombre AS categorias, P02usuarios.nombre AS nombre, P02anuncios.id
FROM P02categorias, P02usuarios, P02anuncios
WHERE P02anuncios.categoria=:ca AND vendido=0 AND email=propietario AND P02categorias.id=:ca
ORDER BY fechahora DESC";
$result2 = $db->prepare($consulta2);
$result2->execute(array(":ca" => $idcat));    
    
//Validar consulta
if (!$result){
	print "<p> Error en la consulta. </p>\n";
}else{
	
    print("<br><br>");
	print("\t\t<h1 class=\"tit\">Está viendo los articulos de la categoria: ".$fila["categoria"]."</h1>\n");
    print("<br><br>");
	
	
	//Contador per rows bootstrap
	$i=0;

	//Processament de resultats de la consulta SQL	
	foreach($result2 as $fila){
	//foreach($result as $contador => $fila){ //sintaxi alternativa de forache que inclou el contador: https://www.php.net/manual/es/control-structures.foreach.php
		//Printat de fila bootstrap només si múltiple de 3
		if(($i%3)==0){
			print("<div class=\"row\">\n");
		}		
		
			//Print column de 4, per situar-hi card
			print("\t<div class=\"col-sm-4\">\n");			
				
				//Print card amb dades anunci
				print("\t\t<article class=\"card\">\n");
				print("\t\t<div class=\"card-body\">\n");
				//print("<h2 class=\"card-title\">".$fila["titulo"]."</h2>\n");
				print("\t\t<h2 class=\"t1\"><a href=\"anuncio.php?idanuncio=".$fila["id"]."\">".$fila["titulo"]."</a></h2>\n");
				//print("<h2><a href=\"detallnoticia.php?id=".$fila["id"]."\">".$fila["titulo"]."</a></h2>\n");
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