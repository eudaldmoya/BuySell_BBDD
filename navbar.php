<header>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estils.css">

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
	print("<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">\n");
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
?>
    </header>