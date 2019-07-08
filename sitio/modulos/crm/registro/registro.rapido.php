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
//$db->debug=true;
$idxx=$_REQUEST['idxx'];
if($idxx=="") $idxx=1;
$titulomodulo="Registro rapido ";
$letra=$_REQUEST['letra'];
$idgaleria=$_REQUEST['idgaleria'];
if ($_REQUEST['campo']=="idconsecutivo"){$tabla="crm_propiedades";}else{ $tabla="crm_clientes";}
$tablax=$prefix."tbltiposformulariosxcampo";
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

//--- Trae  Nombre  de los campos y Los prefijos de los campo de la  base de  datos ---//
$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where 1 ";

if($_REQUEST['campo']=="idconsecutivo") $sqlx.=" and idtipoformulario=104 ";
if($_REQUEST['campo']<>"idconsecutivo") $sqlx.=" and idtipoformulario=$idxx ";

$sqlx.="and idactivo not in (2,9)  and idpublicardetalle=1 ";

if($_REQUEST['campo']=="idconsecutivo") $sqlx.=" and dscampo!='dscampo2'";

$sqlx.=" order by idpos";
//echo $sqlx;
$nombrecampos="Codigo,";
if($_REQUEST['campo']=="idconsecutivo") $nombrecampos.="Propietario,";
$result_campos=$db->PageExecute($sqlx,$maxregistros,$pagina_actual);
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
$cantidad = explode(",", $campos);
 $cantidad= count($cantidad);
  $cantidad= $cantidad+2;

 if($_REQUEST['param']<>''){
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.idactivo,a.idclasgratis,a.idusuario,a.id,a.idactivo,";
if($_REQUEST['campo']=="idconsecutivo") {$sql.="a.idconsecutivo,a.idpropietario";}else{ $sql.="a.id"; }
if($dscampo<>"")$sql.=",".$campos.",idusuario";
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";
$sql.=" from $tabla a";

//if( $_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
if ($_REQUEST['campo']=="idusuario") $sql.=" inner join tblusuarios b";
if ($_REQUEST['campo']=="idconsecutivo") {
	$sql.="  where  1";
} else { 
	$sql.="  where  1";
}
if ($_REQUEST['campo']=="idusuario") $sql.=" and a.idusuario=b.id";

if ($_SESSION['i_idactivo']<>"1") $sql.=" and a.idusuario=".$_SESSION['i_idusuario'];
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"" && $_REQUEST['param']<>"-1" &&  $_REQUEST['campo']<>"nombre_o_razn_social" && $_REQUEST['campo']<>"apellido_o_nombre_comercial" && $_REQUEST['campo']<>"idconsecutivo") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['param']<>"" && $_REQUEST['param']<>"-1" && ($_REQUEST['campo']=='nombre_o_razn_social' || $_REQUEST['campo']=='apellido_o_nombre_comercial')) $sql.=" and CONCAT_WS(' ',nombre_o_razn_social,apellido_o_nombre_comercial) like '%".$_REQUEST['param']."%'" ;
if ($_REQUEST['param']<>"" && $_REQUEST['param']<>"-1" && ($_REQUEST['campo']=='idconsecutivo')) $sql.=" and ".$_REQUEST['campo']." ='".(double)($_REQUEST['param'])."'" ;
if ($_REQUEST['campo']=="idconsecutivo") {
		$sql.=" order by a.idconsecutivo asc  ";

} else {
	$sql.=" order by a.id desc  ";
}
}
//echo $sql;
//exit();

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		//$campoletra="dscampo27";



$separador="|";
	$ocultar=1;
	$listar=1;
		$paramb="nombre_o_razn_social|apellido_o_nombre_comercial|cdula_o_nit|telfono_1|telfono_2|correo_email";
	//echo "<br><br><br>";
	$paramn="Nombres|Apellidos|Identificaci&oacute;n|Tel&eacute;fono|Celular|Email";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&idactivox=".$_REQUEST['idactivox']."&clasgratisx=".$_REQUEST['clasgratisx']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];

	$rutamodulo="<a href='$rutxx../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../formularios/listado.php?dstoken=$dstokenvalidador' class='textlink' title='Listado de usuarios registrados'> Listado de formularios </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$parametros="?parametros=".$idxx."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
	if($_SESSION['i_idperfil']==1)$exportar=2; $importar=2;// permite exportar la tabla


	 include("registros.tabla.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

//		include($rutxx."../../incluidos_modulos/paginar.php");
//include($rutxx."../../incluidos_modulos/html.remate.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>