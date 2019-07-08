<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
Ingreso de cada fila de datos uno a uno
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
$tabla="tblproductosxsubcategorias";
if ($_REQUEST['inn']==1){
	// variables de carga
	$dsm=$_REQUEST['dsm'];
	$idactivo=$_REQUEST['idactivo'];
	$idcategoria=$_REQUEST['idcategoria'];
	$nombre1=$_FILES['dsarchivo1']['name'];


	if ($_FILES['dsarchivo1']['name']<>"") {
				// borrar anterior
				//$archivoanterior=$_REQUEST['archivoanterior'];
				//@unlink($rutaImagen.$archivoanterior1);
				$rutaImagen="../../temas/productos/";
				$temp_name = $_FILES['dsarchivo1']['tmp_name'];
				$nombre1=$_FILES['dsarchivo1']['name'];
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
			}


	// fin variables de carga
	$sql="select id from $tabla where dsm='$dsm' and idcategoria=$idcategoria";

	$ver=mysql_db_query($dbase,$sql,$db);
	if(mysql_num_rows($ver)>0){
	$val=3;
	}else{
	$sql=" insert into $tabla(dsm,idactivo,idempresa,idcategoria,dsfoto) values('$dsm','$idactivo',".$_SESSION['i_idempresa'].",$idcategoria,'$nombre1')";
	echo $sql;
	if(mysql_db_query($dbase,$sql,$db))$val=2;
	}
}

// validaciones de datos

// Mensajes de resultado
if ($val==1) {
	// no iongresa
		$Mensaje="No se pudo ingresar "."(".$dsm.")"." porque es posible que ya se encuentre registrado. Intente de nuevo";
} elseif ($val==2) {
	// ingresa
		$Mensaje="El dato "."(".$dsm.") ha sido ingresado con éxito";
} elseif ($val==3) {
	// ingresa
		$Mensaje="El dato "."(".$dsm.") ya existe en el sistema";
}
?>
<html>
<head>
	<title><? echo $AppNombre;?> Configuraciones: Ingreso</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ("../../incluidos/javageneral.php"); ?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.dsm.value==""){
			alert("Debe ingresar el nombre");
			document.u.dsm.focus();
			return;
     }

	if (document.u.idactivo.value==""){
			alert("Debe seleccionar el estado");
			document.u.idactivo.focus();
			return;
     }
     if (document.u.dsarchivo1.value==""){
			alert("Debe seleccionar foto");
			document.u.idactivo.focus();
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
		<table width=50% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=textnegro2 colspan=2>
			<h2><strong>Tipos  de sub categorias</strong></h2><br>
		</td>
		</tr>
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=textnegro2 colspan=2>
			<p>Para Ingresar los datos, es necesario llenar las casillas que se encuetran a continuación.
			TODAS LAS CASILLAS CON OBLIGATORIAS</p><br>
		</td>
		</tr>

		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2 >
			 &nbsp;
			 Nombre
		</td>
		<td valign=top>
			<input type=text name="dsm" class=textnegro2 value="<? echo $_REQUEST['dsm'];?>">
		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			 &nbsp;
			 Activar
		</td>
		<td valign=top>
			<select name="idactivo" class=textnegro2>
						<option value="1" <? if ($_REQUEST['campo3']==1){ echo "selected";}?>>SI</option>
						<option value="2" <? if ($_REQUEST['campo3']==2){ echo "selected";}?>>NO</option>
				</select>
			<td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			 &nbsp;
			 Categoria asociada
		</td>
		<td valign=top>
			<select name="idcategoria" class=textnegro2>
						<? combosproductosxcategorias($idcategoria,$_SESSION['i_idempresa']);?>

				</select>
			<td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
			<td valign=top class=textnegro2>
				 &nbsp;
				 Agregar foto
			</td>

			<td valign=top>
				<input type="file"  name="dsarchivo1">
			</td>
		</tr>


		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Regresar" class=formabot onClick="irAPaginaD('productos.subcategorias.php');">
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
