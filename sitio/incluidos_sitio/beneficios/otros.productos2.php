 <?
      $dsnombre=$_REQUEST["dsnombre"];

      if($partir[0]<>"") $dsnombre=$partir[0];


      $id=$_REQUEST["id"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg2,a.dsruta from tblcategoria a where idactivo=1 ";
      if($dsnombre<>'') $sql.=" and dsruta!='$dsnombre' ";
      if($id<>"") $sql.=" and id!='$id' ";

      //echo $sql;
      $maxregistros=9;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
    ?>
<article class="bql_categorias_centro">

	<ul>
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

 		<a href="<? echo $dsrutax;?>" class="ver_mas">
      <? if($dsimg<>""){?>
		<li>
      <img src="<? $rutalocal;?>/contenidos/images/producto/<? echo $dsimg;?>" alt="">
		</li>
    <?}?>
		</a>
 <?
          $result->Movenext();
          }
 ?>

	</ul>

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