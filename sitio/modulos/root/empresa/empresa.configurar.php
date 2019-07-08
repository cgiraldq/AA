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

$rc4 = new rc4crypt();
$titulomodulo="Configuraciones especiales";
$rr="empresa.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla="tblempresa";
$rutaImagen=$rutxx."../../../contenidos/images/empresa/";


			$dsrutaimagen=$_REQUEST['dsrutaimagen'];
			$dsrutalocal=$_REQUEST['dsrutalocal'];
			$dsrutamiga=$_REQUEST['dsrutamiga'];
			$dsstat=$_REQUEST['dsstat'];

			$dsdominio=$_REQUEST['dsdominio'];
			$codcliente=$_REQUEST['codcliente'];
			//$dsrutaimagenlocal=$_REQUEST['dsrutaimagenlocal'];
			$dsrutaservidor=$_REQUEST['dsrutaservidor'];

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsrutaimagen='$dsrutaimagen'";
					$sql.=",dsrutalocal='$dsrutalocal'";
					$sql.=",dsrutamiga='$dsrutamiga'";
					$sql.=",dsstat='$dsstat'";
					$sql.=",dsdominio='$dsdominio'";
					$sql.=",codcliente='$codcliente'";
					//$sql.=",dsrutaimagenlocal='$dsrutaimagenlocal'";
					$sql.=",dsrutaservidor='$dsrutaservidor'";

					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						$error=0;
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de destacado index";
						$dsruta="../root/empresa.php";
						include($rutxx."../../incluidos_modulos/logs.php");
									//
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");

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
$sql="select dsrutaimagen,dsrutalocal,dsrutamiga,dsstat,dsrutaservidor,dsdominio,codcliente";
$sql.=" from $tabla ";
$sql.=" where id=$idx ";

//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href=' $rutxx../root/default.php' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink'>Principal</a>  /";
	$rr="../empresa/empresa.php"; // hacia donde regresa
}
$rutamodulo.=" <span class='text1'><a href='../empresa/empresa.php' class='textlink'>".$titulomodulo."</a> / Editar empresa</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsrutaimagen=$result->fields[0];
$dsrutalocal=$result->fields[1];
$dsrutamiga=$result->fields[2];
$dsstat=$result->fields[3];
$dsrutaservidor=$result->fields[4];
$dsdominio=$result->fields[5];
$codcliente=$result->fields[6];

?>
<br>

	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo Cliente para Sistema Tickets Comprandofacil S.A</td>
<td><input type=text name=codcliente size=15 maxlength="30" class=text1 onKeyPress="ocultar('capa_codcliente')" value="<? echo $codcliente?>">
<?
$nombre_capa="capa_codcliente";
$mensaje_capa="Debe ingresar el codigo";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ruta de las imagenes</td>
<td><input type=text name=dsrutaimagen size=105 maxlength="255" class=text1 onKeyPress="ocultar('dsrutaimagen')" value="<? echo $dsrutaimagen?>">
<?
$nombre_capa="capa_dsrutaimagen";
$mensaje_capa="Debe ingresar la ruta de las imagenes";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>




<!--tr valign=top bgcolor="#FFFFFF">
<td>Rutas absoluta de las rutas amigas</td>
<td><input type=text name=dsrutaservidor size=100 maxlength="250" class=text1 onKeyPress="ocultar('capa_dsrutaservidor')" value="<? echo $dsrutaservidor?>">
<?
$nombre_capa="capa_dsrutaservidor";
$mensaje_capa="Digite las rutas";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr-->

<tr valign=top bgcolor="#FFFFFF">
<td>Rutas absoluta de las rutas amigables</td>
<td><input type=text name=dsrutalocal size=100 maxlength="250" class=text1 onKeyPress="ocultar('capa_dsrutalocal')" value="<? echo $dsrutalocal?>">
<?
$nombre_capa="capa_dsrutalocal";
$mensaje_capa="Digite las rutas";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr  valign=top bgcolor="#FFFFFF">
	<td>Activar rutas amigables</td>
	<td>
		  <select name="dsrutamiga" class="textnegro">
			<option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
			<option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
		  </select>
	</td>

</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo Google Analitycs para estadisticas</td>
<td><input type=text name=dsstat size=15 maxlength="30" class=text1 onKeyPress="ocultar('capa_dsstat')" value="<? echo $dsstat?>">
<?
$nombre_capa="capa_dsstat";
$mensaje_capa="Debe ingresar el codigi";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Dominio para Google Analitycs para estadisticas</td>
<td><input type=text name=dsdominio size=15 maxlength="30" class=text1 onKeyPress="ocultar('capa_dsdominio')" value="<? echo $dsdominio?>">
<?
$nombre_capa="capa_dsdominio";
$mensaje_capa="Debe ingresar el dominio";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr>

	<td align="center" colspan="2">
<?
$forma="u";
$param="dsrutamiga";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td>
</tr>
</form>
</table>


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



