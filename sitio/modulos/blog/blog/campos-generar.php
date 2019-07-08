<?
/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- | 
 Panel de la generacion del boletin de noticias
 Condiciones
 Debe haber una plantilla.
 El sistema genera el codigo y se guarda en un textarea
 con la programacion
 Pide 
 	1. nombre del boletin
 Opcion:
 	2. vista previa
 
*/
include ("sessiones.php");
include ("incluidos/creditos.php");
include ("incluidos/vargenerales.php");
include ("incluidos/varconexion.php");
include ("incluidos/abrirconexion.php");
include ("incluidos/funciones.php");
include ("idiomas/es.php");
$tabla=$_REQUEST['tabla'];
if ($tabla==""){
	$tabla="tblcontenidos";
}
$dir=$_REQUEST['dir'];
if ($dir==""){
	$dir=1;
}

$v=$_REQUEST['v'];
if ($v==""){
	$v=$_REQUEST['v'];
}


// validaciones de datos
	if ($v==1){
		$mensajeData=$mem[157];
	} elseif ($_SESSION['i_idperfil']==1){
		$mensajeData=$mem[158];
	} elseif ($_SESSION['i_idperfil']==2){ 
		$mensajeData=$mem[159];
	}
	// armando los datos del buscador
	$codigos[0]="dsd";
	$nombres[0]=$mem[154];
	// armando campos
	$campos="idc as id,dsd,idempresa,idlec,idactivo";
	$condiciones="";
	$nombreBase="dsc";
	$ordenar="idc";
	$del="idc";
	$orderby=" desc ";
// eliminacion de datos
	if ($_REQUEST['idcampo']<>""){
		$strSQLd="delete from ".$tabla;
		$strSQLd.=" where ";
		$strSQLd.=$del;
		$strSQLd.="=".trim($_REQUEST['idcampo']); 
		mysql_db_query($dbase,$strSQLd,$db);
		$Mensaje1=$mem[41]." ".$mensajeData;
	}
// fin eliminacion de de campo

// modificando solo el idactivo
	if ($_REQUEST['inn']==1){
		$contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "idactivo=".$_REQUEST['idactivo'][$j];
					$sqlm.= " where idc=".$_REQUEST['id'][$j];
					mysql_db_query($dbase,$sqlm,$db);
				} // fin si
			} // fin for
			$Mensaje1=$mem[42]." ".$mensajeData;	
	} // fin inn		

if ($_REQUEST['proc']==3){
	$idempresa=$_REQUEST['idempresa'];
	if ($idempresa<>""){
		// borrando newsletters
		$strSQL="delete from ".$tabla;
		$strSQL.=" where ";
		$strSQL.=" idempresa=".$idempresa;
		mysql_db_query($dbase,$strSQL,$db);
		$Mensaje1=$mem[175]." !";
	}
}

if ($_REQUEST['proc']==4){ // copiar el newsletter con otro nombre
	$idcampo=$_REQUEST['idcampo'];
	if ($idcampo==""){ 	$idcampo=$_REQUEST['idcampo']; }
	$nombrecampo=$_REQUEST['nombrecampo'];
	if ($nombrecampo==""){ 	$nombrecampo=$_REQUEST['nombrecampo']; }
	if ($idcampo<>"" && $nombrecampo<>"" && $nombrecampo<>"0" ){
		
		$strSQL=" select dsc,idempresa,idlec from ".$tabla." where idc=$idcampo ";
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		$fila=@mysql_fetch_object($vermas);
		$dsc=$fila->dsc;
		$idemp=$fila->idempresa;
		$idlec=$fila->idlec;
		@mysql_free_result($vermas);
		
		// revison previa
		$strSQL=" select dsd from ".$tabla." where dsd='$nombrecampo' and idempresa=".$idemp;
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		$num=mysql_num_rows($vermas);
		if ($num>=1){
			$Mensaje1=$mem[290]." !";				
		}else {
		// insertar
			$strSQL="insert into ".$tabla;
			$strSQL.="  values (";
			$strSQL.=" '','$nombrecampo','$dsc',$idemp";
			$strSQL.=" ,$idlec,1";
			$strSQL.=" )";
//			echo $strSQL;
			
			@mysql_db_query($dbase,$strSQL,$db);
			$Mensaje1=$mem[288]." !";		
		}

	} else {
		$Mensaje1=$mem[287]." !";
	}
}
?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<link rel="stylesheet" type="text/css" href="css/accesos.css">
<link rel="stylesheet" type="text/css" href="css/global.css">
<? include ("incluidos/javageneral.php"); ?>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("incluidos/encabezado.php"); ?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >			<td valign=top colspan=2 bgcolor="<? echo $fondos[9];?>"><font class=titulo1><? echo $mem[20]." <u>".$mensajeData."</u>";?>
</font></td>
		</tr>
		<tr align=center >
			<td valign=top colspan=2 background="temas/imagenes/barraseparador2.jpg" height="4"></td>
		</tr>
	</table>
	<? include ("incluidos/resultoperaciones.php"); ?>	
<br>
	<?
// parametro adicional en caso que se lista por empresa
// se  pasa a buscador como a sql
if ($_SESSION['i_idperfil']==3){
	$idempresa=$_SESSION['i_idempresa'];
}
if ($v==1){
	$idempresa=$_REQUEST['idempresa'];
	if ($idempresa==""){
			$idempresa=$_REQUEST['idempresa'];
	}
}

	include ("incluidos/buscador.php"); 
	include ("incluidos/sql.php"); 
	?>	
<br>
<? 
//  echo $strSQL;
// pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);
?>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
			<tr class=textos bgcolor="<? echo $fondos[12];?>" align="center">
			<td class=fondoprincipal2><strong><? echo $mem[154];?></strong></td>
			<? if ($_SESSION['i_idperfil']==1){ ?>
				<td class=fondoprincipal2><strong><? echo $mem[117];?></strong></td>
			<? } ?>
			<td class=fondoprincipal2><strong><? echo $mem[160];?></strong></td>
			<td class=fondoprincipal3 width="35%">::<strong><? echo $mem[38];?></strong>::</td>
			</tr>
			<form action="<? echo $_SERVER["PHP_SELF"];?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>" method="post" name=xx1>							
			</table>
		<? 
		if (mysql_affected_rows()>0){
			while($fila=mysql_fetch_object($vermas)) {
					ob_start(); 
					$campo0=mysql_field_name($vermas,0);
					$campo1=mysql_field_name($vermas,1);
					$campo2=mysql_field_name($vermas,2);
					$campo3=mysql_field_name($vermas,3);
					$campo4=mysql_field_name($vermas,4);
					?>
	<table width=100% align=center  cellpadding=2 cellspacing=1  style="table-layout:fixed;">
	<tr class=textos  bgcolor="<? echo $fondos[4];?>" onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[9];?>');" align="center">		
					<td><? echo $fila->$campo1;?></td>
		<? if ($_SESSION['i_idperfil']==1){ ?>
		<td><? echo seldato("dsnombre","idempresa","tblempresas",$fila->$campo2,1);?></td>		
		<? } ?>
			<td>
			<select name="idactivo[]" class=textos>
	<option value="1" <? if ($fila->$campo4=="1"){ echo "SELECTED";}?>>Tipo normal</option>
	<option value="2" <? if ($fila->$campo4=="2"){ echo "SELECTED";}?>>Tipo Plantilla</option>
	<option value="3" <? if ($fila->$campo4=="3"){ echo "SELECTED";}?>>Desactivar</option>
			</select> 
		</td>						
						
						
					<td nowrap width="35%"> 
					<? if ($_SESSION['i_idperfil']==1){?>
					<? } else { ?>
						<? if ($fila->idlec<>1){?>
						
						<? if ($fila->$campo4<>"2"){?>
							<? }?>
						<? } ?>
					<? } ?>
					<input type=button name=enviar value="<? echo $idb[42];?>" class=fondoprincipal5 onClick="irAPaginaD('vc.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>&dsnombre=<? echo $fila->$campo1;?>&redir=<? echo $pagina?>&add=1');">					
					<input type=hidden name="id[]" value="<? echo $fila->$campo0;?>">
					<? if ($_SESSION['i_iddelu']==1){?>
						<input type=button name=enviar value="<? echo $idb[4];?>" class=fondoprincipal4 onClick="enviarconfirm('Esta seguro de eliminar este item?','Recuerde que este proceso no se puede devolver',2,'<? echo $_SERVER["PHP_SELF"];?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $fila->$campo0;?>','');">
					<? }?>
					
					</td>		
					</tr>

					</table>
					<?
					ob_end_flush(); 	
				} // fin while
		} // fin si 
		// boton de modificar
		?>
		<table width=99% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
		<tr class=textos  bgcolor="<? echo $fondos[4];?>" align="center">		
		<td  onMouseOut="mOut(this,'<? echo $fondos[4];?>');" onMouseOver="mOvr(this,'<? echo $fondos[9];?>');">
		<?	if (mysql_affected_rows()>0){ 
			if ($_SESSION['i_idmodu']==1){
		?>
			<input type=submit name="enviar" class=campos value="<? echo $idb[3];?>">
			<input type=hidden name=inn value="1">
			<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">				
			<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">				
			<input type=hidden name=v value="<? echo $v;?>">				
			<input type=hidden name=idempresa value="<? echo $idempresa;?>">				
		<? 
			}
		} ?>
		</td>
	</form>
	<form action="<? echo $_SERVER["PHP_SELF"];?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&v=1" method="post" name=xx1>															
	<td align="right" valign="middle">
		<?	if ($_SESSION['i_idperfil']==1){?>
		<? echo $mem[147];?>
			<select name="idempresa" class=textos>
			<option value="0"><? echo $mem[234];?></option>
			<?	combosempresas($_REQUEST['idempresa']);?>
			</select>
		<input type=submit name="enviar" class=campos value="<? echo $idb[44];?>">
		<input type=hidden name=letra value="<? echo $_REQUEST['letra'];?>">				
		<input type=hidden name=param value="<? echo $_REQUEST['param'];?>">				
	<? } ?>		
		</td>
		</tr>
	</form>	
		</table>
		<br>
<table width=95% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
<form action="<? echo $_SERVER["PHP_SELF"];?>?proc=4&dir=<? echo $dir;?>&tabla=<? echo $tabla;?>" method="post">
			<tr class=textos bgcolor="<? echo $fondos[12];?>">
			<td bgcolor="<? echo $fondos[4]?>" width="40%"><img src="temas/iconos/desactivar.gif" border="0" align="absmiddle"> 
			<strong><? echo $mem[285];?></strong>
			<br>
			<select name="idcampo" class=textos>
				<?	if ($_SESSION['i_idperfil']==1){
					combosnews(0,0);
				} else {
					combosnews(0,$_SESSION['i_idempresa']);
				} ?>
			</select>

			</td>
			<td bgcolor="<? echo $fondos[9]?>" valign="middle" align="left" rowspan="4">
			<strong><? echo $mem[286];?> </strong>
			<input type="text" name="nombrecampo" class="campos" size="30" maxlength="100">
			<br>
			<input type=submit name=enviar value="<? echo $idb[31];?>" class=fondoprincipal4>
			</td>			
			</tr>
			</form>
</table>	

			
			
<? include ("incluidos/inferior.php"); ?>
<? include ("incluidos/cerrarconexion.php"); ?>
</body>
</html>

