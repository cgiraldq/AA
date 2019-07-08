<?

 $idtipoformulario=$_REQUEST["idx2"];
 $tipoform=$_REQUEST["tipoform"];
  $dsmcampox=$_REQUEST["dsmcampox"];


if ($tipoform<>"" && $dsmcampox<>"" && $_REQUEST['editar']=="") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$tipoform' and dsvalor='$dsmcampox' and idtipoformulario='idtipoformulario' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idcampo,idtipoformulario,dsvalor)";
			$sql.=" values ('$tipoform','$idx',$idtipoformulario,'$dsmcampox') ";
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$i_dsnombre." Ingreso un nuevo registro $dsm";
				$dsruta="../redes/default.php";


			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
			//echo $sql;
				//exit();
		 }
		 $result->close();
}

// modificacion rapida
		
		$h=0;
	
				if ($_REQUEST['tipoform']<>"" && $_REQUEST['dsmcampox']<>"" && $_REQUEST['editar']==1){
					$sql=" update $tabla set ";
					$sql.= "dsm='".$_REQUEST['tipoform']."'";
					$sql.= ",dsvalor='".$_REQUEST['dsmcampox']."'";
	
					$sql.= " where id='".$_REQUEST['idregistro']."';";
//					echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
		


		if ($h>0) $mensajes=$men[4];

		if ($_REQUEST['idx']<>"") {

	$sql="delete from $tabla where id=".$_REQUEST['idy'];
	$db->Execute($sql);
	 $mensajes=$men[4];
}
?>

