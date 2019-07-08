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
$nombrecampos="Id,Distribuidor?,Activar?,Nombres,Apellidos,Telefono 1,Telefono 2,Direccion,Movil,Ciudad,Departamento,Pais,Email,Tipo Identificacion";
$nombrecampos.=",Identificacion,Fecha nacimiento,Fecha registro,Clave,Tienda,Concurso,Precio distribuidor";
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
		  <td align="center" >
		  <? if ($exportardatos=="") { ?>

		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
<? } else { ?>
		  <? echo $result->fields[1]?>

<? } ?>
</td>
		  <td align="center">
		  <? if ($exportardatos=="") { ?>

	<select name="idtipocliente_[]" class=text1>
			<option value="" <? if ($result->fields[1]=="") echo "selected";?>>Seleccione...</option>

		  <option value="1" <? if ($result->fields[1]=="1") echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[1]=="2") echo "selected";?>>NO</option>

	</select>


		  <? } else { ?>
		  <? echo $result->fields[1]?>
		  <? } ?>
		  	</td>
		  <td align="center">
		  <? if ($exportardatos=="") { ?>

<select name="idactivo_[]" class=text1>
			<option value="" <? if ($result->fields[2]=="") echo "selected";?>>Seleccione...</option>

		  <option value="1" <? if ($result->fields[2]=="1") echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[2]=="2") echo "selected";?>>NO</option>

	</select>


<? } else {?>
<? echo $result->fields[2]?>
<? } ?>
		  	</td>

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

		  <input type="text" name="dsdireccion_[]" value="<? echo $result->fields[7]?>" size="30" class="textnegro" maxlength="255">

		  <? } else {?>


		  	<? echo $result->fields[7];?>
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

  		  <input type="text" name="dsciudad_[]" value="<? echo $result->fields[9]?>" size="20" class="textnegro" maxlength="100">


		  <? } else {?>

		  	<? echo $result->fields[9];?>
	<?} ?>

		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>
  		  <input type="text" name="dsdepartamento_[]" value="<? echo $result->fields[10]?>" size="20" class="textnegro" maxlength="100">

		  <? } else {?>

		  	<? echo $result->fields[10];?>
<? } ?>
		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>

		  <input type="text" name="dspais_[]" value="<? echo $result->fields[11]?>" size="20" class="textnegro" maxlength="100">


		  <? } else {?>

		  	<? echo $result->fields[11];?>
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

		  <input type="text" name="dstipoidentificacion_[]" value="<? echo $result->fields[13]?>" size="3" class="textnegro" maxlength="10">


		  <? } else {?>

		  	<? echo $result->fields[13];?>
<? } ?>
		  </td>
		  <td align="center">
  <? if ($exportardatos=="") { ?>

  		  <input type="text" name="dsidentificacion_[]" value="<? echo $result->fields[14]?>" size="10" class="textnegro" maxlength="30">


		  <? } else {?>

		  	<? echo $result->fields[14];?>
<? } ?>
		  </td>
		  <td align="center">

  <? if ($exportardatos=="") { ?>
  		  <input type="text" name="dsfechanacimiento_[]" value="<? echo $result->fields[15]?>" size="15" class="textnegro" maxlength="30">

		  <? } else {?>

		  	<? echo $result->fields[15];?>
<? } ?>
		  </td>
		  <?if ($_REQUEST['idconcursox']==1) {?>
		  		<td align="center"><? echo $result->fields[20];?></td>
		  <?}else{?>
			  <td align="center"><? echo $result->fields[16];?></td>
		  <?} ?>
<td align="center"><?
$clave=$result->fields[17];
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
echo $dsclave;
?>
</td>

<td align="center"><?
$idtienda=$result->fields[18];
echo seldato("dsnombre","id","tblempresa",$idtienda,1);
?>
</td>

<td align="center"><?
$idregistroc=$result->fields[19];
if ($idregistroc==1) {
	echo "<span style='color:#F00;'>Concurso Aguatur</span>";
}
?>
</td>

		  <td align="center">
  <? if ($exportardatos=="") { ?>

  		  <input type="text" name="dspreciomindistrib_[]" value="<? echo $result->fields[21]?>" size="20" class="textnegro" maxlength="100">

		  <? } else {?>

		  	<? echo $result->fields[21];?>
	<?} ?>

		  </td>


		  <? if ($exportardatos=="") { ?>
		  <td align="center">
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  //include("../../incluidos_modulos/enlace.eliminar.php");?>
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
