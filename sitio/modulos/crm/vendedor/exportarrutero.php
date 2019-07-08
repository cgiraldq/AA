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
Rutero medico - Exportar
*/
//header("Content-type: application/octet-stream");
$nombre="exportarrutero_".$idciclo.".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
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
 <table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" border="1">
 <tr>
 <td align="left"><strong>Impresión de rutero</strong> - <? echo $mensaje2;?>, ciclo <? echo $dsciclo;?></td>
 <td align="right">&nbsp;<strong><? echo $_SESSION['i_dsnombre'];?></strong></td>
 </tr>
</table>
<?
// impresion dependiendo del opt
if ($opt==1 || $opt==2 || $opt==3){ 
?>
<?
		$strSQL="select a.id,a.dsobs,a.idr,a.dsfechaa,a.dshoraai,a.dshoraaf";
		$strSQL.=",b.dsnombre,";
		$strSQL.="b.dscomercial,";
		$strSQL.="a.idestado,";
		$strSQL.="a.idsact,a.dsfechac,a.dshorac";
		$strSQL.=" from ";
		$strSQL.=" $tabla a,";
		if ($opt==1){
			$strSQL.="tblclientes b ";		
		} elseif($opt==2){
		} elseif($opt==3){
		}
		$strSQL.=" where b.idactivo=1 ";
		$strSQL.=" and a.idcliente=b.id ";
		$strSQL.=" and a.idciclo=".$idciclo;
		$strSQL.=" and a.iddia=".$diaciclo;
		$strSQL.=" and a.idusuario=".$_SESSION['i_idusuario'];
		$strSQL.=" and a.idcanal=".$opt;
		$strSQL.=" order by dsnombre ASC ";
		// echo $strSQL;
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		 if(mysql_affected_rows()>0){
		 ?>
		 <table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" border="1">
		 <tr align="center" bgcolor="<? echo $fondos[3];?>">
	<td align="center">Fecha Actividad / Hora</td>
		 <td align="left"><? echo $mensaje2;?></td>
		 <td align="left">Actividad</td>		 
		 <td align="left">Resultado</td>
 		 <td align="left">Observaciones</td>
		 </tr>
		 <?
				while ($fila=mysql_fetch_object($vermas)){
					?>
				
					 <tr align="center" bgcolor="<? echo $fondos[3];?>">
					<td align="center" valign="top">
					 <? echo formatfecha($fila->dsfechaa);?><br />
					 <? echo $fila->dshoraai?> - <? echo $fila->dshoraaf?>
					 <? if ($fila->dsfechac<>"") { ?>
					 <br>
					 <font color="<? echo $fondos[6];?>">
					 <? echo "Próximo Compromiso: ".$fila->dsfechac;?> <br />
					<? echo $fila->dshorac?>
					 </font>	
					 <? } ?>
					 </td>
					 <td align="left" valign="top"><strong>
					 <? echo $fila->dsnombre;?>&nbsp;
					  <? if ($opt==1){ 
							echo $fila->dscomercial;
						} elseif ($opt==2 || $opt==3){ 
						}
						 ?>
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
}
?>
<?
include ("../../incluidos/cerrarconexion.php"); 
?>
