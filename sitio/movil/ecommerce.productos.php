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

        <section class="cont_cuerpo_general">
            <?include("incluidos_sitio/index/banner.superior.php");?>
            <?include("incluidos_sitio/index/video.superior.php");?>
            
            <?include("incluidos_sitio/ecommerce/productos/productos.vertical.php");?>
            
            <?include("incluidos_sitio/index/video.inferior.php");?>
            <?include("incluidos_sitio/index/banner.inferior.php");?>
        </section>


     <?include("incluidos_sitio/ecommerce/productos/subcategoria.productos.vertical.php");?>
        <section class="cont_footer">
            <?include("incluidos_sitio/footer/footer.php");?>
        </section>

        </section>
    </body>
</html>