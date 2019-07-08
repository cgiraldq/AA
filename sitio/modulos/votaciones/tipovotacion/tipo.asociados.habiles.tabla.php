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

<tr><td colspan="5" align="left">
<? if ($bloqueohabiles=="") {?>
<strong><a href="tipo.asociados.habiles.php?idtv=<? echo $idtv?>&paso=&enviarx=recargar">Recargar asociados habiles</a></strong>
<? } ?>
</td></tr>


<tr><td colspan="5" align="center">
<input type=submit name=enviar value="Asociar Datos"  class="botones">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('default.php')">

<input type=hidden name=paso value="1">

</td></tr>

<?
// encabezado generico basado
$nombrecampos="Id,Codigo,Nombre,Zona Electoral";
$opcioncheck="1";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
		  <td align="center">
		  <? echo $result->fields[1]?>
		  </td>

		  <td align="center">
		  <? echo $result->fields[2]?>
		  </td>

			<td align="center">
		  <? echo $result->fields[3]?>

		  </td>

<td align="center">
		  <?
		  $check="";
		  $sql="select dscodigo from tblvotacionasociados where dscodigo='".$result->fields[1]."' and idtipov=$idtv and idtipo=$idtipo";
		  $resultx=$db->Execute($sql);
			if (!$resultx->EOF) {
				$check="checked";
			}
			$resultx->Close();
		  ?>
		  <input type=checkbox name="dscodigo_[]" value="<? echo $result->fields[1]?>" <? echo $check?>>
		  </td>


		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Asociar Datos"  class="botones">
<input type=hidden name=paso value="1">
<input type=hidden name=idtv value="<? echo $idtv?>">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('default.php')">

<br>
Total: <? echo $contar;?>

</td></tr>
</form>

</table>
