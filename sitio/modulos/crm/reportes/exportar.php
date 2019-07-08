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
// exportar

header("Content-type: application/octet-stream");
$nombre="exportar-".date("Ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");


$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
$titulomodulo="Listado";

 $idxx=$_REQUEST["parametros"];


$tabla=$prefix."tblregistro_formularios";
$tablax=$prefix."tbltiposformulariosxcampo";
// generacion del encabezado de acuerdo a los resultados encontrados
//--- Trae  Nombre  de los campos y Los prefijos de los campo de la  base de  datos ---//
$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where idtipoformulario=$idxx ";
$sqlx.="and idactivo=1 order by idposn";
//echo $sqlx;

$result_campos=$db->Execute($sqlx);
if (!$result_campos->EOF) {
	while(!$result_campos->EOF){
		$id=$result_campos->fields[0];
		$dsm=$result_campos->fields[1];
		$dscampo=$result_campos->fields[2];

		$nombrecampos.=$dsm.",";
		$campos.=$dscampo.",";
  $result_campos->MoveNext();
		 		 }
	} // fin si
$result_campos->Close();

//*******  Fin nombre campos ******//

$campos=trim($campos,',');
$cantidad = explode(",",$campos);
 $cantidad= count($cantidad);
  $cantidad= $cantidad;
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select idusuario,clasgratis,idactivo,id,";
if($dscampo<>"")$sql.="$campos";
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";
$sql.=" from $tabla a";


//if( $_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
if ($_REQUEST['campo']=="idusuario") $sql.=" inner join tblusuarios b";
$sql.="  where  a.idformulario='$idxx'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and a.idusuario=b.id";

//if( $_SESSION['i_idperfil']==4)$sql.="  and a.idusuario=b.idorigen and b.idorigen='".$_SESSION['i_idusuario']."' and b.iddestino='$idxx' ";
//echo "<br>";
//echo $_REQUEST['campo'];
if ($_REQUEST['param']<>"" && $_REQUEST['campo']<>"idusuario") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idactivox']<>"") $sql.=" and a.idactivo='".$_REQUEST['idactivox']."%'";
if ($_REQUEST['clasgratisx']<>"") $sql.=" and a.clasgratis='".$_REQUEST['clasgratisx']."%'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and b.dsm like '".$_REQUEST['param']."%'";

$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		//$campoletra="dsnombre";
		// 2. los tipo de busqueda
	// fin modulo buscador
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("registros.tabla.exportar.php");

	} // fin si
$result->Close();
?>