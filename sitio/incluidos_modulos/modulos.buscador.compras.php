<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
buscador generico
por letras
por parametros
*/
?>
<br />

  <table width="100%" cellspacing="5" cellpadding="0" class="text1" align="center"  border=0>
  <form method="post" name="buscador_superior" action="<? echo $pagina?>?dspagina=<? echo $dspagina?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&dsafiliado=<? echo $dsafiliado ?>&entidad=<? echo $entidad ?>">

<tr>
  <td colspan="2" align=center class="style1"> <img src="<?echo $rutxx?>../../img_modulos/modulos/zoom_g.gif" align="absmiddle" border="0" >&nbsp;Buscar por
  <input type="text" name="param" value="<? echo $param?>" class="textnegro" size="25" maxlength="255">
  En
   <select name=campo class=textnegro>
					<?
					$codigosb=explode(",",$paramb);
					$codigosn=explode(",",$paramn);
					for ($i=0;$i<=count($codigosb)-1;$i++){?>
	<option value="<? echo $codigosb[$i];?>" <? if ($codigosb[$i]==$_REQUEST['campo']) echo "selected"; ?>><? echo $codigosn[$i];?></option>
					<? } ?>
				</select>
				<? if($tabla=="tblpagos"){?>

				<select name=idestado class=textnegro>
				<option value="" selected>Estado</option>

				<? combo_estados_select($idestado)?>
				</select>

				<select name=dstipopago class=textnegro>
				<option value="">Tipo de pago</option>
				<option value="Consignacion" <? if ($dstipopago=="Consignacion") echo "selected"?>>Consignacion</option>
				<option value="Tarjeta de credito" <? if ($dstipopago=="Tarjeta de credito") echo "selected"?>>Tarjeta de credito</option>
				</select>



				<select name=idcliente class=textnegro>
				<option value="">Tipo de Gestion</option>
				<option value="99999999999" <? if ($idcliente=="99999999999") echo "selected"?>>Venta asistida</option>
				<option value="88888888888" <? if ($idcliente=="88888888888") echo "selected"?>>Casillero</option>
				<option value="77777777777" <? if ($idcliente=="77777777777") echo "selected"?>>Exportacion</option>
				<option value="66666666666" <? if ($idcliente=="66666666666") echo "selected"?>>Cotizacion</option>

				</select>

<select name="idtiendax" class=textnegro>
				<option value="">Tienda</option>

				<? lista_tiendas("tblempresa",$idtiendax);		?>
				</select>



	<?
		}
		if($tabla=="tbl_logs"){
		$sqlx="select dsmodulo";
		$sqlx.=" from $tabla where id>0 group by dsmodulo order by dsmodulo asc";
		$resultx=$db->Execute($sqlx);
		if (!$resultx->EOF) {
	?>
	&nbsp;o por Modulos
	<input type="hidden" name="campox" value="dsmodulo">
	<select name=param2 class=textnegro>
		<option value="">----Seleccione la opcion----</option>
		<? while(!$resultx->EOF){?>
			<option value="<? echo $resultx->fields[0];?>"><? echo $resultx->fields[0];?></option>
		<?
			$resultx->MoveNext();
			}//fin while
		?>
	</select>
	<?
		}//fin if
		$resultx->Close();
	?>
	<?
		}//fin if
		if($tabla=="tbl_logs" || $tabla=="tblpagos"){
	?>
</td></tr>
<tr><td align=center>
		y/o por Fecha
		<select name=dsfechasel>
		<option value="dsfechacompra" <? if ($dsfechasel=="dsfechacompra") echo "selected";?>>Compra</option>

		<option value="dsfechaven" <? if ($dsfechasel=="dsfechaven") echo "selected";?>>Vencimiento</option>
		<option value="dsfechadesp" <? if ($dsfechasel=="dsfechadesp") echo "selected";?>>Despacho</option>



		</select>:&nbsp;&nbsp;&nbsp;
		Inicial
	<input type="hidden" name="campoy" value="idfecha">
	<input class="textnegro" type="text" name="fechain" size=10 maxlength="10" readonly>
	<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('fechain', this);" language="javaScript">
	&nbsp;&nbsp;&nbsp;Final
	<input class="textnegro" type="text" name="fechafi" size=10 maxlength="10" readonly>
	<img align="absmiddle" SRC="<?echo $rutxx?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('fechafi', this);" language="javaScript">
	<? }?>

  <input type="submit" name="enviar" value="Buscar" class="text1">
  <input type="hidden" name="idtienda" value="<? echo $idtienda?>">

  </td>
  </tr>
  </form>
  <?
  // letras

  ?>
                <tr bgcolor="#f3f3f3">
                  <td align="center">
				<?
				$i=0;
				$partir=explode(",",$vector);
				$contador=count($partir);
				for ($i=0;$i<=$contador;$i++){
				?>
	<a class="text" href="<? echo $pagina;?>?dspagina=<? echo $dspagina?>&letra=<? echo $partir[$i];?>&campoletra=<? echo $campoletra;?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&dsafiliado=<? echo $dsafiliado ?>&entidad=<? echo $entidad ?>&idtiendax=<? echo $idtiendax?>" TITLE="Listar por <? echo $partir[$i];?>"><? echo $partir[$i];?></a>&nbsp;&nbsp;
				<?

				} ?>

				<a href="<? echo $pagina?>?dspagina=<? echo $dspagina?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&dsafiliado=<? echo $dsafiliado ?>&entidad=<? echo $entidad ?>&idtiendax=<? echo $idtiendax?>">Listar Todos</a>
				  </td>
				  <? if($importar==1){?>
				  <td>
				  <a href="#a" title="Click para importar los datos" onclick="mostrarimportar()">Importar Datos</a>
				  </td>
				  <? }?>

                </tr>
	<? // fin letras ?>

  <?
  // botones
  if ($mostrarbotones==1) {
  ?>
                <tr bgcolor="#f3f3f3">
                 <td align="center">	
                  	<?  // $db->debug=true;
                  	$sqlb="select id,dsm ";
						$sqlb.=" from ecommerce_tblestadoscompra where id>0 and idactivo not in (2,9) order by idpos asc";
						$resultb=$db->Execute($sqlb);
						if (!$resultb->EOF) {
							while(!$resultb->EOF){?>
                  		<input type=button value="<? echo $resultb->fields[1];?>"  onclick="irAPaginaD('<?echo $pagina?>?idestado=<? echo $resultb->fields[0];?>&idtiendax=<?echo $idtiendax?>')">
                  	   <?$resultb->MoveNext();
						}//fin while
						}//fin if
						$resultb->Close();
						?>


							</td>
                </tr>
	<?
}
	// fin botones ?>


              </table>