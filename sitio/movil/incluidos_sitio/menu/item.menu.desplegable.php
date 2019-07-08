<div class="rmm">
    <ul>
<?
$sql="select a.id,a.dsm,a.dstitulo from tblpaginas a,tblvistaxtblpaginas b where a.idactivo=1 and a.idvista=1";
$sql.=" and a.id=b.iddestino order by a.idpos";
//echo $sql;
$result=$db->Execute($sql);
	if (!$result->EOF) {
		while (!$result->EOF) {
		$destino=$result->fields[0];
		$dsm=$result->fields[1];
		$dstit=$result->fields[2];
		//$dsrutax=$rutalocal."/quienes_somos/".$dsruta;
		//if ($rutaAmiga>1) $dsrutax="qsomos.php?id=".$id;
?>

        <li><a href='<? echo $rutbase.$dsm;?>'><? echo reemplazar($dstit);?></a></li>

<?
	 $result->MoveNext();
	 } // fin si
}
	$result->Close();
?>
 </ul>
</div>