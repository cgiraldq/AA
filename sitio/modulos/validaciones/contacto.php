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

$dsnombre=trim($_REQUEST['dsnombre']);
$dsapellidos=trim($_REQUEST['dsapellidos']);
$dsid=trim($_REQUEST['dsid']);
$dstelefono=trim($_REQUEST['dstelefono']);
$dscelular=trim($_REQUEST['dscelular']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dspais=trim($_REQUEST['dspais']);
$dsciudad=trim($_REQUEST['dsciudad']);
$contacto=trim($_REQUEST['contacto']);
$dscom=trim($_REQUEST['dscom']);

$autorizado=str_replace("/","",$autorizado);

include("../../incluidos_modulos/encabezado_correo.php");

if ($dsnombre<>"" && $_REQUEST['captcha']<>"") {


		//$asunto="Solicitud de contacto  en  ".$autorizado;
		//if ($dsproducto<>"") $asunto="Producto $dsproducto -  Solicitud de contacto en  ".$autorizado;
		$sql="select dsd,dsd2 from  tbltextodecorreos where idcategoria=1 and idactivo=1";
		//echo $sql;
		$result=$db->Execute($sql);
			if (!$result->EOF) {
				$asuntoc=$result->fields[0];
				$text=nl2br($result->fields[1]);
			}
			$result->Close();
		$asunto=$asuntoc;	
		$cuerpo=$asuntoc."$dsd2 <br>";
		$cuerpo.=$text."<br>";
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		//$cuerpo.="$asunto:<br>";
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Apellidos: $dsapellidos<br>";
		if ($dsid<>"")$cuerpo.="identificaci&oacute;n: $dsid<br>";
		if ($dstelefono<>"")$cuerpo.="Telefono: $dstelefono<br>";
		if ($dscelular<>"")$cuerpo.="Celular: $dscelular<br>";
		$cuerpo.="Email: $dscorreocliente<br>";
		if ($dsdireccion<>"") $cuerpo.="dsdireccion: $dsdireccion<br>";
		if ($dspais<>"")$cuerpo.="Pais: $dspais<br>";
		if ($dsciudad<>"")$cuerpo.="Ciudad: $dsciudad<br>";
		$cuerpo.="Comentarios: $dscom<br>";



		///////////////////////////////////// Pie del correo /////////////////////////////////////////////

		$cuerpo.="<br>==============================================================<br>";
		$cuerpo.="Fecha: ".date("Y/M/d h:m:s")."<br>";
		$cuerpo.="IP remota: <br>$remoto<br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." Online ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.co/'>Comprandofacil</a></font><br>";
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//echo $cuerpo;
		//exit();
		include("../../incluidos_modulos/enviadorcorreo.php");

		if ($contacto==1) {
		//almacenar en base de datos
		$sql="insert into tblcontacto_corporativo ( ";
		$sql.="dsnombre,dsapellidos,dscorreocliente,dstelefono,dsciudad";
		$sql.=",dscom,dsfecha,idtienda";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dstelefono','$dsciudad',";
		$sql.="'$dscom','".date("d/m/Y")."',1)";
		//echo $sql;
		//exit();
		$db->Execute($sql);//exit();
		$redir="../../$rutaInclude/gracias.php";

		} else {
			$sql="insert into tblcontacto ( ";
			$sql.="dsnombre,dsapellidos,dscorreocliente,dstelefono,dsmovil,dsciudad,dspais";
			$sql.=",dscom,dsfecha,idtienda,dsid";
			$sql.=") values (";
			$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dstelefono','$dscelular','$dspais','$dsciudad',";
			$sql.="'$dscom','".date("d/m/Y")."',1,'$dsid')";
			//echo $sql;
			//exit();
			$db->Execute($sql);//exit();

				$redir="../../gracias.php?msg=3";


		}
} else {
	$redir="../../index.php";
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