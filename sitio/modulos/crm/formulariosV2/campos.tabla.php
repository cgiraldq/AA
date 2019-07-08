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
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		$maxregistros=500;
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

?>

<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Nombre,Mensaje Cuando es Obligatorio,Descripcion,Activo,Publicar <br>en la Web,Publicar en<br>listado<br>registros,Minimo<br> caracteres <br>x campo,Tipo,Campo Obligatorio,Posici&oacute;n ,Campo de referencia<br> del formulario,Campo activar <br>en el selecionador,Activar En buscadores?";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$maxregistros=500;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		 	 <!--td  align="center">
		  <input type="text" name="idcodigo_[]" value="<? echo $result->fields[15]?>" size="10" class="textnegro" maxlength="15">
			</td-->

		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">

			 <td  align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="25" class="textnegro" maxlength="100">
		  <input type="hidden" name="dsm_anterior[]" value="<? echo $result->fields[1];?>">
			</td>


	 		 <td align="center">

		  <textarea name="dsmensaje_[]" class="textnegro" cols=20 rows=3><? echo $result->fields[2]?></textarea>
			</td>

		 <td align="center">

		  <textarea name="dsdes_[]" class="textnegro" cols=20 rows=3><? echo $result->fields[8]?></textarea>
			</td>


			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
		  </select>
			</td>

			 <td align="center">
		  <select name="idpublicar_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[10]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[10]==2) echo "selected";?>>NO</option>
		  </select>
			</td>

			 <td align="center">
		  <select name="idpublicardetalle_[]" class="textnegro">
		   <option value="2" <? if ($result->fields[14]==2) echo "selected";?>>NO</option>
		  <option value="1" <? if ($result->fields[14]==1) echo "selected";?>>SI</option>

		  </select>
			</td>

			 <td  align="center">
		  <input type="text" name="idcaracteres_[]" value="<? echo $result->fields[16]?>" size="5" class="textnegro" maxlength="5">
		 
			</td>


			  <td align="center">
		  <select name="idtipo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>Texto (255 caracteres)</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>Texto Grande (500 caracteres)</option>
		  <option value="3" <? if ($result->fields[4]==3) echo "selected";?>>Password o Clave (255 caracteres)</option>
		  <option value="4" <? if ($result->fields[4]==4) echo "selected";?>>Seleccion Unica</option>
		  <option value="15" <? if ($result->fields[4]==15) echo "selected";?>>Seleccion Unica externa</option>
		  <option value="5" <? if ($result->fields[4]==5) echo "selected";?>>Tipo Email</option>
		  <option value="6" <? if ($result->fields[4]==6) echo "selected";?>>Tipo Pa&iacute;s</option>
		  <option value="7" <? if ($result->fields[4]==7) echo "selected";?>>Tipo Departamento</option>
		  <option value="8" <? if ($result->fields[4]==8) echo "selected";?>>Tipo Ciudad</option>
		   <option value="9" <? if ($result->fields[4]==9) echo "selected";?>>Tipo Checkbox</option>
		  <option value="10" <? if ($result->fields[4]==10) echo "selected";?>>Tipo RadioButtom</option>
		  <option value="12" <? if ($result->fields[4]==12) echo "selected";?>>Tipo Zona</option>
		   <option value="11" <? if ($result->fields[4]==11) echo "selected";?>>Tipo Barrios</option>
		  <option value="13" <? if ($result->fields[4]==13) echo "selected";?>>Tipo Direcci&oacute;n</option>
		  <option value="14" <? if ($result->fields[4]==14) echo "selected";?>>Tipo Num&eacute;rico</option>
		  <option value="16" <? if ($result->fields[4]==16) echo "selected";?>>Tipo Archivo</option>
		  <option value="17" <? if ($result->fields[4]==17) echo "selected";?>>Tipo Fecha</option>

		  </select>

		  <input type="hidden" name="idtipoactual_[]" value="<? echo $result->fields[4]?>">


			</td>



			  <td align="center">
		  <select name="idoblig_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[5]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[5]==2) echo "selected";?>>NO</option>
		  </select>
			</td>



			  <td align="center">
		  <input type="text" name="idposn_[]" value="<? echo $result->fields[6]?>" size="2" class="textnegro" maxlength="100">
			</td>

			<!-- campo unico -->
			<!--td align="center">
		  <select name="idoblig_[]" class="textnegro">
		  <option value="1" <? //if ($result->fields[5]==1) echo "selected";?>>SI</option>
		  <option value="2" <? //if ($result->fields[5]==2) echo "selected";?>>NO</option>
		  </select>
			</td -->

		   <!--td align="center">
		  <input type="text" name="idminimo_[]" value="<? //echo $result->fields[7]?>" size="2" class="textnegro" maxlength="100">
			</td -->

			<td align="center">
		  <select name="idref_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[11]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[11]==2) echo "selected";?>>NO</option>
		  </select>
			</td>

			<td align="center">
		  <select name="idselect_[]" class="textnegro">
		  	 <option value="2" <? if ($result->fields[12]==2) echo "selected";?> >NO</option>
		  <option value="1" <? if ($result->fields[12]==1) echo "selected";?> >SI</option>
		  </select>
			</td>

			<td align="center">
		  <select name="idbuscador_[]" class="textnegro">

		  <option value="1" <? if ($result->fields[13]==1) echo "selected";?> >Superior</option>
		   <option value="2" <? if ($result->fields[13]==2) echo "selected";?> >NO</option>
		  <option value="3" <? if ($result->fields[13]==3) echo "selected";?> >Lateral</option>
		  <option value="4" <? if ($result->fields[13]==4) echo "selected";?> >Ambos</option>

		  </select>
			</td>


		  <td align="center">
		  <?

		  $rutax="tipo.equivalencias.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Equivalencias";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  echo "<br>";


		  if ($result->fields[4]==4 || $result->fields[4]==10 ) {
		  $rutax="tipo.default.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Configurar";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		}
		 if ($result->fields[4]==15 ) {
		  $rutax="tipo.externo.default.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Configurar externos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		}

		if ($result->fields[4]==6) {
		  $rutax="tipo.paises.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Paises";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		}
		if ($result->fields[4]==7) {
		  $rutax="tipo.dep.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Departamentos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		}
		if ($result->fields[4]==8) {
		  $rutax="tipo.ciudad.php?idx=".$result->fields[0]."&idx2=".$idx;
		  $trutax="Click para configurar";
		  $mrutax="Ciudades";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		}
		?>
		|



		  	  <?

		  $rutax=$pagina."?idy=".$result->fields[0]."&idx=".$result->fields[9]."&dsmcolumna=".$result->fields[1];
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
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type=hidden name=idx value="<? echo $idx?>">
</td></tr>
</form>

</table>

<?
	} // fin si
$result->Close();
?>