<?
/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Validar acceso cliente
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$redir=trim($_REQUEST['redir']);
$rc4 = new rc4crypt();


 $dsclave=trim($_REQUEST['clave']);
$dsusuario=trim($_REQUEST['usuariol']);
if ($dsclave =="" || $dsusuario=="") {
$redir="login.php?idno=2";
}else{
$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
$clave = urlencode($clavee);
$sql="select id,dsm,dsapellidos from  tblregistro_zonaprivada where idactivo=1 and dscorreocliente='$dsusuario' and dscontrasena='$clave'";

$result=$db->Execute($sql);
//$tienda=0;
 if (!$result->EOF) {



			$idcliente=$result->fields[0];
			$dsm=$result->fields[1];
			$dsapellidos=$result->fields[2];
			$idacceso=$result->fields[3];
		    $_SESSION['i_idregist'] = $idcliente;
			$_SESSION['i_nombregist'] = "registro sesion privada";
			$_SESSION['i_idsnombre'] = $dsm;
			$_SESSION['i_idsapellidos'] = $dsapellidos;
			$_SESSION['i_idacceso'] = $idacceso;
			$cliente=1;

			//echo $rutax;
			$rutax="../../zona.privada.php";
}else{
	$redir="login.php?idno=1";
}
$result->Close();

}

include("../../incluidos_modulos/cerrarconexion.php");
//exit();
if ($cliente==1) {
		$redir="".$rutax;
	} else {?>
	 <script language="javascript">
		<!--
		//alert("No se encuentra registrado, o su usuario y contraseña son incorrectos");
		//-->
		</script>

	<?
	$redir="../../".$redir;

	}
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
location.href="<? echo $redir?>";
//-->
</script>
<style type="text/css">
.style1 {
	text-align: center;
}
</style>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1>
<p class="style1">&nbsp;</p>

</body></html>