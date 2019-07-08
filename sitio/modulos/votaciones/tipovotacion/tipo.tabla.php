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
$nombrecampos="Id,Nombre,Activo,Cargar Archivo";
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
		<td align="center" width="4%" size=4>
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
		</td>


			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
			</td>

		  <!--<td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="2" class="textnegro" maxlength="8">
			</td>-->


			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($result->fields[2]==3) echo "selected";?>>Demo</option>

		  </select>
			</td>

			  <td align="center">
		  <select name="idarchivo_[]" class="textnegro">
		  <!--option value="0" <? if ($result->fields[3]=="") echo "selected";?>>---</option-->

		  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
		  <!--option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option-->
		  </select>
			</td>


		  <td align="center">
			<?
		  	$rutax="tipo.editar.php?idx=".$result->fields[0];
		  	include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  	|
		  	<?
		  	$rutax="fechainscripcion.php?idtv=".$result->fields[0];
		  	$trutax="Click para ingresar la fecha de inscripcion";
		  	$mrutax="Fechas Inscripci&oacute;n";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
		  	$rutax="fechavotacion.php?idtv=".$result->fields[0];
		  	$trutax="Click para ingresar la fecha de votacion";
		  	$mrutax="Fechas Votaci&oacute;n";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
		  	$rutax="escrutinios.php?idtv=".$result->fields[0];
		  	$trutax="Click para ingresar el escrutinio";
		  	$mrutax="Escrutinios";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
		  	$rutax="fichatecnica.php?idtv=".$result->fields[0];
		  	$trutax="Click para ingresar el escrutinio";
		  	$mrutax="Fichas t&eacute;cnicas";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
			if ($result->fields[3]==1){
			  	$rutax="tipo.asociados.cargarhabiles.php?idtv=".$result->fields[0];
			  	$trutax="Click para cargar asociados habiles por archivo plano";
			  	$mrutax="Cargar Asociados";

			} else {
			  	$rutax="tipo.asociados.habiles.php?idtv=".$result->fields[0];
			  	$trutax="Click para habilitar asociados";
			  	$mrutax="Habilitar Asociados";

		  	}

		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
		  	$rutax="tipo.mensajes.inhabiles.php?idtv=".$result->fields[0];
		  	$mrutax="Mensaje Asociados inhabiles";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
			|
			<?
/*		  	$rutax="usuarios.php?idtv=".$result->fields[0];
		  	$trutax="Click para ingresar usuarios";
		  	$mrutax="Usuarios";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");
*/
		  	?>
<!--			| -->
			<?
			$rutax="candidatos.php?idtv=".$result->fields[0];
		  	$trutax="Click para ver los candidatos";
		  	$mrutax="Candidatos";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
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
