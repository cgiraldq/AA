<?
  $id=$_REQUEST["id"];
  $sql="select dsm,dsd,id from tblasociados where idactivo not in(2,9) and id!='$id' order by idpos  ";
  $result = $db->Execute($sql);
  if (!$result->EOF) {
?>
<article class="otros_listado">
	<h2>OTROS</h2>
		<ul>
		<?

		  while(!$result->EOF) {

		  $dsm=reemplazar($result->fields[0]);
		  $dsd=trim($result->fields[1]);
		  $dsd=reemplazar($dsd);
		  $id=$result->fields[2];

		?>
			<li>
				<a href="asociados.detalle.php?id=<? echo $id;?>">
					<p><? //echo $dsm?><? echo $dsm;?></p>
					<!--p><? //echo $dsd?></p-->
				</a>
			</li>


		<?
		$result->MOveNext();
		}

		?>
		</ul>
	</article>
<?
}
$result->Close();
?>