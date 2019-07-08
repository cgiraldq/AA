<? include ("sessiones.php");?>
<? //include ($rut."sessiones.activas.logueo.php");?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
<?include("incluidos_sitio/head/head.php");
$r=$_REQUEST['r'];
if ($r=="1") $mensaje="Clave actualizada con exito";
if ($r=="2") $mensaje="Las Clave no coinciden. Intente de nuevo";
if($_SESSION['i_idcliente']<>""){
$sql="select dsclave,dscodigousa,dscodigouk from tblclientes where id=".$_SESSION['i_idcliente'];
//echo $sql;
$result=$db->Execute($sql);
if(!$result->EOF){
$clave=reemplazar($result->fields[0]);
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
$dscodigousa=reemplazar($result->fields[1]);
$dscodigouk=reemplazar($result->fields[2]);
}
$result->Close();
}
if ($mensaje=="") $mensaje=$_REQUEST['mensaje'];
    ?>
    <body>

        <section class="cont_pagina">
            <section class="cont_header">
                <?include("incluidos_sitio/header/header.php");?>
            </section>

            <?include("incluidos_sitio/menu/menu.superior.php");?>

            <section class="cont_cuerpo_general">
                <?include("incluidos_sitio/zona_privada/zona.privada.php");?>
            </section>

            <section class="cont_footer">
                <?include("incluidos_sitio/footer/footer.php");?>
            </section>
        </section>
    </body>
</html>