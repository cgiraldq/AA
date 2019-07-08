<table width=140% align=center  cellpadding=2 cellspacing=1 bgcolor="<? echo $fondos[3]?>">
<form action="<? echo $pagina;?>" method="post" name=u>										
<?$nombrecampos="Prefijo,Resoluci&oacute;n,Desde,Hasta,Actual,NIT,Ciudad,Nombre,Dir,Tel,Fecha,TextoActivo";
include("../../../incluidos_modulos/tabla.encabezado.php");
?>

<? 
if (!$vermas->EOF) {
while(!$vermas->EOF) {

?>
<tr class=forma2  bgcolor="<? echo $fondo;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[3];?>');">		
<td align="center" class="link_negro1">
<input type="text" name="dsprefijo_[]" value="<? echo $vermas->fields[12];;?>" size="5" class="link_numeros">
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsres_[]" value="<? echo $vermas->fields[1];?>" size="10" class="link_numeros">
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecini_[]" value="<? echo $vermas->fields[2];?>" size="4" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecfin_[]" value="<? echo $vermas->fields[3];?>" size="4" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="idconsecactual_[]" value="<? echo $vermas->fields[4];;?>"  readonly size="10" class="link_numeros" >
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsnit_[]" value="<? echo $vermas->fields[7];;?>" size="9" class="link_numeros" >
</td>


<td align="center" class="link_negro1">
<input type="text" name="dsciudad_[]" value="<? echo $vermas->fields[5];;?>" size="20" class="link_numeros" >

</td>


<td align="center" class="link_negro1">
<input type="text" name="dsnombre_[]" value="<? echo $vermas->fields[6];;?>" size="25" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dsdir_[]" value="<? echo $vermas->fields[8];;?>" size="25" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dstel_[]" value="<? echo $vermas->fields[9];;?>" size="10" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<input type="text" name="dsfechax_[]" value="<? echo $vermas->fields[10];?>" size="20" class="link_numeros" >
</td>

<td align="center" class="link_negro1">
<textarea name="dsdescx_[]" class="link_numeros" cols="40" rows="6"><? echo $vermas->fields[11]?></textarea>
</td>


<td align="center">
					<select name="idactivo_[]" class=ddesingtex1>
		<option value="0" <? if ($vermas->fields[13]==0){ echo "selected";}?>>--</option>
		<option value="1" <? if ($vermas->fields[13]==1){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($vermas->fields[13]==2){ echo "selected";}?>>NO</option>
				</select>	
					</td>


						
  <td align="center">
		  <?
		  $rutax=$pagina."?idx=".$vermas->fields[0]."&enviar=Eliminar";
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
<input type="hidden" name="id_[]" value="<? echo $vermas->fields[7];?>">
		  </td>		
</tr>

<?
$vermas->MoveNext();
}
} // fin si 
$vermas->Close();
?>
</table>				
<table width=80% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
<tr class=forma2  bgcolor="<? echo $fondos[4];?>" align="center">		
<td  onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[5];?>');">

<? if ($idmod==1){?>
<input type=submit name="enviar" class="formbt1" value="Modificar">
<input type="hidden" name="idlistax" value="<? echo $idlistax?>">
<input type="hidden" name="idorigenclientex" value="<? echo $idorigenclientex?>">
<? } ?>
<? if ($iddel==1){?>
<!--input type=submit name="enviar" class=forma2 value="Eliminar"-->
<? } ?>
</td>
</tr>
</form>		
</table>