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

<table width="100%" border="0" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Nombre Empresa,Activar,tipo";
include("../../incluidos_modulos/tabla.encabezado.php");
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
		</td>
		  <td align="center">
	  <input type="text" name="dsnombre_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
		</td>

		 <td align="center">
			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


			<td  align="center">
				<input type=text name="idpos_[]" size=1 maxlength="8" class=text1  value="<? echo $result->fields[3];?>">

			</td>

	  <td align="center">
	   <?/*
		  $rutax="empresa.posicionamiento.php?idx=".$result->fields[3];
		  $trutax="Click ingresar los tags de posicionamiento";
		  $mrutax="Posicionamiento";
		  include("../../incluidos_modulos/enlace.generico.php");
			*/?>


	  <?
	  $rutax="gestion.editar.php?idx=".$result->fields[0];
	  include("../../incluidos_modulos/enlace.detalles.php");
	  ?>

	  <?
	  $rutax=$pagina."?idx=".$result->fields[0];
	  $formax="";
	  include("../../incluidos_modulos/enlace.eliminar.php");
	  ?>
	  </td>

		</tr>

	<?
	$result->MoveNext();
	$contar++;
} // fin while
?>
</table>
<nav class="nav_centro">
	<input type=submit name=enviar value="Modificar datos"  class="botones">
</nav>
</form>

