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


$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;
$titulomodulo="Edicion de galeria";
$titulopremodulo = $_REQUEST['titulomodulo']; 

$rutaImagen="../../../../contenidos/temas/productos/";

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
$idcampox=$_REQUEST['idcampox'];


$dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_REQUEST['dsnombre'];
}


if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // nombre
	$campo1=$_REQUEST['campo1']; // desc
	$campo2=$_REQUEST['campo2']; // activo / desactivo
	$campo3=$_REQUEST['campo3']; // desc 2
	$campo6=$_REQUEST['campo6']; // terminos y condiciones
	
	$archivoanterior=$_REQUEST['archivoanterior'];
	$archivoanterior2=$_REQUEST['archivoanterior2'];
	$archivoanterior3=$_REQUEST['archivoanterior3'];
	$idpos = $_REQUEST['idpos'];

			$nombre="dsarchivo1";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['elim1'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsarchivo2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['elim2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsarchivo3";
			$nombreant="archivoanterior3";
			$borrar=$_REQUEST['elim3'];
			$valimg=$_REQUEST['img3'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
	// actualizando

			$campo2=$_REQUEST['campo2'];
			$strSQL="update ".$tabla;
			$strSQL.="  set ";
			$strSQL.=" dsz='$campo0',dso='$campo1'";

			if($imgvec[0]<>"") $strSQL.=",dsarchivo1='".$imgvec[0]."'";
			if($imgvec[1]<>"") $strSQL.=",dsarchivo2='".$imgvec[1]."'";
			if($imgvec[2]<>"") $strSQL.=",dsarchivo3='".$imgvec[2]."'";

			$strSQL.=" ,idactivo=$campo2";
			$strSQL.=" ,idpos=$idpos";
			$strSQL.=" where idz=".$idcampox;
			//echo $strSQL;
			if($db->Execute($strSQL)){
			// adicional. 
			$val=1;
			

	// fin variables de carga
}

// validaciones de datos
	$mensajeData="Editando galeria seleccionada";
	// armando vector de campos
	$camposN[0]="Nombre";
	$camposN[1]="Descripción";
	$camposN[2]="Activo?";
	$camposN[4]="Cargar imagen pequeña";
	$camposN[5]="Cargar imagen grande";
	$camposN[6]="Cargar imagen destacada";
	}	
// Mensajes de resultado
if ($val==1) { 
	// no iongresa
	$Mensaje=" Datos modificados en el sistema para  (".$campo0.").";
}
// cargando datos
$idcampox=$_REQUEST['idcampox'];
$sql="select * from tblproductosxgalerias where idz=".$idcampox;
//echo $sql;
$vermas=$db->Execute($sql);
//$fila=mysql_fetch_object($vermas);
$campov0=$vermas->fields['dsz'];
$campov1=$vermas->fields['dso'];

$campov2=$vermas->fields['idactivo'];
$campov3=$vermas->fields['dso2'];
$archivoanterior=$vermas->fields['dsarchivo1'];
$archivoanterior2=$vermas->fields['dsarchivo2'];
$archivoanterior3=$vermas->fields['dsarchivo3'];
$idpos=$vermas->fields['idpos'];


$vermas->Close();
?>
<html>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
    function valI(){
	/*if (document.u.campo0.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[0];?>");
			document.u.campo0.focus();
			return;
     }*/

	/*if (document.u.campo1.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[1];?>");
			document.u.campo1.focus();
			return;
     }*/

	     document.u.submit();
	  }
//-->
</SCRIPT>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
		 include($rutxx."../../incluidos_modulos/navegador.principal.php");
		 include($rutxx."../../incluidos_modulos/core.mensajes.php");
		 // modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		$bannersx=1;
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");

		$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <a href='galeria.php?tabla=crm_productos_y_servicios&dir=1&idcampo=$idcampox' class='textlink' ><span class='text1'>".$titulopremodulo."</span></a> / ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=0;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


  ?>

<? include($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>	
<br />
		<table width=70% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=text1 colspan=2>
			<strong>Todos los datos son obligatorios</strong><br>
		</td>
		</tr>
		
		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
	<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			Titulo
		</td>
		<td valign=top>
			<input type="text" name="campo0" class=text1 value="<? echo $campov0;?>" size=80 maxlength="255">
		</td>
		</tr>

			<? /* ?>
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			<? echo $camposN[1];?>
		</td>
		<td valign=top>
		<textarea name="campo1" class=text1 cols="80" rows="15"><? echo $campov1;?></textarea>
		</td>
		</tr>

		<? */ ?>
		
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			Activar ?
		</td>
		<td valign=top>
			<select name="campo2" class=text1>
			<option value="1" <? if ($campov2=="1"){ echo "SELECTED";}?>>SI</option>
			<option value="2" <? if ($campov2=="2"){ echo "SELECTED";}?>>NO</option>
			<option value="3" <? if ($campov2=="3"){ echo "SELECTED";}?>>Destacada</option>
			<option value="4" <? if ($campov2=="4"){ echo "SELECTED";}?>>Detalle</option>

			</select> 
			
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			Posicion 
		</td>
		<td valign=top>
			<input type="text" name="idpos" class=text1 value="<? echo $idpos;?>" size="2" maxlength="255">
		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>" class=text1>
		<td valign=top >
			<strong>Imagen</strong>
		</td>
		<td valign=top>

			<input type="file" name="dsarchivo1" class="text1" >

			<input type="hidden" name="archivoanterior" value="<? echo $archivoanterior?>">	
		<? if (is_file($rutaImagen.$archivoanterior)){?>
		<a href="<? echo $rutaImagen.$archivoanterior?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior?>" border=0 width=80 heigth=80></a>
			<input type="checkbox" name="elim1" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>" class=text1>
		<td valign=top >
			<strong>Imagen</strong>
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

		<tr bgcolor="<? echo $fondos[4];?>" class=text1>
		<td valign=top >
			<strong>Imagen</strong>
		</td>
		<td valign=top>
			<input type="file" name="dsarchivo3" class="text1" >
			<input type="hidden" name="archivoanterior3" value="<? echo $archivoanterior3?>">	
		<? if (is_file($rutaImagen.$archivoanterior3)){?>
		<a href="<? echo $rutaImagen.$archivoanterior3?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior3?>" border=0 width=250 heigth=250></a>
			<input type="checkbox" name="elim3" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>
		
		
		<tr align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Modificar" class=botones onClick="valI();">
			<input type=button name=enviar value="Regresar" class=botones onClick="irAPaginaD('galeria.php?tabla=crm_productos_y_servicios&dir=1&idcampo=<? echo $vermas->fields['idproducto']; ?>');">
																								
			<input type="hidden" name="inn" value="1">
			<input type="hidden" name="tabla" value="<? echo $tabla;?>">
			<input type="hidden" name="idcampo" value="<? echo $idcampo;?>">
			<input type="hidden" name="idcampox" value="<? echo $idcampox;?>">
			
			<input type="hidden" name="dir" value="<? echo $dir;?>">
			</td>
		</tr>
		</form>
		
	</table>
<? 	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>

