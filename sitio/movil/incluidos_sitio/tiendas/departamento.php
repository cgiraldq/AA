 
<?
//$db->debug=true;
$sql="select dsm,idactivo,idpos,dsd,dsruta from tbldepartamentosmovil  where idactivo not in (2,9)";
$result=$db->Execute($sql);
?>

 
 	<h2>Distribuidores Nacionales</h2>
<ul>
	
 	<?
if (!$result->EOF ) {

	while(!$result->EOF){
	$dsm= $result->fields[0];?>
	<li>
	<?echo $dsm;?>
		</li>
		<?
$result->MoveNext();
}
}
$result->close();
?>
	

 



</ul>