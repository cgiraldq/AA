<?
	$sql="select dsm,dsruta,dsimg1,dsmodo from tblmenu_vertical where idactivo=1";
	$result=$db->Execute($sql);
	if(!$result->EOF){
?>
<div class="menu_vertical">

	<ul>
		<?
			while(!$result->EOF){
			$dsm=$result->fields[0];
			$dsruta=$result->fields[1];
			$dsimg=$result->fields[2];
			$dsmodo=$result->fields[3];
		?>


			<li>
				<a href="<? echo $dsruta?>" target="<? echo $dsmodo;?>">
							<div class="menu_icono"></div>
							<!--img src="<? //echo $rutalocal;?>/images/img_menu.png" alt=""-->
							<h2><? echo reemplazar($dsm);?></h2>
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