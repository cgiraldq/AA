<? include ("sessiones.php");
$enca=$_REQUEST['enca'];
$encas=$_REQUEST['encas'];
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");?>

    <body>

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

            <section class="cont_terminos">
                    <?include("incluidos_sitio/terminoscondiciones/terminos.condiciones.php");?>
            </section>
        </section>

        <?if ($enca==""){      ?>
        <section class="cont_footer">

             <?include("incluidos_sitio/footer/footer.php");?>
        </section>
        <? }?>

    </body>
</html>