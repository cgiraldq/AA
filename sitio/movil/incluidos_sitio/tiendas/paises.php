 
<?
$sql="select dsm,idactivo,idpos,dsd from tblpaisesmovil  where idactivo not in (2,9)";
$result=$db->Execute($sql);
?>

 <ul>
 	<h2>Distribuidores Internacionales</h2>

 	<?
if (!$result->EOF ) {
	while(!$result->EOF){
	$dsm= $result->fields[0];?>
	<li>
	<?echo reemplazar($dsm);?>
	</li>
	<?
$result->MoveNext();
}
}
$result->close();
	?>

 



</ul>