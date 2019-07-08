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
$titulomodulo="Configuraci&oacute;n de la empresa autorizada";
$rr="empresa/empresa.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla=$prefix."tblempresa";
$rutaImagen=$rutxx."../../../imagenes/empresa/";

			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);	move_uploaded_file($temp_name,$rutaImagen.$nombre1);
} elseif ($_REQUEST['img1']<>"") {
$nombre1=$_REQUEST['img1'];
}
if ($_REQUEST['borrar1']==1) $nombre1="";


			$robots=$_REQUEST['robots'];
			$abstract=$_REQUEST['abstract'];
			$author=$_REQUEST['author'];
			$copyright=$_REQUEST['copyright'];
			$rating=$_REQUEST['rating'];
			$replyto=$_REQUEST['reply'];
			$creationdate=$_REQUEST['creation'];
			$docrights=$_REQUEST['doc'];
			$title=$_REQUEST['title'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" robots='$robots'";
					$sql.=",author='$author'";
					$sql.=",abstract='$abstract'";
					$sql.=",copyright='$copyright'";
					$sql.=",rating='$rating'";
					$sql.=",replyto='$replyto'";
					$sql.=",creationdate='$creationdate'";
					$sql.=",docrights='$docrights'";
					$sql.=",title='$title'";
					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql)) $error=0; $mensajes=$men[6];
			}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.robots,a.abstract,a.author,a.copyright,a.rating,a.replyto,a.creationdate,a.docrights,a.title";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";


$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href=' $rutxx../root/default.php' class='textlink'>Principal</a>  /";
	$rr="../empresa/empresa.php"; // hacia donde regresa
} else {
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink'>Principal</a>  /";
	$rr="../empresa/empresa.php"; // hacia donde regresa
}



$rutamodulo.=" <span class='text1'><a href='../empresa/empresa.php' class='textlink'>".$titulomodulo."</a> / Posicionamiento </span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$robots=$result->fields[0];
$abstract=$result->fields[1];
$author=$result->fields[2];
$copyright=$result->fields[3];
$rating=$result->fields[4];
$reply=$result->fields[5];
$creation=$result->fields[6];
$doc=$result->fields[7];
$title=$result->fields[8];
?>

<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Nombre title por defecto</td>
<td><input type=text name=title size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_title')" value="<? echo $title ?>">
<?
$nombre_capa="capa_title ";
$mensaje_capa="Debe ingresar la etiqueta title por defecto";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Robots</td>
<td><input type=text name=robots size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_robots')" value="<? echo $robots?>">
<?
$nombre_capa="capa_robots";
$mensaje_capa="Debe ingresar la etiqueta robots";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Abtract</td>
<td><input type=text name=abstract size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_abstract')" value="<? echo $abstract?>">
<?
$nombre_capa="capa_abstract";
$mensaje_capa="Digite el la etiqueta abstract";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Author</td>
<td><input type=text name=author size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_author')" value="<? echo $author?>">
<?
$nombre_capa="capa_dstel1";
$mensaje_capa="digite la etiqueta author";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Copyright</td>
<td><input type=text name=copyright size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_copyright')" value="<? echo $copyright?>">
<?
$nombre_capa="capa_copyright";
$mensaje_capa="Digite la etiqueta copyright";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Rating</td>
<td><input type=text name=rating size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_rating')" value="<? echo $rating?>">
<?
$nombre_capa="capa_rating";
$mensaje_capa="Digite la etiqueta rating";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>


</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Reply-to</td>
<td><input type=text name=reply size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_reply')" value="<? echo $reply?>">
<?
$nombre_capa="capa_reply";
$mensaje_capa="Digite la etiqueta reply-to";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Creation-date</td>
<td><input type=text name=creation size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_creation')" value="<? echo $creation?>">
<?
$nombre_capa="capa_creation";
$mensaje_capa="Digite la etiqueta creation-date";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Doc-rights</td>
<td><input type=text name=doc size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_doc')" value="<? echo $doc?>">
<?
$nombre_capa="capa_doc";
$mensaje_capa="Digite la etiqueta doc-rights";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr><td align="center" colspan="2">

<?
$forma="u";
$param="robots,abstract,author,copyright,rating,reply,creation,doc";
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