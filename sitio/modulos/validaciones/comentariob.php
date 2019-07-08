<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

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
//$rc4 = new rc4crypt();
//exit;
 //$db->debug=true;
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();


if($idr=="") $idr=0;
$dsm=trim($_REQUEST['dsnombrex']);
$dsm=utf8_decode($dsm);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dscom=trim($_REQUEST['dscom']);
$dscom=utf8_decode($dscom);
$dsciudad=trim($_REQUEST['dsciudad']);
$dsciudad=utf8_decode($dsciudad);
$idblog=trim($_REQUEST['idblog']);
$idtipo=trim($_REQUEST['idtipo']);//tipo respuesta o tipo comentario principal
$idc=trim($_REQUEST['idc']);//comentario principal
$rutablog=trim($_REQUEST['rutablog']);//ruta del blog
$enviarblog=$rutablogcomnetario.$rutablog;//Ruta amigable
$numrespuesta=trim($_REQUEST['numrespuesta']);//ruta del blog
$idx=trim($_REQUEST['idx']);//ruta del blog


$capa="#comentar";


if($idc=="") $idc=0;


include("../../incluidos_modulos/encabezado_correo.php");

//exit;
 $captcha=$_REQUEST['captcha'];
// echo $_SESSION['captcha1'];
if ($dsm<>"" && $captcha<>"") {
if ($acceso==0) {
//}
		$nombre=seldato("dsm","id","tblcomentarios_blog",$idc,1);//

		if($idx==1)$mensaje=" una respuesta comentario de blog con";
		if($idx=="")$mensaje=" un comentario de blog con";

		$asunto=" ".$mensaje." ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="Se ha generado $asunto:<br>";
		$nombreb=reemplazar(seldato("dsm","id","blogtblblog",$idblog,1));
		$ruta=reemplazar(seldato("dsruta","id","blogtblblog",$idblog,1));
		$cuerpo.="Nombre del blog : $nombreb<br>";
		$cuerpo.="Nombres: $dsm<br>";
		//$cuerpo.="Tel&eacute;fono: $dstelefono<br>";
		//$cuerpo.="Mov&iacute;l: $dstelefono<br>";
		$cuerpo.="Email: $dscorreocliente<br>";
		$cuerpo.="Ciudad: $dsciudad<br>";
		$cuerpo.="Comentarios: $dscom<br>";
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		$cuerpo.="Correo electr&oacute;nico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";
		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br><br>";
		//include("rutabloqueoip.php");
		//echo $asunto;
		//echo $cuerpo;
		//	exit();
		include("../../incluidos_modulos/enviadorcorreo.php");

		if($idx=="") $tabla="blogtblcomentarios";
		if($idx==1) $tabla="blogtblrespuestas";

		$sql="insert into $tabla ( ";
		$sql.="dsm,idr";
		$sql.=",dscorreocliente,dsfecha,dscom";

		if($idx==1) $sql.=",idc";
		if($idx=="")  $sql.=",idactivo";

		$sql.=") values (";
		$sql.="'$dsm',$idblog,";
		$sql.="'$dscorreocliente'";
		$sql.=",'".date("Y/m/d")."','$dscom' ";

	    if($idx=="")  $sql.=",2";
	    if($idx==1) $sql.=",$idc";

		$sql.=")";
		//echo $sql;
		//exit();

		$db->Execute($sql);//exit();
		//exit;
	} else {
		//echo "entra";
		$redir="../../mis_blogs/$ruta";
		//$redir=$enviarblog."&idcapx=1&numrespuestax=$numrespuesta&#comentar";
	}//redirreciona si la ip esta bloqueada
//echo "entra2";
	$redir="../../mis_blogs/$ruta";
	//$redir=$enviarblog."&idcapx=1&numrespuestax=$numrespuesta&#comentar";
	//gracias/4/
} else {
	$redir=$enviarblog.$capa;
}//redirecciona si no pasa los parametros y nombre captcha
//include("incluidos_modulos/cerrarconexion.php");
//exit();//para imprimir
/*$idblog=trim($_REQUEST['idblog']);
$idtipo=trim($_REQUEST['idtipo']);//tipo respuesta o tipo comentario principal
$idc=trim($_REQUEST['idc']);//comentario principal*/
//exit();
?>
<script language="javascript">
<!--
//alert("Gracias por enviar la informacion.");
location.href="<? echo $redir?>";
//-->
</script>
