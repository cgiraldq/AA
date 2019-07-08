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
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de las respuestas";

$idc=$_REQUEST['idc'];//id de la pregunta
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$tabla=$prefix."tblencuestarespuesta";
$dsruta="../cms/encuesta/default.php";
// insercion
if ($dsm<>"" &&  $idpos<>"" ) {
	$sql="select id ";
	$sql.=" from $tabla WHERE dsm='$dsm' and idc=$idc";
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		// no insertar
		$error=1;
		$mensajes=$men[0];
		} else {
			// insertar
			$sql="insert into $tabla (dsm,idc,idactivo,idpos)";
			$sql.=" values ('$dsm',$idc,$idactivo,$idpos) ";
			if ($db->Execute($sql))  {
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de respuestas";
				$dsrutap="../cms/encuesta/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$error=1;
				$mensajes=$men[2].".<br><br>$sql";
		}
	}
	$result->close();
}
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de respuestas";
		include($rutxx."../../incluidos_modulos/logs.php");
	}
}
// modificacion rapida
$contarx=count($_REQUEST['id_']);
$h=0;
for ($j=0;$j<$contarx;$j++){
	if ($_REQUEST['id_'][$j]<>""){
		$sql=" update $tabla set ";
		$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
		$sql.= ",idpos=".$_REQUEST['idpos_'][$j];
		$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
		$sql.= " where id=".$_REQUEST['id_'][$j];
		//echo $sql;
		if ($db->Execute($sql)) $h++;
	} // fin si
} // fin for
if ($h>0) $mensajes=$men[4];
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>


<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.idpos from $tabla a where id>0 and idc=$idc";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.id DESC ";
}
//echo $sql;
// modulo buscador
// 1. por cual campo se lista cuando se usa letra
$campoletra="dsm";
// 2. los tipo de busqueda
$paramb="dsm";
$paramn="Respuesta";
$camposadd_action="&idc=$idc";
include($rutxx."../../incluidos_modulos/modulos.buscador.php");
// fin modulo buscador
//esta es la ruta que manda siempre y cuando haga consulta con el buscador o con el paginador 1... o A-Z
$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
$rutaPaginacion.="&idcanal=$idcanal";

		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="  <a href='default.php' class='textlink'>Configuracion de encuesta</a> /";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
include($rutxx."../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if (!$result->EOF) {

	include("encuesta.respuesta.tabla.php");
	include($rutxx."../../incluidos_modulos/paginar.php");
} // fin si
$result->Close();
include("encuesta.respuesta.ingreso.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>
