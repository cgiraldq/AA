<?  include($rutbase."incluidos_sitio/session.encabezado.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");?>

<body onload="volumen()">
        <audio id="mi_audio" autoplay>
        <source src="audios/adrianacuna.mp3" type="audio/mpeg">
        <source src="audios/adrianacuna.ogg" type="audio/ogg">
        <source src="audios/adrianacuna.wav" type="audio/wav">
        <source src="audios/adrianacuna.aac" type="audio/aac">
    </audio>

    <section class="cont_pagina">

        <section class="cont_header">
            <?include("incluidos_sitio/header/header.php");?>
        </section>

            <?include("incluidos_sitio/menu/menu.superior.php");?>
            <?include("incluidos_sitio/slide/slider.php");?>

        <section class="cont_bql_index">
           
        </section>


            <section class="cont_cuerpo_general">
                
                    <?//include("incluidos_sitio/index/qsomos.php");?>
                    <?//include("incluidos_sitio/index/banner.php");?>
                    <?include("incluidos_sitio/index/home.php");?>
                     <?//include("incluidos_sitio/index/galeria_index.php");?>
                     <?include("incluidos_sitio/ecommerce/productos/categoria.vertical.php");?>

                      <?include("incluidos_sitio/index/bloques.php");?>

                    <?//include("incluidos_sitio/index/destacados.php");?>
               

                <?//include("incluidos_sitio/aside/aside.php");?>

            </section>

             <?include("incluidos_sitio/index/bloques.inferiores.php");?>



            <?//include("incluidos_sitio/informes/indicadores.horizontal.php");?>
    <section class="cont_footer">
        <?//include("incluidos_sitio/menu/menu.inferior.php");?>
        <?include("incluidos_sitio/footer/footer.php");?>
    </section>
    </section>
</body>
</html>