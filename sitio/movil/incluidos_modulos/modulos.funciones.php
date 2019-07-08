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
// funciones genericas
function total_modulos($tabla){
global $db;
$sql="select count(*) as t from $tabla ";
$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 	$resultado=$resultx->fields[0];
	 } else {
	 	$resultado="--";
	 }
	 $resultx->Close();
	 return $resultado;
}
//funcion de las categorias
function categorias($tabla,$id) {
	global $db;
	$sql="select id,dsm from $tabla where idactivo not in (2) order by idpos asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}
function modulos($tabla,$id) {
	global $db;
	$sql="select id,dsm from $tabla where 1 order by idpos asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function lista_proveedores($tabla,$id) {
	global $db;
	$sql="select id,dsm from $tabla where idactivo not in (2) order by dsm asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}


function categorias_validar($tabla,$id,$valida) {
	global $db;
	$sql="select id,dsm from $tabla where idactivo not in (2) $valida order by idpos asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function categoriascampo($tabla,$id,$campo) {
	global $db;
	$sql="select id,dsm,dsapellido from $tabla where idactivo not in (2) order by dsm ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			$dsapellido=$resultx->fields[2];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm." ".$dsapellido."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function listar_categorias($tabla,$id) {
	global $db,$idtipo,$soloactivas;
	$sql="select id,dsm from tblcategoria where 1";
	if ($soloactivas==1) $sql.=" and idactivo not in (2)";
	if ($idtipo<>"") $sql.=" and idtipo=$idtipo ";

	$sql.=" order by id asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function listar_subcategoria($tabla,$id) {
	global $db;
	$sql="select id,dsm from tblsubcategoria order by id asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function listar_marcas($tabla,$id) {
	global $db;
	$sql="select id,dsm from tblmarcas order by id asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
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


function generarPagina($dsarchivo,$carpeta,$dsm,$idreg,$include){
	$rutaGeneral="../../../contenidos/";
	$rutaCopiar=$rutaGeneral.$carpeta."/";
	//exit();
	if (is_file($rutaCopiar.$dsarchivo)) unlink($rutaCopiar.$dsarchivo);
	$dsruta=$carpeta."/".$dsarchivo;
	$gestor=fopen($rutaCopiar.$dsarchivo,"w+");
	$cuerpo="<?";
	$cuerpo.=" $";
	if($idreg<>"")$cuerpo.="idc=".$idreg.";";//validar por idcategoria en ideas
	$cuerpo.=" $";
	$cuerpo.="dsmc='".$dsm."';";
	$cuerpo.=" $";
	$cuerpo.="rutap=1;";
	$cuerpo.="$include;";
	$cuerpo.="?>";
	fwrite($gestor,$cuerpo);// crear
	fclose($gestor);
	return $dsruta;
}
// formateo de imagenes
function makeimage($rutaBase,$archivo,$nuevoarchivo,$rutaarchivo,$ancho,$alto,$mensaje,$calidad) {
	if ($calidad==""){ $calidad=60;}
	// exntesion
	$image_type = strtolower(strstr($archivo, '.'));
	// DEPENDIENDO DEL TIPO DE IMAGEN
		switch($image_type) {
			case '.jpg':
				$source = imagecreatefromjpeg($rutaBase.$archivo);
				break;
			case '.jpeg':
				$source = imagecreatefromjpeg($rutaBase.$archivo);
				break;
			case '.png':
				$source = imagecreatefrompng($rutaBase.$archivo);
				break;
			case '.gif':
				$source = imagecreatefromgif($rutaBase.$archivo);
				break;
			default:
				echo($mensaje);
				die;
				break;
			}

	$fullpath = $rutaarchivo.$nuevoarchivo;
	list($width, $height) = getimagesize($rutaBase.$archivo);
	// con el ancho de las imagenes se cargan de nuevo los anchos
	// y altos
	//$ancho1=$width/$ancho;
	//$alto1=$height/$alto;
	$ancho1=$ancho;
	$alto1=$alto;


	$thumb = imagecreatetruecolor($ancho1, $alto1);
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $ancho1, $alto1, $width, $height);
	imagejpeg($thumb, $fullpath, $calidad);
	$filepath = $fullpath;
	return $nuevoarchivo;
}
function ver_estado($idestado){
	global $estado;
	$texto=formateo_texto($estado[$idestado]);
	return $texto;

}
function combo_estados($idestado,$idpedido,$id,$idclientepago){
	global $estado,$idtienda;
	$rutax="tracking.php";
	for ($i=0;$i<count($estado);$i++){
		$sel="";
		if ($idestado==$i) $sel=" selected ";
		echo "<option $sel value='".$rutax."?idpedido=".$idpedido."&id=".$id."&idclientepago=".$idclientepago."&idestado=".$i."&dsestado=".formateo_texto($estado[$i])."&idtienda=".$idtienda."'>".formateo_texto($estado[$i])."</option>";
	}
}

function combo_estados_select($idestado){
	global $estado;
	for ($i=0;$i<count($estado);$i++){
		$sel="";
		//if ($idestado==$i) $sel=" selected ";
		echo "<option $sel value='".$i."'>".formateo_texto($estado[$i])."</option>";
	}
}

function combo_estados_botones(){
	global $estado,$pagina,$idtiendax;

	for ($i=0;$i<count($estado);$i++){
		echo "<input type=button value='".formateo_texto($estado[$i])."' class='text1' onclick=irAPaginaD('".$pagina."?idestado=".$i."&idtiendax=".$idtiendax."')>";
	}
}


function formateo_texto($param) {
	global $dsorigen,$dsdestino,$dsdiasorigen,$dsdiasdestino,$quitar;
	$textov=$param;
	if ($quitar=="") {
	$textov=preg_replace("/-origen-/",$dsorigen,$textov);
	$textov=preg_replace("/-destino-/",$dsdestino,$textov);
	}
	$textov=preg_replace("/-diasorigen-/",$dsdiasorigen,$textov);
	$textov=preg_replace("/-diasdestino-/",$dsdiasdestino,$textov);
	if ($quitar==1) {
		$textov=str_replace("<font color=red>","",$textov);
		$textov=str_replace("</font>","",$textov);


	}

	return $textov;
}
function combo_bodegas($dsbodega){
	global $bodega;
	for ($i=0;$i<count($bodega);$i++){
		$sel="";
		if ($dsbodega==$bodega[$i]) $sel=" selected ";
		echo "<option ".$sel." value='".$bodega[$i]."'>".$bodega[$i]."</option>";
	}
}
function lista_tiendas($tabla,$id) {
	global $db;
	$sql="select id,dsnombre from $tabla where id>0  order by dsnombre asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'";
			if ($id==$idm) echo "selected";
			echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function lista_categorias() {
	global $db;
	$sql="select a.id,a.dsm from tblservicios a where id>0  order by dsm asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'"; if ($idm==$cat) echo "selected"; echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function lista_experiancias() {
	global $db;
	$sql="select a.id,a.dsm from tblexperiencia a where id>0  order by dsm asc ";

$resultx = $db->Execute($sql);
	 if (!$resultx->EOF) {
	 //echo "<option value='0'>--</option>";
		while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'"; if ($idm==$cat) echo "selected"; echo ">".$dsm."</option>";
			$resultx->MoveNext();
		} // fin while
	 }
	 $resultx->Close();
}

function permitir($value){
                $valido=0; // siempre permit
                global $autorizado;
                $CadenasProhibidas = array("phtml","php3","php","pl","py","jsp","asp","htm","shtml","sh","cgi","dat","phtml","php3","php","pl","py","jsp","asp","htm","shtml","sh","cgi","dat");

                                foreach($CadenasProhibidas as $valor){
                                                if(strpos(strtolower($value), strtolower($valor)) !== false){
                                                                $valido=1;// no ptermite
                                                }
                                }

			    return $valido;




}
function contarx($tabla,$tablab,$id){
global $db;
// contruccion
$sql_count="select count(*) from $tabla a";
$sql_count.=", $tablab b ";
$sql_count.=" where a.idorigen=b.id and a.iddestino='$id' ";
$sql_count.="  and (".date('Ymd')." between b.idfechainicial and b.idfechafinal) ";
$sql_count.=" and b.idactivo not in (2,9)";
//echo $sql_count;
$result_count=$db->Execute($sql_count);
if(!$result_count->EOF){
$contar=$result_count->fields[0];
}
return $contar;
}

?>