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
// Modulo de ingreso de garantia  o devolucion
$titulo="Su pedido ha presentado novedades de funcionamiento";
$txtbase="El pedido con referencia -Idpedido- ha sido notificado por usted con novedades de funcionamiento.

[Reloj Freak, usted comento no enciende, pantalla en Blanco.]

Nuestro procedimiento de garant&iacute;a contempla el env&iacute;o del articul&oacute; a nuestra oficina en la ciudad de Medellin a trav&eacute;s de las red de centros de recepci&oacute;n de Saferbo en Colombia, ma&ntilde;ana 27 de diciembre le notificaremos a que centro de recepci&oacute;n debe llevarlo en su ciudad.

El paquete debe marcarse as&iacute;:

Destinatario ".$autorizado."

Observaci&oacute;n [Garant&iacute;a Reloj Freak pedido 1184000001]

ES NECESARIO QUE USTED ENVIE EL ARTICULO CON LOS EMPAQUES ORIGINALES

Cuando recibamos el art&iacute;culo , ser&aacute; revisado y debe ser necesario remitido a nuestro proveedor en esta dos Unidos. 

El tiempo estimado para la remisi&oacute;n del art&iacute;culo al fabricante y que este lo reemplace para ser enviado de nuevo a usted es de 15 d&iacute;as h&aacute;biles.

Los costos de este proceso ser&aacute;n cubiertos por ".$autorizado."  

Todas las novedades con respecto a su reclamaci&oacute;n ser&aacute;n notificadas a su correo electr&oacute;nico -Idcorreo- y podr&aacute; seguirlas accediendo a la <a href=http://www.comprandofacil.com/tienda/pagar.php?rutaacceso=1>zona privada</a> con su usuario y clave.

";

$remate="
Datos de contacto:
Medell&iacute;n - Colombia
Tel&eacute;fono  (574) --
Direcci&oacute;n Punto de Atenci&oacute;n y Centro de Experiencia --
";
$txtbase.=$remate;

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
<form action="<? echo $pagina;?>" method=post name=u1 enctype="multipart/form-data">
<tr valign=top bgcolor="#FFFFFF">
<td>Numero de pedido:</td>
<td>
<? echo $idpedido?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo </td>
<td>
<? $contadorx="dstitulo_r_counter";$valorx="255";$campox="dstitulo_r";$cantidad=strlen($dstitulo_r)?>
<textarea name=dstitulo_r cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dstitulo_r')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $titulo?></textarea>
<?
$nombre_capa="capa_dstitulo_r";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Garantia o devolucion</td>
<td>
<? $contadorx="dscausa_r_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dscausa_r)?>
<textarea name=dscausa_r cols="90"  rows="15" class=text1 onKeyPress="ocultar('capa_dscausa_r')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $txtbase?></textarea>
<?
$nombre_capa="capa_dscausa_r";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha:</td>
<td>
<? $contadorx="dsfechar_counter";$valorx="20";$formax="u";$campox="dsfechar";$cantidad=strlen($dsfechar)?>
<input type=text name=dsfechar size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechar')" readonly  value="<? echo date("Y/m/d")?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechar', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechar";
$mensaje_capa="Debe ingresar la fecha de despacho";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Estado:</td>
<td>
<select name="idestado" class=text1>
  <option value="1">Garantia</option>
  <option value="2">Devolucion</option>
  <option value="3">Cerrar Garantia</option>
  <option value="4">Cerrar Devolucion</option>
  
</select>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Enviar esta novedad al cliente:</td>
<td>
<input type="checkbox" name="idenviaralcliente" value="1">
</td>
</tr>



<tr>
  <td align="center" colspan="2" style="text-align: right;">
<?
$forma="u1";
$param="dsfechar";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idclientepago" value="<? echo $idclientepago?>">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="idpedido" value="<? echo $idpedido?>">

<input type="hidden" name="paso" value="1">

</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
