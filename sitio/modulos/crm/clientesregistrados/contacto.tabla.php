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
$border=0;
if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>
<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Nombres,Apellidos,Email,Telefono 1,Telefono 2,Movil,Ciudad,Direccion,Estado";
$nombrecampos.=",Pedidos,Contactos";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
 <tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>


		  <td align="center">
		  <? if ($exportardatos=="") { ?>
		  <input type="text" name="dsnombres_[]" value="<? echo $result->fields[3]?>" size="20" class="textnegro" maxlength="100">
		  <? } else {?>
		  	<? echo $result->fields[3];?>
		<? } ?>
		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>
  		  <input type="text" name="dsapellidos_[]" value="<? echo $result->fields[4]?>" size="20" class="textnegro" maxlength="30">

		  <? } else {?>

		  	<? echo $result->fields[4];?>

<? } ?>
		  </td>
		    		  <td align="center">
  <? if ($exportardatos=="") { ?>

		  <input type="text" name="dscorreocliente_[]" value="<? echo $result->fields[12]?>" size="30" class="textnegro" maxlength="255">


		  <? } else {?>

		  	<? echo $result->fields[12];?>
<? } ?>
		  </td>

		  <td align="center">
  <? if ($exportardatos=="") { ?>
  		  <input type="text" name="dstelefono_[]" value="<? echo $result->fields[5]?>" size="10" class="textnegro" maxlength="30">

		  <? } else {?>

		  	<? echo $result->fields[5];?>
<? } ?>
		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>

  		  <input type="text" name="dstelefono2_[]" value="<? echo $result->fields[6]?>" size="10" class="textnegro" maxlength="30">

		  <? } else {?>

		  	<? echo $result->fields[6];?>
<? } ?>
		  </td>
	
		  <td align="center">
  <? if ($exportardatos=="") { ?>
  		  <input type="text" name="dsmovil_[]" value="<? echo $result->fields[8]?>" size="10" class="textnegro" maxlength="30">

		  <? } else {?>

		  	<? echo $result->fields[8];?>
<? } ?>
		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>

  		  <input type="text" name="dsciudad_[]" value="<? echo $result->fields[9]?>" size="10" class="textnegro" maxlength="100">


		  <? } else {?>

		  	<? echo $result->fields[9];?>
	<?} ?>

		  </td>
		  	  <td align="center">
		  	  <? if ($exportardatos=="") { ?>

		  <input type="text" name="dsdireccion_[]" value="<? echo $result->fields[7]?>" size="30" class="textnegro" maxlength="255">

		  <? } else {?>


		  	<? echo $result->fields[7];?>
		  	<? } ?>

		  </td>
		    <td align="center">
		     <? if ($exportardatos=="") { ?>
		  	<select name="idactivo_[]" class="textnegro">
			<option value="1" <? if ($result->fields[22]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[22]==2) echo "selected";?>>NO</option>
		  </select>
		   <? } else {?>
		     	<? if ($result->fields[22]==1){
		     	   echo "SI";
		     	}
		     	 if ($result->fields[22]==2) {
		     		echo "NO";
		     		}
		     	 } ?>

			</td>
		  <? if ($exportardatos=="") { ?>
		  <td align="center">
		  <?

		  $ventas="0";
		  $sql="select count(*) as t from tblpagos where idclientepago='".$result->fields[0]."'";
		 $resultx= $db->Execute($sql);
			if (!$resultx->EOF) {
				$ventas=$resultx->fields[0];
			}
			$resultx->Close();



		  $mrutax=" (".$ventas.")";
		  $rutax="../compras/default.php?idcliente=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		</td>
		
		  <td align="center">

		  <?
			
			$contacto="0";
		  $sql="select count(*) as t from tblcontacto where dscorreocliente='".$result->fields[12]."'";
		 $resultx= $db->Execute($sql);
			if (!$resultx->EOF) {
				$contacto=$resultx->fields[0];
			}
			$resultx->Close();



		  $mrutax="(".$contacto.")";
		  $rutax="../correos/default.php?dscorreoclientex=".$result->fields[12];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  </td>

		<td align="center">


		  <?
		  $mrutax="Editar";
		  $rutax="../clientesregistrados/editar.php?idclientepago=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>

		  </td>


		  <? } ?>
			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<? if ($exportardatos=="") { ?>
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type=hidden name=enca value="<? echo $enca?>" >
<input type=hidden name=idclientepago value="<? echo $idclientepago?>" >
<? } ?>

</td></tr>

</form>
</table>
