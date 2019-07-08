	<?
		//echo $pagina;
		$sql="select dsimg1";
		$sql.=" from tblremate a where idactivo=1";
		//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	$img=$result->fields[0];
?>
	<article class="cont_logo_remate">

		<? if($img<>""){?><img src="../../contenidos/images/remate/<? echo $img; ?>" class="logo_remate"><?}?>
	</article>
<?
} // fin si
$result->Close();
?>