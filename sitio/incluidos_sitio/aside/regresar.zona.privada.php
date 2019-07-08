<? if( $_SESSION['i_idregist']<>""){?>
<article class="cont_zona_clientes">
	<h2>Zona Privada</h2>
	<h3>Bienvenido</h3>
	<p>
		<?   $nombre=$_SESSION['i_idsnombre']." ".$_SESSION['i_idsapellidos'];
			echo reemplazar($nombre);
		?>
	</p>

	<a href="<? echo $rutalocal;?>/zona.privada.php" class="btn_general"><p>Regresar</p></a>

	<a href="<? echo $rutalocal;?>/salir.php" class="btn_general"><p>Cerrar sesión</p></a>
</article>
<?}?>