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

<table width="100%" border="0" cellspacing="1" align="center" class="text1" >
<form action="<? echo $pagina;?>" method='post' name='p' enctype="multipart/form-data">
<?
// encabezado generico basado
$nombrecampos="Usuario responsable,Observaciones";
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
		  	<input style="text-align:center" type="text" name="id_[]" value="<? echo $result->fields[2]?>" size="10" readonly class="textnegro">

		  </td>

			  <td align="center">
			  	<textarea cols="100" rows="8" name="dsd_[]"><? echo $result->fields[1]?></textarea>
		  <!--input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100"-->
			</td>

<? if($_SESSION['i_dslogin']==$result->fields[2] || $_SESSION['i_idperfil']==1){?>
		  <td align="center">
		  <?
		  $rutax=$pagina."?idxx=".$result->fields[0];
		  $rutax.="&idy=".$_REQUEST["idy"];
		  $rutax.="&idx=".$_REQUEST["idx"];
		  $rutax.="&observaciones=observaciones";

		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>
<?}?>
			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<!--input type=submit name=enviar value="Modificar datos"  class="botones"-->

<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name='galeria' value="galeria">


</td></tr>
</form>

</table>
