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
			$dsruta=limpieza(strtolower($dsm));

			$sql="insert into $tabla (dsm,idpos,idactivo,dsruta,idcategoria)";
			$sql.=" values ('$dsm',$idpos,$idactivo,'$dsruta','$idcat') ";
			//echo $sql;
			//exit();
			if ($db->Execute($sql))  {
				$error=0;

				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../blog/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");

			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
				$error=1;

			}
		 }
		 $result->close();
}
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$dsruta=limpieza(strtolower($_REQUEST['dsm_'][$j]));

					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsruta='".$dsruta."'";

					$sql.= ",idcategoria='".$_REQUEST['idcategoria_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;


				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];

?>
