<?
session_start();
    if($_SESSION['i_idcliente']=="" || $_SESSION['i_idcodigodis']=="")
{
    header("Location:index.php");
  //  exit;

}
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->


<?   $mensaje=$_REQUEST['mensaje'];?><!--Para la validacion de actualizcion datos en zona privada-->

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

<section class="bg_cuerpo">
    <section class="cont_cuerpo_general">

    
        <?include("incluidos_sitio/miga/miga.php");?>

        <section class="cont_zona_distribuidores">
            <?include("incluidos_sitio/zona_distribuidor/zona.distribuidor.menu.php");?>
        </section>

        <section id="cont_principal">

            <?include("incluidos_sitio/zona_distribuidor/inicio.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/datos.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/puntos.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/historial.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/pedidos.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/pedidos.detalle.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/nuevo.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/saldos.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/referidos.zona.distribuidor.php");?>
            <?include("incluidos_sitio/zona_distribuidor/capacitacion.zona.distribuidor.php");?>

            <?//include("incluidos_sitio/zona_distribuidor/documentos.zona.privada.php");?>
            <?//include("incluidos_sitio/zona_distribuidor/videos.zona.privada.php");?>

        </section>

        <?include("incluidos_sitio/aside/aside.php");?>

    </section>
</section>
    <section class="cont_footer">
        <?include("incluidos_sitio/footer/footer.php");?>
    </section>

</section>
    </body>
</html>