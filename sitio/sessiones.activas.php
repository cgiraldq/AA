<?
//script que verifica que si ya esta logueado no es necesario volver a pedirlo
if ($_SESSION['i_idcliente']<>"" && $_SESSION['i_dsnombre']<>"") header("Location: proceso.pago.1.php"); 
?>