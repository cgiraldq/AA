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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
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
$nombrecampos="Id,Nombre,Posicion,Tipo,Obligatorio?,Activo";
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
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>



			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[4]?>" size="2" class="textnegro" maxlength="8">
			</td>

			  <td align="center">
		  <select name="idtipo_[]" class="textnegro">

		  <option value="0"  <? if ($result->fields[6]=="0") echo "selected";?>>Seleccione..</option>
		<option value="1" <? if ($result->fields[6]=="1") echo "selected";?>>Unica Respuesta</option>
		<option value="2" <? if ($result->fields[6]=="2") echo "selected";?>>Multiple Respuesta</option>
		<option value="3" <? if ($result->fields[6]=="3") echo "selected";?>>Texto</option>


		  </select>
			</td>

	  <td align="center">
		  <select name="idoblig_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[5]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[5]==2) echo "selected";?>>NO</option>
		  </select>
			</td>


			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
		  </select>
			</td>



		  <td align="center">
			<?
			if ($result->fields[6]=="1" || $result->fields[6]=="2"){
			$trutax="Click para asociar Respuestas";
			$mrutax="Respuestas";
		  	$rutax="fichatecnica.respuestas.php?idtv=".$idtv."&idz=".$result->fields[0]."&idy=".$idy;
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  	|
		  	<?
			}
			$rutax=$pagina."?idx=".$result->fields[0]."&idtv=$idtv&idy=$idy";
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
<input type="hidden" name="idy" value="<? echo $idy?>"/>
<input type="hidden" name="idtv" value="<? echo $idtv?>"/>
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('fichatecnica.php?idtv=<? echo $idtv;?>')">


</td></tr>
</form>

</table>
