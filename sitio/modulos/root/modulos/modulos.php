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
// root / modulos
$rutx=1;
if($rutx==1) $rutxx="../";
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuraci&oacute;n de m&oacute;dulos";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$idmodulo=$_REQUEST['idmodulo'];
$idsubmodulo=$_REQUEST['idsubmodulo'];
$idactivox=$_REQUEST['idactivox'];

//$db->debug=true;
$tabla=$prefix."tblmodulos";
// insercion
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
		 	$error=1;
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo,idmodulo,idsubmodulo)";
			$sql.=" values ('$dsm','$idpos','$idactivo','$idmodulo','$idsubmodulo') ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
			} else {
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
	}
}
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsr='".$_REQUEST['dsr_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";
					$sql.= ",idmodulo='".$_REQUEST['idmodulo_'][$j]."'";
					$sql.= ",idsubmodulo='".$_REQUEST['idsubmodulo_'][$j]."'";


					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];
?>
<html>
 <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
//exit();
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.dsr,a.idactivo,a.idmodulo,a.idsubmodulo from $tabla a where id>0 ";
if ($idactivox<>"") {
	if ($idactivox<>"999") $sql.=" and a.idactivo=$idactivox ";
} else {
	if ($_REQUEST['param']=="") $sql.=" and a.idactivo not in (2) ";

}
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.idmodulo asc,a.idsubmodulo asc,a.idactivo asc ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm,dsd,dsr";
		$paramn="Nombre Modulo,Descripcion,Ruta";
			include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idactivox=$idactivox";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../root/default.php' class='textlink' title='Principal'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("modulos.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("modulos.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

