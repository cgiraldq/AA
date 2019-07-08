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
 Modificando roles
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

$r=$_REQUEST['r'];
if ($r==""){
	$r=$_REQUEST['r'];
}
$idcampo=$_REQUEST['idcampo'];
if ($idcampo==""){
	$idcampo=$_REQUEST['idcampo'];
}

$dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_REQUEST['dsnombre'];
}
$rutaImagen="../../temas/productos/";


if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // nombre
	$campo1=$_REQUEST['campo1']; // desc
	$campo2=$_REQUEST['campo2']; // activo / desactivo
	$campo3=$_REQUEST['campo3']; // desc 2
	$campo6=$_REQUEST['campo6']; // terminos y condiciones

	$archivoanterior=$_REQUEST['archivoanterior'];
	$archivoanterior2=$_REQUEST['archivoanterior2'];


			if ($_FILES['dsarchivo1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior'];
				@unlink($rutaImagen.$archivoanterior1);
				$temp_name = $_FILES['dsarchivo1']['tmp_name'];
				$nombre1=$_FILES['dsarchivo1']['name'];
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
			} else {
				$nombre1=$archivoanterior;
			}

			if ($_REQUEST['elim1']==1){
				@unlink($rutaImagen.$archivoanterior1);
				$nombre1="";
			}


			if ($_FILES['dsarchivo2']['name']<>"") {
				// borrar anterior
				$archivoanterior2=$_REQUEST['archivoanterior2'];
				@unlink($rutaImagen.$archivoanterior2);
				$temp_name = $_FILES['dsarchivo2']['tmp_name'];
				$nombre2=$_FILES['dsarchivo2']['name'];
				move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			} else {
				$nombre2=$archivoanterior2;
			}

			if ($_REQUEST['elim2']==1){
				@unlink($rutaImagen.$archivoanterior2);
				$nombre2="";
			}

	// fin variables de carga
}

// validaciones de datos
	$mensajeData="Editando Actividad selecccionada";
	// armando vector de campos
	$camposN[0]="Nombre";
	$camposN[1]="Descripción";
	$camposN[2]="Activo?";
	$camposN[4]="Cargar imagen pequeña";
	$camposN[5]="Cargar imagen grande";


	// insertando
	if ($_REQUEST['inn']==1){
	// actualizando

			$strSQL="update ".$tabla;
			$strSQL.="  set ";
			$strSQL.=" dsz='$campo0',dso='$campo1'";
			$strSQL.=",dsarchivo1='$nombre1',dsarchivo2='$nombre2'";

			$strSQL.=" ,idactivo=$campo2";
			$strSQL.=" where idz=".$idcampo;
			//echo $strSQL;
			@mysql_db_query($dbase,$strSQL,$db);
			// adicional.
			$val=1;
	}
// Mensajes de resultado
if ($val==1) {
	// no iongresa
	$Mensaje=" Datos modificados en el sistema para  (".$campo0."). Presione 'Cerrar', para recargar los datos  ";
}
// cargando datos
$sql="select * from $tabla where idz=".$idcampo;
$vermas=mysql_db_query($dbase,$sql,$db);
$fila=mysql_fetch_object($vermas);
$campov0=$fila->dsz;
$campov1=$fila->dso;

$campov2=$fila->idactivo;
$campov3=$fila->dso2;
$archivoanterior=$fila->dsarchivo1;
$archivoanterior2=$fila->dsarchivo2;



mysql_free_result($vermas);
?>
<html>
<head>
<title><? echo $AppNombre;?> Configuraciones: <? echo $mensajeData?></title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
    function valI(){
	if (document.u.campo0.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[0];?>");
			document.u.campo0.focus();
			return;
     }

	if (document.u.campo1.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[1];?>");
			document.u.campo1.focus();
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
		<table width=70% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=textnegro2 colspan=2>
			<strong>Todos los datos son obligatorios</strong><br>
		</td>
		</tr>

		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
	<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[0];?>
		</td>
		<td valign=top>
			<input type="text" name="campo0" class=textnegro2 value="<? echo $campov0;?>" size=80 maxlength="255">

		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[1];?>
		</td>
		<td valign=top>
		<textarea name="campo1" class=textnegro2 cols="80" rows="15"><? echo $campov1;?></textarea>
		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[2];?>
		</td>
		<td valign=top>
			<select name="campo2" class=textnegro2>
			<option value="1" <? if ($campov2=="1"){ echo "SELECTED";}?>>SI</option>
			<option value="2" <? if ($campov2=="2"){ echo "SELECTED";}?>>NO</option>

			</select>

		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>" class=textnegro2>
		<td valign=top >
			<strong><? echo $camposN[4];?></strong>
		</td>
		<td valign=top>
			<input type="file" name="dsarchivo1" class="text1">
			<input type="hidden" name="archivoanterior" value="<? echo $archivoanterior?>">
		<? if (is_file($rutaImagen.$archivoanterior)){?>
		<a href="<? echo $rutaImagen.$archivoanterior?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior?>" border=0 width=50 heigth=50></a>
			<input type="checkbox" name="elim1" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>" class=textnegro2>
		<td valign=top >
			<strong><? echo $camposN[5];?></strong>
		</td>
		<td valign=top>
			<input type="file" name="dsarchivo2" class="text1">
			<input type="hidden" name="archivoanterior2" value="<? echo $archivoanterior2?>">
		<? if (is_file($rutaImagen.$archivoanterior2)){?>
		<a href="<? echo $rutaImagen.$archivoanterior2?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior2?>" border=0 width=150 heigth=150></a>
			<input type="checkbox" name="elim2" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Modificar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Regresar" class=formabot onClick="irAPaginaD('productos.actividades.php');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=idcampo value="<? echo $idcampo;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			</td>
		</tr>
		</form>

	</table>
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>
