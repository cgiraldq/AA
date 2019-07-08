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
| ------------------------------------- ---------------------------- | 
Reporte de visita - Impresión
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
// mensajes de recuperacion de claves
$opt=$_REQUEST['opt'];
$tabla="tblvisitas";
if ($opt==1){ 
	$mensaje2=" Cliente";
}
if ($opt==2){ 
}
if ($opt==3){ 
}

$idciclo=$_REQUEST['idciclo'];
if ($idciclo==""){ $idciclo=$_REQUEST['idciclo'];}
$diaciclo=$_REQUEST['diaciclo'];
if ($diaciclo==""){ $diaciclo=$_REQUEST['diaciclo'];}
$dsciclo=$_REQUEST['dsciclo'];
if ($dsciclo==""){ $dsciclo=$_REQUEST['dsciclo'];}
$totalciclo=$_REQUEST['totalciclo'];
if ($totalciclo==""){ $totalciclo=$_REQUEST['totalciclo'];}
$dataciclo=$_REQUEST['dataciclo'];
if ($dataciclo==""){ $dataciclo=$_REQUEST['dataciclo'];}
?>
<html>
<head>
	<title><? echo $AppNombre;?> Vendedor: Visitas <? echo $mensaje2;?></title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
//-->
</SCRIPT>
<?
include ("../../incluidos/javageneral.php");
?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
 <table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" border="1">
 <tr>
 <td align="left" class="textnegro3"><strong><? echo $AppNombre?></strong></td>
 <td align="right">&nbsp;<strong>Coordinadora Mercantil</strong></td>
 </tr>
 <tr>
 <td align="left"><strong>Impresión de rutero </strong>- <? echo $mensaje2;?>, ciclo <? echo $dsciclo;?>,dia <? echo $diaciclo;?></td>
 <td align="right">&nbsp;<strong><? echo $_SESSION['i_dsnombre'];?></strong></td>
 </tr>
</table>
<br>

<?
// impresion dependiendo del opt
if ($opt==1 || $opt==2 || $opt==3){ //
		$strSQL="select a.id,a.dsobs,a.idr,a.dsfechaa,a.dshoraai,a.dshoraaf";
		$strSQL.=",b.dsnombre1,";
		$strSQL.="b.dsnombre2,";
		$strSQL.="b.dsapell,";
		$strSQL.="b.dsapell2,";
		$strSQL.="a.idestado,";
		$strSQL.="a.idsact,a.dsfechac,a.dshorac,a.idfecha,a.dscobroc,a.dsfechai";
		$strSQL.=",a.dshorai,a.dshoraf,a.dsfechai";
		$strSQL.=" from ";
		$strSQL.=" $tabla a,";
		if ($opt==1){
			$strSQL.="tblclientes b ";		
		} elseif($opt==2){
		} elseif($opt==3){
		}
		$strSQL.=" where b.idactivo in (1,3,4,5) ";
		$strSQL.=" and a.idcliente=b.id ";
		$strSQL.=" and a.idciclo=".$idciclo;
		$strSQL.=" and a.iddia=".$diaciclo;
		$strSQL.=" and a.idusuario=".$_SESSION['i_idusuario'];
		$strSQL.=" and a.idcanal=".$opt;
		$strSQL.=" order by idhorai ASC ";
		// echo $strSQL;
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		 if(mysql_affected_rows()>0){
		 ?>
		 <table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" border="1">
		 <tr align="center" bgcolor="<? echo $fondos[3];?>" class="textnegro2">
		<td align="center"><strong>Fecha Actividad / Hora</strong></td>
		 <td align="left"><strong><? echo $mensaje2;?></strong></td>
		 <td align="left"><strong>Actividad</strong></td>		 
		 <td align="left"><strong>Resultado</strong></td>
 		 <td align="left"><strong>Observaciones</strong></td>
		 </tr>
		 <?
				while ($fila=mysql_fetch_object($vermas)){
				$dsnombre=$fila->dsnombre1."&nbsp;".$fila->dsnombre2."&nbsp".$fila->dsapell."&nbsp".$fila->dsapell2;
					?>
				
					 <tr align="center" bgcolor="<? echo $fondos[3];?>">
 					 <td align="center" valign="top">
					 <? 
				 	echo formatfecha($fila->dsfechai)."<br>";
					  echo $fila->dshorai?> - <? echo $fila->dshoraf;
					 if ($fila->dsfechac<>"") { ?>
					 <br>
					 <font color="<? echo $fondos[6];?>">
					 <? echo "Próximo Compromiso: <br>".$fila->dsfechac;?>
					<? echo $fila->dshorac?>
					<? }?>
				  <? if ($fila->dscobroc=="1") { ?>
		  	<br /><span class="textnegro2"><strong>Visita de Cobro</strong></span>

					  <? } ?>
					 </td>
					 <td align="left" valign="top"><strong>
					 <? echo $dsnombre;?>&nbsp;
					 <? if ($fila->idacomp<>0) { ?>
					 <br>
					 <font color="<? echo $fondos[6];?>">
					 Visita Acompañada
					 <? $x=seldato("dsnombre","id","tblusuariose",$fila->idacomp,2);
					 if ($x<>"N/A") echo "<br> Por ".$x."";
					 } 
					 ?>
					 </font>	 
						 
					 </strong>
					 
					 
					 </td>
					 
					 <td align="left" valign="top">
					 	<? echo seldato("dst","idt","tblactclientes",$fila->idsact,1);?> 
					 </td>
					 
					 <td align="left" valign="top">
					 	<? echo seldato("dsoc","idoc","tblrazonesactividad",$fila->idr,1);?> 
					 </td>
					 
					 <td align="left" valign="top">
<? echo $fila->dsobs;?></td>

					 
					 </tr>
					<?
					} // fin while
				?>
				</table><?	
		} else { 
			echo "No hay datos relacionados con el ciclo necesario";
		}// fin si 
		@mysql_free_result($vermas);
		?>	
<?
} else if ($opt==2){  // farmacias
}
?>

<br>
<?
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>
<script language="javascript">
<!--
window.print();
-->
</script>
