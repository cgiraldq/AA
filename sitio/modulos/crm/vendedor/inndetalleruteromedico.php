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
$tabla="tblruterodetalle";
$idsemana=$_REQUEST['idsemana'];
if ($idsemana==""){
	$idsemana=$_REQUEST['idsemana'];
}
$idr=$_REQUEST['idr'];
if ($idr==""){
	$idr=$_REQUEST['idr'];
}
$iddian=$_REQUEST['iddian'];
if ($iddian==""){
	$iddian=$_REQUEST['iddian'];
}
$idanio=$_REQUEST['idanio'];
if ($idanio==""){
	$idanio=$_REQUEST['idanio'];
}


if ($_REQUEST['inn']==1){
	$dshoras=$_REQUEST['dshoras'];
	$dsdias=$_REQUEST['dsdias'];	
	$dsfecha=date("d-m-Y h:i:s");
	$idmedico=$_REQUEST['idmedico'];	
	
	$strSQL=" select id from ".$tabla." where idrutero=$idr";
	$strSQL.=" and idmedico=".$idmedico;
	$vermas=mysql_db_query($dbase,$strSQL,$db);
	$num=mysql_num_rows($vermas);
	if ($num==1){
		$Mensaje="No se ha asociado el médico seleccionado al rutero porque ya esta en el sistema.";			
		$val=1;
	} else {
		$strSQL="insert into ".$tabla;
		$strSQL.="  values (";
		$strSQL.=" '',$idr,$idmedico,'$dsdias','$dshoras','$dsfecha'";
		$strSQL.=" )";
		//echo $strSQL;
		//exit();
		@mysql_db_query($dbase,$strSQL,$db);
		$Mensaje="Se ha asociado el médico seleccionado al rutero con éxito.";			
	}
	@mysql_free_result($vermas);

	} // fin inn

// validaciones de datos
	$mensajeData="Ingresando médico a rutero seleccionado";
?>
<html>
<head>

	<title><? echo $AppNombre;?> Configuraciones: Selección de médico para el rutero</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.dsdias.value==""){
			alert("<? echo $AppNombre;?>: Por favor ingrese los días de visita de la semana.");
			document.u.dsdias.focus();
			return;
     }

	if (document.u.dshoras.value==""){
			alert("<? echo $AppNombre;?>: Por favor ingrese las horas de visita de la semana.");
			document.u.dshoras.focus();
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
			Ingrese los dias de visita de la semana
		</td>
		<td valign=top>
			<textarea name=dsdias cols="40" rows="3" class="text1"><? echo $dsdias;?></textarea>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Ingrese las horas de visita de la semana
		</td>
		<td valign=top>
			<textarea name=dshoras cols="40" rows="3" class="text1"><? echo $dshoras;?></textarea>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Seleccione Médico:
		</td>
		<td valign=top>
			<select name="idmedico" class="text1">
			<? combosmedicos($idmedico,$_SESSION['i_idusuario'],1);?>
			</select>
		</td>
		</tr>
	
		
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Cerrar" class=formabot onClick="CargarPagina('detalleruteromedico.php?idr=<? echo $idr;?>&iddian=<? echo $iddian;?>&idsemana=<? echo $idsemana;?>&idanio=<? echo $idanio;?>');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=iddian value="<? echo $iddian;?>">
			<input type=hidden name=idsemana value="<? echo $idsemana;?>">
			<input type=hidden name=idanio value="<? echo $idanio;?>">
			<input type=hidden name=idr value="<? echo $idr;?>">
			</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
