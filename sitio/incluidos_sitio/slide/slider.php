<? if($pagina<>"oficinas.php"){?>
<?
 $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsmodo,a.idfechai,a.idfechaf  from tblbanners a, tblbannersxtblpaginas b where a.idactivo='1' and a.id=b.idorigen and b.iddestino='$idpagina'";
 $sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf  order by a.idpos asc";
              //echo $sql;
              $result=$db->Execute($sql);
              if(!$result->EOF){

?>

<article class="galeria_index">

  <article class="centro_banner">

    <div class="border_box">
        <div class="box_skitter box_skitter_large">
            <ul>
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
               <li>

                <? echo $ahref1?>
                  <img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" class="block" />
                <? echo $ahref2?>

                <div class="label_text">
                  <div class="label_titulos">
                  <h1></h1>
                  <h2></h2>
                <p>
                </p>
                  </div>
                  <nav>
                    <a href=""></a>
                  </nav>
                </div>

              </li>
              <?
                $result->MoveNext();
                     } // fin while

              ?>
            </ul>
        </div>
    </div>
</article>
<?


}else{
$sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblbanners a, tblbannersxtblpaginas b where a.idactivo=6 and a.id=b.idorigen and b.iddestino='$idpagina'  order by a.idpos asc LIMIT 0,1";
                //echo $sql;
                $result=$db->Execute($sql);
                if(!$result->EOF){
?>

 <article class="centro_banner">


  <article class="img_banner">

              <?

                    while(!$result->EOF){
                     $dsimg=$result->fields[3];
                     $dsruta=$result->fields[2];
                ?>

                <a href="<? echo $dsruta;?>">
                  <img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" class="block" />
                </a>
                <!--div class="label_text"><p>block</p></div-->

              <?
                $result->MoveNext();
                     } // fin while

              ?>
</article>

</article>



</article>
<?}}$result->Close();?>

<?}?>

