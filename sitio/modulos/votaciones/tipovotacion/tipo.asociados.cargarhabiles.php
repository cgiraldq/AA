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

$idtipo=21;
$titulomodulo="Cargar Asociados habilitados para el tipo de votaci&oacute;n seleccionado";
$tabla="tblvotacionasociados_temp";
$dsruta="../tipovotacion/default.php";
$rutaImagen=$rutxx."../../../contenidos/images/fichatecnica/";
$idtv=$_REQUEST['idtv'];
$cargar=$_REQUEST['cargar'];
// proceso de votacion por medio de archivo plano
//$db->debug=true;
if ($cargar<>"") {
		include("tipo.asociados.cargarhabiles.proceso.php");

		$sql="delete from $tabla ";
		$db->Execute($sql);
		// borrar los asociados
		$sql="delete from tblvotacionasociados where idtipov=$idtv and idtipo=$idtipo";
		$db->Execute($sql);
		// fin borrar los asociados

		$contarx=count($cedula);
		$h=0;
			for ($j=1;$j<$contarx;$j++){
		if ($cedula[$j]<>"") {
			$sql="select id from $tabla where dscodigo='".$cedula[$j]."' and dsnombre='".$dsnombre[$j]."'";
			$sql.=" and idnits='".$idnits[$j]."' and dscodigoasociado='".$dscodigoasociado[$j]."' ";
			//echo $sql."<br>";

			$resultx=$db->Execute($sql);
			if (!$resultx->EOF) {
			} else {

			$sql="insert into $tabla (dscodigo,dsnombre,idnits,idzonaelectoral,dszonaelectoral,dscodigoasociado,dsclave,dsemail)";
			$sql.="	values ('".$cedula[$j]."','".$dsnombre[$j]."','$idnits[$j]','$idzonaelectoral[$j]','".$dszonaelectoral[$j]."','".$dscodigoasociado[$j]."','".sha1($dsclave[$j])."','".$dsemail[$j]."') ";
			//exit();
			//echo $sql."<br>";
			$db->Execute($sql);

			}
			$resultx->Close();
		}
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
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");

	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
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
		$bloqueohabiles=1;
		include("tipo.asociados.habiles.tabla.php");
	} // fin si
$result->Close();
	include("tipo.asociados.cargarhabiles.ingreso.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>