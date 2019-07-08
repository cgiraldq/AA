<?
	$idx=$_REQUEST['idx'];
	/// capturar ruta
	$partirru=explode("/",$_SERVER['SCRIPT_FILENAME']);
	$total=count($partirru);
	$dsrutap="../".$partirru[$total-3]."/".$partirru[$total-2]."/".$partirru[$total-1];
	$dsruta=$dsrutap;
	if ($idx<>"") {
		$sql=" update $tabla set idactivo=9 WHERE id='$idx' ";
		if ($db->Execute($sql))  {
			$mensajes="<strong>".$men[3]."</strong>";
			$dstitulo="Eliminacion $titulomodulo";
			$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino un registro";
			$dsruta=$dsrutap;
			include($rutxx."../../incluidos_modulos/logs.php");
			$error=0;
		}
	}

?>