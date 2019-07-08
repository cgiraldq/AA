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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// proceso de carga de las garantias y novedades



  $dstitulo_r=$_REQUEST['dstitulo_r'];
        
    $dscausa_r=$_REQUEST['dscausa_r'];
    $dsfecha_r=$_REQUEST['dsfechar'];
    $idestado=$_REQUEST['idestado'];
    $idenviaralcliente=$_REQUEST['idenviaralcliente'];
    $dsfechaenviocorreo="";
    if ($idenviaralcliente=="") $idenviaralcliente=0;
    if ($idenviaralcliente==1) $dsfechaenviocorreo=date("Y/m/d H:i:s a");

    $sql="select id ";
    $sql.=" from ecommerce_tblpagos_gdev WHERE dscausa_r='$dscausa_r' and idpedido=$idpedido";
    $sql.=" and idclientepago=$idclientepago and idestado=$idestado ";    
     $result = $db->Execute($sql);
     if (!$result->EOF) {
      // no insertar
      $error=1;
      $mensajes=$men[0];
     } else { 

      // insertar
      $idcategoria=0;
      $sql="insert into ecommerce_tblpagos_gdev (idestado,dsestado,idpedido,idclientepago,dsfecha,dscausa_r,dsfecha_r,dstitulo_r";
      $sql.=",idenviaralcliente,dsfechaenviocorreo)";
      $sql.=" values ('$idestado','$dsestado',$idpedido,$idclientepago,'$fechaBaseLarga','$dscausa_r','$dsfecha_r'";
       $sql.=",'$dstitulo_r','$idenviaralcliente','$dsfechaenviocorreo') ";
      //echo $sql;
      //exit();
      if ($db->Execute($sql))  { 
        $error=0;
        $mensajes="<strong>".$men[1]."</strong>";
     
         if ($idenviaralcliente==1) {
            $titulo=$dstitulo_r;
            $asuntocf="Aviso de la tienda: ".$titulo;
            $asuntocorreocliente=$titulo;
            $dsobs=$dscausa_r;
            include ("tracking.gdev.envio.correo.formato.php");
            // envio generico de correos
            include("tracking.gdev.envio.correo.procesos.php");

         }

      } else {
      $error=1; 
        $mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
      } 
     }
     $result->close();
     
?>
