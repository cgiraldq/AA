<? include ("sessiones.php");
if ($_REQUEST['regreso']=="1") {
  $mensaje="LA TRANSACCION FUE CANCELADA.";
  $mensaje.=" la transaccion fue cancelada por usted.  ";
  $mensaje.=" Por favor cambie la forma de pago, actualice el transporte y realicela nuevamente.";
}
if ($_REQUEST['regreso']=="2") {
  $mensaje="LA TRANSACCION FUE RECUPERADA.";
  $mensaje.=" la transaccion fue recuperada por usted.  ";
  $mensaje.=" Por favor cambie la forma de pago, actualice el transporte y realicela nuevamente.";
}

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");?>

    <body >

        <section class="cont_pagina">

            <section class="cont_header">
              <?include("incluidos_sitio/header/header.php");?>
            </section>

                <?include("incluidos_sitio/menu/menu.superior.php");?>
            <section class="bg_cuerpo">
              <section class="cont_cuerpo_general">

                  <?include("incluidos_sitio/ecommerce/carrito/proceso.pago.distribuidor.php");?>
              </section>

              </section>
            </section>

            <section class="cont_footer">
                <?include("incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>
