<?
	$sql="select dsm,dsruta,dsimg1 from tblvinculos where idactivo=1";
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>
<div class="coofi_lateral">

	<ul>
		<?
			while(!$result->EOF){
			$dsm=reemplazar($result->fields[0]);
			$dsruta=$result->fields[1];
			$dsimg=$result->fields[2];
		?>
		
			<li>
				<a href="<? echo $dsruta?>">
				<? if($dsimg<>""){?>
					<img src="<? echo $rutalocalimag;?>/contenidos/images/redes/<? echo $dsimg;?>" />
				<?} else {?>
					<img src="<? echo $rutalocal?>/images/img_sin.png" alt="">
				<? } ?>
				<h2><? echo $dsm?></h2>
				<!--p>Párrafo vinculo</p-->
			</a>
			</li>
		
		<?
			$result->MoveNext();
			}
		?>
	</ul>

</div>

<div class="espacio3"></div>
<?
	}$result->Close();
?>