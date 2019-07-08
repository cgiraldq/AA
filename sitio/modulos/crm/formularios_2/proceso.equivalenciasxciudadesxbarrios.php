<?

 $idtipoformulario=$_REQUEST["idx2"];
 $dsm=$_REQUEST["dsm"];
if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idcampo='$idx' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo,idcampo,idtipoformulario,idcodigo,idwebservice,idsubcampo,idbarrio)";
			$sql.=" values ('$dsm','$idpos','$idactivo','$idx',$idtipoformulario,'$idcodigo','$idweb','$idx3','$idx4') ";
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
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",idcodigo='".$_REQUEST['idcodigo_'][$j]."'";
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",idwebservice='".$_REQUEST['idweb_'][$j]."'";

					//$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					//$sql.= ",dsvalor=".$_REQUEST['dsvalor_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for


		if ($h>0) $mensajes=$men[4];

		if ($_REQUEST['idx']<>"") {

	$sql="delete from $tabla where id=".$_REQUEST['idy'];
	$db->Execute($sql);
	 $mensajes=$men[4];
}
?>

