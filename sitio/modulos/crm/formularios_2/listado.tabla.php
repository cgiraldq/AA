<?/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados
//	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	//include($rutxx."../../incluidos_modulos/paginar.variables.php");
$bloqueor=1;
$exportar=2;
$papelera=8;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

     $result=$db->Execute($sql);
	if (!$result->EOF) {

?>

<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Nombre";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$maxregistros=20;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$registros=0;
		$id=$result->fields[0];
	$dstabla=$result->fields[4];

	if ($dstabla=="") {
		$sqlx="select count(*) as total from framecf_tblregistro_formularios where idformulario=".$result->fields[0];

		if($_SESSION['i_idperfil']==4) $sqlx.=" and idusuario='".$_SESSION['i_idusuario']."'";
		//echo $sqlx;
		$resultx= $db->Execute($sqlx);
		if (!$resultx->EOF) {
		$registros=$resultx->fields[0];

		}
		$resultx->Close();
	}
$dsruta=$result->fields[5];
$idgaleria=$result->fields[11];
		?>

		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0];?>" size="2" readonly class="textnegro">

			  <td align="left">
		  <? echo $result->fields[1];?>
			</td>

		  <td align="center">



		  <?
		  if($result->fields[5]=="")$dsruta="formularios.vistaprevia.php";
		  $rutax=$dsruta."?idx=".$result->fields[0]."&r=1";
		  $trutax="Click para ingresar un registro";
		  $mrutax="Ingresar registro";
		  $clase="botones2";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");

		  if($result->fields[5]=="")$dsruta="registros.php";
		  $rutax=$dsruta."?idxx=".$result->fields[0]."&r=1";
		  $trutax="Click para ver los registros realizados en el sitio";
		  $mrutax="Ver registros ($registros)";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>




		  </td>
		</tr>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>
</form>

</table>

<?
	} // fin si
$result->Close();
?>