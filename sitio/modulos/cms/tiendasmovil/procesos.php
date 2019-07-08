<?$titulomodulo="Configuracion de Tiendas";
//$db->debug=true;
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idciudad=$_REQUEST['idciudad'];

$letra=$_REQUEST['letra'];
$tabla="tbltiendas";
$orderby=$_REQUEST['orderby'];
if ($dsm<>"" && $idpos<>"") { 
	$sql="select id ";
 	$sql.=" from $tabla WHERE dsm='$dsm' ";
    $result = $db->Execute($sql);
	if (!$result->EOF) {
	// no insertar
	$error=1;
	$mensajes=$men[0];
	} else { 
	// insertar
	$sql="insert into $tabla (dsm,idpos,idactivo,idciudad)";
	$sql.=" values ('$dsm',$idpos,$idactivo,$idciudad) ";
	if ($db->Execute($sql))  { 
	$error=0;
	$mensajes="<strong>".$men[1]."</strong>";
	// cargar auditoria
	$dstitulo="Insercion $titulomodulo";
	$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
	$dsruta="../cms/Tiendas/default.php";
	include($rutxx."../../incluidos_modulos/logs.php");
	} else { 
	$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
	}	
	}
	$result->close();
}
// eliminacion
include("../../../incluidos_modulos/modulos.papelera.php");
// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					//$sql.= ",dsruta='".$dsrutaPagina."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= ",idciudad='".$_REQUEST['idciudad_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for	
		if ($h>0) $mensajes=$men[4];

?>