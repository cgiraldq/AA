<?if($id<>""){?>
    <?
          //$db->debug=true;
            $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsimg2 from tblgaleria a where a.idactivo=4 and idevento=".$id;
            //echo $sql;
            $result=$db->Execute($sql);
            if(!$result->EOF){?>
<div class="container">

  <div id="slides">
      <?
                while(!$result->EOF){
                 $dsimg=$result->fields[3];
                 $dsimg2=$result->fields[4];
                 $dsruta=$result->fields[2];
                 if($dsimg=="")$dsimg=$dsimg2;
                 if($dsim2=="")$dsim2=$dsimg;
                 if($dsimg2<>""){
          ?>

              <img src="/contenidos/images/galeria/<? echo $dsimg;?>"  >
         
         <?
       }
            $result->MoveNext();
                 } // fin while
      
        ?>

  </div>

</div>

<?
      }
            $result->Close();

}?>



