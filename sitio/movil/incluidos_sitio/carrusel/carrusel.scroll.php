<article class="carrusel_imagenes">
  
<?
$sql="select dsm,dsd,dsimg,dsvideo,dsruta,id from $dstabla where idactivo=1  and idpos=0 limit 0,1  ";
$result = $db->Execute($sql);
if (!$result->EOF) {
$dsm=reemplazar($result->fields[0]);
$dsd=trim($result->fields[1]);
$dsd=reemplazar($dsd);
$dsimg=$result->fields[2];
$dsvideo=$result->fields[3];
$dsruta=$result->fields[4];
$id=$result->fields[5];
$dsrutax=$rutalocal."/quienes_somos/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutalocal/".$rutadetalle."?id=".$id;
if($id==$idm) $dsrutax="";
?>

<h1><?echo $dsm;?></h1>
<p><?echo ellistr($dsd,400);?></p>
<nav>
  <a href="<? echo $dsrutax;?>" class="ver_mas">ver+</a>
</nav>
<?}
$result->Close();
?>
<br>


<div id="demo">
		<section id="examples" class="snap-scrolling-example">
			
<?
  $sql="select dsm,dsd,dsimg,dsvideo,dsruta,id from $dstabla where idactivo=5 order by idpos  ";

  $result = $db->Execute($sql);
  if (!$result->EOF) {?>
			<!-- content -->
			<div id="content-1" class="content horizontal-images">
				<ul>
<?
  while(!$result->EOF) {

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
  $dsruta=$result->fields[4];
  $id=$result->fields[5];
  $dsrutax=$rutalocal."/quienes_somos/".$dsruta;
  if ($rutaAmiga>1) $dsrutax="$rutalocal/".$rutadetalle."?id=".$id;
  if($id==$idm) $dsrutax="";
?>
<li>
<? if ($dsimg<>""){?>
<a href="<? echo $dsrutax;?>"class="ver_mas">
<img src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg;?>" alt="">
</a>
<?}?>
<h2><? echo $dsm;?></h2>
</li>
<?
$result->MOveNext();
}?>


				</ul>
			</div><?
}
$result->Close();
?>
			
		</section>
	</div>
<?
  $sql="select dsm,dsd,dsimg,dsvideo from $dstabla where idactivo=5  and idpos=0 limit 0,1  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];
  if($dsrutax<>""){?>
<nav class="cont_trayectoria">
	<a href="<? echo $dsrutax;?>" class="btn_trayectoria">VER TRAYECTORIA</a>
</nav>
<?
}
}
$result->Close();
?>
</article>


