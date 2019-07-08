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


$titulomodulo="Listado de autores del sitio";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla=$prefix."blogtblautores";
$rutaImagen=$rutxx."../../../contenidos/images/blog/";

			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];
			$dsvideo=$_REQUEST['dsvideo'];

			$dstitulo=$_REQUEST['dstitulo'];
			$dskw=$_REQUEST['dskw'];
			$dskwin=$_REQUEST['dskwin'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dstit=$_REQUEST['dstit'];
			$paso=$_REQUEST['paso'];

			$dsd2ingles=$_REQUEST['dsd2ingles'];

			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd2='$dsd2'";
					$sql.=",dstitulo='$dstitulo'";
					$sql.=",dsvideo='$dsvideo'";

					$sql.=",dsd2ingles='$dsd2ingles'";


					$sql.=",dsimg1='".$imgvec[0]."'";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico $titulomodulo";
						$sql.=",idactivo=$idactivo";
						$error=0;

						$dsruta="../paginas/default.php";
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
$sql="select a.dsm,a.idpos,a.idactivo,a.dstit,a.dsd,a.dsimg1,a.dsd2,a.dskw,a.dsvideo,a.dstitulo,a.dsd2ingles ";
$sql.=" from $tabla a where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' target='_top' class='textlink'>Principal</a>  / <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dstit=$result->fields[3];
$dsd=$result->fields[4];
$dsimg1=$result->fields[5];
$dsd2=$result->fields[6];
$dskw=$result->fields[7];
$dsvideo=$result->fields[8];
$dstitulo=$result->fields[9];
$dsd2ingles=$result->fields[10];
?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


<?
$titulocampo="Nombre";
$campo="dsm";
$contadorx="counter_$campo";


$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsm;
$mensaje_capa="Debe ingresar el nombre";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");




$titulocampo="Descripci&oacute;n";
$campo="dsd2";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd2;
$mensaje_capa="Debe ingresar la descripcion ";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

if($activadoing==1){
$titulocampo="Descripci&oacute;n en ingles";
$campo="dsd2ingles";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd2ingles;
$mensaje_capa="Debe ingresar la descripcion ";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");
}

$titulocampo="Imagen asociada al autor";
$campo="dsimg1";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsimg1;
$mensaje_capa="Debe ingresar la Imagen";
$tipocampo=4;
$narchivoanterior="archivoanterior1";
$carchivoanterior="img1";
$borrararchivo="borrar1";
$tipoarchivo=1;
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
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?} // fin si
$result->Close();
?>
<br>
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>