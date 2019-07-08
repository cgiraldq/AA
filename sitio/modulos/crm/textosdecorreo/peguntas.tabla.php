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
$nombrecampos="Id,Titulo,Asunto,Texto del Correo,Categoria,Posicion,Activo";
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

		  <td align="center" width="5%" style="height: 20px">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align="center" style="height: 30px">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="300">
			</td>

			<td align="center" style="height: 30px">
		  <textarea  name="dsrespu_[]" class="textnegro" cols="30" rows="8"><? echo $result->fields[2]?></textarea>
			</td>

			<td align="center" style="height: 30px">
		  <textarea  name="dsd2_[]" class="textnegro" cols="50" rows="8"><? echo $result->fields[6]?></textarea>
			</td>

			<td align="center" style="height: 30px">
			  <select name="idcategoria_[]" class="textnegro">
			 <option value="1" <? if ($result->fields[5]==1) echo "selected";?> >Contacto</option>
			 <option value="2" <? if ($result->fields[5]==2) echo "selected";?> >Solicitud de servicio</option>

			   <!--option value="2" <? if ($result->fields[5]==2) echo "selected";?> >Registro</option-->
			  <!--option value="4" <? if ($result->fields[5]==4) echo "selected";?>>Recomendar</option-->

			  <!--option value="5" <? if ($result->fields[5]==5) echo "selected";?>>Recordar Clave</option-->

			  </select>
			</td>

		  <td align="center" style="height: 30px">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[3]?>" size="1" class="textnegro" maxlength="100">
			</td>



			  <td align="center" style="height: 30px">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
		  </select>
			</td>





		  <td align="center" style="height: 30px">

		  <? /*
		  $rutax="preguntas.editar.php?idx=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");*/?>
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
