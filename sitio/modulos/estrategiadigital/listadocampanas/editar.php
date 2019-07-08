<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// edicion de datos
$rutx=1;

$injection="no";
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de campa&ntilde;as en estrategias digitales";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblestrategias_campanas";


$rutaImagen="../../../../contenidos/images/banners/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/banners/";
$rutaPlayer="../"; // uso desde el admon

			 $nombre="dsimg1";
             $nombreant="archivoanterior1";
             $borrar=$_REQUEST['borrar1'];
             $valimg=$_REQUEST['img1'];
             include("../../../incluidos_modulos/modulos.cargar.imagen.php");


			$dsm=$_REQUEST['dsm'];
			$dsruta=$_REQUEST['dsruta'];
			$dsflash=$_REQUEST['dsflash'];
			$dsancho=$_REQUEST['dsancho'];
			$dsalto=$_REQUEST['dsalto'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idtipo=$_REQUEST['idtipo'];
			$dsmodo=$_REQUEST['dsmodo'];
			$dsd=$_REQUEST['dsd'];
			$paso=$_REQUEST['paso'];
			$dsfechai=$_REQUEST['dsfechai'];
			$idusuariox=$_REQUEST['idusuariox'];

			if ($dsfechai<>"") $idfechai=str_replace("/","",$dsfechai);
			$dsfechaf=$_REQUEST['dsfechaf'];
			if ($dsfechaf<>"") $idfechaf=str_replace("/","",$dsfechaf);

			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsruta='$dsruta'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsancho='$dsancho'";
					$sql.=",dsalto='$dsalto'";
					$sql.=",idtipo=$idtipo";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsflash='$dsflash'";
					$sql.=",idpos='$idpos'";
					$sql.=",idactivo=$idactivo";
					$sql.=",dsfechai='$dsfechai'";
					$sql.=",idfechai='$idfechai'";

					$sql.=",dsfechaf='$dsfechaf'";
					$sql.=",idfechaf='$idfechaf'";


					$sql.=",dsmodo='$dsmodo'";
					$sql.=",idusuario='$idusuariox'";

					$sql.=" where id=".$idx;

					 //echo $sql;
					 //exit();

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de banner";
						$dsruta="../estrategiasdigitales/campanas/default.php";
						include("../../../incluidos_modulos/logs.php");
						$error=0;
					}	else {
						$mensajes=$men[7];
						$error=1;

					}
			}



?>
<html>
	<?include("../../../incluidos_modulos/head.php");?>
<body >

	<? include("../../../incluidos_modulos/navegador.principal.php");?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsimg,a.dsruta,a.dsalto,a.dsancho,a.dsflash,a.idtipo,a.dsmodo,a.dsd";
$sql.=",a.dsfechai,a.dsfechaf,a.idusuario ";

$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsimg1=$result->fields[3];
$dsruta=$result->fields[4];
$dsalto=$result->fields[5];
$dsancho=$result->fields[6];
$dsflash=$result->fields[7];
$idtipo=$result->fields[8];
$dsmodo=$result->fields[9];
$dsd=$result->fields[10];
$dsfechai=$result->fields[11];
$dsfechaf=$result->fields[12];
$idusuariox=$result->fields[13];

?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1>Edicion del registro seleccionado</h1>
         	</td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="idpos";
	include("../../../incluidos_modulos/botones.modificar.php");?>
	<input type=button name=enviar value="Configurar"  class="botones" onClick="irAPaginaD('<? echo $rutxx;?>../core/core.redir.php?rutaredir=core.mailing&rutacore=http://www.comprandofacil.com/pide/corehome/')">

	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

<tr valign=top>
	<td class="txt"><p>Nombre</p></td>

	<td>
		<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";$cantidad=strlen($dsm)?>
		<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el titulo";
		include("../../../incluidos_modulos/control.capa.php");
		include("../../../incluidos_modulos/control.letras.php");?>

	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Fecha Inicial</p></td>

	<td>
	<? $contadorx="dsfechai_counter";$valorx="10";$formax="u";$campox="dsfechai";$cantidad=strlen($dsfechai)?>
	<input type=text name=dsfechai size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechai')" readonly  value="<? echo $dsfechai?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
	<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai', this);" language="javaScript">
	<?
	$nombre_capa="capa_dsfechai";
	$mensaje_capa="Debe ingresar la fecha inicial";
	include("../../../incluidos_modulos/control.capa.php");
	include("../../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Fecha Final</p></td>

	<td>
	<? $contadorx="dsfechaf_counter";$valorx="10";$formax="u";$campox="dsfechaf";$cantidad=strlen($dsfechaf)?>
	<input type=text name=dsfechaf size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechaf')" readonly  value="<? echo $dsfechaf?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
	<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf', this);" language="javaScript">
	<?
	$nombre_capa="capa_dsfechaf";
	$mensaje_capa="Debe ingresar la fecha final";
	include("../../../incluidos_modulos/control.capa.php");
	include("../../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Tipo?</p></td>
	<td>
		<select name=idtipo class=text1>
    <option value="1" <? if ($idtipo==1) echo "selected";?>>Mailing</option>
    <option value="2" <? if ($idtipo==2) echo "selected";?>>Landingpage</option>
    <option value="3" <? if ($idtipo==3) echo "selected";?>>Publicidad redes sociales</option>
		</select>
	</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Descripci&oacute;n general de la campa&ntilde;a</p></td>
	<td>
	<? $contadorx="dsd_counter";$valorx="255";$campox="dsd";?>
	<textarea name=dsd  cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dsd')" <? include("../../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
	<?
	$nombre_capa="capa_dsd";
	$mensaje_capa="Debe ingresar la descripci&oacute;n";
	include("../../../incluidos_modulos/control.capa.php");
	include("../../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td><p>Activar?</p></td>
<td>
	<select name=idactivo class=text1>
    <option value="1" <? if ($idactivo==1) echo "selected";?>>En proceso</option>
    <option value="2" <? if ($idactivo==2) echo "selected";?>>Inactiva</option>
    <option value="3" <? if ($idactivo==3) echo "selected";?>>Finalizada</option>

	</select><br>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td><p>Usuario Responsable</p></td>
<td>
	<select name=idusuariox class=text1>
    <option value="" <? if ($idusuariox=="") echo "selected";?>>----</option>
    <? lista_marcas("tblusuarios",$idusuariox,"");?>

	</select><br>
	</td>
</tr>

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsd";
	include("../../../incluidos_modulos/botones.modificar.php");?>
	<input type=button name=enviar value="Configurar"  class="botones" onClick="irAPaginaD('configurar.php?idx=<? echo $idx?>')">

	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

</form>

</table>
</td>
</tr>
</table>

<? 
} // fin si
$result->Close();
?>

	<?
	include("../../../incluidos_modulos/navegador.principal.cerrar.php");
	include("../../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>