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
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
//$db->debug=true;
$titulomodulo="Configuracion de mapas";
?>
<html>
<?include("../../../incluidos_modulos/head.php");?>

<? include("../../../incluidos_modulos/navegador.principal.php");?>
<body>
	<?
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	include("../../../incluidos_modulos/modulos.subencabezado.php");
	include("mapas.tabla.php");
	include("../../../incluidos_modulos/navegador.principal.cerrar.php");
	include("../../../incluidos_modulos/modulos.remate.php");
	?>
</body>
</html>
