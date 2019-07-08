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
 Proceso inicial de facturacion
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
include("funciones.ingresos.php");
$rc4 = new rc4crypt();
$tabla="tblrecibos";
//$db->debug=true;
$border=0;
// proceso de refacturacion
$dsnit=$_REQUEST['dsnit']; // cliente enviado
$idreciboxx=$_REQUEST['idreciboxx'];
$idrecibox=$_REQUEST['idrecibox'];
$idrecibo=$_REQUEST['idrecibo'];// si existe este es para modificar
$idpedido=$_REQUEST['idpedido'];
$mensajeData="Paso 2. Editando Recibo de Caja $idrecibo";
$contar=count($idpedido);

if ($_REQUEST['inn']==2){
	// variables de carga
	$dsfechac=$_REQUEST['dsfechac'];// Fecha de creacion
	$dsvendedorx=$_REQUEST['dsvendedorx'];// Vendedor traido en caso que haya sido modificado
	// datos del cliente para ingresar en cada linea del recibo
	// traer los datos del cliente
	$sql="select dsnombres as dsrazon,dsidentificacion,dstelefono as dstele,dsdireccion,dsciudad";
	$sql.=" from tblclientes where dsidentificacion='$dsnit' limit 0,1";
	$result=$db->Execute($sql);
	if (!$result->EOF){
		$dsrazon=$result->fields[0];
		$dsnit=$result->fields[1];
		$dstele=$result->fields[2];
		$dsdir=$result->fields[3];
		$dsciudad=$result->fields[4];
		$idvendedor="";
	}
	$result->close();
	if ($dsvendedorx=="") $dsvendedorx=$idvendedor;
	//
	$dsfecha=$_REQUEST['dsanioc']."/".$_REQUEST['dsmesc']."/".$_REQUEST['dsdiac'];// Fecha de creacion
	$partir=explode("/",$dsfecha);
	$idfecha=$partir[0].$partir[1].$partir[2];
	$dsfechalarga=$dsfecha." ".date("h:i:s a");
}
// validaciones de datos
	
	// armando vector de campos
	// insertando
	if ($_REQUEST['inn']==2){
		$strSQL=" delete from ".$tabla." where dsnumero='$idrecibox' ";
		$db->Execute($strSQL);
		$idx=$_REQUEST['idx'];
		$dstxtbanco=$_REQUEST['dstxtbanco'];

		$contar=count($idx);
		$h=0;
		$dsbanco=$_REQUEST['dsbanco'];
		for ($j=0;$j<$contar;$j++){
			$idpedido=$_REQUEST['idpedido'][$j];
			$iddescripcion=$_REQUEST['iddescripcion'][$j];
			$dsvalor=$_REQUEST['dsvalor'][$j];
			$dscuentacontable=$_REQUEST['dscuentacontable'][$j];
			$dsnaturaleza=$_REQUEST['dsnaturaleza'][$j];

			if ($iddescripcion<>"" && $dsvalor<>"" && $dscuentacontable<>"") { 
				if ($iddescripcion==1){
					$sql=" update tblfacturase set idactivo=2";
					$sql.=",dsvendedor=$dsvendedorx";
					$sql.=",idusuariocreador=$dsvendedorx";
					$sql.=" where idpedido='$idpedido'"; // pagada
					// mysql_db_query($dbase,$sql,$db);
					$dscom="CANCELANDO FACTURA ".$idpedido;
				} elseif ($iddescripcion==2) {
					$sql="  update tblfacturase set idactivo=1";
					$sql.=",dsvendedor=$dsvendedorx";
					$sql.=",idusuariocreador=$dsvendedorx";
					$sql.=" where idpedido='$idpedido'"; // abonando
					// mysql_db_query($dbase,$sql,$db);
					$dscom="ABONANDO FACTURA ".$idpedido;
				} elseif ($iddescripcion==3) {
					$dscom=$_REQUEST['dscom'][$j];
				} elseif ($iddescripcion==4) {
					$dscom=$_REQUEST['dscom'][$j];
					$dscom="ANTICIPO PAGO";
				
				}

			// echo $sql."<br>";


				$sql=" insert into $tabla ";
				$sql.=" (";
				$sql.=" idanio,idmes,dsrazon";
				$sql.=" ,dsdir,dsciudad,dstele";
				$sql.=" ,dsnumero,dsmes,dsanulado_a";
				$sql.=" ,dsespera,dsnit,dsvendedor";
				$sql.=" ,dscuentacontable_b,dsfactura,iddescripcion";
				$sql.=" ,dsdescripcion,dscom,dsvalor,dscuentacontable";
				$sql.=" ,dsnaturaleza,dsanulado,dsfechalarga,dsfecha,idfecha,idpos,dsbanco,dstxtbanco";
				$sql.=" )";
				$sql.=" values ";
				$sql.=" (";
				$sql.=" ".$_REQUEST['dsanioc'].",".$_REQUEST['dsmesc'].",'$dsrazon'";
				$sql.=" ,'$dsdir','$dsciudad','$dstele'";
				$sql.=" ,'$idrecibox','".$_REQUEST['dsmesc']."','0'";
				$sql.=" ,'0','$dsnit','$dsvendedorx'";
				$sql.=" ,'$dscuentacontable_b','$idpedido',$iddescripcion";
				$sql.=" ,'$dsdescripcion','$dscom','$dsvalor','$dscuentacontable'";
				$sql.=" ,'$dsnaturaleza','0','$dsfechalarga','$dsfecha',$idfecha,$j,'$dsbanco','$dstxtbanco'";
				$sql.=" )";
//			echo $sql."<br>";
//exit();
				if ($db->Execute($sql)) $h++;
			}
		}	
		// listar datos del recibo de caja. Hasta que se imprima se puede realizar
		if ($h>0) { 
			$mensajes=" Recibo $idrecibox actualizado con exito";
			 $mensajes.=" <br>";
			  $mensajes.="<a class=formabot1 href=javascript:irAPaginaDN('ingresos.imprimir.html.php?idrecibo=$idrecibox','','');>Ver Recibo</a> &nbsp;|&nbsp;";
			 $mensajes.="<a href='ingresos.primer.paso.php' class=formabot1>Nuevo Recibo</a><br>";
		}
	}	


// consecutivo del pedido
if ($idrecibox=="") {
	$posdatos=8;
	$strSQL=" select dsnumero as t from ".$tabla."  order by dsnumero desc limit 0,1 ";
	// echo $strSQL;
	$result=$db->Execute($strSQL);
	if (!$result->EOF){
		$idrecibox=$result->fields[0];
		$idrecibox=$idrecibox+1;
	} else { 
		$idrecibox=1;
	}
	$result->Close();
}

if ($idrecibo<>"") $idrecibox=$idrecibo;

$ceros="";
for ($i=1;$i<=($posdatos-strlen($idrecibox));$i++) { 
	$ceros.="0";
}
$idreciboxx=$ceros.$idrecibox;
//if ($dsbanco=="") $dsbanco="11100504";
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
<? if ($val==2){?>
location.href="ingresos.segundo.paso.php?idpedido=<? echo $idpedido;?>&idrecibo=<? echo $idrecibo;?>";
<? } ?>
     // validacion acceso
    function valI(){
	if (document.u.idrecibox.value==""){
			alert("Por favor ingrese el numero de ingreso.");
			document.u.idrecibox.focus();
			return ;
     }
	 if (isNaN(document.u.idrecibox.value)){
			alert("El numero de recibo debe ser numerico.");
			document.u.idrecibox.focus();
			return ;
     }
	 if (document.u.idrecibox.value<=0){
			alert("El numero de recibo no puede ser menor o igual a cero.");
			documentu.idrecibox.focus();
			return;
     }


		 if (document.u.dsbanco.value==""){
			alert("digite el banco.");
			document.u.dsbanco.focus();
			return ;
		     }
 
	 
//	if (confirm('Esta seguro de procesar?','Este proceso se puede devolver si se mantiene en esta pantalla')==true) { 
	     document.u.submit();
//	}	else { 
//		return false;
//	} 
  }
//-->
</SCRIPT>

<table width="100%" border="<?echo $border?>"   cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">
<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1><?echo $mensajeData?></h1>
         	</td>
        </tr>
    </table>    
	
		<table width=90% align=center border="<?echo $border?>"   cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<form action="<? echo $pagina;?>" method=post name=u >
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  valign=top colspan="4">
		<p>Seleccione Tercero:</p>
		<p>
		<select name="dsnit" class="link_negro1">
		<option value="">...</option>
		<? combosfacturasp_editar($dsnit,$_SESSION['i_idempresa']);?>
		</select>
		</p>
		<!--input type="button" name="enviar" value="Cargar" class="formbt1" onClick="cargarrecibo();">
		<input type=button name=enviar value="Ver Perfil cliente" class="formbt1" onClick="cargarcliente('dsnit','<? echo $pagina?>');">
		<input type=button name=enviar value="Buscar" class="formbt1" onClick="irAPaginaDN('../terceros/default.php?cargarec=1&enca=1');" title="Click para imprimir "-->
		<a href="javascript:irAPaginaDN('../facturacion/default.php?enca=1','','');" class="textlink2">Ver facturas</a>
		<input type=hidden name=dsvendedorx value="">
		</td>
		<td  colspan=4 align=center>
		<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('default.php');">
		</td>
		</tr>
		</table>

	


<? if ($_REQUEST['enviar']=="Cargar") { 

		
$sql="Select ";
if ($idrecibo<>"") { 
	$sql.=" b.id,b.dsfactura as idpedido,b.dsvalor,b.dsnit ";	
} else { 
	$sql.=" a.id,a.idpedido,a.dstotal,a.idactivo,a.dsnit ";
}
$sql.=" from ";
if ($idrecibo<>"") { 
	 $sql.=" tblrecibos b ";
} else { 
	$sql.=" tblfacturase a";
}	 

$sql.="  where  1 ";

if ($_REQUEST['enviarx']=="Seleccionar y continuar" || $_REQUEST['enviarx']=="Guardar y Generar Recibo"){

	if($idrecibo<>"") { 
	$sql.=" and b.dsnumero=$idrecibo ";
	} else { 
		$sql.=" and  a.idpedido in (0";
		for ($j=0;$j<$contar;$j++){
			if ($_REQUEST['idpedido'][$j]<>"" && $_REQUEST['idpedido'][$j]<>"0") $sql.=",".$_REQUEST['idpedido'][$j];
			
		}
		$sql.=" )";
	}	
} elseif($idrecibo<>"") { 
	$sql.="and b.dsnumero=$idrecibo ";
} else { 
	$sql.=" and a.idactivo in ";
	$sql.="(";
	$sql.="0,1";	
	$sql.=")";
}	


if ($idrecibo=="") $sql.=" and a.dsnit='$dsnit'" ;
if ($idrecibo=="") { 
	$sql.=" order by a.idpedido asc ";
} elseif($idrecibo<>"") { 
	$sql.=" order by b.idpos asc ";
}	
$vermas=$db->Execute($sql);
if (!$vermas->EOF){
	$i=0;
	$totaldatos=$vermas;
	$color=$fondos[4];
	$colorx=$fondos[3];

	if ($idrecibo<>"") { 
			$sql="select dsbanco,idmes,idanio,dsfecha,dstxtbanco from tblrecibos where dsnumero='".$idrecibo."'";
			// echo $sql;
			$vermasr=$db->Execute($sql);
			if (!$vermasr->EOF){
				$dsbanco=$vermasr->fields[0];
				$dstxtbanco=$vermasr->fields[4];
				$idmes=$vermasr->fields[1];
				$idanio=$vermasr->fields[2];
				$dsfecha=$vermasr->fields[3];
				$partir=explode("/",$dsfecha);
				$iddia=$partir[2];
			} else { 
				$idmes=$_SESSION['i_dsanio'];
				$idanio=$_SESSION['i_dsmes'];
				$iddia=date("d");
			}
			$vermasr->Close();		
	}


		?>
			<br>
		
		<table width=90% align=center border="<?echo $border?>"  cellpadding=4 cellspacing=1 class="link_negro1" >
<tr bgcolor="<? echo $fondos[4];?>" >
		<td  class="textnegro2">
		<strong><p>Recibo Numero</p></strong></td>
		<td>
		<input type="text" name="idreciboxx" class="link_negro1" value="<? echo $idreciboxx;?>" maxlength="10" size="10" readonly onKeypress="moverfoco_1(1,'dsbanco',0)" >
<input type="hidden" name="idrecibox" class="link_negro1" value="<? echo $idrecibox;?>">
		<a href="javascript:irAPaginaDN('default.php?enca=1','','');" class="textlink2">Ver otros ingresos</a>

		</td>

		<td  class="textnegro2">
			<strong><p>Cuenta</p></strong></td>
		<td>
			<select name="dstxtbanco">
		<option value="BANCO" <? if ($dstxtbanco=="BANCO") echo "selected";?>>Banco</option>
		<option value="CAJA" <? if ($dstxtbanco=="CAJA") echo "selected";?>>Caja</option>
		<option value="PRESTAMO A SOCIOS" <? if ($dstxtbanco=="PRESTAMO A SOCIOS") echo "selected";?>>Prestamo a socios</option>
		<option value="CRUCE DE CUENTAS" <? if ($dstxtbanco=="CRUCE DE CUENTAS") echo "selected";?>>Cruce de cuentas</option>
		
		</select>

<input type="text" name="dsbanco" class="link_negro1" value="<? echo $dsbanco;?>" maxlength="20" size="20" onKeypress="moverfoco_1(1,'dsanioc',0)">
		</td>
			
			<td class="textnegro2">
		<strong><p>Fecha</p></strong></td>
		<td valign=top class="link_negro1">
<input type="text" name="dsanioc" class="link_negro1"  value="<? echo $_SESSION['i_dsanio'];?>" maxlength="4" size="2" readonly onKeypress="moverfoco_1(1,'dsmesc',0)" >
 /
<input type="text" name="dsmesc" class="link_negro1"  value="<? echo $_SESSION['i_dsmes'];?>" maxlength="2" size="1" onKeypress="moverfoco_1(1,'dsdiac',0)" >
/
<select name=dsdiac class="forma" onKeypress="moverfoco_1(2,'idpedido[]',0)" >
	<? for ($i=1;$i<=31;$i++) {
		$i1=$i;
		if ($i<10) $i1="0".$i;
		?>
	<option value="<? echo $i1?>" <? if ($i1==$iddia) echo selected?>><? echo $i1?></option>
	<? } ?>
	</select>



		</td>
			
		</tr>
</table>
<br>
		
		
<table width=90% align=center border="<?echo $border?>"  cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr bgcolor="<? echo $fondos[4];?>" align=center>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>FACTURA</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>DESCRIPCION</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>VALOR / SALDO</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>COMENTARIOS</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>CUENTA</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>NATURALEZA</p></strong></td>
		<td valign=top align="center" bgcolor="#DADFE4"><strong><p>ADD</p></strong></td>
		</tr>
<?
$x="130505";	
$dsnaturaleza=2;
$subdsvalor=0;
$i=0;
while(!$vermas->EOF) {
			
			// recibos de caja	
			$sql="select sum(dsvalor) as total from tblrecibos where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$vermas->fields[3]."' and dscuentacontable=$x ";
			$creditos=0;
			$vermasx=$db->Execute($sql);
			if (!$vermasx->EOF){
			$creditos=$vermasx->fields[0];
			}
			$vermasx->close();		
			// notas credito


			$sql="select sum(dsvalor) as total from tblnotasxcredito where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$dsnit."' and dscr=$x ";
			$creditosnc=0;
			$vermasc=$db->Execute($sql);
			if (!$vermasc->EOF){
			$creditosnc=$vermasc->fields[0];
			}
			$vermasc->close();		
			// depuracion de cartera
			$sql="select sum(dsvalor) as total from tbldepuracion_recibos where dsfactura='".$vermas->fields[1]."'";
			$sql.=" and dsnit='".$dsnit."' and dscuentacontable=$x  ";
			// echo $sql;
			$creditosdc=0;
			$vermasl=$db->Execute($sql);
			if (!$vermasl->EOF){
			$creditosdc=$vermasl->fields[0];
			if ($creditosdc=="") $creditosdc=0;
			}
			$vermasl->close();	


			$total=$vermas->fields[2]-$creditos-$creditosnc-$creditosdc;	
			
			
			// validar informacion si ya esta 
			if ($vermas->fields[1]<>"") { 
			$sql="select * from tblrecibos where dsnumero='$idrecibo' and dsfactura=".$vermas->fields[1]." and idpos=$i";
			} else { 
			$sql="select * from tblrecibos where dsnumero='$idrecibo' and dsfactura='' and idpos=$i ";	
			}
			$vermasy=$db->Execute($sql);
			if (!$vermasy->EOF){
				$total=$vermasy->fields[18];
				$dsnaturaleza=$vermasy->fields[20];
				$x=$vermasy->fields[19];
				$y=$vermasy->fields[15];
				$z=$vermasy->fields[17];
			} else { 
				if ($_REQUEST['dsvalor'][$i]<>"") $total=$_REQUEST['dsvalor'][$i];
				if ($_REQUEST['dsnaturaleza'][$i]<>"") $dsnaturaleza=$_REQUEST['dsnaturaleza'][$i];
				if ($_REQUEST['dscuentacontable'][$i]<>"") $x=$_REQUEST['dscuentacontable'][$i];
				if ($_REQUEST['iddescripcion'][$i]<>"") $y=$_REQUEST['iddescripcion'][$i];
				if ($y==3) {
					if ($_REQUEST['dscom'][$i]<>"") $z=$_REQUEST['dscom'][$i];
				}	
			}
			$vermasy->Close();	
			if ($dsnaturaleza==2) {	
				$subdsvalor=$subdsvalor+$total;
			} else { 
				$subdsvalor=$subdsvalor-$total;	
			}	

			
			
	if ($idrecibo=="") {
		include ("ingresos.editar.paso.panelnat2.php");
	} else { 
		if ($y=="3"){ 
			include ("ingresos.editar.paso.panelnat1.php");
		} else { 
			include ("ingresos.editar.paso.panelnat2.php");
		}
	}
	$i++;	
$vermas->MoveNext();
} // fin while
// totales
?>

<?
////
for ($j=0;$j<=3;$j++) {
		
	$total="";
	$dsnaturaleza=1;
	$x="";
	$z="";
	
		
		
		include ("ingresos.editar.paso.panelnat1.php");
	$i++;	
}
if ($_REQUEST['subdsvalor']<>"") $subdsvalor=$_REQUEST['subdsvalor'];
?>

<tr class=forma2  bgcolor="<? echo $color;?>" align="center" title="<? echo $mem;?>" onMouseOut="mOut(this,'<? echo $color;?>');" onMouseOver="mOvr(this,'<? echo $colorx;?>');">
		<td valign=top class="link_negro1">
		<strong>TOTALES</strong>
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">
		<input type='text' name="subdsvalor" class='imprimir_tit_datos_caja' size='10' maxlength=20 id="subdsvalor" value="<? echo $subdsvalor;?>" readonly>
		</td>
		<td valign=top class="link_negro1">&nbsp;
		
		</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		<td valign=top class="link_negro1">&nbsp;</td>
		</tr>


</table>


	<? 
}
$vermas->Close();
	
	} ?>

	<? if ($_REQUEST['enviar']=="Cargar") { ?>
		<br>
		<table width=90% align=center  border="<?echo $border?>"cellpadding=4 cellspacing=1 class="link_negro1" style="border-bottom:<? echo $fondos[20];?>" >
		<tr bgcolor="<? echo $fondos[4];?>" align=right>
		<td valign=top colspan=4 class="link_negro1" align=center>
		<input type=button name=enviary value="Guardar y Generar Recibo" class="botones" onClick="valI();" >
		<input type=hidden name=enviarx value="Guardar y Generar Recibo">
		<input type=hidden name=idusuariox value="<? echo $idusuariox?>">
		<input type=hidden name=inn value="2">
		<input type=hidden name=enviar value="<? echo $_REQUEST['enviar']?>">
		<input type=hidden name=idrecibo value="<? echo $_REQUEST['idrecibo']?>">
		<input type=button name=enviarx1 value="Regresar" class="botones" onClick="irAPaginaD('default.php');">
		</td>
		</tr>
		</form>
		</table>

<? } ?>	
</td>
		</tr>
	</table>
<br>

	
<?	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>
<script language="javascript">
<!--
function cargarrecibo(){
	location.href="<? echo $pagina?>?dsnit="+document.u.dsnit.value+"&enviar=Cargar";
}

function totales(){
var totales=0;
var x=0;
	for (i=0;i<document.u.elements['dsvalor[]'].length;i++){ 
		if (document.u.elements['dsvalor[]'][i].value!="") { 
			var x=eval(document.u.elements['dsvalor[]'][i].value);
			if (document.u.elements['dsnaturaleza[]'][i].value==2) { 
				totales=totales+x;
			} else if (document.u.elements['dsnaturaleza[]'][i].value==1) { 
				totales=totales-x;
			}
		}
	}	
	document.u.elements['subdsvalor'].value=totales;
}
//-->
</script>