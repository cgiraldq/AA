<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
$sqlimg="SELECT dscantimagenesmostrar FROM  framecf_tbltiposformularios WHERE id='".$_REQUEST['idx']."'";
$sqlimg.=" AND idgaleria=1 AND idgaleriaoblig=1 ";
$resultimg=$db->Execute($sqlimg);
if(!$resultimg->EOF){
	$dscantimagenesmostrar=$resultimg->fields[0];
} else {
	$dscantimagenesmostrar=1; // por defecto una
}
$resultimg->close();

include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name='galeria' enctype="multipart/form-data">

<?
for ($i=1;$i<=$dscantimagenesmostrar;$i++) {
?>
<tr valign=top bgcolor="#FFFFFF">
	<td>Nombre <? echo $i?></td>

	<td>
	<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm_$i";?>
	<input type=text name="dsm_<? echo $i;?>" size=30 maxlength="255" placeholder="Nombre <? echo $i?>" class=text1 onKeyPress="ocultar('capa_dsm')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el titulo de la red";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>Imagen <? echo $i?></td>

	<td>
		<input type=file name="dsimg_<? echo $i;?>" size=1 maxlength="8" class=text1
		onKeyPress="ocultar('capa_dsimg_<? echo $i;?>');return numero(event);" value="">
			<?
			$nombre_capa="capa_dsimg";
			$mensaje_capa="Debe subir imagen";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
	</td>
</tr>


<tr valign="top" bgcolor="#FFFFFF">
	<td>Activar imagen <? echo $i;?></td>

	<td>
		<select name="idactivo_<? echo $i;?>" class="text1">
			  <option value="1">SI</option>
			  <option value="2">NO</option>
			  <option value="3">Principal</option>
		</select>
	</td>
</tr>
<tr valign="top" bgcolor="#f3f3f3">
	<td colspan="2"></td>

</tr>


<?
} // fin for
?>




<tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?
    $forma="galeria";
    $param="dscantimagenesmostrar";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
  </td>
</tr>
<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idgaleria" value="<? echo $_REQUEST['idgaleria'];?>">
<input type="hidden" name="galeria" value="galeria">
<input type="hidden" name="dscantimagenesmostrar" value="<? echo $dscantimagenesmostrar?>">

</form>
</table>
<br>

</td>
</tr>
</table>