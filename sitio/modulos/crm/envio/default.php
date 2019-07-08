<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// root / empresa
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
?>
<html>
<head>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
	<link rel="stylesheet" type="text/css" href="../../servicios/style.css">
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados

	$rutamodulo="<a href='../../core/default.php' target='_top' class='textlink'>Principal</a>  /";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$papelera=1;

	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	

	include("gestion.plan.cliente.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

