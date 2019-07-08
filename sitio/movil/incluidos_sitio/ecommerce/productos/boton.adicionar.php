<? if ($idtipo==1) {?>
	<? if($dsdisponible==1 && $dsunidadesdispo>0 && ($idactivo<>2 && $idactivo<>9) && $precio1>0){ ?>
<ul class="btn_comprar">
	<li>
				<a onclick="adicionar_tallas_colores('<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>')"   class="btn_carrito"><p>Comprar</p></a>
	</li>
	<!--li>
		<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_anadir"><p>Añadir a lista de deseos</p></a>
	</li-->
</ul>
<? } ?>

<? }elseif($idtipo==2){?>
	<? if($dsdisponible==1 && $dsunidadesdispo>0 && ($idactivo<>2 && $idactivo<>9) && $precio1>0){ ?>

<ul class="btn_comprar">
	<li>
					<a onclick="adicionar_tallas_colores('<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>')"   class="btn_carrito"><p>Comprar</p></a>
	</li>
	<!--li>
		<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_anadir"><p>Añadir a lista de deseos</p></a>
	</li-->

</ul>
<? } ?>

<?}else{?>
<?   $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);// ?><!--VALOR MINIMO DE COMPRA DISTRIBUIDOR-->
	<? if($tipocliente==2){ ?>
			<? if($dsdisponible==1 && $dsunidadesdispo>0 && ($idactivo<>2 && $idactivo<>9) && $precio1>0){ ?>

		<ul class="btn_comprar">
			<li>
			<a  href="<? echo $rutbase ?>/carrito.distribuidor.php" class="btn_carrito"><p>Compra</p></a>
			</li>
			<!--li>
				<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_anadir"><p>Añadir a lista de deseos</p></a>
			</li-->

		</ul>

		<? } ?>
	<? }else{?>

	<? if($dsdisponible==1 && $dsunidadesdispo>0 && ($idactivo<>2 && $idactivo<>9) && $precio1>0){ ?>

	<ul class="btn_comprar">
		<li>
			<a onclick="adicionar_tallas_colores('<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>')"   class="btn_carrito"><p>Comprar</p></a>
		</li>
		<!--li>
			<a href="<? echo $rutbase?>/adicionar.php?idproducto=<? echo $idproducto?>"class="btn_anadir"><p>Añadir a lista de deseos</p></a>
		</li-->

	</ul>

		<? } ?>
		<? } ?>
<? } ?>
<script type="text/javascript">
function adicionar_tallas_colores(ruta){
var base=document.getElementById('mensaje');
	
var color="NO";
var colorx=producto_detalle.idcolor.value;
var talla=document.getElementById('idtalla').value;
if(talla==""){
if (base) base.style.display="";
document.getElementById("mensaje").innerHTML="<h4>Seleccione un talla</h4>";
return;
}

for(var i = 0;i<producto_detalle.idcolor.length; i++ ){

if (producto_detalle.idcolor[i].checked ){
color= "SI";
break;
}

}// fin for

if ( color == "NO" ){
if (base) base.style.display="";
document.getElementById("mensaje").innerHTML="<h4>Seleccione un color</h4>";
return;
}

location.href=ruta+"&sel_colores="+colorx+"&sel_tallas="+talla;

}


</script>