<?
//$db->debug=true;
// PROCESO DE GUARDAR COMPRA Y GENERAR PROCESO DE PAGOS DEPENDIENDO DEL SELECCIONADO
foreach($_POST as $nombre_campo => $valor){ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
 //  echo($nombre_campo.'='.$valor.'<br>'); 

}
//exit();
//$db->debug=true;

$partir=explode("|",$dsformadepago);
$formapago=$partir[1];
$plantilla=$partir[2];
$idactivopago=$partir[3];

if ($dsciudadenvio<>""){
  $partirx=explode("|",$dsciudadenvio);
  $dsciudadflete=$partirx[0];
  $dsflete=$partirx[1];
} 
$validarflete=0; // indica que se tome el valor de arrivba
if ($dsflete=="") {
$validarflete=1; // indica que se sume el flete de cada producto
$dsflete=0;
}

//exit();
if ($_SESSION['idcomprador_dis']<>"") {

  
        $sql="select idpedido  from ecommerce_tblpagos where id>0 ";
        $sql.=" and idcliente='".$_SESSION['idcomprador_dis']."' and dsfecha='".$_SESSION['dsfechacompra_dis']."' ";
        $sql.=" and idip='".$_SESSION['ipremota_dis']."' and idtienda=$idtienda ";
        //echo $sql;
        //exit();
        $result=$db->Execute($sql);
             if(!$result->EOF){
                $idpedido=$result->fields[0];
                    
                $mensaje="Esta transaccion ya se realizo. No es necesario volverla a realizar. ";
                $mensaje.=" Recuerde que es la numero <strong>$idpedido</strong>. ";
                $mensaje.="Presione '<strong>Terminar</strong>' para finalizar el proceso e '<strong>Imprimir</strong>' para una copia del pedido.";
             } else{ 
                
                // General el idpedido
                $sql="select count(*) from ecommerce_tblpagos where id>0 ";
                $sql.=" and idclientepago='".$_SESSION['i_idcliente']."'  order by id desc limit 0,1 ";
                $consec=1;
                $resultx=$db->Execute($sql);
                 if(!$resultx->EOF){
                  $valor=$resultx->fields[0];
                  if ($valor=="") $valor=0;
                $consec=$consec+$valor;
                 } 
                $resultx->Close();


                $idpedido=$idcomercio.$_SESSION['i_idcliente'];
                $valor=10-strlen($idpedido);
                $ceros="";
                for ($x=0;$x<($valor-strlen($consec));$x++) {
                    $ceros.="0";
                }
                $idpedido=$idpedido.$ceros.$consec;

              $sql="delete from ecommerce_tblcompras where id>0";
              $sql.=" and idcliente='".$_SESSION['idcomprador_dis']."' and dsfecha='".$_SESSION['dsfechacompra_dis']."' ";
              $sql.=" and idip='".$_SESSION['ipremota_dis']."' and idtienda=$idtienda ";
              $db->Execute($sql);
             // insertar en ecommerce_tblcompras lo de tbltemporal
             $sql="select 
             idproducto,  idcant,  idcolor, idcliente, dsfecha, 
             idprecio,dspordescuento,dsdescuento,dsiva,
             dsporiva,dstotal,dspin,dsd,idestado, idtipocomp,
             idpromocion,idip,dspara,dsciudadenvio,dsvalorenvio,
             dsdireccionenvio,dstelefonoenvio,dsmensajeenvio,dsobsenvio,
             idconsec,dsfechaenvio,dshoraenvio,dstipodirenvio,dstipoenvio,dszonaenvio,dsvalorflete,dstalla,dscolor,idtalla,idsubc,idcate
                from ecommerce_tbltemporalcompras where id>0 and idproducto>0 ";
              $sql.=" and idcliente='".$_SESSION['idcomprador_dis']."' and dsfecha='".$_SESSION['dsfechacompra_dis']."' ";
              $sql.=" and idip='".$_SESSION['ipremota_dis']."' and idtienda=$idtienda ";

                $resultx=$db->Execute($sql);
                 if(!$resultx->EOF){

                    while(!$resultx->EOF){
                    $idclientepedido=$_SESSION['i_idcliente'];
                    $idproducto=$resultx->fields[0];
                    $idcant=$resultx->fields[1];
                    $idcolor=$resultx->fields[2];
                    $idcliente=$resultx->fields[3];
                    $dsfecha=$resultx->fields[4];
                    $idprecio=$resultx->fields[5];
                    $dspordescuento=$resultx->fields[6];
                    $dsdescuento=$resultx->fields[7];
                    $dsiva=$resultx->fields[8];
                    $dsporiva=$resultx->fields[9];
                    $dstotal=$resultx->fields[10];
                    $dspin=$resultx->fields[11];
                    $dsd=$resultx->fields[12];
                    $idestado=$resultx->fields[13];
                    $idtipocomp=$resultx->fields[14];
                    if ($tipotransc=="1") $idtipocomp="66666666666";// tipo cotizacion


                    $idpromocion=$resultx->fields[15];
                    $idip=$resultx->fields[16];
                    $dspara=$resultx->fields[17];
                    $dsciudadenvio=$resultx->fields[18];
                    $dsvalorenvio=$resultx->fields[19];
                    $dsdireccionenvio=$resultx->fields[20];
                    $dstelefonoenvio=$resultx->fields[21];
                    $dsmensajeenvio=$resultx->fields[22];
                    $dsobsenvio=$resultx->fields[23];

                    $idconsec=$resultx->fields[24];
                    $dsfechaenvio=$resultx->fields[25];
                    $dshoraenvio=$resultx->fields[26];
                    $dstipodirenvio=$resultx->fields[27];
                    $dstipoenvio=$resultx->fields[28];
                    $dszonaenvio=$resultx->fields[29];
                    $dsvalorflete=$resultx->fields[30];

                    $dstalla=reemplazar($resultx->fields[31]);
                    $dscolor=reemplazar($resultx->fields[32]);
                    $idtalla=$resultx->fields[33];
                    $idsubc=$resultx->fields[34];
                    $idcate=$resultx->fields[35];

                    $dsflete=$dsflete+$dsvalorenvio;


                    $sql=" insert into ecommerce_tblcompras ";
             $sql.=" (idproducto,  idcant,  idcolor, idcliente, dsfecha, 
             idprecio,dspordescuento,dsdescuento,dsiva,
             dsporiva,dstotal,dspin,dsd,idestado, idtipocomp,
             idpromocion,idip,dspara,dsciudadenvio,dsvalorenvio,
             dsdireccionenvio,dstelefonoenvio,dsmensajeenvio,dsobsenvio,idclientepedido,idpedido,
             idconsec,dsfechaenvio,dshoraenvio,dstipodirenvio,dstipoenvio,dszonaenvio,idtienda,dsvalorflete,dstalla,dscolor,idtalla,idsubc,idcate
             )
             ";
             $sql.=" values ";
             $sql.=" ('$idproducto','$idcant','$idcolor','$idcliente','$dsfecha',";
             $sql.="'$idprecio','$dspordescuento','$dsdescuento','$dsiva','$dsporiva'";
             $sql.=",'$dstotal','$dspin','$dsd','$idestado','$idtipocomp','$idpromocion'";
             $sql.=",'$idip','$dspara','$dsciudadenvio','$dsvalorenvio','$dsdireccionenvio'";
             $sql.=",'$dstelefonoenvio','$dsmensajeenvio','$dsobsenvio','$idclientepedido','$idpedido'";
             $sql.=",'$idconsec','$dsfechaenvio','$dshoraenvio','$dstipodirenvio','$dstipoenvio','$dszonaenvio','$idtienda','$dsvalorflete','$dstalla','$dscolor','$idtalla','$idsubc','$idcate')";              
          // echo $sql;
           // exit();
             $db->Execute($sql); 

                    $resultx->MoveNext(); 
                    } 


                 } 
                $resultx->Close();
              //  exit();
              // insercion en ecommerce_tblpagos
             $sql="insert into  ecommerce_tblpagos ";
             $sql.=" (";
             $sql.="idpedido,idcliente,idclientepago";
             $sql.=",dsfecha,dssubtotal,dsiva,dsflete,dsciudadflete";
             $sql.=",dstotal,dsrecibotv,dsformadepago,idestado,idtipocomp,idpromocion,idip";
             $sql.=",dsfechalarga,dsfechatv,idfechatv,dsdescuento";
             $sql.=",dsvalorseguro,dsmanejo,idtienda,dstransad,totalvalorguia,dsciudadestino,dsciudadorigen,transporte,impuestostrans";
             $sql.=",aranceltrans,idmanejoadministratrans,idserviciotrans,valoracion,nombreserviciotrans,dspuntos";
             if($_SESSION['i_codigo']<>"")$sql.=",dscodigo,dsdescuentocodigo,dsporcentajecodigo";
             
             $sql.=" )";  


             $sql.=" values";
             $sql.=" (";

             $sql.="'$idpedido','$idcliente','$idclientepedido'";
             $sql.=",'$dsfecha','$xsubtotal','$xiva','$xfletes','$dsciudadflete'";
             $sql.=",'$xtotal','','$formapago','1','$idtipocomp','$idpromocion','$idip'";
             $sql.=",'$fechaBaseLarga','','','$xdescuento' ";
             $sql.=",'$xvalorseguro','$xvalormanejo',$idtienda,'$xtransad','".$totalvalorguia."','$dsciudadestino','$dsciudadorigen','$valor_transporte','$impuestostrans'";
             $sql.=",'$aranceltrans','$idmanejoadministratrans','$idserviciotrans','$valoracion','$nombreserviciotrans','$dspuntos'";
               if($_SESSION['i_codigo']<>"")$sql.=",'".$_SESSION['i_codigo']."','".$_SESSION['dsdescuentocodigo']."','".$_SESSION['i_dsdescuento']."'";

             $sql.=" )";    
            // echo $sql;
           //exit();
              if ($db->Execute($sql)){
                if ($tipotransc=="1") {
                    $mensaje="GRACIAS POR REALIZAR LA COTIZACION.";
                    $mensaje.="Presione '<strong>Terminar</strong>' para finalizar el proceso e '<strong>Imprimir</strong>' para una copia del pedido.";
                } else {
                    $mensaje.=" Recuerde que su transacci&oacute;n es la n&uacute;mero <strong>$idpedido</strong> ";
                    $mensaje.=" y un correo ha sido enviado con los datos del pedido.";
                    $mensaje.="Presione '<strong>Terminar</strong>' para finalizar el proceso e '<strong>Imprimir</strong>' para una copia del pedido.";
                }
              } else { 
                $mensaje="PROBLEMAS CON LA TRANSACCION.";
                $mensaje.=" la transaccion ha queda parcialmente almacenada.  ";
                $mensaje.=" <a href='contacto.php'>Contactenos</a> para finalizar el proceso.";
              }

             } // fin validacion de pedido en ecommerce_tblpagos 
        $result->Close();

          // formato de envio de correo siempre y cuando no sea pago virtual
          if ($idactivopago==1){
            //include con envio de correo
            if ($tipotransc=="1") {
                $sql=" update ecommerce_tblpagos set idestado=12 where idpedido=$idpedido and idclientepago=$idclientepedido";
                $db->Execute($sql);
            }
            include("proceso.pago.formatocorreo.php");
            include("proceso.pago.enviocorreo.php");
            
            } else {
               // enviar correo de prepedido
            //$db->debug=true;
            if ($tipotransc=="1") {
            $sql=" update ecommerce_tblpagos set idestado=12,dspuntos=0 where idpedido=$idpedido and idclientepago=$idclientepedido";

            } else {

            $sql=" update ecommerce_tblpagos set idestado=1 where idpedido=$idpedido and idclientepago=$idclientepedido";

            }

            if ($db->Execute($sql)){

            include("proceso.pago.formatocorreo.prepedido.php");
            include("proceso.pago.enviocorreo.prepedido.php");

            } else { 

            $mensaje="PROBLEMAS CON LA TRANSACCION.";
            $mensaje.=" la transaccion No se puede enviar hacia los sistemas de pagos virtuales.  ";
            $mensaje.=" <a href='contacto.php'>Contactenos</a> para finalizar el proceso. Recuerde que su pedido es el $idpedido.";
            }


          }

  // destruir sesssiones
  $_SESSION['idcomprador_dis']="";
  $_SESSION['dsfechacompra_dis']="";
  $_SESSION['ipremota_dis']="";
  $_SESSION['idpedido']=$idpedido;

    if($_SESSION['i_tipocodigo']==2 || $_SESSION['i_tipocodigo']==1){

    $sql_c =" update ecommerce_tblcodigosprom set idactivo=2 ";
    $sql_c.=" ,dsfecha='".date("Y/m/d H:s:i")."'";
    $sql_c.=" ,dspedido='".$idpedido."'";
    $sql_c.=" ,dscliente='".$_SESSION['i_dsnombre']."'";
    $sql_c.=" ,idcliente='".$idclientepedido."'";
    $sql_c.=" where dscodigo='".$_SESSION['i_dscodigo']."'";
    $sql_c.=" and codigo='".$_SESSION['i_codigo']."'";
    if($db->Execute($sql_c)){
        /* variables codigos promocionales */
    $_SESSION['i_dscodigo']="";
    $_SESSION['i_acceso']="";
    $_SESSION['i_dsdescuento']="";
    $_SESSION['i_dscodigo']="";
    $_SESSION['i_codigo']="";
    $_SESSION['i_dsproveedor']="";  
    $_SESSION['dsdescuentocodigo']="";
    /* variables codigos promocionales */
    }    
    
    }

    if($_SESSION['i_tipocodigo']==3){
        
        $sql_c=" insert into ecommerce_tblcodigoxpedido (";
        $sql_c.="codigo,dscodigo,dsdescuento,dspedido,idcliente,dscliente,dsfecha,idfecha";
        $sql_c.=") value (";
        $sql_c.="'".$_SESSION['i_codigo']."'";
        $sql_c.=",'".$_SESSION['i_dscodigo']."'";
        $sql_c.=",'".$_SESSION['i_dsdescuento']."'";
        $sql_c.=",'".$idpedido."'";
        $sql_c.=",'".$idclientepedido."'";
        $sql_c.=",'".$_SESSION['i_dsnombre']."'";
        $sql_c.=",'".date("Y/m/d H:s:i")."'";
        $sql_c.=",'".date("Ymd")."')";     
        if($db->Execute($sql_c)){
        /* variables codigos promocionales */
        $_SESSION['i_dscodigo']="";
        $_SESSION['i_acceso']="";
        $_SESSION['i_dsdescuento']="";
        $_SESSION['i_dscodigo']="";
        $_SESSION['i_codigo']="";
        $_SESSION['i_dsproveedor']="";  
        $_SESSION['dsdescuentocodigo']="";
        /* variables codigos promocionales */
        } 
       
    }

} else { 
    $idpedido=$_SESSION['idpedido'];  

    $mensaje="NO ES NECESARIO REFRESCAR LA PAGINA.";
    if ($idactivopago==1){
    $mensaje.=" Recuerde que su transacci&oacute;n es la n&uacute;mero <strong>$idpedido</strong> ";
    $mensaje.=" y un correo ha sido enviado con los datos del pedido.";
    $mensaje.="Presione '<strong>Terminar</strong>' para finalizar el proceso e '<strong>Imprimir</strong>' para una copia del pedido.";
    } else { 
    $mensaje.=" Recuerde que su pre pedido es la n&uacute;mero <strong>$idpedido</strong> ";
    $mensaje.=" y un correo ha sido enviado con los datos de este.";
    $mensaje.="Una vez finalice el proceso en la tienda, se confirmar&aacute; la transacci&oacute;n y el pedido se activar&aacute;";

    }
}
?>
