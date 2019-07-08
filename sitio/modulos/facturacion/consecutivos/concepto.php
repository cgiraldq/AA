<?
/*
| ----------------------------------------------------------------- |
-SISTEMA INTEGRADO DE GESTION  E INFORMACION ADMINISTRATIVA-
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2010
Medellin - Colombia
=====================================================================
Autores: 
Juan Fernando Fernández <consultorweb@comprandofacil.com>
Juan Felipe Sánchez <graficoweb@comprandofacil.com>
José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Principal Terceros en el sistema - solo usuario seleccionado
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$dsm="Concepto";
include ("../../incluidos/seguridad.php");
// mensajes de recuperacion de claves
$tabla="tblconcepto";
$cargarfac=$_REQUEST['cargarfac'];
$cargarec=$_REQUEST['cargarec'];
if ($_REQUEST['enviar']=="Modificar")
{
	$contar=count($_REQUEST['id']);
	$v=0;
	for ($j=0;$j<$contar;$j++)
	{
		if ($_REQUEST['id'][$j]<>"")
		{
			$sqlm=" update ".$tabla. " set ";
			$sqlm.= "dscodigo='".$_REQUEST['dscodigo'][$j]."'";				
			$sqlm.= "dsm='".$_REQUEST['dsm'][$j]."'";
			$sqlm.= ",dsd='".$_REQUEST['dsd'][$j]."'";						
			$sqlm.= " where id=".$_REQUEST['id'][$j];
			//echo $sqlm;
			if (mysql_db_query($dbase,$sqlm,$db)) $v++;
		} // fin si
	} // fin for
	if ($v>0) $Mensaje="Modificación realizada con éxito ".$mensajeData;	
} // fin inn
// nombre d elos campos en base de datos

$codigos[0]="dsnombre";
//nombre en el combo para el usuario	

$nombres[0]="Nombre";
// armando campos
$campos="dsnombre";
$condiciones="";
$nombreBase="dsnombre";
$name="med"; // el <a name>
if ($_REQUEST['enviar']=="Eliminar")
{ // eliminacion de datos
			$sqlm=" delete from  ".$tabla. "  ";
			$sqlm.= " where id=".$_REQUEST['id'];
			//echo $sqlm;
			mysql_db_query($dbase,$sqlm,$db);
	$Mensaje="Eliminación con exito del cliente seleccionado ";	
}	
?>
<html>
<head>
<title><? echo $AppNombre;?>: Concepto</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
//-->
</SCRIPT>
<?
include ("../../incluidos/javageneral.php");
?>
<style type="text/css">
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #333333;
	font-weight: bold;
}
</style>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
if ($ida==1){
//include ("../../incluidos/encabezado.php");
?>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
<br>


<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2">
	<tr bgcolor="<? echo $fondos[5];?>">
		<td valign=top align=left class="style1">
		CONCEPTO</td>
	
	<td valign=top align=right>
	<input type=button name=enviar1 value="Nuevo" class="formbt1" onClick="irAPaginaDNP('../concepto/innconcepto.php?tabla=tblconcepto');"></td>
	
	</tr>
</table>
<?
// parametro adicional en caso que se lista por empresa
$tabla="tblconcepto";
$bloqueabc=0;
include ("../../incluidos/buscador.php"); 
$strSQL="select a.id,a.dscodigo,a.dsm,a.dsd";
$strSQL.=" from $tabla a where a.id>0";
//$strSQL.=", tblusuariose a";
//echo $strSQL;
//$strSQL.=" where a.idempresa=".$_SESSION['i_idempresa'];
//$strSQL.=" and c.idusuario=a.id ";	
//if ($_SESSION['i_idperfil']<>0) $strSQL.=" and a.idusuario=".$_SESSION['i_idusuario'];
if($_REQUEST['param']<>""){
 	$strSQL.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";	
 	}
if($_REQUEST['letra']<>"") $strSQL.=" and a.dsm like '".$_REQUEST['letra']."%'";


//if($idlistax<>"") $strSQL.=" and idlista=$idlistax";
//if($idorigenclientex<>"") $strSQL.=" and idorigencliente=$idorigencliente";

$strSQL.=" order by  a.dsm ASC ";
//echo $strSQL;
// exit();
// armar paginacion
$vermas=mysql_db_query($dbase,$strSQL,$db);
if (mysql_affected_rows()>0) { 
$total=mysql_num_rows($vermas);
}

if ($_REQUEST['pag']==""){ 
$pag = 1; // Por defecto, pagina 
}else { 
$pag=$_REQUEST['pag'];
}	
$cantidad1=$_REQUEST['cantidad'];
if ($cantidad1==""){ $cantidad1=$_REQUEST['cantidad']; }
if ($cantidad1==""){ 
$tampag = 30;
}else{
$tampag = $cantidad1;
}
$reg1 = ($pag-1) * $tampag;
if ($_REQUEST['pag']<>"-1"){ 
$strSQL.=" limit $reg1,$tampag";
}

//echo $strSQL;
mysql_free_result($vermas);
$rutaPaginador=$pagina."?letra=".$_REQUEST['letra']."&param=".$_REQUEST['param']."&campo=$campo&idorigenclientex=$idorigenclientex&idlistax=$idlista&cargarfac=$cargarfac&cargarec=$cargarec&cantidad=$tampag&pag=";
// pintando cabecera de datos
$vermas=mysql_db_query($dbase,$strSQL,$db);
include ("../../incluidos/func.paginador.php");	
include ("../../incluidos/func.tabla.paginador.php");	

?>
<br>
<table width=80% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>">
<form action="<? echo $pagina;?>" method="post" name=u>										
<tr class=forma2 bgcolor="<? echo $fondos[12];?>" align="center">
<td class="formbt3" style="width: 5%">Id</td>
<td class="formbt3">Codigo PUC</td>
<td class="formbt3">Nombre</td>
<td class="formbt3">Descripcion</td>
<td  background="../../img/fondo3.jpg" bgcolor="#FCF5DB" class="textnegrotit1" width="10%">::Opciones::</td>
</tr>
</table>

<? 
if (mysql_affected_rows()>0){
while($fila=mysql_fetch_object($vermas)) {
$dsnombre=$fila->dsnombre." ".$fila->dsapel;
if ($fila->idusuariootro==$_SESSION['i_idusuario']){
$fondo=$fondos[20];
//$mem="Este Cliente esta compartido con otro usuario";
$compar=1;
} else {
$fondo=$fondos[4];
$mem="";
$compar=2;
}

?>
<table width=80% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed">					
<tr class=forma2  bgcolor="<? echo $fondo;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[3];?>');">		
<td align="center" bgcolor="<? echo $fondos[12]?>" class="link_negro1" width="5%">
<? echo $fila->id;?>
</td>
<td align="center" class="link_negro1">
<input type="text" name="dsm[]" value="<? echo $fila->dscodigo;?>" size="10" class="link_numeros">
</td>

<td align="center" class="link_negro1">
<input type="text" name="dsm[]" value="<? echo $fila->dsm;?>" size="20" class="link_numeros" style="text-transform:uppercase">
</td>
						
<td align="center" class="link_negro1">
<input type="text" name="dsd[]" value="<? echo $fila->dsd;?>" size="25" class="link_numeros">
</td>

<td nowrap class="link_negro1" width="10%"> 				
&nbsp;
<input type=button name=enviar value="Eliminar" class="formbt2" onClick="enviarconfirm('Esta seguro de eliminar el registro',2,'default.php?id=<? echo $fila->id?>&enviar=Eliminar');" title="Click para eliminar registro" style="width: 57px">

<input type=hidden name="id[]" value="<? echo $fila->id;?>" >
</td>		
</tr>
</table>				
<?
} // fin while
ob_flush();
flush(); 
} // fin si 
mysql_free_result($vermas);
?>
<table width=80% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
<tr class=forma2  bgcolor="<? echo $fondos[4];?>" align="center">		
<td  onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[5];?>');">

<? if ($idmod==1){?>
<input type=submit name="enviar" class="formbt1" value="Modificar">
<input type="hidden" name="idlistax" value="<? echo $idlistax?>">
<input type="hidden" name="idorigenclientex" value="<? echo $idorigenclientex?>">
<? } ?>
<? if ($iddel==1){?>
<!--input type=submit name="enviar" class=forma2 value="Eliminar"-->
<? } ?>
</td>
</tr>
</form>		
</table>
<br>

<?
} else {
include ("../../incluidos/mensajenoseguridad.php");	
}
//include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>
