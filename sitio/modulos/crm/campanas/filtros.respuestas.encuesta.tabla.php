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
$nombrecampos="Codigo,Respuetas,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {

		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dstitulo = $result->fields[1];
		$idpos = $result->fields[2];
		$id=$result->fields[0];

		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
			 <td align="center">
		  		<input type="text" name="id_[]" value="<? echo $id ; ?>" size="5" class="textnegro" readonly>
			</td>
			 <td align="center">
		  		<input type="text" name="dsm_[]" value="<? echo $dstitulo ; ?>" size="50" class="textnegro" maxlength="100">
			</td>


		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $idpos ;?>" onkeypress="return numero(event);"  size="30" class="textnegro" maxlength="8">
			</td>

		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
				<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
				<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


		  <td align="center">

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
<tr>
	<td align="center" colspan=<? echo $total?>>
		<input type="submit" name="enviar" value="Modificar"  class="botones">
		<input type="hidden" name="mod" value="1">
		<input type="hidden" name="idpregunta" value="<? echo $_REQUEST['idpregunta']; ?>">
		<input type="hidden" name="idencuesta" value="<? echo $_REQUEST['idencuesta']; ?>">
		<input type="button" name="enviar" value="Regresar"  class="botones" onclick="irAPaginaD('filtros.preguntas.encuesta.php?idencuesta=<? echo $_REQUEST['idencuesta']; ?>')">
	</td>
</tr>

</form>

</table>
