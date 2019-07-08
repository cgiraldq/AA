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
$session=$_SESSION['i_idregist'];
$redir=trim($_REQUEST['redir']);
$rc4 = new rc4crypt();

//exit;
//echo "dsdsdsdsd";
//exit;

$dsm = trim($_REQUEST['dsnombre']);
$dsm=utf8_decode($dsm);
$dsapellidos= trim($_REQUEST['dsapellidos']);
$dsapellido=utf8_decode($dsapellido);
$dstelefono = trim($_REQUEST['dstelefono']);
$dscorreocliente = trim($_REQUEST['dscorreocliente']);
$dsciudad = trim($_REQUEST['dsciudad']);
$dsciudad=utf8_decode($dsciudad);
$dspais = trim($_REQUEST['dspais']);
$dspais=utf8_decode($dspais);
$dsdireccion = trim($_REQUEST['dsdireccion']);
$dsdireccion=utf8_decode($dsdireccion);
$dstipo = trim($_REQUEST['dstipo']);

//$dscontrasena=trim($_REQUEST['dscontrasena']);
//$clavee = $rc4->encrypt($s3m1ll4, $dscontrasena);
//$clave = urlencode($clavee);

$dsclave=trim($_REQUEST['dsclave']);
$dscontrasena=trim($_REQUEST['dscontrasena']);
$dscontrasena1=trim($_REQUEST['dscontrasena1']);
$dscontrasena2=trim($_REQUEST['dscontrasena2']);
//exit();
//$dsnit=trim($_REQUEST['dsnit']);
//$dscontrasena=trim($_REQUEST['dscontrasena']);
if ($dscontrasena<>"") {
$dscontrasena = $rc4->encrypt($s3m1ll4, $dscontrasena);
$dscontrasena = urlencode($dscontrasena);
}

if ($dscontrasena1<>"") {
$dscontrasena1 = $rc4->encrypt($s3m1ll4, $dscontrasena1);
$dscontrasena1 = urlencode($dscontrasena1);
}
if ($dscontrasena2<>"") {
$dscontrasena2 = $rc4->encrypt($s3m1ll4, $dscontrasena2);
$dscontrasena2 = urlencode($dscontrasena2);
}





//exit();
if ($dscontrasena=="" || $dscontrasena1=="" || $dscontrasena2=="" || $clave=="" && $dsm<>"") {


		//if(trim($dscorreocliente)<>"")$mail->AddAddress($dscorreocliente, "LogrosPublicitarios");

		//almacenar en base de datos

				$sql=" update tblregistro_zonaprivada set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dsapellidos='$dsapellidos'";
					$sql.=" ,dscorreocliente='$dscorreocliente'";
					$sql.=" ,dsciudad='$dsciudad'";
					$sql.=" ,dstelefono='$dstelefono'";
					$sql.=" ,dsdireccion='$dsdireccion'";
					$sql.=" ,dspais='$dspais'";
					$sql.=" ,dstipo='$dstipo'";
					$sql.=" where id=".$session;

					//echo $sql;
				//	echo "<br>";
					//exit;
$db->Execute($sql);//exit();

$msj=3;
}elseif (($dscontrasena==$dsclave) && ($dscontrasena1==$dscontrasena2) && ($dsm<>"")){

					$sql=" update tblregistro_zonaprivada set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dsapellidos='$dsapellidos'";
					$sql.=" ,dscorreocliente='$dscorreocliente'";
					$sql.=" ,dsciudad='$dsciudad'";
					$sql.=" ,dstelefono='$dstelefono'";
					$sql.=" ,dsdireccion='$dsdireccion'";
					$sql.=" ,dscontrasena='$dscontrasena2'";
					$sql.=" ,dstipo='$dstipo'";
					$sql.=" where id=".$session;


				//	echo $sql;
				//	echo "<br>";
					//exit;
				$db->Execute($sql);//exit();
	$msj=3;
}else{
	$msj=2;
}
if ($dscontrasena<>"") {

if(($dscontrasena==$dsclave) && ($dscontrasena1==$dscontrasena2)){


				$sql=" update tblregistro_zonaprivada set ";
				$sql.=" dscontrasena='$dscontrasena2'";
				$sql.=" where id=".$session;
				//echo $sql;
				//exit;
$db->Execute($sql);

$msj=1;
}else{
	$msj=2;

}
} else {
	$redir="zona.privada.php";
}
$redir="zona.privada.php";

//exit();//para imprimir
?>

<script language="javascript">
<? if ($msj==1 || $msj==3){ ?>

<?
			$redir="zona.privada.php?mensaje=1#actualizar_datos";?>
<? }else{ ?>

<?
			$redir="zona.privada.php?mensaje=2";?>
<? } ?>
location.href="<? echo $redir?>";
//-->
</script>

