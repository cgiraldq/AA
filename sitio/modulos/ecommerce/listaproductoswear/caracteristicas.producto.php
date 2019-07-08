<table id='caracteristicas_producto' width=70% class="campos_ingreso campos_ingreso_producto" >

<tr>
	<td colspan="2"><h1 class="tabs_titulo">Caracteristicas del producto <?echo $nombre?></h1></td>
</tr>

			<tr valign=top bgcolor="#FFFFFF">
				<td colspan=4>
				<table  width=100%>
				<tr>
				<td class="txt"><p>Activar?</p></td>
				<td width=>
					<select name=idactivo class=text1>
						  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
						  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
						  <option value="3" <? if ($idactivo==3) echo "selected";?>>OFERTA</option>
						  <option value="4" <? if ($idactivo==4) echo "selected";?>>RECOMENDADO</option>
						  <option value="5" <? if ($idactivo==5) echo "selected";?>>INCOMPLETO</option>
						  <option value="6" <? if ($idactivo==6) echo "selected";?>>NUEVA OFERTA</option>
						  <option value="7" <? if ($idactivo==7) echo "selected";?>>NUEVO</option>
						  <option value="8" <? if ($idactivo==8) echo "selected";?>>PRINCIPAL INDEX</option>
					</select>

				</td>


				<td ><p>Posici&oacute;n</p>
				</td>
				<td>
					<input type=text name=idpos size=5 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
				<?
				$nombre_capa="capa_idpos";
				$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
				include($rutxx."../../incluidos_modulos/control.capa.php");

				?>
				</td>
				</tr>
				<tr valign=top bgcolor="#FFFFFF">
				<td ><p>Producto mas vendido</p>
				</td>
				<td>
					<select name=idmasvendido class=text1>
							<option value="" <? if ($idmasvendido=="0") echo "selected";?>>Seleccione...</option>

						  <option value="1" <? if ($idmasvendido=="1") echo "selected";?>>SI</option>
						  <option value="2" <? if ($idmasvendido=="2") echo "selected";?>>NO</option>

					</select>

				</td>


				<td ><p>Disponible</p>
				</td>
				<td>
					<select name=dsdisponible class=text1>
							<option value="" <? if ($dsdisponible=="0") echo "selected";?>>Seleccione...</option>

						  <option value="1" <? if ($dsdisponible==1) echo "selected";?>>SI</option>
						  <option value="2" <? if ($dsdisponible==2) echo "selected";?>>NO</option>

					</select>

				</td>
			</tr>
			</table>
		</td>
	</tr>



<tr valign=top>

	<td colspan="2">
		<table>
			<tr>
			<td><p>Volumen</p>
			<? $contadorx="volumen_counter";$valorx="255";$campox="volumen";?>
			<input type=text name=volumen size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_volumen')" value="<? echo $volumen?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_volumen";
			$mensaje_capa="Debe ingresar el Volumen";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>

			<td ><p>Peso</p>
			<? $contadorx="peso_counter";$valorx="255";$campox="peso";?>
			<input type=text name=peso size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_peso')" value="<? echo $peso?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_peso";
			$mensaje_capa="Debe ingresar el Peso";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>

			<td ><p>Ancho</p>
			<? $contadorx="ancho_counter";$valorx="255";$campox="ancho";?>
			<input type=text name=ancho size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_ancho')" value="<? echo $ancho?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_ancho";
			$mensaje_capa="Debe ingresar el Ancho";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>

			<td><p>Alto</p>
			<? $contadorx="alto_counter";$valorx="255";$campox="alto";?>
			<input type=text name=alto size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_alto')" value="<? echo $alto?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_alto";
			$mensaje_capa="Debe ingresar el Alto";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>

			<td ><p>Largo</p>
			<? $contadorx="largo_counter";$valorx="255";$campox="largo";?>
			<input type=text name=largo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_largo')" value="<? echo $largo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_largo";
			$mensaje_capa="Debe ingresar el Largo";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
			</tr>
		</table>
	</td>
</tr>

<tr valign=top>

	<td colspan="2">
		<table>
			<tr>

				<td ><p> Cantidad por Unidad</p>
				<? $contadorx="dsunidad_counter";$valorx="255";$campox="dsunidad";?>
				<input type=text name=dsunidad size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsunidad')" value="<? echo $dsunidad?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsunidad";
				$mensaje_capa="Debe ingresar el Largo";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>


				<td ><p>Unidades disponibles</p>
				<? $contadorx="dsunidadesdispo_counter";$valorx="255";$campox="dsunidadesdispo";?>
				<input type=text name=dsunidadesdispo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsunidadesdispo')" value="<? echo $dsunidadesdispo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsunidadesdispo";
				$mensaje_capa="Debe ingresar el Largo";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>
		</table>
	</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Tiempos de Entrega</p> </td>
	<td>
	<? $contadorx="dsentrega_counter";$valorx="255";$campox="dsentrega";?>
	<input type=text name=dsentrega size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsentrega')" value="<? echo $dsentrega?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<?
	$nombre_capa="capa_dsentrega";
	$mensaje_capa="Debe ingresar el Precio 1";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
	<td colspan="2"><p><strong>Caracteristicas  adicionales</strong><br>
		Titulo con el cual desea que salga en el detalle del producto:<br></p>
	<input type=text name="dscaractxt" size=45 maxlength="255" class=text1 value="<? echo $dscaractxt?>">

	<? $contadorx="dscarac_counter";$valorx="3500";$campox="dscarac";?>
	<textarea name=dscarac cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dscarac')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dscarac?></textarea>
	<?
	$nombre_capa="capa_dscarac";
	$mensaje_capa="Debe ingresar las Caracteristicas";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td colspan="2"><p><strong>Garantias y condiciones de adicionales</strong><br>
		Titulo con el cual desea que salga en el detalle del producto:<br></p>
	<input type=text name="dsdcondicionestxt" size=45 maxlength="255" class=text1 value="<? echo $dsdcondicionestxt?>">

	<? $contadorx="dscondiciones_counter";$valorx="3500";$campox="dscondiciones";?>
	<textarea name=dscondiciones cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dscondiciones')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dscondiciones?></textarea>
	<?
	$nombre_capa="capa_dscondiciones";
	$mensaje_capa="Debe ingresar las condiciones de transporte y entega";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>

<? if ($idtipo==5) {?>
	<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Altura</p></td>
	<td>
	<? $contadorx="dsaltura_counter";$valorx="255";$campox="dsaltura";?>
	<input type=text name=dsaltura size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsaltura')" value="<? echo $dsaltura?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<?
	$nombre_capa="capa_dsaltura";
	$mensaje_capa="Debe ingresar la altura";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
	</tr>
<? } ?>


<tr>
	<td colspan="2" border=0 style="padding:0;">
		<table>

<tr>
	<td>
		<table>
			<tr valign=top>
				<td><p>Proveedor</p>
				</td>
				<td>
				<? $contadorx="dsproveedor_counter";$valorx="255";$campox="dsproveedor";?>
				<input type=text name=dsproveedor size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsproveedor')" value="<? echo $dsproveedor?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsproveedor";
				$mensaje_capa="Debe ingresar el proveedor";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>


			<tr valign=top >
				<td >
					<p>O seleccione Proveedor</p>
				</td>
				<td>
						<select name=idproveedor class=text1>
							<option value="0" <? if ($idproveedor=="0") echo "selected";?>>Seleccione...</option>
				<? lista_proveedores("ecommerce_tblproveedores",$idproveedor) ?>



					</select>

				</td>
			</tr>
			<tr valign=top >
				<td >
					<p>Origen Producto </p>
				</td>
				<td>
						<select name=idorigen class=text1>
							<option value="0" <? if ($idorigen=="0") echo "selected";?>>Seleccione...</option>
				<? categorias("ecommerce_tblorigenes",$idorigen) ?>



					</select>

				</td>
			</tr>

		</table>

	</td>

	<td>
		<table>

			<tr valign=top bgcolor="#FFFFFF">
				<td><p>URL</p>
				</td>
				<td>
				<? $contadorx="dsurl_counter";$valorx="3500";$campox="dsurl";?>
				<input type="text" name=dsurl size=45 maxlength=255 class=text1 onKeyPress="ocultar('capa_dsurl')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?> value="<? echo $dsurl?>">
				<?
				$nombre_capa="capa_dsurl";
				$mensaje_capa="Debe ingresar la dsurl";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				<? if ($dsurl<>"") {?>
				<a href="<? echo $dsurl?>" target="_blank"><strong>Ver Enlace</strong></a>
				<? } ?>
				</td>
			</tr>






			<tr valign=top>
				<td ><p>Naturaleza</p>
				</td>
				<td>
					<select name=idnat class=text1>
							<option value="" <? if ($idnat=="") echo "selected";?>>Seleccione...</option>

						  <option value="1" <? if ($idnat=="1") echo "selected";?>>Nacional</option>
						  <option value="2" <? if ($idnat=="2") echo "selected";?>>Importado</option>

					</select>

				</td>
			</tr>

			<tr valign=top >
				<td ><p>Cargar codigo Video</p>
				</td>
				<td>
				<? $contadorx="dsvideo_counter";$valorx="3500";$campox="dsvideo";?>
				<input type="text" name=dsvideo size=60  maxlength="500" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?> value="<? echo $dsvideo?>">
				<?
				$nombre_capa="capa_dsvideo";
				$mensaje_capa="Debe ingresar el Video";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>


			<tr valign=top>
				<td >
					<p>Tipo de producto. Si lo deja vacio, se asume que es plantilla tipo producto</p>
				</td>
				<td>
				            <select name="idtipo" class="textnegro">
				              <option value="">Seleccione..</option>
				            <? categorias("ecommerce_tbltiposproductos",$idtipo); ?>
				          </select>

				</td>
			</tr>


				</table>
	</td>
</tr>

		</table>
	</td>
</tr>

</table>