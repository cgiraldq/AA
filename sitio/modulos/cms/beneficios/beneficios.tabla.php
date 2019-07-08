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
<tr><td colspan=<? echo $total?> align="center">
<!--input type=submit name=enviarx value="Modificar datos"  class="botones" -->
</td>
<td colspan=9 align="right">


</td></tr>

<?
// encabezado generico basado
$nombrecampos="Imagen,Nombre,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsimg1=$result->fields[9];

		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
			<td align=center>
				<? if (is_file($rutxx.$rutaImagen.$dsimg1)) {?>

				<a class="customlightbox" title="Click para ver la imagen" href="<? echo $rutxx.$rutaImagen.$dsimg1;?>" rel="group2">
		      		<img src="<? echo $rutxx.$rutaImagen.$dsimg1;?>" width=150 heigth=150>
            	</a>


				<? } ?>
			</td>




			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="40" class="textnegro" maxlength="100">

		  <strong>

		</strong>
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="1" class="textnegro" maxlength="8">
			</td>

			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
			  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  <option value="3" <? if ($result->fields[3]==3) echo "selected";?>>DESTACADO</option>


		  </select>
			</td>




		<td align="center">


		   <?
		  $mrutax="Posicionamiento";
		  $rutax="posicionamiento.php?idpo=".$result->fields[0]."&idtipoprod=$idtipoprod";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax="beneficios.editar.php?idx=".$result->fields[0]."&idtipoprod=$idtipoprod";
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&letra=$letra&campoletra=".$_REQUEST['campoletra'];
		  $rutax.="&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
		  $rutax.="&idtipob=".$idactivo;
		  $rutax.="&idactivo=".$idactivo;
		  $rutax.="&idnatx=".$idnatx;


		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0]?>" size="1" readonly class="textnegro">

		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type=hidden name=pagina value="<? echo $_REQUEST['pagina']?>"  class="botones">



</td></tr>
</form>

</table>
