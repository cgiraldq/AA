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
Manejo de roles
*/
include ("../validaciones/sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");

	$tabla="tblproductos";
	$dir=1;
// validaciones de datos
	$mensajeData="Listando productos y servicios en el sistema";
	// armando los datos del buscador
	$codigos[0]="dsz";
	$codigos[1]="dso";
	$nombres[0]="Nombre";
	$nombres[1]="Descripción";
	$nombres[2]="ID";

	// armando campos
	$campos="idz as id,dsz,dso,idactivo";
	$condiciones="";
	$nombreBase="dsz";
	$ordenar="dsz";
	$del="idz";
// eliminacion de datos
	if ($_REQUEST['idcampo']<>""){
		$strSQLd="delete from ".$tabla;
		$strSQLd.=" where ";
		$strSQLd.=$del;
		$strSQLd.="=".trim($_REQUEST['idcampo']);
		mysql_db_query($dbase,$strSQLd,$db);
		$Mensaje="Eliminando datos de ".$mensajeData."!";
	}
// fin eliminacion de de campo
// modificacion
	if ($_REQUEST['inn']==1){
		 $contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){

				if ($_REQUEST['id']<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "idactivo=".$_REQUEST['idactivo'][$j];
//					$sqlm.= ",iddistrito=".$_REQUEST['iddistrito'][$j];
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
<head>
	<title><? echo $AppNombre;?> Configuraciones: Productos y Servicios</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ("../../incluidos/javageneral.php"); ?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php"); ?>
		<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>
	<?
// parametro adicional en caso que se lista por empresa
// se  pasa a buscador como a sql
if ($v==1){
	$idempresa=$_REQUEST['idempresa'];
	if ($idempresa==""){
			$idempresa=$_REQUEST['idempresa'];
	}
}

	include ("../../incluidos/buscador.php");
	$strSQL="select $campos from $tabla where 1 ";
	if ($_SESSION['i_idperfil']<>"-1"){
		$strSQL.="and idempresa=".$_SESSION['i_idempresa'];
	}

	if ($_REQUEST['letra']=="pro"){
		$strSQL.=" and idactivo=3 ";
	}elseif ($_REQUEST['letra']<>"" && $_REQUEST['letra']<>"XX"){
		$strSQL.=" and $nombreBase like '".$_REQUEST['letra']."%'";
	}elseif($_REQUEST['param']<>""){
		$strSQL.=" and $campo like '%".$_REQUEST['param']."%'";
	}
	$strSQL.=" order by  $ordenar $orderby $limitmysql ";
	//echo $strSQL;
	?>
<br>
<? // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
?>
	<form action="<? echo $pagina;?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>" method="post" name=xx1>
			<table width=100% align=center  cellpadding=2 cellspacing=1>
			<tr class=textnegro2 bgcolor="<? echo $fondos[12];?>" align="center">
			<th class=formabot><strong>ID</strong></th>
			<th class=formabot><strong>Nombre</strong></th>
			<th class=formabot><strong>Descripción</strong></th>
			<th  class=formabot><strong>Activar</strong></th>
			<!--th  class=formabot><strong>Pa&iacute;s</strong></th -->
			<th style="width:500px" background="../img/cbz1_fondo.jpg" bgcolor="#4483A8" class="textnegrotit1">:: Opciones ::</th>
			</tr>
		<?
		if (mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)) {
					ob_start();
					$campo0=mysql_field_name($vermas,0);
					$campo1=mysql_field_name($vermas,1);
					$campo2=mysql_field_name($vermas,2);
					$campo3=mysql_field_name($vermas,3);
					$pais=mysql_field_name($vermas,3);

					?>
					<tr class=textnegro2  bgcolor="<? echo $fondos[4];?>" align="center">
					<td><? echo $fila->$campo0;?></td>

					<td><? echo $fila->$campo1;?></td>
					<td><? echo $fila->$campo2;?></td>
					<td>
					<select name="idactivo[]" class=textnegro2>
				<option value="1" <? if ($fila->$campo3=="1"){ echo "SELECTED";}?>>SI</option>
				<option value="2" <? if ($fila->$campo3=="2"){ echo "SELECTED";}?>>NO</option>


				<option value="6" <? if ($fila->$campo3=="6"){ echo "SELECTED";}?>>DESTACADO CARRUSEL</option>
				<option value="8" <? if ($fila->$campo3=="8"){ echo "SELECTED";}?>>OFERTA</option>
				<option value="7" <? if ($fila->$campo3=="7"){ echo "SELECTED";}?>>RECOMENDADO</option>

					</select>
					</td>




					<td>
					<input type=button name=enviar value="Preferencias" class=formabot1 onClick="irAPaginaD('preferenciasproductos.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=button name=enviar value="Galeria" class=formabot1 onClick="irAPaginaD('galeria.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=button name=enviar value="Precios" class=formabot1 onClick="irAPaginaD('precios.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=button name=enviar value="Planes" class=formabot1 onClick="irAPaginaD('destinos.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=button name=enviar value="Actividades" class=formabot1 onClick="irAPaginaD('actividades.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=button name=enviar value="Subcategorias" class=formabot1 onClick="irAPaginaD('subcategorias.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">

					<input type=button name=enviar value="Detalles" class=formabot1 onClick="irAPaginaD('mod.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>','500','500');">
					<input type=button name=enviar value="Eliminar" style="background-color:#CC3300" class=formabot1 onClick="enviarconfirm('Esta seguro de eliminar este ítem ?','Recuerde que este proceso no se puede devolver',2,'<? echo $pagina;?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>');">
					<input type=hidden name="id[]" value="<? echo $fila->$campo0;?>">
					</td>
					</tr>
					<?
					ob_end_flush();
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
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>

