<?
// script que controla las tallas y colores
?>
	<section class="detale_ropa">
<?
$sql="select a.id,a.dsm,a.dsd from tblcolores a ";
if ($idproducto>0) $sql.=" inner join tblcoloresxtblproducto b on b.iddestino=a.id ";
$sql.=" where a.idactivo not in (2) ";
if ($idproducto>0) $sql.=" and b.idorigen=$idproducto ";

$sql.=" order by a.dsm asc ";
//echo $db->debug=true;

			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){

?>
				<article class="color">
						<label for="">Color</label>
						<select name="sel_colores" id="sel_colores" onchange="apagar_capa('sel_colores_txt')" >
<?
			while (!$resultx->EOF) {
			$idmy=$resultx->fields[0];
			$dsmy=$resultx->fields[1];
			$dsdy=$resultx->fields[2];
				

?>

		                    <option value="<? echo reemplazar($dsmy)?>" <? if ($dstalla==reemplazar($dsmy)) echo "selected"?> style="background: <? echo $dsdy?>; color:<? echo $dsdy?>;"><? echo reemplazar($dsmy)?></option>
<?
		$resultx->MoveNext();
		} // fin while
	
?>
		                </select>
		          <span class="camp_requerido" id="sel_colores_txt"></span>

				</article>
<?
			} 
			$resultx->Close();

?>	    	
<?
$sql="select a.id,a.dsm,a.dsd from tbltallas a ";
if ($idproducto>0) $sql.=" inner join tbltallasxtblproducto b on b.iddestino=a.id ";
$sql.=" where a.idactivo not in (2) ";
if ($idproducto>0) $sql.=" and b.idorigen=$idproducto ";

$sql.=" order by a.dsm asc ";
//echo $db->debug=true;

			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){

?>

				<article class="talla">
					<form action="">
						<label for="">Tallas</label>
						<select name="sel_tallas" id="sel_tallas" onchange="apagar_capa('sel_tallas_txt')" >
<?
			while (!$resultx->EOF) {
			$idmy=$resultx->fields[0];
			$dsmy=$resultx->fields[1];
			$dsdy=$resultx->fields[2];
				

?>
		                    <option value="<? echo reemplazar($dsmy)?>" <? if ($dstalla==reemplazar($dsmy)) echo "selected"?>><? echo reemplazar($dsmy)?></option>
<?
		$resultx->MoveNext();
		} // fin while
	
?>

		                </select>
					</form>
	          <span class="camp_requerido" id="sel_tallas_txt"></span>
	          	<br>
					<a href="guia.tallas.php?lightbox[width]=960&lightbox[height]=700&id=5" class="lightbox">Gu&iacute;a de Tallas</a>

				</article>

<?
			} 
			$resultx->Close();

?>	    	

			</section>
