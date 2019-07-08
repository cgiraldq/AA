<? if($idvista==1 and $idpagina==1){?>
<?
  $id=$_REQUEST["id"];
  $sql="select dsm,dsd,dsimg,dsvideo,id from tblqsomos where idactivo=1 order by idpos  ";
  //echo $sql;
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
  $id=$result->fields[4];
?>
<article class="blq_txt">
		<? if($dsimg<>""){?>
      <a href="noticias.detalle.php?id=<? echo $id;?>">
      <img src="../../contenidos/images/qsomos/<? echo $dsimg; ?>">
      </a>
    <?}?>
		<h1><? echo $dsm;?></h1>
    <p><? echo ellistr($dsd,120);?></p>
		<a href="qsomos.detalle.php?id=<? echo $id;?>" class="btn_general" title="ver m&aacute;s">Ver m&aacute;s</a>
</article>
<?
$result->MOveNext();
}
}
$result->Close();
?>

<?}?>
