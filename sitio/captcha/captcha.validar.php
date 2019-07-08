<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Traer los datos de retenciones y descuento del cliente
 
*/
session_start();

/*include("../../sitioweb/incluidos_modulos/version.php");
include("../../sitioweb/incluidos_modulos/comunes.php");*/
	//echo $_SESSION['captcha'];
    if ($_REQUEST['captcha'] != $_SESSION['captcha']) {
        $data = -1;
    } else {
        $data = 1;
    }
    $request_captcha = htmlspecialchars($_REQUEST['captcha']);
    unset($_SESSION['captcha']);

echo $data;

?>