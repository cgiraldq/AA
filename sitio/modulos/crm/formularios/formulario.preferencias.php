<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
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
 Preferencias
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
$tablaasoc=" crm_prefencias_por_clientes";
$idy=$_REQUEST['idy'];

function preferencias($idpreferencia,$tabla,$tabla1,$idcampo,$cant){
	global $db;
		$sql="Select a.id,a.nombre ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idestado=1 and a.preferencia_asociada=$idpreferencia order by a.nombre asc ";
		$resulty=$db->Execute($sql);

		if (!$resulty->EOF) {

			while(!$resulty->EOF){

			$idpreferencia=$resulty->fields[0];
			$nombrepreferencia=$resulty->fields[1];


				$sql="select id  from $tabla1  where ";
				$sql.=" cliente_asociado=".$idcampo;
				$sql.=" and preferencia_asociada=".$idpreferencia;

				$resultxx=$db->Execute($sql);
				 if (!$resultxx->EOF) {
					$idar=1;
				} else {
					$idar=0;
				}
		   		$resultxx->Close();

				for ($i=0;$i<=$cant;$i++) {
					//echo "&nbsp;";
				}
				?>
				<div>
					<input type=checkbox name="idasoc[]" value="<? echo $idpreferencia;?>" <? if ($idar=="1") echo "CHECKED";?>>
					<? echo $nombrepreferencia;?>
				</div>
				<?
				preferencias($idpreferencia,$tabla,$tabla1,$idcampo,$cant*2);
				$resulty->Movenext();
			}
		}
		$resulty->Close();


}
//
if ($_REQUEST['idasoc']<>""){
			$contar=count($_REQUEST['idasoc']);
			$sql="delete from $tablaasoc  where cliente_asociado=".$idy;
			$db->Execute($sql);
			for ($j=0;$j<$contar;$j++){
					// inserta
					if ($_REQUEST['idasoc'][$j]<>"") {

						$sqlm=" insert into $tablaasoc   (cliente_asociado,preferencia_asociada) ";
						$sqlm.= " values (";
						$sqlm.= $idy.",";
						$sqlm.= "'".$_REQUEST['idasoc'][$j]."')";
						//echo $sqlm."<br>";
						$db->Execute($sqlm);

					}
			} // fin for
			// FIN DEPENDENCIAS
//exit();
}

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
<title>Preferencias del cliente</title>

<? include ($rutxx."../../incluidos_modulos/javageneral.php"); ?>
	<link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/estilos.modulos.css">
	<link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/estilos.admon.css">
    <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/style.consola.css">
    <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/style.frm.consola.css">
</head>

<body color=#ffffff  topmargin=5 leftmargin=0>


<section class="cont_general">

<table width="100%" border="0" cellspacing=0 class="campos_ingreso">
	<tr>
		<td>
            <?
            if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
             <? }elseif (is_file($rutaImagend2.$dsimg1empresa)){ ?>
			<img src="<? echo $rutaImagend2.$dsimg1empresa ?>" >
             <? } ?>

		</td>
		<td align="center">
			<strong>PREFERENCIAS DEL CLIENTE</strong>
		</td>
	</tr>
</table>

<?
$tablax=$prefix."tbltiposformulariosxcampo";
$tabla="framecf_tblregistro_formularios";
$idtipoformulario=seldato("id","dstabla","framecf_tbltiposformularios",$_REQUEST['dstabla'],2);


$sqlx="select b.id,b.dsm,b.dscampo,b.idtipo from $tablax b where id>0 and idtipoformulario='$idtipoformulario' ";
$sqlx.="and idactivo=1";
$sqlx.=" order by idpos LIMIT 0,1 ";
//echo $sqlx;
$result_campos=$db->Execute($sqlx);
if (!$result_campos->EOF) {
?>
<table width="100%" border="0" cellspacing=0 class="campos_ingreso">
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
	<td align="right"><strong><? echo $dsm;?></strong></td>
	<td align="left"><strong><? echo reemplazar($valorbase);?></strong></td>
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
$result_campos->Close();
$tabla="crm_preferencias";

?>

<form action="<? echo $pagina;?>" method="post" name=xx1>

<nav class="nav_centro">
	<input type=submit name="enviar1" class="botones2" value="Modificar">

	<input type=button name=enviar value="Cerrar" class="botones2" onClick="window.close();">
</nav>


<table width=100% align=center cellspacing=0 class="campos_ingreso">

	<tr >
		<td valign=top colspan="4" class="formabot">
			<input type=checkbox name="AdjuntarTodo" onclick="ActivarTodoGeneral('xx1')"><strong>Seleccionar todo</strong>
		</td>
	</tr>
		<?
		$sql="Select a.id,a.nombre ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idestado=1 and a.preferencia_asociada=0 order by a.nombre asc ";
		 $result=$db->Execute($sql);
		 if (!$result->EOF) {
		?>

		<tr valign=top>
			<?
			while (!$result->EOF) {
			include("formulario.preferencias.datos.php");
			$result->MoveNext();
			 if (!$result->EOF) {
				include("formulario.preferencias.datos.php");//2
				$result->MoveNext();
			 }
			 if (!$result->EOF) {
				include("formulario.preferencias.datos.php");//2
				$result->MoveNext();
			 }

			 if (!$result->EOF) {
				include("formulario.preferencias.datos.php");//2
				$result->MoveNext();
			 }


				} //fin wehile interno
?>
		</tr>

<?
   		}
   		$result->Close();

		?>
	</table>

		<nav class="nav_centro">

		<input type=submit name="enviar" class="botones2" value="Modificar">

		<input type=button name=enviar value="Cerrar" class=botones2 onClick="window.close();">
		<input type=hidden name=inn value="1">
		<input type=hidden name=idy value="<? echo $_REQUEST['idy'];?>">
		<input type=hidden name=dstabla value="<? echo $_REQUEST['dstabla'];?>">

		</nav>

	</form>
</section>

</body>
</html>