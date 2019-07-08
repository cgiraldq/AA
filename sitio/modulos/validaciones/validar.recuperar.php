<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
/*
PROCESO DE RECUPERACION DE PEDIDO
VARTIABLES  CARGAR 
    $_SESSION['idcomprador']
    $_SESSION['dsfechacompra']
    $_SESSION['ipremota']
	$_SESSION['i_idcliente'] = 
	$_SESSION['i_dsnombre'] = 
	$_SESSION['i_dscorreo'] = 
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
//$db->debug=true;
$idconsec=trim($_REQUEST['idconsec']);
if ($idconsec=="' or '1'='1") {
	$redir="../../index.php";
} else {
	// 1. capturar el idcliente, de pagos
	$sql="select idpedido,idcliente,idclientepago,dsfecha,idip from tblpagos where idpedido=$idconsec ";
	$resultx= $db->Execute($sql);
		 if (!$resultx->EOF) {
			    $_SESSION['idcomprador']=$resultx->fields[1];
			    $_SESSION['dsfechacompra']=$resultx->fields[3];
			    $_SESSION['ipremota']=$resultx->fields[4];
				$idcliente=$resultx->fields[2];
				$sql="select id,dsnombres,dsapellidos from tblclientes where id=$idcliente ";
				$result = $db->Execute($sql);
						 if (!$result->EOF) {
									$idcliente=$result->fields[0];
									$dsnombres=$result->fields[1];
									$dsapellidos=$result->fields[2];
									$_SESSION['i_idcliente'] = $idcliente;	
									$_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;
									$_SESSION['i_dscorreo'] = $dsusuario;
									// borrado de transaccion y comenzar de nuevo
									$sql="delete from tblpagos where idpedido=$idconsec";
									$db->Execute($sql);
									$sql="delete from tblcompras where idpedido=$idconsec";
									$db->Execute($sql);
									$redir="../../proceso.pago.1.php?regreso=2";
						} else { 
							$redir="../../inicio.sesion.php";
						}	
						$result->Close();
		}else {
			$redir="../../index.php";
		}
		$resultx->Close();
}
foreach($_SESSION as $name=>$val){ 
    //echo($name.'='.$val.'<br>'); 
}
//echo $redir;
//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
?>
