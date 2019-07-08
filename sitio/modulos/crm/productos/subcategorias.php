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

$rutx=1;

if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");

include ($rutxx."../../incluidos_modulos/varconexion.php");

include ($rutxx."../../incluidos_modulos/sessiones.php");

include ($rutxx."../../incluidos_modulos/funciones.php");

include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario


$tablaasoc="tblproductosxasocsubcategorias";

$tabla="tblproductosxsubcategorias";

$idcampo=$_REQUEST['idcampo'];

$xx="Subcategorias Asociadas";
$dbase = "c21univiajespide";

$dir=1;

// validaciones de datos

		$mensajeData="Asociando Subcategorias al producto seleccionado";



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

		 ?>

<? include ($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>

	<?

	?>

<br>

	<form action="<? echo $pagina;?>" method="post" name=xx1>

		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[3];?>">





		<tr bgcolor="<? echo $fondos[3];?>">

		<td valign=top colspan="4" class="formabot">

		<? echo $xx?>:

		<br>

		<input type=checkbox name="AdjuntarTodo" onclick="ActivarTodoGeneral('xx1')">Seleccionar Todo

		</td>

		</tr>

		<?

		$sql="Select a.id,a.dsm as nombre ";

		$sql.=" from $tabla a where  ";

		$sql.=" a.idactivo=1 order by a.dsm asc ";

		$vermas=mysql_db_query($dbase,$sql);

		if (mysql_affected_rows()>0){



			while($fila=mysql_fetch_object($vermas)) {



			$sql="select id  from $tablaasoc  where ";

			$sql.=" idproducto=".$idcampo;

			$sql.=" and idasoc=".$fila->id;

			$vermas1=mysql_db_query($dbase,$sql);

			if (mysql_num_rows($vermas1)>0){

				$idar=1;

			} else {

				$idar=0;

			}

			mysql_free_result($vermas1);

			?>

			<tr bgcolor="<? echo $fondos[3];?>" class="text1">

				<td>

				<input type=checkbox name="idasoc[]" value="<? echo $fila->id;?>" <? if ($idar=="1") echo "CHECKED";?>>

				<strong><? echo $fila->nombre;?></strong>

				</td>

				<?

				while($fila=mysql_fetch_object($vermas)) {



				$sql="select id  from $tablaasoc  where ";

				$sql.=" idproducto=".$idcampo;

				$sql.=" and idasoc=".$fila->id;

				$vermas1=mysql_db_query($dbase,$sql);

				if (mysql_num_rows($vermas1)>0){

					$idar=1;

				} else {

					$idar=0;

				}

				mysql_free_result($vermas1);

				?>

				<td>

				<input type=checkbox name="idasoc[]" value="<? echo $fila->id;?>" <? if ($idar=="1") echo "CHECKED";?>>

				<strong><? echo $fila->nombre;?></strong>

				</td>

				<?

				break;

				} //fin wehile interno



				while($fila=mysql_fetch_object($vermas)) {

				$sql="select id  from $tablaasoc  where ";

				$sql.=" idproducto=".$idcampo;

				$sql.=" and idasoc=".$fila->id;

				$vermas1=mysql_db_query($dbase,$sql);

				if (mysql_num_rows($vermas1)>0){

					$idar=1;

				} else {

					$idar=0;

				}

				mysql_free_result($vermas1);

				?>

				<td>

				<input type=checkbox name="idasoc[]" value="<? echo $fila->id;?>" <? if ($idar=="1") echo "CHECKED";?>>

				<strong><? echo $fila->nombre;?></strong>

				</td>

				<?

				break;

				} //fin wehile interno





			while($fila=mysql_fetch_object($vermas)) {



			$sql="select id  from $tablaasoc  where ";

			$sql.=" idproducto=".$idcampo;

			$sql.=" and idasoc=".$fila->id;



			$vermas1=mysql_db_query($dbase,$sql);

			if (mysql_num_rows($vermas1)>0){

				$idar=1;

			} else {

				$idar=0;

			}

			mysql_free_result($vermas1);



				?>

				<td>

				<input type=checkbox name="idasoc[]" value="<? echo $fila->id;?>" <? if ($idar=="1") echo "CHECKED";?>>

				<strong><? echo $fila->nombre;?></strong>

				</td>

				<?

				break;

				} //fin wehile interno



			?>

			</tr>

			<?

			} // fin while interno



		}

		mysql_free_result($vermas);



		?>

	</table>



		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">

		<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">

		<td >

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

</html>



