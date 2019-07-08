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
PROCESO DE EDICION DE LA COMPRA ASISTIDA
*/
if ($_REQUEST['inn']=="1"){
//$db->debug=true;
  foreach($_POST as $nombre_campo => $valor){ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
    // editar cliente
      $clavee = $rc4->encrypt($s3m1ll4, $dsclave);
      $dsclave = urlencode($clavee);
  		$sql=" update tblclientes set ";
      $sql.="dsnombres='$dsnombres'";
      $sql.=",dsapellidos='$dsapellidos'";
      $sql.=",idactivo='$idactivo'";
      $sql.=",idtipocliente='$idtipocliente'";
      $sql.=",dstipoidentificacion='".$_REQUEST['dstipoid']."'";
			$sql.=",dsidentificacion='$dsidentificacion'";					
			$sql.=",dstelefono='$dstelefono'";
			$sql.=",dstelefono2='$dstelefono2'";
			$sql.=",dsmovil='$dsmovil'";
      $sql.=",dsfax='$dsfax'";		
			$sql.=",dsdireccion='$dsdireccion'";	
			$sql.=",dspais='$dspais'";
      $sql.=",dsdepartamento='$dsdepartamento'";  
      $sql.=",dsciudad='$dsciudad'";
      $sql.=",dsempresa='$dsempresa'";
      $sql.=",dsclave='$dsclave'";
      $sql.=",dscargo='$dscargo'";    
      $sql.=",dsfacebook='$dsfacebook'"; 
      $sql.=",dstwitter='$dstwitter'";  
      $sql.=",dsfechanacimiento='$dsfechanacimiento'"; 
      $sql.=",idfechanacimiento='".str_replace("/","",$dsfechanacimiento)."'";   	
			$sql.=" where id=".$idclientepago;
      //echo $sql;
     //exit();
			$db->Execute($sql);
      $mensajes="Datos actualizados con exito";
}

if ($idclientepago<>"") {
      $sql="select dsnombres,dsapellidos,dsidentificacion,dscorreocliente,";
      $sql.="dstelefono,dstelefono2,dsmovil,dsdireccion,dsciudad";
      $sql.=",idactivo,idtipocliente,dstipoidentificacion,dsfax,dspais,dsdepartamento";
      $sql.=",dsempresa,dscargo,dsfechanacimiento,dsfecha,dsacepto,idtienda,dsfacebook,dstwitter,dsclave";
      $sql.=" from tblclientes where id='$idclientepago'";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {
      $dsnombres=$resultb->fields[0];
      $dsapellidos=$resultb->fields[1];
      $dsidentificacion=$resultb->fields[2];
      $dscorreocliente=$resultb->fields[3];
      $dstelefono=$resultb->fields[4];
      $dstelefono2=$resultb->fields[5];
      $dsmovil=$resultb->fields[6];
      $dsdireccion=$resultb->fields[7];
      $dsciudad=$resultb->fields[8];
      $idactivo=$resultb->fields[9];
      $idtipocliente=$resultb->fields[10];
      $dstipoid=$resultb->fields[11];
      $dsfax=$resultb->fields[12];
      $dspais=$resultb->fields[13];
      $dsdepartamento=$resultb->fields[14];
      $dsempresa=$resultb->fields[15];
      $dscargo=$resultb->fields[16];
      $dsfechanacimiento=$resultb->fields[17];
      $dsfecha=$resultb->fields[18];
      $dsacepto=$resultb->fields[19];
      $idtienda=$resultb->fields[20];
      $dsfacebook=$resultb->fields[21];
      $dstwitter=$resultb->fields[22];
      $clave=$resultb->fields[23];
      $clavee = $rc4->decrypt($s3m1ll4, urldecode($clave));
      $dsclave=$clavee;
     }
     $resultb->Close(); 


}
?>