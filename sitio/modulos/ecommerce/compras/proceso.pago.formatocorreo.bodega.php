<?
// datos encabezdo
//$db->debug=true;
$sql="select idclientepago,dsformadepago,dsfechalarga,dsciudadflete,dsflete,dssubtotal,dstotal,dsiva,dsdescuento,dsfechat,dsfechad,dsnum_guia,dsd,dscausa_r,dsfechar ";
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
//$dscausa_r=reemplazar($resultx->fields[13]);
//$dsfechar=reemplazar($resultx->fields[14]);

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
$dscausa_r=preg_replace("/-Nombre-/",$dsnombres." ".$dsapellidos,$dscausa_r);
$dscausa_r=preg_replace("/-Idpedido-/",$idpedido,$dscausa_r);
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
      Fecha de ingreso a bodega: <strong>".$dsfechar."</strong>
            <BR>
      <br> <strong>".$dscausa_r."</strong>
 </font>     
      </td>
      </tr>

<tr>
<td colspan=2 bgcolor='#f3f3f3'>
<font face='arial' size='-1'>

PARA VER EL DETALLE DE LA COMPRA, haga click <a href='".$rutaAbs."proceso.pago.impresion.php?idpedido=".$idpedido."'>sobre este enlace</a>
</font>
<br>
<br>
</td>
</tr>";
$cuerpo.="<tr>
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