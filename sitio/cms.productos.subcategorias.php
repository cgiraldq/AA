<?  include($rutbase."incluidos_sitio/session.encabezado.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->

<? $dsnombre=$_REQUEST['dsnombre']?>
<? $idrelacion=$_REQUEST['idrelacion']?>
    <?include("incluidos_sitio/head/head.php");?>

    <body>
        <!--[if lt IE 8 ]>
            <?include("incluidos_sitio/ie7/ie7.php");?>
        <![endif]-->
        <section class="cont_pagina">
            <section class="cont_header">
                <?include("incluidos_sitio/header/header.php");?>
            </section>
            <?include("incluidos_sitio/menu/menu.superior.php");?>
                <?include("incluidos_sitio/slide/slider.php");?>

            <section class="cont_cuerpo_general">


                <section id="cont_principal">
                    <?include("incluidos_sitio/miga/miga.php");?>

                    <?include("incluidos_sitio/cms.productos/productos.subcategorias.php");?>

                </section>

                <?include("incluidos_sitio/aside/aside.php");?>

            </section>
        </section>

            <section class="cont_footer">
                <?include("incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>