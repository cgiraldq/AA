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
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$rc4 = new rc4crypt();
$titulomodulo="Listado de Registros Zona privada";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="tblregistro_zonaprivada";
$orderby=$_REQUEST['orderby'];
$carpeta="Regsitros";
// insercion
$papelera=1;
include_once($rutbase.'../../PHPMailer_v5.1/class.phpmailer.php');
include($rutbase."../../PHPMailer_v5.1/class.smtp.php");




//exit();

		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>"" && $_REQUEST['idactivo_'][$j]==1){
				$idactivo=$_REQUEST['idactivo_'][$j];
				$idx=$_REQUEST['id_'][$j];


					$sql=" select dscontrasena,dsm,dsapellidos,dscorreocliente from tblregistro_zonaprivada where id=".$idx;
					$sql.=" and idenvio=0 ";

					//echo $sql;
					$result=$db->Execute($sql);
						if(!$result->EOF){
						//$dscontrasena=$result->fields[0];
						$clavem=$result->fields[0];
						$dscontrasenanm = $rc4->decrypt($s3m1ll4, urldecode($clavem));
						//$dscontrasenanm= urldecode($dscontrasena);
						$dsm=$result->fields[1];
						$dsapellido=$result->fields[2];
						$dscorreocliente=trim($result->fields[3]);


					$sql="select dsm,dsd,dsd2 from tbltextodecorreos where idcategoria=2 and idactivo=1 ";



					$resultx=$db->Execute($sql);
						if(!$resultx->EOF){
						//$dscontrasena=$resultx->fields[0];
						$dsasunto=$resultx->fields[1];
						$dscuerpo=$resultx->fields[2];
						$dsasunto=str_replace("-autorizado-",$autorizado,$dsasunto);
						$dscuerpo=str_replace("[\]",'',$dscuerpo);
						$dscuerpo=str_replace("\n",'<br>',$dscuerpo);
						$dscuerpo=str_replace("-dsnombre-",$dsm." ".$dsapellido,$dscuerpo);
						$dscuerpo=str_replace("-dscorreocliente-",$dscorreocliente,$dscuerpo);
						$dscuerpo=str_replace("-dsclave-",$dscontrasenanm,$dscuerpo);


					}
					$resultx->Close();




								$dscuerpo.="<br>Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
								//echo $asuntoa;

								//echo $dsasunto."<br>".$dscuerpo;
								//exit();

					      // enviar autorespuesta

					      $mail=new PHPMailer();
					      $mail->IsSMTP(); // telling the class to use SMTP
					      $mail->SMTPAuth = true; // turn on SMTP authentication
					      $mail->Username = $correobase; // SMTP username
					      $mail->Password = $clavebase; // SMTP password
					      $mail->Port=$dsport;//

					      $mail->Host       = $smtpbase; // SMTP server
					      $mail->From       = $correobase;
					      $mail->FromName   = $autorizado;
					      $mail->Subject = $dsasunto;
					      $mail->IsHTML(true);
					      $mail->MsgHTML($dscuerpo);

					    	//echo $mail;
					      $mail->AddAddress($dscorreocliente, $dsnombre." ".$dsapellidos);
					       if(!$mail->Send()) {
					          echo "Mailer Error: " . $mail->ErrorInfo;
					          //exit();
					        } else {

					        }
					        $mail->ClearAddresses();
					        unset($mail);


										$sql=" update tblregistro_zonaprivada set ";
										$sql.= "idenvio=1,idactivo=$idactivo ";
										$sql.= " where id=".$idx;
										$db->Execute($sql);

						}
		}


}

$exportar=1; // permite exportar la tabla
$pruta="zonaprivada";
$dsrutaPapelera="../papelera/papelera.php?dstabla=$tabla&titulomodulo=$titulomodulo&xruta=$pruta";//ruta de la papelera
include("proceso.php");?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
		include($rutxx."../../incluidos_modulos/core.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.dstelefono,a.dscorreocliente,a.dscontrasena,a.dsfecha,";//6
$sql.=" a.dsapellidos,a.dspais,a.dsdireccion,a.dsciudad,a.dstipo from $tabla a where id>0 and idactivo<>9";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.id desc ";
} else {
	$sql.=" order by a.id desc ";
}
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutamodulo="<a href='../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

		include("tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	include("ingreso.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>