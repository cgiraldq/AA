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
<tr >
		  <td align="right">

		  <?
		  $rutax=$pagina."?idactivox=1";
		  $trutax="Listar por los activos";
		  $mrutax="Activos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax=$pagina."?idactivox=2";
		  $trutax="Listar por los inactivos";
		  $mrutax="Inactivos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
 		  <?
		  $rutax=$pagina."?idactivox=3";
		  $trutax="Listar asociados a modulos";
		  $mrutax="Asociados a modulos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax=$pagina."?idactivox=4";
		  $trutax="Listar asociados a submdulos";
		  $mrutax="Asociados a submodulos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax=$pagina."?idactivox=999";
		  $trutax="Listar todos ";
		  $mrutax="Listar todos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>


		  </td>

</tr>
</table>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,M&oacute;dulo,Ruta,Posici&oacute;n,Activo,Modulo Asociado,SubModulo Asociado";
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
		  <td align="center">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="25" class="textnegro" maxlength="100">
			</td>


		  <td align="left">
		  <input type="text" name="dsr_[]" value="<? echo $result->fields[3]?>" size="25" class="textnegro" maxlength="100">
		  <?  if (is_file($rutxx.$result->fields[3])) {
		  		?>
				<img  src="<? echo $rutxx;?>../../img_modulos/modulos/vistobueno.gif" align="absmiddle" title="Creado en el sistema"/>
				<?
			} else {
				?>
				<img  src="<? echo $rutxx;?>../../img_modulos/modulos/stop.gif" align="absmiddle" title="Pendiente por crear en el sistema"/>
				<?
			}
				?>
			</td>


		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="2" class="textnegro" maxlength="8">
			</td>



			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
		 <option value="3" <? if ($result->fields[4]==3) echo "selected";?>>Asociado a Modulo</option>
		 <option value="4" <? if ($result->fields[4]==4) echo "selected";?>>Asociado a SubModulo</option>


		  </select>
			</td>


			  <td align="center">
		  <select name="idmodulo_[]" class="textnegro">
		  <option value="0" <? if ($result->fields[5]==0) echo "selected";?>>---</option>
 		<? modulos("tblmodulos",$result->fields[5]);?>

		  </select>
			</td>

				  <td align="center">
		  <select name="idsubmodulo_[]" class="textnegro">
		  <option value="0" <? if ($result->fields[6]==0) echo "selected";?>>---</option>
 		<? modulos("tblmodulos",$result->fields[6]);?>

		  </select>
			</td>

		  <td align="center">

		  <?
		  $rutax="modulos.editar.php?idx=".$result->fields[0];
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
</td></tr>
</form>

</table>
