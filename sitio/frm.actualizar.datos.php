<?  include($rutbase."incluidos_sitio/session.encabezado.php"); ?>
<!DOCTYPE html>
<? $dsnombre=$_REQUEST["dsnombre"];?>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");?>

    <body <?if($bg_color<>""){echo "style=' background:$bg_color' ";}?>>

        <section class="cont_pagina">

            <?include("incluidos_sitio/frm.actualizar/frm.actualizar.datos.php");?>

            <!--section class="cont_cuerpo_general">
            </section-->

        </section>


    </body>
</html>