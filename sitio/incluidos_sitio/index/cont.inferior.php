<?
  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsimg1,a.dsruta from tblcontenidos a where idactivo=1 order by idpos asc";
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
  	 while(!$result->EOF){
	  $id=$result->fields[0];
	  $dsm=reemplazar($result->fields[1]);
	  $dsimg=$result->fields[2];
	  $dsruta=$result->fields[3];

?>

<article class="cont_inferior">



	<ul>
	<!--h1><? echo $dsm?></h1-->
	<?
	  $dsnombre=$_REQUEST["dsnombre"];
	  $sqlx="select a.id,a.dsm,a.dsd,a.dsimg1,a.dsenlace,a.dsruta from tblcategoriacontenido a where idactivo=1 and idcat=$id order by idpos asc";
	  //echo $sqlx;
	$resultx=$db->Execute($sqlx);
	if(!$resultx->EOF){
		while(!$resultx->EOF){
		$id=$resultx->fields[0];
		$dsm=reemplazar($resultx->fields[1]);
		$dsd=reemplazar($resultx->fields[2]);
		$dsimg=$resultx->fields[3];
		$dsenlace=$resultx->fields[4];

		$dsruta=$resultx->fields[5];

	if($dsenlace<>""){
	$dsrutax=$dsenlace;

	 }else{
	 	 $dsrutax=$rutalocal."/informacion/".$dsruta;
	 if ($rutaAmiga>1){ $dsrutax="contenidos.detalle.php?id=".$id;}

	}
?>

		<li>
			
			<? if($dsimg<>""){?><a href="<? echo $dsrutax;?>" class="ver_mas">
			<img src="<? echo $rutalocalimag;?>/contenidos/images/categoriacontenido/<? echo $dsimg; ?>">

			</a><?}?>
				<a href="<? echo $dsrutax;?>" class="ver_mas" target="_blank"></a>
				
				<a href="<? echo $dsrutax;?>">
					<h2><? echo $dsm;?></h2>
				</a>
				<p><? echo $dsd;?></p>
			
			
			<!--a href="<? //echo $dsrutax;?>" class="ver_mas"><p>ver más</p></a-->
		</li>
<?
	 $resultx->Movenext();
 }
 }
  $resultx->Close();
?>


	</ul>

</article>

<?
	 $result->Movenext();
 }
 }
  $result->Close();
?>