<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com>
  Juan Felipe S�nchez <graficoweb@comprandofacil.com>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Zonas de ventas. Este tiene una forma diferente de ingreso de datos
 Uso exclusivo de loa administradores
*/
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;
$tabla="tblproductosxsubcategorias";
$titulomodulo="Configuracion de Subcategorias";

if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo,idempresa)";
			$sql.=" values ('$dsm',$idpos,$idactivo,1) ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../cms/noticias/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");


			$sqld="select id,dsm from $tabla where dsm='".$dsm."'";
			$resultd = $db->Execute($sqld);
			if (!$resultd->EOF) {
			$idr=$resultd->fields[0];
			$dsmr=$resultd->fields[1];
			}

			$dsarchivo=limpieza(strtolower($dsmr))."";
			$cuerpo='Noticias';
			$ruta=$cuerpo."/".$dsarchivo;
			$idreg=$idr;
			$rutax=1;
//			$include="include('".$rutacomunes."/noticias_detalle.php')";
//			include($rutxx."../../incluidos_modulos/modulos.constructor.php") ;
			$sqlu="update $tabla set dsruta='".$dsarchivo."' where id=$idreg";
			$resultu = $db->Execute($sqlu);
				$error=0;

			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
				$error=1;

			}
		 }
		 $result->close();
}



// eliminacion de datos
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
$idx="";
	if ($_REQUEST['idcampo']<>""){
		/*$strSQLd="delete from ".$tabla;
		$strSQLd.=" where id=".trim($_REQUEST['idcampo']);
		mysql_db_query("c21univiajespide",$strSQLd);
		$Mensaje="Eliminando datos de ".$mensajeData."!";*/
	}


	$codigos[0]="dsm";
	$nombres[0]="Nombre";


// fin eliminacion de de campo
// modificacion
	if ($_REQUEST['inn']==1){
		$contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "idactivo=".$_REQUEST['idactivo'][$j];
					$sqlm.= ",dsm='".$_REQUEST['dsm'][$j]."'";

					$dsruta=str_replace(" ","_",$_REQUEST['dsm'][$j]);
					$dsruta=strtolower($dsruta);
					$dsruta=limpieza($dsruta);

					$sqlm.= ",dsruta='".$dsruta."'";
					$sqlm.= ",idcategoria='".$_REQUEST['idcategoria'][$j]."'";
					$sqlm.= ",idpos='".$_REQUEST['idpos'][$j]."'";
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					//echo $sqlm;
					mysql_db_query("c21univiajespide",$sqlm);
				} // fin si
			} // fin for
	$Mensaje=" Modificando datos de ".$mensajeData. " con �xito";
	} // fin inn
// fin modificacion
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
 include($rutxx."../../incluidos_modulos/core.mensajes.php");?>

<? include($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>
	<?
// parametro adicional en caso que se lista por empresa
// se  pasa a buscador como a sql
if ($v==1){
	$idempresa=$_REQUEST['idempresa'];
	if ($idempresa==""){
			$idempresa=$_REQUEST['idempresa'];
	}
}

	$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		$bannersx=1;
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");

	$strSQL="select id,dsm,idactivo,idcategoria,idpos from $tabla where 1 and idactivo not in (9) ";


	if ($_SESSION['i_idperfil']<>"-1"){
		$strSQL.="and idempresa=".$_SESSION['i_idempresa'];
	}

	if($_REQUEST['idcate']<>""){
		$strSQL.=" and idcategoria=".$_REQUEST['idcate']." ";
	}

	if ($_REQUEST['letra']<>"" && $_REQUEST['letra']<>"XX"){
		$strSQL.=" and dsm like '".$_REQUEST['letra']."%'";
	}elseif($_REQUEST['param']<>""){
		$strSQL.=" and ".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
	}

	$strSQL.=" order by  dsm asc";
	 //echo $strSQL;
	
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	?>
<br>
<? // pintando cabecera de datos
	$vermas=mysql_db_query("c21univiajespide",$strSQL);
?>
	<form action="<? echo $pagina;?>" method="post" name=xx1>
		
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr bgcolor="#666666">
			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">NOMBRE</td>
			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">ACTIVAR</td>
			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">CATEGORIA</td>
			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">POSICI&Oacute;N</td>


			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff"><strong>OPCIONES</strong></td>
			</tr>
		<?
		if (mysql_num_rows($vermas)>0){
			$contar=0;
			while($fila=mysql_fetch_object($vermas)) {
			$colorlineal ="#f3f3f3";
		?>
					<tr class=text1  bgcolor="
					<? 
					if($contar%2==0){
						echo $colorlineal;
					}else 
					{
						$colorlineal= '#FFF' ;
						echo $colorlineal; 
					} 
					?>

					" align="center" onmouseover="mOvr(this,'#CCCCCC');" onmouseout="mOut(this,'<? echo $colorlineal; ?>')">
					<td><input type="text" class=text1 value="<? echo $fila->dsm?>" name="dsm[]"></td>

					<td>
					<select name="idactivo[]" class=text1>
					<option value="1" <? if ($fila->idactivo=="1"){ echo "SELECTED";}?>>SI</option>
					<option value="2" <? if ($fila->idactivo=="2"){ echo "SELECTED";}?>>NO</option>
					</select>
					</td>


					<td>
					<select name="idcategoria[]" class=text1>
						<? combosproductosxcategorias($fila->idcategoria,$_SESSION['i_idempresa']);?>
					</select>
					</td>

					<td><input style="width:60px" type="text" name="idpos[]" min="1" max="99999" value="<? echo $fila->idpos;?>"> </td>


					<td>
					<? /* ?><input type=button name=enviar value="Detalles" class="btn_detalle botones2" onClick="irAPaginaD('productos.modsubcategorias.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->id;?>','500','500');"><?  */?>
					<?
						$rutax="productos.modsubcategorias.php?tabla=".$tabla."&dir=".$dir."&idcampo=".$fila->id ;
						$trutax="Click ingresar al detalle";
						$mrutax="Detalle";
						include($rutxx."../../incluidos_modulos/enlace.generico.php");
						?>
						|

						 <?
						$rutax=$pagina."?idx=".$fila->id;
						$formax="";
						include($rutxx."../../incluidos_modulos/enlace.eliminar.php");
					?>
					<input type=hidden name="id[]" value="<? echo $fila->id;?>">
					</td>
					</tr>
					<?
					$contar++;
				} // fin while
		} // fin si
		?>
		</table>
		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=text1  bgcolor="<? echo $fondos[4];?>" align="center">
		<td>
		<input type=submit name="enviar" class="btn_detalle botones2" value="Modificar">
		<input type=hidden name=inn value="1">
		<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">
		<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">
		<input type=hidden name=v value="<? echo $v;?>">
		<input type=hidden name=idempresa value="<? echo $idempresa;?>">
		</td>
	</tr>
		</table>
	</form>
<? 
	include("subcategoria.ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>
