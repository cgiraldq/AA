<aside class="lateral">
<?
if($idpagina<>""){
    $rutaImagenl=$rut."incluidos_sitio/aside/";
    $sql="select a.dsm from tblmenu a inner join tblmenuxtblpaginas b on a.id=b.idorigen where b.iddestino=$idpagina and a.idactivo=1 order by idpos asc";
  //echo $sql;
    $resultl=$db->Execute($sql);
    if(!$resultl->EOF){
        while(!$resultl->EOF){
        $dsm=$resultl->fields[0];
        if(is_file($rutaImagenl.$dsm)){
         include($rutaImagenl.$dsm);
        }
        $resultl->MoveNext();
        }
    }$resultl->Close();
}

/*?>
    <? include ($rut."incluidos_sitio/aside/banner.top.php");?>
    <? include ($rut."incluidos_sitio/aside/productos.detalle.php");?>
    <? include ($rut."incluidos_sitio/aside/menu.lateral.php");?>
    <? include ($rut."incluidos_sitio/aside/novedades.php");?>
    <? include ($rut."incluidos_sitio/aside/columnistas.php");?>
    <? include ($rut."incluidos_sitio/aside/tips.php");?>
    <? include ($rut."incluidos_sitio/aside/banner.medio.php");?> <!--Banner Posicion 2-->
    <? include ($rut."incluidos_sitio/aside/video.php");?>
    <?include ($rut."incluidos_sitio/aside/banner.inferior.php");?> <!--Banner Posicion 2-->
  <?
*/
  ?>
</aside>