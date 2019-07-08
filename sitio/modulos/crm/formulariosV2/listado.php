<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$apagar=1;
$titulomodulo="Listado de formularios.";
$tabla="framecf_tbltiposformularios";
$pruta="formularios";
$dsrutap="../crm/formularios/listado.php";

$msn=$_REQUEST["msn"];
if($msn==1){ $error=0; $mensajes=$men[1];}
if($msn==2) {$error=1; $mensajes=$men[0];}

//include("proceso.php");
//include("proceso.duplicar.php");
//$papelera=3;
//$dsrutaPapelera="../papelera/papelera.php?dstabla=$tabla&titulomodulo=$titulomodulo&xruta=$pruta&idy=$idy&dstoken=$dstokenvalidador";//ruta de la papelera

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dstabla,a.dsr,a.idtipo,a.idpublicar,a.iddesplegable,a.idestilo,a.idformclientes,a.idgaleria  ";
$sql.="from $tabla a ";

if( $_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
$sql.=" where a.idactivo=1  ";

if( $_SESSION['i_idperfil']==4)$sql.=" and a.id=b.iddestino and b.idorigen='".$_SESSION['i_idrol']."'";

if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.dsm asc ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Formulario";
	// fin modulo buscador
		$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
		$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";

		include("listado.tabla.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

//		include($rutxx."../../incluidos_modulos/paginar.php");
//include($rutxx."../../incluidos_modulos/html.remate.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>