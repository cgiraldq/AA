<?
function combosusuarios($id,$idempresa){
global $idperfil,$idusuariodep,$dbase,$idlista,$facturar;
$sql="Select a.id,a.dsm ";
$sql.=" from tblusuarios a where  ";
$sql.=" a.idactivo not in (2,9) ";
$sql.=" order by a.dsm ASC";

global $db;
$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
		while (!$resultx->EOF) {
		if ($id==$resultx->fields[0]){
			echo "<option value=".$resultx->fields[0]." selected>".$resultx->fields[1]." </option>";
		} else{
			echo "<option value=".$resultx->fields[0].">".$resultx->fields[1]."</option>";
		}
		$resultx->MoveNext();
		}
		}
		$resultx->Close();
} 
function ultimadata($campo,$tabla){
global $dbase;
// contruccion
$sql="select $campo as param ";
$sql.=" from $tabla order by $campo desc limit 0,1";
global $db;
$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	$resultado=($resultx->fields[0].",0".",param")+1;
	if ($resultado=="") $resultado=1;
} else {
	$resultado="1";
}	
	return $resultado;
$resultx->Close();
}

function combosclientesp($id,$idempresa){
global $dbase;
global $db;
global $idactivox;
if ($idactivox=="") $idactivox="2,9";
$sql="Select a.id,a.dsnombres,a.dsapellidos,a.dsidentificacion,idtipocliente ";
$sql.=" from tblclientes a  where  ";
$sql.=" a.idactivo not in ($idactivox)";
$sql.=" and dsidentificacion<>''";
$sql.=" order by a.dsnombres ASC";
$resultp=$db->Execute($sql);
if (!$resultp->EOF) {
while (!$resultp->EOF){
if($id==$resultp->fields[0]){
echo "<option value=".$resultp->fields[0]."|".$resultp->fields[4]." selected>".$resultp->fields[1]." " .$resultp->fields[2]."--".$resultp->fields[3]."</option>";
}else{
	echo "<option value=".$resultp->fields[0]."|".$resultp->fields[4].">".$resultp->fields[1]." " .$resultp->fields[2]."--".$resultp->fields[3]."</option>";
}
$resultp->MoveNext();
}
}
$resultp->Close();
}
function combosconsecutivos($id){
global $dbase;
global $db;
global $idactivox;
$sql="Select a.dsprefijo,a.dsres,a.dsnombre,a.idconsecini,a.idconsecfin ";
$sql.=" from tblresoluciones a  where id>0 ";
$sql.=" order by a.dsnombre ASC";
$resultp=$db->Execute($sql);
if (!$resultp->EOF) {
while (!$resultp->EOF){
$valuex=$resultp->fields[0];	
$valuex.="|";
$valuex.=$resultp->fields[1];	
$valuex.="|";	
//$valuex.=$resultp->fields[2];	
$valuex.="|";	
$valuex.=$resultp->fields[3];	
$valuex.="|";	
$valuex.=$resultp->fields[4];	

if($id==$resultp->fields[0]){
echo "<option value=".$valuex." selected>".$resultp->fields[0]."-".$resultp->fields[1]."-".$resultp->fields[2]."</option>";
}else{
echo "<option value=".$valuex.">".$resultp->fields[0]."-".$resultp->fields[1]."-".$resultp->fields[2]."</option>";
}
$resultp->MoveNext();
}
}
$resultp->Close();
}
function combofpresentaciones($id,$idempresa){
global $dbase;
$sql="Select ida as id,dsa as nombre,dsi";
$sql.=" from tblformapresentaciones where idactivo=1 and idempresa=$idempresa order by dsa ASC";
global $db;
		$resultp=$db->Execute($sql);
		 if (!$resultp->EOF) {
		while (!$resultp->EOF){
			echo "<option value=".$resultp->fields[0].">".$resultp->fields[1]."</option>";
		$resultp->MoveNext();
		}
		}
		$resultp->Close();
}
function combosciudades($id,$idempresa){
global $dbase;
$sql="Select a.idciudad ,a.dsciudad ,a.dscodigo,b.dspais as pais ";
$sql.=" from tblciudades a, tblpaises b where a.idpais=b.idpais ";
$sql.=" and a.idactivo=1 and b.idactivo=1 and a.idempresa=$idempresa ";
$sql.=" and b.idempresa=$idempresa order by dsciudad ASC";
//echo $sql;
//exit();
global $db;
$resultp=$db->Execute($sql);
		 if (!$resultp->EOF) {
		while (!$resultp->EOF){
			echo "<option value=".$resultp->fields[0];
			if ($id==$resultp->fields[0]){ echo " selected";}
			echo ">";
			if ($fila->dscodigo){ echo $fila->dscodigo." - ";}			
			echo $resultp->fields[1]." (".$resultp->fields[3].")</option>";

		$resultp->MoveNext();
		}
		}
		$resultp->Close();
} 
function fechaletras($fecha){
	$partir=explode("/",$fecha);
	$dia=$partir[2];
	$mes=nombre_mes(intval($partir[1]));
	echo $mes. " ". $dia. " de ".$partir[0];

}
$filasdatos=20; // datos del ciclo
$filasdatosimprimir=10; // datos del ciclo
$filasdatosimprimircaja=28; // datos de impresion en recibo de caja

$filamostrar=3; // maximo de filas a mostrar
$posdatos=8; // posiciones de los consecutivos
$rutaImpresora="Lexmark 2500 Series";
?>

