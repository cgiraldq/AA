<?$edit=$_REQUEST['edit'];
$rutaImagenhome=$rutaFuenteImagenes."/contenidos/images/entorno_sitio/";
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
$sql.=" from tblconstructorhome a ";
$sql.=" where a.idactivo  in (3) and idpos=1 order by rand() limit 0,1 ";

            $result=$db->Execute($sql);
            if(!$result->EOF){
          $contar=0;
            while (!$result->EOF) {
        $dsm=$result->fields[0];
        $dsd=reemplazar($result->fields[1]);
        $dsd=preg_replace("/\n/","<br>", $dsd);
        $dsimg=$result->fields[2];
        $idpos=$result->fields[3];
        $dsruta=$result->fields[4];
        $idactivo=$result->fields[5];
        $dsimg2=$result->fields[6];
        $dsvideo=$result->fields[7];
?>
<article class="bloque_inf">
  <? if ($edit==1) echo "POS 1<br>";?>
	<article class="qsomos_index">
    <?if($dsruta<>"")?><a href="<?echo $dsruta?>"class="ver_mas">
      <h1><? echo $dsm?></h1>
    <?if($dsruta<>"")?></a>
        <p><? echo $dsd?></p>
		  <?if($dsruta<>"")?><a href="<?echo $dsruta?>"class="btn_color">
			<p>ver trayectoria</p>
			<img src="images/icono_trayectoria.png" alt="">
		<?if($dsruta<>"")?></a>
	</article><?
	            $result->MoveNext();
          }
      }
      $resultx->Close();

?>


<article class="modelos">
<? if ($edit==1) echo "POS 2";
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
$sql.=" from tblconstructorhome a ";
$sql.=" where a.idactivo  in (1) and idpos=2 order by rand() limit 0,1 ";
$result=$db->Execute($sql);
if(!$result->EOF){
$contar=0;
while (!$result->EOF) {
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];
$dsimg2=$result->fields[6];
$dsvideo=$result->fields[7];
if (is_file($rutaImagenhome.$dsimg) && $dsimg<>""){?>
<?if($dsruta<>"")?><a href="<? echo $dsruta?>">
<img src="<? echo $rutaImagenhome.$dsimg?>" alt=""/>
<!--h2><?//echo $dsm?></h2-->
<?if($dsruta<>"")?></a>
<?}elseif ($dsvideo<>"" && $dsimg=="") {
echo $dsvideo;
}
$dsvideo="";
$result->MoveNext();
}
}
$resultx->Close();
?>
</article>



<?
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
$sql.=" from tblconstructorhome a ";
$sql.=" where a.idactivo  in (1) and idpos=3 order by idpos asc  ";
$result=$db->Execute($sql);
if(!$result->EOF){?>
  <article class="slider_index">
  <? if ($edit==1) echo "POS 3.1";?>
      <div class="container">
            <div id="slides">
                        <?
                        $contar=0;
                        while (!$result->EOF) {
                        $dsm=$result->fields[0];
                        $dsd=$result->fields[1];
                        $dsimg=$result->fields[2];
                        $idpos=$result->fields[3];
                        $dsruta=$result->fields[4];
                        $idactivo=$result->fields[5];
                        $dsimg2=$result->fields[6];
                        $dsvideo=$result->fields[7];
                        if (is_file($rutaImagenhome.$dsimg) && $dsimg<>""){?>
                        <?if($dsruta<>"")?><a href="<? echo $dsruta?>">
                        <img src="<? echo $rutaImagenhome.$dsimg?>" alt=""/>
                        <?if($dsruta<>"")?></a>
                        <?}
                        $contarpos3++;
                        $result->MoveNext();
                        }?>
            </div>
      </div>
  </article>
<?
}else{?>


<article class="video_index">

      <? if ($edit==1) echo "POS 3.1";
      $sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
      $sql.=" from tblconstructorhome a ";
      $sql.=" where a.idactivo  in (5) and idpos=3 order by rand() limit 0,1 ";
      $result=$db->Execute($sql);
      if(!$result->EOF){
      $contar=0;
      while (!$result->EOF) {
      $dsm=$result->fields[0];
      $dsd=$result->fields[1];
      $dsimg=$result->fields[2];
      $idpos=$result->fields[3];
      $dsruta=$result->fields[4];
      $idactivo=$result->fields[5];
      $dsimg2=$result->fields[6];
      $dsvideo=$result->fields[7];
      echo $dsvideo;
      $result->MoveNext();
      }
      }
      $resultx->Close();
      ?>

</article>

<?
}$resultx->Close();?>






</article>


 <? if ($edit==1) echo "POS 4";?>
<article class="banner_index"><?

$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
$sql.=" from tblconstructorhome a ";
$sql.=" where a.idactivo  in (1) and idpos=4 order by rand() limit 0,1 ";

            $result=$db->Execute($sql);
            if(!$result->EOF){
          $contar=0;
            while (!$result->EOF) {
        $dsm=$result->fields[0];
        $dsd=$result->fields[1];
        $dsimg=$result->fields[2];
        $idpos=$result->fields[3];
        $dsruta=$result->fields[4];
        $idactivo=$result->fields[5];
        $dsimg2=$result->fields[6];
        $dsvideo=$result->fields[7];
      if (is_file($rutaImagenhome.$dsimg) && $dsimg<>""){?>
            
        <?if($dsruta<>"")?><a href="<? echo $dsruta?>">
          <img src="<? echo $rutaImagenhome.$dsimg?>" alt=""/>
        <?if($dsruta<>"")?></a>
      <?}elseif ($dsvideo<>"" && $dsimg=="") {
        echo $dsvideo;
      }
          $dsvideo="";
            $result->MoveNext();
          }
      }
      $resultx->Close();
      ?>







</article>