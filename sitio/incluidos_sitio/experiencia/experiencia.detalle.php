<article class="cont_txt">

	<h1>NUESTRA EXPERIENCIA</h1>
	<?
      $dsnombre=$_REQUEST["dsnombre"];
      $id=$_REQUEST["id"];
      $idx=$_REQUEST["idx"];
      $cambio=explode("/",$dsnombre);

      $sql="select a.id,a.dsm,a.dsd,a.dsvideo,a.dsimg3,b.id,b.dsm from tblcategoriaexp a,";
      $sql.=" tblexperiencia b where b.id=a.idcat ";
      if($cambio[1]<>""){
        $sql.="and  a.dsruta='".$cambio[1]."' ";
      }else{
         if($dsnombre<>"") $sql.=" AND  b.dsruta='$dsnombre'  ";
         $sql.="and b.id=$id ";

         if($idx==""){
           $sql.="AND a.idactivo=3";
         }else{
             $sql.="AND  a.id=$idx";
         }

      }

     // echo $sql;
     $maxregistros=4;
      include($rut."incluidos_sitio/paginar_variables.php");
      $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
      if(!$result->EOF){
        //$id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=nl2br($result->fields[2]);
          $dsd=reemplazar($dsd);

           $dsvideo=$result->fields[3];

            $dsimg=$result->fields[4];

               $idcat=$result->fields[5];
               $nombreexp=$result->fields[6];
    ?>
  <h2><?echo $nombreexp;?></h2>


	<article class="servicios_detalle">

		<? echo $dsvideo; ?>




     <article class="bloque_texto2">

      <ul>

       <? if ($dsimg<>""){?>
        <a href="<? echo $dsrutax;?>"class="ver_mas"><img src="<?echo $rutalocalimag?>/contenidos/images/categoriaexp/<? echo $dsimg;?>" alt=""></a>
      <?}?>

       </li>

      <li>

      	<h2><?echo $dsm;?></h2>

      	<p><? echo $dsd;?></p>

        <br style="clear:both;">

      </li>

      </ul>

    </article>
    <?

     }
      $result->Close();

    ?>


<?
  if($idcat=="")$idcat=0;
 $sqlx="select a.id,a.dsm,a.dsruta,a.dsimg1,a.dsimg2 from tblcategoriaexp a where a.idactivo!=2 and a.idcat=$idcat ";
   if($cambio[1]<>"")$sqlx.="and a.dsruta!='".$cambio[1]."'";

    //echo $sqlx;
    $resultx=$db->Execute($sqlx);
    if(!$resultx->EOF){
?>
<h1>OTROS: <? echo $nombreexp;?></h1>
   <div id='carousel_container'>
  <div id='left_scroll'><img src="<? echo $rutalocalimag;?>/sitio/images/prev2.png" /></div>
    <div id='carousel_inner'>
        <ul id='carousel_ul'>
          <?

                while(!$resultx->EOF){
                $idm=$resultx->fields[0];
                 $dsimg1=$resultx->fields[3];
                 $dsimg2=$resultx->fields[4];
                 $dsrutax=$resultx->fields[2];

                  $dsrutax1=$rutalocal."/tv_experiencia/".$cambio[0]."/".$dsrutax;
                    if ($rutaAmiga>1) $dsrutax1="experiencia.detalle.php?id=".$id."&idx=".$idm;

          ?>

            <li><a href="<?echo $dsrutax1;?>"class="" rel="lightbox">
             <? if($dsimg1<>""){?> <img src="<? echo $rutalocalimag;?>/contenidos/images/categoriaexp/<? echo $dsimg1;?>"  class="img_carrousel" /> <?}?>
                </a>
            </li>
         <?
            @$resultx->MoveNext();
                 } // fin while

        ?>

        </ul>
    </div>
  <div id='right_scroll'><img src="<? echo $rutalocalimag;?>/sitio/images/next2.png" /></div>
</div>
<?
 }
            @$resultx->Close();

?>

  </article>

</article>









