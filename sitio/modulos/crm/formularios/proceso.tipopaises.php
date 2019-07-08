<?
if ($dsm<>"") {
		$sql="select dsm ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {
		 	// insertar

			$sql="insert into $tabla (dsm,idactivo,dsvalor,idcampo,idtipoformulario)";
			$sql.=" values ('$dsm','$idactivo','$dsvalor','$idx','$idx2') ";
			//echo $sql;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$i_dsnombre." Ingreso un nuevo registro $dsm";
				$dsruta="../redes/default.php";
			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
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
					$sql.= ",name='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",iso3_code='".$_REQUEST['dsvalor_'][$j]."' ";
					$sql.= " where num_code=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

		if ($_REQUEST['idy']<>""){

	$sql="delete from $tabla where id=".$_REQUEST['idy'];

	//echo $sql;
	$db->Execute($sql);
	 $mensajes=$men[4];
}
?>

