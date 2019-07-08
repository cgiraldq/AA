<?
/*
FrameWork Cf Para CMS CRM ECOMMERCE
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
 Validacion de datos al ingresar y manejo de perfiles
*/
session_start();
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
//include("../../incluidos_modulos/sql.injection.php");
//include("../../incluidos_modulos/validacion.campos.php");

$idx=$_REQUEST["formulario"];
$web=$_REQUEST["web"];
$editar=$_REQUEST["editar"];
$idcampo=$_REQUEST["idy"];
$dstoken=$_REQUEST["dstoken"];
$idfecha=date("Ymd");
$dsfecha=date("Y/m/d H:i:s");



$sqlx="select a.dscampo from framecf_tbltiposformulariosxcampo a where id>0 and idtipoformulario=$idx ";
$sqlx.="and idactivo not in(9)";
//echo $sqlx;

 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

if($editar==1){

$sqle=" update framecf_tblregistro_formularios set ";
$campose="";
$valorese="";

while(!$resultx->EOF){
		 $campose.=",".$resultx->fields[0];
		 $valorese.=",'".$_REQUEST[$resultx->fields[0]]."'";
		 $ingreso.=$resultx->fields[0]."='".$_REQUEST[$resultx->fields[0]]."',";
		$resultx->MoveNext();
	}
	$ingreso = trim($ingreso,',');
	$sqle.=" $ingreso,idfecha_mod='$idfecha',dsfecha_mod='$dsfecha'";
	$sqle.="where id=$idcampo";
	$resulte=$db->Execute($sqle);
	$resulte->Close();

 $ruta="../formularios/registros.php?idxx=$idx&dstoken=$dstoken";
//echo $sqle;
//exit();
}else{

	$sql="insert into framecf_tblregistro_formularios  ";

	$campos="";
	$valores="";
	while(!$resultx->EOF){
		$campos.=",".$resultx->fields[0];
		$valores.=",'".$_REQUEST[$resultx->fields[0]]."'";
		$resultx->MoveNext();
	}

	$campos=substr($campos,1,strlen($campos));
	$valores=substr($valores,1,strlen($valores));
	$sql.=" (idformulario,idfecha,dsfecha,$campos) ";
	$sql.=" values  ";
	$sql.=" ($idx,'$idfecha','$dsfecha',$valores)";

	$result=$db->Execute($sql);
	$result->Close();
if($web==1){
	$ruta="../formularios/listado.php?msg=1";
}else{
$ruta="../formularios/default.php?dstoken=$dstoken";
}

}
}


$resultx->Close();



//include("../../incluidos_modulos/cerrarconexion.php");
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<?
// redireccionadores

?>
<script language="javascript">
<!--
location.href="<? echo $ruta;?>";
//-->
</script>
?>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1>
</body>
</html>