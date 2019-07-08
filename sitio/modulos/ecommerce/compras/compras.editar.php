<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernï¿½ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sï¿½nchez <graficoweb@comprandofacil.com> - Diseï¿½o
  Josï¿½ Fernando Peï¿½a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// principal
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");
$rc4 = new rc4crypt();
$titulomodulo="Configuracion de las compras";
$letra=$_REQUEST['letra'];
$tabla="ecommerce_tblcompras";
$orderby=$_REQUEST['orderby'];
$idcliente=$_REQUEST['idcliente'];
$dsfecha=$_REQUEST['dsfecha'];
if($_REQUEST['idrecordar']==1){
	$sql="select a.dsnombres,a.dsapellidos,a.dscorreocliente,a.dsclave from tblclientes a inner join ecommerce_tblpagos b on a.id=b.idclientepago";
	$sql.=" where b.idcliente=".$idcliente;
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$dsnombre=$result->fields[0]." ".$result->fields[1];
		$dsusuario=$result->fields[2];
		$dsclave=$result->fields[3];
		$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($dsclave));
		//$dscorreo=$result->fields[4];
		
		$asunto="Recordatorio de compra ".$autorizado;
		$cuerpo="<font face='Arial' size=-1>Apreciado <strong>Cliente</strong>:<br><br>";	
		$cuerpo.="Señor :$dsnombre<br>";	
		$cuerpo.="datos:<br>";
		$cuerpo.="Ususario: $dsusuario<br>";
		$cuerpo.="Clave: $dsclavecorreo<br>";
		$cuerpo.="==============================================================<br>";	
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";

		include_once('../../PHPMailer_v5.1/class.phpmailer.php');
		include("../../PHPMailer_v5.1/class.smtp.php"); 
		$mail=new PHPMailer();
		
		$cuerpo=eregi_replace("[\]",'',$cuerpo);
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = $dscorreorem; // SMTP username
		$mail->Password = $dsclavecorreo; // SMTP password
		$mail->Port=$dspuerto;// 
		
		$mail->Host       = $dssmtp; // SMTP server
		$mail->From       = $dscorreorem;
		$mail->FromName   = $dsnombrerem;
		$mail->Subject    = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		$mail->AddAddress($dscorreo, $dsnombre);
		if($mail->Send()){
			$mensajes=$men[10];
		}

	}
}
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.idproducto,a.idcolor";
$sql.=",a.idprecio,a.dsiva,a.idtipocomp,a.dspin,a.idestado from $tabla a where idcliente='$idcliente' and dsfecha='$dsfecha' ";
echo $sql; 
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") { 
	$sql.=" order by a.$orderby asc ";
} else { 
	$sql.=" order by a.dsfecha desc ";
}
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
		$paramb="dsnombre";
		$paramn="Nombre";
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	include("../../incluidos_modulos/paginar.variables.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Principal'>".$titulomodulo."</a>   /   <span class='text1'>Productos</span>";
	$papelera=2;
		include("../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		
		include("compras.editar.tabla.php");
		include("../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>