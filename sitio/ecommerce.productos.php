<?
include ("sessiones.php");
$idrelacion=$_REQUEST['idrelacion'];
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->

<? $dsnombre=$_REQUEST['dsnombre']?>
<? $idrelacion=$_REQUEST['idrelacion']?>
    <?include("incluidos_sitio/head/head.php");
if ($idrelacion=="") $idrelacion=seldato("id","dsruta","ecommerce_tblsubcategoriasxcategoria",$_REQUEST['dsnombre'],2);
    ?>

    <body>

        <section class="cont_pagina">
            <section class="cont_header">
                <?include("incluidos_sitio/header/header.php");?>
            </section>
                <?include("incluidos_sitio/menu/menu.superior.php");?>
                <?include("incluidos_sitio/slide/slider.php");?>
                <?//include("incluidos_sitio/slide/slider.automatico.php");?>
        <section class="bg_cuerpo">
            <section class="cont_cuerpo_general">

                <section id="cont_principal">

                    <?include("incluidos_sitio/miga/miga.php");?>
                     <? $idcat=$_REQUEST['idcat'] ?>
                     <?include("incluidos_sitio/ecommerce/productos/subcategoria.productos.vertical.php");?>
                    <?include("incluidos_sitio/ecommerce/productos/productos.vertical.php");?>
                </section>

                <?include("incluidos_sitio/aside/aside.php");?>

            </section>
        </section>
        </section>

            <section class="cont_footer">

                <?include("incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>