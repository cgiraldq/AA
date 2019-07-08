<?
	$archivobaseimagen="";
	if($contImg=="")$contImg=1;
	if ($_FILES[$nombre]['name']<>"") {
		// borrar anterior
		$archivoanterior=$_REQUEST[$nombreant];
		if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
		$temp_name = $_FILES[$nombre]['tmp_name'];
		$imgnom=explode(".",$_FILES[$nombre]['name']);
		$nombreimg=strtolower(limpieza($imgnom[0]));
		$nombre1=$nombreimg."-".date("his")."-".$contImg.".".substr($_FILES[$nombre]['name'],-4);

		 $s_ext = pathinfo($_FILES[$nombre]['name'], PATHINFO_EXTENSION);
        $valido=permitir($s_ext);
        if ($valido==0) move_uploaded_file($temp_name,$rutaImagen.$nombre1);
	} elseif ($valimg<>"") {
	$nombre1=$valimg;
	}else $nombre1="";
	if ($borrar==1) $nombre1="";
	if ($gd==1) {
		$archivobaseimagen=$nombre1;
	} else {
	$imgvec[]=$nombre1;
	$contImg++;

	}
?>