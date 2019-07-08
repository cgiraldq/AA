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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// Tabla con el formato de envio de notificacion al cliente
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
          <td width="615" align="left" valign="middle">
            <img src="../../../img_modulos/modulos/edicion.png">
            <h1>Cuerpo del correo que notifica al cliente</h1>
          </td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Numero de pedido:</td>
<td>
<? echo $idpedido?>
<? if ($dsfechalarga<>"") { ?>
<strong> Este pedido y este estado fue notificado al cliente el <? echo $dsfechalarga?></strong>
<? } ?>
</td>
</tr>

<? if ($idestado==7) { ?>

<tr valign=top bgcolor="#f3f3f3">
<td>Aviso importante:</td>
<td>
<strong>RECUERDE ENVIAR LA FACTURA PARA CAMBIAR EL PAQUETE </strong>
</td>
</tr>


<? } ?>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo del correo</td>
<td>
<? $contadorx="dstitulo_b_counter";$valorx="1000";$campox="dstitulo_b";$cantidad=strlen($dstitulo_b)?>
<textarea name=dstitulo_b cols=80  rows="2" class=text1 onKeyPress="ocultar('capa_dstitulo_b')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dstitulo_b?></textarea>
<?
$nombre_capa="capa_dstitulo_b";
$mensaje_capa="Debe ingresar este campo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Cuerpo del correo</td>
<td>
<? $contadorx="dscausa_b_counter";$valorx="1000";$campox="dscausa_b";$cantidad=strlen($dscausa_b)?>
<textarea name=dscausa_b cols=80  rows="15" class=text1 onKeyPress="ocultar('capa_dscausa_b')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dscausa_b?></textarea>
<?
$nombre_capa="capa_dstitulo_b";
$mensaje_capa="Debe ingresar este campo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha:</td>
<td>
<? $contadorx="dsfecha_b_counter";$valorx="20";$formax="u";$campox="dsfecha_b";$cantidad=strlen($dsfecha_b)?>
<input type=text name=dsfecha_b size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfecha_b')" readonly  value="<? echo $dsfecha_b?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfecha_b', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfecha_b";
$mensaje_capa="Debe ingresar este campo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<?
// aca colocar de acuerdo a los tipos de estados o nacionalizadon
?>


<tr valign=top bgcolor="#FFFFFF">
<td>Quien Aprueba el cambio de estado:</td>
<td>
<? $contadorx="dsaprobo_counter";$valorx="20";$formax="u";$campox="dsaprobo";$cantidad=strlen($dsaprobo)?>
<input type=text name=dsaprobo size=30 maxlength="100" class=text1 onKeyPress="ocultar('capa_dsaprobo')" value="<? echo $dsaprobo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsaprobo";
$mensaje_capa="Debe ingresar este campo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<? if ($idestado==4 || $idestado==5 || $idestado==6 || $idestado==7 || $idestado==8 || $idestado==9) { ?>
<tr valign=top bgcolor="#FFFFFF">
<td>Bodega de Origen:</td>
<td>
<select class="text1" name="dsorigen">
<option value="">Seleccione</option>
<? combo_bodegas($dsorigen)?>
</select> 

</td>
</tr>
<? } ?>

<? if ($idestado==5) { ?>
<tr valign=top bgcolor="#FFFFFF">
<td>Dias de bodega en origen:</td>
<td>
<? $contadorx="dsdiasorigen";$valorx="20";$formax="u";$campox="dsdiasorigen";$cantidad=strlen($dsdiasorigen)?>
<input type=text name=dsdiasorigen size=20 maxlength="20" class=text1 value="<? echo $dsdiasorigen?>">

</td>
</tr>
<? } ?>


<? if ($idestado==7) { ?>
<tr valign=top bgcolor="#FFFFFF">
<td>Dias de bodega en destino:</td>
<td>
<? $contadorx="dsdiasdestino";$valorx="20";$formax="u";$campox="dsdiasdestino";$cantidad=strlen($dsdiasdestino)?>
<input type=text name=dsdiasdestino size=20 maxlength="20" class=text1 value="<? echo $dsdiasdestino?>">

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Nacionalizacion:</td>
<td>
<? $contadorx="dsnacionalizacion";$valorx="100";$formax="u";$campox="dsnacionalizacion";$cantidad=strlen($dsnacionalizacion)?>
<input type=text name=dsnacionalizacion size=30 maxlength="100" class=text1 value="<? echo $dsnacionalizacion?>">

</td>
</tr>


<? } ?>




<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsfecha_b,dstitulo_b,dscausa_b";
$tituloboton="Enviar Correo al cliente";
include($rutxx."../../incluidos_modulos/botones.enviar.php");?>

<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">
<input type="hidden" name="idestado" value="<? echo $idestado?>">
<input type="hidden" name="dsestado" value="<? echo $dsestado?>">
<input type="hidden" name="idenviaralcliente" value="1">



</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<br>