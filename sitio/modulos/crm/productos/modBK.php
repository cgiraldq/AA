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
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario

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

	$campo7=$_REQUEST['campo7']; // cupos
	$campo8=$_REQUEST['campo8']; // minimos de cupos petmanente
	$dsvideo=$_REQUEST['dsvideo']; // minimos de cupos petmanente
	$subtitulo=$_REQUEST['subtitulo']; // minimos de cupos petmanente


	$archivoanterior=$_REQUEST['archivoanterior'];
	$archivoanterior2=$_REQUEST['archivoanterior2'];


	$dsitin=$_REQUEST['dsitin']; //
	$dstips=$_REQUEST['dstips']; //
	$dskey=$_REQUEST['dskey']; //
		$dsservicio=$_REQUEST['dsservicio']; //


	$dsfechai=$_REQUEST['dsfechai']; //
	if ($dsfechai<>"") $idfechai=str_replace("/","",$dsfechai);
	$dsfechaf=$_REQUEST['dsfechaf']; //
	if ($dsfechaf<>"") $idfechaf=str_replace("/","",$dsfechaf);



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
	$mensajeData="Editando producto o servicio";
	// armando vector de campos
	$camposN[0]="Titulo";
	$camposN[1]="Descripción";
	$camposN[2]="Activo?";
	$camposN[3]="El plan incluye";
	$camposN[4]="Cargar imagen peque&ntilde;a";
	$camposN[5]="Cargar imagen grande";
	$camposN[6]="Terminos y condiciones";

	$camposN[7]="Cupos asignados";
	$camposN[8]="Cupos minimos permanentes";
	$camposN[9]="Subir video Youtube";
	$camposN[10]="Subtitulo";

	// insertando
	if ($_REQUEST['inn']==1){
	// actualizando

			$strSQL="update ".$tabla;
			$strSQL.="  set ";
			$strSQL.=" dsz='$campo0',dso='$campo1',dso2='$campo3',dso3='$campo6',dsvideo='$dsvideo'";
			$strSQL.=",dsarchivo1='$nombre1',dsarchivo2='$nombre2'";

			$strSQL.=" ,idactivo=$campo2";
			$strSQL.=" ,dscupo='$dscupo'";
			$strSQL.=" ,dsmincupo='$dsmincupo'";
			$strSQL.=" ,dsitin='$dsitin'";
			$strSQL.=" ,dstips='$dstips'";
			$strSQL.=" ,dskey='$dskey'";
			$strSQL.=" ,dsservicio='$dsservicio'";
			$strSQL.=" ,dsfechai='$dsfechai'";
			$strSQL.=" ,dsfechaf='$dsfechaf'";
			$strSQL.=" ,idfechai='$idfechai'";
			$strSQL.=" ,idfechaf='$idfechaf'";
			$strSQL.=" ,dsz2='$subtitulo'";


			$strSQL.=" where idz=".$idcampo;
			//echo $strSQL;
			mysql_db_query($dbase,$strSQL,$db);
			echo mysql_error();
			// adicional.
			$val=1;
	}
// Mensajes de resultado
if ($val==1) {
	// no iongresa
	$Mensaje=" Datos modificados en el sistema para  (".$campo0."). Presione 'Cerrar', para recargar los datos  ";
}
// cargando datos
$sql="select * from tblproductos where idz=".$idcampo;
//echo $sql;
$vermas=mysql_db_query($dbase,$sql,$db);
$fila=mysql_fetch_object($vermas);
$campov0=$fila->dsz;
$campov1=$fila->dso;

$campov2=$fila->idactivo;
$campov3=$fila->dso2;
$campov6=$fila->dso3;

$campov7=$fila->dscupo;
$campov8=$fila->dsmincupo;

$dsitin=$fila->dsitin;
$dstips=$fila->dstips;
$dskey=$fila->dskey;
$dsservicio=$fila->dsservicio;


$dsfechai=$fila->dsfechai;
$dsfechaf=$fila->dsfechaf;



$archivoanterior=$fila->dsarchivo1;
$archivoanterior2=$fila->dsarchivo2;
$dsvideo=$fila->dsvideo;

$subtitulo=$fila->dsz2;



mysql_free_result($vermas);
?>
<html>
<head>
<title><? echo $AppNombre;?> Configuraciones: Modificación de producto o servicio</title>
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
				<? echo $camposN[10];?>
			</td>
		<td valign=top>
			<input type="text" name="subtitulo" class=textnegro2 value="<? echo $subtitulo;?>" size=80 maxlength="255">

		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[1];?>
		</td>
		<td valign=top>
		<textarea name="campo1" class=textnegro2 cols="120" rows="15"><? echo $campov1;?></textarea>
		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[3];?>
		</td>
		<td valign=top>
			<textarea name="campo3" class=textnegro2 cols="120" rows="15"><? echo $campov3;?></textarea>
		</td>
		</tr>



		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[6];?>
		</td>
		<td valign=top>
			<textarea name="campo6" class=textnegro2 cols="120" rows="15"><? echo $campov6;?></textarea>
		</td>
		</tr>




		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Itinerario
		</td>
		<td valign=top>
			<textarea name="dsitin" class=textnegro2 cols="120" rows="15"><? echo $dsitin;?></textarea>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Tips de viaje
		</td>
		<td valign=top>
			<textarea name="dstips" class=textnegro2 cols="120" rows="15"><? echo $dstips;?></textarea>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Palabras claves (keywords)
		</td>
		<td valign=top>
			<textarea name="dskey" class=textnegro2 cols="120" rows="15"><? echo $dskey;?></textarea>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">



		<td valign=top class=textnegro2>
			Tipo de servicio
		</td>
		<td valign=top>

			<select name="dsservicio" class=textnegro2>
			<?

				$sqlx="select id,dsm  from tblservicios where idactivo not in(2) ORDER BY dsm ASC";
				//echo $sqlx;
				$vermas2=mysql_db_query($dbase,$sqlx,$db);
				//$fila2=mysql_fetch_object($vermas2);

				if (mysql_affected_rows()>0){
					while($fila2=mysql_fetch_object($vermas2)) {
						$id=$fila2->id;
						$dsm=$fila2->dsm;
					ob_start();


			?>
			<option value="<? echo $id;?>" <? if($dsservicio==$id) echo "selected";?>  > <? echo $dsm;?> </option>
			<?
				ob_end_flush();
			}

		}
		mysql_free_result($vermas2);
			?>
			</select>

		</td>
		</tr>



		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[2];?>
		</td>

		<td valign=top>
			<select name="campo2" class=textnegro2>
			<option value="1" <? if ($fila->$idactivo=="1"){ echo "SELECTED";}?>>SI</option>
				<option value="2" <? if ($campov2=="2"){ echo "SELECTED";}?>>NO</option>


				<option value="6" <? if ($campov2=="6"){ echo "SELECTED";}?>>DESTACADO CARRUSEL</option>
				<option value="8" <? if ($campov2=="8"){ echo "SELECTED";}?>>OFERTA</option>
				<option value="7" <? if ($campov2=="7"){ echo "SELECTED";}?>>RECOMENDADO</option>
			</select>

		</td>
		</tr>


	<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[7];?>
		</td>
		<td valign=top>
			<input type="text" name="campo7" class=textnegro2 value="<? echo $campov7;?>" size=9 maxlength="9">

		</td>
		</tr>

<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[8];?>
		</td>
		<td valign=top>
			<input type="text" name="campo8" class=textnegro2 value="<? echo $campov8;?>" size=9 maxlength="9">

		</td>
		</tr>


<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Fecha inicial de publicacion
		</td>
		<td valign=top>
<input type="text" name="dsfechai" value="<? echo $dsfechai?>" size=10  maxlenght="10">
<img align="absmiddle" SRC="../../temas/iconos/fechas.gif" ALT="Calendario" name="imgFecha"
ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai', this);" language="javaScript">

		</td>
		</tr>


<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			Fecha final de publicacion
		</td>
		<td valign=top>
<input type="text" name="dsfechaf" value="<? echo $dsfechaf?>" size=10  maxlenght="10">
<img align="absmiddle" SRC="../../temas/iconos/fechas.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf', this);" language="javaScript">

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
		<a href="<? echo $rutaImagen.$archivoanterior?>" target="_blank">Descargar Archivo</a>
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
		<a href="<? echo $rutaImagen.$archivoanterior2?>" target="_blank">Descargar Archivo</a>
			<input type="checkbox" name="elim2" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textnegro2>
			<? echo $camposN[9];?>
		</td>
		<td valign=top>
		<textarea name="dsvideo" class=textnegro2 cols="120" rows="8"><? echo $dsvideo;?></textarea>
		</td>
		</tr>



		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Modificar" class=formabot onClick="valI();">
			<input type=button name=enviar value="Regresar" class=formabot onClick="irAPaginaD('default.php');">
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
