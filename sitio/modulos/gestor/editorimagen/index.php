<?
	session_cache_limiter('public');
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

	include('incluidos/functions.php');
	$titulomodulo="Editor de imagenes";
	$rutaImagen="../../../contenidos/images/empresa/";

if($_REQUEST['inn']<>""){
	$ext=getExtension($_FILES['imagen']['name']);
	if($ext=="JPG" || $ext=="PNG" || $ext=="GIF"){
		$temp_name = $_FILES['imagen']['tmp_name'];
		$nombre1=$_FILES['imagen']['name'];
		move_uploaded_file($temp_name,$rutaImagen.$nombre1);
		//$dsimg=$_FILES['imagen']['name'];
		//$size = getImageSize($rutaImagen . $nombre1);//obtener el tamaño de la imagen
		if($ext=="PNG")$image = imagecreatefrompng($rutaImagen.$nombre1);
		if($ext=="GIF")$image = imagecreatefromgif($rutaImagen.$nombre1);
		if($ext=="JPG")$image = imagecreatefromjpeg($rutaImagen.$nombre1);
		/*$crop = imagecreatetruecolor($size[0],$size[1]);
		echo $image;
		imagecopy($crop, $image, 0, 0, 0, 0, $size[0], $size[0]);*/
		$dsimg=date("ymdhis").".jpg";
		imagejpeg($image,$rutaImagen.$dsimg, 80);
		//exit();
		$img_size = getImageSize($rutaImagen . $dsimg);//obtener el tamaño de la imagen
		set_dpi($rutaImagen.$dsimg);
		//$file=$rutaImagen . $dsimg;
		//

		//print_r(get_dpi($rutaImagen.$dsimg));


	}elseif ($_FILES['imagen']['name']==""){
		?>
			<script>
				alert("Debe seleccionar una imagen");
				//location.href="openfile.php";
			</script>
		<?
	}else{
		?>
		<script>
			alert("Archivo no valido. Extension "+"<? echo getExtension($_FILES['imagen']['name']);?>");
			//location.href="openfile.php";
		</script>
		<?
	}

}
//http://www.prosoxi.com/2011/05/05/image-fun-with-php/
//http://www.pympy.com/editor-imagenes.php
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<link href="estilo/stylesheet.css" rel="stylesheet" type="text/css">
<script language="javascript">
var imgorg="<? echo $dsimg;?>";//imagen original
var ruta='<? echo $rutaImagen?>';
var posicionimg=0;
var imgRatio='<?php if($img_size<>""){echo  $img_size[0]/$img_size[1];} ?>';
</script>
<script src="javascript/jquery-1.3.2.min.js" language="javascript" type="text/javascript"></script>
</head>

<body onload="loadJPIE('<? echo $dsimg?>')" color=#ffffff  topmargin=0 leftmargin=0>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>

<?
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal' target='_top'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

?>

<div id="JPIE_toolbar" style="margin-top:10px;">
<table border="0" width="100%">
	<tr>
		<td>
		</td>
		<td align="center">
		<span><a href="javascript:mostrarcapa('1','3');"><img src="icons/open.gif" title="Abrir imagen"></a></span><!-- para abrir las imagenes -->
		<span><a href="javascript:saveImage('<? echo "../".$rutaImagen?>');mostrarcapa('0','3')"><img src="icons/save.gif" title="Guardar imagen"></a></span>
		<span><a href="javascript:crop('<? echo "../".$rutaImagen?>');mostrarcapa('0','3')"><img src="icons/crop.gif" title="Cortar imagen"></a></span>
		<span><a href="javascript:undo();mostrarcapa('0','3')"><img src="icons/undo.gif" title="Deshacer"></a></span>
		<span><a href="javascript:redo();mostrarcapa('0','3')"><img src="icons/redo.gif" title="Rehacer"></a></span>
		<span><a href="javascript:rotate('<? echo "../".$rutaImagen?>',90);mostrarcapa('0','3')"><img src="icons/izquierda.gif" title="Girar izquierda"></a></span>
		<span><a href="javascript:rotate('<? echo "../".$rutaImagen?>',-90);mostrarcapa('0','3')"><img src="icons/derecha.gif" title="Girar derecha"></a></span>
		<span><a href="javascript:mostrarcapa('3','3');"><img src="icons/brightness_contrast.gif" alt="Ajustar brillo y contraste"></a></span><!--TODO-->
		<span><a href="javascript:gray('<? echo "../".$rutaImagen?>');mostrarcapa('0','3')"><img src="icons/brightness_contrast.gif" alt="Escala de gris"></a></span><!--TODO-->
		<span><a href="javascript:bordes('<? echo "../".$rutaImagen?>');mostrarcapa('0','3')"><img src="icons/brightness_contrast.gif" alt="Deteccion bordes"></a></span><!--TODO-->
		<span><a href="javascript:suavizar('<? echo "../".$rutaImagen?>');mostrarcapa('0','3')"><img src="icons/brightness_contrast.gif" alt="Deteccion bordes"></a></span><!--TODO-->
		<span><a href="javascript:mostrarcapa('2','3');"><img src="icons/resize.gif" title="Cambiar tamaño"></a></span>
		<!--span><a href="javascript:trans();"><img src="brightness_contrast.gif" title="Cambiar tamaño"></a></span-->
		</td>
		<td width="10%">
		</td>
	</tr>
</table>
</div>
<br />
<!-- subir imagen -->
<div id="1" style="display:none">
<form name="editor" action="index.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="imagen" class="text">&nbsp;<input type="submit" value="Cargar Imagen para editar" class="text">
		<input type="hidden" name="inn" value="1">
</form>
</div>
<!-- ajustar ancho y alto de la imagen -->
<div id="2" style="display:none">
<table class="text1">
		<tr>
			<td>Ancho / Width:</td>
			<td><input type="text" class="textnegro" name="x_scale" size="5" id="x_scale" value="" onKeyUp="changeSize('w');" onkeypress="return misdatos(event)"> px</td>
		</tr>
		<tr>
			<td>Alto / Height:</td>
			<td><input type="text" class="textnegro" name="y_scale" size="5" id="y_scale" value="" onKeyUp="changeSize('h');"> px</td>
		</tr>
	</table>
	<div>
		<input type="checkbox" value="1" id="proportional" checked /> Mantener relacion de tamaño
	</div>
	<input type="button" class="text" name="resize" value="Cambiar tamaño" onClick="resizex('<? echo "../".$rutaImagen?>');">
	<input type="button" class="text" name="cancel" value="Cancelar" onClick="document.getElementById('2').style.display='none';">
</div>
<!-- ajustar brillo y contraste -->

<div id="3" style="display:none">

<table border="0" cellspacing="20" class="text1">
<tr>
<td align="center">Brillo:</td>
<td align="center">Contrasate:</td>
</tr>
<tr>
<td style="text-align:center;height:30px;width:200px;background-image:url('icons/bg-fader2.gif');background-repeat:no-repeat" id="barrabrillo" onclick="mouseCoordsx(event,'<? echo "../".$rutaImagen?>');">
<img src="icons/thumb-n.gif" id="imgbrillo" style="position:absolute">
</td>

<td style="text-align:center;width:200px;background-image:url('icons/bg-fader2.gif');background-repeat:no-repeat" id="barrabrilloc" onclick="mouseCoordsc(event,'<? echo "../".$rutaImagen?>');">
<img src="icons/thumb-n.gif" id="imgcontraste" style="position:absolute">
</td>

</tr>
</table>

</div>
<br />
		<span id="statusBar">
				<!-- muestra la posicion donde esta ubicado el mause -->
				<span id="info1"></span>
				<span id="info2"></span>
		</span>

<table class="tabla" border="1">
	<tr>
		<td valign="top">
			<div id="canvas" style="display:none;width:<? echo $img_size[0]?>px;" onmouseout="ocultar()" >
				<img id="mainImage">
			<div id="coordenadas" style="position:absolute">
			</div>
			</div>
		</td>
	</tr>
</table>
<br>
<script src="javascript/functions.js" language="javascript" type="text/javascript"></script>
<?
			include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>

