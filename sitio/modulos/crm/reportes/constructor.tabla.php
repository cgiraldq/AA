<?/*
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
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	//include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

     $result=$db->Execute($sql);
	if (!$result->EOF) {

?>

<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Nombre,Tipo de Reporte,Fuente del reporte,Filtro Fecha, Filtro Usuario,Ruta";

include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$maxregistros=20;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$registros=0;
		$id=$result->fields[0];

		?>

		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0];?>" size="2" readonly class="textnegro">

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1];?>" size="25" class="textnegro" maxlength="100">
		  <input type="hidden" name="dsm_anterior[]" value="<? echo $result->fields[1];?>">

			</td>


		  	  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>Listado</option>
		  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>Inactivo</option>
		  <option value="3" <? if ($result->fields[3]==3) echo "selected";?>>Personalizado</option>

		  </select>
			</td>


	<td>
		<select name="dstabla_[]" class="text1">
<?
$sql="select id, dsm from  framecf_tbltiposformularios where idactivo not in (2,9) order by dsm asc ";
     $resultxx = $db->Execute($sql);
     if (!$resultxx->EOF) {
     	  while(!$resultxx->EOF) {
    $id=$resultxx->fields[0];
    $dsm=$resultxx->fields[1];

?>
			  <option value="<? echo $id?>" <? if ($id==$result->fields[4]) echo "selected"?>><? echo $dsm?></option>

<? 
  $resultxx->Movenext();
} 
}
$resultxx->Close();
?>

		</select>
	
	</td>

		  	  <td align="center">
		  <select name="idfecha_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[5]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[5]==2) echo "selected";?>>NO</option>
		  </select>
			</td>


		  	  <td align="center">
		  <select name="idusuario_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[6]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[6]==2) echo "selected";?>>NO</option>
		  </select>
			</td>

			  <td align="center">
		  <input type="text" name="dsruta_[]" value="<? echo $result->fields[7];?>" size="25" class="textnegro" maxlength="100">

			</td>


		  <td align="center">
<? if ($result->fields[3]==3) { ?>
	<a href="<? echo $result->fields[7];?>?idx=<? echo $result->fields[0]?>&r=1&reporte=<? echo $result->fields[1]?>&idxx=<? echo $result->fields[4]?>" class="btn_detalle">Ver reporte</a>
<? } else { ?>
	<a href="reportes.detalle.php?idx=<? echo $result->fields[0]?>&r=1&reporte=<? echo $result->fields[1]?>&idxx=<? echo $result->fields[4]?>" class="btn_detalle">Ver reporte</a>
|
<a href="constructor.campos.php?idx=<? echo $result->fields[0]?>&r=1&idform=<? echo $result->fields[4]?>" class="btn_detalle">Campos</a>
|
<? } ?>


		  <?
		  $rutax=$pagina."?idxe=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");
		  ?>


		  </td>
			</tr>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>
<tr>
	<td colspan="8" align="center">
		<input type=submit name=enviar value="Modificar datos"  class="botones">
		<input type=hidden name=idx value="<? echo $idx?>">
	</td></tr>
</form>

</table>

<?
	} // fin si
$result->Close();
?>