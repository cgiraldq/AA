<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
Proceso que detecta el tipo de envio de correo

*/

// por defecto el envio de correo es mail

	$sql="select dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto,idformaenvio from tblempresa";
		//echo $sql;
	$idtipoenvio=1;//Mail
		//echo $sql;
		$resultb = $db->Execute($sql);
		//$atac="";
		if (!$resultb->EOF) {

			$nombreremitente=trim($resultb->fields[0]);
			$smtpbase=trim($resultb->fields[2]);
			$correobase=trim($resultb->fields[1]);
			$clave=trim($resultb->fields[4]);
			$clavebase = $rc4->decrypt($s3m1ll4, urldecode($clave));
			$usuariocorreo=trim($resultb->fields[3]);
			$dsport=trim($resultb->fields[5]);
			$idtipoenvio=trim($resultb->fields[6]);
		}
		$resultb->Close();

?>

