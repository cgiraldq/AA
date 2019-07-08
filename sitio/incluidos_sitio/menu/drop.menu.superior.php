<nav class="cont-drop_menu" id="cont-drop_menu">
	<ul id="drop_menu" class="drop_menu">
		<li class="li_p"><a href="<?echo $rut?>index.php" class="drop">Inicio</a>
			<!-- <article class="dropdown_columns">
				<article class="col_img">
					<img src="http://localhost/astronic/contenidos/images/destacado/locuradepreciotablettitan7009hd_copiar_2-011609-1.jpg" alt="">
				</article>
				<article class="col_agrupar">
					<article class="col_1">
						<p>text 1</p>
					</article>
					<article class="col_2">
						<p>text 2</p>
					</article>
					<article class="col_3">
						<p>text 3</p>
					</article>
					<article class="col_4">
						<p>text 4</p>
					</article>
				</article>
			</article> -->
		</li>
		<li class="li_p"><a href="<?echo $rut?>tienda.php" class="drop">Empresa</a>
		<!--	<article class="dropdown_columns dropdown_1columns">

					<<article class="col_1">
	                    <ul class="simple">
				    		<li class="noborder"><a href="<?echo $rut?>terminos.condiciones.php">T&eacute;rminos y Condiciones</a></li>
				    		<li class=""><a href="<?echo $rut?>preguntas.frecuentes.php">Preguntas Frecuentes</a></li>
				    		< <li class=""><a href="<?echo $rut?>compra.asistida.php">Compra Asistida</a></li>
				    		<li><a href="<?echo $rut?>tiempos.entrega.php">Tiempo de Entrega</a></li> -->
				    		<!--li class=""><a href="vender.producto.php">Como vender mis productos</a></li-->
				    		<!--li class=""><a href="mi.tienda.php">Como obtener mi tienda</a></li-->
				    		<!--li class=""><a href="<?echo $rut?>ayuda.php">Ayuda</a></li>
	                    </ul>
					</article>
			</article> -->
		</li>
		<li class="li_p"><a href="<?echo $rut?>categoria.productos.php" class="drop">Productos</a>
			<article class="dropdown_columns dropdown_2columns">

				<article class="col_img">
					<? $ubic=11;$limit=1;include($rut."incluidos_sitio/banners/panel.banners.php"); ?>
				</article>

				<article class="col_agrupar">
					<article class="col_1">
						<h2>CATEGORÍAS</h2>
						<?
						// listar categorias de la tienda
							$sql="select a.id,a.dsm from tblcategoria a ";
							if ($idtienda>0) $sql.=" inner join tblempresaxtblcategoria b on b.idorigen=a.id ";

							$sql.=" where dsm<>'Servicios' and  a.idactivo in (";
								$sql.="1";
								if ($idtienda>0)  $sql.=",8";
								$sql.=") ";
							if ($idtienda>0) $sql.=" and b.iddestino=$idtienda ";

							$sql.=" and a.idtipo=1 order by dsm ";

						//echo $sql;
						//exit();
									$resultx=$db->Execute($sql);
									if(!$resultx->EOF){

						?>
							    	<ul class="simple-categorias">
						<?
									while (!$resultx->EOF) {
									$idm=$resultx->fields[0];
									$dsm=reemplazar($resultx->fields[1]);


						?>
							 		<li><a href="<?echo $rut?>productos.php?idcat=<? echo reemplazar($idm)?>"><? echo reemplazar($dsm)?></a></li>
						<?
								$resultx->MoveNext();
								} // fin while

						?>
							    	</ul>
						<?
						// fin listar lkas categorias de la tienda
									}
									$resultx->Close();

						?>
					</article>
				</article>
			</article>
		</li>
		<li class="li_p"><a href="<?echo $rut?>productos.php?idcat=30" class="drop">Como ser distribuidor</a></li>
		<li class="li_p"><a href="<?echo $rut?>casillero.php" class="drop">Registrate</a></li>
		<li class="li_p"><a href="<?echo $rut?>novedades.php" class="drop">preguntas frecuentes</a></li>
		<li class="li_p"><a href="<?echo $rut?>contacto.php" class="drop">Contacto</a></li>
		<li class="li_p"><a href="<?echo $rut?>tienda.php" class="drop">Quiénes Somos</a>
			<article class="dropdown_columns dropdown_1columns">

					<article class="col_1">
	                    <ul class="simple">
							<li><a href="<?echo $rut?>about_us.php">English</a></li>
	                    </ul>
					</article>
			</article>
		</li>
	</ul>
</nav>

<script type="text/javascript">
	$(".li_p").mouseover(function() {
		$(this).children("a.drop").addClass("a_activo");
		//alert("entra");
	}).mouseout(function(){
		$(this).children("a.drop").removeClass("a_activo");
	});
</script>