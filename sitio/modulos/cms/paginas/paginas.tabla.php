
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
$nombrecampos="Id,Pagina,Pagina Alterna,Titulo,Posici&oacute;n";
if ($_SESSION['i_idperfil']== "-1") $nombrecampos.=",Activo";
$nombrecampos.=",Mostrar en Remate,Activar Mapa Sitio";
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
		  <td align="center" width="5%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="25" class="textnegro" maxlength="100">
			</td>

			  <td align="center">
		  <input type="text" name="dsmalterna_[]" value="<? echo $result->fields[6]?>" size="25" class="textnegro" maxlength="100">
			</td>


		  <td align="center">
		  <input type="text" name="dstit_[]" value="<? echo $result->fields[2]?>" size="40" class="textnegro" maxlength="255">
			</td>

		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[3]?>" size="2" class="textnegro" maxlength="8">
			</td>
<? if ($_SESSION['i_idperfil']== "-1") { ?>
			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[4]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[4]==2) echo "selected";?>>NO</option>
		  </select>
			</td>
<? } ?>			
				  <td align="center">
		  <select name="idtienda_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[8]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[8]==2) echo "selected";?>>NO</option>
		  </select>
			</td>
			  <td align="center">
		  <select name="idsitemap_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[7]==1) echo "selected";?>>SI</option>
		  <option value="3" <? if ($result->fields[7]==3) echo "selected";?>>Pricipal</option>
		  <option value="2" <? if ($result->fields[7]==2) echo "selected";?>>NO</option>
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
		  $mrutax="Posicionamiento";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax="paginas.editar.php?idx=".$result->fields[0]."&idtiendax=".$_REQUEST['idtiendax'];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		|
		  <?
		   $rutax="menu.paginas.php?idx=".$result->fields[0];
		  $trutax="Click para asociar las paginas";
		  $mrutax="Asociar paginas Principal";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  		|
		  <?
		   $rutax="formularios.paginas.php?idx=".$result->fields[0];
		  $trutax="Click para asociar formularios a la pagina";
		  $mrutax="Asociar formularios ";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
<? if ($_SESSION['i_idperfil']== "-1") { ?>
		  |
		  <?

		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
<? } ?>
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
