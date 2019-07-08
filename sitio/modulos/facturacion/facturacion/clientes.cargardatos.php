<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Traer los datos de retenciones y descuento del cliente
 
*/
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
$tabla="tblclientes";
$idclientex=$_REQUEST['idclientex'];
$sql=" select dsret,dsretiva,dsretica,idlista,dsdescuento,dsdiasv,idusuario from $tabla where id='$idclientex'";
$vermas=mysql_db_query($dbase,$sql,$db);

// traer la fecha de vencimiento de acuerdo a los dias de vencimiento por cliente
	$dsmes=$_SESSION['i_dsmes'];
	if ($dsmes<10) $dsmes="0".$dsmes;
	$can_dias = 30; 
	$dyh = getdate(mktime(0, 0, 0, $dsmes, date("d"), $_SESSION['i_dsanio']) + 24*60*60*$can_dias); 
	$fec_vencimiento = $dyh['year']."/".$dyh['mon']."/".$dyh['mday'];  
	$dsfechav=$fec_vencimiento;

if (mysql_num_rows($vermas)>0) { 
	// traer los datos adicionales
	$dsretica=mysql_result($vermas,"0","dsretica");
	$dsret=mysql_result($vermas,"0","dsret");
	$dsretiva=mysql_result($vermas,"0","dsretiva");
	$idlista=mysql_result($vermas,"0","idlista");
	$dsdescuento=mysql_result($vermas,"0","dsdescuento");
	$can_dias=mysql_result($vermas,"0","dsdiasv");
	$idusuario=mysql_result($vermas,"0","idusuario");
	$dyh = getdate(mktime(0, 0, 0, $dsmes, date("d"), $_SESSION['i_dsanio']) + 24*60*60*$can_dias); 
	$mesbase=$dyh['mon'];
	$diabase=$dyh['mday'];
	if (strlen($mesbase)<2) $mesbase="0".$mesbase;
	if (strlen($diabase)<2) $diabase="0".$diabase;
	$fec_vencimiento = $dyh['year']."/".$mesbase."/".$diabase;  
	//$fec_vencimiento = $dyh['year']."/".$dyh['mon']."/".$dyh['mday'];  
	$dsfechav=$fec_vencimiento;
	$data=$dsret."|".$dsretiva."|".$dsretica."|".$idlista."|".$dsdescuento."|".$dsfechav."|".$can_dias."|".$idusuario;
} else { 
	$data="0|0|0|0|0|$dsfechav|0|0";
}
mysql_free_result($vermas);	
echo $data;
include ("../../incluidos/cerrarconexion.php");
?>