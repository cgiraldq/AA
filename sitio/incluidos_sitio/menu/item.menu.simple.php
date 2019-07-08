<li><a href="<?echo $rutalocal?>/index.php">Inicio</a></li>



<? // validacion existencia del modulo
if(validar_core($_SESSION['i_idusuario'],75)>0){
?>
<li class="nodiv"><a href="<?echo $rutalocal?>/ecommerce.categoria.php">Catálogo</a>
<li><a href="<?echo $rutalocal?>/tiendas.php">Dónde comprar</a></li>

<? } ?>

<li><a href="<?echo $rutalocal?>/qsomos.php">Estilos Adriana Arango</a></li>
<li><a href="<?echo $rutalocal?>/noticias.php">Tips</a></li>
<li><a href="http://www.adrianaarango.com/sitio/indexblog.php">Blog</a>

<li><a href="<?echo $rutalocal?>/contacto.php">Contacto</a></li>

