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
// Modulo de novedades sobre un estado especiifci
	

$sql="select id,idpedido,idclientepago,dsfecha,dscausa_b,dsfecha_b from ecommerce_tblpagos_novedades where idpedido=$idpedido";
$sql.=" and idclientepago=$idclientepago and idestado=$idestado ";
$sql.=" order by id desc ";
$result= $db->Execute($sql);
  if (!$result->EOF) {
include("novedades.tabla.php");
  } // fin si 
$result->Close();

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

<tr valign=top bgcolor="#FFFFFF">
<td>Numero de pedido:</td>
<td>
<? echo $idpedido?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Novedad</td>
<td>
<? $contadorx="dscausa_r_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dscausa_r)?>
<textarea name=dscausa_r cols=80  rows="6" class=text1 onKeyPress="ocultar('capa_dscausa_r')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dscausa_r?></textarea>
<?
$nombre_capa="capa_dscausa_r";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha de novedad:</td>
<td>
<? $contadorx="dsfechar_counter";$valorx="20";$formax="u";$campox="dsfechar";$cantidad=strlen($dsfechar)?>
<input type=text name=dsfechar size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechar')" readonly  value="<? echo $dsfechar?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechar', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechar";
$mensaje_capa="Debe ingresar la fecha de despacho";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u1";
$param="dsfechar";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">

<input type="hidden" name="paso" value="1">
<input type="hidden" name="idestado" value="<? echo $idestado?>">
<input type="hidden" name="dsestado" value="<? echo $dsestado?>">


</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
