<?
/*serror_reporting(E_ALL);
ini_set("display_errors", 1);*/
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
$rutx=1;

if($rutx==1) $rutxx="../";
$titulomodulo="Opciones Campa&ntilde;a Telef&oacute;nica";


include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/modulos.funciones.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
$idcampana=$_REQUEST['idcampana'];

?>

<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
	  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">
	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">

<body>


<?
$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

include($rutxx."../../incluidos_modulos/navegador.principal.php");
include($rutxx."../../incluidos_modulos/core.mensajes.php");
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

?>

<section>
<nav class="nav_centro">
<a class="botones"  href="filtros.actulizar.datos.cliente.php?idcampana=<? echo $idcampana; ?>" >ACTUALIZAR DATOS</a>
<a class="botones"  href="filtros.realizar.encuesta.cliente.php?idcampana=<? echo $idcampana; ?>" >REALIZAR ENCUESTA</a>
<?
$rutacam="filtros.php?idcampana=$idcampana";
if($_REQUEST['reg']==1)$rutacam='../formularios/registros.php?idxx=94&r=1';
?>
<a class="botones" href="<? echo $rutacam; ?>" >REGRESAR</a>
</nav>
</section>
<?

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

