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

$titulomodulo="Configuraci&oacute;n de documentaci&oacute;n zona privada";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tbldocumentos_zona";

$rutaImagen=$rutxx."../../../contenidos/images/documentacion/";





			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsruta = str_replace(' ', '_', $dsm);
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$paso=$_REQUEST['paso'];
			$dsd2=$_REQUEST['dsd2'];
			$dsfecha=$_REQUEST['dsfecha'];
			if ($paso=="1") {


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dsruta='$dsruta'";
					$sql.=" ,dsd='$dsd'";
					$sql.=" ,dsfecha='$dsfecha'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",idpos=$idpos";
					$sql.=",dsd2='$dsd2' ";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					//exit;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/documentacion/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");


						$mensajes=$men[7];
					}
					}

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsd,a.dsimg,a.dsd2,dsfecha";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsd=$result->fields[3];
$dsimg=$result->fields[4];
$dsd2=$result->fields[5];
$dsfecha=$result->fields[6];



?>
<br>
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




$titulocampo="Descripci&oacute;n  ";
$campo="dsd";
$contadorx="counter_$campo";
$tam=60;$valorx="200";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd;
$mensaje_capa="Debe ingresar la descripcion de la pagina";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Fecha de creaci&oacute;n ";
$campo="dsfecha";
$contadorx="counter_$campo";
$tam=60;$valorx="200";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsfecha;
$mensaje_capa="Debe ingresar la fecha";
$tipocampo=5;
$imgcalendario="../../../img_modulos/modulos/calendario.gif";
include($rutxx."../../incluidos_modulos/control.texto.php");
/*$titulocampo="Descripci&oacute;n larga ";
$campo="dsd2";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd2;
$mensaje_capa="Debe ingresar la descripcion larga de la pagina";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");*/



//if($idpos==1 || $idpos==2) {
$titulocampo="Subir documento";
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
$tipoarchivo=2;
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
$valores="1-SI;2-NO;3-Zona Privada";
$campo="idactivo";
$valorcampo=$idactivo;
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");

?>


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,idpos";
$activareditor=2; // incluye el botton de activar editor de texto cuando es igual a 1

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
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
