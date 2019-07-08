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
//$db->debug=true;

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


?>


            <?
            if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
             <? }elseif (is_file($rutaImagend2.$dsimg1empresa)){ ?>
      <img src="<? echo $rutaImagend2.$dsimg1empresa ?>" >

             <? } else {?>
            <br>
            <? echo $dstituloempresa?>
            <br>
            <? echo $derechos ?>
            <? } ?>

            <?
            }
            $resultd->Close();
            ?>

</td>
		<td align="center">
			<strong>INFORMACI&Oacute;N DE CLIENTES</strong>

		</td>
	</tr>
</table>

<?
$tablax=$prefix."tbltiposformulariosxcampo";
	$tabla="crm_clientes";
	$idy=$_REQUEST['idy'];

$sqlx="select b.id,b.dsm,b.dscampo from $tablax b where id>0 and idtipoformulario='1' ";
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

		$nombrecampos.=$dsm.",";
		$campos.=$dscampo.",";

		$sql=" SELECT $dscampo FROM $tabla WHERE $dscampo !='' and id=$idy ";
		//echo $sql;
		$result=$db->Execute($sql);
		if (!$result->EOF) {
		$dsmvalor=$result->fields[0];
?>
<tr>
	<td><? echo $dsm;?></td>
	<td> <? echo $dsmvalor;?></td>
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

