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
$sql="select id,dsm,idpos,idactivo from ";
$sql.="  $tabla WHERE idactivo not in(9) ";
$result = $db->Execute($sql);
//echo $sql;
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Nombre,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$maxregistros=20;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="1" readonly class="textnegro">
			</td>

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="40" class="textnegro" maxlength="100">
			</td>




		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="1" class="textnegro" maxlength="8">
			</td>
			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
			  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  <!--option value="3" <? if ($result->fields[3]==3) echo "selected";?>>DESTACADO INDEX</option-->

		  </select>
			</td>

		<td align="center">
		  <?/*
		  $mrutax="Subcategoria";
		  $rutax="../categoria/default.php?idpo=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		 */ ?>

		  <?
		  $mrutax="Posicionamiento";
		  $rutax="posicionamiento.php?idpo=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>
		  |
		  <?
		  $rutax="eventos.editar.php?idx=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");
		  ?>
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
</td></tr>
</form>

</table>
