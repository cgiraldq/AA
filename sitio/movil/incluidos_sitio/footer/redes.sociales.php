<?
$rutaImagen=$rutalocalimag."/contenidos/images/redes/";

	$sql="select dsm,dsruta,dsimg2 from tblredes where idactivo=1 order by idpos asc ";
	$resulty = $db->Execute($sql);
	//echo $sql;
	if (!$resulty->EOF) {

?>

<article class="redes">

	<ul>
<?
	while(!$resulty->EOF) {
		$dsm=reemplazar($resulty->fields[0]);
		$dsruta=$resulty->fields[1];
		$dsimg1=trim($resulty->fields[2]);


?>
		<li>
			<? if($dsimg1<>""){?>
			<a href="<? echo $dsruta;?>" data-transition="fade" >

				<img src="<? echo "../../contenidos/images/redes/".$dsimg1?>" alt="<? echo $dsm?>">
			</a>
			<?}?>
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