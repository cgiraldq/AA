<?

// insercion
if ($dsm<>"" && $idpos<>"") { 
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else { 
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo)";
			$sql.=" values ('$dsm',$idpos,$idactivo) ";
			if ($db->Execute($sql))  { 
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de banner";
				$dsruta="../banners/default.php";
				include("../../../incluidos_modulos/logs.php");
			} else { 
				$error=0;
				$mensajes=$men[2].".<br><br>$sql";
			}	
		 }
		 $result->close();
}
// eliminacion
include("../../../incluidos_modulos/modulos.papelera.php");
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
						$dshorai=$_REQUEST['dshorai_'][$j];
						$dsminutoi=$_REQUEST['dsminutoi_'][$j];
						$dshoraf=$_REQUEST['dshoraf_'][$j];
						$dsminutof=$_REQUEST['dsminutof_'][$j];
						if($dshorai=="")$dshorai="00";
						if($dshoraf=="")$dshoraf="00";
						if($dsminutoi=="")$dsminutoi="00";
						if($dsminutof=="")$dsminutof="00";
						$dshorasi=$dshorai.":".$dsminutoi;
						$dshorasf=$dshoraf.":".$dsminutof;

					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsporcentaje='".$_REQUEST['dsporcentaje_'][$j]."'";
					if ($_REQUEST['dsfechai_'][$j]<>""){
						$sql.= ",dsfechai='".$_REQUEST['dsfechai_'][$j]."'";
						$idfechai=str_replace("/","",$_REQUEST['dsfechai_'][$j]);
						$sql.= ",idfechai='".$idfechai.$dshorai.$dsminutoi."'";
						$sql.=" ,dshorai='".$dshorasi."'";
					}

					if ($_REQUEST['dsfechaf_'][$j]<>""){
						$sql.= ",dsfechaf='".$_REQUEST['dsfechaf_'][$j]."'";
						$idfechaf=str_replace("/","",$_REQUEST['dsfechaf_'][$j]);
						$sql.= ",idfechaf='".$idfechaf.$dshoraf.$dsminutof."'";
						$sql.=" ,dshoraf='".$dshorasf."'";
					}
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?>
