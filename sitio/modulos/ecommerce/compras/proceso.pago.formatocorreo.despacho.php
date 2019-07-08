<?
// datos encabezdo
//$db->debug=true;
$sql="select idclientepago,dsformadepago,dsfechalarga,dsciudadflete,dsflete,dssubtotal,dstotal,dsiva,dsdescuento,dsfechat,dsfechad,dsnum_guia,dsd ";
$sql.="from ecommerce_tblpagos where idpedido=$idpedido";
//echo $sql;
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$idclientepago=reemplazar($resultx->fields[0]);
$formapago=reemplazar($resultx->fields[1]);
$dsfechalarga=reemplazar($resultx->fields[2]);
$dsciudadflete=reemplazar($resultx->fields[3]);
$xfletes=reemplazar($resultx->fields[4]);
$xsubtotal=reemplazar($resultx->fields[5]);
$xtotal=reemplazar($resultx->fields[6]);
$xiva=reemplazar($resultx->fields[7]);
$xdescuento=reemplazar($resultx->fields[8]);
$dsfechat=reemplazar($resultx->fields[9]);
$dsfechad=reemplazar($resultx->fields[10]);
$dsnum_guia=reemplazar($resultx->fields[11]);
$dsd=reemplazar($resultx->fields[12]);

}
$resultx->Close();

$sql="select dsnombres,dsapellidos,dstelefono,dstelefono2,dsdireccion,dspais,dsciudad,dscorreocliente ";
$sql.="from tblclientes where id=$idclientepago";
//echo $sql;
//exit;
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$dsnombres=reemplazar($resultx->fields[0]);
$dsapellidos=reemplazar($resultx->fields[1]);
$dstelefono=reemplazar($resultx->fields[2]);
$dstelefono2=reemplazar($resultx->fields[3]);
$dsdireccion=reemplazar($resultx->fields[4]);
$dspais=reemplazar($resultx->fields[5]);
$dsciudad=reemplazar($resultx->fields[6]);
$dscorreocliente=reemplazar($resultx->fields[7]);
}
$resultx->Close();

$cuerpo="
<table border=0 width=100%>
  <tr>
    <td valign=top colspan=2>
<img src='".$rutaFuenteImagenes."/contenidos/images/logo_empresa/".$rutaLogoTienda."'>    <br>
    </td>
    </tr>

    <tr>
    <td colspan=2>
<font face='arial' size='-1'>
     <strong> ".$titulo.".</strong>
      <BR>
      RECUERDE QUE SU NUMERO DE PEDIDO ES <strong>".$idpedido."</strong>
      <BR>
      Fecha de Pedido: <strong>".$dsfechalarga."</strong>
            <BR>
      Fecha de despacho: <strong>".$dsfechad."</strong>
           <BR>
      Fecha tentativa: <strong>".$dsfechat."</strong>
         <BR>
      Numero de guia: <strong>".$dsnum_guia."</strong>
             <BR>
      Observaciones de envio de compra: <strong>".$dsd."</strong>

            
      <br>
      <br>
 </font>     
      </td>
      </tr>
      <tr bgcolor='#f3f3f3'>
      <td valign=top >
      <font face='arial' size='-1'>

      <strong>DATOS COMO COMPRADOR:</strong>
      </font>
      </td>
      <td><font face='arial' size='-1'>
<strong> DATOS DEL PEDIDO </strong></font></td>
      </tr>
<tr>
      <td valign=top >
      <font face='arial' size='-1'>

      <br> 
      Nombre Completo: <strong>".$dsnombres." ".$dsapellidos."</strong><br>
      Tel&eacute;fono 1 / Tel&eacute;fono 2: <strong>".$dstelefono." / ".$dstelefono2."</strong><br>
	  Direcci&eacute;n: <strong>".$dsdireccion."</strong><br>
	  Pais / Ciudad: <strong>".$dspais." / ".$dsciudad."</strong><br>
      Correo electr&oacute;nico: <strong>".$dscorreocliente."</strong><br>
</font>
</td>
<td valign=top>
  <font face='arial' size='-1'>

  <br>
        SubTotal: <strong>$ ".number_format($xsubtotal,0)."</strong>";

   if ($xdescuento>0) {
         $cuerpo.="<br>Descuento: <strong>$". number_format($xdescuento,0)."</strong>";
   }

   if ($xiva>0) {
       $cuerpo.=" <br />Iva: <strong>$ ".number_format($xiva,0)."</strong>";
  } 
     if ($xfletes>0) {
    $cuerpo.="<br>Transporte: <strong>$ ".number_format($xfletes,0)."</strong>
    <br>Lugar de destino: <strong>".$dsciudadflete."</strong>";
    }
        $cuerpo.="<br>
        Forma de Pago: <strong>".$formapago."</strong>
<br>TOTAL: <strong>$ ".number_format($xtotal,0)."</strong>
<br>Pedido Numero: ".$idpedido."</font>
</td></tr>";
$cuerpo.="
<tr>
<td colspan=2 bgcolor='#f3f3f3'>
<br>
<font face='arial' size='-1'>

PARA VER EL DETALLE DE LA COMPRA, haga click <a href='".$rutaAbs."proceso.pago.impresion.php?idpedido=".$idpedido."'>sobre este enlace</a>
</font>
<br>
<br>
</td>
</tr>
<tr>
<td valign=top >
<font face='arial' size='-1'>

<strong>POR FAVOR TENGA EN CUENTA:</strong>
<BR><br>";
$sql="select dsm,dsd2 ";
$sql.="from tblformasdepagos where dsm='$formapago'";

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
  $dsm=reemplazar($resultx->fields[0]);
  $dsd=reemplazar($resultx->fields[1]);

  $cuerpo.="<strong>Sobre la forma de pago ".$dsm."</strong><br>
  <p><? echo $dsd?></p>";
}
$resultx->Close();

$cuerpo.="</font></td><td valign=top>
  <font face='arial' size='-1'>

  <strong>OTRAS CONDICIONES:</strong>
  <BR><br>";
  
$sql="select dsm,dsd ";
$sql.="from tblcondicionesdepago where idactivo=1 order by dsm asc";
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
  while(!$resultx->EOF){
  $dsm=reemplazar($resultx->fields[0]);
  $dsd=reemplazar($resultx->fields[1]);

$cuerpo.="<strong>".$dsm."</strong><br>
 <p>".trim($dsd)."</p>";
         $resultx->MoveNext();
            }

}
$resultx->Close();
$cuerpo.=" </font></td>
 </tr>
 <tr>
 <td valign=top colspan=2>
 <font face='arial' size='-1'>

    ".$autorizado." On line ". date("Y")  ." Todos los derechos reservados
    Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>
</font>
 </td>
 </tr>
</table>";        

//echo $cuerpo;
//exit();
?>