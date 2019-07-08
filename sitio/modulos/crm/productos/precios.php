<?
/*serror_reporting(E_ALL);

ini_set("display_errors", 1);*/

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

$rutx=1;

if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");

include ($rutxx."../../incluidos_modulos/varconexion.php");

include ($rutxx."../../incluidos_modulos/sessiones.php");

include ($rutxx."../../incluidos_modulos/funciones.php");

include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario

/*foreach($_POST as $name=>$val){ 

    echo($name.'='.$val.'<br>'); 

}*/


$tabla="tblproductosxprecios";

$titulomodulo="Configuracion de precios";

$idcampo=$_REQUEST['idcampo'];


if($_REQUEST['idc']<>"") 
{
	$idc=$_REQUEST['idc'];	
	$idcampo = $_REQUEST['idc'];
}
else 
{
	$idc= $idcampo;
	$idcampo = $idc;
	if($idcampo=="")
	{
			$idcampo = seldato("idproducto","id","tblproductosxprecios",$_REQUEST['idx'],1);
	}

}

$dsm=$_REQUEST['dsm'] ;
$idpos=$_REQUEST['idpos'] ;

$dir=1;

//$db->debug=true;

//insertcion de datos
/*
if ($dsm<>"" && $idpos<>"") {

		$sql="select idz ";

	 	$sql.=" from $tabla WHERE dsm='$dsm' ";

		 $result = $db->Execute($sql);

		 if (!$result->EOF) {

		 	// no insertar

			$mensajes=$men[0];

			$error=1;



		 } 
*/
		 if($_REQUEST['dsm']<>"" && $_REQUEST['idpos']<>"" ){

		 	// insertar

			$sql="insert into $tabla (dsm,idpos,idactivo,idempresa,idproducto)";

			$sql.=" values ('$dsm',$idpos,1,1,$idc) ";

			if ($db->Execute($sql))  {

				$mensajes="<strong>".$men[1]."</strong>";

				// cargar auditoria

				$dstitulo="Insercion $titulomodulo";

				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";

				$dsruta="../cms/productos/precios.php";

				include($rutxx."../../incluidos_modulos/logs.php");





			$sqld="select id,dsm from $tabla where dsm='".$dsm."'";

			$resultd = $db->Execute($sqld);

			if (!$resultd->EOF) {

			$idr=$resultd->fields[0];

			$dsmr=$resultd->fields[1];

			}



			$dsarchivo=limpieza(strtolower($dsmr))."";

			$cuerpo='Precios';

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

		 /*$result->close();

}*/



	// eliminacion de datos

if($_REQUEST['eli']=="1"){
	include($rutxx."../../incluidos_modulos/modulos.papelera.php");
}
	$idx="";





	if ($_REQUEST['idcampox']<>""){

		/*$strSQLd="delete from ".$tabla;

		$strSQLd.=" where id=".trim($_REQUEST['idcampox']);

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

					$sqlm.= ",dsd='".$_REQUEST['dsd'][$j]."'";

					$sqlm.= ",dsd2='".$_REQUEST['dsd2'][$j]."'";

					$sqlm.=",idtipomoneda=".$_REQUEST['idtipomoneda'][$j]." ";

					$sqlm.= " where id=".$_REQUEST['id'][$j];

		//			echo $sqlm;

					$db->Execute($sqlm);

				} // fin si

			} // fin for

	$Mensaje=" Modificando datos de ".$mensajeData. " con éxito";

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

		//include($rutxx."../../incluidos_modulos/modulos.buscador.php");

		$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";

		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

				$papelera=1;
				$dsrutap="../crm/productos/precios.php";
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

		$strSQL.=" and dsm like '".$_REQUEST['letra']."%'";

	}elseif($_REQUEST['param']<>""){

		$strSQL.=" and ".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";

	}

	if($_REQUEST['idcampo'] <>""){


		$strSQL.=" and idproducto=".$_REQUEST['idcampo']." ";


	}
	else
	{
		if($idc<>"")$strSQL.=" and idproducto=".$idc."  ";
		if($idc=="")$strSQL.=" and idproducto=".$idcampo."  ";
	}


	$strSQL.=" and idactivo not in (9) order by  dsm asc";

 // pintando cabecera de datos

	$result=$db->Execute($strSQL);

//	echo mysql_error();
	//$db->debug=false;

?>
<br>

	<form action="<? echo $pagina;?>" method="post" name=xx1>

			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">

			<tr bgcolor="#666666">

			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">DESCRIPCI&Oacute;N</td>

			<? /* ?><td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">VALOR NI&Ntilde;O</td> <? */?>

			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">VALOR DESDE</td>

			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">ACTIVAR</td>

			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff">TIPO DE MONEDA</td>

			<td align="center" background="../../img_modulos/fondo3.jpg" class="text1" style="color:#fff"><strong>OPCIONES</strong></td>

			</tr>

		<?

		if (!$result->EOF){

			$contar=0;

			while(!$result->EOF) {

			$colorlineal ="#f3f3f3";

		?>

					<tr class=text1  bgcolor="<?if($contar%2==0){echo $colorlineal;}else {	$colorlineal= '#FFF' ;echo $colorlineal; }?>" align="center" onmouseover="mOvr(this,'#CCCCCC');" onmouseout="mOut(this,'<? echo $colorlineal; ?>')">

					<td><textarea cols="40" rows=5 class=text1  name="dsm[]"><? echo $result->fields['dsm'] ;?></textarea></td>

					<?/* ?><td><input type="text" class=text1 value="<? echo $fila->dsd?>" name="dsd[]"></td><? */?>

					<td><input type="text" class=text1 value="<? echo $result->fields['dsd2']; ?>" name="dsd2[]"></td>



					<td>

					<select name="idactivo[]" class=text1>

				<option value="1" <? if ($result->fields['idactivo']=="1"){ echo "SELECTED";}?>>SI</option>

				<option value="2" <? if ($result->fields['idactivo']=="2"){ echo "SELECTED";}?>>NO</option>

					</select>

					</td>

					<td>	
						<select name="idtipomoneda[]">
							<option> -- -- </option>
								<?
								$sqlMon="select id,codigo ";
								$sqlMon.=" from crm_tipos_de_monedas WHERE idactivo not in (2,9) ";

								$resultxc = $db->Execute($sqlMon);

								if (!$result->EOF) {
										while(!$resultxc->EOF){
											$codigo=$resultxc->fields[1];
											$id=$resultxc->fields[0];
								 ?>
								<option value="<? echo $id; ?>" <? if ($result->fields['idtipomoneda']==$id) echo "Selected" ?>>
									<? echo $codigo; ?>
								</option>
								<?
								$resultxc->Movenext();
								}
							}
							$resultxc->Close();


								 ?>
						</select>
					</td>



					<td>
							
						  <? 
						  $rutax="../preciosxhotel/default.php?idprecio=".$result->fields['id']."&idcampo=".$_REQUEST['idcampo'];
						  $trutax="Click para ver los precios por hotel";
						  $mrutax="Precios por hotel";
						  include($rutxx."../../incluidos_modulos/enlace.generico.php");
						  ?>
						|
						 <?

						$rutax=$pagina."?idx=".$result->fields['id']."&tabla=tblproductosxprecios&dir=1&idcampo=".$_REQUEST['idcampo']."&eli=1" ;

						$result->fields['id'];

						$formax="";

						include($rutxx."../../incluidos_modulos/enlace.eliminar.php");

						?>





					<input type=hidden name="id[]" value="<? echo $result->fields['id'];?>">

					



					</td>

					</tr>

					<?

					$contar++;
				$result->MoveNext();
				} // fin while

		} // fin si
		$result->Close();

		?>

		</table>

		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">

		<tr class=text1  align="center">

		<td>

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

	include("precio.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");



?>





</body>

</html>

