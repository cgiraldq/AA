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
$nombrecampos="Id,Imagen,Titulo,Posici&oacute;n,Activo";
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
		 <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
		</td>

		<td align=center>

			<? $dsimg1= $result->fields[3];
				if (is_file($rutxx.$rutaImagen.$dsimg1)) {?>

				<a class="customlightbox" title="Click para ver la imagen" href="<? echo $rutxx.$rutaImagen.$dsimg1;?>" rel="group2">
		      		<img src="<? echo $rutxx.$rutaImagen.$dsimg1;?>" width=150>
            	</a>


				<? } ?>
		</td>


		<td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100">
		</td>


		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td>


		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[5]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[5]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


		  <td align="center">
		  <?
		  $mrutax="Subcategoria";
		  $rutax="../paginaxgaleria2/default.php?idy=".$result->fields[0]."&dsm=".$result->fields[1];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>
		  |
		  <?
		  $rutax="entorno.editar.php?idx=".$result->fields[0];
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
