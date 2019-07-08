<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Rutero medico - dependiendo del tipo de pintan los datos
Pantalla principal
el resto de las operaciones se generan en pop ups
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
// mensajes de recuperacion de claves
$opt=$_REQUEST['opt'];
$rr=$_REQUEST['rr'];
$tabla="tblvisitas";
if ($opt==1){ 
	$mensaje2=" Cliente(s)";
	$mensaje3=" Cliente";
	$tipov=1;
	$tipo="clientes";
	$tablax="tblclientes";
}elseif ($opt==2){ 
	$mensaje2="";
	$mensaje3="";
	$tipov=2;
	$tipo="";	
	$tablax="";
}elseif ($opt==3){ 
	$mensaje2="";	
	$mensaje3="";	
	$tipov=3;
	$tipo="";
	$tablax="";
}
$idciclo=$_REQUEST['idciclo'];
$diaciclo=$_REQUEST['diaciclo'];
$dsciclo=$_REQUEST['dsciclo'];
$totalciclo=$_REQUEST['totalciclo'];
$dataciclo=$_REQUEST['dataciclo'];
// nuevo campo ...si es reunion o no 
$idreunion=$_REQUEST['idreunion'];
if ($idreunion==""){ $idreunion=0;}
if ($_REQUEST['enviar']=="Actualizar"){
	if ($opt==1 || $opt==2 || $opt==3){ // 
			$contar=count($_REQUEST['id']);
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['dsobs'][$j]<>""){
					$sqlm=" update $tabla set ";
					$sqlm.= "dsobs='".$_REQUEST['dsobs'][$j]."'";
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					//echo $sqlm;
					mysql_db_query($dbase,$sqlm,$db);
				} // fin si
			} // fin for
	}
		$Mensaje="Rutero actualizado con éxito";	
}

if ($_REQUEST['del1']==1){
	$sql=" delete from $tabla where id=".$_REQUEST['idrutero'];
	mysql_db_query($dbase,$sql,$db);
	$Mensaje="$mensaje2 eliminado de su lista de rutero";
}

// traer datos del ciclo para mostrar el formato dia mes año

$partir=explode(" ",$dsciclo);
$mesbase=num_mes(trim($partir[0]));
$aniobase=trim($partir[1]);
?>
<html>
<head>
	<title><? echo $AppNombre;?> Vendedor: Reporte de visitas y manejo de pauta</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<?
include ("../../incluidos/javageneral.php");
?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<script language="JavaScript" type="text/javascript">
<!--
// funciones unicas de esta pagina

function validarRutero(ruta,proc){
	if (document.proceso.idcliente.value==""){
		alert("Primero seleccione el <? echo $mensaje3;?>");
		return;
	}
	var idcampo=document.proceso.idcliente.value;
	if (proc==1){
	// capturar el nombre
	var dsnombre=document.proceso.idcliente.options[document.proceso.idcliente.selectedIndex].text;
	//	alert(dsnombre);
		var rutaadd=ruta+"&idcampo="+idcampo+"&dsnombre="+dsnombre;
	}else{
		var rutaadd=ruta+"&idcliente="+idcampo+"&ver=1";
	}
	 window.open(rutaadd,"",'scrollbars=YES,width=600,height=600,left=30,top=2,resizable=yes');	
}	
//-->
</script>

<?
include ("../../incluidos/encabezado.php");
?>

		<table width="100%" cellspacing="0" cellpadding="2" class=textnegro2 ID="Table2" bgcolor="<? echo $fondos[3]?>">
		<form action="<? echo $_SERVER['PHP_SELF'];?>" name="t3" method="post">
			<tr bgcolor="<? echo $fondos[4];?>">
					<td valign=top align=left >
					<font class="text1"><strong>Rutero para el día <? echo $diaciclo;?>,  <? echo $dsciclo;?></strong>.
					Cambiar día: 
					 <select name="diaciclo" class="text1">
					<? for ($i=1;$i<=$totalciclo;$i++){
					// agregar el dia 
					$sql="select iddiacal,idmescal from tblciclodiaxcal where";
				  $sql.=" iddiaciclo=$i";
				  $sql.=" and idmescal=$mesbase";
				  $sql.=" and idaniocal=$aniobase";
				  $sql.=" and idciclo=$idciclo";
				  // echo $sql;
				  // exit();
				  $ssql=mysql_db_query($dbase,$sql,$db);
				  //echo $total;
					if (mysql_num_rows($ssql)> 0){
						$ast=mysql_result($ssql,"0","iddiacal");
						$ast1=mysql_result($ssql,"0","idmescal");
						$x=nombre_mes($ast1).",".nombre_dia_semana($ast,$mesbase,$aniobase)." ".$ast;
					}
					mysql_free_result($ssql);		
					?>
						<option value="<? echo $i;?>" <? if ($i==$_REQUEST['diaciclo']){ echo "SELECTED";}?>><? echo $i. " ($x)";?></option>
					<? } ?>}
					</select>
					<input type="submit" name="enviar1" value="Cambiar" class=formabot>
					<input type="hidden" name="opt" value="<? echo $opt;?>">
					<input type="hidden" name="idciclo" value="<? echo $idciclo;?>">			
					<input type="hidden" name="dsciclo" value="<? echo $dsciclo;?>">			
					<input type="hidden" name="totalciclo" value="<? echo $totalciclo;?>">			
					<input type="hidden" name="dataciclo" value="<? echo $dataciclo;?>">
					<input type="hidden" name="rr" value="<? echo $rr;?>">
					
					</font>
					</td>
					<td valign=top align=right >
					<a href="rutero.php?idciclo=<? echo $idciclo;?>&opt=<? echo $opt;?>&rr=<? echo $rr;?>" title="Click para regresar" class="link11"><strong>REGRESAR</strong></a>
					</td>
		</tr>					
		</form>
		</table>
<table width="100%" cellspacing="0" cellpadding="1" class=textnegro2 ID="Table2">
<tr align="center">
		<form action="<? echo $_SERVER['PHP_SELF'];?>" name="proceso" method="post">
		<td bgcolor="<? echo $fondos[4];?>" align="left" ><strong>Seleccione:</strong>
				<select name="idcliente" class="text1">
				<?
				if ($opt==1){
						// combosclientesv($idcliente,$_SESSION['i_idusuario'],1,$diaciclo);
						$idperfilx=$_SESSION['i_idperfil'];
						combosclientesasoc($idcliente,$_SESSION['i_idusuario'],1,$diaciclo);
				} elseif($opt==2){
				} elseif($opt==3){
				}
				?>
				</select>
			</td>
			</tr>		
<tr align="center" class="text1">
		<td bgcolor="<? echo $fondos[4];?>" align="left" >
<? if ($_SESSION['i_idvista']==0){?>		
<input type="button" name="enviar" value="Reportar visita" class="formabot" onClick="validarRutero('procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&diaciclo=<? echo $diaciclo;?>&totalciclo=<? echo $totalciclo;?>&dataciclo=<? echo $dataciclo;?>&opt=<? echo $opt;?>&rr=<? echo $rr;?>','2');" title="Click para reportar visita en el sistema">
<input type=button name=enviar value="HISTORICOS" class=formabot onClick="validarRutero('../reportes/rep.actividades.php?tabla=<? echo $tablax;?>&exp=1&enviar=Generar&idusuario=<? echo $_SESSION['i_idusuario'];?>&idcanal=<? echo $opt;?>','2');" title="Click para ver los historicos de reporte de visita.">	


<input type=button name=enviar value="COMPETENCIA" class=formabot onClick="validarRutero('competencias.php?tabla=<? echo $tablax;?>&exp=1&enviar=Generar&idusuario=<? echo $_SESSION['i_idusuario'];?>&idcanal=<? echo $opt;?>&idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&iddia=<? echo $diaciclo;?>','1');" title="Click manejar la competencia del cliente">	


<!--input type=button name=enviar value="HACIA NOVEDADES" class=formabot1 onClick="validarRutero('','1');" title="Click ir hacia el sistema interno de la empresa"-->	


<? } ?>	
<? if ($_SESSION['i_idperfil']<>0){?>		
<? if ($_SESSION['i_idvista']==0){?>					
<!--input type=button name=enviar value="PAUTAS" class="text1" onClick="validarRutero('../pautas/hacerpedido.php?tipo=<? echo $tipo?>','1');" title="Click para hacer una orden de pauta"-->		
<? } ?>
<!--input type=button name=enviar value="MERCADEO" class=textnegro2 onClick="validarRutero('../productos/prodmuestras.php?idcanal=<? echo $opt;?>','1');" title="Click para ver los productos recomendados y muestras entregadas">	
<input type=button name=enviar value="COMPETENCIA" class=textnegro2 onClick="validarRutero('../productos/prodcompetencia.php?idcanal=<? echo $opt;?>','1');" title="Click para digitar los productos de la competencia"-->	
<? if (($opt==2 || $opt==3) && $_SESSION['i_idvista']==1){?>
<!--input type=button name=enviar value="TRANSFERENCIAS" class=textnegro2 onClick="validarRutero('../transferencias/hacerpedido.php?tipo=<? echo $tipo;?>&idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsciclo;?>&diaciclo=<? echo $diaciclo;?>&totalciclo=<? echo $totalciclo;?>&dataciclo=<? echo $dataciclo;?>&opt=<? echo $opt;?>&rr=<? echo $rr;?>','1');" title="Click para ver generar una transferencia en el sistema.">	

<input type=button name=enviar value="HISTORICOS" class=textnegro2 onClick="validarRutero('../reportes/reptransferencias.php?tabla=<? echo $tablax;?>&exp=1&enviar=Generar&idusuario=<? echo $_SESSION['i_idusuario'];?>&idcanal=<? echo $opt;?>','2');" title="Click para ver los historicos de generación de transferencias."-->	
<? } ?>


<? } ?>
		
			</td>
			</tr>		

</form>
</table>
<? include ("../../incluidos/resultoperaciones.php");
if ($_SESSION['i_idvista']==0){?>					
<table width="100%" cellspacing="4" cellpadding="4" class=textnegro2 ID="Table2">
		<tr align="center">
			<td width="100%" align="center" valign="top">
			<?
			if ($opt==1 || $opt==2 || $opt==3){ // clientes
			include ("../../incluidos/func.tablaasocruteromed.php");
			}
			?>
			</td>
			<!--
			<?
			// operaciones genericas
			// TEMPORALMENTE APAGADO
			// include ("../../incluidos/func.ruterooperaciones.php");
			?>
			-->
			</td>
		</tr>
		</table>

<? } ?>
<?
include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>