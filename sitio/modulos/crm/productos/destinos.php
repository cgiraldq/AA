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
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/
$rutx=1;
if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
//$db->debug=true;
$tablaasoc="tblproductosxasocdestinos";
$titulomodulo="Asociar preferencias al producto o servicio";
$idy=$_REQUEST['idcampo'];

function preferencias($idpreferencia,$tabla,$tabla1,$idcampo,$cant){
	global $db;
		$sql="Select a.id,a.titulo ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idactivo=1 and a.preferencia_asociada=$idpreferencia order by a.titulo asc ";
		$resulty=$db->Execute($sql);

		if (!$resulty->EOF) {

			while(!$resulty->EOF){

			$idpreferencia=$resulty->fields[0];
			$nombrepreferencia=$resulty->fields[1];
 

				$sql="select id from $tabla1  where ";
				$sql.=" idproducto=".$idcampo;
				$sql.=" and idasoc=".$idpreferencia;

				$resultxx=$db->Execute($sql);
				 if (!$resultxx->EOF) {
					$idar=1;
				} else {
					$idar=0;
				}
		   		$resultxx->Close();

				for ($i=0;$i<=$cant;$i++) {
					echo "&nbsp;";
				}
				?>
				<input type=checkbox name="idasoc[]" value="<? echo $idpreferencia;?>" <? if ($idar=="1") echo "CHECKED";?>>
				<strong><? echo $nombrepreferencia;?></strong>
<br>
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
			$sql="delete from $tablaasoc  where idproducto=".$idy;
			$db->Execute($sql);
			for ($j=0;$j<$contar;$j++){
					// inserta
					if ($_REQUEST['idasoc'][$j]<>"") {
			
						$sqlm=" insert into $tablaasoc (idproducto,idasoc) ";
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
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
		 include($rutxx."../../incluidos_modulos/navegador.principal.php");
		 include($rutxx."../../incluidos_modulos/core.mensajes.php");
		 // modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsz";
		$paramn="Nombre";
		$bannersx=1;
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");

		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <a href='../formularios/registros.php?idxx=52&r=1' class='textlink' title='Principal'><span class='text1'>Listado de registros</span></a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


  ?>

<?
$tablax=$prefix."tbltiposformulariosxcampo";
$tabla="framecf_tblregistro_formularios";
$idtipoformulario=seldato("id","dstabla","framecf_tbltiposformularios",$_REQUEST['tabla'],2);


$sqlx="select b.id,b.dsm,b.dscampo,b.idtipo from $tablax b where id>0 and idtipoformulario='$idtipoformulario' ";
$sqlx.="and idactivo=1";
$sqlx.=" order by idpos LIMIT 0,1 ";
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

		$sql=" SELECT $dscampo FROM ".$_REQUEST['tabla']." WHERE $dscampo !='' and id=$idy ";
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
<br/>
<tr bgcolor="#666666">
	<td style="color:#fff;font-size:12pt;" align="center"><strong><? echo strtoupper($dsm);?>:</strong>&nbsp;&nbsp;&nbsp;	<? echo reemplazar($valorbase);?></td>
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
$tabla="crm_destinos";

?>

	<form action="<? echo $pagina;?>" method="post" name=xx1>
		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=textnegro2  align="center">
		<td >
		<input type=submit name="enviar1" class="botones" value="Modificar">

		<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('../formularios/registros.php?idxx=52&r=1');">

		</td>
	</tr>
		</table>


		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[3];?>">


		<tr bgcolor="<? echo $fondos[3];?>">
		<td valign=top colspan="4" class="formabot">
		<input type=checkbox name="AdjuntarTodo" onclick="ActivarTodoGeneral('xx1')">Seleccionar Todo
		</td>
		</tr>
		<?
		$sql="Select a.id,a.titulo ";
		$sql.=" from $tabla a where  ";
		$sql.=" a.idactivo=1 order by a.titulo asc ";
		//echo $sql;
		 $result=$db->Execute($sql);
		 if (!$result->EOF) {
		?>

			<tr bgcolor="<? echo $fondos[3];?>" class="text1" valign=top>
			<?
			while (!$result->EOF) {
			include("producto.destinos.datos.php");
			$result->MoveNext();
			 if (!$result->EOF) {
				include("producto.destinos.datos.php");//2
				$result->MoveNext();
			 }
			 if (!$result->EOF) {
				include("producto.destinos.datos.php");//2
				$result->MoveNext();
			 }
			 
			 if (!$result->EOF) {
				include("producto.destinos.datos.php");//2
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

		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=textnegro2  align="center">
		<td >
		<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('../formularios/registros.php?idxx=52&r=1');">
		<input type=hidden name=inn value="1">
		<input type=hidden name=idcampo value="<? echo $idy;?>">
		<input type=hidden name=dstabla value="<? echo $tablaasoc;?>">
		<input type=submit name="enviar" class="botones" value="Modificar">

		</td>
	</tr>
		</table>
	</form>
	<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

