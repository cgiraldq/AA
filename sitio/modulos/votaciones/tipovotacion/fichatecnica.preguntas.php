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

$titulomodulo="Preguntas Ficha t&eacute;cnica";
$dsm=$_REQUEST['dsm'];
$idtv=$_REQUEST['idtv'];
$idy=$_REQUEST['idy'];
$idx=$_REQUEST['idx'];

$idactivo=$_REQUEST['idactivo'];

$tabla="tblvotacionfichatecnicapreguntas";
// insercion

$dsruta="../tipovotacion/default.php";
$dsm=$_REQUEST['dsm'];
$idoblig=$_REQUEST['idoblig'];
$idpos=$_REQUEST['idpos'];
$idtipo=$_REQUEST['idtipo'];


if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idtv=$idtv and idficha=$idy";

		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,idtv,idficha,idoblig,idpos,idtipo)";
			$sql.=" values ('$dsm',$idactivo,$idtv,$idy,$idoblig,$idpos,$idtipo) ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql";
			}
		 }
		 $result->close();
}
// eliminacion
//include($rutxx."../../incluidos_modulos/modulos.papelera.php");
if ($idx<>"") {
$sql="delete from $tabla where id=$idx ";
	if ($db->Execute($sql))  {

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
					$sql.= ",idtipo='".$_REQUEST['idtipo_'][$j]."'";
					$sql.= ",idoblig='".$_REQUEST['idoblig_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";

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
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.idtv,a.idpos,a.idoblig,a.idtipo from $tabla a where a.idtv=".$idtv;
$sql.=" and a.idficha=$idy ";

//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";

	$sql.=" order by a.idpos asc ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
//		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
	$rutamodulo.="<a href='fichatecnica.php?idtv=$idtv' class='textlink' title='Ficha t&eacute;cnica'>Ficha t&eacute;cnica</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$papelera=2;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("fichatecnica.preguntas.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("fichatecnica.preguntas.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>