<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2012
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Impresion de pantalla
*/
//include ("../sessiones.php");
//include ("../../incluidos/creditos.php");
$rutx=1;
if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario

    $rutaImagend=$rutxx."../../../contenidos/images/empresa/";
    $rutaImagend2="../../../contenidos/images/logo_empresa/";

    $sqld="select id,dsnombre,dsimg1,copyright,dstitulo,codcliente from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
    $id=$resultd->fields[0];
    $dsmempresa=reemplazar($resultd->fields[1]);
    $dsimg1empresa=$resultd->fields[2];
    $derechos=reemplazar($resultd->fields[3]);
    $dstituloempresa=reemplazar($resultd->fields[4]);
    $codcliente=reemplazar($resultd->fields[5]);
	}
	$resultd->Close();

?>
<html>
<head>
<title>información de cliente</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ($rutxx."../../incluidos_modulos/javageneral.php"); ?>
</head>
<body color=#ffffff  topmargin=5 leftmargin=0>


<table width="100%" border="0" class="textnegrotit">
	<tr>
		<td width="221px">
            <?
            if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
             <? }elseif (is_file($rutaImagend2.$dsimg1empresa)){ ?>
			<img src="<? echo $rutaImagend2.$dsimg1empresa ?>" >
             <? } ?>

		</td>
		<td align="center">
			<strong>INFORMACI&Oacute;N DEL REGISTRO SELECCIONADO</strong>

		</td>
	</tr>
</table>

<?
$tablax=$prefix."tbltiposformulariosxcampo";
	$tabla="framecf_tblregistro_formularios";
	$idy=$_REQUEST['idy'];
$idtipoformulario=seldato("id","dstabla","framecf_tbltiposformularios",$_REQUEST['dstabla'],2);


$sqlx="select b.id,b.dsm,b.dscampo,b.idtipo from $tablax b where id>0 and idtipoformulario='$idtipoformulario' ";
$sqlx.="and idactivo=1";
$sqlx.=" order by idpos";
//echo $sqlx;
$result_campos=$db->Execute($sqlx);
if (!$result_campos->EOF) {
?>
<table width="100%" border="0" class="text1">
<?
	while(!$result_campos->EOF){
		$id=$result_campos->fields[0];
		$dsm=$result_campos->fields[1];
		$dscampo=$result_campos->fields[2];
		$idtipo=$result_campos->fields[3];

		$nombrecampos.=$dsm.",";
		$campos.=$dscampo.",";

		$sql=" SELECT $dscampo FROM ".$_REQUEST['dstabla']." WHERE $dscampo !='' and id=$idy ";
		//echo $sql;
		$result=$db->Execute($sql);
		if (!$result->EOF) {
		$dsmvalor=$result->fields[0];
		if ($idtipo==4 || $idtipo==8 || $idtipo==11 || $idtipo==12 ) {
			$valorbase=seldato("dsm","id","framecf_tbltiposformulariosxcampos",$dsmvalor,1);	
		} elseif ($idtipo==3) { // manejo de clave
			$clave=$dsmvalor;
			$valorbase= $rc4->decrypt($s3m1ll4, urldecode($clave));
		} elseif ($idtipo==15) { // fuente externa
			$idtabla=seldato("dsm","idcampo","framecf_tbltiposformulariosxcampos",$id,1);	
			$campotabla=seldato("dsvalor","idcampo","framecf_tbltiposformulariosxcampos",$id,1);	
			$dstablavalor=seldato("dstabla","id","framecf_tbltiposformularios",$idtabla,1);	
			$valorbase=seldato($campotabla,"id",$dstablavalor,$dsmvalor,1);	

		}  else {
			$valorbase=$dsmvalor;

		}
	
?>
<tr>
	<td><? echo $dsm;?></td>
	<td align="left"> <? echo reemplazar($valorbase);?></td>
</tr>
<?
		}
		$result->Close();



  $result_campos->MoveNext();
		 		 }
?>
</table>
<?
	} // fin si
$result_campos->Close();?>



</body>
</html>

