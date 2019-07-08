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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;

$titulomodulo="Listado de formularios";
$idx=$_REQUEST['idx'];
$idpo=$_REQUEST['idpo'];
$paso=$_REQUEST['paso'];
$iframemap=$_REQUEST['iframemap'];
$rr="default.php?idpo=$idpo";
$rutaImagen=$rutxx."../../../contenidos/images/empresa/";

$tabla="framecf_tbltiposformularios";
$tablaorigen="framecf_tbltiposformulariosxcampo";
$tablarelaciones="tblcamposxtblformularios";

$tablaorigen1="framecf_tbltiposformularios";
$tablarelaciones1="tblrelacionesxtblformularios";

$tablaorigen2="framecf_tbltiposformularios";
$tablarelaciones2="tblrelacionesxtblformulariosxcomplementos";

	$dscorreo1=$_REQUEST["dscorreo1"];
	$dscorreo2=$_REQUEST["dscorreo2"];
	$dscorreo3=$_REQUEST["dscorreo3"];

			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			if ($paso=="1") {

					$sql=" update $tabla set ";
					$sql.=" dsasunto='$dsasunto'";
					$sql.=" ,dsasuntoar='$dsasuntoar'";
					$sql.=" ,iddes='$iddes'";
					$sql.=" ,dsm='$dsm'";

					$sql.=" ,dsmalternativo='$dsmalternativo'";
					$sql.=" ,iframemap='$iframemap'";
					$sql.=" ,iframemappos='$iframemappos'";

					$sql.=",dsimgencabezado='".$imgvec[0]."'";
					$sql.=",dsimgremate='".$imgvec[1]."'";

					$sql.=" ,dsenc='$dsenc'";
					$sql.=" ,dsremate='$dsremate'";
					$sql.=" ,dscorreo1='$dscorreo1'";
					$sql.=" ,dscorreo2='$dscorreo2'";
					$sql.=" ,dscorreo3='$dscorreo3'";
					$sql.=" ,idgaleria='$idgaleria'";
					$sql.=" ,idinformes='$idinformes'";
					$sql.=" ,dsregistros='$dsregistros'";
					$sql.=" ,idactivartitulo='$idactivartitulo'";
					$sql.=" ,idactivardsd='$idactivardsd'";
					$sql.=" ,idgaleriaoblig='$idgaleriaoblig'";
					$sql.=" ,dscantimagenes='$dscantimagenes'";
					$sql.=" ,idresultados='$idresultados'";
					$sql.=" ,idmodomostrarform='$mostrar'";

					if ($dscantimagenesmostrar>10) $dscantimagenesmostrar=10;
					if ($dscantimagenesmostrar<0) $dscantimagenesmostrar=1;

					$sql.=" ,dscantimagenesmostrar='$dscantimagenesmostrar'";



					$sql.=" where id=".$idx;

					//echo $sql;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$i_dsnombre." modifico un registro numero $idx ";
						$dsruta="../formularios/default.php";


						$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,3);



					if ($db->Execute($sql))  {
						$error=0;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../crm/formularios/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						include($rutxx."../relaciones/relaciones.operaciones.php");
						include($rutxx."../relaciones/relaciones.operaciones.relaciones.php");
						include($rutxx."../relaciones/relaciones.operaciones.relaciones.complemento.php");
					}	else {
						$mensajes=$men[7];
						$error=1;

					}
			}



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsasunto,a.dsenc,a.dsremate,a.dscorreo1,a.dscorreo2,a.dscorreo3,a.dsasuntoar,iddes,iframemap,iframemappos";
$sql.=",dsmalternativo,idgaleria,idinformes,dsregistros,idactivartitulo,idactivardsd,dsimgencabezado,dsimgremate";
$sql.=",dscantimagenes,idgaleriaoblig,dscantimagenesmostrar,idresultados,idmodomostrarform";

$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";

$rutamodulo.="  <a href='default.php?idtipo=$idtipo' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsasunto=$result->fields[1];
$dsenc=$result->fields[2];
$dsremate=$result->fields[3];
$dscorreo1=$result->fields[4];
$dscorreo2=$result->fields[5];
$dscorreo3=$result->fields[6];
$dsasuntoar=$result->fields[7];
$iddes=$result->fields[8];
$iframemap=$result->fields[9];
$iframemappos=$result->fields[10];
$dsmalternativo=$result->fields[11];
$idgaleria=$result->fields[12];
$idinformes=$result->fields[13];
$dsregistros=$result->fields[14];
$idactivartitulo=$result->fields[15];
$idactivardsd=$result->fields[16];

$dsimg=$result->fields[17];
$dsimg2=$result->fields[18];

$dscantimagenes=$result->fields[19];
$idgaleriaoblig=$result->fields[20];
$dscantimagenesmostrar=$result->fields[21];
if ($dscantimagenesmostrar=="") $dscantimagenesmostrar=1;
$idresultados=$result->fields[22];
$idmodomostrarform=$result->fields[23];



?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
         		<h1>Editar configuraciones del formulario <? echo seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idx'],2);?></h1>
         	</td>
        </tr>
</table>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">


<tr>
	<td align="center" colspan="2">
<form action="<? echo $pagina;?>" method="post" name="u" enctype="multipart/form-data">
		<?
		$forma="u";
		$param="dsm";
		include($rutxx."../../incluidos_modulos/botones.modificar.php");
		?>
<button class="botones" onClick="javascript:irAPaginaDN('formularios.vistaprevia.correos.php?idx=<? echo $idx;?>');">Vista previa de correo</button>

	</td>
</tr>

<tr valign="top" bgcolor="#FFF">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n general</h3></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo Formulario</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name="dsm" size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign="top" bgcolor="#FFFFFF">
	<td>Mostrar titulo del formulario en la pagina web</td>

	<td>
		<select name="idactivartitulo" class="text1" OnChange="mostar_capa_informes('idactivartitulo');" >
		  <option value="1" <? if ($idactivartitulo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivartitulo==2) echo "selected";?>>NO</option>


		</select>
	</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Titulo Alternativo Formulario (si se digita, aparecera cuando se invoque en alguna parte del sitio web)</td>
<td>
<? $contadorx="dsmalternativo_counter";$valorx="255";$formax="u";$campox="dsmalternativo";?>
<input type=text name="dsmalternativo" size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsmalternativo')" value="<? echo $dsmalternativo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsmalternativo";
$mensaje_capa="Debe ingresar el titulo alternativo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n del formulario</td>
<td>
<? $contadorx="iddes_counter";$valorx="3500";$campox="iddes";?>
<textarea name=iddes cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_iddes')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $iddes?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td>Mostrar descipci&oacute;n del formulario en la pagina web </td>

	<td>
		<select name="idactivardsd" class="text1" OnChange="mostar_capa_informes('idactivardsd');" >

		  <option value="1" <? if ($idactivardsd==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivardsd==2) echo "selected";?>>NO</option>

		</select>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Iframe mapa de Google o video de youtube</td>
<td>
<? $contadorx="iframemap_counter";$valorx="3500";$campox="iframemap";?>
<textarea name="iframemap" cols="80"  rows="8" class="text1" onKeyPress="ocultar('capa_dsdp')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $iframemap?></textarea>
<?
$nombre_capa="capa_dsdp";
$mensaje_capa="Debe ingresar los beneficios";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Posicion del mapa de google o video de youtube</td>
<td>
	<select name="iframemappos" class=text1>
		  <option value="1" <? if ($iframemappos==1) echo "selected";?>>Arriba</option>
		  <option value="2" <? if ($iframemappos==2) echo "selected";?>>Abajo</option>
		  <option value="3" <? if ($iframemappos==3) echo "selected";?>>NO mostrar</option>
	</select>

</td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n de plantilla de correo</h3></td>
</tr>

<tr valign=top bgcolor="#F3F3F3">
<td>Imagen encabezado del correo</td>
<td><input type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
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



<tr valign=top bgcolor="#F3F3F3">
<td>Asunto del correo hacia los correos de la empresa</td>
<td>
<? $contadorx="dsasunto_counter";$valorx="255";$formax="u";$campox="dsasunto";?>
<input type=text name="dsasunto" size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsasunto')" value="<? echo $dsasunto?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsasunto";
$mensaje_capa="Debe ingresar el asunto";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#F3F3F3">
<td>Asunto del correo hacia el cliente</td>
<td>
<? $contadorx="dsasuntoar_counter";$valorx="255";$formax="u";$campox="dsasuntoar";?>
<input type=text name="dsasuntoar" size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsasuntoar')" value="<? echo $dsasuntoar;?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsasuntoar";
$mensaje_capa="Debe ingresar el asunto";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#F3F3F3">
<td>Texto encabezado del correo</td>
<td>
<? $contadorx="dsenc_counter";$valorx="3500";$campox="dsenc";?>
<textarea name=dsenc cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsenc')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsenc?></textarea>
<?
$nombre_capa="capa_dsenc";
$mensaje_capa="Debe ingresar texto encabezado";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#F3F3F3">
<td>Texto remate del correo</td>
<td>
<? $contadorx="dsremate_counter";$valorx="3500";$campox="dsremate";?>
<textarea name=dsremate cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsremate')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsremate?></textarea>
<?
$nombre_capa="capa_dsremate";
$mensaje_capa="Debe ingresar texto remate del correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#F3F3F3">
<td>Imagen del remate del correo <br><br/></td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior2" value="<? echo $dsimg2;?>">
<? if (is_file($rutaImagen.$dsimg2)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg2;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar2" value="1"> Borrar Esta imagen
<input type="hidden" name="img2" value="<? echo $dsimg2?>">
<? } ?>
</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n de envio de correos</h3></td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo 1 hacia donde se envia los datos</td>
<td>
<? $contadorx="dscorreo1_counter";$valorx="255";$formax="u";$campox="dscorreo1";?>
<input type=text name=dscorreo1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo1')" value="<? echo $dscorreo1?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo1";
$mensaje_capa="Debe ingresar el correo 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo 2 hacia donde se envia los datos</td>
<td>
<? $contadorx="dscorreo2_counter";$valorx="255";$formax="u";$campox="dscorreo2";?>
<input type=text name=dscorreo2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo2')" value="<? echo $dscorreo2?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo2";
$mensaje_capa="Debe ingresar el correo 2";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo 3 hacia donde se envia los datos</td>
<td>
<? $contadorx="dscorreo3_counter";$valorx="255";$formax="u";$campox="dscorreo3";?>
<input type=text name=dscorreo3 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo3')" value="<? echo $dscorreo3?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo3";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n de galer&iacute;a</h3></td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td>Galer&iacute;a por Registro? Use esta opcion si cada registro tendra imagenes</td>

	<td>
		<select name="idgaleria" class="text1">
			<option value="2" <? if ($idgaleria==2) echo "selected";?>>NO</option>
		  	<option value="1" <? if ($idgaleria==1) echo "selected";?>>SI</option>
		</select>
	</td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td>Validar que la galer&iacute;a tenga imagenes</td>

	<td>
		<select name="idgaleriaoblig" class="text1">
			<option value="2" <? if ($idgaleriaoblig==2) echo "selected";?>>NO</option>
		  	<option value="1" <? if ($idgaleriaoblig==1) echo "selected";?>>SI</option>

		</select>
	</td>
</tr>

<tr valign=top bgcolor="#F3F3F3" id="capa_cantidadx" style="display">
<td>Cuantos imagenes debe tener la galer&iacute;a</td>
<td>
<? $contadorx="dscantimagenes_counter";$valorx="255";$formax="u";$campox="dscantimagenes";?>
<input type=text name='dscantimagenes' size=45 maxlength="4" class=text1 onKeyPress="ocultar('capa_dscantimagenes')" value="<? echo $dscantimagenes?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscantimagenes";
$mensaje_capa="Debe ingresar el numero de registros";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#F3F3F3" id="capa_cantidadx" style="display">
<td>Cuantos imagenes desea subir masivamente (Maximo 10)</td>
<td>
<? $contadorx="dscantimagenesmostrar_counter";$valorx="255";$formax="u";$campox="dscantimagenesmostrar";?>
<input type=text name='dscantimagenesmostrar' size=45 maxlength="4" class=text1 onKeyPress="ocultar('capa_dscantimagenesmostrar')" value="<? echo $dscantimagenesmostrar?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscantimagenesmostrar";
$mensaje_capa="Debe ingresar ";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td>Permitir mostrar registros en un buscador al momento de no enconrar resultados en el sitio web?</td>

	<td>
		<select name="idresultados" class="text1">
		  <option value="2" <? if ($idresultados==2) echo "selected";?>>NO</option>
		  <option value="1" <? if ($idresultados==1) echo "selected";?>>SI</option>

		</select>
	</td>
</tr>


<tr valign="top" bgcolor="#FFFFFF">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n de acciones</h3></td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="" >
<td colspan="2">
<strong>RELACIONES.</strong> Elegir formularios para realizar acciones:
<?

$validar=" where idactivo=1 and id!=$idx";
include($rutxx."../relaciones/default.relaciones.php");?>
</td>
</tr>


<tr valign="top" bgcolor="#F3F3F3">
	<td align="center" colspan="2"><h3>Configuraci&oacute;n de informes</h3></td>
</tr>

<tr valign="top" bgcolor="#F3F3F3">
	<td>Mostrar informe de ultimos registros en principal del sistema </td>

	<td>
		<select name="idinformes" class="text1" OnChange="mostar_capa_informes('idinformes');" >
		  <option value="2" <? if ($idinformes==2) echo "selected";?>>NO</option>
		  <option value="1" <? if ($idinformes==1) echo "selected";?>>SI</option>

		</select>
	</td>
</tr>

<tr valign=top bgcolor="#F3F3F3" id="capa_cantidad" style="display:none">
<td>Cuantos registros a mostrar en el informe en principal del sistema</td>
<td>
<? $contadorx="dsregistros_counter";$valorx="255";$formax="u";$campox="dsregistros";?>
<input type=text name=dsregistros size=45 maxlength="4" class=text1 onKeyPress="ocultar('capa_dsregistros')" value="<? echo $dsregistros?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsregistros";
$mensaje_capa="Debe ingresar el numero de registros";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>





<tr valign=top bgcolor="#F3F3F3" id="capa_campos" style="display:none" >
<td colspan="2">
<strong>RELACIONES.</strong> Elegir los campos a mostrar en el reporte:
<?

$validar=" where idtipoformulario=$idx";
include($rutxx."../relaciones/default.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="" >
<td>Forma de mostrar formulario</td>
<td>
	<select name="mostrar" id="mostrar">
		<option value="">Seleccionar</option>
		<option value="1" <? if($idmodomostrarform==1)echo "selected";?> >Horizontal</option>
		<option value="2" <? if($idmodomostrarform==2)echo "selected";?>>Vertical</option>
	</select>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="" >


<td colspan="2">
<strong>RELACIONES.</strong> Asociar formularios para informaci&oacute;n complementaria.
<?

$validar=" where idactivo=1 and id!=$idx";
include($rutxx."../relaciones/default.relaciones.complemento.php");?>
</td>
</tr>


<tr><td align="center" colspan="2">
	<?
	$forma="u";
	$param="dsm";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	<input type="hidden" name="idpo" value="<? echo $idpo?>">
	<input type="hidden" name="paso" value="1">
	</td>
</tr>
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
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>



<script type="text/javascript">

function mostrar_capa_informes(estado){

	//alert(estado);
  			if (document.u.elements[estado].value==1){
  				document.getElementById('capa_cantidad').style.display='';
  				document.getElementById('capa_campos').style.display='';
  			} else {
  				document.getElementById('capa_cantidad').style.display='none';
  				document.getElementById('capa_campos').style.display='none';
  			}
 }
 mostrar_capa_informes('idinformes');


</script>


