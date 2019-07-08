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
 Ingresar zonas al sistema.
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
$rutaImagen="../../temas/productos/";

if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // nombre
	$campo2=$_REQUEST['campo2']; // activo

	// fin variables de carga
}
// validaciones de datos
if ($dir==1){
	$mensajeData="Ingresando producto o servicio";
	// armando vector de campos
	$camposN[0]="Nombre";
	$camposN[2]="Activo?";

	if ($_REQUEST['inn']==1){
		$strSQL=" select dsz from ".$tabla." where dsz='$campo0' and idempresa=".$_SESSION['i_idempresa'];
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		$num=mysql_num_rows($vermas);
		if ($num>=1){
			$val=1;
		} else {
			$strSQL="insert into ".$tabla." (idempresa,dsz,idactivo)";
			$strSQL.="  values (";
			//$strSQL.=" '',".$_SESSION['i_idempresa'].",$campo3,'$campo0','$campo1',";
			$strSQL.=" ".$_SESSION['i_idempresa'].",'$campo0'";

			$strSQL.=",$campo2";
			$strSQL.=" )";
			if (mysql_db_query($dbase,$strSQL,$db)) {
				$val=2;
				$strSQL=" select idz from ".$tabla." where dsz='$campo0' and idempresa=".$_SESSION['i_idempresa'];
				$vermasx=mysql_db_query($dbase,$strSQL,$db);
				if (mysql_num_rows($vermasx)>0) {
					$idcampo=mysql_result($vermasx,"0","idz");
					?>
					<script language="javascript">
					<!--
					location.href="mod.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $idcampo;?>";
					//-->
					</script>
					<?
				}
				mysql_free_result($vermasx);
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

	<title><? echo $AppNombre;?> Configuraciones: Ingreso de producto o servicio</title>
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
<body color=#ffffff  topmargin=0 leftmargin=1 onLoad="javascript:document.u.campo0.focus();">
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
			<input type="text" name="campo0" class=textnegro2 value="<? echo $_REQUEST['campo0'];?>" size=80 maxlength="255">
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[2];?>
		</td>
		<td valign=top>
			<select name="campo2" class=textnegro2>
			<option value="1" <? if ($fila->$campo3=="1"){ echo "SELECTED";}?>>SI</option>
				<option value="2" <? if ($fila->$campo3=="2"){ echo "SELECTED";}?>>NO</option>
				<option value="4" <? if ($fila->$campo3=="4"){ echo "SELECTED";}?>>DESTACADO HOME</option>
				<option value="5" <? if ($fila->$campo3=="5"){ echo "SELECTED";}?>>DESTACADO CENTRAL</option>
				<option value="6" <? if ($fila->$campo3=="6"){ echo "SELECTED";}?>>DESTACADO CARRUSEL</option>

			</select>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Regresar" class=formabot onClick="irAPaginaD('default.php');">
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
