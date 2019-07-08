<? if($dsimgpaginas<>""){?>
	<a href="oficinas.detalle.php?id=<? echo $id;?>">
		<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">
	</a>
<?}?>
<article class="blq_txt">
<h1><? echo reemplazar($dstituloPagina);?></h1>
<p><? echo reemplazar($dsd2Pagina);?></p>

</article>

<ul class="cont_qsomos">

<?
  $sql="select dsm,dsd,dsimg,dsvideo,id from tblqsomos where idactivo not in(2,9) order by idpos  ";
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
		<? if($dsimg<>""){?>
			<a href="qsomos.detalle.php?id=<? echo $id;?>">
			<img src="../../contenidos/images/qsomos/<? echo $dsimg; ?>">
		</a>
		<?}?>
	<li>
		<a href="qsomos.detalle.php?id=<? echo $id;?>">
			<h2><? echo $dsm?></h2>
		</a>
		<p><? echo ellistr($dsd,100);?></p>
		<!--a href="qsomos.detalle.php?id=<? echo $id;?>" class="btn_general" title="ver m&aacute;s">Ver m&aacute;s</a-->
	</li>

<?
$result->MoveNext();
}
}
$result->Close();
?>

</ul>