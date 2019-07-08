<?
// constructor del landingpage
	$rutaCopiar=$carpeta;
	//exit();
	if (is_file($rutaCopiar."/".$dsarchivo)) unlink($rutaCopiar."/".$dsarchivo);
	$dsruta=$carpeta."/".$dsarchivo;
	$gestor=fopen($rutaCopiar."/".$dsarchivo,"w+");
	 $cuerpo="<?";
	 $cuerpo.="$";
	 $cuerpo.="id='".$idr."';";
	 $cuerpo.="$include;";
	 $cuerpo.="?>";
	    fwrite($gestor,$cuerpo);// crear
	    fclose($gestor);
	   /* fin construccion*/
?>