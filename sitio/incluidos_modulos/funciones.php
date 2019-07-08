<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
//////////////////////////////////////////////////////////////////////
////////// FUNCIONES
// autorizado
function autorizado($AppNombre,$AppNombreCliente,$i_usuario,$i_dsempresa,$cadval1,$diff,$tipo){
global $donde,$referido,$remoto,$servidor,$c1,$c2,$c3,$correo;
// asunto
$asunto="El cliente $AppNombreCliente entra al $AppNombre (Usuario: $i_usuario ,Empresa: $i_dsempresa)";
$cuerpo.="Fecha ingreso: ".date("Y-M-D h:m:s")."\n";
// campos que se agregan a partir de esta version
$cuerpo.="Pagina de carga: ".$donde."\n";
$cuerpo.="Referido: ".$referido."\n";
$cuerpo.="IP: ".$remoto."\n";
$cuerpo.="Servidor: ".$servidor."\n";
// fin campos que se agregan a partir de esta version
$cuerpo.="----------------------------\n";
$cuerpo.= " ".$AppNombre."  - On line ". date("Y")  ." todos los derechos reservados\n";
$cuerpo.="Powered by $direccionAPP\n";
//echo $cuerpo;
//exit();
// envio de correo
//envio de correo con copia a la tienda
if ($servidor<>"localhost"){
//	mail($c1,$asunto,$cuerpo, "From: ".$correo);
	// mail($c2,$asunto,$cuerpo, "From: ".$correo);
	mail($c3,$asunto,$cuerpo, "From: ".$correo);
}
return 1;
}
// fin autorizado
// combo de tipo de entidades de salud
function combosesalud($vector){
global $saludVector;
	$partir=explode(",",$saludVector);
	$total=count($partir);
	for ($e=0;$e<$total;$e++) {
		?><option value="<? echo $partir[$e];?>" <? if ($vector==$partir[$e]){ echo "SELECTED";}?>><? echo $partir[$e];?></option><?
	}
}
// funcion adiconal a lo meses
function nombremes($vector){
global $mesesVector;
	$partir=explode(",",$mesesVector);
	return $partir[$vector-1];
}
function combomeses($compara){
	for ($meses=1;$meses<=12;$meses++) {
		if ($meses<10){
			$meses="0".$meses;
		}
		if ($compara==$meses){
			echo "<option value=".$meses." selected>".nombremes($meses)."</option>";
		} else{
			echo "<option value=".$meses.">".nombremes($meses)."</option>";
		}
	} // fin for
}
// funcion dias
function combodias($compara){
	for ($dias=1;$dias<=31;$dias++) {
		if ($dias<10){
			$dias="0".$dias;
		}
		if ($compara==$dias){
			echo "<option value=".$dias." selected>".$dias."</option>";
		} else{
			echo "<option value=".$dias.">".$dias."</option>";
		}
	} // fin for
}
// funcion de años
function comboanios($compara){
	for ($anios=(date("Y")-60);$anios<=(date("Y")-18);$anios++) {
		if ($compara==$anios){
			echo "<option value=".$anios." selected>".$anios."</option>";
		} else{
			echo "<option value=".$anios.">".$anios."</option>";
		}
	} // fin for
}
// funcion que convierte AAAAMMDD en dia mesletra año
function convFecha($fecha){
	$anio=substr($fecha,0,4);
	$mes=intval(substr($fecha,4,2));
	$dia=substr($fecha,6,2);
	echo $dia." de ".nombremes($mes)." de ".$anio;
}
function convFecha1($fecha){
	$anio=substr($fecha,0,4);
	$mes=intval(substr($fecha,4,2));
	$dia=substr($fecha,6,2);
	$valor=$dia." de ".nombremes($mes)." de ".$anio;
	return $valor;
}
// funcion global que trae un valor pedido de otro


// determinar asociacion
function asociardatau($campopedido,$campobase,$tabla,$valor,$valor1){
global $dbase;
// contruccion
$sql="select $campopedido as nombre ";
$sql.=" from $tabla ";
$sql.=" where $campobase=$valor ";
$sql.=" and idasoc=".$valor1;
//echo $sql;
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","nombre");
if ($resultado==""){
	return "N/A";
} else {
	return $resultado;
}
mysql_free_result($ssql);
}
// funcion que calcula total de visitas programadas por ciclo
function totalvisitasciclo($idr,$idciclo,$tabla,$tipo){
global $dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla where 1 ";
if ($tipo==1){
	$sql.=" and idruterodetalle=".$idr;
	$sql.=" and idciclo=".$idciclo;
} elseif ($tipo==2) {
	$sql.=" and idrutero=".$idr;
}
// echo $sql;
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
if (mysql_affected_rows()>0){
	$resultado=mysql_result($ssql,"0","total");
} else {
	$resultado=0;
}
mysql_free_result($ssql);
return $resultado;
}

// total farmacias o total

function totalvendedorr($idusuario,$tabla,$comp,$idempresa,$idperfil,$idusuariodep){
global $dbase;
global $idtipoasig,$tabla3,$iddia;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla a, tblusuariose b";
if ($idtipoasig==1){
	if ( $iddia<>"0" && $iddia<>"" ){
		$sql.=", $tabla3 c ";
	}
}
$sql.=" where a.idactivo=1 ";
if ($idtipoasig==1){
	if ($iddia<>"0" && $iddia<>""){
	$sql.=" and c.iditem=a.id ";
	$sql.=" and c.iddia=".$iddia;
	}
}
if ($idtipoasig==0){
	if ($iddia<>"0" && $iddia<>""){
	$sql.=" and a.idciclo".$iddia;
	}
}

//$sql.=" and idtipo in (4,3) ";
if ($idperfil==12 || $idperfil==15 || $idperfil==25){
	$sql.=" and b.idusuariodep=".$idusuariodep;
}
if ($comp==1){ // usuario
	$sql.=" and a.idusuario=".$idusuario;
	$sql.=" and a.idusuario=b.id ";
} elseif ($comp==2) { // compartido
	$sql.=" and a.idusuariootro=".$idusuario;
	$sql.=" and a.idusuariootro<>idusuario and idusuariootro<>0 ";
	$sql.=" and a.idusuariootro=b.id ";
} elseif ($comp==3) {  // carrera
	$sql.=" and (a.idcarrera=".$idusuario;
	$sql.=" or a.idcarrera2=".$idusuario;
	$sql.=" or a.idcarrera3=".$idusuario;
	$sql.="  )";
	$sql.=" and a.idusuario=b.id ";

} elseif($comp==0){ // todos
	$sql.=" and a.idusuario=b.id ";
	//$sql.=" and a.idusuariootro=0 ";
}
if ($idempresa<>0){
	$sql.=" and a.idempresa=".$idempresa;
}
// echo $sql;
// exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// anterior pero con item add
function totalvendedorradd($idusuario,$tabla,$comp,$idempresa,$idperfil,$idusuariodep,$itemadd){
global $dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla a, tblusuariose b where a.idactivo=1 ";
$sql.=" and a.idusuario=".$idusuario;
$sql.=" and a.idusuario=b.id ";
$sql.=" and a.idcarrera=".$itemadd;
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// lista las farmacias  o los vendedores
function totalvendedorr1($idusuario,$tabla){
global $idempresa,$dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla a, tblusuariose b where a.idactivo=1 ";
if ($idusuario<>"0") {
	$sql.=" and a.idusuario=".$idusuario;
}
$sql.=" and a.idusuario=b.id ";
$sql.=" and b.idempresa=".$idempresa;
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// funcion que calcula los items visitados segun las tabla seleccionada
function totalvisitasitems($idusuario,$tabla,$idciclo,$iddia,$idfechabase1,$idfechabase2,$tipo,$idempresa,$idcanal){
global $tabla1;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla a, $tabla1 b ";
// $sql.=" ,tblestadosvisitas b  where ";
$sql.=" where 1 ";
$sql.=" and b.id=a.idmedico ";
// $sql.=" and b.idactivo=1 and b.idval=1";
// $sql.=" and b.idtipo=".$tipo;
// $sql.=" and b.idev=a.idestado";
$sql.=" and a.idusuario=".$idusuario;
$sql.=" and b.idusuario=a.idusuario ";
if ($idfechabase1<>"" && $idfechabase2<>""){
	$sql.=" and (a.dsfecha between '".$idfechabase1."'";
	$sql.=" and  '".$idfechabase2."' )";
}
if ($idciclo<>"0" && $idciclo<>""){
	$sql.=" and a.idciclo=".$idciclo;
}
if ($iddia<>"0" && $iddia<>""){
	$sql.=" and a.iddia=".$iddia;
}
	$sql.=" and a.idreunion=0 "; // que no sea reunion
	if ($idcanal==1){
		$sql.=" and b.dsnombre<>'MEDICO SIN ASIGNAR' ";
	}elseif($idcanal==2){
		$sql.=" and b.dsnombre<>'FARMACIA SIN ASIGNAR' ";
	}elseif($idcanal==3){
		$sql.=" and b.dsnombre<>'CANALES SIN ASIGNAR' ";
	}
	$sql.=" and a.idcanal=".$idcanal; // canal
// dependiendo del tipo de canal que sea activa la visita
// echo $sql;
// exit();
global $db,$dbase;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// anterior pero se agrega otro item dependiendo del tipo de canal
function totalvisitasitemsmas($idusuario,$tabla1,$idciclo,$iddia,$idfechabase1,$idfechabase2,$tipo,$idempresa,$itemadd,$idcanal){
global $dbase;

// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla1 a";
// $sql.=" ,tblestadosvisitas b ";
if ($tipo==1){
	$sql.=" , tblmedicos b, tblcarreras c ";
}
$sql.=" where 1 ";
if ($tipo==1){
	$sql.=" and b.idcarrera=".$itemadd;
	$sql.=" and a.idmedico=b.id ";
	$sql.=" and b.idcarrera=c.idcarrera ";
	$sql.=" and b.dsnombre<>'MEDICO SIN ASIGNAR' ";	 // quitar los que usan sin asignar
}
// $sql.=" and b.idempresa=".$idempresa;
// $sql.=" and b.idactivo=1 and b.idval=1";
// $sql.=" and b.idtipo=".$tipo;
// $sql.=" and b.idev=a.idestado";
$sql.=" and a.dsr<>''";
$sql.=" and a.idusuario=".$idusuario;
$sql.=" and a.idcanal=".$idcanal;
if ($idfechabase1<>"" && $idfechabase2<>""){
	$sql.=" and (a.dsfecha between '".$idfechabase1."'";
	$sql.=" and  '".$idfechabase2."' )";
}
if ($idciclo<>"" && $idciclo<>"0"){
	$sql.=" and a.idciclo=".$idciclo;
}
if ($iddia<>"" && $iddia<>"0"){
	$sql.=" and a.iddia=".$iddia;
}
// dependiendo del tipo de canal que sea activa la visita
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// anterior pero sin depender de carrera

function totalvisitasitemsmassc($idusuario,$tabla1,$idciclo,$iddia,$idfechabase1,$idfechabase2,$tipo,$idempresa,$itemadd,$idcanal){
global $dbase;

// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla1 a";
// $sql.=" ,tblestadosvisitas b ";
if ($tipo==1){
	$sql.=" , tblmedicos b ";//, tblcarreras c ";
}
$sql.=" where 1 ";
if ($tipo==1){
//	$sql.=" and b.idcarrera=".$itemadd;
//	$sql.=" and a.idmedico=b.id ";
//	$sql.=" and b.idcarrera=c.idcarrera ";
	$sql.=" and b.dsnombre<>'CLIENTE SIN ASIGNAR' ";	 // quitar los que usan sin asignar
}
// $sql.=" and b.idempresa=".$idempresa;
// $sql.=" and b.idactivo=1 and b.idval=1";
// $sql.=" and b.idtipo=".$tipo;
// $sql.=" and b.idev=a.idestado";
// $sql.=" and a.dsr<>''";
$sql.=" and a.idusuario=".$idusuario;
$sql.=" and a.idcanal=".$idcanal;
$sql.=" and a.idmedico=b.id ";

if ($idfechabase1<>"" && $idfechabase2<>""){
	$sql.=" and (a.dsfecha between '".$idfechabase1."'";
	$sql.=" and  '".$idfechabase2."' )";
}
if ($idciclo<>"" && $idciclo<>"0"){
	$sql.=" and a.idciclo=".$idciclo;
}
if ($iddia<>"" && $iddia<>"0"){
	$sql.=" and a.iddia=".$iddia;
}
// dependiendo del tipo de canal que sea activa la visita
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}



// total de presentaciones
function totalpreprod($idprod,$tabla){
global $dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla ";
$sql.=" where idproducto=".$idprod;
// echo $sql;
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}

// total de visitas por ciclo
function totalvisitasrutero($idprod,$tabla){
global $dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from $tabla ";
$sql.=" where idproducto=".$idprod;
// echo $sql;
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}



// listado de paises en modo combo
function combospaises($id,$idempresa){
global $dbase;
$sql="Select idpais as id,dspais as nombre from tblpaises where idactivo=1 and idempresa=$idempresa order by dspais ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->id." (".$fila->nombre.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->id." (".$fila->nombre.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de regionales
function combosregionales($id,$idempresa){
global $dbase;
$sql="Select idtr as id,dstr as nombre from tblregionales where idactivo=1 and idempresa=$idempresa order by dstr ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de conductores
function combosconductores($id,$idempresa){
global $dbase;
$sql="Select id,dsnombre as nombre from tblpersonal where idactivo=1 and idtipo=27 order by dsnombre ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}



// combo tipo de archivos
function combostarchivos($id,$idempresa,$idtipo){
global $dbase;
$sql="Select idta as id,dsta as nombre,dsaa from tbltipoarchivos";
$sql.=" where idactivo=1 and idempresa=$idempresa and idtipo=$idtipo order by DSTA ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." (".$fila->dsaa.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." (".$fila->dsaa.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de capitulos
function comboscapitulos($id){
global $dbase;
$sql="Select idm as id,dsm as nombre from tblmodulomanual where idactivo=1 order by dsm ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// combo de temas
function combotemas($id,$idempresa){
global $dbase;
$sql="Select idt as id,dst as nombre from tbltemas where idactivo in (1,3,4,5) and idempresa=$idempresa order by dst ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// determina si el cliente tiene asociado otro vendedor


// combo de actividades con clientes
function comboactividades($id,$idempresa){
global $dbase;
$sql="Select idt as id,dst as nombre from tblactclientes where idactivo in (1,3,4,5) and idempresa=$idempresa order by dst ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}



// combo de tipos de recursos, archivos, etc
function combostiposarchivos($id,$idempresa,$idclas){
global $dbase;
$sql="Select idta as id,dsta as nombre,dsaa from tbltipoarchivos";
$sql.=" where idactivo=1 and idempresa=$idempresa and idtipo=$idclas order by dsta ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." (".$fila->dsaa.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." (".$fila->dsaa.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de distritos
function combosdistritos($id,$idempresa){
global $dbase;
$sql="Select idd as id,dsd as nombre from tbldistritos where idactivo=1 and idempresa=$idempresa order by dsd ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->id." (".$fila->nombre.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->id." (".$fila->nombre.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de empresas en el sistema
function comboempresas($id){
global $dbase;
$sql="Select idempresa as id,dsnombre as nombre from tblempresa where idactivo=1 order by dsnombre ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// sectores
function combossectores($id,$idempresa){
global $dbase;
$sql="Select idsector as id,dsector as nombre from tblsector where idactivo=1 and idempresa=$idempresa order by dsector ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// combo empresas
function combosempresas($id){
global $dbase;
$sql="Select a.idempresa as id,a.dsnombre as nombre ";
$sql.=" from tblempresa a where a.idactivo=1 ";
$sql.=" order by a.dsnombre ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combos ciudades
function combosciudades($id,$idempresa){
global $dbase;
$sql="Select a.idciudad as id,a.dsciudad as nombre,a.dscodigo,b.dspais as pais,idterminal ";
$sql.=" from tblciudades a, tblpaises b where a.idpais=b.idpais ";
$sql.=" and a.idactivo=1 and b.idactivo=1 and a.idempresa=$idempresa ";
$sql.=" and b.idempresa=$idempresa order by dsciudad ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
			echo "<option value=".$fila->id;
			if ($id==$fila->id){ echo " selected";}
			echo ">";
			if ($fila->dscodigo){ echo $fila->dscodigo." - ";}
			echo $fila->nombre." - ".$fila->idterminal." (".$fila->pais.")</option>";
	}
	return 1;
} else {
 return 0;
}

}
// anterior pero por usuario

function combosciudadesusuarios($id,$idempresa,$idusuario){
global $dbase;
$sql="Select a.idciudad as id,a.dsciudad as nombre,a.dscodigo,b.dspais as pais ";
$sql.=" from tblciudades a, tblpaises b,tblciudadesxusuario c where a.idpais=b.idpais ";
$sql.=" and a.idactivo=1 and b.idactivo=1 and a.idempresa=$idempresa ";
$sql.=" and a.idciudad=c.idc and c.ida=1 and c.idu=".$idusuario;
$sql.=" and b.idempresa=$idempresa order by dsciudad ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
			echo "<option value=".$fila->id;
			if ($id==$fila->id){ echo " selected";}
			echo ">";
			if ($fila->dscodigo){ echo $fila->dscodigo." - ";}
			echo $fila->nombre." (".$fila->pais.")</option>";
	}
	return 1;
} else {
		$sql="Select a.idciudad as id,a.dsciudad as nombre,a.dscodigo,b.dspais as pais ";
		$sql.=" from tblciudades a, tblpaises b where a.idpais=b.idpais ";
		$sql.=" and a.idactivo=1 and b.idactivo=1 and a.idempresa=$idempresa ";
		$sql.=" and b.idempresa=$idempresa order by dsciudad ASC";
		//echo $sql;
		//exit();
		$ssql1=mysql_db_query($dbase,$sql,$db);
		 if(mysql_affected_rows()>0){
			while($fila1=mysql_fetch_object($ssql1)) {
					echo "<option value=".$fila1->id;
					if ($id==$fila1->id){ echo " selected";}
					echo ">";
					if ($fila1->dscodigo){ echo $fila1->dscodigo." - ";}
					echo $fila1->nombre." (".$fila1->pais.")</option>";
			}
			return 1;
		} else {
		 return 0;
		}
}

}


// combos de productos presentaciones

function combosprodpres($id,$idempresa,$tipo){
global $dbase,$db;
$sql="Select a.idpres as id,a.dsdesc as pres,b.dsnombre as producto ";
$sql.=" from tblproductopres a, tblproductos b where a.idproducto=b.idproducto ";
$sql.=" and a.idactivo=1 and b.idactivo=1 and b.idempresa=".$_SESSION['i_idempresa']." order by b.dsnombre ASC";
//echo $sql;
//exit();
if ($tipo==1){ $v="";}
if ($tipo==2){ $v="[]";}
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
 echo "<select name='idpres$v' class='campos'>";
 echo "<option value=''>Seleccione...</option>";
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->producto." (".$fila->pres.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->producto." (".$fila->pres.")</option>";
		}
		}
echo "</select>";
	return 1;
} else {
	mysql_free_result($ssql);
 // cargar solos los productos
	$sql="Select a.idproducto as id,a.dsnombre as producto ";
	$sql.=" from tblproductos a where 1 ";
	$sql.=" and a.idactivo=1 and a.idempresa=".$_SESSION['i_idempresa'];
	$sql.=" order by a.dsnombre ASC";
	$ssql=mysql_db_query($dbase,$sql,$db);
	 if(mysql_affected_rows()>0){
	 echo "<select name='idprod$v' class='campos'>";
     echo "<option value=''>Seleccione...</option>";
		while($fila=mysql_fetch_object($ssql)) {
			if ($id==$fila->id){
				echo "<option value=".$fila->id." selected>".$fila->producto."</option>";
			} else{
				echo "<option value=".$fila->id.">".$fila->producto."</option>";
			}
			}
	echo "</select>";
		return 1;
	} else {
	 return 0;
	}
}

}

// funcion que calcula el nombre del producto y/o presentacion
function nombreprodpres($idprod,$idpres){
global $db,$dbase;
	if ($idprod<>"" && $idpres=="0"){
		$sql="Select a.idproducto as id,a.dsnombre as producto ";
		$sql.=" from tblproductos a where 1 ";
		$sql.=" and a.idactivo=1 and a.idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and a.idproducto=".$idprod;
		$ssql=mysql_db_query($dbase,$sql,$db);
		 if(mysql_affected_rows()>0){
		 	echo mysql_result($ssql,"0","producto");
		 } else {
		 	echo "N/A";
		 }
		 mysql_free_result($ssql);
	} elseif($idprod=="0" && $idpres<>""){
		$sql="Select a.idpres as id,a.dsdesc as pres,b.dsnombre as producto ";
		$sql.=" from tblproductopres a, tblproductos b where a.idproducto=b.idproducto ";
		$sql.=" and a.idactivo=1 and b.idactivo=1 and b.idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and a.idpres=".$idpres;
		$ssql=mysql_db_query($dbase,$sql,$db);
		 if(mysql_affected_rows()>0){
		 	echo mysql_result($ssql,"0","producto")." - ".mysql_result($ssql,"0","pres");
		 } else {
		 	echo "N/A";
		 }
		 mysql_free_result($ssql);
	}
}


// combos de asociaciones
function comboasoc($id,$idempresa){
global $dbase,$db;
$sql="Select a.ida as id,a.dsa as nombre ";
$sql.=" from tblasoc a ";
$sql.=" where a.idactivo=1 and  a.idempresa=".$_SESSION['i_idempresa'];
$sql.=" order by a.dsa ASC";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}




// combos de zonas
function comboszonas($id,$idempresa){
global $idperfil,$idusuariodep;
$sql="Select a.idz as id,a.dsz as nombre,dso as obs ";
$sql.=" from tblzonas a  ";
if ($idperfil==12 || $idperfil==25 || $idperfil==15){
	$sql.=" ,tblzonasxusuario b";
}
$sql.=" where  a.idactivo=1 and idempresa=$idempresa ";
if ($idperfil==12 || $idperfil==25 || $idperfil==15){
	$sql.=" and a.idz=b.idz and b.idu=".$idusuariodep;
	$sql.=" and b.ida=1 ";
}
$sql.=" order by a.dsz ASC";
//echo $sql;
//exit();
global $db,$dbase;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."  ".$fila->obs." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." ".$fila->obs."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// anteriores pero para el usuario
function comboszonasusuario($id,$idempresa,$idusuario){
global $dbase;
$sql="Select a.idz as id,a.dsz as nombre,dso as obs ";
$sql.=" from tblzonas a, tblzonasxusuario b where  ";
$sql.=" b.idz=a.idz and b.idu=".$idusuario." and b.ida=1 ";
$sql.=" and a.idactivo=1 and a.idempresa=$idempresa order by a.dsz ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."  ".$fila->obs." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." ".$fila->obs."</option>";
		}
	}
	return 1;
} else {
	// pintar las zonas normales
		$sql1="Select a.idz as id,a.dsz as nombre,dso as obs ";
		$sql1.=" from tblzonas a where  ";
		$sql1.=" a.idactivo=1 and idempresa=$idempresa order by dsz ASC";
		$ssql1=mysql_db_query($dbase,$sql1,$db);
		 if(mysql_affected_rows()>0){
			while($fila1=mysql_fetch_object($ssql1)) {
				if ($id==$fila1->id){
				echo "<option value=".$fila1->id." selected>".$fila1->nombre."  ".$fila1->obs." </option>";
				} else{
				echo "<option value=".$fila1->id.">".$fila1->nombre." ".$fila1->obs."</option>";
				}
			}
			return 1;
		} else {
		 return 0;
		}
}

}

// funcion que me muestra los items asignados dependiendo del tipo de
// asignaciones multiples
function itemsasociados($idusuario,$tabla1,$tabla3,$tipo,$tipoasig,$iddia,$idciclo){
global $dbase;
$sql="select count(*) as total from $tabla1 a";
if ($tipoasig==1){
	$sql.=",$tabla3 b ";
}
$sql.=" where 1 ";
if ($tipoasig==0){ // uno a uno
	if ($iddia<>0){
		$sql.=" and idciclo=".$iddia;
	}
}elseif ($tipoasig==1){ // muchos a muchos
	$sql.=" and a.id=b.iditem ";
	if ($iddia<>0){
		$sql.=" and b.iddia=".$iddia;
	}

}
	$sql.=" and idusuario=".$idusuario;
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
if(mysql_affected_rows()>0){
	$x=mysql_result($ssql,"0","total");
} else {
	$x=0;
}
mysql_free_result($ssql);
return $x;

}


// combos de carreras
function comboscarreras($id,$idempresa){
global $dbase;
$sql="Select a.idcarrera as id,a.dscarrera as nombre ";
$sql.=" from tblcarreras a where  ";
$sql.=" a.idactivo in (1,3) and idempresa=$idempresa order by dscarrera ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// combo de clinicas
function combosclinicas($id,$idempresa){
global $dbase;
$sql="Select a.idclinica as id,a.dsclinica as nombre ";
$sql.=" from tblclinicas a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa order by dsclinica ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de cadenas
function comboscadenasf($id,$idempresa){
global $dbase;
$sql="Select a.idcf as id,a.dscf as nombre ";
$sql.=" from tblcadenasf a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa order by dscf ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila1=mysql_fetch_object($ssql)) {
		if ($id==$fila1->id){
			echo "<option value=".$fila1->id." selected>".$fila1->nombre." </option>";
		} else{
			echo "<option value=".$fila1->id.">".$fila1->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// combo de convenios
function combosconvenios($id,$idempresa){
global $dbase;
$sql="Select a.idcv as id,a.dscv as nombre ";
$sql.=" from tblconvenios a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa order by dscv ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de tipos de clientes
function combostipoclientes($id,$idempresa,$tipo){
global $dbase;
$sql="Select a.idtc as id,a.dstc as nombre ";
$sql.=" from tbltipoclientes a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa and idtipo=$tipo order by dstc ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de usuarios
function combosusuarios($id,$idempresa){
global $idperfil,$idusuariodep,$dbase,$idlista;
$sql="Select a.id,a.dsnombre as nombre ";
$sql.=" from tblusuariose a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa";
if ($idlista<>"") $sql.=" and a.idlista=1 ";
$sql.=" order by a.dsnombre ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

function comboasesores($id,$idempresa){
global $idperfil,$idusuariodep,$dbase,$idlista;
$sql="Select a.id,a.dsm as nombre ";
$sql.=" from tblusuarios a where  ";
$sql.=" a.idactivo=1 ";
if ($idlista<>"") $sql.=" and a.idlista=1 ";
$sql.=" order by a.dsm ASC";
echo $sql;
//exit();
global $db;

$result = $db->Execute($sql);
	if (!$result->EOF) {
	while (!$result->EOF) {
		$idx=$result->fields[0];


		if ($id==$idx){
			echo "<option value=".$result->fields[0]." selected>".$result->fields[1]." </option>";
		} else{
			echo "<option value=".$result->fields[0].">".$result->fields[1]."</option>";
		}
		$result->MoveNext();
		}
	return 1;
} else {
 return 0;
}
$result->Close();

}

// anterior pero por perfil
function combosusuariosperfil($id,$idempresa,$idperfil){
global $idusuariodep,$dbase,$idlista;
$sql="Select a.id,a.dsnombre as nombre ";
$sql.=" from tblusuariose a where  ";
$sql.=" a.idactivo=1 and idtipo=$idperfil and idempresa=$idempresa";
if ($idlista<>"") $sql.=" and a.idlista=1 ";
$sql.=" order by a.dsnombre ASC";

global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	mysql_free_result($ssql);
	return 1;
} else {
 return 0;
}

}


// anterior pero con dependencia de usuarios
function combosusuariosperfildep($id,$idempresa,$idperfil,$iddep,$inc){
global $idusuariodep,$dbase;
$sql="select a.id,a.dsnombre as nombre from tblusuariose a, tblusuariosxdependencias  b";
$sql.=" where b.idcolab=a.id and a.idactivo not in (2)  ";
$sql.=" and b.idjefe=".$iddep;
$sql.=" group by a.id,a.dsnombre order by a.dsnombre asc";
global $db;
if ($inc==1) {
	$espacio="";
} else {
	$espacio="";
	for ($i=0;$i<=$inc;$i++) {
		$espacio.="-";
	}
}

$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>$espacio".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">$espacio".$fila->nombre."</option>";
		}
		combosusuariosperfildep($fila->id,$idempresa,$idperfil,$fila->id,$inc*2);
	} // fin while
	mysql_free_result($ssql);


} else {
 return 0;
}

}



// funcion de listar los tipos de pautas
function combostipospautas($id,$idempresa){
global $idperfil,$idusuariodep,$dbase;
$sql="Select a.idtp as id,a.dstp as nombre ";
$sql.=" from tbltipopautas a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa";
$sql.=" order by a.dstp ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// funcion de listar las formas de pago
function combosfpagos($id,$idempresa){
global $idperfil,$idusuariodep,$dbase;
$sql="Select a.idfp as id,a.dsfp as nombre ";
$sql.=" from tblfpago a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa";
$sql.=" order by a.dsfp ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


function combostiposcomerciales($id,$idcampo){
global $idperfil,$idusuariodep,$dbase;
$sql="Select a.idcom as id,a.strcom as nombre ";
$sql.=" from tblcomerciales a where  ";
$sql.=" a.idactivo=1 and idcliente=$idcampo";
$sql.=" order by a.strcom ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}



// combos estados civiles
function combosestadosciviles($id){
global $dbase;
$sql="Select a.idec as id,a.dsec as nombre ";
$sql.=" from tblestadosciviles a where  ";
$sql.=" a.idactivo=1 order by dsec ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// Combo estados visitas
// cambios octubre / 2005
// se le agrega tipo
function combosestadosvisitas($id,$tipo,$idempresa){
global $dbase;
$sql="Select a.idev as id,a.dsev as nombre ";
$sql.=" from tblestadosvisitas a where  ";
$sql.=" a.idactivo=1 ";
$sql.=" and a.idempresa=".$idempresa;
$sql.=" and a.idtipo=$tipo order by dsev ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// antrerior pero con explicacion de cada uno
function combosestadosvisitasrep($id,$tipo,$idempresa){
global $dbase;
$sql="Select a.idev as id,a.dsev as nombre, a.idtipo ";
$sql.=" from tblestadosvisitas a where  ";
$sql.=" a.idactivo=1 ";
$sql.=" and a.idempresa=".$idempresa;
$sql.=" order by dsev ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($fila->idtipo==1){
			$opt="Clientes";
		} elseif ($fila->idtipo==2){
			$opt="Concesionarios";
		} elseif ($fila->idtipo==2){
			$opt="Otros";
		}
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." (".$opt.") </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." (".$opt.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combos medicos
// Modificacion Octubre 2005
// se agrega ciclo
// combos de clientes
function combosclientesv($id,$idusuario,$tipo,$ciclo){
global $dbase,$idperfil;
global $db;
$sql="Select a.id,a.dsnombre1,a.dsnombre2,a.dsapell,a.dsapell2";
$sql.=" from tblclientes a";
if ($ciclo<>"0" && $ciclo<>"") $sql.=" ,tbldiasxclientes b  ";
$sql.=" where a.idactivo=1 and a.dslogin<>'csa' ";
if ($idperfil==38 || $idperfil==39 || $idperfil==0) {

} else {
	if ($tipo==1){
		$sql.=" and (a.idusuario=".$idusuario;
		$sql.=" or a.idusuariootro=".$idusuario.")";
	}
}
if ($ciclo<>"0" && $ciclo<>"") $sql.=" and a.id=b.iditem  and b.iddia=".$ciclo;
$sql.=" ";
$sql.=" group by a.id,a.dsnombre1,a.dsnombre2,a.dsapell,a.dsapell2 ";
$sql.=" order by a.dsnombre1 ASC";
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
$dsnombre=$fila->dsnombre1."&nbsp;".$fila->dsnombre2."&nbsp".$fila->dsapell."&nbsp".$fila->dsapell2;
	if ($id==$fila->id){
	echo "<option value=".$fila->id." selected>".$dsnombre."</option>";
	} else{
		echo "<option value=".$fila->id.">".$dsnombre."</option>";
	}
	}
}
mysql_free_result($ssql);
echo "<option value='' class='textos1'>Otros Clientes </option>";
	$sql="Select id,dsnombre1,dsnombre2,dsapell,dsapell2 ";
	$sql.=" from tblclientes where  ";
	$sql.=" idactivo=1 ";
	if ($tipo==1){
		$sql.=" and (idusuario=".$idusuario;
		$sql.=" or idusuariootro=".$idusuario.")";
	}
	$sql.=" group by id,dsnombre,dsnombre2,dsapell,dsapell2";
	$sql.=" order by dsnombre1 ASC";
//echo $sql;
//exit();
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
$dsnombre=$fila->dsnombre1."&nbsp;".$fila->dsnombre2."&nbsp".$fila->dsapell."&nbsp".$fila->dsapell2;

		if ($id==$fila->id){
echo "<option value=".$fila->id." selected class='campo2'>".$dsnombre."</option>";
		} else{
echo "<option value=".$fila->id." class='campo2'>".$dsnombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// anterior pero con clientes asociados

function combosclientesasoc($id,$idusuario,$tipo,$ciclo){
global $dbase,$idperfilx;
global $db;
$sql="Select a.id,a.dsnombre1,a.dsnombre2, a.dsapell,a.dsapell2";
$sql.=" from tblclientes a where  ";
$sql.=" a.id > 0 and a.idactivo<>4 "; // a.idactivo=1
if ($tipo==1){
	if ($idperfilx<>3 && $idperfilx<>4 && $idperfilx<>5 && $idusuario<>"") {
		$sql.=" and a.idusuario=".$idusuario;
	} else {
		$sql.=" and a.dsnombre1<>'CLIENTE SIN ASIGNAR'";
	}
// 	$sql.=" or a.idusuariootro=".$idusuario.")";
}
$sql.=" group by a.id,a.dsnombre1,a.dsnombre2,a.dsapell,a.dsapell2 ";
$sql.=" order by a.dsnombre1 ASC";
// echo $sql;
// exit();
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
 echo "<option value='' class='textos1'>Sus clientes</option>";
	while($fila=mysql_fetch_object($ssql)) {
	//verificar numero de visitas
	$sql="select count(id) as t  from tblvisitas where idcliente=".$fila->id;
	$vermas=mysql_db_query($dbase,$sql,$db);
	if(mysql_num_rows($vermas)>0){
		$x=mysql_result($vermas,"0","t");
		if ($x > 0 ){
			 $x="*";
		} else {
			$x="";
		}
	 } else {
	 	$x="";
	 }
	mysql_free_result($vermas);


		$dsnombre=$fila->dsnombre1."&nbsp;".$fila->dsnombre2."&nbsp".$fila->dsapell."&nbsp".$fila->dsapell2;
	if ($id==$fila->id){
	echo "<option value=".$fila->id." selected>".$dsnombre." $x</option>";
	} else{
		echo "<option value=".$fila->id.">".$dsnombre." $x</option>";
	}
	}
}
mysql_free_result($ssql);


	$sql="select c.id,c.dsnombre1,c.dsnombre2,c.dsapell,c.dsapell2 from ";
	$sql.=" tblusuariose a, tblusuariosxclientes b,tblclientes c ";
	$sql.=" where a.id > 0 and c.id=b.idcliente";
	$sql.=" and b.idusuario=a.id and b.idusuario=".$idusuario;
	$sql.=" group by c.id,c.dsnombre1,c.dsnombre2,c.dsapell,c.dsapell2 ";
	$sql.=" order by c.dsnombre1 ASC";
//echo $sql;
//exit();
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
 echo "<option value='' class='textos1'>Clientes Asociados</option>";
	while($fila=mysql_fetch_object($ssql)) {

	//verificar numero de visitas
	$sql="select count(id) as t  from tblvisitas where idcliente=".$fila->id;
	$vermas=mysql_db_query($dbase,$sql,$db);
	if(mysql_num_rows($vermas)>0){
		$x=mysql_result($vermas,"0","t");
		if ($x>0) $x="*";
	 } else {
	 	$x="";
	 }
	mysql_free_result($vermas);


		$dsnombre=$fila->dsnombre1."&nbsp;".$fila->dsnombre2."&nbsp".$fila->dsapell."&nbsp".$fila->dsapell2;
		if ($id==$fila->id){
echo "<option value=".$fila->id." selected class='campo2'>".$dsnombre." $x</option>";
		} else{
echo "<option value=".$fila->id." class='campo2'>".$dsnombre." $x</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// anterior pero con clientes y programas

function combosclientesprogramas($id){
global $dbase;
global $db,$idtipocliente,$idtipo;
$sql="Select a.idp as id,a.dstit as ds ";
$sql.=" from tblprogramas a where  ";
$sql.=" a.idactivo in (1,4) ";
$sql.=" order by a.dstit asc ";
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id && $idtipocliente==1){
			echo "<option value=".$fila->id." selected>".$fila->ds."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->ds."</option>";
		}
	 } // fin while
} // fin si
mysql_free_result($ssql);
if ($idtipo=="") {
// actividades empresa
echo "<option value='' class='link22'>Actividades Empresa</option>";
$sql="Select a.idp as id,a.dstit as ds ";
$sql.=" from tblprogramas a where  ";
$sql.=" a.idactivo=3 ";
$sql.=" order by a.dstit asc ";
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id && $idtipocliente==1){
			echo "<option value=".$fila->id." selected>".$fila->ds."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->ds."</option>";
		}
	 } // fin while
} // fin si
mysql_free_result($ssql);
// actividades
$sql="Select a.id,a.dsnombre as ds, b.dsactividad ";
$sql.=" from tblclientes a, tblinformacionpre b where  ";
$sql.=" a.idactivo=1 and a.id=b.idcliente ";
$sql.=" and b.dsactividad<>'' ";
$sql.=" group by a.id,a.dsnombre, b.dsactividad ";
$sql.=" order by b.dsactividad asc ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
echo "<option value='' class='link22'>Actividades Clientes</option>";
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id && $idtipocliente==2){
			echo "<option value=".$fila->id." selected>".$fila->dsactividad." -".$fila->ds."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->dsactividad." -".$fila->ds."</option>";
		}
	 } // fin while
} // fin si
mysql_free_result($ssql);
}
}
// funcion que lista los datos de los items de preproduccion
function combositemsprod($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tbltemas where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3,4,5) order by dst asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
				echo "<option value='' class='link22'>".$fila->dst."</option>";
				$sql=" select * from tblsubtemas where idtema=".$fila->idt;
				$sql.=" and idactivo in (1,3,4,5) order by dst asc ";
				$vermas1=mysql_db_query($dbase,$sql,$db);
				if (mysql_affected_rows()>0){
					while($fila1=mysql_fetch_object($vermas1)){
					if ($id==$fila1->idst) {
						echo "<option value='".$fila1->idst."' class=text1 selected>-  ".$fila1->dst."</option>";
					} else {
					echo "<option value='".$fila1->idst."' class=text1>- ".$fila1->dst."</option>";

					}

					}

				}
				mysql_free_result($vermas1);

			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}


// lostado de actividades con subactividades

function combosactsubact($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tblactclientes  where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3,4,5) order by dst asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
				if ($id==$fila->idt) {
					echo "<option value='".$fila->idt."' class='campos' selected>".$fila->dst."</option>";
				} else {
					echo "<option value='".$fila->idt."' class='campos'>".$fila->dst."</option>";
				}
			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}
// combos de tipos
function combostipos($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tbltipos  where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3,4,5) order by dst asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
				if ($id==$fila->idt) {
					echo "<option value='".$fila->idt."' class='campos' selected>".$fila->dst."</option>";
				} else {
					echo "<option value='".$fila->idt."' class='campos'>".$fila->dst."</option>";
				}
			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}


// resultados de acvtividades
function combosresultadosact($id,$idempresa,$nombrecampo){
global $dbase;
global $db;
$sql="select * from tblrazonesactividad  where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3) order by dsoc asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			echo "			Motivos de la actividad <select name='$nombrecampo' class='text1'>";
			echo  "<option value=''>...</option>";
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
			if ($id==$fila->idoc) {
		echo "<option value='".$fila->idoc."' class='campos' selected>".$fila->dsoc."</option>";
			} else {
			echo "<option value='".$fila->idoc."' class='campos'>".$fila->dsoc."</option>";
			}
			}
		mysql_free_result($vermas);
		echo "</select>";
	return 1;
} else {
 return 0;
}

}


function combosresultadosact_fin($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tblresactividad where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3) order by dsra asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
			if ($id==$fila->idra) {
		echo "<option value='".$fila->idra."' class='campos' selected>".$fila->dsra."</option>";
			} else {
			echo "<option value='".$fila->idra."' class='campos'>".$fila->dsra."</option>";
			}
			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}


// listar las  transportadoras
function combostransportadoras($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tbltransportadoras where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3) order by dst asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
			if ($id==$fila->idt) {
		echo "<option value='".$fila->idt."' class='campos' selected>".$fila->dst."</option>";
			} else {
			echo "<option value='".$fila->idt."' class='campos'>".$fila->dst."</option>";
			}
			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}

// tipos de contactos
function combostipocontactos($id,$idempresa){
global $dbase;
global $db;
$sql="select * from tbltipocontactos where idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and idactivo in (1,3) order by dstcc asc ";
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
			if ($id==$fila->idtcc) {
		echo "<option value='".$fila->idtcc."' class='campos' selected>".$fila->dstcc."</option>";
			} else {
			echo "<option value='".$fila->idtcc."' class='campos'>".$fila->dstcc."</option>";
			}
			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}

}


// combo de personal
function combospersonal($id,$idempresa){
global $dbase,$db,$idu,$idp;
$sql="Select a.id,a.dsnombre as nombre,a.idactivo,a.dscargo ";
$sql.=" from tblpersonal a where a.idactivo in (1,3)  ";
$sql.=" and a.idempresa=".$idempresa;
// if ($idp<>0) $sql.=" and a.idusuariodep=".$idu;
$sql.=" order by a.idactivo,dsnombre ASC ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($fila->idactivo==1) $x=" - P ";
		if ($fila->idactivo==3) $x=" - F ";
		if ($fila->dscargo<>"" && $fila->dscargo<>"0") {
			$c="(".$fila->dscargo.")";
		} else {
			 $c="";
		}
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." $x $c</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." $x $c</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}




// anterior pero solo los clientes
function combosclientesp($id,$idempresa){
global $dbase;
global $db;
$sql="Select a.id,a.dsnit,a.dsnombre1 as dsnombre,a.dsapell as dscomercial";
$sql.=" from tblclientes a  where  ";
$sql.=" a.idactivo not in (2) and a.idempresa=".$idempresa;
$sql.=" and a.dslogin<>'CSA' or a.dslogin is null ";
$sql.=" order by a.dsnombre1 ASC";
//echo $sql;
//exit();
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
	if ($id==$fila->id){
	echo "<option value=".$fila->id." selected>".$fila->dsnombre." ".$fila->dscomercial." - ".$fila->dsnit."</option>";
	} else{
		echo "<option value=".$fila->id.">".$fila->dsnombre." ".$fila->dscomercial." - ".$fila->dsnit."</option>";
	}
	}
	return 1;
} else {
 return 0;
}

}

// cargar guiones
function combosguiones($id,$idprog){
global $dbase;
global $db;
$sql="Select a.id,a.dsnombre";
$sql.=" from tblguiones a  where  ";
$sql.=" a.idprograma=".$idprog;
$sql.=" order by a.id desc";
//echo $sql;
//exit();
// prevalidacion para entrar al ciclo
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
	if ($id==$fila->id){
		echo "<option value='$fila->id' selected>$fila->dsnombre</option>";
	} else{
		echo "<option value='$fila->id'>$fila->dsnombre</option>";
	}
	}
	return 1;
} else {
 return 0;
}

}


// combo entidades
function comboentidades($id,$idempresa){
global $dbase;
$sql="Select a.ides as id,a.dses as nombre,a.tipo ";
$sql.=" from tblesalud a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa order by dses ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." (".$fila->tipo.")</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre." (".$fila->tipo.")</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// fin combo entidades

// combo de clasificaciones por tipo de canal
function comboclas($id,$idempresa,$tipo){
global $dbase;
$sql="Select a.idtc as id,a.dstc as nombre ";
$sql.=" from tblclas a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa and a.idtipo=".$tipo;
$sql.="  order by dstc ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo de ciclos
function combociclos($id,$idempresa,$idanio){
global $dbase,$db;
$sql="Select a.idciclo as id,a.dsc as nombre ";
$sql.=" from tblciclos a where  ";
$sql.=" a.idactivo=1 ";
if ($idanio<>0){
	$sql.=" and a.idanio=$idanio ";
}
$sql.=" and a.idempresa=".$idempresa;
$sql.=" order by idciclo ASC";

$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
// fin combo de ciclos
// anterior pero sin control de ciclos
function combociclos1($id,$idempresa,$idanio){
global $dbase,$db;
$sql="Select a.idciclo as id,a.dsc as nombre ";
$sql.=" from tblciclos a where 1  ";
if ($idanio<>0){
	$sql.=" and a.idanio=$idanio ";
}
$sql.=" and a.idempresa=".$idempresa;
$sql.=" order by idciclo ASC";

$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// combo de recursos
function comborecursos($id,$idempresa){
global $dbase;
$sql="Select idr as id,dsr as nombre from tblrecursosguiones";
$sql.=" where idactivo=1 and idempresa=$idempresa order by dsr ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// combo de tipo de cortes
function combotiposcortes($id,$idempresa){
global $dbase;
$sql="Select idtc as id,dstc as nombre from tbltiposcortesguiones";
$sql.=" where idactivo=1 and idempresa=$idempresa order by dstc ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


function checklistausuarios($idusuario){
global $dbase,$db;
$sql="Select a.id,a.dsnombre  ";
$sql.=" from tblusuariose a ";
$sql.=" where a.idusuariodep=".$idusuario;
$sql.=" and a.idactivo=1 and id<>idusuariodep";

$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
	echo "<input type=checkbox name=idu[] value=".$fila->id.">".$fila->dsnombre."<br>";
	}
 }
mysql_free_result($ssql);
}

// anterior pero mostrando todos
function checklistausuariostodos($idusuario){
global $dbase,$db,$fondos,$idusuarioz;
$sql="Select a.id,a.dsnombre  ";
$sql.=" from tblusuariose a ";
$sql.=" where ";
$sql.=" a.idactivo=1 and id<>$idusuario order by a.dsnombre asc ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
echo "<table class='text1' border=0 cellspacing='1' cellpadding='2' bgcolor=".$fondos[21].">";
	echo "<tr bgcolor=".$fondos[3].">";
	echo "<td colspan='2'><input type=checkbox name='Adjuntarm' onclick='Adjuntartodousuarios()' value='1'><strong>Todos</strong></td>";
	echo "</tr>";
 	echo "<tr bgcolor=".$fondos[3].">";
	while($fila=mysql_fetch_object($ssql)) {
		if ($idusuarioz==$fila->id) {
			$x="checked";
		} else {
			$x="";
		}
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." $x>".$fila->dsnombre."</td>";
		while($fila=mysql_fetch_object($ssql)) {

		if ($idusuarioz==$fila->id) {
			$x="checked";
		} else {
			$x="";
		}


			echo "<td bgcolor=".$fondos[3].">";
			echo "<input type=checkbox name=idusuariox[] value=".$fila->id." $x>".$fila->dsnombre;
			echo "</td>";
			break;
			}
			echo "</tr>";
		}

	 }
	 echo "</table>";

mysql_free_result($ssql);
}

// anterior pero con mensajes

function checklistausuariostodos_mensajes($idusuario,$dsasunto){
global $dbase,$db,$fondos,$idusuarioz;
$sql="Select a.id,a.dsnombre  ";
$sql.=" from tblusuariose a ";
$sql.=" where ";
$sql.=" a.idactivo=1 ";
// $sql.=" and id<>$idusuario ";
$sql.=" order by a.dsnombre asc ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
echo "<table class='text1' border=0 cellspacing='1' cellpadding='2' bgcolor=".$fondos[21].">";
	echo "<tr bgcolor=".$fondos[3].">";
	echo "<td colspan='2'><input type=checkbox name='Adjuntarm' onclick='Adjuntartodousuarios()' value='1'><strong>Todos</strong></td>";
	echo "</tr>";
 	echo "<tr bgcolor=".$fondos[3].">";
	while($fila=mysql_fetch_object($ssql)) {

		$sql="select idm,idrecibe from tblmensajes_usuarios ";
		$sql.=" where idusuario=".$idusuario;
		$sql.=" and dsasunto='".$dsasunto."' and idrecibe=".$fila->id;
		$vermasxx=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0) {
			$x="checked";
			$b1="<strong>";
			$b2="</strong>";
		} else {
		mysql_free_result($vermasxx);

			$sql="select idm,idusuario from tblmensajes_usuarios ";
			$sql.=" where idrecibe=".$idusuario." and idusuario<>idrecibe";
			$sql.=" and dsasunto='".$dsasunto."' and idusuario=".$fila->id;
			$vermasxx=mysql_db_query($dbase,$sql,$db);
			if (mysql_affected_rows()>0) {
				$x="checked";
				$b1="<strong>";
				$b2="</strong>";
			} else {
				$x="";
				$b1="";
				$b2="";
			}
			mysql_free_result($vermasxx);
		}


echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." $x>$b1".$fila->dsnombre."$b2</td>";
		while($fila=mysql_fetch_object($ssql)) {

		$sql="select idm,idrecibe from tblmensajes_usuarios ";
		$sql.=" where idusuario=".$idusuario;
		$sql.=" and dsasunto='".$dsasunto."' and idrecibe=".$fila->id;
		$vermasxx=mysql_db_query($dbase,$sql,$db);
		if (mysql_affected_rows()>0) {
			$x="checked";
			$b1="<strong>";
			$b2="</strong>";
		} else {
		mysql_free_result($vermasxx);

			$sql="select idm,idusuario from tblmensajes_usuarios ";
			$sql.=" where idrecibe=".$idusuario." and idusuario<>idrecibe";
			$sql.=" and dsasunto='".$dsasunto."' and idusuario=".$fila->id;
			$vermasxx=mysql_db_query($dbase,$sql,$db);
			if (mysql_affected_rows()>0) {
				$x="checked";
				$b1="<strong>";
				$b2="</strong>";
			} else {
				$x="";
				$b1="";
				$b2="";
			}
			mysql_free_result($vermasxx);
		}



			echo "<td bgcolor=".$fondos[3].">";
			echo "<input type=checkbox name=idusuariox[] value=".$fila->id." $x>$b1".$fila->dsnombre;
			echo "$b2</td>";
			break;
			}
			echo "</tr>";
		}

	 }
	 echo "</table>";

mysql_free_result($ssql);
}


// anterior pero para grupos
function checklistausuariostodosgrupos($idusuario,$idgrupo,$forma){
global $dbase,$db;
$sql="Select a.id,a.dsnombre  ";
$sql.=" from tblusuariose a ";
$sql.=" where ";
$sql.=" a.idactivo=1 and id<>$idusuario order by a.dsnombre asc ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
 	echo "<table class='textonegro' border=1>";
	echo "<tr>";
	echo "<td colspan='2'><input type=checkbox name='Adjuntarm' onclick=Adjuntartodousuariosgrupos('$forma') value='1'><strong>Todos</strong></td>";
	echo "</tr>";
 	echo "<tr>";
	while($fila=mysql_fetch_object($ssql)) {

	// validaciones adicional
	$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
	$sql.=" idusuario=".$fila->id;
	$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
	mysql_free_result($ssqlx);



		while($fila=mysql_fetch_object($ssql)) {
		// validaciones adicional
		$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
		$sql.=" idusuario=".$fila->id;
		$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
		mysql_free_result($ssqlx);

			break;
			}
			echo "</tr>";
		}

	 }
	 echo "</table>";

mysql_free_result($ssql);
}

// anterior pero a cuatro filas
function checklistausuariostodosgrupos_dos($idusuario,$idgrupo,$forma){
global $dbase,$db,$fondos;
$sql="Select a.id,a.dsnombre  ";
$sql.=" from tblusuariose a ";
$sql.=" where ";
$sql.=" a.idactivo=1 and id<>$idusuario order by a.dsnombre asc ";
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
echo "<table class='text1' border=0 cellspacing='1' cellpadding='2' bgcolor=".$fondos[12].">";
	echo "<tr bgcolor=".$fondos[3].">";
	echo "<td colspan='2'><input type=checkbox name='Adjuntarm' onclick=Adjuntartodousuariosgrupos('$forma') value='1'><strong>Todos</strong></td>";
	echo "</tr>";
	echo "<tr bgcolor=".$fondos[3].">";
	while($fila=mysql_fetch_object($ssql)) {

	// validaciones adicional
	$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
	$sql.=" idusuario=".$fila->id;
	$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
	mysql_free_result($ssqlx);



		while($fila=mysql_fetch_object($ssql)) {
		// validaciones adicional
		$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
		$sql.=" idusuario=".$fila->id;
		$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
		mysql_free_result($ssqlx);

			break;
			}


				while($fila=mysql_fetch_object($ssql)) {
		// validaciones adicional
		$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
		$sql.=" idusuario=".$fila->id;
		$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
		mysql_free_result($ssqlx);

			break;
			}

				while($fila=mysql_fetch_object($ssql)) {
		// validaciones adicional
		$sql="select idm from tblgrupomenxusuario where idgrupo=$idgrupo and ";
		$sql.=" idusuario=".$fila->id;
		$ssqlx=mysql_db_query($dbase,$sql,$db);
	if (mysql_affected_rows()>0) {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id." checked>".$fila->dsnombre."</td>";
	} else {
echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idusuariox[] value=".$fila->id.">".$fila->dsnombre."</td>";
	}
		mysql_free_result($ssqlx);

			break;
			}

			echo "</tr>";
		}

	 }
	 echo "</table>";

mysql_free_result($ssql);
}



// lista de grupos para enviar mensaje
function checklistagrupousuario($idusuario){
global $dbase,$db,$fondos;
$sql="select a.* from ";
$sql.=" tblgrupos_usuarios a ";
$sql.=" where a.dsg<>'' and ";
$sql.=" a.idusuario=".$idusuario;
// echo $sql;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
echo "<table class='text1' border=0 cellspacing='1' cellpadding='2' bgcolor=".$fondos[12].">";
 	echo "<tr bgcolor=".$fondos[3].">";
	while($fila=mysql_fetch_object($ssql)) {
		echo "<td bgcolor=".$fondos[3]."><input type=checkbox name=idgrupox[] value=".$fila->idg.">".$fila->dsg."</td>";
		while($fila=mysql_fetch_object($ssql)) {
			echo "<td bgcolor=".$fondos[3].">";
			echo "<input type=checkbox name=idgrupox[] value=".$fila->idg.">".$fila->dsg;
			echo "</td>";
			break;
			}
			echo "</tr>";
		}
	 echo "</table>";
	 }


mysql_free_result($ssql);
}




// funcion que lista los items tipo=5
function checkitemsprod($tipo,$dsitems){
global $dbase;
global $db;
$sql="select * from tbltemas where idempresa=".$_SESSION['i_idempresa'];
$sql.=" and idactivo in ($tipo) order by dst asc ";
$vermas=mysql_db_query($dbase,$sql,$db);
if (mysql_affected_rows()>0){
			$t=0;
			while($fila=mysql_fetch_object($vermas)) {
				echo "<strong>".$fila->dst."</strong><br>";
				$sql=" select * from tblsubtemas where idtema=".$fila->idt;
				$sql.=" and idactivo in ($tipo) order by dst asc ";
				$vermas1=mysql_db_query($dbase,$sql,$db);
				if (mysql_affected_rows()>0){
					while($fila1=mysql_fetch_object($vermas1)){
					// validar si esta dentro de los items
					if ($dsitems<>"") {
						$partir=explode(",",$dsitems);
						$contar=count($partir);
						for ($j=0;$j<$contar;$j++){
							if ($fila1->idst==$partir[$j]) {
								$check="checked";
								break;
							} else {
								$check="";
							}
						}
					}
	echo "&nbsp;<input name='dsitemsx[]' type=checkbox value='".$fila1->idst."' class=text1 $check>".$fila1->dst."<br>";
					}
				}
				mysql_free_result($vermas1);

			}
		mysql_free_result($vermas);
	return 1;
} else {
 return 0;
}


}


// funcion que me valida el tipo de campo seguridad
function accesomodulo($modulo,$campo,$idusuario){
global $dbase,$db;
$sql="Select a.$campo as base ";
$sql.=" from tblmseguridad a, tblmodulos b where  ";
$sql.=" b.idactivo=1 ";
$sql.=" and a.idm=b.idmodulo ";
$sql.=" and b.dsm='$modulo' ";
$sql.=" and a.idu=$idusuario";

$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_num_rows($ssql);
	if ($resultado==1){
		$base=mysql_result($ssql,"0","base");
	} else {
		$base=0;
	}
//
	return $base;
}

// validar productos - recetados - recomendados - muestra
function validarproductos($idmedico,$tipo,$tabla){
global $dbase;
// contruccion
$strSQL="select a.id ";
$strSQL.=" from ".$tabla." a, tblproductos b, tblproductopres c";
$strSQL.=" where a.idpres=c.idpres and b.idproducto=c.idproducto ";
$strSQL.=" and a.idmedico=".$idmedico;
$strSQL.=" and a.idtipo=".$tipo;
//echo $sql;
global $db;
$ssql=mysql_db_query($dbase,$strSQL,$db);
$resultado=@mysql_result($ssql,"0","id");
if ($resultado==""){
	$val=2;
} else {
	$val=1;
}
	return $val;

}

// esta funcion valida si un usuario tiene o no permisos
// sobre modulos
function validarmodusuario($idusuario,$tipo,$tabla){
global $dbase,$idperfilxy;
// contruccion
$strSQL="select a.idms  as id";
$strSQL.=" from ".$tabla." a ";
$strSQL.=" where a.idu=".$idusuario;
$strSQL.=" and a.ida=1";
$strSQL.=" limit 0,1 ";
//echo $strSQL;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$strSQL,$db);
$resultado=@mysql_result($ssql,"0","id");
if ($resultado==""){
	$val=2; // no
} else {
	$val=1; // si
}
if ($idperfilxy==0) $val=1; // lo deja entrar porque es administrador y aplica todos los modulos
	return $val;

}

function totalesglobales($idempresa,$tabla,$tipo){
global $dbase,$db;

// contruccion
if ($tipo==1){
$strSQL="select count(*)  as id";
$strSQL.=" from ".$tabla;
}
if ($idempresa<>"0"){
	$strSQL.=" and a.idempresa=".$idempresa;
}
//echo $strSQL;
//exit();
$ssql=mysql_db_query($dbase,$strSQL,$db);
$resultado=@mysql_result($ssql,"0","id");
if ($resultado==""){
	$val=0; // no
} else {
	$val=$resultado; // si
}
	return $val;

}

// funcion que totaliza el pedido
function totalpedido($idusuario,$dspedido){
global $dbase,$db;

// contruccion
$strSQL="select idcant,idvalor,iddesc ";
$strSQL.=" from tblpedidosc ";
$strSQL.=" where dspedido=".$idusuario.$dspedido;
//echo $strSQL;
//exit();
$ssql=mysql_db_query($dbase,$strSQL,$db);
$resultado=mysql_num_rows($ssql);
if ($resultado>0){
	$totalvalor=0;
	while($fila2=mysql_fetch_object($ssql)) {
		$valor=($fila2->idcant*$fila2->idvalor) - ($fila2->idcant*$fila2->idvalor*($fila->iddesc/100));
		$totalvalor=$totalvalor+$valor;
	}
	$val=$totalvalor;
} else {
	$val=0;

}
mysql_free_result($ssql);
	return $val;

}





// subir pero banners
function subirimagenes($upload_dir, $upload_url,$img2,$img3,$img4,$img5) {
		$temp_name = $_FILES['userfile']['tmp_name'];
		$file_name = $_FILES['userfile']['name'];
		$file_type = $_FILES['userfile']['type'];
		$file_size = $_FILES['userfile']['size'];
		$result    = $_FILES['userfile']['error'];
		$file_url  = $upload_url.$file_name;
		$file_path = $upload_dir.$file_name;
		//Nombre
		if ( $file_name =="") {
			$message = $img2;
			return $message;
		}
		//Tamaño
		else if ( $file_size > 100000) {
			$message = $img3;
			return $message;
		}
		//Tipo
		else if ( $file_type == "text/plain" ) {
			$message = $img4 ;
			return $message;
		}
		$result  =  move_uploaded_file($temp_name, $file_path);
		$message = $img5." ".$file_name;
		return $message;
}
// Envio de correo de soporte en formato HTML
function soportecorreo($asunto,$problemapred,$problemanopred,$correocliente,$add,$respuesta){
global $soporte,$AppNombre,$direccionAPP;
// encabezados
	$headers = "From: ".$soporte."\n";
	$headers .= "Organization: ComprandoFacil\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "Content-Transfer-Encoding: 8bit\n";
// fin encabezados
$cuerpo="<table width=100% border=0>";
$cuerpo.="<tr><td>";
$cuerpo.="<font face='arial' size=-1>";
$cuerpo.="Fecha ingreso: ".date("Y-M-D h:m:s")."<br>";
$cuerpo.=$problemapred."<br>";
$cuerpo.=$problemanopred."<br>";
$cuerpo.=$add."<br>";
$cuerpo.=$respuesta."<br>";
$cuerpo.="----------------------------<br>";
$cuerpo.= " ".$AppNombre."  - On line ". date("Y")  ." todos los derechos reservados<br>";
$cuerpo.="Powered by ".$direccionAPP."<br>";
$cuerpo.="</font>";
$cuerpo.="</td></tr></table>";
// echo $cuerpo;
@mail($soporte,stripslashes($asunto),stripslashes($cuerpo), $headers);
// cheuqeo de correo antes de enviar
	if (!eregi("^[^@[:space:]]+@([[:alnum:]\-]+\.)+[[:alnum:]][[:alnum:]][[:alnum:]]?$", $correocliente)) {
		@mail($correocliente,stripslashes($asunto),stripslashes($cuerpo), $headers);
	}
}

// funcion  de formateo de fecha
// forma AAAA/MM/DD
function formatfecha($fecha){
	$partir=explode("/",$fecha);
	$anio=$partir[0];
	$mes=$partir[1];
	$dia=$partir[2];
	// impresion dia de mes de año
	return $dia." de ". nombre_mes(intval($mes))." de ". $anio;
}
function dataciclo($idciclo,$dia,$tabla1,$idusuario,$opt){
global $dbase,$db;
// contruccion
$strSQL="select a.id ";
$strSQL.=" from ".$tabla1." a";
$strSQL.=" where a.idciclo=".$idciclo;
$strSQL.=" and a.iddia=".$dia;
$strSQL.=" and a.idusuario=".$idusuario;
$strSQL.=" and a.idcanal=".$opt;
$strSQL.=" limit 0,1";
// echo $strSQL;
// exit();

$ssql=mysql_db_query($dbase,$strSQL,$db);
$resultado=@mysql_result($ssql,"0","id");
if ($resultado==""){
	$val=2; // no data
} else {
	$val=1; // data
}
	return $val;


}

// combo de tipo de cliente
function combostipocliente($id,$idempresa){
global $dbase;
$sql="Select idtc as id,dstc as nombre from tbltipoclientes where idactivo=1 and idempresa=$idempresa order by dstc ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."	</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}

// combo de tipo de cliente
function combosorigencliente($id,$idempresa){
global $dbase;
$sql="Select idoc as id,dsoc as nombre from tblorigenclientes where idactivo=1 and idempresa=$idempresa order by dsoc ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."	</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// combo tipo de cuenta
function combostipocuenta($id,$idempresa){
global $dbase;
$sql="Select idt as id,dst as nombre from tbltipocuentas where idactivo=1 and idempresa=$idempresa order by dst ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."	</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// validar modulo
function validarmodulo($idusuario,$dsm){
global $dbase,$db;
// contruccion
$sql="select a.ida from ";
$sql.="tblmseguridad a,tblmodulos b ";
$sql.=" where a.idu=".$idusuario;
$sql.=" and a.idm=b.idmodulo";
$sql.=" and b.dsm='".$dsm."'";
$ssql=mysql_db_query($dbase,$sql,$db);
if (mysql_affected_rows()>0){
	$ida=mysql_result($ssql,"0","ida");
	if ($ida==1) {
		$val=1;
	} else {
		$val=2;
	}
} else {
	$val=2;
}
mysql_free_result($ssql);
return $val;

}
// determinar el perfil del cual un usuario depende
function perfil($idusuario){
global $dbase,$db;
// contruccion
if ($idusuario=="N/A") $idusuario=0;
$sql="select a.idtipo from ";
$sql.="tblusuariose a";
$sql.=" where a.id=".$idusuario;
$ssql=mysql_db_query($dbase,$sql,$db);
if (mysql_affected_rows()>0){
	$idp=mysql_result($ssql,"0","idtipo");
} else {
	$idp=0;
}
mysql_free_result($ssql);
return $idp;
}

// referencias
function combosreferencias($id,$idempresa){
global $dbase;
$sql="Select idtp as id,dstp as nombre";
$sql.=" from tbltipocodigos where idactivo in (1,3)";
$sql.=" and idempresa=$idempresa order by dstp ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
	}
	return 1;
} else {
 return 0;
}
}


function combosagencias($idagencia,$idcliente){
global $dbase;
$sql="Select id,strnombre as nombre ";
$sql.=" from tblagencias where idcliente=$idcliente";
$sql.=" order by strnombre ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->nombre." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->nombre.">".$fila->nombre."</option>";
		}
	}
} else {
	echo "<option value=''>NA</option>";
}
}


function combosclientesreferencias($id,$idempresa){
global $dbase;
$sql="Select dsnombre as nombre ";
$sql.=" from tblreferencias where dsnombre<>'' group by dsnombre order by dsnombre ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->nombre){
			echo "<option value=".$fila->nombre." selected>".$fila->nombre."</option>";
		} else{
			echo "<option value=".$fila->nombre.">".$fila->nombre."</option>";
		}
	}
	return 1;
} else {
 return 0;
}
}

// combo de programas
function combosprogramas($id){
global $dbase,$pauta;
$sql="Select a.idp as id,a.dstit as nombre ";
$sql.=" from tblprogramas a where  ";
if ($pauta<>"") {
	$sql.=" a.idactivo=$pauta";
} else {
	$sql.=" a.idactivo in (1,3,4)";
}
$sql.=" order by dstit ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}


// calcula el total de clientes
function totalclientes_sistema($idusuario,$idperfil){
global $dbase;
// contruccion
$sql="select count(*) as total ";
$sql.=" from tblclientes ";
if ($idperfil<>0 && $idperfil<>-1)  $sql.=" where idusuario=".$idusuario;
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
$resultado=@mysql_result($ssql,"0","total");
if ($resultado==""){
	return 0;
} else {
	return $resultado;
}

}


// listado de contacto
function comboscontactos($id,$idcliente){
global $dbase;
$sql="Select a.id,a.dsnombre as nombre,a.dscargo ";
$sql.=" from tblcontactos_cliente a where  ";
$sql.=" a.id>0 and a.idcliente=$idcliente";
$sql.=" order by a.dsnombre ASC";
//echo $sql;
//exit();
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
function formateo($param){
	if ($param<>"") {
		$valor=number_format($param,0);
	} else {
		$valor=0;
	}
	return "$&nbsp;".$valor;

}

// despachadores
function combosdespachos($id,$idempresa){
global $dbase;
$sql="Select id,a.dsm as nombre ";
$sql.=" from tblcurrier a where  ";
$sql.=" a.idactivo=1 and idempresa=$idempresa order by dsm ASC";
global $db;
$ssql=mysql_db_query($dbase,$sql,$db);
 if(mysql_affected_rows()>0){
	while($fila=mysql_fetch_object($ssql)) {
		if ($id==$fila->id){
			echo "<option value=".$fila->id." selected>".$fila->nombre." </option>";
		} else{
			echo "<option value=".$fila->id.">".$fila->nombre."</option>";
		}
		}
	return 1;
} else {
 return 0;
}

}
function validar_core($usuario,$id){
global $db;
// contruccion
$sql="select count(*) ";
$sql.=" from tblmodulos b  ";
$sql.=" where b.id='$id' and b.idactivo not in (2) ";
//echo $sql;
$resultado=0;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
$resultado=$resultx->fields[0];
	return $resultado;
}
$resultx->Close();
}

function seldato($campopedido,$campobase,$tabla,$valor,$tipo){
global $db;
if ($tipo==1){
	// numerico
	$sep="";
	$sep1="";
} else {
	// alfanumerico
	$sep="'";
	$sep1="'";
}
// contruccion
$sql="select $campopedido ";
$sql.=" from $tabla ";
$sql.=" where $campobase=$sep$valor$sep1 ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
$resultado=$resultx->fields[0];
/*if ($resultado==""){
	return "";
} else {
	return $resultado;
}	*/
	return $resultado;
}
$resultx->Close();
}

/// FIN FUNCIONES
//////////////////////////////////////////////////////////////////////////
?>