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
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
$titulomodulo="Configuraci&oacute;n de tipos de motivos";
$rr="motivos/default.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla="crmtblmotivos";
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
			$idactivo=$_REQUEST['idactivo'];
			$idpos=$_REQUEST['idpos'];



			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsnombre='$dsnombre'";
					$sql.=",idactivo='$idactivo'";
					$sql.=",idpos='$idpos'";

					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql)) $mensajes=$men[6];
			}

?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select dsnombre,idactivo,idpos,dsd from $tabla";
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

$idactivo=$result->fields[1];
$idpos=$result->fields[2];

?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#CACAD0"><br />


<table width="70%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Edicion del registro seleccionado</td>
        </tr></table>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="text1" bgcolor="#CCCCCC">
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



<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos;?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe ingresar la Posici&oacute;n ";
include("../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>




<tr>
<td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
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
<!--<form name="probarcon" action="javascript:irAPaginaDN('pconexion.php')" method="post">
  <input type="hidden" value="" name="nombcorreo">
  <input type="hidden" value="" name="correo">
  <input type="hidden" value="" name="smtp">
  <input type="hidden" value="" name="usuario">
  <input type="hidden" value="" name="clave">
  <input type="hidden" value="" name="puerto">
</form>-->

<?

} // fin si
$result->Close();
?>
<br>
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>



