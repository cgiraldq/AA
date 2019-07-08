<? if( $_SESSION['i_idregist']<>""){?>
<article class ="sesion_header">
	<p><?  $nombre=$_SESSION['i_idsnombre']." ".$_SESSION['i_idsapellidos'];
					echo reemplazar($nombre);
				?>
	</p>

	<a href="http://giraldoherreraabogados.com/sitio/zona.privada.php">		<h2>|  Regresar a zona clientes | </h2> 	</a>

	<a href="<? echo $rutalocal;?>/salir.php">	<h2 class="rojo">Cerrar Sesi&oacute;n</h2>	</a>

</article>
<?}?>