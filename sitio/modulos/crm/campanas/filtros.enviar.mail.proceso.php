<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

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
*/
if($_REQUEST['enviar']==1 && $_REQUEST['mail']<>'' && $_REQUEST['servicio']<>'' )
{
$contarenvio=0;
$idmail=$_REQUEST['mail'];
$idserviciomail=$_REQUEST['servicio'];
$cuerpomail=seldato('cuerpo','id','crm_mailing',$idmail,1);
$asuntomail=seldato('asunto','id','crm_mailing',$idmail,1);

$SMTP = seldato('servidor_smtp','id','crm_servicios_mailing',$idserviciomail,1);
$usuarioacceso = seldato('login_o_usuario','id','crm_servicios_mailing',$idserviciomail,1);
$claveacceso = seldato('clave_de_acceso','id','crm_servicios_mailing',$idserviciomail,1);
$puertodeacceso = seldato('puerto_de_acceso','id','crm_servicios_mailing',$idserviciomail,1);
$dsmremitente = seldato('nombre_del_remitente','id','crm_servicios_mailing',$idserviciomail,1);
$correoremitente = seldato('correo_del_remitente','id','crm_servicios_mailing',$idserviciomail,1);

if($SMTP<>''){

$sqlS="select cliente_asociado from crm_campa_por_cliente where campaa_asociada = '".$idcampana."' group by cliente_asociado ";
$result=$db->Execute($sqlS);

if(!$result->EOF)
{

	while(!$result->EOF)
	{
			$idcliente=$result->fields[0];

			$dscorreox =seldato('correo_email','id','crm_clientes',$idcliente,1);
			
			/*$nombres =seldato('nombre_o_razn_social','id','crm_clientes',$idcliente,1);
			$apellido =seldato('apellido_o_nombre_comercial','id','crm_clientes',$idcliente,1);*/

			include('filtro.generar.enviar.mail.php');

	$result->MoveNext();
	}

}
$result->Close();
if($contarenvio>0)
{

echo "<table border='0' cellpadding='2' cellspacing='1' class='msm_verde'>
	     <tbody><tr>
		  <td align='center'>
		  	<h3>&nbsp;se enviaron ".$contarenvio." correos exitosamente</h3>
		  </td>
		</tr>
	</tbody></table>";

}else
{
	echo "<table border='0' cellpadding='2' cellspacing='1' class='msm_rojo'>
	     <tbody><tr>
		  <td align='center'>
		  	<h3>&nbsp;No se enviaron correos, verificar lista de destinatario y pruebe de nuevo</h3>
		  </td>
		</tr>
	</tbody></table>";
}
 

}

}
?>