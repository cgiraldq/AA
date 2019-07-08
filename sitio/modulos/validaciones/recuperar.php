<?
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

/*
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2014
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Recuperar clave
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
$dscorreocliente=trim($_REQUEST['email']);

if ($dscorreocliente=="' or '1'='1") {
	$redir="../../recuperar.contrasena.php?mensaje=2";
} else {


	$sql="select id,dsclave,dsnombres,dsapellidos from tblclientes where dscorreocliente='$dscorreocliente' and idtienda=$idtienda ";
	$result = $db->Execute($sql);
	 if (!$result->EOF) {
	 		$dsnombres=$result->fields[2];
	  		$dsapellidos=$result->fields[3];
	 		$dsclave=$result->fields[1];
			$clave = $rc4->decrypt($s3m1ll4, urldecode($dsclave));
			$si=1;

			$asunto="Recuperar usuario y clave en $autorizado";
			$cuerpo=" <img src='".$rutaFuenteImagenes."/contenidos/images/logo_empresa/".$rutaLogoTienda."'>";
			$cuerpo.="<br><br><font face='Arial' size=-1>Apreciado cliente. Estos son tus datos:<br><br>";				
			$cuerpo.="Nombre: $dsnombres $dsapellidos <br>";				
			$cuerpo.="Fecha de pedido de recuperar clave: ".date("Y/m/d H:i:s")."<br><br>";	
			$cuerpo.="<strong>Para ingresar como cliente registrado, digite:<br></strong>";	
			$cuerpo.="Usuario: <u>$dscorreocliente</u><br>";
			$cuerpo.="Clave: <u>$clave </u><br><br>";
			//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";	
			$cuerpo.="==============================================================<br>";	
			$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
			$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
			//	
			//echo $cuerpo;
			//exit();

			include("../../incluidos_modulos/modulos.enviocorreo.php");
			$redir="../../recuperar.contrasena.php?mensaje=1";

	} else {
	 		$redir="../../recuperar.contrasena.php?mensaje=2";

	}
	$result->Close();
}	
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
?>
