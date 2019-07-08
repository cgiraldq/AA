<a name="empresa"></a>

<?
$sql="select a.dsnombre,a.dsnit,a.dstel1,a.dsdir1,a.dscorreo1";
$sql.=",a.dscorreo2,a.dscorreo3,a.dscorreo4,a.dsimg1,a.dstitulo,a.dsdesc,a.dskeyw,a.dsweb";
$sql.=",a.dslogin,a.dsclave,idformaenvio,dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto,idformaenvio,a.dsvalorminimo,a.dsstat,a.codcliente";
$sql.=" from $tabla a  limit 0,1";
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$dsnombre=$result->fields[0];
$dsnit=$result->fields[1];
$dstel1=$result->fields[2];
$dsdir1=$result->fields[3];
$dscorreo1=$result->fields[4];
$dscorreo2=$result->fields[5];
$dscorreo3=$result->fields[6];
$dscorreo4=$result->fields[7];
$dsimg1=$result->fields[8];
$dstitulo=$result->fields[9];
$dsdesc=$result->fields[10];
$dskeyw=$result->fields[11];
$dsweb=$result->fields[12];
$dslogin=$result->fields[13];
$clave=$result->fields[14];
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
$idformaenvio=$result->fields[15];
$dsnombrerem=$result->fields[16];
$dscorreorem=$result->fields[17];
$dssmtp=$result->fields[18];
$dsusuariocorreo=$result->fields[19];
$clavecorreo=$result->fields[20];
$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($clavecorreo));
$dspuerto=$result->fields[21];
$dsvalorminimo=$result->fields[23];
$dsstat=$result->fields[24];
$codcliente=$result->fields[25];


$contador="";
$valor=1;
?>

<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">

<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td><? echo $dsnombre?> <? if (trim($dsnombre)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>NIT</td>
<td><? echo $dsnit?> <? if (trim($dsnit)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Tel&eacute;fono</td>
<td><? echo $dstel1?> <? if (trim($dstel1)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Direcci&oacute;n</td>
<td><? echo $dsdir1?> <? if (trim($dsdir1)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Carga de codigo Cliente para el sistema de Tickets Comprandofacil S.A</td>
<td><? if ($codcliente<>""){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>no se encuentra cargado</strong></font>";

		  }

	?>
</td>
</tr>


<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Configuraci&oacute;n de los correos a los cuales llegan los datos interaccion de los navegantes con el sistema</b></td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 1</td>
<td><? echo $dscorreo1?> <? if (trim($dscorreo1)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 2</td>
<td><? echo $dscorreo2?> <? if (trim($dscorreo2)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 3</td>
<td><? echo $dscorreo3?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 4</td>
<td><? echo $dscorreo4?>
</td>
</tr>

<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Otras Configuraciones </b></td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Valor minimo compra cliente en el ecommerce</td>
<td>
<? echo $dsvalorminimo?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Logo de la empresa</td>
<td>
<? if (is_file($rutaImagen.$dsimg1)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0">
<? } else {
$contador=$contador+$valor;
echo "<font color=red><strong>Revisar</strong></font>";
} ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Direcci&oacute;n de internet del sitio</td>
<td><? echo $dsweb?>
</td>
</tr>


<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Configuraci&oacute;n del correo remitente desde donde se envian los datos de los formularios del sitio</b></td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>M&eacute;todo de envio</td>
<td>
<?
if($idformaenvio==1)echo 'Mail';
if($idformaenvio==2)echo 'PHP mailer';
?>
</td>


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre del Remitente</td>
<td><? echo $dsnombrerem?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Correo del Remitente</td>
<td><? echo $dscorreorem?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo2" style="display:<? echo $display?>">
<td>Servidor SMTP</td>
<td><? echo $dssmtp?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo4" style="display:<? echo $display?>">
<td>Login o usuario de acceso al correo</td>
<td><? echo $dsusuariocorreo?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo1" style="display:<? echo $display?>">
<td>Clave de acceso al correo</td>
<td><? echo $dsclavecorreo?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Puerto de acceso</td>
<td><? echo $dspuerto?>
</td>
</tr>




<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Posicionamiento</b></td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>T&iacute;tulo General del sitio</td>
<td><? echo $dstitulo?> <? if (trim($dstitulo)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n del sitio</td>
<td><? echo $dsdesc?> <? if (trim($dsdesc)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Palabras claves del sitio</td>
<td><? echo $dskeyw?> <? if (trim($dskeyw)=="") $contador=$contador+$valor; echo "<font color=red><strong>Revisar</strong></font>"?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Archivo de Robots.txt</td>
<td><? if (file_exists("../../../robots.txt")){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>No se encuentra. Verificar</strong></font>";

		  }

	?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Generador de sitemap.xml</td>
<td><?
if (file_exists("../../..".$rutalocal."/sitemap.php") ){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>No se encuentra. Verificar</strong></font>";

		  }

	?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Carga de codigo Google Analitycs</td>
<td><? if ($dsstat<>""){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>No se encuentra cargado</strong></font>";

		  }

	?>
</td>
</tr>


<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Rutas Amigables</b></td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Archivo de .htacess</td>
<td><? if (file_exists("../../../.htaccess")){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>No se encuentra. Verificar</strong></font>";

		  }

	?>
</td>
</tr>




<tr valign=top bgcolor="#cccccc">
<td colspan="2" align="center"><b>Seguridad  Carpetas Contenidos</b></td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Validacion activada</td>
<td><? if (file_exists("../../../contenidos/.htaccess")){
			  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	$contador=$contador+$valor;
		  	echo "<font color=red><strong>No se encuentra. Verificar</strong></font>";

		  }

	?>
</td>
</tr>




</table>

</td></tr></table>
<?

} // fin si
$result->Close();
?>

