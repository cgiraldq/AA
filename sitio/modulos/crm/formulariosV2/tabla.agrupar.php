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
$nombrecampos="Id,C&oacute;digo,Nombre,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

		<td align="center" width="5%">
		  <input type="text" name="idcodigo_[]" value="<? echo $result->fields[8]?>" size="10" maxlength="15" class="textnegro">
		</td>

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="25" class="textnegro" maxlength="100">
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[3]?>" size="2" class="textnegro" maxlength="8">
		</td>

			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
		  </select>
			</td>




			  <!--td align="center">
		  <select name="idtienda_[]" class="textnegro">
<? lista_tiendas("tblempresa",$result->fields[5]);?>
		  </select>
			</td -->


		  <td align="center">
		  <?

		  $rutax="tipo.equivalenciasxagrupamiento.php?idx=".$result->fields[0]."&idx2=".$idxx;
		  $trutax="Click para configurar";
		  $mrutax="Equivalencias ";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  echo "| ";


		  $rutax="formularios.agrupar.php?idx=".$result->fields[0]."&idxx=$idxx";
		  $trutax="Click para asociar los formularios";
		  $mrutax="Agrupar campos del formulario";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>
		  |
		  <?
		  $rutax="formularios.campos.agruparxtemas.php?idx=".$result->fields[0]."&idxx=$idxx";
		  $trutax="Click para asociar los formularios";
		  $mrutax="Agrupar campos por temas";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>
		  |
		  <?

		  $rutax=$pagina."?idx=".$result->fields[0]."&idxx=$idxx";
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=6 align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type="hidden" name="idxx" value="<? echo $idxx?>">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('default.php')">
</td></tr>
</form>

</table>
