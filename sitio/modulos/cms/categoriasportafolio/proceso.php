<?
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
				$error=1;

		 } else {
		 	// insertar
		 	$dsrutax=limpieza(strtolower($dsm));
			$sql="insert into $tabla (dsm,idpos,idactivo,dsruta)";
			$sql.=" values ('$dsm',$idpos,$idactivo,'$dsrutax') ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../cms/categoriasportafolios/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
				$error=0;






			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
				$error=1;

			}
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
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";

					$dsrutax=limpieza(strtolower($_REQUEST['dsm_'][$j]));
					//$dsrutax=limpieza(strtolower($dsruta));

					$sql.= ",dsruta='".$dsrutax."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;

					if ($db->Execute($sql)) $h++;


				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
