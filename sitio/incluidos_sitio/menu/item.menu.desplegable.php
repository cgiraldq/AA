
<li class="nodiv"><a href="<?echo $rutalocal?>/index.php">Inicio</a></li>

<!--inicio  categorias subcategorias -->
 <li><a href="<?echo $rutbase?>/ecommerce.categoria.php">Catálogo</a>
<?
// $db->debug=true;
  $sql="select a.id,a.dsalias,a.dsruta from ecommerce_tblcategoria a ";
  $sql.=" where a.idactivo in (1,3) ";
  $sql.=" order by idpos asc ";
    $resultx=$db->Execute($sql);
  if(!$resultx->EOF){?>
<ul>
  <?while (!$resultx->EOF) {
    $idm=$resultx->fields[0];
    $idmx=$idm;
    $dsm=reemplazar($resultx->fields[1]);
    $dsruta=$resultx->fields[2];
    $dsrutax=$rutalocal."/categorias/".$dsruta;
      if ($rutaAmiga>1) $dsrutax="ecommerce.subcategorias.php?idrelacion=".$idm;
      // $contar1=contar('ecommerce_tbltblproductoxcategoria',$idm);
      // $contar2=contar('ecommerce_tblcategoriaxsubcategoria',$idm);

       // $db->debug=false;

      ?>
<?//if($contar1>0 || $contar2>0){?>
<li>

  <a href="<? echo $dsrutax ?>"><? echo reemplazar($dsm)?></a>


  <?// listar categorias de la tienda
  $sqld="select b.id,b.dsalias,b.dsruta from ";
  $sqld.="  ecommerce_tblsubcategoriasxcategoria b ,ecommerce_tblcategoriaxsubcategoria c ";
  $sqld.=" where  c.iddestino=".$idm." and b.id=c.idorigen and b.idactivo not in (2,9) order by b.idpos asc ";
  $resultd=$db->Execute($sqld);
  if(!$resultd->EOF){
  ?>
  <ul>
    <?  while (!$resultd->EOF) {
      $idm=$resultd->fields[0];
      $dsms=reemplazar($resultd->fields[1]);
      $dsrutax=$resultd->fields[2];
      $dsrutasub=$rutalocal."/subcategorias/".$dsruta."/".$dsrutax;
        if ($rutaAmiga>1) $dsrutasub="ecommerce.productos.php?idrelacion=".$idm."&dscategoria=".$idmx;
        //$db->debug=true;
        $contarx=contarx('ecommerce_tblsubcategoriaxtblproducto','ecommerce_tblproductos',$idm);
      //$db->debug=false;
      ?>
      <?if($contarx>0){?>
      <li><a href="<? echo $dsrutasub?>"><? echo $dsms ?></a></li>
      <?}
      $resultd->MoveNext();
      } // fin while*/
      ?>
  </ul>
</li>

      <?  }
        $resultd->Close();
      // }?>

      <?
      $resultx->MoveNext();
        } // fin while*/
      ?>
</ul>
      <?
// fin listar lkas categorias de la tienda
      }
      $resultx->Close();?>



      </li>
<!--fin  categorias subcategorias -->

<li><a href="<?echo $rutalocal?>/tiendas.php">Dónde comprar</a>
  <ul>
    <li><a href="<?echo $rutalocal?>/puntos.venta.php">Tiendas y distribuidores</a></li>
    <li><a href="<?echo $rutalocal?>/comercializar.php">Comercializa nuestra marca</a></li>
    <li><a href="<?echo $rutalocal?>/ventas.catalogo.php">Vende por catálogo</a></li>
  </ul>
</li>

<li class="nodiv"><a href="<?echo $rutalocal?>/qsomos.php">Estilo Adriana Arango</a>

  <?

    $sql="select a.id,a.dsm,a.dsruta from tblqsomos a where idactivo not in(2,9) order by idpos asc";
    //echo $sql;

    $result=$db->Execute($sql);
    if(!$result->EOF){
  ?>

  <!--ul>
     <? while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);

          $dsruta=$result->fields[2];

           $dsrutax=$rutalocal."/quienes_somos/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="qsomos.detalle.php?id=".$id;

         ?>
    <li>
      <a href="<? echo $dsrutax ?>"><? echo $dsm;?></a>
    </li>

     <?
          $result->Movenext();
          }
        ?>
  </ul-->
 <?
     }
      $result->Close();

    ?>

</li>




<li><a href="<?echo $rutalocal?>/indexblog.php">Blog</a></li>

<!--li><a href="http://www.sopbiker.com/sitio/expectativa.php" target="_blank" >SOP+POSITIVO</a>




      <?
      /*

        $sql="select a.dsm,a.dsd,a.dsdireccion,a.dstelefono,a.dslongitud,a.dslatitud,a.dszoom,a.id,a.dsruta ";
      $sql.=" from tbloficina a inner join tblciudades b on a.idc=b.id where a.idactivo not in (2,9) and b.idactivo not in (2,9) order by b.idpos,a.idpos asc";
      $result=$db->Execute($sql);
      if(!$result->EOF){
      ?>
         <?
          $con=1;
          while(!$result->EOF){
      $dsmoficina=$result->fields[0];
      $dsdoficina=$result->fields[1];
      $dsdireccion=$result->fields[2];
      $dstelefono=$result->fields[3];
      $dslongitud=$result->fields[4];
      $dslatitud=$result->fields[5];
      $dszoom=$result->fields[6];
      $idoficina=$result->fields[7];
      $dsruta=$result->fields[8];
      $cadenadatos=$dslatitud."|".$dslongitud."|".$dszoom."|".$dsmoficina."|".$dsdoficina."|".$dstelefono."|".$dsdireccion;
      //if(trim($dslatitud)<>"" && trim($dslongitud)<>"" && trim($dszoom)<>""){
       $dsrutax=$rutalocal."/mis_oficinas/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="oficinas.php?id=".$idoficina;
         ?>

         <?
          //}
          $con++;
          $result->MoveNext();
          }
         ?>

         <?
          }$result->Close();
        */

         ?>

</li-->

<li><a href="<?echo $rutalocal?>/noticias.php">Noticias</a></li>


<li><a href="<?echo $rutalocal?>/contacto.php">Contacto</a></li>

<!-- ////////////////////////////////////////                           //////////////////////////////////////////////-->









<?
//////////////////// Inicio de validacion de categorias ///////////////////

$sqlxx="select idactivo from blogtbladmin where idactivo='1' ";
    $resultxx=$db->Execute($sqlxx);
    if(!$resultxx->EOF){

//////////////////////////////////////////////////////////////////////////
?>



<?
//////////////////  fin validar si esta activo las categorias /////////////////
}
$resultxx->Close();

//////////////////////////////////////////////////////////////////////////////
?>

<!--li><a href="<?echo $rutalocal?>/galeria2.categoria.php">GALERIAS</a>

  <?
  /*

    $sql="select a.id,a.dsm,a.dsruta from tblgaleria2 a where idactivo not in(2,9) order by idpos asc";
    //echo $sql;

    $result=$db->Execute($sql);
    //if(!$result->EOF){
  */
  ?>

  <ul>
     <?
     /*
      while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);

          $dsruta=$result->fields[2];

           $dsrutax=$rutalocal."/subcategoria_galerias/".$dsruta;
        //if ($rutaAmiga>1) $dsrutax="galeria2.subcategoria.php?id=".$id;
        */
         ?>
    <li>
      <a href="<? //echo $dsrutax ?>"><? //echo $dsm;?></a>
    </li>

     <?
     /*
          $result->Movenext();
          }
        */
        ?>
  </ul>
 <?
 /*
     }
      $result->Close();

  */
    ?>
</li-->

