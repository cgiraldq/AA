<?
      $dsnombre=$_REQUEST["dsnombre"];
      $sql="select a.id,a.dsm,a.dsd,a.dsimg from tblpolitica a  ";

      $result=$db->Execute($sql);
      if(!$result->EOF){
      	 $id=$result->fields[0];
          $dsm=reemplazar($result->fields[1]);
          $dsd=reemplazar($result->fields[2]);
           $dsimg=reemplazar($result->fields[3]);
    ?>
<article class="cont_header" style="text-align:center;">
	<img src="images/logo_principal.jpg">
</article>

<article class="info_frm ">
	<h2><? echo $dsm;?></h2>
	<p><? echo $dsd;?></p>
	 <? if($dsimg<>""){?>
          <img src="<?echo $rutalocalimag?>/contenidos/images/premios/<? echo $dsimg;?>">
          <?}?>
</article>
<?
   }
   $result->Close();

 ?>