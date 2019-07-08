<?
function combosfacturasp_editar($id,$idempresa){
global $dbase;
global $db;
$sql="Select sum(dstotal) as total,a.dsnit ";
$sql.=" from tblfacturase a  where  ";
$sql.=" a.idactivo in (0,1)" ;
$sql.=" group by a.dsnit ";
$sql.=" order by a.dsrazon asc ";
// prevalidacion para entrar al ciclo
$ssql=$db->Execute($sql);
 if(!$ssql->EOF){
		while(!$ssql->EOF) {
		$dsrazon=seldato("dsnombres","dsidentificacion","tblclientes",$ssql->fields[1],2);
		$apellidos=seldato("dsapellidos","dsidentificacion","tblclientes",$ssql->fields[1],2);
		if ($dsrazon=="N/A") $dsrazon=seldato("dsrazon","dsidentificacion","tblfacturase",$ssql->fields[1],2);
		if ($id==$ssql->fields[1]){
		echo "<option value='".$ssql->fields[1]."' selected>".$dsrazon." ".$apellidos."-".$ssql->fields[1]."</option>";
		} else{
		echo "<option value='".$ssql->fields[1]."'>".$dsrazon." ".$apellidos."-".$ssql->fields[1]."</option>";
		}
		$ssql->MoveNext();
	}	
	return 1;
} else {
 return 0;
}
$ssql->Close();

}
?>