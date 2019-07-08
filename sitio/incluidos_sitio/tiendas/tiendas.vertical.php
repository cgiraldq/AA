<ul class="ecommerce_tiendas">
	
		


				<?
				$rutaimg_galeria=$rutalocalimag."/contenidos/images/galeria/";
				$sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsimg2 from tblgaleria a where a.idactivo=3";
				$result=$db->Execute($sql);
				if(!$result->EOF){?>
				<li>
				<div class="gallery items-3">
				<!--div id="item-1" class="control-operator"></div>
				<div id="item-2" class="control-operator"></div-->
				<?
				$contar=1;
				while(!$result->EOF){
				$dsimg=$result->fields[3];
				$dsimg2=$result->fields[4];
				$dsruta=$result->fields[2];
				if(is_file($rutaimg_galeria.$dsimg) || $dsimg<>""){
				?>
				<div id="item-<?echo $contar?>" class="control-operator"></div>
				<figure class="item">
				<img src="<? echo $rutaimg_galeria.$dsimg;?>"  class="img_carrousel" />
				</figure>
				<?
				$contar++;
				}
				$result->MoveNext();
				} // fin while?>
				<div class="controls">
				<?for ($i=1; $i <$contar;$i++) { ?>
				<a href="#item-<?echo $i?>" class="control-button">•</a>
				<?}?>
				<!--a href="#item-1" class="control-button">•</a>
				<a href="#item-2" class="control-button">•</a-->
				</div>
				</div>
				</li>
				<?
				}
				$result->Close();
				?>



<?
$rutaImagen=$rutaFuenteImagenes."/contenidos/images/tiendas/";
$sqlx = "select a.dsm,a.dsd,a.dsruta,a.dsimg,a.id,b.id ";
$sqlx.="FROM cms_tbltiendas a left join cms_tblmapasxtienda b on b.idtienda=a.id ";
$sqlx.="WHERE a.id>0 and a.idactivo=3 order by idpos asc";
$resultx=$db->Execute($sqlx);
if (!$resultx->EOF) {
while(!$resultx->EOF){
$dsimg=$resultx->fields[3];
$id=$resultx->fields[4];
$idmapa=$resultx->fields[5];


?>
	<li>
	<?if(is_file($rutaImagen.$dsimg) && $dsimg<>""){?>
	<img src="<?echo $rutaImagen.$dsimg?>">
	<?}?>
	<h2><?echo reemplazar($resultx->fields[0])?></h2>
	<p><?echo reemplazar($resultx->fields[1])?></p>
	<?if($resultx->fields[1]<>""){?>
	<a href="<?echo $resultx->fields[2]?>" target="_blank"><p><?echo $resultx->fields[2]?></p></a>
	<?}?>
	<?if($idmapa<>""){?>
	<nav>
	<a  href="<?echo $rutbase?>/mapa.php?idtienda=<?echo $id?>" class="btn_tiendas ver_mapa" rel="ver_mapa" onclick="cargar();">Ver mapa</a>
	</nav>
	<?}?>
	</li>

<?
$resultx->MoveNext();
} // fin while
}
$resultx->Close();
?>



	
</ul>


 <script language="javascript">
<!--
  function cargar() {
          $(".ver_mapa").colorbox({iframe:true, width:"45%", height:"70%"});
}
//-->

        </script>