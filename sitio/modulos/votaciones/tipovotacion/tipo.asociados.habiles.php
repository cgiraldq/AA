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
// proceso de validacion contra la tabla de usuarios del informer41_feisa
$rutx=1;
$rutxx="../";




$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
include($rutxx."../../incluidos_modulos/modulos.calendario.php");
$idtipo=21;
include("tipo.asociados.habiles.proceso.php");
$titulomodulo="Asociados habilitados para el tipo de votacion seleccionado";

$idtv=$_REQUEST['idtv'];
$tabla="tblvotacionasociados_temp";
//echo $total."".$_SESSION['i_totalasociados'];
//$db->debug=true;
if ($total<>$_SESSION['i_totalasociados'] && $_REQUEST['paso']=="" && $_REQUEST['enviarx']=="recargar") {

		$sql="delete from $tabla ";
		//$db->Execute($sql);
		// borrar los asociados
		$sql="delete from tblvotacionasociados where idtipov=$idtv and idtipo=$idtipo";
		$db->Execute($sql);
		// fin borrar los asociados

		$contarx=count($cedula);
		$h=0;
			for ($j=0;$j<$contarx;$j++){

			$sql="select id from $tabla where dscodigo='".$cedula[$j]."' and dsnombre='".$dsnombre[$j]."'";
			$sql.=" and idnits=".$idnits[$j]." and dscodigoasociado='".$dscodigoasociado[$j]."' ";

			$resultx=$db->Execute($sql);
			if (!$resultx->EOF) {
			} else {

			$sql="insert into $tabla (dscodigo,dsnombre,idnits,idzonaelectoral,dszonaelectoral,dscodigoasociado)";
			$sql.="	values ('".$cedula[$j]."','".$dsnombre[$j]."',$idnits[$j],$idzonaelectoral[$j],'".$dszonaelectoral[$j]."','".$dscodigoasociado[$j]."') ";
			//exit();
			$db->Execute($sql);

			}
			$resultx->Close();

			//echo $sql;

		}


}
if ($_REQUEST['paso']=="1") {
// INSERCION DE DATOS ASOCIADOS HABILES
		$sql="delete from tblvotacionasociados where idtipov=$idtv and idtipo=$idtipo";
		//$db->debug=true;
		$db->Execute($sql);

		$contarx=count($_REQUEST['dscodigo_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['dscodigo_'][$j]<>""){

				$sql="insert into tblvotacionasociados";
				$sql.="(dscodigo,idtipov,idtipo)";
				$sql.=" values ";
				$sql.="('".$_REQUEST['dscodigo_'][$j]."',$idtv,$idtipo)";
				if ($db->Execute($sql)) $h++;
				}
			}
		if ($h>0) $mensajes=" Proceso realizado ";

}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votacion</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$papelera=2;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dscodigo,a.dsnombre,a.dszonaelectoral from $tabla a where 1";
//echo $sql;
$sql.=" order by a.dszonaelectoral asc,a.dsnombre asc ";
//echo $sql;
$result=$db->Execute($sql);
	if (!$result->EOF) {
		include("tipo.asociados.habiles.tabla.php");
	} // fin si
$result->Close();

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>