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
	Rutero medico - vista seleccionando el ciclo
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
$idcanal=1;
$tabla="tblvisitas";
$idcliente=$_REQUEST['idcliente'];
?>
<html>
<head>
	<title><? echo $AppNombre;?> Vendedor: Selección de dias de ciclo</title>
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
<?
include ("../../incluidos/encabezado.php");
?>
		<table width="100%" cellspacing="0" cellpadding="2" class=textnegro2 ID="Table2" bgcolor="<? echo $fondos[21]?>">
		<form action="<? echo $pagina;?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>" method="post" name=xx1>
			<tr bgcolor="<? echo $fondos[4];?>">
					<td valign=top align=left >
					<font class="text1">
					Apreciado <? echo $_SESSION['i_dsnombre'];?>, 
					Este es el ciclo del año <? echo date("Y");?> que se encuentra actualmente.<br>
					Puede seleccionar otro ciclo y presionar "<strong>Buscar</strong>"</font>
						<select name="idciclo" class=textnegro2>
						<option value="">Seleccione...</option>
						<? combociclos($_REQUEST['idciclo'],$_SESSION['i_idempresa'],date("Y"));?>
						</select> 
						<input type="submit" name="enviar" value="Buscar" class="formabot">
						<input type="hidden" name="opt" value="<? echo $opt;?>">
						<input type="hidden" name="rr" value="<? echo $rr;?>">
						<input type="hidden" name="idcanal" value="<? echo $idcanal;?>">
						<input type="hidden" name="idcliente" value="<? echo $idcliente;?>">
					</td>
					<td valign=top align=left >
					<a href="../clientes/default.php" title="Click para regresar" class="link11"><font class="text1"><strong>Regresar</strong></font></a>
					</td>
			</tr>
				
		</form>	
</table>
<?
// if ($_REQUEST['idciclo']<>"") { 
	include ("../../incluidos/func.tablarutero.php");
// }
?>	
<br>
<?
include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>
