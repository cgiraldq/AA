<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
Principal listado de facturacion
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$dsm="Facturacion";
include ("../../incluidos/seguridad.php");
// mensajes de recuperacion de claves
$tabla="tblfacturase";
$idaniox=$_REQUEST['idaniox'];
if ($idaniox=="") $idaniox=$_SESSION['i_dsanio'];
$idmesx=$_REQUEST['idmesx'];
if ($idmesx=="") $idmesx=$_SESSION['i_dsmes'];
$dsvendedor=$_REQUEST['dsvendedor'];

if ($_REQUEST['enviar']=="Modificar"){
 		$contar=count($_REQUEST['id']);
			$v=0;
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "dsfechac='".$_REQUEST['dsfechac'][$j]."'";
					$sqlm.= ",idfechac=".$_REQUEST['idfechac'][$j]."";
					$sqlm.= ",dsfechav='".$_REQUEST['dsfechav'][$j]."'";
					$sqlm.= ",idfechav=".$_REQUEST['idfechav'][$j]."";
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					// echo $sqlm."<br>";
					// exit();
					if (mysql_db_query($dbase,$sqlm,$db)) $v++;
				} // fin si
			} // fin for
			if ($v>0) $Mensaje="Modificación realizada con éxito ".$mensajeData;	
	} // fin inn
// parametros de busqueda
	$codigos[0]="idpedido";
	$codigos[1]="dsorden";
	$codigos[2]="dsrazon";
	$codigos[3]="dsnit";
	$codigos[4]="dstele";

	$nombres[0]="Numero";
	$nombres[1]="Nro Orden";
	$nombres[2]="Tercero";
	$nombres[3]="NIT";
	$nombres[4]="Telefono";



// armando campos
$idactivox1=$_REQUEST['idactivox1'];
$dsfecha1=$_REQUEST['dsfecha1'];
$partir=explode("/",$dsfecha1);
$idfecha1=$partir[0].$partir[1].$partir[2];
//
$dsfecha2=$_REQUEST['dsfecha2'];
$partir=explode("/",$dsfecha2);
$idfecha2=$partir[0].$partir[1].$partir[2];
$paramx=$_REQUEST['paramx'];
$idprog=$_REQUEST['idprog'];
$dsprog=$_REQUEST['dsprog'];
?>
<html>
<head>
	<title><? echo $AppNombre;?> Administración: Facturacion</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
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
if ($ida==1){
include ("../../incluidos/encabezado.php");
?>
<? include ("../../incluidos/resultoperaciones.php"); ?>	


<br>

		<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2">
			<tr bgcolor="<? echo $fondos[5];?>">
					<td valign=top align=left>
					<font class="textnegrotit">Listado de facturas 
					<? if ($idprog<>"" && $dsprog<>"") echo ", $dsprog";?>
					</font></td>
					
					<td valign=top align=right>
					
<a href="../administrador/utilidades.php" title="Click para ver reporte" class="link11"><font class="formbt1"><strong>Regresar</strong></font></a> 
</td>
					
			</tr>
		</table>
			<?
	$strSQL="select c.*";
	$strSQL.="";
	$strSQL.=" from $tabla c ";
	$strSQL.=" where c.id > 0 and c.idanio=2010 ";
	$strSQL.=" order by  c.idpedido desc ";
	//echo $strSQL;
	 // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);

?>
<br>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>">
								
			<tr class="text" bgcolor="<? echo $fondos[21];?>" align="center">
			<td width="5%" background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>Num</strong></td>
			<td  width="20%" background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>Tercero</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>Fecha C</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>Idfecha C</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>Fecha V</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>Idfecha V</strong></td>
			<td background="../../img/fondo3.jpg" bgcolor="#FCF5DB" class="textnegrotit1" width="20%">::Opciones::</td>
			</tr>
</table>
	<form action="<? echo $pagina;?>" method="post" name="u<? echo $fila->idpedido?>"> 				
		<? 
		if (mysql_num_rows($vermas)>0){
			$xdssubtotal=0;
			$xdsdesct=0;
			$xdsiva=0;
			$xdsrete=0;
			$xdsreteiva=0;
			$xdstotal=0;
			while($fila=mysql_fetch_object($vermas)) {
				$color=$fondos[4];
				$colorx=$fondos[10];

			if ($fila->idactivo<>3) { 
				$xdssubtotal=$xdssubtotal+$fila->dssubtotal;
				$xdsdesct=$xdsdesct+$fila->dsdesct;
				$xdsiva=$xdsiva+$fila->dsiva;
				$xdsrete=$xdsrete+$fila->dsrete;
				$xdsreteiva=$xdsreteiva+$fila->dsreteiva;
				$xdstotal=$xdstotal+$fila->dstotal;
			}
			
			// organizacion de fechas
			$partir=explode("/",$fila->dsfechav);
			$anio=$partir[0];
			$mes=$partir[1];
			$dia=$partir[2];
			if (strlen($fila->dsfechav)<10) { 
				if (strlen($mes)<2) $mes="0".$mes;
				if (strlen($dia)<2) $dia="0".$dia;
			}
			$dsfechav=$anio."/".$mes."/".$dia;
			$idfechav=$anio.$mes.$dia;
			
			
					?>
<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed">					

			<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');" onClick="mOut(this,'<? echo $colorx;?>');">		
					<td width="5%" align="center" bgcolor="<? echo $fondos[12]?>" class="link_negro1">
					<strong><? echo $fila->idpedido;?></strong>					</td>
					<td width="20%" align="center" class="link_negro1"><strong><? echo $fila->dsrazon;?></td>
					<td align="center" class="link_negro1"><strong><input type=text name="dsfechac[]" value="<? echo $fila->dsfechac;?>"></td>
					<td align="center" class="link_negro1"><strong><input type=text name="idfechac[]" value="<? echo $fila->idfechac;?>"></td>
					<td align="center" class="link_negro1"><strong><input type=text name="dsfechav[]" value="<? echo $dsfechav;?>"></td>
					<td align="center" class="link_negro1"><strong><input type=text name="idfechav[]" value="<? echo $idfechav;?>"></td>

					<td width="20%" class="link_negro1" > 
<input type=button name=enviar value="IMP" class="formbt1" onClick="irAPaginaDN('../facturacion/facturar.imprimir.html.php?idpedido=<? echo $fila->idpedido;?>&idcliente=<? echo $fila->idcliente;?>&enca=1');" title="Click para imprimir ">
	 <input type=hidden name="id[]" value="<? echo $fila->id;?>" >
<!--input type=button name=enviar value="ANULAR" class="formbt1" onClick="" title="Click para anular"-->

			  </td>		
  </tr>
</table>				
					<?
				} // fin while
		ob_flush();
		flush(); 

?>
<input type="submit" name="enviar" value="Modificar">
</form>
<?

		} // fin si 
		mysql_free_result($vermas);
		?>
<br>


<?
} else {
	include ("../../incluidos/mensajenoseguridad.php");	
}
include ("../../incluidos/inferior.php");
include ("../../incluidos/cerrarconexion.php"); 
?>
</body>
</html>
