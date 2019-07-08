<?
$sql="select dsm,dsayuda from tblmodulos where dstabla='$tabla' and dsayuda<>'' ";
//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
	$dsm=$result->fields[0];
	$dsayuda=$result->fields[1];
?>
<article>
	<h1 id="ver" style="cursor:pointer"><img src="<?echo $rutxx;?>../../images/ayuda2.png"></h1>

	<article id="verayuda" class="blq_horz_index">

		<article class="img_izq">
			<img src="<?echo $rutxx;?>../../images/3.png">
		</article>

		<article class="txt_horizontal">

			<h2>AYUDA</h2>
			<h1><? echo ($dsm);?></h1>
			<p><? echo $dsayuda;?></p>

		</article>

	</article>

</article>

<script type="text/javascript">

	  $(document).ready( function() {
	  	$("#verayuda").hide();
	  $("#ver").click(function(){
	  		$("#verayuda").slideToggle("slow");
	  });

	  });
</script>
<?
}
$result->Close();
?>