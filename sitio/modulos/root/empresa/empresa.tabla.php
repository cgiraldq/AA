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
$nombrecampos="Id,Nombre Empresa,NIT";
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
		</td>
		  <td align="center">
	  <input type="text" name="dsnombre_[]" value="<? echo $result->fields[1]?>" size="30" class="textnegro" maxlength="100">
		</td>

	  <td align="center">
	  <input type="text" name="dsnit_[]" value="<? echo $result->fields[2]?>" size="20" class="textnegro" maxlength="30">
		</td>
	  <td align="center">
   <?
	  $rutax="empresa.posicionamiento.php?idx=".$result->fields[0];
	  $trutax="Click ingresar los tags de posicionamiento";
	  $mrutax="Posicionamiento";
	  include($rutxx."../../incluidos_modulos/enlace.generico.php");
	?>
	  |

	  <?
	  $rutax="empresa.editar.php?idx=".$result->fields[0];
	  include($rutxx."../../incluidos_modulos/enlace.detalles.php");

	  if ($_SESSION['i_idperfil']=="-1") {
	  ?>
	  |
	  <?
	  $rutax="empresa.configurar.php?idx=".$result->fields[0];
	   $trutax="Click ingresar configuraciones especiales";
	   $mrutax="Configurar";
	  include($rutxx."../../incluidos_modulos/enlace.generico.php");
	 }
	  ?>

	  <?/*
	  $rutax=$pagina."?idx=".$result->fields[0];
	  $formax="";
	  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");
	  */?>
	  </td>

		</tr>

	<?
	$result->MoveNext();
	$contar++;
} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr>
</form>

</table>
