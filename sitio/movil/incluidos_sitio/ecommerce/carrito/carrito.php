

<h1>Su carrito de compras</h1>

	<form>
			<article class="cont_carrito">

				<ul class="cont_izq">
					<li>
						<a href="productos.detalle.php">
							<img src="images/1.jpg">
						</a>
					</li>

					<li>
						<a href="eliminar.php">
							<article class="eliminar" title="Eliminar este item de la compra">
								<img src="images/eliminar.png">
							</article>
						</a>
					</li>

				</ul>

				<ul>

					<li>
						<h3>CAMARA OLYMPUS</h3>
					</li>

					<li>

					<article class="precio">

							<p>$ 1'400.00</p>

					</article>

					</li>

				<li>

				<article class="cantidad">
					<p>Cantidad</p>
					<select>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					</select>

					<!--<input type="text" name="cantidad[]" value="<? echo $idcant?>" size=2 maxlength=4 <? echo $read?>>
					<input type=hidden name="idx[]" value="<? echo $idx?>">
					<input type="hidden" name="idpro[]" value=<? echo $idproducto ?>>
					<input type="hidden" name="unidaddisponible[]" value=<? echo $dsunidadesdispo ?>>

					<? //if ($xtotal>0) {?>
						<input type="button" value="CAMBIAR CANTIDADES" class="btn_general" onclick="validar_cantidad();carrito_modificar('forma_carrito')">
						<input type="hidden" name="clientex" value="1">
					<? //} ?>
				-->
				</article>
				</li>

				<li>

				<article class="subtotal">

					<p class="p1">
						$ 1'400.000
					</p>

				</article>

				</li>

				</ul>

			</article>

			<article class="cont_totales">

				<h2>Resumen del pedido</h2>
				<ul>
					<li>
						<p ><strong>Subtotal</strong></p>
					</li>

					<li>
						<p ><strong>$ 1'400.000</strong></p>
					</li>

				</ul>

				<ul>
					<li>
						<p >Descuento</p>
					</li>

					<li>
						<p >0%</p>
					</li>

				</ul>

				<ul>
					<li>
						<p >Manejo de logistica</p>
					</li>

					<li>
						<p >$0</p>
					</li>
				</ul>

				<ul>
					<li>
						<p >Impuestos</p>
					</li>

					<li>
						<p >$ 0</p>
					</li>
				</ul>


				<ul class="total">
					<li>
						<p >Total: </p>
					</li>

					<li>
						<p > $ 1'400.000</p>
					</li>
				</ul>

			</article>


			<input type="button" value="SEGUIR COMPRANDO" class="btn_general">

			<input type="button" value="FINALIZAR COMPRA" class="finalizar_compra" onclick="validar_distribuidor()">
			<input type='hidden' name='totalvalor' >
			<input type="hidden" name="preciomcliente">
	</form>


	<article class="no_producto">
		<img src="<?echo $rutbase?>images/no_compra.png">
		<h3>NO HAY PRODUCTOS ASOCIADOS EN ESTOS MOMENTOS</h3>
		<p>Por favor agregue uno</p>
		<a href="productos.php" class="btn_general">VER PRODUCTOS</a>
	</article>