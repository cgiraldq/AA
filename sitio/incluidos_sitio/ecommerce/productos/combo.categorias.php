<?
// combo generico de categorias
?>

		<form action="#" method=post name="categorias">
			<label>SELECCIONE LA CATEGOR&Iacute;A:</label>

<?
// listar categorias de la tienda
$sql="select a.id,a.dsm from tblcategoria a ";
	if ($idtienda>0) $sql.=" inner join tblempresaxtblcategoria b on b.idorigen=a.id ";

	$sql.=" where a.idactivo in (";
		$sql.="1";
		if ($idtienda>0)  $sql.=",8";
		$sql.=") ";
	if ($idtienda>0) $sql.=" and b.iddestino=$idtienda ";

			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){

?>

			<select name="idcat" id="idcat" onChange="redirec_combo('categorias','<?echo $rut?>productos.php','idcat')">
				<option value="">...Todos...</option>

<?
			while (!$resultx->EOF) {
			$idmx=$resultx->fields[0];
			$dsmx=$resultx->fields[1];


?>

				<option value="<? echo $idm?>" <? if ($idcat==$idmx) echo "selected";?>><? echo reemplazar($dsmx)?></option>
<?
		$resultx->MoveNext();
		} // fin while

?>


			</select>

<?
// fin listar lkas categorias de la tienda
			}
			$resultx->Close();

?>
	</form>

