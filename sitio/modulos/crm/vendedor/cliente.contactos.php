<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
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
 Traer los datos de retenciones y descuento del cliente
 
*/
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
$idclientex=explode("|",$_REQUEST['idclientex']);
	if($idclientex[0]==0){
		$campo="idcliente";
		$valor=$idclientex[1];
	}
	else {
		$campo="idsucursal";
		$valor=$idclientex[0];
	}
	$sqlx="select id,dscontacto,dsdepartamento from tblclientescontacto where $campo=".$valor;
	$contacto='	<select name="dscontacto" class="textnegro2"><option value="">Seleccione..</option>';	
	
	$verx=mysql_db_query($dbase,$sqlx,$db);
	if(mysql_num_rows($verx)>0){
  		
	  	while($fila=mysql_fetch_object($verx)){
	  		$contacto.=	'<option value="'.$fila->id.'">'.reemplazar($fila->dscontacto).'</option>';
	  	}
  		
	}$contacto.='</select>';
	$data=$contacto;

echo $data;
include ("../../incluidos/cerrarconexion.php");
?>

