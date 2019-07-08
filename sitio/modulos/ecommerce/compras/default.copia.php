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
  Juan Felipe Sï¿½nchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
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
include("../../incluidos_modulos/modulos.calendario.php");
$rc4 = new rc4crypt();


$titulomodulo="Configuracion de las compras";
$letra=$_REQUEST['letra'];
$tabla="tblpagos";
$orderby=$_REQUEST['orderby'];
$dsfechasel=$_REQUEST['dsfechasel'];
if($_REQUEST['idconfirmar']==1){
	$idpago=$_REQUEST['id'];
	
	$sql="select a.dsidentificacion,a.dsnombre,a.dscorreo,a.dsdireccion,a.dstelefono,a.idciudad,a.dssubtotal,a.dsflete ";
	$sql.=",a.dsiva,a.dstotal,a.dsfecha,a.idcliente from $tabla a where id=".$idpago;
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$dsidentificacion=$result->fields[0];
		$dsnombre=$result->fields[1];
		$dscorreo=$result->fields[2];
		$dsdireccion=$result->fields[3];
		$dstelefono=$result->fields[4];
		$idciudad=$result->fields[5];
		$dsciudad=seldato('dsciudad','id','tblfletes',$idciudad,1);
		$dssubtotal=$result->fields[6];
		$dsflete=$result->fields[7];
		$dsiva=$result->fields[8];
		$dstotal=$result->fields[9];
		$dsfecha=$result->fields[10];
		$idcliente=$result->fields[11];
		
		$sql="select idformaenvio,dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto from tblempresa where id>0";
		$result=$db->Execute($sql);
	 	if(!$result->EOF){
	  		$formaenvio=$result->fields[0];
	  		$dsnombrerem=$result->fields[1];
	  		$dscorreorem=$result->fields[2];
	  		$dssmtp=$result->fields[3];
	  		$dsusuariocorreo=$result->fields[4];
	  		$clavecorreo=$result->fields[5];
	  		$dspuerto=$result->fields[6];
			$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($clavecorreo));
		}
		
		$asunto="Confirmacion de compra ".$autorizado;
		$cuerpo="<font face='Arial' size=-1>Apreciado <strong>Cliente</strong>:<br><br>";	
		$cuerpo.="Su solicitud de compra ha sido confirmada, estos son los datos:<br>";	
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Telefono: $dstelefono<br>";
		$cuerpo.="Direccion: $dsdireccion<br>";
		$cuerpo.="Ciudad de envio: <u>$dsciudad</u><br>";
		$cuerpo.="Correo electr&oacute;nico: <u>$dscorreo</u><br>";
		$cuerpo.="Subtotal: <u>$dssubtotal</u><br>";
		$cuerpo.="Flete: <u>$dsflete</u><br>";
		//$cuerpo.="Iva: <u>$dsiva</u><br>";
		$cuerpo.="Total: <u>$dstotal</u><br>";
		$cuerpo.="Fecha Pedido: $dsfecha<br>";
		$sqlx="select idproducto,idcolor,dstamanio,idtipocomp,idprecio,dsiva,dstipo,id from tblcompras where idcliente='$idcliente' and dsfecha='$dsfecha'";
		$result=$db->Execute($sqlx);
		if(!$result->EOF){
		$cuerpo.="<br><br>Datos de la compra:<br>";
		$cuerpo.='<table width="100%" style="font-family:Arial, Helvetica, sans-serif;font-size:11px" border=1>';
		$cuerpo.='	<tr>';
		$cuerpo.='		<td align="center"><strong>Producto</strong></td>';
		$cuerpo.='		<td align="center"><strong>Color</strong></td>';
		$cuerpo.='		<td align="center"><strong>Tamaño</strong></td>';
		$cuerpo.='		<td align="center"><strong>Valor</strong></td>';
		//$cuerpo.='		<td><strong>Iva</strong></td>';
		//$cuerpo.='		<td><strong>Total</strong></td>';
		$cuerpo.='	</tr>';
			while(!$result->EOF){
				$dstipo=$result->fields[6];
				$idcomp=$result->fields[7];
				if($dstipo=='Interactiva'){
					
					include("../../incluidos_sitio/generarpin.php"); 
					$sqlu="update tblcompras set dspin='$pin' where id=".$idcomp;
					$db->Execute($sqlu);
					$est=2;
				}
				//exit();
				$idtipocomp=$result->fields[3];
				if($idtipocomp==1){
					$tbl="tblproductos";
					$tbl2="tblcoloresprod";
				}else{
					$tbl="tblaccesorios";
					$tbl2="tblcoloresacc";
				}
				//echo $tbl2;
				//exit();
				$idproducto=$result->fields[0];
				$dsproducto=seldato('dsm','id',$tbl,$idproducto,1);
				$idcolor=$result->fields[1];
				$dscolor=seldato('dsm','id',$tbl2,$idcolor,1);
				$dstamanio=$result->fields[2];
				
				$idprecio=$result->fields[4];
				$dsiva=$result->fields[5];
				
				$cuerpo.='	<tr>';
				$cuerpo.='		<td>'.$dsproducto.'</td>';
				$cuerpo.='		<td>'.$dscolor.'</td>';
				$cuerpo.='		<td>'.$dstamanio.'</td>';
				$cuerpo.='		<td>'.$idprecio.'</td>';
				//$cuerpo.='		<td>'..'</td>';
				//$cuerpo.='		<td>'..'</td>';
				$cuerpo.='	</tr>';
				
				$result->MOveNext();
			}
			$cuerpo.='</table>';
		}
		
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

		/*$headers= "From: info@movilid.com\n";
		$headers.= "Organization: $autorizado\n";
		$headers.= "MIME-Version: 1.0\n";
		$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: $dscorreorem\r\n";
		//ruta del mensaje desde origen a destino
		$headers .= "Return-path: $dscorreorem\r\n";*/

 		
 		
				
		/*if(mail($dscorreo,$asunto,$cuerpo,$headers)){
			$sql="update $tabla set idestado=2 where id=".$idx;
 			if($db->Execute($sql))$mensajes=$men[8];

		}*/
		$mail->AddAddress($dscorreo, $dsnombre);
		if($mail->Send()){
			$sql="update $tabla set idestado=2,dsconfirmo='".$_SESSION['i_dsnombre']."' where id=".$idpago;
 			if($db->Execute($sql))$mensajes=$men[8];

		}
	}
}
if($_REQUEST['despachar']==1){
		$idpago=$_REQUEST['id'];
		$dsfechadesp=$_REQUEST['dsfechad'];
		$partir=explode("/",$dsfechadesp);
		$nueva = mktime(0,0,0, $partir[1],$partir[2],$partir[0]) + 365 * 24 * 60 * 60;
       	$dsfechav=date("Y/m/d",$nueva);
		//exit();
		$dsd=$_REQUEST['dsd'];
	$sql="select a.dsidentificacion,a.dsnombre,a.dscorreo,a.dsdireccion,a.dstelefono,a.idciudad,a.dssubtotal,a.dsflete ";
	$sql.=",a.dsiva,a.dstotal,a.dsfecha,a.idcliente,a.idcli from $tabla a where id=".$idpago;
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$dsidentificacion=$result->fields[0];
		$dsnombre=$result->fields[1];
		$dscorreo=$result->fields[2];
		$dsdireccion=$result->fields[3];
		$dstelefono=$result->fields[4];
		$idciudad=$result->fields[5];
		$dsciudad=seldato('dsciudad','id','tblfletes',$idciudad,1);
		$dssubtotal=$result->fields[6];
		$dsflete=$result->fields[7];
		$dsiva=$result->fields[8];
		$dstotal=$result->fields[9];
		$dsfecha=$result->fields[10];
		$idcliente=$result->fields[11];
		$idcli=$result->fields[12];
		
		$sql="select idformaenvio,dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto from tblempresa where id>0";
		$result=$db->Execute($sql);
	 	if(!$result->EOF){
	  		$formaenvio=$result->fields[0];
	  		$dsnombrerem=$result->fields[1];
	  		$dscorreorem=$result->fields[2];
	  		$dssmtp=$result->fields[3];
	  		$dsusuariocorreo=$result->fields[4];
	  		$clavecorreo=$result->fields[5];
	  		$dspuerto=$result->fields[6];
			$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($clavecorreo));
		}
		
		$asunto="Despacho de compra ".$autorizado;
		$cuerpo="<font face='Arial' size=-1>Apreciado <strong>Cliente</strong>:<br><br>";	
		$cuerpo.="Su solicitud de compra ha sido despachada, estos son los datos:<br>";	
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Telefono: $dstelefono<br>";
		$cuerpo.="Direccion: $dsdireccion<br>";
		$cuerpo.="Ciudad de envio: <u>$dsciudad</u><br>";
		$cuerpo.="Correo electronico: <u>$dscorreo</u><br>";
		$cuerpo.="Subtotal: <u>$dssubtotal</u><br>";
		$cuerpo.="Flete: <u>$dsflete</u><br>";
		//$cuerpo.="Iva: <u>$dsiva</u><br>";
		$cuerpo.="Total: <u>$dstotal</u><br>";
		$cuerpo.="Fecha Pedido: $dsfecha<br>";
		$cuerpo.="Fecha de despacho: $dsfechadesp<br>";
		$cuerpo.="Fecha de vencimiento: $dsfechav<br>";
		$cuerpo.="Empresa transportadora: <a href='http://www.coordinadora.com' target='_blank'>www.coordinadora.com</a><br>";
		$cuerpo.="Observaciones: $dsd<br>";
		$sqlx="select idproducto,idcolor,dstamanio,idtipocomp,idprecio,dsiva,dspin from tblcompras where idcliente='$idcliente' and dsfecha='$dsfecha'";
		$result=$db->Execute($sqlx);
		if(!$result->EOF){
		$cuerpo.="<br><br>Datos de la compra:<br>";
		$cuerpo.='<table width="100%" style="font-family:Arial, Helvetica, sans-serif;font-size:11px" border=1>';
		$cuerpo.='	<tr>';
		$cuerpo.='		<td align="center"><strong>Producto</strong></td>';
		$cuerpo.='		<td align="center"><strong>Color</strong></td>';
		$cuerpo.='		<td align="center"><strong>Tamaño</strong></td>';
		$cuerpo.='		<td align="center"><strong>Valor</strong></td>';
		//$cuerpo.='		<td><strong>Iva</strong></td>';
		//$cuerpo.='		<td><strong>Total</strong></td>';
		$cuerpo.='		<td align="center"><strong>Pin</strong></td>';
		$cuerpo.='	</tr>';
			while(!$result->EOF){
				$idtipocomp=$result->fields[3];
				if($idtipocomp==1){
					$tbl="tblproductos";
					$tbl2="tblcoloresprod";
				}else{
					$tbl="tblaccesorios";
					$tbl2="tblcoloresacc";
				}
				//echo $tbl2;
				//exit();
				$idproducto=$result->fields[0];
				$dsproducto=seldato('dsm','id',$tbl,$idproducto,1);
				$idcolor=$result->fields[1];
				$dscolor=seldato('dsm','id',$tbl2,$idcolor,1);
				$dstamanio=$result->fields[2];
				
				$idprecio=$result->fields[4];
				$dsiva=$result->fields[5];
				$dspin=$result->fields[6];
				$cuerpo.='	<tr>';
				$cuerpo.='		<td>'.$dsproducto.'</td>';
				$cuerpo.='		<td>'.$dscolor.'</td>';
				$cuerpo.='		<td>'.$dstamanio.'</td>';
				$cuerpo.='		<td>'.$idprecio.'</td>';
				//$cuerpo.='		<td>'..'</td>';
				//$cuerpo.='		<td>'..'</td>';
				$cuerpo.='		<td>'.$dspin.'</td>';
				$cuerpo.='	</tr>';
				
				$result->MOveNext();
			}
			$cuerpo.='</table>';
		}
		if($idcli<>""){
			$sql="select dsusuario,dsclave from tblclientes where id=".$idcli;
			$result=$db->Execute($sql);
			if(!$result->EOF){
				$dsusuario=$result->fields[0];
				$dsclave=$result->fields[1];
				$clave=$rc4->decrypt($s3m1ll4, urldecode($dsclave));
				$cuerpo.="<br><br>Datos de acceso a la seccion clientes:<br>";
				$cuerpo.="Usuario:$dsusuario<br>";	
				$cuerpo.="Clave:$clave<br>";
			}
		}
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

		/*$headers= "From: info@movilid.com\n";
		$headers.= "Organization: $autorizado\n";
		$headers.= "MIME-Version: 1.0\n";
		$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: $dscorreorem\r\n";
		//ruta del mensaje desde origen a destino
		$headers .= "Return-path: $dscorreorem\r\n";*/

 		
 		
				
		/*if(mail($dscorreo,$asunto,$cuerpo,$headers)){
			$sql="update $tabla set idestado=2 where id=".$idx;
 			if($db->Execute($sql))$mensajes=$men[8];

		}*/
		$mail->AddAddress($dscorreo, $dsnombre);
		if($mail->Send()){
			//$sumar = 60*60*24*365;
			
			//echo $dsfechadesp;
			//echo $dsfechav=date("Y/m/d", time()+$sumar );
			//exit();
			$sql="update $tabla set idestado=3,dsd='$dsd',dsfechadesp='$dsfechadesp',dsfechaven='$dsfechav',dsdespacho='".$_SESSION['i_dsnombre']."' where id=".$idpago;
 			if($db->Execute($sql))$mensajes=$men[9];

		}
	}

}
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") { 
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  { 
		$mensajes="<strong>".$men[3]."</strong>";
		
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo";
		$dsruta="../compras/default.php";
		include("../../incluidos_modulos/logs.php");
		
	}	
}

$idr=$_REQUEST['idr'];
if ($idr<>"") { 
	$sql=" select idcompras,idcliente,dsfecha from $tabla where id=$idr ";
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$idcompra=$result->fields[0];
		$idcliente=$result->fields[1];
		$dsfecha=$result->fields[2];
		$dsfechadesp=date('Y/m/d');
		$partir=explode("/",$dsfechadesp);
		$nueva = mktime(0,0,0, $partir[1],$partir[2],$partir[0]) + 365 * 24 * 60 * 60;
       	$dsfechav=date("Y/m/d",$nueva);

		$sql="update tblcompras set idestado=2 where id=".$idcompra;
		$db->Execute($sql);
		$sql="update tblcompras set idestado=1 where idcliente='".$idcliente."' and dsfecha='".$dsfecha."'";
		$db->Execute($sql);
		$sql="update $tabla set dsfechadesp='".$dsfechadesp."',dsfechaven='".$dsfechav."',idestado=3,dsdespacho='".$_SESSION['i_dsnombre']."' where id='".$idr."'";
		if($db->Execute($sql))$mensajes=$men[11];
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
$sql="select a.id,a.dsidentificacion,a.dsnombre,a.dscorreo,a.dsdireccion,a.dstelefono,a.idciudad,a.dssubtotal,a.dsflete";
$sql.=",a.dsiva,a.dstotal,a.strtipopago,a.idestado,a.idcliente,a.dsfecha,a.idtipo,a.dsfechaven,a.dsfechacompra from $tabla a where 1 ";//and idestado<>0";
//echo $sql; 
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"") $sql.=" and a.$dsfechasel  between '".$_REQUEST['fechain']."' and '".$_REQUEST['fechafi']."'";
if($_REQUEST['idestado']<>"")$sql.=" and idestado=".$_REQUEST['idestado'];
if($_REQUEST['dstipopago']<>"")$sql.=" and strtipopago='".$_REQUEST['dstipopago']."'";
if($_REQUEST['enviar']<>"Buscar")$sql.=" and idestado<>3";
if ($orderby<>"") { 
	$sql.=" order by a.$orderby asc ";
} else { 
	$sql.=" order by a.id desc ";
}
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
		$paramb="dsnombre";
		$paramn="Nombre";
		$info="vencimiento";
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	
	$rutaPaginacion="param=".$_REQUEST['param']."&dsfechasel=$dsfechasel&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	include("../../incluidos_modulos/paginar.variables.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$papelera=2;
		include("../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		
		include("compras.tabla.php");
		include("../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>