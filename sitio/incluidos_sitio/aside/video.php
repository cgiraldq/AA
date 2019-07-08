<?
	$sql="select a.dsvideo from tblvideos a where a.idactivo=1 order by rand() limit 0,1  ";
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>

<article class="cont_pregunta">
	<!--h1>VIDEOS</h1-->
	<?
	$dsvideo=reemplazar($result->fields[0]);

	?>
		<? echo $dsvideo?>
		<!--a href="videos.php" class="vermas"><p>ver más videos</p></a-->
</article>
<?

	}
	$result->Close();

?>
