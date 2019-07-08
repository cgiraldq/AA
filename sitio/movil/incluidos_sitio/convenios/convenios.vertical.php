<article class="cont_paginas">

	<h1><? echo reemplazar($dstituloPagina);?></h1>
	<p><? echo reemplazar($dsd2Pagina);?></p>
	<? if($dsimgpaginas<>""){?>

		<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

	<?}?>
<?
  $sql="select dsm,dsd,dsimg1,dsvideo,id from tblcategoriaconvenios where idactivo not in(2,9) order by idpos  ";
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
	<article class="noticias_vertical">
		<? if($dsimg<>""){?>
			<a href="convenios.detalle.php?id=<? echo $id;?>"  >
				<img src="../../contenidos/images/producto/<? echo $dsimg; ?>">
			</a>
		<?}?>
		<a href="convenios.detalle.php?id=<? echo $id;?>"><h2><? echo $dsm?></h2></a>
		<h3></h3>
		<p><? echo ellistr($dsd,100);?></p>
		<a href="convenios.detalle.php?id=<? echo $id;?>" class="ver_mas" title="ver m&aacute;s">VER MÁS</a>
	</article>

	<!--div class="separador"></div-->
<?
$result->MOveNext();
}
}
$result->Close();
?>

</article>



