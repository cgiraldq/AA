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
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;
$tabla="tblproductosxgalerias";
$titulomodulo="Configuracion de Galeria";
$idcampo=$_REQUEST['idcampo'];
$dir=1;

//insertcion de datos
if ($dsm<>"" && $idpos<>"") {
		$sql="select idz ";
	 	$sql.=" from $tabla WHERE dsz='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;

		 } else {
		 	// insertar
			$sql="insert into $tabla (dsz,idactivo,idempresa,idproducto,idpos)";
			$sql.=" values ('$dsm',$idactivo,1,$idcampo,$idpos) ";
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../cms/noticias/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");


			$sqld="select id,dsm from $tabla where dsz='".$dsm."'";
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

	if ($_REQUEST['idcampox']<>""){
		/*$strSQLd="delete from ".$tabla;
		$strSQLd.=" where idz=".trim($_REQUEST['idcampox']);
		mysql_db_query("c21univiajespide",$strSQLd);
		echo mysql_error();
		$Mensaje="Eliminando datos de ".$mensajeData."!";*/
	}


	$codigos[0]="dsz";
	$nombres[0]="Nombre";

// fin eliminacion de de campo



// modificacion
		if ($_REQUEST['inn']==1){
		//$db->debug=true;
		$contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "idactivo=".$_REQUEST['idactivo'][$j];
					$sqlm.= ",dsz='".$_REQUEST['dsz'][$j]."'";
					$sqlm.= ",dso='".$_REQUEST['dso'][$j]."'";
					$sqlm.= ",idpos='".$_REQUEST['idpos'][$j]."'";
					

					$sqlm.= " where idz=".$_REQUEST['id'][$j];
		//			echo $sqlm;
					$db->Execute($sqlm);
				} // fin si
			} // fin for
	$Mensaje=" Modificando datos de ".$mensajeData. " con éxito";
	//$db->debug=true;
	} // fin inn
// fin modificacion
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
		$paramb="dsm";
		$paramn="Nombre";
		$bannersx=1;
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");

		$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		
		$papelera=0;

		$idx=$_REQUEST['idcampo'];
		$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


  ?>
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
	//include($rutxx."../../incluidos_modulos/buscador.php"); 

	$strSQL="select * from $tabla where 1 ";
	if ($_SESSION['i_idperfil']<>"-1"){
		$strSQL.=" and idempresa=".$_SESSION['i_idempresa'];
	}

	if ($_REQUEST['letra']<>"" && $_REQUEST['letra']<>"XX"){
		$strSQL.=" and dsz like '".$_REQUEST['letra']."%'";
	}elseif($_REQUEST['param']<>""){
		$strSQL.=" and ".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
	}
	$strSQL.=" and idproducto=".$_REQUEST['idcampo'];

	$strSQL.=" and idactivo not in (2,9) order by  dsz asc";
	 //echo $strSQL;
	


	?>

<br>
<? // pintando cabecera de datos
	$vermas=$db->Execute($strSQL);
?>
	<form action="<? echo $pagina;?>" method="post" name=xx1>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr bgcolor="#666666">
				<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">NOMBRE</td>
				<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">POSICION</td>
				<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">ACTIVAR</td>
				<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff"><strong>OPCIONES</strong></td>
			</tr>
		<?
		if (!$vermas->EOF){
			$contar=0;
			while(!$vermas->EOF) {
			$colorlineal ="#f3f3f3";
		?>
					<tr class=text1  bgcolor="<?if($contar%2==0){echo $colorlineal;}else {	$colorlineal= '#FFF' ;echo $colorlineal; }?>" align="center" onmouseover="mOvr(this,'#CCCCCC');" onmouseout="mOut(this,'<? echo $colorlineal; ?>')">
					<td><input type="text" class=txt1 value="<? echo $vermas->fields['dsz']?>" name="dsz[]"></td>
					<td>
						<input type="text" name="idpos[]" size="2" class=text1 value="<? echo $vermas->fields['idpos'];?>" >
					</td>
					<td>
					<select name="idactivo[]" class=txt1>
						<option value="1" <? if ($vermas->fields['idactivo']=="1"){ echo "SELECTED";}?>>SI</option>
						<option value="2" <? if ($vermas->fields['idactivo']=="2"){ echo "SELECTED";}?>>NO</option>
						<option value="3" <? if ($vermas->fields['idactivo']=="3"){ echo "SELECTED";}?>>Destacada</option>
						<option value="4" <? if ($vermas->fields['idactivo']=="4"){ echo "SELECTED";}?>>Detalle</option>
									</select>
					</td>

					<td>

						<?
						$rutax="galeria.mod.php?tabla=".$tabla."&dir=".$dir."&idcampox=".$vermas->fields['idz']."&titulomodulo=$titulomodulo" ;
						$trutax="Click ingresar al detalle";
						$mrutax="Detalle";
						include($rutxx."../../incluidos_modulos/enlace.generico.php");
						?>
						|

						 <?
						$rutax=$pagina."?tabla=crm_productos_y_servicios&dir=1&idcampo=".$_REQUEST['idcampo']."&idx=".$vermas->fields['idz'];
						$formax="";
						include($rutxx."../../incluidos_modulos/enlace.eliminar.php");
					?>



					<input type=hidden name="id[]" value="<? echo $vermas->fields['idz'];?>">
					</td>
					</tr>
					<?
					$contar++;
					$vermas->MoveNext();
				} // fin while
		} // fin si
		$vermas->Close();
		?>
		</table>
		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=txt1 align="center">
		<td >
		<input type=submit name="enviar" class="botones" value="Modificar">
		<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('../formularios/registros.php?idxx=52&r=1');">

		<input type=hidden name=inn value="1">
		<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">
		<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">
		<input type=hidden name=v value="<? echo $v;?>">
		<input type=hidden name=idempresa value="<? echo $idempresa;?>">
		<input type=hidden name=idcampo value="<? echo $idcampo;?>">

		</td>
	</tr>
		</table>
	</form>
	<?
		include("galeria.ingreso.php");

		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>


