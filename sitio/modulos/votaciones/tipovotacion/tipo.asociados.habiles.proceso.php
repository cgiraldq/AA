<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
//include_once('../../../sitio/general.variables.php');
// proceso de validacion contra la tabla de usuarios del informer41_feisa
$sql="select a.idafiliacion,a.cedula,a.nombre1,a.nombre2,a.apellido1,a.apellido2,a.estado,a.email,a.telefono1,";
$sql.=" a.celular,c.idzonaelectoral,c.nombrezonaelectoral,a.codasociado ";
$sql.=" from tblasociados a, zonaselectoralesxasociadofeisa b,  zonaselectoralesfeisa c, tblidnitsxdscedula d ";
$sql.=" where d.cedulasociado=a.cedula and d.idnits=b.idnits and c.idzonaelectoral=b.idzonaelectoral ";
echo $sql;
//exit();
$result = $db->Execute($sql);
if (!$result->EOF) {
	echo $total->$result->RecordCount();
}
while (!$result->EOF) {
	$vector="0";

		if ($total<>$_SESSION['i_totalasociados']) {

			$cedula[]=$fila->cedula;
			$dsnombre[]=$fila->nombre1." ".$fila->nombre2." ".$fila->apellido1." ".$fila->apellido2;
			$idnits[]=$fila->idafiliacion;
			$idzonaelectoral[]=$fila->idzonaelectoral;
			$dszonaelectoral[]=$fila->nombrezonaelectoral;
			$dscodigoasociado[]=$fila->codasociado;



		}

$result->MoveNext();
}
$result->close();
?>