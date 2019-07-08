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
// root / Panel de ejecuciones generales de sql
// lado izquierdo: textarea
// lado derecgho: listado de tablas actuales en el sistma
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Ejecuciones SQL";
$dsm=$_REQUEST['dsm'];
if ($dsm<>"") {
			$sql=$dsm;
			if ($db->Execute($sql))  {
				$h=1;
				$mensajes="<strong>".$men[1]."</strong>";
			} else {
				$error=1;
				$mensajes=$men[2].".<br><br>$sql";
			}
}
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

$rutamodulo="<a href='$rutxx../root/default.php' class='textlink'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
$bloqueor=1; // bloquea el mensaje de registros encontrados
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
include("sql.tabla.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>

