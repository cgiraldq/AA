<article class="ecommerce_tiendas">
<?
$rutaImagen="../../contenidos/images/tiendas/";
?>
<ul>

		<?
$sqlx = "select a.dsm,a.dsd,a.dsruta,a.dsimg ";
$sqlx.="FROM tbltiendas a ";
$sqlx.="WHERE a.id>0  and a.idactivo not in (2,9) ";
$resultx=$db->Execute($sqlx);
if (!$resultx->EOF) {
while(!$resultx->EOF){
$dsimg=$resultx->fields[4];
?>
		<li>
			<?if(is_file($rutaImagen.$dsimg) && $dsimg<>""){?>
			<img src="<?echo $rutaImagen.$dsimg?>">
			<?}?>
			<p><strong><?echo reemplazar($resultx->fields[0])?></strong></p>
			<p><?echo reemplazar($resultx->fields[1])?></p>
			<?if($resultx->fields[1]<>""){?>
			<a href="<?echo $resultx->fields[2]?>" target="_blank"><p><?echo $resultx->fields[2]?></p></a>
			<?}?>
		</li>

<?
	$resultx->MoveNext();
	} // fin while
	 }
  $resultx->Close();
  include("departamento.php");
  include("paises.php");
?>

	</ul>





</article>