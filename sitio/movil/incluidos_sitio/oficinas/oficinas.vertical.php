<article class="cont_paginas">

	<article class="bloques_destacados">
		<? if($dsimgpaginas<>""){?>

			<img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

		<?}?>
		<h1><? echo reemplazar($dstituloPagina);?></h1>
		<p><? echo reemplazar($dsd2Pagina);?></p>
	</article>
<?
  $sql="select dsm,dsd,dsimg,id from tblciudades where idactivo not in(2,9) order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];

  $id=$result->fields[3];
?>
	<article class="noticias_vertical">
		<a href="oficinas.detalle.php?id=<? echo $id;?>"><h2><? echo $dsm?></h2></a>
		<h3></h3>

		<? if($dsimg<>""){?>
			<a href="oficinas.detalle.php?id=<? echo $id;?>" >
			<img src="../../contenidos/images/banners/<? echo $dsimg; ?>">
			</a>
		<?}?>

		<p><? echo ellistr($dsd,100);?></p>
		<a href="oficinas.detalle.php?id=<? echo $id;?>" class="ver_mas" title="ver m&aacute;s">VER MÁS</a>
	</article>

	<!--div class="separador"></div-->
<?
$result->MOveNext();
}
}
$result->Close();
?>


</article>



