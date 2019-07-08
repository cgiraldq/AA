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
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<?
$exportardatos=1;
// encabezado generico basado
$nombrecampos="Pagina,Pagina Alterna,Titulo (title),Description,Keywords";//,Imagen";
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
			  <td align="center">
		  <?
		  echo $result->fields[1];
		  	?>
			</td>

			  <td align="center">
		  <? if ($result->fields[13]<>"") {
		  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	echo "<font color=red><strong>Revisar</strong></font>";

		  }

		  ?>
			</td>


		  <td align="center">
		  <? if ($result->fields[9]<>"") {
		  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	echo "<font color=red><strong>Revisar</strong></font>";

		  }

		  ?>			</td>

		  <td align="center">
		  <? if ($result->fields[2]<>"") {
		  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	echo "<font color=red><strong>Revisar</strong></font>";

		  }

		  ?>
			</td>

			  <td align="center">
		  <? if ($result->fields[8]<>"") {
		  	echo "<font color=green><strong>OK</strong></font>";
		  } else {
		  	echo "<font color=red><strong>Revisar</strong></font>";

		  }

		  ?>

			</td>



			</tr>

		<?
		$result->MoveNext();
	} // fin while
?>
</table>

</td>
</tr>
</table>