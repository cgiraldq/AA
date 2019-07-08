<?php
	include('functions.php');
	$ruta=$_GET['ruta'];
	$w=$_GET['w'];
	$h=isset($_GET['h'])?$_GET['h']:$w;    // h est facultatif, =w par défaut
	$x=isset($_GET['x'])?$_GET['x']:0;    // x est facultatif, 0 par défaut
	$y=isset($_GET['y'])?$_GET['y']:0;    // y est facultatif, 0 par défaut
	$filename =  $_GET['src'];
	if($_REQUEST['val']==1){//validar si la seleccion fue hacia arriba que retome el valos de las posiciones
		$x=$x-$w;
		$y=$y-$h;
	}
	/*imagecreatefromgif
	imagecreatefrompng*/
	if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
	$image = imagecreatefromjpeg($ruta .$filename);
	}
	/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
	$image = imagecreatefrompng($ruta .$filename);
	}
	if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
	$image = imagecreatefromgif($ruta .$filename);
	}*/

	
	$crop = imagecreatetruecolor($w,$h);
	imagecopy($crop, $image, 0, 0, $x, $y, $w, $h );
	
	//Get the next name	
	$ext = strtolower(substr(($t=strrchr($filename,'.'))!==false?$t:'',1));
	$i=1;
	while (file_exists($ruta . $filename)) {//si el nombre de la imagen ya exite le pone otro nombre
	 	if (strrpos($filename,"(")) {
			$filename = substr($filename, 0,strrpos($filename,"("))."(".$i.").".$ext;
		} else {
			$filename = substr($filename, 0,strrpos($filename,"."))."(".$i.").".$ext;			
		}	
		$i++;
	}
	if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
	// Save the image
	ImageJPEG($crop,$ruta .$filename,$calidad);
	}
	set_dpi($ruta.$filename);
	/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
	// Save the image
	ImagePNG($crop,$ruta .$filename);
	}
	if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
	// Save the image
	ImageGIF($crop,$ruta .$filename);
	}*/
	

	// Print the name
	echo utf8_encode($filename);
?>