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
$nombrecampos="Id,Imagen,Nombre,Alias,Mayorista,Mostrar en Remate,Posici&oacute;n";
$nombrecampos.=",Activo";
if ($idtipo==1) $nombrecampos.=",Naturaleza";

include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsimg=$result->fields[4];
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

				  <td align=center>
				<?$dsimg1=$result->fields[4];
				 if (is_file($rutaImagen.$dsimg1)) {?>

				 <a class="customlightbox" title="Click para ver la imagen" href="<? echo $rutaImagen.$dsimg1;?>" rel="group2">
		      		<img src="<? echo $rutaImagen.$dsimg1;?>" width="200" heigth="200">
            	</a>

				<? } ?>
			</td>


			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo reemplazar($result->fields[1])?>" size="40" class="textnegro" maxlength="100">
			</td>


			  <td align="center">
		  <input type="text" name="dsalias_[]" value="<? echo reemplazar($result->fields[6])?>" size="40" class="textnegro" maxlength="100">
			</td>



			  <td align="center">
		  <input type="text" name="dsmayorista_[]" value="<? echo $result->fields[7]?>" size="10" class="textnegro" maxlength="100">
			</td>

			  <td align="center">
		  <select name="idmostrar_[]" class="textnegro">
			<option value="1" <? if ($result->fields[8]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[8]==2) echo "selected";?>>NO</option>

		  </select>
			</td>



		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="2" class="textnegro" maxlength="8">
			</td>
			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			<option value="3" <? if ($result->fields[3]==3) echo "selected";?>>SOLO MENU SUPERIOR</option>

		  </select>
			</td>

			      <? if ($idtipo=="1") {?>

			  <td align="center">
		  <select name="idnat_[]" class="textnegro">
			<option value="1" <? if ($result->fields[5]==1) echo "selected";?>>Nacional</option>
			<option value="2" <? if ($result->fields[5]==2) echo "selected";?>>Importado</option>

		  </select>
			</td>

				<? } ?>

		  <td align="center">
		   <?
		  $rutax="categoria.editar.php?idtipo=$idtipo&idx=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |

		  <?
		  $rutax=$pagina."?idtipo=$idtipo&idx=".$result->fields[0];
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
