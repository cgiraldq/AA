<?
/*
	SCRIPT GENERICO DE VLAIDACIONES DE SSESSIONES
*/
session_start();
if($_SESSION['i_idusuario']<=0)
{
	header("Location: ".$rutxx."../admon/default.php?mensaje=2");
	exit;
}
// fin de validacion	
?>