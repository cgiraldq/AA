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

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1" >
<form action="<? echo $pagina;?>" method='post' name='p' enctype="multipart/form-data">
<?
// encabezado generico basado
$nombrecampos="Id,Imagen,Titulo";
if ($enca=="") $nombrecampos.=",Subir imagen,Activo";
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

		<td align=center>

			<? $dsimg1= $result->fields[4];
				$rutaImagen=$rutxx."../../../contenidos/images/galeria/";
				if ($dsimg1<>"") {?>

				<a class="customlightbox" title="Click para ver la imagen" href="<? echo $rutaImagen.$dsimg1;?>" rel="group2">
		      		<img src="<? echo $rutaImagen.$dsimg1;?>" width=150 >
            	</a>
            	<input type="hidden" name="imagenes_[]" value="<? echo $dsimg1;?>">

				<? } ?>
		</td>

		  </td>
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100">
			</td>
<? if ($enca==""){?>

			 <td align="center">
<input type="file" name="dsimg_[]" value="<? echo $result->fields[2]?>" size="2" class="textnegro" maxlength="8">
			</td>
<? } ?>


		  <!--td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td-->

<? if ($enca==""){?>

		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
				  <option value="3" <? if ($result->fields[3]==3) echo "selected";?>>Principal</option>
				  <option value="4" <? if ($result->fields[3]==4) echo "selected";?>>Resultados Buscador</option>

			  </select>
		  </td>
<? } ?>

		  <td align="center">

		  <?
		  $rutax=$pagina."?idxx=".$result->fields[0];
		  $rutax.="&idy=".$_REQUEST["idy"];
		  $rutax.="&idx=".$_REQUEST["idx"];
		  $rutax.="&galeria=galeria";

		  $formax="";
		  if ($enca=="") include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
if ($enca=="") {
?>
</table>
<nav class="nav_centro">

<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name='galeria' value="galeria">


</nav>
<? } ?>
</form>

