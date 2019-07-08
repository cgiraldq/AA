
<?
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$idx=$_REQUEST['idtalla'];
$idx=trim($idx);
$sql="delete from ecommerce_tbltallasxtblproductos where id=$idx";
if($db->Execute($sql)){
$data=1;
}else{
$data=-1;
}
include("../../../incluidos_modulos/cerrarconexion.php");
echo $data;
?>