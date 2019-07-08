<?
/*
| ----------------------------------------------------------------- |
WebCenter Version 2.0
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
*/
include ("../validaciones/sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla=$_REQUEST['tabla'];
if ($tabla==""){
	$tabla=$_REQUEST['tabla'];
}
$dir=$_REQUEST['dir'];
if ($dir==""){
	$dir=$_REQUEST['dir'];
}
$idcampo=$_REQUEST['idcampo'];

if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // descripcion
	$campo3=$_REQUEST['campo3']; // valor

	$campo2=$_REQUEST['campo2']; // activo


	// fin variables de carga
}
// validaciones de datos
if ($dir==1){
	$mensajeData="Ingresando precio de producto seleccionado";
	// armando vector de campos
	$camposN[0]="Descripcion";

	$camposN[2]="Activo?";
	$camposN[3]="Valor";
	
	if ($_REQUEST['inn']==1){
		$strSQL=" select dsm from ".$tabla." where dsm='$campo0' and idproducto=".$_REQUEST['idcampo'];
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		$num=mysql_num_rows($vermas);
		if ($num>=1){
			$val=1;
		} else {
			$strSQL="insert into ".$tabla." (idempresa,dsm,idactivo,dsd,idproducto)";
			$strSQL.="  values (";
			//$strSQL.=" '',".$_SESSION['i_idempresa'].",$campo3,'$campo0','$campo1',";
			$strSQL.=" ".$_SESSION['i_idempresa'].",'$campo0'";

			$strSQL.=",$campo2,'$campo3','$idcampo'";
			$strSQL.=" )";
			if (mysql_db_query($dbase,$strSQL,$db)) {
				$val=2;
			} else {
				echo mysql_error()."<br>".$strSQL;
			}

			
		}
		mysql_free_result($vermas);
	}	
}


// Mensajes de resultado
if ($val==1) { 
	// no iongresa
		$Mensaje="Los Datos no pueden ser ingresados en el sistema para (".$campo0."). Intente de nuevo";
} elseif ($val==2) { 
	// ingresa
		$Mensaje="Datos ingresados en el sistema para  (".$campo0."). Presione 'Cerrar', para recargar los datos ";
}
?>
<html>
<head>

	<title><? echo $AppNombre;?> Configuraciones: <? echo $mensajeData?></title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.campo0.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[0];?>");
			document.u.campo0.focus();
			return;
     }

	     document.u.submit();
	  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php"); ?>
		<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	

		<table width=100% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=textnegro2 colspan=2>
			<strong>Para Ingresar los datos, es necesario llenar las casillas que se encuetran a continuación. TODAS LAS CASILLAS CON OBLIGATORIAS</strong><br>
		</td>
		</tr>
		
		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[0];?>
		</td>
		<td valign=top>
		<textarea name="campo0" class=textnegro2 cols="80" rows="15"><? echo $campo0;?></textarea>
		</td>
		</tr>

	<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[3];?>
		</td>
		<td valign=top>
			<input type="text" name="campo3" class=textnegro2 value="<? echo $campo3;?>" size=80 maxlength="30">

		</td>
		</tr>



		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[2];?>
		</td>
		<td valign=top>
			<select name="campo2" class=textnegro2>
			<option value="1" <? if ($_REQUEST['campo2']=="1"){ echo "SELECTED";}?>>SI</option>
			<option value="2" <? if ($_REQUEST['campo2']=="2"){ echo "SELECTED";}?>>NO</option>
			</select> 
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Regresar" class=formabot onClick="irAPaginaD('precios.php?idcampo=<? echo $idcampo?>');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			<input type=hidden name=idcampo value="<? echo $idcampo;?>">

			</td>
		</tr>
		</form>
		
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
