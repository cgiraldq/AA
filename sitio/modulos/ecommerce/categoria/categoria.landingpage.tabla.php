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
$nombrecampos="Id,Imagen,Nombre,Tipo,Ubicacion en LandingPage";

include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}

		$sql="select idactivo from tbllanding_page_productos where idprodcat=".$result->fields[0];
		$sql.=" and idtipo=2 and idlanding=$idlanding";
		$idactivolanding="";
	$resultx=$db->Execute($sql);
	if (!$resultx->EOF) {
		$idactivolanding=$resultx->fields[0];
	}
	$resultx->Close();
		$dsimg=$result->fields[4];


		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="idx_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
			  <td align="center">
	  	<? if (is_file($rutaImagen.$dsimg)){?>
		  <img src="<? echo $rutaImagen.$dsimg?>">
		  <? } ?>
			</td>

			
			  <td align="center">
		  <? echo $result->fields[1]?>
			</td>
			
			  <td align="center">
		  <select name="idactivo_[]" class="textnegro" disabled>
			<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
		      <option value="5" <? if ($result->fields[3]==5) echo "selected";?>>Tipo Flores</option>
		      <option value="7" <? if ($result->fields[3]==7) echo "selected";?>>Tipo Ropa Zapatos</option>
		      <option value="6" <? if ($result->fields[3]==6) echo "selected";?>>Tipo Viajes</option>
		      <option value="3" <? if ($result->fields[3]==3) echo "selected";?>>Tipo Hoteles</option>
		      <option value="4" <? if ($result->fields[3]==4) echo "selected";?>>Tipo Cupones</option>

		  </select>
			</td>
	
	
			  <td align="center">
		  <select name="idactivox_[]" class="textnegro">
			  <option value="" <? if ($idactivolanding=="") echo "selected";?>>Seleccione...</option>

			  <option value="1" <? if ($idactivolanding==1) echo "selected";?>>Pos 1 </option>
			  <option value="2" <? if ($idactivolanding==2) echo "selected";?>>Pos 2</option>
			  <option value="3" <? if ($idactivolanding==3) echo "selected";?>>Pos 3</option>
			  <option value="4" <? if ($idactivolanding==4) echo "selected";?>>Pos 4</option>
			  <option value="5" <? if ($idactivolanding==5) echo "selected";?>>Pos 5</option>
			  <option value="6" <? if ($idactivolanding==6) echo "selected";?>>Pos 6</option>

		  </select>
			</td>


		  <td align="center">
		  </td>
		
			</tr>
	
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Asociar Categoria"  class="botones">
<input type=hidden name=idlanding value="<? echo $idlanding?>"  class="botones">

</td></tr>
</form>

</table>
