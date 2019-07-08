<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

//$db->debug=true;
$tablaasoc="tblproductosxasocactividades";

$tabla="crm_actividades";

$idcampo=$_REQUEST['idcampo'];
$xx="Actividades Asociadas";
$dir=1;
// validaciones de datos
		$mensajeData="Asociando Destinos al producto seleccionado";

if ($_REQUEST['idasoc']<>""){

			$contar=count($_REQUEST['idasoc']);
			$sql="delete from $tablaasoc  where idproducto=".$idcampo;
			$result=$db->Execute($sql);

			for ($j=0;$j<$contar;$j++){
					// inserta
					if ($_REQUEST['idasoc'][$j]<>"") {

						$sqlm=" insert into $tablaasoc  values ";
						$sqlm.= "('',";
						$sqlm.= $idcampo.",";
						$sqlm.= "'".$_REQUEST['idasoc'][$j]."')";
						$db->Execute($sqlm);
					}
			} // fin for
			// FIN DEPENDENCIAS
}


?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>

<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
 include($rutxx."../../incluidos_modulos/core.mensajes.php");

// generacion del encabezado de acuerdo a los resultados encontrados 
 ?>

<? include($rutxx."../../incluidos_modulos/encabezado.php"); ?>

		<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>
	<?
	?>
<br>
	<form action="<? echo $pagina;?>" method="post" name="xx1">
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[3];?>">


		<tr bgcolor="<? echo $fondos[3];?>">
		<td valign=top colspan="4" class="formabot">
		<? echo $xx?>:
		<br>
		<input type=checkbox name="AdjuntarTodo" onclick="ActivarTodoGeneral('xx1','AdjuntarTodo','idasoc[]')">Seleccionar Todo
		</td>
		</tr>
		<?
		
		$sql="Select a.id,a.nombre ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idactivo=1 order by a.nombre asc ";
		$vermasxx=$db->Execute($sql);
		
		if (!$vermasxx->EOF){

			while(!$vermasxx->EOF) {

			$sql="select id from $tablaasoc  where ";
			$sql.=" idproducto=".$idcampo;
			$sql.=" and idasoc=".$vermasxx->fields['id'];
			//echo $sql;
			$vermas1=$db->Execute($sql);
			if (!$vermas1->EOF){
				$idar=1;
			} else {
				$idar=0;
			}
			$vermas1->Close();
			?>
			
			<tr bgcolor="<? echo $fondos[3];?>" class="text1">
				<td>
				<input type=checkbox name="idasoc[]" value="<? echo $vermasxx->fields['id'];?>" <? if ($idar=="1") echo "CHECKED";?>>
				<strong><? echo $vermasxx->fields['nombre'];?></strong>
				</td>
			</tr>
			<?
			$vermasxx->MoveNext();
			} // fin while interno

		}
		$vermasxx->Close();

		?>
	</table>

		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">
		<td>
		<input type=submit name="enviar" class="botones" value="Modificar">
		<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('../formularios/registros.php?idxx=52&r=1');">

		<input type=hidden name=inn value="1">
		<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">
		<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">
		<input type=hidden name=v value="<? echo $v;?>">
		<input type=hidden name=idempresa value="<? echo $idempresa;?>">
		<input type=hidden name=idcampo value="<? echo $idcampo;?>">

		</td>
	</tr>
		</table>
	</form>
	<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>

