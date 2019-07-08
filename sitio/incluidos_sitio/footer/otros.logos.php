<?
$rutaImagen=$rutalocalimag."/contenidos/images/redes/";

	$sql="select dsm,dsruta,dsimg1 from tbllogos where idactivo=1 order by idpos asc ";
	$resulty = $db->Execute($sql);
	//echo $sql;
	if (!$resulty->EOF) {

?>
<article class="otros_logos">
	<ul>
<?
	while(!$resulty->EOF) {
		$dsm=reemplazar($resulty->fields[0]);
		$dsruta=reemplazar($resulty->fields[1]);
		$dsimg1=trim($resulty->fields[2]);


?>
		<!--li><img src="images/1.png"></li-->
		<li>
			<?if ($dsimg1<>""){?>
		<? if($dsruta<>""){?><a href="<? echo $dsruta?>" target="_blank" title="<? echo $dsm?>"><?}?>
			<img src="<? echo $rutalocalimag."/contenidos/images/redes/".$dsimg1?>" alt="<? echo $dsm?>">
		<? if($dsruta<>""){?></a><?}?>
			<? } ?>
		</li>

<?
	$resulty->Movenext();
}
?>
	</ul>
</article>
<?
	}
	$resulty->Close();
?>