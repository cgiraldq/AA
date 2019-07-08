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
 Script generico de envio de datos via formulario
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$redir=trim($_REQUEST['redir']);

$rc4 = new rc4crypt();

//exit;
//echo "dsdsdsdsd";
//exit;
 $dscorreo=trim($_REQUEST['dscorreo']);
//exit;

if ($dscorreo<>"") {


$sql="select dscontrasena,dsm,dsapellidos,dscorreocliente from tblregistro_zonaprivada where dscorreocliente='$dscorreo' and idactivo=1";
//echo $sql;
//exit;
$result=$db->Execute($sql);
	if(!$result->EOF){

	//$dscontrasena=$result->fields[0];
	$clavex=$result->fields[0];
	$dscontrasenanx = $rc4->decrypt($s3m1ll4, urldecode($clavex));
	//$dscontrasenanx= urldecode($dscontrasena);
	$dsm=$result->fields[1];
	$dsapellidos=$result->fields[2];
	$dscorreo=$result->fields[3];
	$autorizado=str_replace("/","",$autorizado);

	include("../../incluidos_modulos/encabezado_correo.php");



					$sql="select dsm,dsd,dsd2 from tbltextodecorreos where idcategoria=5 and idactivo=1 ";



					$resultx=$db->Execute($sql);
						if(!$resultx->EOF){
						//$dscontrasena=$resultx->fields[0];
						$asunto=$resultx->fields[1];
						$cuerpo=$resultx->fields[2];
						$asunto=str_replace("-autorizado-",$autorizado,$asunto);
						$cuerpo=str_replace("[\]",'',$cuerpo);
						$cuerpo=str_replace("\n",'<br>',$cuerpo);
						$cuerpo=str_replace("-dsnombre-",$dsm." ".$dsapellidos,$cuerpo);
						$cuerpo=str_replace("-dscorreocliente-",$dscorreo,$cuerpo);
						$cuerpo=str_replace("-dsclave-",$dscontrasenanx,$cuerpo);


					}
					$resultx->Close();




			$cuerpo.="<br>==============================================================<br>";
			$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
			$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";


  //    echo $asunto."<br>";
//      echo $cuerpo."<br>";
   //   exit();
		$dscorreox=$dscorreo;
		$dsnombrex=$dsm." ".$dsapellidos;
		include("../../incluidos_modulos/enviadorcorreo.php");



		 $redir="../../gracias.php?msg=4";
		//exit();

	} else {
//echo "no hay correos";
	//echo "entra";
		$redir="../../registro.php?msg=3";

	}

} else {//fin validar captcha
	$redir="../../recuperar.contrasena.php";
}
//exit;
?>
<script language="javascript">
<!--
//alert("Gracias por enviar la informacion.");
location.href="<? echo $redir?>";
//-->
</script>
