<?
	$idr=$_REQUEST['idr'];
	if ($idr<>"") {
		$sql=" update $tabla set idactivo=1 WHERE id='$idr' ";
		if ($db->Execute($sql))  {
			$error=0;
			$mensajes="<strong>".$men[6]."</strong>";
			$dstitulo="Restauracion $titulomodulo2";
			$dsdesc=" El usuario ".$_SESSION['i_dslogin']." restauro un registro";
			include($rutxx."../../incluidos_modulos/logs.php");
		}
	}

?>