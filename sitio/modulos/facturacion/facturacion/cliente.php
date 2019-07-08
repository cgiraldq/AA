<?$inn=$_REQUEST['inn'];
$mod=$_REQUEST['mod'];
if ($inn<>"") { 
	$idcliente=$_REQUEST['idcliente']; // id del cliente
	if ($idcliente=="") {  // validar que haya ingresado los datos
		$tablabase="tblclientes"; // tabla base para ingresos nuevo
	include ("../../incluidos/cliente.nuevo.dato.php");
	}
	// traer los datos del cliente
	$partirx=explode("|",$idcliente);
	$idclientex=$partirx[0];
	$sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dsdireccion,dsciudad from tblclientes where id=$idclientex";
	$resultx=$db->Execute($sql);
	if(!$resultx->EOF){
		$dsrazon=$resultx->fields[0]." ".$resultx->fields[1];
		$dsnit=$resultx->fields[2];
		$dstele=$resultx->fields[3];
		$dsdir=$resultx->fields[4];
		$dsciudad=$resultx->fields[5];
	}$resultx->Close();

//echo $dsciudad;
//exit();
?>