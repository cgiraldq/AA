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
$injection="no";
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$rr="default.php";
$titulomodulo="Editando cliente seleccionado";
$idclientepago=$_REQUEST['idclientepago'];
include("proceso.editar.php");
$tabla="tblclientes";
?>
<html>
	<?include("../../../incluidos_modulos/head.php");?>
<body >

	<? include("../../../incluidos_modulos/navegador.principal.php");?>
<?
include("ingreso.php");
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
