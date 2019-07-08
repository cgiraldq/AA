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
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Tipo,Nombres,Apellidos,Teléfono,Correo,Contrase&ntilde;a,Ciudad,Pa&iacute;s,Direcci&oacute;n,Fecha registro,Activo";
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
			<td align="center" width="5%"><? echo $result->fields[0]?>
<input type="hidden" name="id_[]" value="<? echo $result->fields[0]?>">
			</td>
			<td align="center"><? if($result->fields[11]==1){?>
			Se&ntilde;or
			<? }elseif($result->fields[11]==2){ ?>
			Se&ntilde;ora
			<? } ?>
			</td>
     		<td align="center"><? echo $result->fields[1]?></td>
			<td align="center"><? echo $result->fields[7]?></td>
			<td align="center"><? echo $result->fields[3]?></td>
			<td align="center"><? echo $result->fields[4]?></td>
			<?
			$clave=$result->fields[5];
			$dscontrasenan = $rc4->decrypt($s3m1ll4, urldecode($clave));
			?>
			<td align="center"><? echo $dscontrasenan;?></td>
			<td align="center"><? echo $result->fields[10]?></td>
			<td align="center"><? echo $result->fields[8]?></td>
			<td align="center"><? echo $result->fields[9]?></td>


			<td align="center"><? echo $result->fields[6]?></td>
    		<td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>




			</select>
		  </td>
		  <td align="center">
 		<?
 		  $rutax="envio.correo.php?idX=".$result->fields[0]."&nombre=".$result->fields[1]."&correo=".$result->fields[4]."&correoenvio=1";
		  $trutax="Click para enviar Notificacion de Envio";
		  $mrutax="Notificación";
		  include($rutxx."../../incluidos_modulos/enlace.genericoc.php");?>

|
		  <?
		  $rutax="editar.php?idx=".$result->fields[0];
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
<?
	} // fin si
$result->Close();
?>