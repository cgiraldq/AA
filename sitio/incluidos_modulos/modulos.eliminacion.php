<?
	$idx=$_REQUEST['idx'];
	if ($idx<>"") {
		$sql=" delete from $tabla WHERE id='$idx' ";
		if ($db->Execute($sql))  {
			$error=0;
			$mensajes="<strong>".$men[3]."</strong>";
			$dstitulo="Eliminacion $titulomodulo2";
			$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino un registro";
			include($rutxx."../../incluidos_modulos/logs.php");
		}
	}

?>