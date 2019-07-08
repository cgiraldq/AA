<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$dsmform=seldato("dstabla","id","framecf_tbltiposformularios",$_REQUEST['idxx'],2);
$idxx=$_REQUEST['idxx'];
$titulomodulo="Listado de registros ";
$letra=$_REQUEST['letra'];
$idgaleria=$_REQUEST['idgaleria'];
$tabla=$prefix."tblregistro_formulariosx";
$tablax=$prefix."tbltiposformulariosxcampo";
// eliminacion
if ($idx<>"") {
	
	$sql=" UPDATE $dsmform SET idactivo=9 WHERE id='$idx' ";
	//echo $sql;
	$dstitulo="Eliminacion $titulomodulo";
	$dsdesc=" El usuario ".$i_dsnombre." elimino registro de $titulomodulo numero $idx ";
	$dsruta="../formularios/default.php";
	$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,1);
}


//// actualizar rapido ////////////////
$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){

								$sql=" update $dsmform set ";
								$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
								$sql.= ",idclasgratis='".$_REQUEST['clasgratis_'][$j]."'";
if( $_SESSION['i_idperfil']==1)	$sql.= ",idusuario='".$_REQUEST['idusuario_'][$j]."'";
//if( $_SESSION['i_idperfil']==1)	$sql.= ",idarrendatario='".$_REQUEST['idarrendatario_'][$j]."'";
								$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];


// manejo de caracteristicas de los formularios que sean genericas a todos
$sqlimg="SELECT idresultados FROM  framecf_tbltiposformularios WHERE id='$idxx'  ";
$resultxy=$db->Execute($sqlimg);
	if(!$resultxy->EOF){
	$idresultados=$resultxy->fields[0];
}else{
	$idresultados=2;

}
$resultxy->Close();


// fin manejo de caracteristicas		

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


//--- Trae  Nombre  de los campos y Los prefijos de los campo de la  base de  datos ---//
$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where id>0 and idtipoformulario=$idxx ";
$sqlx.="and idactivo not in (2,9) and idpublicardetalle=1 ";
 if($idxx==104) $sqlx.=" and dscampo!='dscampo2'";
$sqlx.=" order by idpos";
//echo $sqlx;
$nombrecampos="Codigo,";
$result_campos=$db->PageExecute($sqlx,$maxregistros,$pagina_actual);
if (!$result_campos->EOF) {
	while(!$result_campos->EOF){
		$id=$result_campos->fields[0];
		$dsm=$result_campos->fields[1];
		$dscampo=$result_campos->fields[2];

		$nombrecampos.=$dsm.",";
		$campos.=$dscampo.",";

		$nombrecamposx.=$dsm."|";
		$camposx.=$dscampo."|";

  $result_campos->MoveNext();
		 		 }
	} // fin si
$result_campos->Close();

//*******  Fin nombre campos ******//

$campos=trim($campos,',');
$cantidad = explode(",", $campos);
 $cantidad= count($cantidad);
  $cantidad= $cantidad+2;
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.idactivo,a.idclasgratis,a.idusuario,a.id,";
if($idxx==104) {$sql.="a.consecutivo";}else{ $sql.="a.id"; }
if($dscampo<>"")$sql.=",".$campos;
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";

$sql.=",a.dsfecha,a.dsfecha_mod from $dsmform a";

//if( $_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
if ($_REQUEST['campo']=="idusuario") $sql.=" inner join tblusuarios b";
$sql.="  where  a.id>0";

if ($_REQUEST['campo']=="idusuario") $sql.=" and a.idusuario=b.id";
if ($_SESSION['i_idactivo']<>"1") $sql.=" and a.idusuario=".$_SESSION['i_idusuario'];

//if( $_SESSION['i_idperfil']==4)$sql.="  and a.idusuario=b.idorigen and b.idorigen='".$_SESSION['i_idusuario']."' and b.iddestino='$idxx' ";
//echo "<br>";
//echo $_REQUEST['campo'];
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"" && $_REQUEST['campo']<>"idusuario" && $_REQUEST['campo']<>"consecutivo" && $_REQUEST['campo']<>"clasgratis" && $_REQUEST['param']<>"-1") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idactivox']<>"") $sql.=" and a.idactivo='".$_REQUEST['idactivox']."%'";

if ($_REQUEST['clasgratisx']<>"") $sql.=" and a.clasgratis='".$_REQUEST['clasgratisx']."%'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and b.dsm like '".$_REQUEST['param']."%'";

if ($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="si" || $_REQUEST['param']=="SI")) $sql.=" and a.clasgratis=1";
if ($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="no" || $_REQUEST['param']=="NO")) $sql.=" and a.clasgratis=2";

if ($_REQUEST['tipoprop']<>"") $sql.=" and a.idagrupamiento=".$_REQUEST['tipoprop'];
if ($_REQUEST['dispo']<>"") $sql.=" and a.dscampo11 like '".$_REQUEST['dispo']."%'";

if ($_REQUEST['campo']=="consecutivo" && $_REQUEST['param']<>""){
	$idpropiedad=(int) $_REQUEST['param'];
	$sql.=" and a.consecutivo like '%".$idpropiedad."%'";
}
$sql.=" and a.idactivo not in (9) ";

if($_SESSION['i_idperfil']<>1 && $_REQUEST['listartodos']<>"1" && $_REQUEST['campo']=="" && $_REQUEST['param']=="") $sql.=" and a.idusuario='".$_SESSION['i_idusuario']."' ";
if ($_REQUEST['campo']=="consecutivo" && $_REQUEST['param']<>""){
	$sql.="order by a.consecutivo asc ";  
} else { 
$sql.=" order by a.id desc  ";
}
//$db->debug=true;
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		//$campoletra="dscampo27";



$separador="|";
	$ocultar=1;
	$listar=1;
	if($idxx==104){$paramb="consecutivo|idusuario|clasgratis|dscampo1|dscampo93|dscampo27|dscampo28|dscampo74";
	$paramn="Codigo propiedad|Usuario|Clasificados gratis|Direcci&oacute;n|Zonas|Barrios|Precio venta|Precio arriendo";
}else{

	$nombrecamposx=trim($nombrecamposx,'|');
	$camposx=trim($camposx,'|');
	$paramb=$camposx;
	$paramn=$nombrecamposx;
}


	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&idactivox=".$_REQUEST['idactivox']."&clasgratisx=".$_REQUEST['clasgratisx']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idxx=".$_REQUEST['idxx']."&r=".$_REQUEST['r'];

	$rutamodulo="<a href='$rutxx../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../formularios/listado.php?dstoken=$dstokenvalidador' class='textlink' title='Listado de usuarios registrados'> Listado de formularios </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$parametros="?parametros=".$idxx."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
	if($_SESSION['i_idperfil']==1)$exportar=1; $importar=2;// permite exportar la tabla
		include("registrosx.tabla.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>