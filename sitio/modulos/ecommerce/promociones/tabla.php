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
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Nombre,Porcentaje (%),Fecha inicial,Hora Inicial,Fecha final,Hora Final,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		//}		
		$dshorasi=$result->fields[7];
		$dshorasf=$result->fields[8];
		$partir1=explode(":",$dshorasi);
		$dshorai=$partir1[0];
		$dsminutoi=$partir1[1];
		$partir2=explode(":",$dshorasf);
		$dshoraf=$partir2[0];
		$dsminutof=$partir2[1];
		$dsimg1=$result->fields[4];
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >


		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="20" class="textnegro" maxlength="100">
			</td>
			  <td align="center">
		  <input type="text" name="dsporcentaje_[]" value="<? echo $result->fields[2]?>" size="5" class="textnegro" maxlength="100">
			</td>

 <td align="center">
<input type=text name="dsfechai_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[3]?>">
<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai_[<? echo $contar?>]', this);" language="javaScript">
</td>
  <td align="center" >
	<select name="dshorai_[]" class=text1>
		<option value="">Hora</option>
		<? for($i=1;$i<=24;$i++){
			if($i<10)$m="0".$i;
			else $m=$i;
		?>
		  <option value="<? echo $m?>" <? if ($dshorai==$m) echo "selected";?>><? echo $m?></option>
		 <? }?>
	</select>
	<select name="dsminutoi_[]" class=text1>
		<option value="">Minuto</option>
		<? for($i=0;$i<=59;$i++){
			if($i<10)$m="0".$i;
			else $m=$i;
		?>
		  <option value="<? echo $m?>" <? if ($dsminutoi==$m) echo "selected";?>><? echo $m?></option>
		 <? }?>
	</select>

</td>
 <td align="center">
<input type=text name="dsfechaf_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[4]?>">
<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf_[<? echo $contar?>]', this);" language="javaScript">
</td>
<td>
	<select name="dshoraf_[]" class=text1>
		<option value="">Hora</option>
		<? for($i=1;$i<=24;$i++){
			if($i<10)$m="0".$i;
			else $m=$i;
		?>
		  <option value="<? echo $m?>" <? if ($dshoraf==$m) echo "selected";?>><? echo $m?></option>
		 <? }?>
	</select>
	<select name="dsminutof_[]" class=text1>
		<option value="">Minuto</option>
		<? for($i=0;$i<=59;$i++){
			if($i<10)$m="0".$i;
			else $m=$i;
		?>
		  <option value="<? echo $m?>" <? if ($dsminutof==$m) echo "selected";?>><? echo $m?></option>
		 <? }?>
	</select>
</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[5]?>" size="2" class="textnegro" maxlength="8">
			</td>



			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[6]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[6]==2) echo "selected";?>>NO</option>
		  </select>
			</td>


		  <td align="center">

		  <?
		  $rutax="editar.php?idx=".$result->fields[0];
		  $mrutax="Asociar Categoria";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  <br>
		  <? $rutax="editarsub.php?idx=".$result->fields[0];
		  $mrutax="Asociar Subcategoria";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		   <br><? $rutax="editarproc.php?idx=".$result->fields[0];
		  $mrutax="Asociar Producto";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  <br><? $rutax="editartienda.php?idx=".$result->fields[0];
		  $mrutax="Promocion Todos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?><br>
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr>
</form>

</table>
