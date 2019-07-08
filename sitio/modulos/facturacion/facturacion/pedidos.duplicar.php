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
 Plantilla de pedido externo
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
include ("../../incluidos/func.calendario_2.php"); // funcion nueva del calendario
$tabla="tblfpedidose";
// proceso de refacturacion
$mensajeData="Duplicar pedido externo";
$filasdatos=30; // datos del ciclo
// consecutivo
$idpedido=$_REQUEST['idpedido'];
$idpedidox=$_REQUEST['idpedidox'];
$inn=$_REQUEST['inn'];
$mod=$_REQUEST['mod'];
if ($inn<>"") { 
	$idcliente=$_REQUEST['idcliente']; // id del cliente
	if ($idcliente=="") {  // validar que haya ingresado los datos
		$tablabase="tblclientes"; // tabla base para ingresos nuevo
		include ("../../incluidos/cliente.nuevo.dato.php");
	}
	$dsfechac=$_REQUEST['dsfechac'];// Fecha de creacion
	$partir=explode("/",$dsfechac);
	$idfechac=$partir[0].$partir[1].$partir[2];
	
	$dsfechae=$_REQUEST['dsfechae'];// Fecha de entrada
	$partir=explode("/",$dsfechae);
	$idfechae=$partir[0].$partir[1].$partir[2];
	
	//
	
	$dsfechas=$_REQUEST['dsfechas'];// Fecha de salida
	$partir=explode("/",$dsfechas);
	$idfechas=$partir[0].$partir[1].$partir[2];
	
	
	$dsvendedor=$_REQUEST['dsvendedor'];
	$dsobs=$_REQUEST['dsobs']; // codigo de producto
	$dsorden=$_REQUEST['dsorden']; // codigo central de datos
	$dssubtotal=$_REQUEST['subtotalvalor']; // subtotal	
	$dsiva=$_REQUEST['totaliva']; // total iva
	$dstotal=$_REQUEST['totalvalor']; // total
	// validar si existe..Si existe que actualice 
	$sql="select * from $tabla where idpedido='$idpedido'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$sql=" update $tabla set ";
		$sql.="dsfechac='$dsfechac'";
		$sql.=",idfechac='$idfechac'";
		$sql.=",dsfechae='$dsfechae'";
		$sql.=",idfechae='$idfechae'";
		
		$sql.=",dsfechas='$dsfechas'";
		$sql.=",idfechas='$idfechas'";
		$sql.=",dsobs='$dsobs'";
		$sql.=",dsorden='$dsorden'";
		$sql.=",idcliente='$idcliente'";
		$sql.=",dssubtotal='$dssubtotal'";		
		$sql.=",dsiva='$dsiva'";
		$sql.=",dstotal='$dstotal'";		
		$sql.=" where idpedido='$idpedido'";
		if (mysql_db_query($dbase,$sql,$db)) $Mensaje=" Orden de trabajo para $dsobs actualizada";
	} else { 
		$sql=" insert into $tabla ";
		$sql.=" (";
		$sql.="id,idpedido,idorden";
		$sql.=",idusuario,idcliente,dsobs";
		$sql.=",dsorden,dsfechac,idfechac,idusuariocreador,dsvendedor";
		$sql.=",dsfechae,idfechae,dsfechas,idfechas";
		$sql.=",dssubtotal,dsiva,dstotal";		
		$sql.=" ) values (";
		$sql.="'','$idpedido','$idorden'";
		$sql.=",'".$_SESSION['i_idusuario']."','$idcliente','$dsobs'";
		$sql.=",'$dsorden','$dsfechac','$idfechac','".$dsvendedor."'";		
		$sql.=",'$dsvendedor'";		
		$sql.=",'$dsfechae','$idfechae','$dsfechas','$idfechas'";
		$sql.=",'$dssubtotal','$dsiva','$dstotal'";				
		$sql.=" )";
		if (mysql_db_query($dbase,$sql,$db)) $Mensaje=" Orden de trabajo interna para $dsobs ingresada";
	}

	mysql_free_result($vermas);
	////////////// DATOS A LA TABLA AUXILIAR /////////////////////////////////
	$sql="delete from tblfpedidosc where dspedido='$idpedido' ";
	mysql_db_query($dbase,$sql,$db);
	$dsref=$_REQUEST['dsref'];
	$contar=count($dsref);
	if ($dsref>0) { 
	$h=0;
		for ($j=0;$j<$contar;$j++){
			if ($_REQUEST['peso'][$j]<>"" && $_REQUEST['peso'][$j]<>"0") {
				$sql="insert into tblfpedidosc  ";
				$sql.=" (";
				$sql.="idc,dspedido,idproducto";
				$sql.=",dsref,dscant,dsunidad,dsvalor,dssubtotal,idpos";
				$sql.=",dsdesc) values (";
				$sql.="'','$idpedido',''";
				$sql.=",'".$_REQUEST['dsref'][$j]."',";
				$sql.="'".$_REQUEST['dscant'][$j]."'";
				$sql.=",'".$_REQUEST['dsun'][$j]."'";
				$sql.=",'".$_REQUEST['dsvalor'][$j]."'";
				$sql.=",'".$_REQUEST['dssubtotal'][$j]."'";
				$sql.=",'".$_REQUEST['idpos'][$j]."'";
				$sql.=",'".$_REQUEST['dsdesc'][$j]."'";
				$sql.=" )";
				if (mysql_db_query($dbase,$sql,$db)) $h++;
			}
		}
	}
	////////////// FIN DATOS A LA TABLA AUXILIAR DE COLORES /////////////////////////////
	if ($h>0) $Mensaje.=", junto con sus referencias asociadas";
	$mod=1;
}
if ($inn<>"") { 
	$idpedido=ultimadata("idpedido",$tabla);
}elseif ($idpedido=="") {
	$idpedido=ultimadata("idpedido",$tabla);
	$des="";
} else { 
	$des="";
}	
$ceros="";
for ($i=1;$i<=(6-strlen($idpedido));$i++) { 
	$ceros.="0";
}
$idpedidoxx=$ceros.$idpedido;
if ($idpedido<>"") { 
	// traer los datos de la tabla
	$sql="select * from $tabla where idpedido='$idpedidox'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$fila=mysql_fetch_object($vermas);
		$idcliente=$fila->idcliente;
		$dsfechac=$fila->dsfechac;
		
		$dsobs=$fila->dsobs;
		$dsvendedor=$fila->dsvendedor;
		$dsfechae=$fila->dsfechae;
		$dsfechas=$fila->dsfechas;
		$dsorden=$fila->dsorden;		
		
		$dssubtotal=$fila->dssubtotal;		
		$dsiva=$fila->dsiva;		
		$dstotal=$fila->dstotal;		
	} else { 
		$idcliente="";
		$dsfechac=$fechaBase;
		$dsfechae=$fechaBase;
		$dsobs="";
		$dsvendedor="";
		$dsorden="";
		
		$dssubtotal="";		
		$dsiva="";		
		$dstotal="";		
	}
	mysql_free_result($vermas);
}

?>
<html>
<head>
<title><? echo $AppNombre;?> Planilla pedido externo</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilo.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<script language="javascript" src="../../incluidos/ajax.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.dsfechac.value==""){
			alert("Por favor ingrese la fecha de creación");
			document.u.dsfechac.focus();
			return;
     }


	if (document.u.dsfechae.value==""){
			alert("Por favor ingrese la fecha de entrada");
			document.u.dsfechae.focus();
			return;
     }
	
	
	if (document.u.dsfechas.value==""){
			alert("Por favor ingrese la fecha de creación");
			document.u.dsfechas.focus();
			return;
     }

	document.u.submit();
 }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? //  include ("../../incluidos/encabezado.php");?>
<? include ("../../incluidos/resultoperaciones.php");?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
		<table width=100% align=center  cellpadding=4 cellspacing=1 style="border-bottom:<? echo $fondos[20];?>" >
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="link_negro1"align="right">
			  	<input type=button name=enviar value="Regresar" class="formbt2" onClick="irAPaginaD('default.php');">
				</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top class="link_negro1">
		Orden de pedido  Nro.
		</td>
		<td valign=top class="link_negro1">
			<input type="text" name="idpedidox1" class="link_negro1"value="<? echo $idpedidoxx;?>" maxlength="10" size="10">
		<input type="hidden" name="idpedido" value="<? echo $idpedido;?>">
		</td>
		
		
		<td valign=top class="link_negro1">
		Fecha		</td>
		<td valign=top class="link_negro1">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechae', this);" language="javaScript">			
		
<input type="text" name="dsfechae" class="link_negro1"value="<? echo $dsfechae;?>" maxlength="10" size="10">



		</td>
		</tr>		
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		
		<td valign=top class="link_negro1">Observaciones</td>
		<td valign=top class="link_negro1">
<input type="text" name="dsobs" class="link_negro1"value="<? echo $dsobs;?>" size="45" maxlength="100">

		</td>
		
		<td valign=top class="link_negro1">
		Fecha de despacho </td>
		<td valign=top class="link_negro1">
<img align="absmiddle" SRC="../../temas/iconos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechas', this);" language="javaScript">			
		
<input type="text" name="dsfechas" class="link_negro1"value="<? echo $dsfechas;?>" maxlength="10" size="10">

</td>
</tr>

<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top class="link_negro1">
		Orden del cliente
		</td>
		<td valign=top class="link_negro1">
<input type="text" name="dsorden" class="link_negro1"value="<? echo $dsorden;?>" maxlength="10" size="10">


		<td valign=top class="link_negro1">
		VENDEDOR
		</td>
		<td valign=top class="link_negro1">
<select name="dsvendedor" class="link_negro1">
	<option value=""></option>
	<? combosusuarios($dsvendedor,$_SESSION['i_idempresa']);?>
</select>


</td>


		
</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top class="link_negro1"colspan="6">
		Tercero:
<br>
		<select name="idcliente" class="link_negro1">
		<option value="">...</option>
		<? combosclientesp($idcliente,$_SESSION['i_idempresa']);?>
		</select>

<input type=button name=enviar value="Nuevo" class="formbt2" onClick="capacliente('capaclientebase',1)">
			</td>
		</tr>
			<tr bgcolor="<? echo $fondos[4];?>" id="capaclientebase" style="display:none">
		<td valign=top class="link_negro1"colspan="4"   >
		<?
		$capa="capaclientebase";
		$retenciones=""; // carga campos de retencion
		include ("../../incluidos/cliente.nuevo.php")?>
		</td>
		</tr>
		
		
</table>
<? //////////////////////////////////////// CUERPO CENTRAL ///////////////////////////////?>		
<br>
		<table width=95% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
<td valign=top class="formabot1" width="5%">&nbsp;</td>		
<td valign=top class="formabot1" width="10%">REFERENCIA</td>
<td valign=top class="formabot1" width="10%">UNIDAD</td>
<td valign=top class="formabot1">DESCRIPCION</td>
<td valign=top class="formabot1" width="10%">VALOR</td>
<td valign=top class="formabot1" width="10%">CANTIDAD</td>
<td valign=top class="formabot1" width="20%">SUBTOTAL</td>
		</tr>
</table>
<?
$totales=0;
for ($i=0;$i<=$filasdatos;$i++) { ?>
 <?
	$sql="select a.* ";
	$sql.=" from tblfpedidosc a ";
	$sql.="  where a.dspedido='$idpedidox' and idpos='$i'";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
		$fila=mysql_fetch_object($vermas);
		$totales=$totales+$fila->dscant;
		$dsref=$fila->dsref;
		$dscant=$fila->dscant;
		$dsun=$fila->dsun;
		$dsvalor=$fila->dsvalor;
		$dsdesc=$fila->dsdesc;
		$dssubtotalx=$fila->dssubtotal;
		$idproducto=$fila->idproducto;
	} else { 
		$dsref="";
		$idproducto="";
		$dscant="";
		$dsun="";
		$dsvalor="";
		$dsdesc="";
		$dssubtotalx="";		
	}
	mysql_free_result($vermas);
if ($mod=="")	 { 
	if ($i<6) { 
		$sd="";
	} else { 
		$sd="none";
	}	
} else { 
	
}	
		?>
 <div id="capaprod_<? echo $i;?>" style="display:<? echo $sd;?>">
<table width=95% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[12];?>"  style='table-layout:fixed'>
<tr class='text' bgcolor='<? echo $fondos[3];?>' align=center>
<td width="5%"><input type=button class="textnegrotit" value='-' name='enviar' onClick='quitarcapa(<? echo $i;?>)' title="Quitar"></td>
<td width="10%"><? // echo $fila->idproducto;?><input type='text' name="dsref[]" class='forma2' value='<? echo $dsref?>' size='10' maxlength=100 id="dsref[]">
</td>
<td width="10%"><? // echo $fila->idproducto;?><input type='text' name="dsun[]" class='forma2' value='<? echo $dsdesc?>' size='5' maxlength=10 id="dsun[]" onBlur="validarvalor(<? echo $i?>);">
</td>

<td><? // echo $fila->idproducto;?><input type='text' name="dsdesc[]" class='forma2' value='<? echo $dsdesc?>' size='45' maxlength=255 id="dsdesc[]">
</td>

<td width="10%"><? // echo $fila->idproducto;?><input type='text' name="dsvalor[]" class='forma2' value='<? echo $dsvalor?>' size='10' maxlength=10 id="dsvalor[]">
</td>


<td width="10%"><? // echo $fila->idproducto;?><input type='text' name="dscant[]" class='forma2' value='<? echo $dscant?>' size='10' maxlength=10 id="dscant[]" onBlur="calcularsubtotal(<? echo $i?>);">
</td>


<td width="20%"><input type='text' name='dssubtotal[]' class='forma2' value='<? echo $dssubtotalx;?>' size='20' maxlength=20 onKeyPress="mostrarcapa(<? echo ($i+1);?>,event)" id='dssubtotal[]'>

<input type='hidden' name='idpos[]' class='forma2' value='<? echo $i;?>' id='idpos[]'>

</td>
</td>
	</tr>
	</table>
	</div>
	<? 	} // FIN FOR?>

<? //////////////////////////////////////// FIN CUERPO CENTRAL ///////////////////////////////?>				
<br>

		<table width=95% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
<td valign=top class="formabot1">SUBTOTAL</td>
		<td valign=top class="formabot1"><input type="text" name="subtotalvalor" class="link_negro1"value="<? echo $dssubtotal;?>"></td>
		<td valign=top class="formabot1">IVA</td>
		<td valign=top class="formabot1"><input type="text" name="totaliva" class="link_negro1"value="<? echo $dsiva;?>"></td>
		

		<td valign=top class="formabot1">TOTAL</td>
		<td valign=top class="formabot1"><input type="text" name="totalvalor" class="link_negro1"value="<? echo $dstotal;?>"></td>

		
		</tr>
</table>

<br>

<table width=95% align=center  cellpadding=4 cellspacing=1 style="border-bottom:<? echo $fondos[20];?>" >

		<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=4 class="link_negro1"align="right">
				<input type=button name=enviar value="Ingresar" class="formbt2" onClick="valI();" >
				<input type=hidden name=inn value="1">
				<input type=hidden name=mod value="<? echo $mod;?>">
				<input type=button name=enviar value="Regresar" class="formbt2" onClick="irAPaginaD('default.php');">	
				<input type="hidden" name="dsfechac" value="<? echo $dsfechac;?>" >


</td>
		</tr>
	</table>
</form>	
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
</body>
</html>
<script language="javascript">
<!--
function mostrarcapa(valorx,e){
	var key=window.event.keyCode;
	if (key!=13) { 
	} else { 
		  var content = document.getElementById('capaprod_'+valorx);
		  if (content) { 
			content.style.display="";
			for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
				if (i==valorx) { 
				document.u.elements['dsref[]'][i].focus();
				break;
				}
			}
		  }
	} 
	totales();
}

 function quitarcapa(div){
	var d = document.getElementById('capaprod_' + div);
	if (d) d.style.display="none";
  }


// crear capa basandose en el tipo de producto + presentacion
function validarvalor(pos){	
    // Div donde se agregara la nueva linea
	
	for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
		if (i==pos) { 
		var ref=document.u.elements['dsref[]'][i].value;
		var un=document.u.elements['dsun[]'][i].value;
		break;
		}
	}
	if (ref!="" && un!=""){
		conexion=AjaxObj();
		 conexion.open("POST","pedidos.cargardatos.php?dsref="+ref+"&dsun="+un,true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					if (_resultado!="") { 
						partir=_resultado.split("|");
						for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
							if (i==pos) { 
							document.u.elements['dsdesc[]'][i].value=partir[0];
							document.u.elements['dsvalor[]'][i].value=partir[1];
							break;
							}
						}
						
					}
	        } // fin conexion
	      } // fin funcion conexion interna
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	} // fin valorbase
}
// fin crear capa
function totales(){
	// vector valor
	var total=0;
	var subtotal=0;
	var iva=0;
	for (i=0;i<document.u.elements['dscant[]'].length;i++){ 
		if(document.u.elements['dscant[]'][i].value==""){
		} else { 
			var x=document.u.elements['dsvalor[]'][i].value;
			var y=document.u.elements['dscant[]'][i].value;
			var ivax=(x*y)*0.16;
			var z=x*y;
			
	    	var valorbase=z;	
			subtotal=subtotal+valorbase;
			iva=iva+ivax;
		}	
	} 
	document.u.subtotalvalor.value=subtotal.toFixed(0);
	document.u.totaliva.value=iva.toFixed(0);
	totalx=iva+subtotal;
	document.u.totalvalor.value=totalx.toFixed(0);
	
}  

function calcularsubtotal(pos){
	for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
		if (i==pos) { 
		var x=document.u.elements['dsvalor[]'][i].value;
		var y=document.u.elements['dscant[]'][i].value;
		var z=x*y
		document.u.elements['dssubtotal[]'][i].value=z.toFixed(0);
		document.u.elements['dssubtotal[]'][i].focus();
		break;
		}
	}	
}

//-->
</script>

<? include ("../../incluidos/cerrarconexion.php"); ?>
