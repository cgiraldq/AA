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
$nombrecampos="Id,Foto,Nombre,Cedula,Codigo,Fecha,Activo,Zona";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;

	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$dsfoto=$result->fields[10];
		// traer cedula
		$sqlx="select dscodigo from  tblvotacionasociados_temp where idnits=".$result->fields[1];

		//echo $sql;
		$resultx=$db->Execute($sqlx);
		if (!$resultx->EOF) {
			$dscedula=$resultx->fields[0];

		}
		$resultx->Close();
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>

			  <td align="center">
			  <?
			  if (is_file($rutaImagen.$dsfoto)){
				?>
				<img src="<? echo $rutaImagen.$dsfoto?>" width=70 height=70>
				<?
			  } else{
				echo "Sin Foto";
			  }
			  ?>


		  </td>


			  <td align="center">
		  <strong><? echo $result->fields[5]?></strong>
		  </td>

	<td align="center">
		  <strong><? echo $dscedula?></strong>
		  </td>

	<td align="center">
		  <strong><? echo $result->fields[7]?></strong>
		  </td>

	<td align="center">
		  <strong><? echo $result->fields[8]?></strong>
		  </td>




			  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[2]==1) echo "selected";?>>Pendiente</option>
		  <option value="2" <? if ($result->fields[2]==2) echo "selected";?>>Faltan datos</option>
		  <option value="3" <? if ($result->fields[2]==3) echo "selected";?>>Exitosa</option>

		  </select>
			</td>


			<td align="center">
		  <? echo ($result->fields[11]);?>
			</td>


			<input type="hidden" name="idtv" value="<? echo $idtv?>">


		  <td align="center">
	<?
			$trutax="Click para subir la foto ";
			$mrutax="Subir Foto";
		  	$rutax="candidatos.foto.php?idtv=".$idtv."&idasociado=".$result->fields[0]."&regresar=1&foto=$dsfoto";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  	|

		<?
			$trutax="Click para ver la ficha";
			$mrutax="Ver Ficha";
		  	$rutax="candidatos.ficha.php?idtv=".$idtv."&idasociado=".$result->fields[1]."&regresar=1&foto=$dsfoto";
		  	include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  	|
		  	<?
			$rutax=$pagina."?idx=".$result->fields[0]."&idtv=".$idtv;

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
<input type=submit name=enviar value="Exportar"  class="botones">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('default.php')">

<input type="hidden" name="idzona" value="<? echo $_REQUEST['idzona']?>">

</td></tr>
</form>

</table>
