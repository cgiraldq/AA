<?
/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Validacion de datos al ingresar y manejo de perfiles
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/modulos.funciones.php");
$dscodigo=$_REQUEST['dscodigo'];
//$db->debug=true;
		$sql="select a.dsdescuento,a.dsdescuentov,a.iddistribuidor,a.dscodigo,a.codigo,a.idfechaf,a.idfechai,b.dsm,b.dsimg,a.idactivo,a.idtipo";
	 	$sql.=" from ecommerce_tblcodigosprom a , ecommerce_tblpatrocinadores b WHERE a.codigo='$dscodigo'and  a.iddistribuidor=b.id";
	    $numcod=seldato('count(*)','codigo','ecommerce_tblcodigoxpedido',$dscodigo,2);


	    $result = $db->Execute($sql);
		if (!$result->EOF) {
		while (!$result->EOF) {
		$dsdescuento=$result->fields[0];
		$dsdescuentov=$result->fields[1];
		$iddistribuidor=$result->fields[2];
		$dscodigo=$result->fields[3];
		$codigo=$result->fields[4];
		$idfechaf=$result->fields[5];
		$idfechai=$result->fields[6];
		$dsm=$result->fields[7];
		$dsimg=$result->fields[8];
		$idactivo=$result->fields[9];
		$idtipo=$result->fields[10];
		if($idactivo==1 || $numcod>100){
		if ($fechaBaseNum>=$idfechai && $fechaBaseNum<=$idfechaf) {
			$_SESSION['i_acceso']="1";
			$_SESSION['i_dsdescuento']=$dsdescuento;
			} else {
			$_SESSION['i_acceso']="1";
			$_SESSION['i_dsdescuento']=$dsdescuentov;
			}

		$_SESSION['i_img']=$dsimg;
		$_SESSION['i_dscodigo']=$dscodigo;
		$_SESSION['i_codigo']=$codigo;
		$_SESSION['i_tipocodigo']=$idtipo;
		$_SESSION['i_dsproveedor']=$dsm;		
		$data="1";
		}else{
			
		$_SESSION['i_acceso']="0";
		$_SESSION['i_dsdescuento']="";
		$_SESSION['i_img']=""; 	
		$_SESSION['i_dsproveedor']="";
		$data="2";	

		}

		$result->MoveNext();
		}
		 }else{
		$_SESSION['i_acceso']="0";
		$_SESSION['i_dsdescuento']="";
		$_SESSION['i_img']=""; 	
		$_SESSION['i_dsproveedor']="";
		$data="0";
		}
		$result->close();



include("../../incluidos_modulos/cerrarconexion.php");


echo $data;