
<?$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
 $db->debug=true;
$sql="select id,dsimg1,dsimg4,dsimg7 from tblproductos where 1";
$resul = $db->Execute($sql);
if (!$resul->EOF) {
while (!$resul->EOF) {

$id=$resul->fields[0];
$idimg1=$resul->fields[1];
$idimg2=$resul->fields[2];
$idimg3=$resul->fields[3];

	$sqld="delete from ecommerce_tblproductoximg where iddestino=$id";
	$db->Execute($sqld);
	if($idimg1<>"")
	{
	$sql="insert into ecommerce_tblproductoximg (iddestino,dsimg,idactivo) values($id,'$idimg1',1)";
	$db->Execute($sql);
	}
	if($idimg2<>"")
	{
	$sql="insert into ecommerce_tblproductoximg (iddestino,dsimg,idactivo) values($id,'$idimg2',1)";
	$db->Execute($sql);
	}
	if($idimg3<>"")
	{
	$sql="insert into ecommerce_tblproductoximg (iddestino,dsimg,idactivo) values($id,'$idimg3',1)";
	$db->Execute($sql);
	}

		$resul->MoveNext();
		 }
		 }
$resul->Close();
?>
