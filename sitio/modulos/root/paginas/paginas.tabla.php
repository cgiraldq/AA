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
	<tr>
		<td align="center">id</td>
		<td align="center">Pagina</td>
		<td align="center">Titulo</td>
		<td align="center">Posici&oacute;n</td>
		<td align="center">Activo</td>
		<td align="center">Activar Vista mobile</td>
	</tr>
<?
// encabezado generico basado
$nombrecampos="Id,Pagina,Titulo,Posici&oacute;n,Activo";
//include($rutxx."../../incluidos_modulos/tabla.encabezado.php");


$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>

		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="25" class="textnegro" maxlength="100">
			</td>




		  <td align="center">
		  <input type="text" name="dstit_[]" value="<? echo $result->fields[2]?>" size="40" class="textnegro" maxlength="255">
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[3]?>" size="2" class="textnegro" maxlength="8">
			</td>

			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
		  </select>
			</td>

			  <td align="center">
		  <select name="idvista_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[5]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[5]==2) echo "selected";?>>NO</option>
		  </select>
			</td>



			  <!--td align="center">
		  <select name="idtienda_[]" class="textnegro">
<? lista_tiendas("tblempresa",$result->fields[5]);?>
		  </select>
			</td -->


		  <td align="center">
		  <?
		  $rutax="paginas.posicionamiento.php?idx=".$result->fields[0]."&idtiendax=".$_REQUEST['idtiendax'];
		  $trutax="Click ingresar los tags de posicionamiento";

		$sqlx="select dsd,dskw from tblpaginas where id=".$result->fields[0];
		$resultx = $db->Execute($sqlx);
		if (!$resultx->EOF){
			$dsm=$resultx->fields[0];
			$dskw=$resultx->fields[1];

			if($dsm=="" || $dskw==""){
			 $mensaje="<img src='../../../images/error.png' width=15px height=15px>";
			}

		}
		$resultx->Close();
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
</td></tr>
</form>

</table>
