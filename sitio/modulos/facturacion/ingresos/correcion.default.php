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
Principal Recibos de caja
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$dsm="Ingresos";
include ("../../incluidos/seguridad.php");
// mensajes de recuperacion de claves
$tabla="tblrecibos";
	$codigos[0]="dsfactura";
	$codigos[1]="dsvalor";
	$codigos[2]="dsnumero";
	$codigos[3]="dsrazon";
	$codigos[4]="dsnit";
	$codigos[5]="dstele";
	$codigos[6]="dsbanco";
	//
	$nombres[0]="Factura";
	$nombres[1]="Valor";
	$nombres[2]="Nro Recibo";
	$nombres[3]="Tercero";
	$nombres[4]="NIT";
	$nombres[5]="Telefono";
	$nombres[6]="Banco";


if ($_REQUEST['enviar']=="Modificar"){
 		$contar=count($_REQUEST['id']);
			$v=0;
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "dsfecha='".$_REQUEST['dsfecha'][$j]."'";
					$sqlm.= ",idfecha=".$_REQUEST['idfecha'][$j]."";
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					// echo $sqlm."<br>";
					// exit();
					if (mysql_db_query($dbase,$sqlm,$db)) $v++;
				} // fin si
			} // fin for
			if ($v>0) $Mensaje="Modificación realizada con éxito ".$mensajeData;	
	} // fin inn


$idaniox=$_REQUEST['idaniox'];
if ($idaniox=="") $idaniox=$_SESSION['i_dsanio'];
$idmesx=$_REQUEST['idmesx'];
if ($idmesx=="") $idmesx=$_SESSION['i_dsmes'];

$dsvendedor=$_REQUEST['dsvendedor'];
// armando campos
?>
<html>
<head>
	<title><? echo $AppNombre;?> Administración: Recibos de caja</title>
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
<a name="med"></a>
		<table width="100%" cellspacing="0" cellpadding="1" class=forma2 ID="Table2">
			<tr bgcolor="<? echo $fondos[5];?>">
					<td valign=top align=left>
					<font class="textnegrotit">Listado de recibos de caja</font>					</td>
					
					<td valign=top align=right>
					<a href="../administrador/utilidades.php" title="Click para ver " class="link11"><font class="formbt1"><strong>Regresar</strong></font></a> 
|					
</td>
					
			</tr>
		</table>
			<?
// parametro adicional en caso que se lista por empresa
	$strSQL="select c.id,";
	$strSQL.="c.idanio,c.idmes,c.dsrazon,c.dsdir,c.dstele,c.dsciudad,c.dsnumero,c.dsfecha,c.dsbanco,c.dsnit ";
	$strSQL.=",c.dsvendedor ";
	$strSQL.=" from $tabla c ";
	$strSQL.=" where c.id>0 and LENGTH( IDFECHA ) <8";
	$strSQL.=" order by  c.dsnumero desc ";
//	 echo $strSQL;
//	 exit();
	 // pintando cabecera de datos
	$vermas=mysql_db_query($dbase,$strSQL,$db);

?>
<br>
			<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed" bgcolor="<? echo $fondos[3]?>">
			<tr class="text" bgcolor="<? echo $fondos[21];?>" align="center">
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco"><strong>Numero</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>Fecha</strong></td>
			<td background="../../img/titu_fondo.jpg" bgcolor="#DADFE4" class="text_blanco" ><strong>idFecha</strong></td>
			<td background="../../img/fondo3.jpg" bgcolor="#FCF5DB" class="textnegrotit1">::Opciones::</td>
			</tr>
</table>
	<form action="<? echo $pagina;?>" method="post" name="u<? echo $fila->idpedido?>"> 				

		<? 
		if (mysql_num_rows($vermas)>0){
		$totalvalor=0;
			while($fila=mysql_fetch_object($vermas)) {
			$color=$fondos[4];
			$colorx=$fondos[10];
			
			// el calculo se hace de acuerdo a la naturaleza
			
		// organizacion de fechas
			$partir=explode("/",$fila->dsfecha);
			$anio=$partir[0];
			$mes=$partir[1];
			$dia=$partir[2];
			if (strlen($fila->dsfecha)<10) { 
				if (strlen($mes)<2) $mes="0".$mes;
				if (strlen($dia)<2) $dia="0".$dia;
			}
			$dsfecha=$anio."/".$mes."/".$dia;
			$idfecha=$anio.$mes.$dia;



					?>
<table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed">					
		<tr class=forma2 bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');" onClick="mOut(this,'<? echo $colorx;?>');">		
		<td align="center" bgcolor="<? echo $fondos[12]?>" class="link_negro1"><? echo $fila->dsnumero;?></td>
		<td class="link_negro1" ><? echo $fila->dsfecha?><input type=text name="dsfecha[]" value="<? echo $dsfecha;?>"></td>
		<td class="link_negro1" ><? echo $fila->idfecha?><input type=text name="idfecha[]" value="<? echo $idfecha;?>"></td>
<td nowrap class="link_negro1"> 
<input type=button name=enviar value="VER" class="formbt2" onClick="irAPaginaD('../ingresos/ingresos.tercer.paso.php?idrecibo=<? echo $fila->dsnumero;?>&no=1');" title="Click para ver el recibo">
<? if ($_SESSION['i_dsmes']==$fila->idmes) { ?>
<input type=button name=enviar value="EDITAR" class="formbt2" onClick="irAPaginaD('../ingresos/ingresos.editar.paso.php?idrecibo=<? echo $fila->dsnumero;?>&enviar=Cargar&dsnit=<? echo $fila->dsnit?>');" title="Click para editar el recibo">
<? } ?>






	 <input type=hidden name="id[]" value="<? echo $fila->id;?>" >
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
