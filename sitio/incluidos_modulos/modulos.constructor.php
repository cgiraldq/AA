<?
	//if (!is_dir($rutaGeneral.$cuerpo)) mkdir($rutaGeneral.$carpeta);//crear carpeta
	$rutaCopiar=$rutaGeneral.$carpeta;
	//exit();
	if (is_file($rutaCopiar."/".$dsarchivo)) unlink($rutaCopiar."/".$dsarchivo);
	$dsruta=$carpeta."/".$dsarchivo;
	$gestor=fopen($rutaCopiar."/".$dsarchivo,"w+");
	 $cuerpo="<?";
	 $cuerpo.=" $";
	 if($idreg<>"")$cuerpo.="idc=".$idreg.";";//validar por idcategoria en ideas
	 $cuerpo.="$";
	 $cuerpo.="dsmc='".$dsmr."';";
	 $cuerpo.="$";
	 $cuerpo.="rutap=1;";
	 $cuerpo.="$";
	 $cuerpo.="idsub=".$idsubcategoria.";";
	 $cuerpo.="$";
	 $cuerpo.="idmarca=".$idmarca.";";
	 $cuerpo.="$include;";
	 $cuerpo.="?>";
	    fwrite($gestor,$cuerpo);// crear
	    fclose($gestor);
	   /* fin construccion*/
?>