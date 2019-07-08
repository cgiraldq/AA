<table id='informacion_producto' width=60% class="campos_ingreso campos_ingreso_producto" >

<tr>
	<td colspan="2"><h1 class="tabs_titulo">INFORMACI&Oacute;N DEL PRODUCTO <?echo $nombre?></h1></td>
</tr>




<tr>
	<td>
		<table>
			<tr valign=top>
				<td ><p>Nombre</p></td>
				<td>
			  	<?

				$contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
				<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsm";
				$mensaje_capa="Debe ingresar el titulo";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>
			<tr valign=top bgcolor="#FFFFFF">
				<td ><p>Referencia</p></td>
				<td>
				<? $contadorx="dsreferencia_counter";$valorx="255";$formax="u";$campox="dsreferencia";?>
				<input type=text name=dsreferencia size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsreferencia')" value="<? echo $dsreferencia?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsreferencia";
				$mensaje_capa="Debe ingresar el titulo";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>
			<!--tr valign=top bgcolor="#FFFFFF">
				<td class="txt"><p>Digite la Marca</p></td>
				<td>
				<? $contadorx="dsmarca_counter";$valorx="255";$campox="dsmarca";?>
				<input type=text name=dsmarca size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsmarca')" value="<? echo $dsmarca?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
				$nombre_capa="capa_dsmarca";
				$mensaje_capa="Debe ingresar la maraca del producto";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr-->

			<tr valign=top bgcolor="#FFFFFF">
				<td class="txt"><p>Seleccione la marca</p></td>
				<td>
						<select name=idmarca class=text1>
							<option value="0" <? if ($idmarca=="0") echo "selected";?>>Seleccione...</option>
				<? lista_marcas("ecommerce_tblmarcas",$idmarca,$dsmarca) ?>

					</select>

				</td>
			</tr>

			<tr valign=top bgcolor="#FFFFFF">
				<td colspan="2"><p>
					<strong>Descripci&oacute;n Corta o Resumen</strong></p>

				<? $contadorx="dsd_counter";$valorx="1500";$campox="dsd";?>
				<textarea name=dsd cols=80  rows="0" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
				<?
				$nombre_capa="capa_dsd";
				$mensaje_capa="Debe ingresar la descripci&oacute;n";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
				</td>
			</tr>

			<tr valign=top bgcolor="#FFFFFF">
				<td colspan="2"><p>
					<strong>Descripci&oacute;n Larga o Detalle</strong><br>
					Titulo con el cual desea que salga en el detalle del producto:<br></p>
				<input type=text name="dsd2txt" size=45 maxlength="255" class=text1 value="<? echo $dsd2txt?>">

				<? $contadorx="dsd2_counter";$valorx="3500";$campox="dsd2";?>
				<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
				<?
				$nombre_capa="capa_dsd2";
				$mensaje_capa="Debe ingresar la descripci&oacute;n Larga";
				include($rutxx."../../incluidos_modulos/control.capa.php");
				include($rutxx."../../incluidos_modulos/control.letras.php");?>
			</td>
			</tr>
		</table>




		<table width=100%>


		<tr valign=top>
				<td colspan="2">
					<table width=100%>
						<tr>
							<td ><p>Fecha Inicial</p></td>
							<td>
							<? $contadorx="dsfechainicial_counter";$valorx="10";$formax="u";$campox="dsfechainicial";$cantidad=strlen($dsfechainicial)?>
							<input type=text name=dsfechainicial size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechainicial')" readonly  value="<? echo $dsfechainicial?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
							<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechainicial', this);" language="javaScript">
							<?
							$nombre_capa="capa_dsfechainicial";
							$mensaje_capa="Debe ingresar la fecha inicial";
							include("../../../incluidos_modulos/control.capa.php");
							include("../../../incluidos_modulos/control.letras.php");?>
							</td>
							<td><p>Fecha Final</p></td>
							<td>
							<? $contadorx="dsfechafinal_counter";$valorx="10";$formax="u";$campox="dsfechafinal";$cantidad=strlen($dsfechafinal)?>
							<input type=text name=dsfechafinal size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechafinal')" readonly  value="<? echo $dsfechafinal?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
							<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechafinal', this);" language="javaScript">
							<?
							$nombre_capa="capa_dsfechafinal";
							$mensaje_capa="Debe ingresar la fecha final";
							include("../../../incluidos_modulos/control.capa.php");
							include("../../../incluidos_modulos/control.letras.php");?>
							</td>



						</tr>

					</table>

				</td>
			</tr>


		<tr valign=top bgcolor="#FFFFFF">
			<td colspan="2">
			<strong>RELACIONES.</strong> Asocie en que subcategoria desea ver este item
			<br>

			<?

			$datasqladd=" and idactivo not in (2,9) and idtipo=$idtipoprod ";
			include($ruttx."../../relaciones/default.php");?>
			</td>
		</tr>

		<tr valign=top bgcolor="#FFFFFF">
			<td colspan="2">
			<strong>RELACIONES.</strong> Asocie en que categoria desea ver este item
			<br>
			<?
			
			$datasqladd=" and idactivo not in (2,9)";
			$tablaorigen="ecommerce_tblcategoria";
			include($rutxx."../relaciones/default.ecommerce.categoria.php");?>
			</td>
		</tr>


		<tr valign=top bgcolor="#FFFFFF">
			<td colspan="2">
			<strong>RELACIONES CON TIENDAS.</strong> Asocie en que tienda desea ver este item
			<br>
			<?
			$datasqladd=" and id>1 ";
			include($ruttx."../../relaciones/default.empresa.php");?>
			</td>
		</tr>

		</table>
	</td>
</tr>


</table>