<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

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
//$db->debug=true;
// actualizar
$contarx=count($_REQUEST['id_']);
		$h=0;
if ($contarx>0) {
$dsmform=seldato("dstabla","id","framecf_tbltiposformularios",104,2);

			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){

								$sql=" update $dsmform set ";
								$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
								$sql.= ",estado_propiedad='".$_REQUEST['estado_propiedad_'][$j]."'";
								$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql."<br>";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];
}

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

$sql="SELECT id,dstabla FROM   framecf_tbltiposformularios WHERE id='".$_REQUEST['idxx']."' ";
//echo $sql;

$result=$db->execute($sql);
$nombrecampos="Codigo,";
//$campos="idconsecutivo,";
if(!$result->EOF){
	$id=$_REQUEST['idx'];
	$destino=$result->fields[0];
	$dsmform=$result->fields[1];

	$sqlx=" SELECT a.iddestino,a.iddestino FROM  tbltiposreportesxcampos a  WHERE a.idorigen=$id ";
	$resultx=$db->execute($sqlx);
		if(!$resultx->EOF){
			while(!$resultx->EOF){
			$destino=$resultx->fields[0];
			$dscampo=$resultx->fields[0];

				$sqlxx=" SELECT dscampo,dsm FROM framecf_tbltiposformulariosxcampo WHERE id='$destino' ";
				//echo $sqlxx."<br>";
				$resultxx=$db->execute($sqlxx);

					if(!$resultxx->EOF){
						while(!$resultxx->EOF){
							 $campos.=$resultxx->fields[0].",";
							 $nombrecampos.=$resultxx->fields[1].",";
							$nombrecamposx.=$resultxx->fields[1]."|";
							$camposx.=$resultxx->fields[0]."|";

							$resultxx->MoveNext();
						}

					}
					$resultxx->Close();

			    //$campos.=seldato("dscampo","id","framecf_tbltiposformulariosxcampo",$destino."	",1).",";
				//$nombrecampos.=seldato("dsm","id","framecf_tbltiposformulariosxcampo",$destino,1).",";

				$resultx->MoveNext();
			}

		}
		$resultx->Close();

}
$result->close();

//////////////////////////////////////////////////////////////////////////////////////////



$campos=trim($campos,',');
$cantidad = explode(",", $campos);
 $cantidad= count($cantidad);
  $cantidad= $cantidad+2;
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.idactivo,a.estado_propiedad,a.idusuario,a.id,";
if($idxx==104) {$sql.="a.idconsecutivo";}else{ $sql.="a.id"; }
if($dscampo<>"")$sql.=",".$campos;



$sql.=",a.dsfecha,a.dsfecha_mod from $dsmform a";

if ($_REQUEST['campo']=="idusuario") $sql.=" inner join tblusuarios b";
$sql.="  where  a.id>0";

if ($_REQUEST['campo']=="idusuario") $sql.=" and a.idusuario=b.id";
if ($_SESSION['i_idactivo']<>"1" && $_SESSION['i_idrol_admon']<>1) $sql.=" and a.idusuario=".$_SESSION['i_idusuario'];

//if( $_SESSION['i_idperfil']==4)$sql.="  and a.idusuario=b.idorigen and b.idorigen='".$_SESSION['i_idusuario']."' and b.iddestino='$idxx' ";
//echo "<br>";
//echo $_REQUEST['campo'];
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"" && $_REQUEST['campo']<>"idusuario" && $_REQUEST['campo']<>"consecutivo" && $_REQUEST['campo']<>"clasgratis" && $_REQUEST['param']<>"-1" && $_REQUEST['campo']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['idactivox']<>"") $sql.=" and a.idactivo='".$_REQUEST['idactivox']."%'";

if ($_REQUEST['clasgratisx']<>"") $sql.=" and a.clasgratis='".$_REQUEST['clasgratisx']."%'";

if ($_REQUEST['campo']=="idusuario") $sql.=" and b.dsm like '".$_REQUEST['param']."%'";

if ($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="si" || $_REQUEST['param']=="SI")) $sql.=" and a.clasgratis=1";
if ($_REQUEST['campo']=="clasgratis" && ($_REQUEST['param']=="no" || $_REQUEST['param']=="NO")) $sql.=" and a.clasgratis=2";

if ($_REQUEST['tipoprop']<>"") $sql.=" and a.idagrupamiento=".$_REQUEST['tipoprop'];
if ($_REQUEST['dispo']<>"") $sql.=" and a.disponibilidad=".$_REQUEST['dispo'];


if ($_REQUEST['campo']=="consecutivo" && $_REQUEST['param']<>""){
	$idpropiedad=(int) $_REQUEST['param'];
	$sql.=" and a.idconsecutivo='".$idpropiedad."'";
}
$sql.=" and a.idactivo not in (9) ";

if(($_SESSION['i_idperfil']<>1 && $_SESSION['i_idrol_admon']<>1 ) && $_REQUEST['listartodos']<>"1" && $_REQUEST['campo']=="" && $_REQUEST['param']=="") $sql.=" and a.idusuario='".$_SESSION['i_idusuario']."' ";
if ($_REQUEST['campo']=="consecutivo" && $_REQUEST['param']<>""){
	$sql.="order by a.idconsecutivo asc ";  
} else { 
$sql.=" order by a.id desc  ";
}

//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		//$campoletra="dscampo27";
$camposx=trim($camposx,'|');
$nombrecamposx=trim($nombrecamposx,'|');
$separador="|";
	$ocultar=1;
	$listar=0;
		$paramb="$camposx";
		if ($idxx==104) $paramb.="|idusuario|consecutivo|idactivo";
	//echo "<br><br><br>";
	$paramn="$nombrecamposx";
	if ($idxx==104)$paramn.="|Usuario|Codigo propiedad|Estado";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&idactivox=".$_REQUEST['idactivox']."&clasgratisx=".$_REQUEST['clasgratisx']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&dispo=".$_REQUEST['dispo']."&tipoprop=".$_REQUEST['tipoprop'];
	$rutaPaginacion.="&idx=".$_REQUEST['idx']."&r=".$_REQUEST['r'];
	$rutaPaginacion.="&reporte=".$_REQUEST['reporte']."&idxx=".$_REQUEST['idxx'];

	$rutamodulo="<a href='$rutxx../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../reportes/default.php' class='textlink' title='Listado de reportes'> Listado de reportes del CRM </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$parametros="?parametros=".$idxx."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
	if($_SESSION['i_idperfil']==1)$exportar=0; $importar=2;// permite exportar la tabla


	include("reportes.estadopropiedad.tabla.php");


include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>