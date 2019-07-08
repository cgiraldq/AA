<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores: 
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados
	include("../../incluidos_modulos/modulos.buscador.php");
	include("../../incluidos_modulos/paginar.variables.php");
		include("../../incluidos_modulos/modulos.subencabezado.php");
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Tipo,Nombres,Apellidos,Teléfono,Correo,Contrase&ntilde;a,Ciudad,Pa&iacute;s,Direcci&oacute;n,Fecha registro,Activo";
include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
			<td align="center" width="15%"><? echo $result->fields[0]?>
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
			<td align="center">***</td>
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
 		  $rutax="envio.correo.php?idx=".$result->fields[0]."&nombre=".$result->fields[1]."&correo=".$result->fields[4]."&correoenvio=1";
		  $trutax="Click para enviar por correo la activacion del registro";
		  $mrutax="Notificación";
		  include("../../incluidos_modulos/enlace.generico.php");?>

|
		  <?
		  $rutax="registrese.editar.php?idx=".$result->fields[0];
		  include("../../incluidos_modulos/enlace.detalles.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include("../../incluidos_modulos/enlace.eliminar.php");?>
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