<?php

//**************** MUESTRA LA EXTENSI�N DE UN FICHERO ****************** 
//Hay que comprobar que se le pasa un nombre de fichero y no un directorio.
date_default_timezone_set("America/Bogota");
$calidad=80;
function getExtension($fileName) { 	
 	$ext = substr($fileName, strrpos($fileName, '.') + 1);
 	return strtoupper ($ext);
}

function deleteDir($dir) {
   if (substr($dir, strlen($dir)-1, 1) != '/') 
       $dir .= '/';

   if ($handle = opendir($dir))
   {
       while ($obj = readdir($handle))
       {
           if ($obj != '.' && $obj != '..')
           {
               if (is_dir($dir.$obj))
               {
                   if (!deleteDir($dir.$obj)) {
                   		echo "Problema al eliminar un directorio";
                       return false;
                       }
               }
               elseif (is_file($dir.$obj))
               {
                   if (!unlink($dir.$obj)) {
                   	echo "Problema al eliminar el fichero fichero: " . $dir.$obj ;
                       return false;
                       }
               }
           }
       }

       closedir($handle);

       if (!@rmdir($dir))
           return false;
       return true;
   }
   return false;
}



// *************** Funcion para subir fichero al servidor. Si es una imagen JPG la redimensiona ************************
function uploadFile($fileName,$dirpath,$max_width,$max_height) { // (Nombre del fichero, directorio donde subirlo, anchura (s�lo jpg), altura (s�lo jpg))
	
		$ext = getExtension($fileName['file']['name']);
		//echo "extensi�n : " .$ext . "<br>";
	    if ($ext=="JPG" || $ext=="JPEG"){ // si se trata de fichero jpeg se les cambia el tama�o para que no ocupen demasiado
			$mensaje =  "<div class=\"infoMensaje\">El fichero \"" . $fileName['file']['name'] . "\" ha sido copiado correctamente.</div>";

			$size=GetImageSize($fileName['file']['tmp_name']);

			//Control del tama�o final de la imagen:
			
			$image_ratio = $size[0]/$size[1];
			if ($max_width =="" && $max_height == "") {
			 echo "tenemos ambas medidas";
	 			 $max_width = 400;
	 			 $max_height = 400;
			} else {
				if ($max_width != "" && $max_height == ""){
				 echo "Tenemos solo la altura";
					$max_height = $max_width / $image_ratio;
				}
				if ( $max_height != "" && $max_width == "") {
				 echo "Tenemos solo la anchura";
					$max_width = $max_height * $image_ratio;
				}			  
			}


			$width_ratio  = ($size[0] / $max_width);
			$height_ratio = ($size[1] / $max_height);
	
			if($width_ratio >= $height_ratio)
			{
			   $ratio = $width_ratio;
			}
			else
			{
			   $ratio = $height_ratio;
			}
	
			$new_width    = ($size[0] / $ratio);
			$new_height   = ($size[1] / $ratio);
	
			$src_img = ImageCreateFromJPEG($fileName['file']['tmp_name']);
			$thumb = ImageCreateTrueColor($new_width,$new_height);
			ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
			ImageJPEG($thumb,$dirpath.'/'. $fileName['file']['name']);
			chmod($dirpath.'/'.$fileName['file']['name'],  0777);
			ImageDestroy($src_img);
			ImageDestroy($thumb);
			unlink($fileName['file']['tmp_name']);
	
		} else { //Cualquier tipo de fichero	   
			$mensaje = "<div class=\"infoMensaje\">El fichero \"" . $_FILES['file']['name'] . "\" ha sido copiado correctamente.</div>";
			// echo $dirpath.'/'.  $_FILES['file']['name'];
			// echo $_FILES['file']['tmp_name'];
			
		   if(move_uploaded_file($_FILES['file']['tmp_name'],$dirpath.'/'.  $_FILES['file']['name'])) {
		    // echo "Magazine Updated!";
		   }
		   else
		   {
		     //echo "There was a problem when uploding the new file, please contact  about this.";
		     //print_r($_FILES);
		   }

			chmod($dirpath.'/'.$_FILES['file']['name'],  0777);			
		}
		return 1;
	}
	
	function get_next_name($filename,$ruta) {
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
	$i=1;
	return $filename;
}

function get_dpi($filename){   
  
    // open the file and read first 20 bytes.   
    $a = fopen($filename,'r');   
    $string = fread($a,20);   
    fclose($a);   
  
    // get the value of byte 14th up to 18th   
    $data = bin2hex(substr($string,14,4));   
    $x = substr($data,0,4);   
    $y = substr($data,4,4);   
    return array(hexdec($x),hexdec($y));   
  
}
function set_dpi($file){
	$dpi_x = 300; 
	$dpi_y = 300;
	$size = filesize ( $file ); 
	$image = file_get_contents ( $file ); 
	
	// Update DPI information in the JPG header 
	$image [ 13 ] = chr ( 1 ); 
	$image [ 14 ] = chr ( floor ( $dpi_x / 255 )); 
	$image [ 15 ] = chr ( $dpi_x % 255 ); 
	$image [ 16 ] = chr ( floor ( $dpi_y / 255 )); 
	$image [ 17 ] = chr ( $dpi_y % 255 ); 
	
	// Write the new JPG 
	$f = fopen ( $file , 'w+' ); 
	fwrite ( $f , $image  ); 
	fclose ( $f ); 
}
 

?>