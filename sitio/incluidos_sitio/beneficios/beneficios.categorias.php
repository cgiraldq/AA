
   <h1><? echo reemplazar($dstituloPagina);?></h1>
   <p><? echo reemplazar($dsd2Pagina);?></p>


   <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta from tblcategoria a where idactivo=1  ";
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



          $sqlx="select count(*) as total from tblsubcategoriasxcategoria a where a.idcategoria=$id and idactivo=1";

          $resultx=$db->Execute($sqlx);
          if(!$resultx->EOF){
             $total=$resultx->fields[0];

             if($total>0) $ruta="mis_subcategorias";
            if($total<1) $ruta="mis_productos";

             if($total>0) $rutax="productos.subcategorias.php";
            if($total<1) $rutax="productos.php";

          }


          $dsruta=$result->fields[4];
          $dsrutax=$rutalocal."/".$ruta."/".$dsruta;
        if ($rutaAmiga>1) $dsrutax=$rutax."?id=".$id;


         ?>
    <article class="categorias_productos">

      <a href="<? echo $dsrutax;?>">

      <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"><img src="<?echo $rutalocalimag?>/contenidos/images/producto/<? echo $dsimg;?>" alt=""></a>
      <?}?>
        <a href="<? echo $dsrutax;?>"><h2><?echo $dsm;?></h2></a>
      </a>
      <p><? echo ellistr($dsd,150);?></p>
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

            include($rut."incluidos_sitio/func.paginador.php");

          }
     }
      $result->Close();

    ?>
    <? include("productos.destacado.php");?>
    </article>
</article>


