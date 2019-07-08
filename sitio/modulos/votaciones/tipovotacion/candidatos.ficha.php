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
$rutxx="../";
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Candidatos";
$dsm=$_REQUEST['dsm'];
$idtv=$_REQUEST['idtv'];
$foto=$_REQUEST['foto'];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
	$rutamodulo.="<a href='candidatos.php?idtv=$idtv' class='textlink' title='Tipo de votacion'>Candidatos</a>  /  ";

	$rutamodulo.=" <span class='text1'>Ficha candidato seleccionado</span>";
	$papelera=1;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	include("../../../incluidos_sitio/votaciones/asociados_votaciones.inscripciones.ficha.cuerpo.php");


	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>