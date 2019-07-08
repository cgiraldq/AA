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
$nombrecampos="Hotel,Tipo de habitacion,Precio desde,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {

		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsmhotel = seldato("titulo","id","crm_hoteles",$result->fields[1],1);
		$dsmhabitacion = seldato("titulo","id","crm_tipos_de_habitacion",$result->fields[2],1);
		$dsd2 = seldato("dsd2","id"," tblproductosxprecios",$result->fields[3],1);
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $dsmhotel ; ?>" size="50" class="textnegro" maxlength="100">
			</td>


		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $dsmhabitacion ;?>" onkeypress="return numero(event);"  size="30" class="textnegro" maxlength="8">
			</td>

			  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $dsd2;?>" size="30" readonly class="textnegro">
			</td>

		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
				<option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
				<option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


		  <td align="center">
		  <?
 		  $rutax="../formularios/registros.editar.php?idx=70&idy=".$result->fields[0]."&idgaleria=idpo=&regr=1&idprecio=".$_REQUEST['idprecio']."&idcampo=".$_REQUEST['idcampo'];
		  $trutax="Click para editar el registro";
		  $mrutax="Editar";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&idprecio=".$idprecio."&idcampo=".$idcampo;
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr>
	<td colspan=<? echo $total?> align="center">

	</td>
</tr>
</form>

</table>
