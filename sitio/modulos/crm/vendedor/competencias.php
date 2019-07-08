<?
/*
| ----------------------------------------------------------------- |
 Sistema integrado de gestion e informacion administrativa.

Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Productos recetados por la competencia
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblcompetenciatransp ";
$idcampo=$_REQUEST['idcampo'];
$dsnombre=$_REQUEST['dsnombre'];
$iddia=$_REQUEST['iddia'];
$idciclo=$_REQUEST['idciclo'];
// fin variables parent

if ($_REQUEST['inn']==1){
	$idt=$_REQUEST['idt'];
	$idpor=$_REQUEST['idpor'];
	$dscom=$_REQUEST['dscom'];	
	$dsfecha=date("Y/m/d h:i:s");
	$idfecha=date("Ymd");
	$sql="select id from $tabla where idt=$idt and idcliente=$idcampo and iddia=$iddia ";
	$sql.=" and idciclo=$idciclo ";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$Mensaje="Estos datos ya se encuentra en el sistema.";			
	} else { 
		$strSQL="insert into ".$tabla;
		$strSQL.=" (";
		$strSQL.=" id,idusuario,idt,idcliente,idpor,dscom";
		$strSQL.=" ,dsfecha,idfecha,iddia,idciclo";
		$strSQL.=" )";
		$strSQL.=" values (";
		$strSQL.=" '',".$_SESSION['i_idusuario'].",$idt,$idcampo,$idpor,'$dscom'";
		$strSQL.=" ,'$dsfecha',$idfecha,$iddia,$idciclo";
		$strSQL.=" )";
//		echo $strSQL;
//		exit();
		if (mysql_db_query($dbase,$strSQL,$db)) {
			 $Mensaje="Competencia ingresada con éxito.";			
		} else { 
			 $Mensaje="Problemas con la base de datos";			
		}	 
	}	
	} // fin inn

if ($_REQUEST['del']=="1"){
	$strSQL="delete from $tabla ";
	$strSQL.=" where id=".$_REQUEST['iddi'];
	if (mysql_db_query($dbase,$strSQL,$db)) { 
		$Mensaje="Ítem eliminado con éxito del sistema.";
	} else { 
		$Mensaje="Problemas con la base de datos";
	}	
}
// validaciones de datos
	$mensajeData="Competencia encontrada en ". $dsnombre;
?>
<html>
<head>

	<title><? echo $AppNombre;?></title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	
	if (document.u.idt.value==""){
	alert("<? echo $AppNombre;?>: Seleccione la transportadora");
	document.u.idt.focus();
	return false;
     }
	 
	 if (document.u.idpor.value==""){
	alert("<? echo $AppNombre;?>: Digite el porcentaje ");
	document.u.idpor.focus();
	return false;
     }

	 if (isNaN(document.u.idpor.value)){
	alert("<? echo $AppNombre;?>: El valor debe ser numerico ");
	document.u.idpor.focus();
	return false;
     }

	 
     document.u.submit();

	  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
	<tr align=left class="formabot">
			<td valign=top colspan=2 bgcolor="<? echo $fondos[4];?>"><? echo  $mensajeData;?>
			</td>
		</tr>
	</table>
	<? include ("../../incluidos/resultoperaciones.php"); ?>	
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>" class="text1">
		<form action="<? echo $pagina;?>" method=post name=u>
		<tr bgcolor="<? echo $fondos[3];?>">
		<td valign=top class=texto>
			Competencia
		</td>
		<td valign=top>
<select name="idt" class="text1">
			<option value="">...</option>
			<? combostransportadoras($idt,$_SESSION['i_idempresa']);?>
			</select>		</td>
			
		<td valign=top class=texto>
			Porcentaje
		</td>
		<td valign=top>
		<input type="text" class="text1" name="idpor" value="<? echo $idpor;?>" size="3" maxlength="3">
</td>	
			
		</tr>
		
		<tr bgcolor="<? echo $fondos[3];?>">
		<td valign=top class=texto>
			Comentarios:
		</td>
		<td valign=top colspan="3"> 
			<textarea name=dscom cols="60" rows="2" class="texto"><? echo $dscom;?></textarea>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan="4">
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Cerrar" class=formabot onClick="window.close();">
			<input type=hidden name=inn value="1">
			<input type=hidden name=idcampo value="<? echo $idcampo;?>">
			<input type=hidden name=dsnombre value="<? echo $dsnombre;?>">
			<input type=hidden name=name value="<? echo $name;?>">		
			<input type=hidden name=iddia value="<? echo $iddia;?>">									
			<input type=hidden name=idciclo value="<? echo $idciclo;?>">									
			</td>
		</tr>
		</form>
	</table>
	<br>

<?
$strSQL="select a.*,b.dst as transp ";
$strSQL.=" from ".$tabla." a, tbltransportadoras b";
$strSQL.=" where a.idt=b.idt ";
$strSQL.=" and a.idcliente=".$idcampo;
$strSQL.=" and a.iddia=".$iddia;
$strSQL.=" and a.idciclo=".$idciclo;
$strSQL.=" order by a.idpor DESC ";
//echo $strSQL;
?>

<? // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
?>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;" bgcolor="<? echo $fondos[4]?>">
			
			<tr class=formabot align="center">
			<td ><strong>Transportadora</strong></td>
			<td ><strong>Observaciones</strong></td>
			<td ><strong>Porcentaje</strong></td>			
			<td ><strong>Fecha</strong></td>			
			<td class=fondoprincipal3><strong>Opciones</strong></td>
			</tr>
				</table>
		<? 
		if (mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)) {
					ob_start(); 
					?>
					<table width=100% align=center  cellpadding=2 cellspacing=1  style="table-layout:fixed;" bgcolor="<? echo $fondos[4];?>">
					<tr class=textnegro2  bgcolor="<? echo $fondos[3];?>" align="center">		
					<td align="left"><strong><? echo $fila->transp;?></strong></td>					
					<td align="left"><? echo $fila->dscom;?></td>
	<td><? echo $fila->idpor;?></td>					
					<td><? echo $fila->dsfecha;?></td>
				
					<td>
					 <? if ($fila->idfecha>=$fechaBaseNum){ ?>
					<a href="javascript:enviarconfirmG('Esta seguro de eliminar este item?','Este proceso no se puede devolver',2,'<? echo $_SERVER['PHP_SELF'];?>?iddi=<? echo $fila->id;?>&idcampo=<? echo $idcampo;?>&dsnombre=<? echo $dsnombre;?>&del=1&idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&iddia=<? echo $iddia;?>','');" title="Eliminar este ítem" class="link11">Eliminar</a>
					<? }?>
					</td>
					
					</tr>
					</table>
					<?
					ob_end_flush(); 	
				} // fin while
		} // fin si 
		@mysql_free_result($vermas);
		?>
<br>	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>