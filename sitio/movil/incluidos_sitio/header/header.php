<?
		//echo $pagina;
		$sql="select dsimg1";
		$sql.=" from tblremate a where idactivo=1";
		//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	$img=$result->fields[0];
?>
<header >
	<article class="enc_tienda">


		<? if($img<>""){?><img src="../../contenidos/images/remate/<? echo $img; ?>"><?}?>
	</article>

</header>
<?
			} // fin si
				$result->Close();
		?>