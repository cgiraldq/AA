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

$idxx=$_REQUEST['idxx'];
$titulomodulo="Reporte de ".$_REQUEST['reporte'];
$letra=$_REQUEST['letra'];
$idgaleria=$_REQUEST['idgaleria'];
$tabla=$prefix."tblregistro_formularios";
$tablax=$prefix."tbltiposformulariosxcampo";
// eliminacion
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
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

					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",clasgratis='".$_REQUEST['clasgratis_'][$j]."'";
					if( $_SESSION['i_idperfil']==1)$sql.= ",idusuario='".$_REQUEST['idusuario_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];




?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


//--- Trae  Nombre  de los campos y Los prefijos de los campo de la  base de  datos ---//
$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where id>0 and idtipoformulario=$idxx ";
$sqlx.="and idactivo not in (2,9) and idpublicar=1 order by idpos";
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
$sql="select a.idactivo,a.clasgratis,a.idusuario,a.id,a.idformulario,a.id";
if($dscampo<>"")$sql.=",".$campos;
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";
$sql.=",a.dsfecha,a.dsfecha_mod from $tabla a";

//if( $_SESSION['i_idperfil']==4) $sql.=" ,tblusuarioxtblformularios b";
if ($_REQUEST['campo']=="idusuario") $sql.=" inner join tblusuarios b";
$sql.="  where  a.idformulario='$idxx'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and a.idusuario=b.id";

//if( $_SESSION['i_idperfil']==4)$sql.="  and a.idusuario=b.idorigen and b.idorigen='".$_SESSION['i_idusuario']."' and b.iddestino='$idxx' ";
//echo "<br>";
//echo $_REQUEST['campo'];
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"" && $_REQUEST['campo']<>"idusuario"  && $_REQUEST['campo']<>"clasgratis" && $_REQUEST['campo']<>"idactivo") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idactivox']<>"") $sql.=" and a.idactivo='".$_REQUEST['idactivox']."%'";
if ($_REQUEST['clasgratisx']<>"") $sql.=" and a.clasgratis='".$_REQUEST['clasgratisx']."%'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and b.dsm like '".$_REQUEST['param']."%'";
if($_REQUEST['idarrendador']<>"") $sql.=" and a.idarrendatario='".$_REQUEST['idarrendador']."' ";
if($_REQUEST['propietario']<>"") $sql.=" and a.idpropietario='".$_REQUEST['propietario']."' ";

if($_REQUEST['tipocliente']<>"") $sql.=" and a.tipocliente='".$_REQUEST['tipocliente']."' ";

if($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="si" || $_REQUEST['param']=="Si") ) $sql.=" and a.clasgratis='1' ";
if($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="no" || $_REQUEST['param']=="NO") ) $sql.=" and a.clasgratis='2' ";

if($_REQUEST['campo']=="idactivo" && ($_REQUEST['param']=="si" || $_REQUEST['param']=="SI") ) $sql.=" and a.idactivo='1' ";
if($_REQUEST['campo']=="idactivo" && ($_REQUEST['param']=="no" || $_REQUEST['param']=="NO") ) $sql.=" and a.idactivo='2' ";

$sql.=" order by a.id desc  ";
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		//$campoletra="dscampo27";

$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where idtipoformulario=$idxx ";
$sqlx.="and idactivo=1 order by dsm asc";
//echo $sqlx;
$result_buscador=$db->Execute($sqlx);
if (!$result_buscador->EOF) {
	while(!$result_buscador->EOF){

		$dsmx=$result_buscador->fields[1];
		$dscampox=$result_buscador->fields[2];

		$nombrecamposx.=$dsmx."|";
		$camposx.=$dscampox."|";
  $result_buscador->MoveNext();
		 		 }
	} // fin si
$result_buscador->Close();
		// 2. los tipo de busqueda
$camposx=trim($camposx,'|');
$nombrecamposx=trim($nombrecamposx,'|');
$separador="|";
	$ocultar=1;
	$listar=1;
		$paramb="$camposx|idusuario|clasgratis|idactivo";
	//echo "<br><br><br>";
	$paramn="$nombrecamposx|Usuario|Clasificado gratis|Estado";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&idactivox=".$_REQUEST['idactivox']."&clasgratisx=".$_REQUEST['clasgratisx']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];

	$rutamodulo="<a href='$rutxx../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../reportes/default.php' class='textlink' title='Listado de reportes del CRM'> Listado de reportes del CRM </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$parametros="?parametros=".$idxx."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
	if($_SESSION['i_idperfil']==1)$exportar=1; $importar=2;// permite exportar la tabla


	include("reporte.propiedades.tabla.php");


include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>



</body>
</html>