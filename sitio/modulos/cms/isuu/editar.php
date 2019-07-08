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
//$db->debug=true;
$titulomodulo="Configuraci&oacute;n de isuu";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblisuu";
$carpeta="videos";
$rutaImagen=$rutxx."../../../contenidos/images/videos/";

			$nombre="dsimg";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


			$dsm=$_REQUEST['dsm'];
			$dsvideo=$_REQUEST['dsvideo'];
			$dsvideo2=$_REQUEST['dsvideo2'];
			$dsd=$_REQUEST['dsd'];
			$dsvideo3=$_REQUEST['dsvideo3'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsfecha=$_REQUEST['dsfecha'];

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
							$dsruta=limpieza(strtolower($dsm));



					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dsd='$dsd'";
					$sql.=" ,dsvideo='$dsvideo'";
					$sql.=" ,dsfecha='$dsfecha'";
					$sql.=" ,dsvideo2='$dsvideo2'";
					$sql.=" ,dsvideo3='$dsvideo3'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=" ,dsruta='".$dsruta."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					echo $sql;
					//exit;

					if ($db->Execute($sql))  {
						$error=0;

						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/videos/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
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
$sql="select a.dsm,a.idpos,a.idactivo,a.dsvideo,a.dsfecha,a.dsimg,a.dsvideo2,a.dsfecha,a.dsvideo3,a.dsd";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsvideo=$result->fields[3];
$dsfecha=$result->fields[4];
$dsimg=$result->fields[5];
$dsvideo2=$result->fields[6];
$dsfecha=$result->fields[7];
$dsvideo3=$result->fields[8];
$dsd=$result->fields[9];


?>

	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


<?
$titulocampo="T&iacute;tulo del isuu";
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




$titulocampo="C&oacute;digo del iframe";
$campo="dsvideo";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsvideo;
$mensaje_capa="Debe ingresar el video";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");


$titulocampo="Descripci&oacute;n";
$campo="dsd";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd;
$mensaje_capa="Debe ingresar la descripci&oacuten";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Subir documento";
$campo="dsimg";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsimg;
$mensaje_capa="Debe ingresar documento";
$tipocampo=4;
$narchivoanterior="archivoanterior";
$carchivoanterior="img";
$borrararchivo="borrar";
$tipoarchivo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Posici&oacute;n";
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
$valores="1-SI;2-NO;";//3-LATERAL;5-DESTACADO SECCION";
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
