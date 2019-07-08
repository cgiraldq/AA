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
include("../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuraci&oacute;n de tipos de actividades";
$rr="gestiones/default.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla="crmtblactividades";
$rutaImagen="../../../contenidos/images/empresa/";

			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
				} elseif ($_REQUEST['img1']<>"") {
				$nombre1=$_REQUEST['img1'];
				}
				if ($_REQUEST['borrar1']==1) $nombre1="";


			$dsnombre=$_REQUEST['dsnombre'];
      $dsd=$_REQUEST['dsd'];
			$idactivo=$_REQUEST['idactivo'];
			$idpos=$_REQUEST['idpos'];



			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsnombre'";
            $sql.=",dsd='$dsd'";
					$sql.=",idactivo='$idactivo'";
					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql)) $mensajes=$men[6];
			}

?>
<html>
  <?include("../../incluidos_modulos/head.php");?>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select dsm,dsd,idactivo,idtipo from $tabla";
$sql.=" where id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href='default.php' target='_top' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='../core/default.php' target='_top' class='textlink'>Principal</a>  /";
	$rr="../core/default.php"; // hacia donde regresa
}
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$dsnombre=$result->fields[0];
$dsd=$result->fields[1];
$idactivo=$result->fields[2];
$idpos=$result->fields[3];


?>
<? include("../../incluidos_modulos/encabezado.editar.php");?>
<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td><input type=text name=dsnombre size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombre')" value="<? echo $dsnombre?>">
<?
$nombre_capa="capa_dsnombre";
$mensaje_capa="Debe ingresar el nombre";
include("../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>Activo</td>

	<td>
		<select name="idactivo" class="textnegro2">
				<option value="1" <? if($idactivo==1)echo 'selected'?>  >SI</option>
				<option value="2" <? if($idactivo==2)echo 'selected'?> >NO</option>

			</select>
	</td>
</tr>






<tr>
<td align="center" colspan="2">
<?
$forma="u";
$param="dsnombre";
$rr="default.php"; // hacia donde regresa
include("../../incluidos_modulos/botones.modificar.php");?>
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
  include("../../incluidos_modulos/navegador.principal.cerrar.php");

include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
