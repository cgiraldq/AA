<ul class="btn_comprar">
<li>
<? if ($dsurlpago<>"") {?>
<a href="<? echo $dsurlpago?>" target="_blank" class="btn_carrito"><p>Comprar</p></a>
<?} else {
?>
<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_carrito"><p>Comprar</p></a>
<? } ?>
<!--a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"  class="btn_carrito"><p>Regresar</p></a-->
</li>
</ul>