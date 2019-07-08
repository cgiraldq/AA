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
$nombrecampos="Id,Nombre,Fecha inicial,Fecha final,Estado,Tipo";
include("../../../incluidos_modulos/tabla.encabezado.php");
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


			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
			</td>

 <td align="center">
<input type=text name="dsfechai_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[6]?>">
<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai_[<? echo $contar?>]', this);" language="javaScript">
</td>

 <td align="center">
<input type=text name="dsfechaf_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[7]?>">
<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf_[<? echo $contar?>]', this);" language="javaScript">
</td>



			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>En proceso</option>
			<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>Inactiva</option>
			<option value="3" <? if ($result->fields[3]==3) echo "selected";?>>Finalizada</option>
		  </select>
			</td>

			  <td align="center">
		  <select name="idtipo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[5]==1) echo "selected";?>>Mailing</option>
			<option value="2" <? if ($result->fields[5]==2) echo "selected";?>>Landingpage</option>
			<option value="3" <? if ($result->fields[5]==3) echo "selected";?>>Publicidad redes sociales</option>
		  </select>
			</td>



		  <td align="center">

		  <?
		  $rutax="editar.php?idx=".$result->fields[0];
		  include("../../../incluidos_modulos/enlace.detalles.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include("../../../incluidos_modulos/enlace.eliminar.php");?>
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
