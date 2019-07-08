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
Rutero medico - Impresión de lista pero por fecha y usuario 
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
// mensajes de recuperacion de claves
$opt=$_REQUEST['opt'];
if ($opt==""){ $opt=$_REQUEST['opt'];}
$dsfecha=$_REQUEST['dsfecha'];
if ($dsfecha==""){ $dsfecha=$_REQUEST['dsfecha'];}
if ($opt==1){ 
	$tabla="tblvisitasmedicos";
	$mensaje2=" Médicos";
}
if ($opt==2){ 
	$tabla="tblvisitasfarmacias";
	$mensaje2=" Farmacias";
}
?>
<html>
<head>
	<title><? echo $AppNombre;?> Rutero <? echo $mensaje2;?> -- Impresión</title>
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
 <td align="left" colspan="2">
	<? if (is_file("../../temas/logosempresas/".$_SESSION['i_dslogo'].".jpg")){?>
	<img src="../../temas/logosempresas/<? echo $_SESSION['i_dslogo'];?>.jpg" border="0">
	<? } else { ?>
	<font class="titulo"><? echo $AppNombre;?></font>
	<? } ?>
 </td>
  <td align="right">
  <strong>Impresion de rutero</strong> - <? echo $mensaje2;?>
  <br>
  <strong><? echo $_SESSION['i_dsnombre'];?></strong>
  </td>
 </tr>
</table>
<?
// impresion dependiendo del opt
if ($opt==1 || $opt==2){ //
		$strSQL="select a.id,a.dso,a.dsr,a.dsfecha,a.dshora,a.ids";
		$strSQL.=",b.dsnombre,";
		if ($opt==1){
			$strSQL.="b.dsapel,";
		}
		$strSQL.="a.idestado";
		$strSQL.=" from $tabla a,";
		if ($opt==1){
			$strSQL.="tblmedicos b ";		
		} else if($opt==2){
			$strSQL.="tblfarmacias b ";		
		}
		$strSQL.=" where b.idactivo=1 ";
		$strSQL.=" and a.idmedico=b.id ";
		$strSQL.=" and a.dsfecha='".$dsfecha."'";
		$strSQL.=" and a.idusuario=".$_SESSION['i_idusuario'];		
		$strSQL.=" order by dsnombre ASC ";
		// echo $strSQL;
		// exit();
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		 if(mysql_affected_rows()>0){
		 ?>
		 <table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" border="1">
		 <tr align="center" bgcolor="<? echo $fondos[3];?>">
		 <td align="center"><strong>Fecha</strong></td>
		 <td align="center"><strong>Hora</strong></td>
		 <td align="left"><strong><? echo $mensaje2;?></strong></td>
		 <td align="left"><strong>Acompañada ?</strong></td>
		 <td align="left"><strong>Objetivo</strong></td>
 		 <td align="left"><strong>Resultado</strong></td>
		 <td align="left"><strong>Estado</strong></td>
		 </tr>
		 <?
				while ($fila=mysql_fetch_object($vermas)){
					?>
				
					 <tr align="center" bgcolor="<? echo $fondos[3];?>">
					 <td align="center">
					 <? echo formatfecha($fila->dsfecha);?>
					 </td>
 					 <td align="left" valign="top">&nbsp;<? echo $fila->dshora;?></td>
					 <td align="left" valign="top"><strong>
					<? echo $fila->dsnombre;?> <? if ($opt==1){ $fila->dsapel;}?>
					 </strong></td>
 					 <td align="center">
					 <?
					 	if ($fila->ids=="1"){ 
							echo "SI";
						} else if($fila->ids=="0") {
							echo "NO";
						} else { 
							echo "&nbsp;";
						}
						?>
					 </td>

					 <td align="left" valign="top"><? echo $fila->dso;?></td>
					 <td align="left" valign="top">&nbsp;<? echo $fila->dsr;?></td>
					 <td align="center">
					 <? if ($fila->idestado<>"0"){
					 		echo seldato("dsev","idev","tblestadosvisitas",$fila->idestado,1);
					 } else { 
					 	echo "Sin evaluar";
					} ?>
					 </td>

					 
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
