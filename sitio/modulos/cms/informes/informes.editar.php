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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");


$titulomodulo="Configuraci&oacute;n de informes estad&iacute;sticos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblinformes";

$tablarelaciones2="tblempresaxtbltextozona";
$tablaorigen2="tblempresa";

$rutaImagen=$rutxx."../../../contenidos/images/documentos/";

			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=", dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
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
						$dsruta="../linksrecomendados/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");


					}	else {
						$mensajes=$men[7];
					}
					}

?>
<html>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsimg,a.dsd";
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
$dsimg=$result->fields[3];
$dsd=$result->fields[4];


?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<?
$titulocampo="Titulo del informe";
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

$titulocampo="Descripci&oacute;n<br> del documento";
$campo="dsd";
$contadorx="counter_$campo";
$tam=60;$valorx="2000";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsd;
$mensaje_capa="Debe ingresar la descripcion";
$tipocampo=2;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="posicion";
$campo="idpos";
$contadorx="counter_$campo";
$tam=2;$valorx="5";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$idpos;
$mensaje_capa="Debe ingresar  la posicion";
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
<? include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
