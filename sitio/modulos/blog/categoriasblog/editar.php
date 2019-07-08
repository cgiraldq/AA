<?
/*
| ----------------------------------------------------------------- |
CF-informer
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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

///////////////////////////////////////

$sqlxx="select idactivocat,idactivoing from blogtbladmin";
		$resultxx=$db->Execute($sqlxx);
		if(!$resultxx->EOF){
			$activado=$resultxx->fields["0"];
			$activadoing=$resultxx->fields["1"];
		}
		$resultxx->Close();
//////////////////////////////////////



$titulomodulo="Configuracion de categorias temas";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="blogtblcategorias";
$rutaImagen=$rutxx."../../../contenidos/images/blog/";
			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			$dsmingles=$_REQUEST['dsmingles'];
			$dsdingles=$_REQUEST['dsdingles'];

					include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
					$dsm=$_REQUEST['dsm'];
					$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$dsruta=limpieza(strtolower($dsm));
					$dsrutaingles=limpieza(strtolower($dsmingles));
					$sql=" update $tabla set ";
					$sql.="dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsmingles='$dsmingles'";
					$sql.=",dsdingles='$dsdingles'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsruta='".$dsruta."'";
					$sql.=",dsrutaingles='".$dsrutaingles."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					//exit;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../".$pruta."/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						$mensajes=$men[7];
						$error=0;

					} else {
						$mensajes=$men[7];
						$error=1;

					}
					}
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsd,a.dsimg,a.dsmingles,a.dsdingles";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsd=$result->fields[3];
$dsimg=$result->fields[4];
$dsmingles=$result->fields[5];
$dsdingles=$result->fields[6];




?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<?
$titulocampo="Titulo";
$campo="dsm";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsm;
$mensaje_capa="Debe ingresar  la pagina";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");


if($activadoing==1){
$titulocampo="Titulo en ingles";
$campo="dsmingles";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsmingles;
$mensaje_capa="Debe ingresar  la pagina";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");
}


$titulocampo="Descripci&oacute;n  ";
$campo="dsd";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd;
$mensaje_capa="Debe ingresar la descripcion de la pagina";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

if($activadoing==1){
$titulocampo="Descripci&oacute;n en ingles ";
$campo="dsdingles";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsdingles;
$mensaje_capa="Debe ingresar la descripcion de la pagina";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");
}

//if($idpos==1 || $idpos==2) {
$titulocampo="Imagen 279 x 156";
$campo="dsimg";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsimg;
$mensaje_capa="Debe ingresar la Imagen Pagina";
$tipocampo=4;
$narchivoanterior="archivoanterior";
$carchivoanterior="img";
$borrararchivo="borrar";
$tipoarchivo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

//}




$titulocampo="posicion";
$campo="idpos";
$contadorx="counter_$campo";


$tam=2;$valorx="5";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$idpos;
$mensaje_capa="Debe ingresar  la pagina";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Activar";
$valores="1-SI;2-NO";
$campo="idactivo";

$valorcampo=$idactivo;
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");

?>


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?
} // fin si
$result->Close();
?>
<br>
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
