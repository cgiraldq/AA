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
// Tabla central de datos cuando se hacen los listados
?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Imagen,Nombre,Fecha inicial,Fecha final,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsimg1=$result->fields[4];
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >


		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align=center>
				<? if (is_file($rutxx.$rutaImagen.$dsimg1)) {?>

				 <a class="customlightbox" href="<? echo $rutxx.$rutaImagen.$dsimg1;?>" rel="group2">
		      		<img src="<? echo $rutxx.$rutaImagen.$dsimg1;?>" width=200 heigth=200>
            	</a>



				<? } ?>
			</td>



			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
			</td>

		<td align="center">
		<input type=text name="dsfechai_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[6]?>">
		<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai_[<? echo $contar?>]', this);" language="javaScript">
		</td>

		 <td align="center">
		<input type=text name="dsfechaf_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[7]?>">
		<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf_[<? echo $contar?>]', this);" language="javaScript">
		</td>


		<td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="2" class="textnegro" maxlength="8">
		</td>



			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>DESTACADO</option>
			<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			<option value="3" <? if ($result->fields[3]==3) echo "selected";?>>SUPERIOR</option>
		    <option value="4" <? if ($result->fields[3]==4) echo "selected";?>>INFERIOR</option>


		  </select>
			</td>


		  <td align="center">

		  <?
		  $rutax="vista.banner.editar.php?idx=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |
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
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('default.php')">
</td></tr>
</form>

</table>
