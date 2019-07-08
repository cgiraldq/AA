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
$nombrecampos="Patrocinador,Cantidad de Codigos,Descuento aplicado,Descuento al vencer,Fecha inicial,Fecha final,Fecha generacion,Tipo";
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
		 <? echo $result->fields[8]?>
			</td>
		<td align="center">
		 <? echo $result->fields[0]?>
		</td>
		<td align="center">
		 <? echo $result->fields[2]?>
		</td>

		<td align="center">
		 <? echo $result->fields[4]?>
		</td>

		<td align="center">
		 <? echo $result->fields[5]?>
		</td>

		<td align="center">
		 <? echo $result->fields[6]?>
		</td>

		<td align="center">
		 <? echo $result->fields[3]?>
		</td>
		<td align="center">
		 <? 
		 switch ($result->fields[7]) {
		 	case '1':
		 		echo "GENERAL";
		 		break;
		 	case '3':
		 	echo "cODIGO UNICO";
		 	break;	

		 }




		 ?>
		</td>

		<?
		$iddistribuidor=$result->fields[1];
		$descuento=$result->fields[2];
		$dsfechag=$result->fields[3];
		$idactivo=$result->fields[7];
		?>



		  <td align="center">
		  <?
		  $rutax="default.codigo.php?iddistribuidor=$iddistribuidor&dsdescuento=$descuento&dsfechag=$dsfechag&idactivo=$idactivo";
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |
		  <a onclick="irAPaginaDN('imprimircodigos.php?iddistribuidor=<? echo $iddistribuidor?>&dsfechag=<?echo $dsfechag?>')"title="Click para imprimir el codigo" target="_blank">Imprimir Codigos</a>
		  
		  <?/*
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");*/?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<!--tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr-->
</form>

</table>
