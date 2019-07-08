<?
// datos encabezdo
//$db->debug=true;
$sql="select idclientepago,dsformadepago,dsfechalarga,dsciudadflete,dsflete,dssubtotal, dstotal,dsiva,dsdescuento ";
$sql.=",dsvalorseguro,dsmanejo,dstransad    ";
$sql.="from ecommerce_tblpagos where idpedido=$idpedido";
//echo $sql;
//exit();
//$db->debug=true;
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
$xvalorseguro=reemplazar($resultx->fields[9]);
$xvalormanejo=reemplazar($resultx->fields[10]);
$dsvalortrans=reemplazar($resultx->fields[11]);

}
$resultx->Close();

$sql="select dsnombres,dsapellidos,dstelefono,dsmovil,dsdireccion,dspais,dsciudad,dscorreocliente ";
$sql.="from tblclientes where id=$idclientepago";
//echo $sql;
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
if ($idpaisorigen==2) $idpaisorigen="Colombia";
if ($idpaisdestino==2) $idpaisdestino="Colombia";

$cuerpo="
<table border=0 width=100%>
  <tr>
    <td valign=top colspan=2>
  <img src='http://".$dirredesx."/contenidos/images/empresa/".$rutaLogoTienda."'>
    <br>
    </td>
    </tr>

    <tr>
    <td colspan=2>
<font face='arial' size='-1'>
     <strong> GRACIAS POR SU PEDIDO!. ESTE SE ENCUENTRA EN PROCESO.</strong>
      <BR>
      RECUERDE QUE SU NUMERO DE PEDIDO ES <strong>".$idpedido."</strong>
      <BR>
      <BR>
      <strong>UNA VEZ SE VERIFIQUE SU PAGO, EL PEDIDO SERA CONFIRMADO Y SE PROCEDERA CON SU DESPACHO
      EN EL TIEMPO ESTIPULADO PARA ELLO</strong>
      <BR>

      Fecha de Pedido: <strong>".$dsfechalarga."</strong>
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
	  Direcci&oacute;n: <strong>".$dsdireccion."</strong><br>
	  Pais / Ciudad origen: <strong>".$idpaisorigen." / ".$dsciudadorigen."</strong><br>
    Pais / Ciudad Destino: <strong>".$idpaisdestino." / ".$dsciudadestino."</strong><br>
   Valor Transporte: <strong>".$partiry[39]."</strong><br>

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
       $cuerpo.=" <br />Impuestos: <strong>$ ".number_format($xiva,0)."</strong>";
  }
     if ($xfletes>0) {

    $cuerpo.="<br>Transporte de productos: <strong>$ ".number_format($xfletes,0)."</strong>";
    if ($dsciudadflete<>""){
    $cuerpo.="<br>Lugar de destino de productos: <strong>".$dsciudadflete."</strong>";
    }

    if ($dsvalortrans>0){
    $cuerpo.="<br>Transporte Lugar de destino de los productos: <strong>$ ".number_format($dsvalortrans,0)."</strong>";
    }

    if ($xvalorseguro<=0) {
  //    $cuerpo.="<br>Valor seguro: <strong>INCLUIDO</strong>";
    } else {
   //   $cuerpo.="<br>Valor seguro: <strong>$ ".number_format($xvalorseguro,0)."</strong>";
    }
     if ($xvalorseguro>0) {

   // $cuerpo.="<br>Valor manejo de productos: <strong>".number_format($xvalormanejo,0)."</strong>";
  }
    }
        $cuerpo.="<br>
        Forma de Pago: <strong>".$formapago."</strong>
<br>TOTAL: <strong>$ ".number_format($xtotal,0)."</strong>
<br>Pedido N&uacute;mero: ".$idpedido."</font>
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
$sql.="from ecommerce_tblformasdepagos where dsm='$formapago'";

$resultx=$db->Execute($sql);
if(!$resultx->EOF){
  $dsm=reemplazar($resultx->fields[0]);
  $dsd=reemplazar($resultx->fields[1]);
  $dsd=preg_replace("/\n/","<br>",$dsd);
  $dsd=preg_replace("/-VALOR-/","".number_format($xtotal,0),$dsd);
  $dsd=preg_replace("/-PEDIDO-/",$idpedido,$dsd);

  $cuerpo.="<strong>Sobre la forma de pago ".$dsm."</strong><br>
  <p>".$dsd."</p>";
}
$resultx->Close();

$cuerpo.="</font></td>

<td valign=top>
";
$cuerpo.="</td>
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
?>
