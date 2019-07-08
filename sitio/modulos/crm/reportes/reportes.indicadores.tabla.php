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
// Tabla central de datos cuando se hacen los listados
if ($exportardatos<>1){
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
}
	//$tablax=$prefix."tbltiposformularios";
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


$border=0;
$ini=$_REQUEST['fechain'];
$fin=$_REQUEST['fechafi'];

if ($ini=="" && $fin=="") {
$mesi=date("m");
$anioi=date("Y");
$diai="01";
$diaf="31";
$idfechai=$anioi.$mesi.$diai;
$idfechaf=$anioi.$mesi.$diaf;
}  else {
	$partir=explode("/",$ini);
	$mesi=$partir[1];
	$anioi=$partir[0];
	$diai=$partir[2];
	$partirx=explode("/",$fin);
	$mesf=$partirx[1];
	$aniof=$partirx[0];
	$diaf=$partirx[2];
	$idfechai=$anioi.$mesi.$diai;
	$idfechaf=$aniof.$mesf.$diaf;

}


if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>

<? if ($exportardatos<>1){?>


<?}
// encabezado generico basado
//echo $sql;

//
if($_REQUEST['idxx']==1)$exportardatos=1;
$nombrecampos="Asesor,Mes A&ntilde;o,Total propiedades,Valor arriendo o valor venta,Numero de Propiedades arrendadas o vendidas, % cumplimiento ";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");

$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$idrol=$result->fields[2];
		?>

 		<tr bgcolor="<? echo $fondo?>"onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');">

 		<td  align="center"> <? echo $result->fields[1];?></td>
 		<td  align="center"> <? echo $mesi?> / <? echo $anioi?></td>
 		<td  align="center">
 		<?
 		// total propiedades
 		$totalp=0;
 		$sql="select count(*) as total from crm_propiedades where idusuario=".$result->fields[0];
 		$sql.=" and idfecha between $idfechai and $idfechaf ";
 		$resultx=$db->execute($sql);
 		if(!$resultx->EOF){
 				$totalp=$resultx->fields[0];
 				if ($totalp=="") $totalp=0;
 		}
 		$resultx->close();	
 		echo $totalp;
 		?>	
 		</td>
 		<td  align="center">
		<?
		// valores calculados dependiendo del rol
		$valorbase="precio_de_arriendo";
		$idbase="9861";
		if ($idrol==4) {
			$valorbase="precio_de_venta";
			$idbase="9862";	
		} 
		$valorprop=0;
 		$sql="select sum($valorbase) as total from crm_propiedades where idusuario=".$result->fields[0];
 		$sql.=" and idfecha between $idfechai and $idfechaf ";
 		//echo $sql;
 		$resultx=$db->execute($sql);
 		if(!$resultx->EOF){
 				$valorprop=$resultx->fields[0];
 				if ($valorprop=="") $valorprop=0;
 		}
 		$resultx->close();	
 		echo number_format($valorprop,0);
		?>
 		</td>
 		<td  align="center">

	<?
		// valores calculados dependiendo del rol
		$valorpropv=0;
		$ok=0;
 		$sql="select sum($valorbase) as total from crm_propiedades where idusuario=".$result->fields[0];
 		$sql.=" and estado_propiedad=$idbase and idfecha between $idfechai and $idfechaf ";
 		$resultx=$db->execute($sql);
 		if(!$resultx->EOF){
 				$valorpropv=$resultx->fields[0];
 				if ($valorpropv=="") $valorpropv=0;
 		}
 		$resultx->close();	
 		
		$sql="select count(*) as total from crm_propiedades where idusuario=".$result->fields[0];
 		$sql.=" and estado_propiedad=$idbase and idfecha between $idfechai and $idfechaf ";
 		$resultx=$db->execute($sql);
 		if(!$resultx->EOF){
 				$ok=$resultx->fields[0];
 				if ($ok=="") $ok=0;
 		}
 		$resultx->close();	
 		

 		echo number_format($valorpropv,0);
		?>
 	

 		</td>
 		<td  align="center"><? echo number_format(($ok/$totalp)*100,2); ?></td>




		</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>

</form>
</table>
<?
	}
	 // fin si
$result->Close();


?>

