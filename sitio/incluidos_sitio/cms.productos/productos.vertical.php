
<h1><? echo reemplazar($dstituloPagina);?></h1>
<p><? echo reemplazar($dsd2Pagina);?></p>

    <?include("otros.productos2.php");?>

   <?

   $partir=explode("/",$dsnombre);

    $partir[0];
      $dsnombre=$_REQUEST["dsnombre"];
      $id=$_REQUEST["id"];

      $idsub=seldato("id","dsruta","tblsubcategoriasxcategoria",$partir[1],2);


      ////////////// consulta cuando es solo servicios /////////////////////
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblproductos a ";


      if($partir[0]<>"subcategoria"){

      $idcat=seldato("id","dsruta","tblcategoria",$dsnombre,2);
      //////////////////consulta si es categoria
      $sql.=" ,tbltblproductoxcategoria b where a.id=b.idorigen and a.idactivo not in(2,9) ";
      if($idcat<>"") $sql.=" and b.iddestino=$idcat  and a.idactivo not in(2,9)";
      if($id<>"") $sql.=" and b.iddestino=$id  and a.idactivo not in(2,9)";
       }



      if($partir[0]=="subcategoria"){
      /////////// consulta si es subcategoria
      $sql.=" ,tblsubcategoriaxtblproducto b where a.id=b.idorigen  ";
      if($idsub<>"") $sql.=" and b.iddestino=$idsub  and a.idactivo not in(2,9)";
      if($id<>"") $sql.=" and b.iddestino=$id  and a.idactivo not in(2,9)";
      }

      //if($dsnombre<>"") $sql.=" and b.dsruta=$dsnombre";    tblsubcategoriaxtblproducto
      //if($id<>"") $sql.=" and b.id=$id";

      //echo $sql;
      $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
    ?>
  <article class="bloques_productos">
       <? while(!$result->EOF){

          $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
          $dsd=reemplazar(preg_replace("/\n/","<br>",$dsd));
          $dsimg=$result->fields[3];

          $dsruta=$result->fields[4];
          $dsrutax=$rutalocal."/detalles/".$dsnombre."/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;


         ?>
    <article class="productos_vertical">

      <a href="<? echo $dsrutax;?>">

      <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"><img  src="<?echo $rutalocalimag?>/contenidos/images/producto/<? echo $dsimg;?>" alt=""></a>
      <?}?>
        <a href="<? echo $dsrutax;?>"><h3><?echo $dsm;?></h3></a>
      </a>
      <p><? echo ellistr($dsd,120);?></p>
    </article>




    <?
          $result->Movenext();
          }
        ?>




  </article>



 <?
   if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
             if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>

  <?include("incluidos_sitio/cms.productos/productos.categorias.inferior.php");?>
