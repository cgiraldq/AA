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

  <table width="80%" cellspacing="5" cellpadding="0" class="text1" align="center">
  <form method="post" name="buscador_superior" action="<? echo $pagina?>?dspagina=<? echo $dspagina?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&dsafiliado=<? echo $dsafiliado ?>&entidad=<? echo $entidad ?>">
  <tr>
  <td colspan="2"> <img src="../../img_modulos/modulos/zoom_g.gif" align="absmiddle" border="0">&nbsp;Buscar por
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
<?
if ($tipob==1) {
	?>
Tipo de producto:
   <select name=idtipob class=textnegro>
            <? categorias("tbltiposproductos",$idtipob); ?>


</select>


Naturaleza:
<select name=idnatx class=text1>
			<option value="" <? if ($idnatx=="") echo "selected";?>>Seleccione...</option>
		  <option value="1" <? if ($idnatx=="1") echo "selected";?>>Nacional</option>
		  <option value="2" <? if ($idnatx=="2") echo "selected";?>>Importado</option>

	</select>

Estado:

	<select name=idactivox class=text1>
		  <option value="1" <? if ($idactivox==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivox==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivox==3) echo "selected";?>>OFERTA</option>
		  <option value="4" <? if ($idactivox==4) echo "selected";?>>DESTACADO INDEX</option>
		  <option value="5" <? if ($idactivox==5) echo "selected";?>>INCOMPLETO</option>
		  <option value="6" <? if ($idactivox==6) echo "selected";?>>NUEVA OFERTA</option>

	</select>



	<?
}
?>
<?
 if ($tienda==1) {
?>
Tienda Asociada:

	<select name=idtiendax class=text1>
		  <option value="" <? if ($_REQUEST['idtiendax']=="") echo "selected";?>>---</option>

			<? lista_tiendas("tblempresa",$_REQUEST['idtiendax']);?>

	</select>
<? } ?>

<?
 if ($tienda==1) {
?>
Concursos:

	<select name='idconcursox' class='text1'>
		<option value="" <? if ($_REQUEST['idconcursox']=="") echo "selected";?>>---</option>
		<option value="1" <? if ($_REQUEST['idconcursox']==1) echo "selected";?>>Concurso Aguatur</option>

	</select>
<? } ?>


	<?
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
		<br>y/o por Fecha:&nbsp;&nbsp;&nbsp;
		Inicial
	<input type="hidden" name="campoy" value="idfecha">
	<input class="textnegro" type="text" name="fechain" size=10 maxlength="10" readonly>
	<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('fechain', this);" language="javaScript">
	&nbsp;&nbsp;&nbsp;Final
	<input class="textnegro" type="text" name="fechafi" size=10 maxlength="10" readonly>
	<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('fechafi', this);" language="javaScript">
	<?
		}//fin if
	?>

  <input type="submit" name="enviar" value="Buscar" class="text1">
  <input type="hidden" name="idlanding" value="<? echo $idlanding?>">
  <input type="hidden" name="idtipoprod" value="<? echo $idtipoprod?>">
  <input type="hidden" name="idtipo" value="<? echo $idtipo?>">

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
	<a class="text" href="<? echo $pagina;?>?idtipob=<? echo $idtipob?>&dspagina=<? echo $dspagina?>&letra=<? echo $partir[$i];?>&campoletra=<? echo $campoletra;?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&idlanding=<? echo $idlanding ?>&entidad=<? echo $entidad ?>" TITLE="Listar por <? echo $partir[$i];?>"><? echo $partir[$i];?></a>&nbsp;&nbsp;
				<?

				} ?>

				<a href="<? echo $pagina?>?dspagina=<? echo $dspagina?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&idlanding=<? echo $idlanding ?>&entidad=<? echo $entidad ?>">Listar Todos</a>
				  </td>
				  <? if($importar==1){?>
				  <td>
				  <a href="#a" title="Click para importar los datos" onclick="mostrarimportar()">Importar Datos</a>
				  </td>
				  <? }?>

                </tr>
	<? // fin letras ?>
              </table>