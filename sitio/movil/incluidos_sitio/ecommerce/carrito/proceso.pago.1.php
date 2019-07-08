<section class="cont_carrito">
	<h1>PROCESO DE PAGO - PASO 1</h1>

    <article class="texto_transaccion">
      <? echo $mensaje;?>
    </article>

      <ul class="cont_izq">
          <li>
           <a href="#">
              <img src="images/1.jpg">
            </a>
          </li>
      </ul>

      <ul>

		      <li>
						<h3>CAMARA</h3>
          </li>

          <li>
            <article class="precio">

    						<p class="p1">$ 1'400.000</p>

    						<p class='p_oferta'>Oferta Válida para Medellín y la Área Metropolitana</p>

    						<p class="p2" style="display:none;">Tiempo de Entrega: <span></span></p>

        				<p class="p3" style="display:none;"><strong>Condiciones:</strong></p>

            </article>
          </li>

					<article class="para" id="mensajes_<? echo $idproducto ?>">
							<p class="p4"><strong>Para:</strong> Nombre</p>
							<p class="p4"><strong>Tel&eacute;fono:</strong> Telefono</p>
							<p class="p4"><strong>Zona / Sector / Ciudad:</strong> Zona</p>
							<p class="p4"><strong>Direcci&oacute;n:</strong> Direcciones</p>
							<p class="p4"><strong>Observaciones:</strong> Observaciones</p>
							<p class="p4"><strong>Mensaje:</strong> Mensaje</p>
							<p class="p4"><strong>Fecha de Envio:</strong> 8:00AM</p>
							<p class="p4"><strong>Hora de Envio:</strong> 12:00PM</p>
    					<p class="p4"><strong>Talla:</strong> L</p>
    					<p class="p4"><strong>Color:</strong>Negro</p>
          </article>

          <li><p>Unidades 1</p></li>

          <article class="precio">

            <p class="p1">
              $ 0
            </p>

          <article class="subtotal">
            <p class="p1">
              $ 0
            </p>
          </article>

        </ul>


		</article>


    </article>
      <table width="100%" border-collapse="0" border-spacing="0">

		<tfoot>

			<tr>

				<td colspan="2"><p><strong>Subtotal</strong></p></td>
				<td colspan="2"><p><strong>$ <? echo number_format($xsubtotal,0)?></strong></p></td>
			</tr>

			<tr>
				<td colspan="2"><p>Descuento</p></td>
				<td colspan="2"><p>$ <? echo number_format($xdescuento,0)?></p></td>
			</tr>

			<tr>
				<td colspan="2"><p>Impuestos</p></td>
				<td colspan="2"><p>$ <? echo number_format($xiva,0)?></p></td>
			</tr>

			<tr>
				<td colspan="2"><p>Manejo de Log&iacute;stica</p></td>
				<td colspan="2"><p>$ <? echo number_format($xfletes+$xvalorseguro,0)?></p></td>
			</tr>

			<tr>
				<td colspan="2"><p>Total en punto de venta Medell&iacute;n <? if ($textoservicio==0) {?>de los productos<? } ?></p></td>
				<td colspan="2"><p id="item_total_valor" style="font-weight: 600;">$ <? echo number_format($xtotal,0)?></p></td>
			</tr>

			<tr>
				<td colspan="2"><p >Seleccione la ciudad de env&iacute;o</p></td>
				<td colspan="2">
          <select name="dsciudadenvio" id="dsciudadenvio" onchange="cambiar_transporte('forma_carrito')"  >
              <option value="0">Seleccione</option>

              <option value="<? echo $dsciudad." - ".$dsdep ?>|<? echo $idtarifa; ?>|<? echo $idvalor; ?>"></option>
          </select>

          <span id="txt_dsciudadenvio" style="display:none" class="camp_requerido"><br><img src="images/warning.png" style="margin-bottom: -2px;
          margin-right: 5px;">Debe seleccionar el transporte</span>
             <span id="txt_cargando" style="display:none" class="camp_requerido"><br>Cargando fletes...</span>

				</td>
			</tr>


			<tr>
				<td colspan="2"><p >Forma de Pago</p></td>
				<td colspan="2">
          <select name="dsformadepago" id="dsformadepago" onchange="cambiar_formadepago('forma_carrito')">
              <option value="">Seleccione</option>
              <option value="<? echo $id?>|<? echo $dsm?>|<? echo $dsd?>|<? echo $idactivo?>"><? echo $dsm;?></option>
          </select>
			       <input type="hidden" name="dscombo" value="<? echo $dscombo?>">
             <span id="txt_dsformadepago" style="display:none" class="camp_requerido"><br><img src="images/warning.png" style="margin-bottom: -2px;
margin-right: 5px;">Debe seleccionar la forma de pago</span>


				</td>
			</tr>

			<tr>
				<td colspan="2"><p  id="item_total_texto_lg" style="display:none;">Total con transporte hacia lugar de entrega</p></td>
				<td colspan="2"><p  id="item_total_valor_lg" style="display:none; "></p></td>
			</tr>
		</tfoot>
</table>

<input type=hidden name="xsubtotal" value="<? echo number_format($xsubtotal,0,"","")?>">
<input type=hidden name="xdescuento" value="<? echo number_format($xdescuento,0,"","")?>">
<input type=hidden name="xiva" value="<? echo number_format($xiva,0,"","")?>">
<input type=hidden name="xfletes" value="<? echo number_format($xfletes,0,"","")?>">
<input type=hidden name="xvalorseguro" value="<? echo number_format($xvalorseguro,0,"","")?>">
<input type=hidden name="xvalormanejo" value="<? echo number_format($xvalormanejo,0,"","")?>">
<input type=hidden name="xpeso" value="<? echo number_format($xpeso,0,"","")?>">
<input type=hidden name="xtotal" value="<? echo number_format($xtotal,0,"","")?>">
<input type=hidden name="xtransad" value="<? echo number_format($xtransad,0,"","")?>">

<input type=hidden name="tipotransc" id="tipotransc" value="0">

<? $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);?>

<? if($tipocliente==1){?>
<input type="button" value="Modificar" onClick="irAPaginaD('carrito.distribuidor2.php')" class="btn_general">
<? }else { ?>
<input type="button" value="Modificar" onClick="irAPaginaD('carrito.php')" class="btn_general">
<? } ?>
<input type="button" onclick="validar_pago_v2('forma_carrito',1);" value="Solo Cotizar" class="btn_general">
<input type="button" onclick="validar_pago_v2('forma_carrito',0);" value="Finalizar Compra" class="finalizar_compra">




  <article class="no_producto">
    <img src="<?echo $rutbase?>images/no_compra.png">
    <h3>NO HAY PRODUCTOS ASOCIADOS EN ESTOS MOMENTOS</h3>
    <p>Por favor agregue uno</p>
    <a href="productos.php" class="btn_general">VER PRODUCTOS</a>
  </article>



</section>

