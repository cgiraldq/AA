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
<form action="<? echo $paginao;?>" method=post name=p>
<tr>
	<td colspan=12 align=center>
		<input type=submit name=enviarx value="Modificar datos"  class="botones">
	</td>
</tr>

<?
// encabezado generico basado
$nombrecampos="Imagen,Referencia,Nombre,Posici&oacute;n,Activo,Cantidad";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsimg1=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$result->fields[0]." and idactivo=1",1);
		//$dsimg1=$result->fields[9];

		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
			<td align=center>
				<?
				if (is_file($rutaImagen.$dsimg1)) {?>
				<a class="customlightbox" href="<? echo $rutaImagen.$dsimg1;?>" rel="group2">
					&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0" width=80 heigth=80>
				</a>
				<? } ?>
			</td>

			  <td align="center">
		  <input type="text" name="dsreferencia_[]" value="<? echo $result->fields[11]?>" size="15" class="textnegro" maxlength="20">

		  <? //echo $result->fields[11]?>
			</td>



			  <td align="center">
			  	<?$dsm=utf8_decode($result->fields[1]);
			  	$dsm=html_entity_decode($dsm);?>
		  <input type="text" name="dsm_[]" value="<? echo $dsm?>" size="40" class="textnegro" maxlength="100">
		  <?
			$sql="select a.dsm,a.idcategoria from ecommerce_tblsubcategoriasxcategoria a inner join  ecommerce_tblsubcategoriaxtblproducto b on (b.iddestino=a.id or a.dsm=b.dscategoria) and (b.idorigen=".$result->fields[0]." or  b.dsref='".$result->fields[11]."') ";
	//	echo $sql;
			 $resultx= $db->Execute($sql);
			 $subcategoria="";

			if (!$resultx->EOF) {
				?>
						  <br>Ubicado en:
		  <strong>

				<?
				echo $subcategoria=$resultx->fields[0];
				?>
						</strong>

				<?
			}
			$resultx->Close();

		  ?>
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" size="1" class="textnegro" maxlength="8">
			</td>

			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
			  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
			  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  <option value="3" <? if ($result->fields[3]==3) echo "selected";?>>OFERTA</option>
			  <option value="4" <? if ($result->fields[3]==4) echo "selected";?>>RECOMENDADO</option>
			  <option value="5" <? if ($result->fields[3]==5) echo "selected";?>>INCOMPLETO</option>
			  <option value="6" <? if ($result->fields[3]==6) echo "selected";?>>NUEVA OFERTA</option>
			  <option value="7" <? if ($result->fields[3]==7) echo "selected";?>>NUEVO</option>
			  <option value="8" <? if ($result->fields[3]==8) echo "selected";?>>PRINCIPAL INDEX</option>
		  </select>
			</td>

		  <!--td align="center">
		  <input type="text" name="precio1_[]" value="<? echo $result->fields[5]?>" size="5" class="textnegro" maxlength="20">
			</td>

			<td align="center">
		  <input type="text" name="preciodistribuidor_[]" value="<? echo $result->fields[12]?>" size="5" class="textnegro" maxlength="20">
			</td>

			<td align="center">
		  <input type="text" name="iva_[]" value="<? echo $result->fields[7]?>" size="3" class="textnegro" maxlength="3">
			</td-->


			<td align="center">
		  <input type="text" name="dsunidadesdispo_[]" value="<? echo $result->fields[13]?>" size="5" class="textnegro" maxlength="5">
			</td>



		<td align="center">
			<a href="<? echo $rutaAbs?>productos.detalle.php?vistaprevia=1&idproducto=<? echo $result->fields[0]?>&idtipoprod=<? echo $idtipoprod?>" target="_blank">
				Vista previa
			</a>
			|
		   <?
		  $mrutax="Posicionamiento";
		  $rutax="posicionamiento.php?idpo=".$result->fields[0]."&idtipoprod=$idtipoprod";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax="producto.editar.php?idx=".$result->fields[0]."&idtipoprod=$idtipoprod&paginax=".$_REQUEST['pagina']."&".$rutaPaginacion;
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&letra=$letra&campoletra=".$_REQUEST['campoletra'];
		  $rutax.="&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
		  $rutax.="&idtipob=".$idactivo;
		  $rutax.="&idactivo=".$idactivo;
		  $rutax.="&idnatx=".$idnatx;


		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0]?>" size="1" readonly class="textnegro">

		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type=hidden name=idtipob value="<? echo $idtipob?>"  class="botones">
<input type=hidden name=letra value="<? echo $letra?>"  class="botones">
<input type=hidden name=campoletra value="<? echo $_REQUEST['campoletra']?>"  class="botones">
<input type=hidden name=param value="<? echo $_REQUEST['param']?>"  class="botones">
<input type=hidden name=campo value="<? echo $_REQUEST['campo']?>"  class="botones">
<input type=hidden name=idactivo value="<? echo $idactivo?>"  class="botones">
<input type=hidden name=idnatx value="<? echo $idnatx?>"  class="botones">
<input type=hidden name=idsubcatx value="<? echo $idsubcatx?>"  class="botones">
<input type=hidden name=pagina value="<? echo $_REQUEST['pagina']?>"  class="botones">

<input type=hidden name=idlanding value="<? echo $idlanding?>"  class="botones">


</td></tr>
</form>

</table>
