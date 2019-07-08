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
$nombrecampos="Id,Fecha Inicial,Hora Inicial,Fecha Final,Hora final,Requsitos,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$idhorai=$result->fields[7];
		$idmini=substr($idhorai,-2);
		$idhoraf=$result->fields[8];
		$idminf=substr($idhoraf,-2);


		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align="center">
		 	<input type=text name=dsfechainicial_[<? echo $contar?>] size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechainicial')" readonly  value="<? echo $result->fields[1]?>" >
			<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechainicial_[<? echo $contar?>]', this);" language="javaScript">
			</td>

			<td align="center">
   				<select name=dshorainicial_[] class="txtnegro">
					<? for ($j=1;$j<=24;$j++) {

		   				if ($j>12) {
						$j1=$j-12;
						$x="p.m.";
					} else {
						$j1=$j;
						$x="a.m.";
				}

				?>
				<option value="<? echo $j; ?>" <? if ($result->fields[2]=="$j"){ echo "selected";}?>><? echo $j1." ".$x; ?></option>
					<?

				} ?>
				</select>
					<select name=minutosini_[] class=txtnegro>
	<option value="0" <? if ($idmini=="0"){ echo "selected";}?>>0</option>

		<? for ($k=1;$k<=60;$k++) { ?>
		<option value="<? echo $k; ?>" <? if ($idmini=="$k"){ echo "selected";}?>><? echo $k; ?></option>
		<? } ?>
	</select>

  			 </td>

			<td align="center">
		 	<input type=text name=dsfechafinal_[<? echo $contar?>] size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechafinal')" readonly  value="<? echo $result->fields[3]?>" >
			<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechafinal_[<? echo $contar?>]', this);" language="javaScript">
			</td>

			<td align="center">
   				<select name=dshorafinal_[] class="txtnegro">
					<? for ($j=1;$j<=24;$j++) {

		   				if ($j>12) {
						$j1=$j-12;
						$x="p.m.";
					} else {
						$j1=$j;
						$x="a.m.";
				}

				?>
				<option value="<? echo $j; ?>" <? if ($result->fields[4]=="$j"){ echo "selected";}?>><? echo $j1." ".$x; ?></option>
					<?

				} ?>
				</select>




	<select name=minutosfin_[] class=txtnegro>
<option value="0" <? if ($idminf=="0"){ echo "selected";}?>>0</option>

		<? for ($t=1;$t<=60;$t++) { ?>
		<option value="<? echo $t; ?>" <? if ($idminf=="$t"){ echo "selected";}?>><? echo $t; ?></option>
		<? } ?>
	</select>


  			 </td>

  			 <td align="center">
  <textarea name="dsrequisitos_[]" cols="30"  rows="5" class=text1><? echo $result->fields[5]?></textarea>

  			 </td>




			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[6]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[6]==2) echo "selected";?>>NO</option>
		  </select>
			</td>
	     <input type="hidden" name="idtv" value="<? echo $idtv?>">

		  <td align="center">
			<?
			$rutax=$pagina."?idx=".$result->fields[0]."&idtv=$idtv";
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
