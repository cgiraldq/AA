<?

include ("sessiones.php");

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");
//$db->debug=true;
    ?>

    <body>

        <section class="cont_pagina">
            <section class="cont_header">
                <?include("incluidos_sitio/header/header.php");?>
            </section>

                <?include("incluidos_sitio/menu/menu.superior.php");?>

        <section class="bg_cuerpo">

            <section class="cont_cuerpo_general">

                    <? include ("proceso.pago.2.datos.distribuidor.php");?>

                    <?
                    $mostrarbotones=1;
                    include("incluidos_sitio/ecommerce/carrito/proceso.pago.2.distribuidor.php");?>

                </section>
            </section>

        </section>

            <section class="cont_footer">
                <?include("incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>
<? // incluido de envio de datos a compras y pagos por medio de form y submit
// temporalmente aca para revisar la forma de datos
 //if ($idactivopago<>1) include("proceso.pago.comprasypagos.php");
?>