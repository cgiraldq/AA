 <?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsruta,a.dsvideo from tblproductos a where idactivo=3 ";
      //echo $sql;
      $result=$db->Execute($sql);
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
          $dsvideo=$result->fields[5];

          $idcat=seldato("iddestino","idorigen","tbltblproductoxcategoria",$id,2);
          $nombrecat=seldato("dsruta","id","tblcategoria",$idcat,2);

          $dsrutax=$rutalocal."/detalles/".$nombrecat."/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;


         ?>
    <article class="productos_destacado">
      <h2>Producto destacado</h2>
      <a href="<? echo $dsrutax;?>">
          <div><? echo $dsvideo;?></div>
        <a href="<? echo $dsrutax;?>">
        <h3><? echo $dsm;?></h3></a>
      </a>
        <p><? echo ellistr($dsd,300);?></p>
        <a href="<? echo $dsrutax;?>"><p>ver mas</p></a>
    </article>
    <?
          $result->Movenext();
          }
        ?>


  </article>
<?
          $result->Movenext();
          }
        ?>


