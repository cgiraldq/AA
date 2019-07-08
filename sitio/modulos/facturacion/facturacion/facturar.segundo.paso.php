<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2008
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Seleccionar producto o seleccionar proyectos asociados al cliente
*/
include ("../sessiones.php");
include ("../../incluidos/creditos.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");
$tabla="tblfacturasc";
$idcliente=$_REQUEST['idcliente'];
$idpedido=$_REQUEST['idpedido'];
$idusuariox=$_REQUEST['idusuariox'];
$mod=$_REQUEST['mod']; // estado de modificar
if ($_REQUEST['inn']==1){
	// variables de carga
	$dsobs=$_REQUEST['dsobs'];// concepto
	$dsobsfinal=$_REQUEST['dsobsfinal'];// Adicionales
	$idplazo=$_REQUEST['idplazo'];// plazo
	if ($idplazo=="") $idplazo=0;
	$dscontacto=$_REQUEST['dscontacto'];// contacto
	$idactivo=0; // EN PROCESO AUN
	// actualizar la tabalde facturas
$sql="update tblfacturase set ";
$sql.=" dsobsfinal='$dsobsfinal',dsobs='$dsobs',idactivo=$idactivo,";
$sql.="idplazo=$idplazo,dscontacto='$dscontacto'";
$sql.="  where idpedido=".$idpedido;
mysql_db_query($dbase,$sql,$db);
	
	

	// datos de cliente en caso de no estar en la base de datos
	$totalcampos=$_REQUEST['totalcampos']; // total campos para generar
	$sql="delete from tblfacturasc  where dspedido=".$idpedido;
	//	echo $sql;
	mysql_db_query($dbase,$sql,$db);
	$h=0;
	$contar=count($_REQUEST['idproducto']);
	for ($j=0;$j<$contar;$j++){	
		if ($_REQUEST['idproducto'][$j]<>"" && $_REQUEST['idcant'][$j]<>"" && $_REQUEST['idvalor1'][$j]){ 
				// productos
				$sql=" insert into tblfacturasc ";
				$sql.=" (idc,dspedido,idproducto,idproyecto";
				$sql.=",idvalorproyecto,idpos,idcant,dsunidad,dsdesc";
				$sql.=",idvalor1,idvalor2,idvalor3,idimp,iddesc)";
				$sql.="  values ";
				$sql.=" ('',$idpedido,".$_REQUEST['idproducto'][$j].",0";
				$sql.=" ,0,0,".$_REQUEST['idcant'][$j].",'".$_REQUEST['dsunidad'][$j]."','".$_REQUEST['dsdesc'][$j]."',".$_REQUEST['idvalor1'][$j];
				$sql.=",0,0,".$_REQUEST['idimp'][$j].",".$_REQUEST['iddesc'][$j].")";			
			if (mysql_db_query($dbase,$sql,$db)) $h++;
		}	// fin idproducto
	}
	// fin datos del cliente
	//exit();
	if ($h>0) $val=2;
	
}
// validaciones de datos
	$mensajeData="Paso 2. Seleccionar productos para la factura Nro. $idpedido";
	// armando vector de campos
	// insertando
?>
<html>
<head>
<title><? echo $AppNombre;?> Facturacion: Seleccionando productos</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">	
<? include ("../../incluidos/javageneral.php"); ?>
<script language="javascript" src="../../incluidos/ajax.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

<!--
<? if ($val==2){?>
location.href="facturar.tercer.paso.php?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>";
<? } ?>
     // validacion acceso
    function valI(){
	
	if (document.u.dsobs.value==""){
		alert("Ingrese las observaciones generales");
		return false;
	}

	if (document.u.dsobsfinal.value==""){
		alert("Ingrese las observaciones finales");
		document.u.dsobsfinal.focus();
		return false;
	}
	 return true;
  }
//-->
</SCRIPT>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
<? include ("../../incluidos/encabezado.php");?>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
<td valign=top colspan=2 bgcolor="<? echo $fondos[3];?>" class="textnegrotit"> <? echo $mensajeData;?></td>
		</tr>
	</table>
<? include ("../../incluidos/resultoperaciones.php"); ?>	
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">
		<form action="<? echo $pagina;?>" method=post name=u onSubmit="return valI();">
		
		
		
			<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=7 class="forma2" align="left">
			CLIENTE:			
			<strong><? echo seldato("dsnombre","id","tblclientes",$idcliente,1); ?></strong>
			
</td>
		</tr>
		
			<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=7 class="forma1" align="left">
			<strong>Seleccione producto:</strong>			
			<br>

		<?	
			$sql=" select * from tblproductos order by dsp asc ";
		$campo=0;
		$vermas=mysql_db_query($dbase,$sql,$db);
		if (mysql_num_rows($vermas)>0) { 
			?>
			<select name="dsprod" class="forma2">
			<?
			while($fila=mysql_fetch_object($vermas)) {
			?>
			<option value="<? echo $fila->id?>"><? echo $fila->dsref?> / <? echo $fila->dsp?></option>
			<?
			}
			?>
			</select>
			<input type="button" name="enviar" value="Adicionar" class="formabot1" onClick="add(0);">
			<?
		}
		mysql_free_result($vermas)	;
			?>
			
</td>
		</tr>

</table>
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
<td valign=top class="formabot1" width="10%" ><a href="javascript:irAPaginaDN('../productos/default.php?enca=1','','');">Referencias</a></td>
		<td valign=top class="formabot1">Descripcion</td>
		<td valign=top class="formabot1">Unidad</td>
		<td valign=top class="formabot1">Valor</td>
		<td valign=top class="formabot1" width="8%">Cantidad</td>		
		<td valign=top class="formabot1" width="10%">Impuestos</td>
		<td valign=top class="formabot1" width="10%">Descuento</td>
		<td valign=top class="formabot1" width="10%">Sub total</td>
		<td valign=top class="formabot1" width="8%">Opcion</td>
		</tr>
</table>
 <div id="capaprod"></div>
		<br>

		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
		<tr bgcolor="<? echo $fondos[4];?>" align="center">
<td valign=top class="formabot1" width="10%" >TOTALES</td>
		<td valign=top class="formabot1">&nbsp;</td>
		<td valign=top class="formabot1">&nbsp;</td>
		<td valign=top class="formabot1"><input type="text" class="forma2" name="totalvalor" size="10"></td>
		<td valign=top class="formabot1" width="8%"><input type="text" class="forma2" name="totalcantidad" size="5"></td>		
		<td valign=top class="formabot1" width="10%"><input type="text" class="forma2" name="totalimpuestos" size="10"></td>
		<td valign=top class="formabot1" width="10%"><input type="text" class="forma2" name="totaldescuentos" size="10"></td>
		<td valign=top class="formabot1" width="10%"><input type="text" class="forma2" name="totalsubtotal" size="10"></td>
		<td valign=top class="formabot1" width="8%">&nbsp;</td>
		</tr>
</table>		
	<br>
	
		<table width=100% align=center  cellpadding=4 cellspacing=1 bgcolor="<? echo $fondos[4];?>"  style="table-layout:fixed">		
		
		
			<?
			// listar las observaciones finales del pedido
			
			$sql="select dsobsfinal,dsobs,idusuario,dscontacto";
			$sql.=" from tblfacturase  where idpedido=".$idpedido;
			$vermasx=mysql_db_query($dbase,$sql,$db);
			//echo $sql;
			if (mysql_num_rows($vermasx)==1) { 
				$dsobsfinal=mysql_result($vermasx,"0","dsobsfinal");
				$dsobs=mysql_result($vermasx,"0","dsobs");
				$idusuario=mysql_result($vermasx,"0","idusuario");
				$dscontacto=mysql_result($vermasx,"0","dscontacto");
			}
			mysql_free_result($vermasx);
			
			if ($dsobsfinal=="" && $dsobs=="") {		
				// traer las ultimas observaciones
				$sql="select dsobsfinal,dsobs,idusuario from tblfacturase ";
				$sql.=" where idpedido<>$idpedido ";
				$sql.=" and dsobsfinal is not null order by id desc limit 0,1";
				$vermasxx=mysql_db_query($dbase,$sql,$db);
				if (mysql_num_rows($vermasxx)==1) {
					$dsobs=mysql_result($vermasxx,"0","dsobs");
				}
				mysql_free_result($vermasxx);
			}
			?>
		
			<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=3 class="forma2" align="left">
			<strong>CONCEPTO</strong><BR>
			<textarea name="dsobs" class="forma2" cols="60" rows="5"><? echo $dsobs;?></textarea>
			<td valign=top colspan=4 class="forma2" align="left">
			<strong>ADICIONALES</strong>
			/ CONDICIONES DE PAGO <BR>
			<?
			if ($dsobsfinal==""){
				$dsobsfinal=trim(seldato("dsobs","id","tblusuariose",$idusuariox,1));
			}	
				?>
<textarea name="dsobsfinal" class="forma2" cols="60" rows="5"><? echo $dsobsfinal;?></textarea>
			</td>
</td>
		</tr>
		
		
			<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=3 class="forma2" align="left">
			<strong>CONTACTO QUE ORDENA FACTURACION</strong> <a href="javascript:irAPaginaDN('../clientes/modclientes.php?tabla=tblclientes&dir=<? echo $dir;?>&idcampo=<? echo $idcliente;?>&name=<? echo $name;?>&enca=1','','');">Verificar</a>
			<BR>
			<?
			$sql="select dscontacto1,dscontacto2,dscontacto3,dscontacto4,dscontacto5,dscontacto6";
			$sql.=" from tblclientes where id=$idcliente";
			$vermasx=mysql_db_query($dbase,$sql,$db);
			if (mysql_num_rows($vermasx)==1) { 
				$dscontacto1=mysql_result($vermasx,"0","dscontacto1");
				$dscontacto2=mysql_result($vermasx,"0","dscontacto2");
				$dscontacto3=mysql_result($vermasx,"0","dscontacto3");
				$dscontacto4=mysql_result($vermasx,"0","dscontacto4");
				$dscontacto5=mysql_result($vermasx,"0","dscontacto5");
				$dscontacto6=mysql_result($vermasx,"0","dscontacto6");
				?>
				<select name="dscontacto" class="forma2">
				<? if ($dscontacto1<>""){?>
					<option value="<? echo $dscontacto1;?>" <? if ($dscontacto==$dscontacto1) echo "selected";?>><? echo $dscontacto1;?></option>
				<? } ?>
				
				<? if ($dscontacto2<>""){?>
					<option value="<? echo $dscontacto2;?>" <? if ($dscontacto==$dscontacto2) echo "selected";?>><? echo $dscontacto2;?></option>
				<? } ?>

				<? if ($dscontacto3<>""){?>
					<option value="<? echo $dscontacto3;?>" <? if ($dscontacto==$dscontacto3) echo "selected";?>><? echo $dscontacto3;?></option>
				<? } ?>
				
				<? if ($dscontacto4<>""){?>
					<option value="<? echo $dscontacto4;?>" <? if ($dscontacto==$dscontacto4) echo "selected";?>><? echo $dscontacto4;?></option>
				<? } ?>

				<? if ($dscontacto5<>""){?>
					<option value="<? echo $dscontacto5;?>" <? if ($dscontacto==$dscontacto5) echo "selected";?>><? echo $dscontacto5;?></option>
				<? } ?>

				
				<? if ($dscontacto6<>""){?>
					<option value="<? echo $dscontacto6;?>" <? if ($dscontacto==$dscontacto6) echo "selected";?>><? echo $dscontacto6;?></option>
				<? } ?>
				
				
			
				
				</select>
				<?
				
			}
			mysql_free_result($vermasx);
			?>
			
			<td valign=top colspan=4 class="forma2" align="left">
			<strong>PLAZO DE PAGO</strong>
			<BR>
			<?
			if ($idplazo==""){
			$idplazo=trim(seldato("idplazo","id","tblclientes",$idcliente,1));
			}	
				?>
<input type="text" name="idplazo" value="<? echo $idplazo;?>" class="forma2" size="3" maxlength="3"> Dias
<br>
Observaciones del plazo:
<br>
<textarea name="dsobsplazo" class="forma2" cols="60" rows="3"><? echo $dsobsplazo;?></textarea>
			</td>
</td>
		</tr>
		
		
		
		
		
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td valign=top colspan=7 class="forma2">
			
			
			<input type=SUBMIT name=enviar value="CONTINUAR CON EL PROCESO" class=formabot1 >

							<input type=button name=enviar value="Refrescar Esta pantalla" class=formabot1 onClick="irAPaginaD('<? echo $pagina;?>?idpedido=<? echo $idpedido;?>&idcliente=<? echo $idcliente;?>&idusuariox=<? echo $idusuariox;?>');" title="Use esta opcion para recargar esta pagina para traer mas productos o mas proyectos del cliente">

			
				<input type=button name=enviar value="Cancelar - Borrar Factura" class=formabot1 onClick="irAPaginaD('default.php?del=1&idpedido=<? echo $idpedido;?>');">
				<input type="hidden" name="totalcampos" value="<? echo $campo;?>">
				<input type="hidden" name="idcliente" value="<? echo $idcliente;?>">
				<input type="hidden" name="idpedido" value="<? echo $idpedido;?>">
				<input type="hidden" name="idusuariox" value="<? echo $idusuariox;?>">
				<input type="hidden" name="inn" value="1">
				</td>
		</tr>
		</form>
	</table>
<br>

	
<? include ("../../incluidos/inferior.php"); ?>
</body>
</html>
<script language="javascript">
<!--
var count = 0;
function add(valorx){
<? if ($mod==1) { ?>
	var valorbase=valorx;
<? } else { ?>
	var valorbase=document.u.dsprod.value;
<? }?>	
	// crear nueva capa
	addcapa(valorbase);
}

// crear capa basandose en el tipo de producto
function addcapa(valor){	
    // Div donde se agregara la nueva linea
    var content = document.getElementById('capaprod');
    var divIdName = 'capaprod' + valor;
    var newDiv = document.createElement('div');
    newDiv.setAttribute('id', divIdName);
	content.appendChild(newDiv);
	
	// ajax para enviar y cargar la capa con los datods
	if (valor!=""){
		conexion=AjaxObj();
		 conexion.open("POST","facturar.cargardatos.php?dsprod="+valor+"&idpedido=<? echo $idpedido;?>",true);
		 contenedor=document.getElementById(divIdName);
		 contenedor.innerHTML = "Un momento mientras se verifica....";
	      conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
					contenedor.innerHTML=_resultado;
				 } else {
			   }  // fin resultado
	         } // fin conexion
	       } // fin funcion conexion interna
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	} // fin valorbase
	
}
// fin crear capa

 function quitarcapa(div){
    var content = document.getElementById('capaprod');
    var divIdName = 'capaprod' + div;
    var remove = document.getElementById(divIdName );
    content.removeChild(remove);
  }
  
  function cambiar(valor){
  var dsunidad = ('dsunidad' + valor); // unidades
  var idvalor1 = ('idvalor1' + valor); // valor seleccionado
  var idcant = ('idcant' + valor); // cantidad
  var idimp = ('idimp' + valor); // impuestos
  var iddesc = ('iddesc' + valor); // descuentos
  var subtotal = ('subtotal' + valor); // subtotal por cada linea

  var idcantidad=document.getElementById(idcant);
  var cantidadbase=eval(idcantidad.value)
  var idvalor=document.getElementById(idvalor1);
  var valorbase=(idvalor.options[idvalor.selectedIndex].value);
  var idimpuesto=document.getElementById(idimp);
  var idimpuestobase=eval(idimpuesto.value/100);
  var iddescuento=document.getElementById(iddesc);
  var iddescuentobase=eval(iddescuento.value);
  // subtotal
  var x=eval((valorbase*cantidadbase) - iddescuentobase);

  
  var subtotalxbase= eval(x+(x*idimpuestobase));
  var idsubtotal=document.getElementById(subtotal);
  idsubtotal.value=eval(subtotalxbase);
//	totales();
  }
  
  
function totales(){
	// vector valor
	var x=0;
	for (i=0;i<document.u.elements['idvalor1[]'].length;i++){ 
		if(document.u.elements['idvalor1[]'][i].options[i].value==""){
		} else { 
//	    	var valorbase=(valor[i].value);	
//			x=x+valorbase;
		}	
	} 
	document.u.totalvalor=x;

	
}  
<? if ($mod==1) { 
	$sql="select a.idproducto ";
	$sql.=" from tblfacturasc a,tblproductos b ";
	$sql.="  where a.dspedido='$idpedido' and b.id=a.idproducto ";
	$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0) { 
	while($fila=mysql_fetch_object($vermas)) {
		?>
		setTimeout('return 0',1000);
		setTimeout('addcapa(<? echo $fila->idproducto?>)',1000);
		
		<?
	}
	}
	mysql_free_result($vermas);	
} // fin mod

?>
//-->
</script>
<? include ("../../incluidos/cerrarconexion.php"); ?>
