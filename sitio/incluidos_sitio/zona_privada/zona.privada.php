
<article id="cont_zona" class="cont_zona">
	<!--article class="cont_bvzona">
		<h1><? echo $dstituloPagina;?></h1>
			<h2>
				Bienvenido	<?echo reemplazar($_SESSION['i_dsnombre']);?>
			</h2>
	<a href="salir.php"><input type="button" value="Cerrar Sesión" class="btn_general"></a>
	</article-->

    <ul class='tabs'>
	    
	    <li><a href='#cont_carrito' class="btn_general">ÚLTIMAS CAMPAÑAS</a></li>
	    <li><a href='#actualizar_datos_form' class="btn_general">MI CUENTA</a></li>
	    <!--li><a href='#historial' class="btn_general">HISTORIAL</a></li-->
	    <li><a href='#pedidos' class="btn_general">MIS PEDIDOS</a></li>
	    <li><a href='#videos' class="btn_general">DOCUMENTOS Y FORMACIÓN</a></li>
	    <li><a href='#notas' class="btn_general">NOTICIAS</a></li>

	</ul>

	
	<?//include("incluidos_sitio/zona_privada/historial.zona.privada.php");?>
	<?include("incluidos_sitio/ecommerce/carrito/carrito.php");?>
	<?include("incluidos_sitio/zona_privada/actualizar.php");?>
	<?//include("incluidos_sitio/zona_privada/actualizar.contrasena.php");?>
	<?//include("incluidos_sitio/zona_privada/documentos.zona.privada.php");?>
	<?include("incluidos_sitio/zona_privada/pedidos.php");?>
	<?include("incluidos_sitio/zona_privada/videos.zona.privada.php");?>
	<?include("incluidos_sitio/zona_privada/notas.zona.privada.php");?>
</article>