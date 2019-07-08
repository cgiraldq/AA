<!--article class="slider_index">
  <div class="container">
    <div id="slides">
      <?
        $sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblcarrousel a where a.idactivo=1";
        //echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
            while(!$result->EOF){
             $dsimg=$result->fields[3];
             $dsruta=$result->fields[2];
      ?>
      <?if($dsruta<>""){?>
         <a href="<? echo $dsruta;?>" target="_blank"> <img src="<? echo $rutalocalimag;?>/contenidos/images/carrousel/<? echo $dsimg;?>" alt="Imagen"> </a>
      <?}else{?>
      <img src="<? echo $rutalocalimag;?>/contenidos/images/carrousel/<? echo $dsimg;?>" alt="Imagen">
      <?}?>

      <?
        $result->MoveNext();
             } // fin while
        }
        $result->Close();
      ?>
    </div>
  </div>
</article-->


<article class="slider_index">
  <div class="border_box">
        <div class="box_skitter box_skitter_otro box_skitter_lateral">
            <ul>
                <?
                  $sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblcarrousel a where a.idactivo=1";
                  //echo $sql;
                  $result=$db->Execute($sql);
                  if(!$result->EOF){
                      while(!$result->EOF){
                       $dsimg=$result->fields[3];
                       $dsruta=$result->fields[2];
                ?>

      <li>

        <?if($dsruta<>""){?>
          <a href="<? echo $dsruta;?>">
            <img src="<? echo $rutalocalimag;?>/contenidos/images/carrousel/<? echo $dsimg;?>" alt="Imagen">
          </a>
        <?}else{?>
          <img src="<? echo $rutalocalimag;?>/contenidos/images/carrousel/<? echo $dsimg;?>" alt="Imagen">
        <?}?>

      </li>
                <?
                  $result->MoveNext();
                       } // fin while
                  }
                  $result->Close();
                ?>

            </ul>
        </div>
    </div>
</article>