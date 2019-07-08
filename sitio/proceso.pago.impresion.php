<?
include ("sessiones.php");
 $idpedido=$_REQUEST['idpedido'];
  $tracking=$_REQUEST['tracking'];
 $paginax=$_REQUEST['pagina'];
//  $dssede=seldato("dsa","ida","tblsedes",$traking,1);//

$mostrarenlace=$_REQUEST['mostrarenlace'];

$bloqueopago=1;

$bloqueonombre=1;

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");
if ($_REQUEST['idtienda']<>"") $idtienda=$_REQUEST['idtienda'];

$sql="select idclientepago,dsformadepago,dsfechalarga,dsciudadflete,dsflete,dssubtotal, dstotal,dsiva,dsdescuento ";
$sql.=",dsvalorseguro,dsmanejo,dscampo1,dsvalorasistido ";

$sql.="from ecommerce_tblpagos where idpedido=$idpedido";

//echo $sql;
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
$dscampo1=reemplazar($resultx->fields[11]);
$xvalorasistido=reemplazar($resultx->fields[12]);






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


    ?>

    <body>
        <!--[if lt IE 8 ]>
            <?include("incluidos_sitio/ie7/ie7.php");?>
        <![endif]-->
    <section class="cont_pagina">

        <section class="cont_header_imprimir">
                <?
                //echo $pagina;
                $sql="select dsimg1";
                $sql.=" from tblremate a where idactivo=1";
                //echo $sql;
                 $result = $db->Execute($sql);
                 if (!$result->EOF) {
                  $img=$result->fields[0];
                ?>
                <article class="logo_encabezado">

                  <a href="<? echo $rutalocal;?>/index.php"><img src="<? echo $rutalocalimag;?>/contenidos/images/remate/<? echo $img; ?>"></a>
                </article>
                <?
                  } // fin si
                    $result->Close();
                ?>
        </section>



  <section class="cont_terminos" id="dta_imprimir">
        <article id="qsomos" >
          <h2>IMPRESION PEDIDO: <strong><? echo $idpedido?></strong></h2>
          <h3>DATOS DEL COMPRADOR:</h3>
          <p>Fecha de Pedido: <strong><? echo $dsfechalarga?></strong></p>
          <p>Nombre Completo: <strong><? echo $dsnombres." ".$dsapellidos?></strong></p>
          <p>Tel&eacute;fono 1 / Celular: <strong><? echo $dstelefono." / ".$dstelefono2?></strong></p>
          <p>Direcci&oacute;n: <strong><? echo $dsdireccion?></strong></p>
          <p>Pais / Ciudad: <strong><? echo $dspais." / ".$dsciudad?></strong></p>
          <p>Correo electr&oacute;nico: <strong><? echo $dscorreocliente?></strong></p>
        </article>


<?
if ($dscampo1=="1") {
  include ("proceso.pago.2.detalle.asistida.php");
} else {
  include ("incluidos_sitio/ecommerce/carrito/proceso.pago.2.detalle.php");
}
                    ?>

<div class="terminar_compra">
  <? if($tracking==1){ ?>
       <a href="<? echo $paginax ?>"  class="btn_general">CERRAR VENTANA</a>
       <? }else{ ?>
       <a href="#" onclick="window.close();" class="btn_general">CERRAR VENTANA</a>
       <? } ?>
</div>
  </section>
    </section>
<?}else {?>

 <section class="cont_pagina">
      <section class="cont_header">
          <?include("incluidos_sitio/header/header.php");?>
      </section>

  <section class="cont_cuerpo_general" id="dta_imprimir">
        <article id="qsomos" >
      <h2>Lo sentimos El numero de tracking que ingreso no es correcto, por favor intente nuevamente.
      </h2>
        </article>

<div class="terminar_compra">
    <? if($tracking==1){ ?>
       <a href="<? echo $paginax ?>"  class="btn_general">CERRAR VENTANA</a>
       <? }else{ ?>
    <a href="#" onclick="window.close();" class="btn_general">CERRAR VENTANA</a>
       <?} ?>
</div>
  </section>
    </section>
<?
}
$resultx->Close();
?>

    </body>
</html>



