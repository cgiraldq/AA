<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
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
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include ("../../incluidos_modulos/modulos.calendario.php");

$titulomodulo="Configuracion de eventos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblconvenios";
$rutaImagen="../../contenidos/images/eventos/";
// rutas repro
//$rutaRepro=$rutaAbs."/contenidos/images/qsomos/";
//$rutaPlayer="../"; // uso desde el admon
$carpeta="eventos";
//echo $carpetaBase;
$include="include('../../tienda/eventos_detalle.php')";


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			//$nombre="dsimg2";
			//$nombreant="archivoanterior2";
			//$borrar=$_REQUEST['borrar2'];
			//$valimg=$_REQUEST['img2'];
			//include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];
			$idpos=$_REQUEST['idpos'];
			//$idtipo=$_REQUEST['idtipo'];
			//$dsdevento=$_REQUEST['dsdevento'];
			$idactivo=$_REQUEST['idactivo'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsd2='$dsd2'";
					$sql.=",dsimg='".$imgvec[0]."'";
					//$sql.=",dsimg2='".$imgvec[1]."'";
					$sql.=",dsruta='$dsrutaPagina'";
					$sql.=",idpos=$idpos";
					//$sql.=",idtipo=$idtipo";
					//$sql.=",dsdevento='$dsdevento'";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					//exit;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../eventos/default.php";
						include("../../incluidos_modulos/logs.php");

						$sqld="select id,dsm from $tabla where id=".$idx;
						$resultd = $db->Execute($sqld);
						if (!$resultd->EOF) {
						$idr=$resultd->fields[0];
						$dsmr=$resultd->fields[1];
						}
						$dsarchivo=limpieza(strtolower($dsmr)).".php";
						$cuerpo='Eventos';
						$ruta=$cuerpo."/".$dsarchivo;
						$idreg=$idr;
						$rutax=1;
						$include="include('".$rutacomunes."/eventos_detalle.php')";
						//include("../../incluidos_modulos/modulos.constructor.php") ;
						$sqlu="update $tabla set dsruta='".$dsruta."' where id=$idreg";
						$resultu = $db->Execute($sqlu);
					}	else {
						$mensajes=$men[7];
					}
			}
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsd2,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsd2=$result->fields[2];
$dsimg=$result->fields[3];
$idpos=$result->fields[4];
$dsruta=$result->fields[5];
$idactivo=$result->fields[6];
$dsimg2=$result->fields[7];
?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#CACAD0"><br />


<table width="70%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Edicion del registro seleccionado</td>
        </tr></table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="text1" bgcolor="#CCCCCC">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n corta</td>
<td>
<? $contadorx="dsd_counter";$valorx="1000";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n larga</td>
<td>
<? $contadorx="dsd2_counter";$valorx="3500";$campox="dsd2";?>
<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? //include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
//include("../../incluidos_modulos/control.capa.php");
//include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen <br>230 x 155<br/></td>
<td><input type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior" value="<? echo $dsimg?>">
<? if (is_file($rutaImagen.$dsimg)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar" value="1"> Borrar Esta imagen
<input type="hidden" name="img" value="<? echo $dsimg?>">
<? } ?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen 2 <br>230 x 155<br/></td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen 2";
//include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior2" value="<? echo $dsimg2?>">
<? if (is_file($rutaImagen.$dsimg2)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg2;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar2" value="1"> Borrar Esta imagen
<input type="hidden" name="img2" value="<? echo $dsimg2?>">
<? } ?>
</td>
</tr -->

<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include("../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		 <option value="3" <? if ($idactivo==3) echo "selected";?>>DESTACADO</option>

	</select>

</td>
</tr>
<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,idpos";
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?
} // fin si
$result->Close();
?>
<br>
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
