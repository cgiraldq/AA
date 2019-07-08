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
 Zonas de ventas. Este tiene una forma diferente de ingreso de datos
 Uso exclusivo de loa administradores
*/
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$tabla="tblproductosxactividades";

// validaciones de datos
		$mensajeData="Tipos de actividades productos / servicios";
	// armando los datos del buscador
// eliminacion de datos
	if ($_REQUEST['idcampo']<>""){
		$strSQLd="delete from ".$tabla;
		$strSQLd.=" where id=".trim($_REQUEST['idcampo']);
		mysql_db_query($dbase,$strSQLd,$db);
		$Mensaje="Eliminando datos de ".$mensajeData."!";
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
					$sqlm.= ",dsz='".$_REQUEST['dsm'][$j]."'";
					$sqlm.= " where idz=".$_REQUEST['id'][$j];
					//echo $sqlm;
					mysql_db_query($dbase,$sqlm,$db);
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
 include($rutxx."../../incluidos_modulos/core.mensajes.php"); ?>
		<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
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

	include($rutxx."../../incluidos_modulos/buscador.php");
	$strSQL="select idz as id,dsz dsm,idactivo from $tabla where 1 ";
	if ($_SESSION['i_idperfil']<>"-1"){
		$strSQL.="and idempresa=".$_SESSION['i_idempresa'];
	}

	if ($_REQUEST['letra']<>"" && $_REQUEST['letra']<>"XX"){
		$strSQL.=" and dsz like '".$_REQUEST['letra']."%'";
	}elseif($_REQUEST['param']<>""){
		$strSQL.=" and ".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
	}
	$strSQL.=" order by  dsz asc";
	 //echo $strSQL;
	?>
<br>
<? // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
	echo mysql_error();
?>
	<form action="<? echo $pagina;?>" method="post" name=xx1>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr class=textnegro2 bgcolor="<? echo $fondos[12];?>" align="center">
			<th class=formabot>Nombre</th>
			<th class=formabot><strong>Activar</strong></th>
			<th background="../img/cbz1_fondo.jpg" bgcolor="#4483A8" class="textnegrotit1">:: Opciones ::</th>
			</tr>
		<?
		if (mysql_num_rows($vermas)>0){
			while($fila=mysql_fetch_object($vermas)) {
		?>
					<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">
					<td><input type="text" class=textnegro2 value="<? echo $fila->dsm?>" name="dsm[]"></td>
					<td>
					<select name="idactivo[]" class=textnegro2>
				<option value="1" <? if ($fila->idactivo=="1"){ echo "SELECTED";}?>>SI</option>
				<option value="2" <? if ($fila->idactivo=="2"){ echo "SELECTED";}?>>NO</option>
					</select>
					</td>
					<td>
					<input type=button name=enviar value="Detalles" class=formabot1 onClick="irAPaginaD('productos.modactividades.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->id;?>','500','500');">
					<input type=button name=enviar value="Eliminar" style="background-color:#CC3300" class=formabot1 onClick="enviarconfirm('Esta seguro de eliminar este ítem ?','Recuerde que este proceso no se puede devolver',2,'<? echo $pagina;?>?idcampo=<? echo $fila->id;?>');">
					<input type=hidden name="id[]" value="<? echo $fila->id;?>">
					</td>
					</tr>
					<?
				} // fin while
		} // fin si
		?>
		</table>
		<table width=20% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">
		<td  onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[21];?>');">
		<input type=submit name="enviar" class=formabot value="Modificar">
		<input type=hidden name=inn value="1">
		<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">
		<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">
		<input type=hidden name=v value="<? echo $v;?>">
		<input type=hidden name=idempresa value="<? echo $idempresa;?>">
		</td>
	</tr>
		</table>
	</form>
<? include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>


