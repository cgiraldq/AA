<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Ingresar Rutero por dia y semana
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblrutero";
if ($_REQUEST['inn']==1){
	$iddian=$_REQUEST['iddian'];
	$idsemana=$_REQUEST['idsemana'];
	$dsfecha=date("d-m-Y h:i:s");
	$idanio=$_REQUEST['idanio'];	
	$idusuario=$_SESSION['i_idusuario'];
	$strSQL=" select idr from ".$tabla." where iddian=$iddian ";
	$strSQL.=" and idsemana=".$idsemana;
	$strSQL.=" and idusuario=".$idusuario;
	$strSQL.=" and idanio=".$idanio;	
	$vermas=mysql_db_query($dbase,$strSQL,$db);
	$num=mysql_num_rows($vermas);
	if ($num==1){
		$Mensaje="El rutero del día $iddian de la semana $idsemana ya existe en el sistema";			
		$val=1;
	} else {
		$strSQL="insert into ".$tabla;
		$strSQL.="  values (";
		$strSQL.=" '',$iddian,$idsemana,$idanio,$idusuario,'$dsfecha'";
		$strSQL.=" )";
		@mysql_db_query($dbase,$strSQL,$db);
		$Mensaje="Se ha ingresado el rutero del día $iddian de la semana $idsemana";			
	}
	@mysql_free_result($vermas);

	} // fin inn

// validaciones de datos
	$mensajeData="Ingresando nuevo rutero de visita médica";
?>
<html>
<head>

	<title><? echo $AppNombre;?> Configuraciones: Ingreso de rutero</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.iddian.value==""){
			alert("<? echo $AppNombre;?>: Por favor digite el día");
			document.u.iddian.focus();
			return;
     }
	 
 	if (isNaN(document.u.iddian.value)){
		alert("<? echo $AppNombre;?>: El valor del día debe ser numérico");
		document.u.iddian.focus();
		return;
     }
	     document.u.submit();
	  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
		<table width=100% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=textnegro2 colspan=2>
			<strong>Para Ingresar los datos, es necesario llenar las casillas que se encuentran a continuación. TODAS LAS CASILLAS CON OBLIGATORIAS</strong><br>
		</td>
		</tr>
		
		<form action="<? echo $pagina;?>" method=post name=u>
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Digite el día del rutero:
		</td>
		<td valign=top>
			<input type="text" name="iddian" class=textnegro2 maxlength="2" size="3" value="<? echo $iddian;?>">
		</td>
		</tr>
		

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Seleccione semana:
		</td>
		<td valign=top>
			<select name="idsemana" class="text1">
			<? for($i=1;$i<=52;$i++){?>
				<option value="<? echo $i;?>" <? if ($i==$idsemana){ echo "SELECTED";}?>><? echo $i;?></option>
			<? } ?>
			</select>
		</td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Seleccione Año:
		</td>
		<td valign=top>
			<select name="idanio" class="text1">
			<? for($i=date("Y")-1;$i<=(date("Y")+10);$i++){?>
				<option value="<? echo $i;?>" <? if ($i==$idanio){ echo "SELECTED";}?>><? echo $i;?></option>
			<? } ?>
			</select>
		</td>
		</tr>
		
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Cerrar" class=formabot onClick="CargarPagina('ruteromedico.php');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
