<?
//script que verifica si sessiones estan vacias lo mande a loguearse
if ($_SESSION['i_idcliente']=="") header("Location: inicio.sesion.php"); 
?>