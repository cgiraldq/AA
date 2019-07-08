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
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Nombre Cliente,Fecha inicial,Fecha final,Valor,Fecha Registro,Activo";
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


		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align="center">
		  <? echo reemplazar($result->fields[4]." ".$result->fields[5]);?>
			</td>

		<td align="center">
		<input type=text name="dsfechai_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[7]?>">
		<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai_[<? echo $contar?>]', this);" language="javaScript">
		</td>

		 <td align="center">
		<input type=text name="dsfechaf_[<? echo $contar?>]" size=10 maxlength="10" class=text1 value="<? echo $result->fields[8]?>">
		<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf_[<? echo $contar?>]', this);" language="javaScript">
		</td>


		<td align="center">
		  <input type="text" name="dsvalor_[]" value="<? echo $result->fields[6]?>" size="10" class="textnegro" maxlength="10">
		</td>


		<td align="center">
		  <? echo $result->fields[3]?>
		</td>


			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[9]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[9]==2) echo "selected";?>>NO</option>
		  </select>
			</td>




		  <td align="center" valign="absmiddle">

		  <?

			  $rutaeditar="resultados.php";
			  $rutax=$rutaeditar."?idnegocio=".$result->fields[0];
			  $formax="";
			  $mrutax="Resultados";
			  $clase="botones2";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			 ?> 

<a class="botones2" href="javascript:irAPaginaDN('../vendedor/reportes.php?id=<? echo $result->fields[1]; ?>')" type="imprimir" title="Click para el resumen de gestiones que posee este cliente">Resumen</a>

<a class="botones2" href="../agenda/default.php?Agendamiento=Agendamiento&idcliente=<? echo $result->fields[1];?>" type="imprimir" title="Click para agendar una actividad con este cliente">Agendar</a>


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
