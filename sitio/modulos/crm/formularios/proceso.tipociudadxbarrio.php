<?
$idxx=$_REQUEST["idxx"];
$idxyy=$_REQUEST["idxyy"];
$idxyz=$_REQUEST["idxyz"];
$idzona=$_REQUEST["idzona"];
$dsm1=$_REQUEST["dsm1"];
$dsm=$_REQUEST["dsm"];

if ($dsm<>"") {
		$sql="select dsm ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idcampo='$idxyz' and idzona='$idzona' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
		 	$error=1;
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idactivo,idcampo,idtipoformulario,dsvalor,idzona,idciudad,idcodigo)";
			$sql.=" values ('$dsm','$idactivo','$idxyz','$idxyy','$dsm1','$idzona','$idxx','$idcodigo') ";
			//echo $sql;
			$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$i_dsnombre." Ingreso un nuevo registro $dsm";
				$dsruta="../redes/default.php";
			$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,2);
		 }
		 $result->close();
}
//echo $sql;
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",idcodigo='".$_REQUEST['idcodigo_'][$j]."'";
					$sql.= ",dsvalor='".$_REQUEST['dsm1']."'";

					$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];


if ($_REQUEST['idy']<>"") {
	$sql="delete from $tabla where id=".$_REQUEST['idy'];
	$db->Execute($sql);
	$mensajes=$men[4];
}

?>

