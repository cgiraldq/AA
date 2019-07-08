<article id="cont_zona">
	<article class="cont_bvzona">
		<?
			$sqlp="select id,dsfecha,count(*) as total ";
			$sqlp.="from tblhistorialingresocliente where idcliente=".$_SESSION['i_idcliente']." ";
			$sqlp.=" GROUP BY id DESC LIMIT 1 OFFSET 1";
			//echo $sqlp;
		?>

		<?
			$resultp=$db->Execute($sqlp);
			if(!$resultp->EOF){
				$id=$resultp->fields[0];
				$ultimafecha=$resultp->fields[1];
		?>
				<p class="Ultima_vista">Última Visita: <?echo $ultimafecha?></p>
		<?
			}
			$resultp->Close();
		?>
		<h2>Bienvenido(a) a la zona privada: <span><? echo $_SESSION['i_dsnombre']?></span></h2>
		<p class="Ultima_vista"><?if ($dscodigousa <>"") { echo 'Código casillero USA: <strong style="color:#000;">'.$dscodigousa.'</strong>'; }?> <?if ($dscodigouk <>"" && $dscodigousa<>"") { echo ' - '; }?> <?if ($dscodigouk <>"") { echo 'Código casillero UK: <strong style="color:#000;">'.$dscodigouk.'</strong>'; }?></p>
		<?
	            $sql="select dsd2 from tblpaginas where dsm='$pag'";
	            //echo $sql;
	            $result=$db->Execute($sql);
	            if(!$result->EOF){
	            $dsd=reemplazar($result->fields[1]);
	            $dsd=preg_replace("/\n/","<br>",$dsd);
	    ?>
	        <!-- <p><? echo $dsd; ?></p> -->
	    <?
	        $result->close();
	        }
	      //echo $mensaje;
	    ?>

		<?
			$sqlp="select count(*) as total, idestado ";
			$sqlp.="from tblpagos where idclientepago=".$_SESSION['i_idcliente'];
			$sqlp.=" and idtienda = 1 group by idestado ";
			$sqlp.=" order by idclientepago ASC ";
			//echo $sqlp;
		?>

		<?
			$resultp=$db->Execute($sqlp);
			if(!$resultp->EOF){
		?>
		<ul class="cont_list_proceso">
			<h4>Estado de tu Compra</h4>
			<?
					while(!$resultp->EOF){
					$idtotal=$resultp->fields[0];
			?>
			<li class="list_proceso">
				<a href="zona.privada.php?idestado=<?echo $resultp->fields[1]?>#historial"><p><?echo ver_estado($resultp->fields[1]);?>: <?echo $idtotal?></p></a>
			</li>
			<?
			  $resultp->MoveNext();
				}
			?>
		</ul>
		<?
			}
			$resultp->Close();
		?>
			<!--input type="button" onclick="irAPaginaD('salir.php?salir=1');" value="" class="btn_general_cerrar"-->
	<?$sql="select id from tbltextozona where idactivo in (1) order by idpos ASC , id DESC";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){?>
		<a href="#cont_textos_zona" class="lightbox btn_ayuda" title="Ayuda"></a>
	<?
	}
	$result->Close();
	?>
	</article>

    <ul class='tabs'>
    	<li><a href='#mi_casillero' class=""><article class="casillero"><p>Actualiza Tus datos</p></article></a></li>
    	<li><a href='#historial' class=""><article class="historial"><p>Historial</p></article></a></li>
	    <li><a href='#actualizar_datos' class=""><article class="clave"><p>Cambiar Contrase&ntilde;a</p></article></a></li>
	    <!---li><a href='#actualizar_datos' class=""><article class="tracking"><p>Tracking</p></article></a></li-->
	    <!--li><a href='#prealertas' class=""><article class="alerta"><p>Pre-Alerta tus Compras</p></article></a></li-->
	    <!--li><a href='#ofertas' class=""><article class="ofertas" onClick="irAPaginaD('index.php#ofertas');"><p>Ofertas</p></article></a></li-->
	    <!--li><a href='#compra_asistida' class=""><article class="casistida" onClick="irAPaginaD('compra.asistida.php#compra_asistida');"><p>Compra Asistida</p></article></a></li-->
	    <!--li><a href='#tiendas_recomendadas' class="" onClick="irAPaginaD('tiendas.php#tiendas_recomendadas');"><article class="trecomendas"><p>Tiendas Recomendas</p></article></a></li-->
	</ul>

	<?include("incluidos_sitio/zona_privada/mi.casillero.zona.privada.php");?>
	<?include("incluidos_sitio/zona_privada/historial.zona.privada.php");?>
	<?include("incluidos_sitio/zona_privada/actualizar.datos.zona.privada.vertical.php");?>
	<?//include("incluidos_sitio/zona_privada/prealertas.zona.privada.vertical.php");?>
	<?//include("incluidos_sitio/zona_privada/ofertas.zona.privada.php");?>
	<?//include("incluidos_sitio/zona_privada/compra.asistida.php");?>
	<?//include("incluidos_sitio/zona_privada/tiendas.recomendadas.php");?>
</article>
<?//include("incluidos_sitio/index/destacado.php");?>

<?include("incluidos_sitio/zona_privada/textos.php");?>