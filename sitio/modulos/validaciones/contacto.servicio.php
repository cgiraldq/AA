<?
/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

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
 Script generico de envio de datos via formulario
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
$redir=trim($_REQUEST['redir']);
//exit;
//echo "dsdsdsdsd";
//exit;
$dsproducto=trim($_REQUEST['dsproducto']);
$dsnombre=trim($_REQUEST['dsnombre']);
$dsapellidos=trim($_REQUEST['dsapellido']);
$dstelefono=trim($_REQUEST['dstelefono']);
$dsciudad=trim($_REQUEST['dsciudad']);
$dspais=trim($_REQUEST['dspais']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dsmovil=trim($_REQUEST['dscelular']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dscom=trim($_REQUEST['dscom']);
$dsfecha=date("Y/M/d h:m:s");


$dsrutax=$_REQUEST["ruta"];
$autorizado=str_replace("/","",$autorizado);


include("../../incluidos_modulos/encabezado_correo.php");

if ($dsnombre<>"" && $_REQUEST['captcha']<>"") {


		$sql="select dsd,dsd2 from  tbltextodecorreos where idcategoria=2 and idactivo=1";
		//echo $sql;
		$result=$db->Execute($sql);
			if (!$result->EOF) {
				$asuntoc=$result->fields[0];
				$text=nl2br($result->fields[1]);
			}
			$result->Close();



		//$asunto="Solicitud de informacion en ".$autorizado;
		//$cuerpo.="<font face='Arial' size=-1> <strong></strong>";
		//$cuerpo.="Se ha generado una $asunto:<br>";

		$cuerpo=$asuntoc."$dsd2 <br>";
		$cuerpo.=$text."<br>";
		////////////////////////////////////////////////////////////////////////////////////////////////
		$cuerpo.="Servicio: $dsproducto<br>";
		if ($dsnombre<>"")$cuerpo.="Nombre: $dsnombre<br>";
		if ($dsapellidos<>"")$cuerpo.="Apellidos: $dsapellidos<br>";

		if ($dstelefono<>"")$cuerpo.="Telefono: $dstelefono<br>";
		if ($dsmovil<>"")$cuerpo.="Celular: $dsmovil<br>";
		if ($dsdireccion<>"")$cuerpo.="Direccion: $dsdireccion<br>";
		if ($dscom<>"")$cuerpo.="Comentarios: $dscom<br><br>";


		$cuerpo.="Correo electrónico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";

		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		$cuerpo.="IP remota: <br>$remoto<br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." Online ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.co/'>Comprandofacil</a></font><br>";

		//echo $cuerpo;
		//exit();
		 include("../../incluidos_modulos/enviadorcorreo.php");

//echo $cuerpo."<br>".$asunto;
		//almacenar en base de datos
		 // idcontacto=2 contato de servicios
		$sql="insert into tblcontacto_corporativo( ";
		$sql.="dsnombre,dsapellidos,dscorreocliente,dstelefono,dsmovil,dsdireccion";
		$sql.=",dscom,dsfecha,dsciudad,dspais,dsreferido,idcontacto";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos',";
		$sql.="'$dscorreocliente','$dstelefono','$dsmovil','$dsdireccion',";
		$sql.="'$dscom','".date("d/m/Y")."','$dsciudad','$dspais','$dsproducto',2)";
		//echo $sql;
		//exit();
		$db->Execute($sql);//exit();



		$redir="../../gracias.php?msg=3&dsrutax=$dsrutax&dsnombre=$dsnombre&dsapellidos=$dsapellidos&dscorreocliente=$dscorreocliente&dstelefono=$dstelefono";
} else {
	$redir="../../gracias.php?msg=3&dsrutax=$dsrutax&dsnombre=$dsnombre&dsapellidos=$dsapellidos&dscorreocliente=$dscorreocliente&dstelefono=$dstelefono";
}

include("../../incluidos_modulos/cerrarconexion.php");
//exit();//para imprimir
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
//alert("Gracias por enviar la informacion.");
location.href="<? echo $redir?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>