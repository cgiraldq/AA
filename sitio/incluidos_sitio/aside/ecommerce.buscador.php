<article class="ecommerce_buscador">

 	<div class="titulo_aside">
	<h2>Buscador especializado</h2>
	</div>

	<form action="<?echo $rutbase?>/ecommerce.buscador.php" name="frm_buscador" id="frm_buscador" method="post">

		


		

	<!--h4>Marca</h4>
	<select name=dsmarca >
	<option value="">Seleccione...</option>
	<? categorias("ecommerce_tblmarcas",$dsmarca) ?>
	</select-->
	<!--h4>Equipo</h4>
	<select name=idequipo class=text1>
	<option value="0" <? if ($idequipo=="0") echo "selected";?>>Seleccione...</option>
	<? categorias("tblequipo",$idequipo) ?>
	</select-->


	<h4>Categoria</h4>
	<select name=idcategoria id="idcategoria" class=text1 onchange="cargar_sub()">
	<option value="" <? if ($idcategoria=="") echo "selected";?>>Seleccione...</option>
	<? categorias("ecommerce_tblcategoria","") ?>
	</select>
	<h4>Subcategoria</h4>
	<select name=idsubt id="idsubt" class=text1>
	<option value="" <? if ($idsubt=="") echo "selected";?>>Seleccione...</option>
	<? categorias("ecommerce_tblsubcategoriasxcategoria",$idsubt) ?>



	</select>

	<h4>Precio</h4>
				<select name="idprecio_b" id="idprecio_b">
					  <option value="" <? if ($idprecio_b=="") echo "selected"; ?> >Seleccione...</option>	
					  <option value="0|50000" <? if ($idprecio_b=="0|50000") echo "selected"; ?> >$0 - $50.000</option>
					  <option value="50001|100000" <? if ($idprecio_b=="50001|100000") echo "selected"; ?>>$50.000 - $100.000</option>
					  <option value="100001|150000" <? if ($idprecio_b=="100001|150000") echo "selected"; ?>>$100.000 - $150.000</option>
					  <option value="150001|200000" <? if ($idprecio_b=="150001|200000") echo "selected"; ?>>$150.000 - $200.000</option>
					  <option value="200001|9999999" <? if ($idprecio_b=="200001|9999999") echo "selected"; ?>>$200.000  o más</option>
				</select>



	<h4>Color</h4>
			<ul class="colores">

<?
$sql="select id,dsm,dsd from ecommerce_tblcolores where id>0 and idactivo=1  order by dsm asc ";
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
		$i=0;
		while (!$resultx->EOF) {
		 $idcolor=$resultx->fields[0];
		 $dsmcolor=$resultx->fields[1];
		 $dscolor=$resultx->fields[2];

?>

<li>
	<input type="checkbox" name="idcolor[]"  title="<? echo $dsmcolor?>" value="<? echo $idcolor?>">
	<span title="<? echo $dsmcolor?>" style="background:<? echo $dscolor?>;"></span>
</li>
<?
		$i++;
			$resultx->MoveNext();

	}
}
$resultx->Close();
?>

			</ul>




		<!--input type="text" name="dsbusqueda" id="dsbusqueda" class="busq_text" value="<? echo $dsbusqueda;?>" placeholder="Buscar . . ."-->

	<nav class="btn_centro">
		<input type="button" value="BUSCAR" class="btn_buscador" onclick="document.frm_buscador.submit();">
	</nav>
	<input type="hidden" name="idbuscador" value="1">
	</form>
</article>
