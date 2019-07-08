<? 
if ($dsicono<>"") {
	if (is_file("../../../../contenidos/images/iconos/".$dsicono)) {?>
		<img src="../../../../contenidos/images/iconos/<? echo $dsicono;?>">
	<?} else {?>
		<img src="../../../contenidos/images/iconos/<? echo $dsicono;?>">
	<? } 

} else {
if (is_file("../../img_modulos/img/crm.png")) {?>
	<img src="../../img_modulos/img/crm.png">
<?} else {?>
	<img src="../../../img_modulos/img/crm.png">
<? } 
}
// cantidad de modulos activos
$sql="select count(*) as total ";
$sql.=" from tblmodulos a ";
$sql.=" where 1  ";
$sql.=" and a.idactivo in (3,4) and a.idmodulo=$idmodulo ";
$sql.=" order by a.dsm ASC ";
$resultd=$db->Execute($sql);
$activos=0;
if (!$resultd->EOF) {
		$activos=$resultd->fields[0];
  }
  $resultd->Close();	
?>

<a href="#">
	<? echo $dsmx;?>
	<div>
		Activo:<h4><? echo $activos?></h4> <!--/ Inactivos:<h4>20</h4-->
	</div>
</a>