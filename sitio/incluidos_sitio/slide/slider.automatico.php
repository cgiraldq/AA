<?
 $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsmodo,a.idfechai,a.idfechaf  from tblbanners a, tblbannersxtblpaginas b where a.idactivo='5' and a.id=b.idorigen and b.iddestino='$idpagina'";
 $sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf ";
 $sql.=" order by a.idpos asc ";
              //echo $sql;
              $result=$db->Execute($sql);
              if(!$result->EOF){
              $total=$result->RecordCount();

 if ($total==1) {

               $dsimg=$result->fields[3];
               $dsruta=$result->fields[2];
               $dsmodo=$result->fields[4];

               if ($dsruta<>""){
                $ahref1="<a href='".$dsruta."' target='".$dsmodo."' title='".reemplazar($mensaje)."'>";
                  $ahref2="</a>";
                }else{
                  $ahref1="";
                  $ahref2="";
                }


  ?>

<article class="centro_banner">

  <article class="img_banner">
        <? echo $ahref1?>
          <img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" >
        <? echo $ahref2?>

  </article>

</article>


  <?
 } else {               
?>
  <div class="container">

    <div id="slides">

	    <?
          //echo "entra";
              while(!$result->EOF){
               $dsimg=$result->fields[3];
               $dsruta=$result->fields[2];
               $dsmodo=$result->fields[4];

               if ($dsruta<>""){
                $ahref1="<a href='".$dsruta."' target='".$dsmodo."' title='".reemplazar($mensaje)."'>";
                  $ahref2="</a>";
                }else{
                  $ahref1="";
                  $ahref2="";
                }
        ?>

        <? echo $ahref1?>
      		<img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" >
      	<? echo $ahref2?>


	    <?
        $result->MoveNext();
             } // fin while
      	?>


    </div>

  </div>

  <?
} // fin validacion de iuna imagen

}
$result->Close();?>

