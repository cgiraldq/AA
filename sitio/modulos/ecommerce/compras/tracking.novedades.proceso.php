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
// proceso de carga de las novedades
    $dscausa_b=$_REQUEST['dscausa_r'];
    $dsfecha_b=$_REQUEST['dsfechar'];

    $sql="select id ";
    $sql.=" from ecommerce_tblpagos_novedades WHERE dscausa_b='$dscausa_b' and idpedido=$idpedido";
    $sql.=" and idclientepago=$idclientepago and idestado=$idestado ";    
     $result = $db->Execute($sql);
     if (!$result->EOF) {
      // no insertar
      $mensajes=$men[0];
     } else { 

      // insertar
      $idcategoria=0;
      $sql="insert into ecommerce_tblpagos_novedades (idestado,dsestado,idpedido,idclientepago,dsfecha,dscausa_b,dsfecha_b)";
      $sql.=" values ('$idestado','$dsestado',$idpedido,$idclientepago,'$fechaBaseLarga','$dscausa_b','$dsfecha_b') ";
      //echo $sql;
      //exit();
      if ($db->Execute($sql))  { 
        $mensajes="<strong>".$men[1]."</strong>";
      } else { 
        $mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
      } 
     }
     $result->close();
?>
