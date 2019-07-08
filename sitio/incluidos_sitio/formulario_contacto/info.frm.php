<?

$id=$_REQUEST['idform'];
$rutaimagen="../contenidos/images/terminos/";
$sql="select a.dsm,a.dsd,a.dsimg ";
$sql.="from tblterminos a ";
if($id<>"")$sql.=", tblterminosxtblformularios b  ";
$sql.="  where 1  and a.idactivo not in (2,9) ";
if($id<>"")$sql.=" and a.id=b.idorigen and  b.iddestino=$id  ";
$resultx=$db->Execute($sql);
if(!$resultx->EOF){
$dsm=reemplazar($resultx->fields[0]);
$dsd=reemplazar($resultx->fields[1]);
$dsd=preg_replace("/\n/","<br>",$dsd);
$dsimg=$resultx->fields[2];
?>

<article class="cont_header" style="text-align:center;">
<? if($dsimg<>"" && is_file($rutaimagen.$dsimg)){?>
<img src="<?echo $rutaimagen.$dsimg;?>">
<?}?>
</article>

<article class="info_frm ">
  <h2><? echo $dsm;?></h2>
  <p><? echo $dsd;?></p>
</article>
<?
}
$resultx->Close();
?>