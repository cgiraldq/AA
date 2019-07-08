<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
	Operaciones con los usuarios
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/class.rc4crypt.php");
$rc4 = new rc4crypt();

$tabla=$_REQUEST['tabla'];
if ($tabla==""){
	$tabla="tblusuariose";
}
$dir=$_REQUEST['dir'];
if ($dir==""){
	$dir=1;
}

$idcolab=$_REQUEST['idcolab'];
$dscolab=$_REQUEST['dscolab'];

	// validaciones de datos
	$mensajeData="Listado de Colaboradores en su zona";
	// armando los datos del buscador
	$codigos[0]="dsnombre";
	$codigos[1]="dslogin";
	$codigos[2]="dscorreo";
	$codigos[3]="dstel";
	$nombres[0]="Nombre1";
	$nombres[1]="Login";
	$nombres[2]="Email";
	$nombres[3]="Teléfono";
	// armando campos
	$campos="a.id,a.dsnombre,a.dslogin,a.idtipo,a.idactivo,a.idusuariodep,a.dsclave";
	$condiciones="";
	$nombreBase="dsnombre";
	$ordenar="dsnombre";
	$del="id";
	
	
	if ($_SESSION['i_idperfil']<>0) { 
	$sql="select idz from tblzonasxusuario ";
	$sql.=" where idu=".$_SESSION['i_idusuario']." and ida=1 ";
} else { 
	$sql="select idz from tblzonas where idactivo=1 ";
}
$vermas=mysql_db_query($dbase,$sql,$db);
	if(mysql_num_rows($vermas)>0){
		$idzona="0";
		while($fila=mysql_fetch_object($vermas)){
			$idzona.=",".$fila->idz;
		}
	} else { 
		$idzona="0";
	}
mysql_free_result($vermas);	
	
?>
<html>
<head>
	<title><? echo $AppNombre;?> Agenda: Ver los colaboradores</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php"); ?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?>
<? if ($idcolab<>"") { ?>
	de <? echo $dscolab;?>
<? } ?>
</td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
	<?
// parametro adicional en caso que se lista por empresa
// se  pasa a buscador como a sql
	$verr=1;
	include ("../../incluidos/buscador.php"); 
	$strSQL="select $campos from tblusuariose a, tblzonasxusuario b";
	$strSQL.=" where b.idu=a.id and a.idactivo not in (2) and b.ida=1 ";
	$strSQL.=" and b.idz in ($idzona) and idu<>".$_SESSION['i_idusuario'];
	if ($_REQUEST['letra']=="pro"){
		$strSQL.=" and idactivo=3 ";		
	}elseif ($_REQUEST['letra']<>"" && $_REQUEST['letra']<>"XX"){
		$strSQL.=" and a.$nombreBase like '".$_REQUEST['letra']."%'";
	}elseif($_REQUEST['param']<>""){
		$strSQL.=" and a.$campo like '%".$_REQUEST['param']."%'";
	}
	
	$sql.=" group by a.id,a.dsnombre order by a.dsnombre asc";
	$strSQL.=" order by  $ordenar $orderby $limitmysql ";
	// echo $strSQL;
	?>	
<br>
<? // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
?>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr class=textnegro2 bgcolor="<? echo $fondos[12];?>">
			<td  align="left"><strong>Nombre</strong></td>
			 <td background="../img/cbz1_fondo.jpg" bgcolor="#4483A8" class="textnegrotit1">:: Opciones ::</td>
			</tr>
				</table>
		<? 
		if (mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)) {
			
			
			
			
					ob_start(); 
					$campo0=mysql_field_name($vermas,0); 
					$campo1=mysql_field_name($vermas,1); // nombre
					$campo2=mysql_field_name($vermas,2); // login
					$campo3=mysql_field_name($vermas,3); // idtipo
					$campo4=mysql_field_name($vermas,4); // idactivo
					$campo5=mysql_field_name($vermas,5); // dependencia
					$campo6=mysql_field_name($vermas,6); // clave
					$fondo=$fondos[4];
					$mem="";
						
			// validar antes de mostrar si los puede ver de acuerdo 
			// al idvistapre
			
			if ($idcolab<>"") { // si estan dentro de un colaborador
			
				if ($fila->$campo3==31 ){ // ejecutivo
					if ($_SESSION['i_idvistadep']==1 || $_SESSION['i_idvistadep']==0 || $_SESSION['i_idvistadep']==3) { 
						$pasar=1;
					} else {
						$pasar=2;
					}
				} elseif($fila->$campo3==10) {  // promotor
					if ($_SESSION['i_idvistadep']==2 || $_SESSION['i_idvistadep']==0 || $_SESSION['i_idvistadep']==3) { 
						$pasar=1;
					} else { 
						$pasar=2;
					}
				} else { 
					$pasar=1;
				}
			} else { 
				$pasar=1;
			}	
						
if ($pasar==1){ 
					?>
		<table width=100% align=center  cellpadding=2 cellspacing=1  style="table-layout:fixed;">
					<tr class=textnegro2  bgcolor="<? echo $fondo;?>" title="<? echo $mem;?>">		
					<td>
					<? echo $fila->$campo1;?>
					<br>
					<strong><? echo $perfiln[$fila->$campo3];?></strong>
					</td>
					<td nowrap  align="center"> 
<input type=button name=enviar value="Agenda" class=formabot1 onClick="irAPaginaDN('../agenda/default.php?idusuariox=<? echo $fila->$campo0;?>&dsusuariox=<? echo $fila->$campo1;?>&enca=1','500','500');" title="Click para ver la agenda de <? echo $fila->$campo1;?>">

					</td>		
					</tr>

					</table>
					<?
} // fin pasar					
					ob_end_flush(); 	
				} // fin while
		} // fin si 
		?>
<? include ("../../incluidos/inferior.php"); ?>
<? include ("../../incluidos/cerrarconexion.php"); ?>
</body>
</html>

