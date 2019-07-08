<?php
	include('functions.php');
	$new_width = $_GET['w'];
	$new_height = $_GET['h'];
	$filename =  $_GET['src'];
	$ruta =  $_GET['ruta'];
	//$src_img = imagecreatefromjpeg(TMP_IMAGE_PATH . $filename);
	if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
	$src_img= imagecreatefromjpeg($ruta .$filename);
	}
	/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
	$src_img= imagecreatefrompng($ruta .$filename);
	}
	if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
	$src_img= imagecreatefromgif($ruta .$filename);
	}*/

	$thumb = ImageCreateTrueColor($new_width,$new_height);
	$size=GetImageSize($ruta . $filename);
	
	ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
	
	//Get the next name	
	$ext = strtolower(substr(($t=strrchr($filename,'.'))!==false?$t:'',1));
	$i=1;
	while (file_exists($ruta . $filename)) {
	 	if (strrpos($filename,"(")) {
			$filename = substr($filename, 0,strrpos($filename,"("))."(".$i.").".$ext;
		} else {
			$filename = substr($filename, 0,strrpos($filename,"."))."(".$i.").".$ext;			
		}
			
		$i++;
	}
	
	// Save the image
	//ImageJPEG($thumb,TMP_IMAGE_PATH . $filename);
	if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
	// Save the image
	ImageJPEG($thumb,$ruta .$filename,$calidad);
	}
	set_dpi($ruta.$filename);
	/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
	// Save the image
	ImagePNG($thumb,$ruta .$filename);
	}
	if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
	// Save the image
	ImageGIF($thumb,$ruta .$filename);
	}*/

	
	// Print the name
	echo $filename;
?>