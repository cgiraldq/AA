<?
/*
| ----------------------------------------------------------------- |
WebCenter Version 2.0
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Modificando roles
*/

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");


$tabla=$_REQUEST['tabla'];
if ($tabla==""){
	$tabla=$_REQUEST['tabla'];
}
$dir=$_REQUEST['dir'];
if ($dir==""){
	$dir=$_REQUEST['dir'];
}

$r=$_REQUEST['r'];
if ($r==""){
	$r=$_REQUEST['r'];
}
$idcampo=$_REQUEST['idcampo'];
if ($idcampo==""){
	$idcampo=$_REQUEST['idcampo'];
}

$dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_REQUEST['dsnombre'];
}
$rutaImagen="../../temas/productos/";


if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // nombre
	$campo1=$_REQUEST['campo1']; // desc
	$campo2=$_REQUEST['campo2']; // activo / desactivo
	$campo3=$_REQUEST['campo3']; // desc 2
	$campo6=$_REQUEST['campo6']; // terminos y condiciones


	$campo0=str_replace(chr(39),"&#39",$campo0);
    $campo0=str_replace(chr(34),"&#34", $campo0);

    $campo1=str_replace(chr(39),"&#39",$campo1);
    $campo1=str_replace(chr(34),"&#34", $campo1);



	$archivoanterior=$_REQUEST['archivoanterior'];
	$archivoanterior2=$_REQUEST['archivoanterior2'];


			if ($_FILES['dsarchivo1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior'];
				@unlink($rutaImagen.$archivoanterior1);
				$temp_name = $_FILES['dsarchivo1']['tmp_name'];
				$nombre1=$_FILES['dsarchivo1']['name'];
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
			} else {
				$nombre1=$archivoanterior;
			}

			if ($_REQUEST['elim1']==1){
				@unlink($rutaImagen.$archivoanterior1);
				$nombre1="";
			}


			if ($_FILES['dsarchivo2']['name']<>"") {
				// borrar anterior
				$archivoanterior2=$_REQUEST['archivoanterior2'];
				@unlink($rutaImagen.$archivoanterior2);
				$temp_name = $_FILES['dsarchivo2']['tmp_name'];
				$nombre2=$_FILES['dsarchivo2']['name'];
				move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			} else {
				$nombre2=$archivoanterior2;
			}

			if ($_REQUEST['elim2']==1){
				@unlink($rutaImagen.$archivoanterior2);
				$nombre2="";
			}

	// fin variables de carga
}

// validaciones de datos
	$mensajeData="Editando Actividad seleccionada";
	// armando vector de campos
	$camposN[0]="Nombre";
	$camposN[1]="Descripci&oacute;n";
	$camposN[2]="Activo?";
	$camposN[4]="Cargar imagen peque&ntilde;a";
	$camposN[5]="Cargar imagen grande";


	// insertando
	if ($_REQUEST['inn']==1){
	// actualizando

			$strSQL="update tblproductosxplanes";
			$strSQL.="  set ";
			$strSQL.=" dsz='$campo0',dso='$campo1'";

			$dsruta=str_replace(" ","_",$campo0);
			$dsruta=strtolower($dsruta);
			$dsruta=limpieza($dsruta);

			$strSQL.= ",dsruta='$dsruta'";

			$strSQL.=",dsarchivo1='$nombre1',dsarchivo2='$nombre2'";

			$strSQL.=" ,idactivo=$campo2";
			$strSQL.=" where idz=".$idcampo;
			//echo $strSQL;
			@mysql_db_query("c21univiajespide",$strSQL);
			// adicional.
			$val=1;

//////////////////////////// actualizar ingreso de categoria de planes/////////////////////////////////////////
if ($_REQUEST['idasoc']<>"" OR $_REQUEST['idasoc']==""){
			$contar=count($_REQUEST['idasoc']);
			$sql="delete from tblproductosxasoccatplanes  where idproducto=".$idcampo;
			mysql_db_query("c21univiajespide",$sqlm);
			for ($j=0;$j<$contar;$j++){
					// inserta
					if ($_REQUEST['idasoc'][$j]<>"") {
						$sqlm=" insert into tblproductosxasoccatplanes  values ";
						$sqlm.= "('',";
						$sqlm.= $idcampo.",";
						$sqlm.= "'".$_REQUEST['idasoc'][$j]."')";
						//echo $sqlm;
						mysql_db_query("c21univiajespide",$sql);
					}
			} // fin for
			// FIN DEPENDENCIAS
}

//////////////////////////// actualizar ingreso de categoria de planes/////////////////////////////////////////



	}
// Mensajes de resultado
if ($val==1) {
	// no iongresa
	$Mensaje=" Datos modificados en el sistema para  (".$campo0."). Presione 'Cerrar', para recargar los datos  ";
}
// cargando datos
$sql="select * from tblproductosxplanes where idz=".$idcampo;
$vermas=mysql_db_query("c21univiajespide",$sql);
$fila=mysql_fetch_object($vermas);
$campov0=$fila->dsz;
$campov1=$fila->dso;

$campov2=$fila->idactivo;
$campov3=$fila->dso2;
$archivoanterior=$fila->dsarchivo1;
$archivoanterior2=$fila->dsarchivo2;



mysql_free_result($vermas);



?>
<html>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
    function valI(){
	if (document.u.campo0.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[0];?>");
			document.u.campo0.focus();
			return;
     }

	if (document.u.campo1.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[1];?>");
			document.u.campo1.focus();
			return;
     }

	     document.u.submit();
	  }
//-->
</SCRIPT>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
 include($rutxx."../../incluidos_modulos/core.mensajes.php"); ?>
<? include ("../../incluidos/encabezado.php"); ?>
	<?
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=0;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


	?>

<section class="cont_general">


		<? include ("../../incluidos/resultoperaciones.php"); ?>

		<table width=70% align=center cellspacing=0>
		<tr  align=center>
		<td valign=top class=text1 colspan=2>
			<strong>Todos los datos son obligatorios</strong>
		</td>
		</tr>

		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
		<tr>
			<td valign=top class=text1>
				<? echo $camposN[0];?>
			</td>
			<td valign=top>
				<input type="text" name="campo0" class=text1 value="<? echo $campov0;?>" size=80 maxlength="255">
			</td>
		</tr>

		<tr>
		<td valign=top class=text1>
			<? echo $camposN[1];?>
		</td>
		<td valign=top>
		<textarea name="campo1" class=text1 cols="80" rows="15"><? echo $campov1;?></textarea>
		</td>
		</tr>


		<tr>
		<td valign=top class=text1>
			<? echo $camposN[2];?>
		</td>
		<td valign=top>
			<select name="campo2" class=text1>
			<option value="1" <? if ($campov2=="1"){ echo "SELECTED";}?>>SI</option>
			<option value="2" <? if ($campov2=="2"){ echo "SELECTED";}?>>NO</option>

			</select>

		</td>
		</tr>


		<tr class=text1>
		<td valign=top >
			<strong><? echo $camposN[4];?></strong>
		</td>
		<td valign=top>
			<input type="file" name="dsarchivo1" class="text1">
			<input type="hidden" name="archivoanterior" value="<? echo $archivoanterior?>">
		<? if (is_file($rutaImagen.$archivoanterior)){?>
		<a href="<? echo $rutaImagen.$archivoanterior?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior?>" border=0 width=80 heigth=80></a>
			<input type="checkbox" name="elim1" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>


		<tr class=text1>
		<td valign=top >
			<strong><? echo $camposN[5];?></strong>
		</td>
		<td valign=top>
			<input type="file" name="dsarchivo2" class="text1">
			<input type="hidden" name="archivoanterior2" value="<? echo $archivoanterior2?>">
		<? if (is_file($rutaImagen.$archivoanterior2)){?>
		<a href="<? echo $rutaImagen.$archivoanterior2?>" target="_blank"><img src="<? echo $rutaImagen.$archivoanterior2?>" border=0 width=150 heigth=150></a>
			<input type="checkbox" name="elim2" value="1"><strong>Eliminar</strong>.<br>

		<? } ?>

		</td>
		</tr>
		<tr>

			<td colspan="2">
<!-- ////////////////////////////////////////////////////lista de categorias de planes //////////////////////////////// -->

		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[3];?>">


		<tr bgcolor="<? echo $fondos[3];?>">
		<td valign=top colspan="4" class="formabot">
		<? $xx="Categorias de planes";
		 echo $xx;
		 ?>:
		<br>
		<!--input type=checkbox name="AdjuntarTodo" onclick="ActivarTodoGeneral('u')" -->
		</td>
		</tr>
		<tr><td colspan="2"> &nbsp;&nbsp;</td></tr>
		<br>
		<?
		$tablaasoc="tblproductosxasoccatplanes";
		$tabla="tblproductosxcatplanes";

		$sql="Select a.idz as id,a.dsz as nombre ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idactivo=1 order by a.dsz asc ";
		$vermas=mysql_db_query("c21univiajespide",$sql);
		if (mysql_affected_rows()>0){

			while($fila=mysql_fetch_object($vermas)) {

			$sql="select id  from $tablaasoc  where ";
			$sql.=" idproducto=".$idcampo;
			$sql.=" and idasoc=".$fila->id;
			$vermas1=mysql_db_query("c21univiajespide",$sql);
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
				$vermas1=mysql_db_query("c21univiajespide",$sql);
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
				$vermas1=mysql_db_query("c21univiajespide",$sql);
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

			$vermas1=mysql_db_query("c21univiajespide",$sql);
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

			</td>
		</tr>

<!-- ////////////////////////////////////////////////////lista de categorias de planes //////////////////////////////// -->



		<tr  align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Modificar" class="btn_detalle botones2" onClick="valI();">
			<input type=button name=enviar value="Regresar" class="btn_detalle botones2" onClick="irAPaginaD('productos.planes.php');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=idcampo value="<? echo $idcampo;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			</td>
		</tr>
		</form>

	</table>

</section>

<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>
