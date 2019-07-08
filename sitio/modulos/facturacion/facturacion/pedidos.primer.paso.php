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
 Plantilla de carga de valores de facturacion
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
include ("modulos.funciones.facturacion.php");
 //$db->debug=true;
$titulomodulo="Modulo facturacion ";
$tabla="tblfacturase";
$_SESSION['i_dsanio']=date('Y');
$_SESSION['i_dsmes']=date('m');
$rrx="default.php";
if($_REQUEST['r']==1){
$rrx="../../ecommerce/compras/default.php";
$x=1;
}

$mensajeData="Ingreso de factura";
// consecutivo
$idpedido=$_REQUEST['idpedido'];
$pedido=$_REQUEST['pedidox'];
// datos de refacturacion
$idpedidoy=$_REQUEST['idpedidoy'];
$idclientey=$_REQUEST['idclientey']; 
//fin datos de refacturacion

$inn=$_REQUEST['inn'];
$mod=$_REQUEST['mod'];
if ($inn<>"") { 
	$idcliente=$_REQUEST['idcliente']; // id del cliente
	$partirx=explode("|",$idcliente);
	$idclientex=$partirx[0];
	if($x==1){
	if($idclientex=="")$idclientex=$_REQUEST['idclientex'];
	}
	$sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dsdireccion,dsciudad from tblclientes where id=$idclientex";
	$resultx=$db->Execute($sql);
	if(!$resultx->EOF){
		$dsrazon=$resultx->fields[0]." ".$resultx->fields[1];
		$dsnit=$resultx->fields[2];
		$dstele=$resultx->fields[3];
		$dsdir=$resultx->fields[4];
		$dsciudad=$resultx->fields[5];
	}$resultx->Close();

	$partiry=explode("|", $idpedido);
	$dsprefijo=$partiry[0];
	$dsres=$partiry[1];
	$dsnombreconse=$partiry[2];
	$idinicial=$partiry[3];
	$idfinal=$partiry[4];
	include ("consecutivo.php");

	$dsclienterete=$_REQUEST['dsclienterete'];
	$dsclientereteiva=$_REQUEST['dsclientereteiva'];
	$dsclienteretica=$_REQUEST['dsclienteretica'];
	$dsclientelista=$_REQUEST['dsclientelista'];
	$dsclientedescuento=$_REQUEST['dsclientedescuento'];
	$dsclientedsdiasv=$_REQUEST['dsclientedsdiasv'];
	
	$dsorden=$_REQUEST['dsorden']; // orden de trabajo
	$dspedido=$_REQUEST['dspedido']; // orden de trabajo

	$dsfechac=$_REQUEST['dsfechax'];// Fecha de creacion
	$partir=explode("/",$dsfechac);
	$idfechac=$partir[0].$partir[1].$partir[2];
	//echo "------***************------------";
	//exit();
	$dsfechav=$_REQUEST['dsfechav'];// Fecha de vencimiento
	$partir=explode("/",$dsfechav);
	$idfechav=$partir[0].$partir[1].$partir[2];
	//exit();

	$totalflete=$_REQUEST['totalflete'];
	$dsvendedor=$_REQUEST['dsvendedor'];
	$dsobs=($_REQUEST['dsobs']); // codigo de producto
	$dssubtotal=$_REQUEST['subtotalvalor']; // subtotal	
	$dsiva=$_REQUEST['totaliva']; // total iva
	$dspordesct=$_REQUEST['portotaldescuento']; // Porcentaje descuento
	$dsdesct=$_REQUEST['totaldescuento']; // total descuentos
	$dsrete=$_REQUEST['totalrete']; // total rete
	$dsreteiva=$_REQUEST['totalreteiva']; // total rete iva
	$dsreteica=$_REQUEST['totalreteica']; // total rete ica
	if ($dsreteica=="") $dsreteica=0;
	$dsbase=$_REQUEST['subtotalvalor']-$_REQUEST['totaldescuento']; // base
	$dstotal=$_REQUEST['totalvalor']; // total
	// validar si existe..Si existe que actualice 


	$sql="select * from $tabla where idpedido='$idpedido' and dsprefijo='$dsprefijo' and dsres='$dsres'";
	//echo $sql;
	$vermas = $db->Execute($sql);
    if (!$vermas->EOF) {
    	
		$sql=" update $tabla set ";
		$sql.=" dsorden='$dsorden'";
		$sql.=",dsfechac='$dsfechac'";
		$sql.=",dsfechav='$dsfechav'";
		$sql.=",idfechac='$idfechac'";
		$sql.=",idfechav='$dsfechav'";
		$sql.=",idusuariocreador='$dsvendedor',dsvendedor='$dsvendedor' ";
		$sql.=",dssubtotal='$dssubtotal',dsiva='$dsiva',";
		$sql.="dstotal='$dstotal',dsbase='$dsbase',dsrete='$dsrete'";
		$sql.=",dsreteiva='$dsreteiva',dsreteica='$dsreteica'";
		$sql.=",dspordesct='$dspordesct',dsdesct='$dsdesct'";		
		$sql.=",idanio=".$_SESSION['i_dsanio'].",idmes=".$_SESSION['i_dsmes'];		
		$sql.=",dsnit='$dsnit',dsrazon='$dsrazon',dsdir='$dsdir'";
		$sql.=",idcliente='$idcliente'";		
		$sql.=",dsobs='$dsobs'";
		$sql.=",dsres='$dsres'";
		$sql.=",dsprefijo='$dsprefijo'";
		$sql.=",dsflete='$totalflete'";		
		$sql.=",dsciudad='$dsciudad',dstele='$dstele'";
		$sql.=",dsclientedsdiasv='".$dsclientedsdiasv."',dspedido='".$dspedido."'";		
		$sql.=" where idpedido='$idpedido' ";


		if ($db->Execute($sql)) {
		$dstitulo="Insercion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nueva factura";
		$dsruta="../facturacion/facturacion/default.php";
		include("../../../incluidos_modulos/logs.php");
		$sql=" update tblresoluciones set ";
		$sql.="idconsecactual='$idpedido'";
		$sql.=" where dsres='$dsres' and dsprefijo='$dsprefijo' and idconsecini='$idinicial' and idconsecfin='$idfinal'";
  		$db->Execute($sql);	
		if($pedido<>""){
		$sql=" update tblpagos set ";
		$sql.="idestado='14'";
		$sql.=",dsnumfactura='$idpedido'";
		$sql.=",dsfechafactura='".$fechabase."'";
		$sql.=",dsfechalargafactura='".date('Y/m/d H:s:i')."'";
		$sql.=" where idpedido=".$pedido;
  		$db->Execute($sql);
  		}
		 $mensajes=" Factura $idpedido actualizada en el sistema.";
		 //$mensajes.=" <br>";
		 //$mensajes.="<a class=formabot1 href=\"javascript:irAPaginaDN('facturar.imprimir.html.php?idpedido=$idpedido&idcliente=$idcliente','','');\">Ver Esta factura</a>&nbsp;";
 		 //$mensajes.=" | &nbsp;<a href='".$pagina."' class=formabot1>Nueva Factura</a><br>";
		} else { 
			$error=1;
			$mensajes="Problemas al insertar:<br>";
			$mensajes.="Sistema Dice: ".mysql_error();
		}

	} else { 
		
		$sql=" insert into $tabla ";
		$sql.=" (";
		$sql.="idpedido";
		$sql.=",idanio,idmes";
		$sql.=",idusuario,idcliente";
		$sql.=",dsnit,dsrazon,dsdir";
		$sql.=",dsciudad,dstele";
		$sql.=",dsobs";
		$sql.=",dsorden,dsfechac,idfechac,idusuariocreador,dsvendedor";
		$sql.=",dsfechav,idfechav";
		$sql.=",dssubtotal,dsiva,dstotal,dsbase,dsrete,dsreteiva,dsreteica,dspordesct,dsdesct,idactivo";		
		$sql.=",dsclientedsdiasv,dspedido,dsflete,dsprefijo,dsres";
		$sql.=" ) values (";
		$sql.="'$idpedido'";
		$sql.=",".$_SESSION['i_dsanio'].",".$_SESSION['i_dsmes'];
		$sql.=",'".$_SESSION['i_idusuario']."','$idcliente'";
		$sql.=",'$dsnit','$dsrazon','$dsdir'";
		$sql.=",'$dsciudad','$dstele'";
		$sql.=",'$dsobs'";
		$sql.=",'$dsorden','$dsfechac','$idfechac','".$dsvendedor."'";		
		$sql.=",'$dsvendedor'";		
		$sql.=",'$dsfechav','$idfechav'";
		$sql.=",'$dssubtotal','$dsiva','$dstotal','$dsbase','$dsrete','$dsreteiva'";
		$sql.=",'$dsreteica','$dspordesct','$dsdesct',0";		
		$sql.=",'$dsclientedsdiasv','$dspedido','$totalflete','$dsprefijo','$dsres'";
		$sql.=" )";



		if ($db->Execute($sql)) {
			$dstitulo="Se genero una nueva  factura con el numero $idpedido ";
			$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nueva factura";
			$dsruta="../facturacion/facturacion/default.php";
			include("../../../incluidos_modulos/logs.php");
			$sql=" update tblresoluciones set ";
			$sql.="idconsecactual='$idpedido'";
			$sql.=" where dsres='$dsres' and dsprefijo='$dsprefijo' and idconsecini='$idinicial' and idconsecfin='$idfinal'";
  				//echo $sql."<br>";
  			$db->Execute($sql);	
			if($pedido<>""){
			$sql=" update tblpagos set ";
			$sql.="idestado='14'";
			$sql.=",dsnumfactura='$idpedido'";
			$sql.=",dsfechafactura='".date('Y/m/d')."'";
			$sql.=",dsfechalargafactura='".date('Y/m/d H:s:i')."'";
			$sql.=" where idpedido=".$pedido;
			//echo $sql;
			//exit();
  			$db->Execute($sql);





  			}
			//$error=0;
			 $mensajes=" Factura $idpedido ingresada con exito";
			 //$mensajes.=" <br>";
			 //$mensajes.="<a class=formabot1 href=\"javascript:irAPaginaDN('facturar.imprimir.html.php?idpedido=$idpedido&idcliente=$idcliente','','');\">Ver  Esta factura</a>&nbsp;";
			 // $mensajes.="&nbsp;<a class=formabot1 href=facturar.imprimir.html.2.php?idpedido=$idpedido'>Imprimir Esta factura</a>&nbsp;";
			 //$mensajes.=" | &nbsp;<a href='".$pagina."' class=formabot1>Nueva Factura</a><br>";
		}


		 else { 
			$error=1;
			$mensajes="Problemas al insertar:<br>";
			$mensajes.="Sistema Dice: ".mysql_error();
		}

	}
	$vermas->Close();
	//exit();
	////////////// DATOS A LA TABLA AUXILIAR /////////////////////////////////
	$sql="delete from tblfacturasc  where dspedido='$idpedido'  and dsprefijo='$dsprefijo' and dsres='$dsres' ";
	$db->Execute($sql);;
	$dsref=$_REQUEST['dsref'];
	$contar=count($dsref);
	if ($dsref>0) { 
	$h=0;
		for ($j=0;$j<$contar;$j++){
			if ($_REQUEST['dscant'][$j]<>"" && $_REQUEST['dscant'][$j]<>"0") {

				// si el producto no esta que se cargue en las tablas correspondientes
				// fin carga de producto

				$sql="insert into tblfacturasc  ";
				$sql.=" (";
				$sql.="idc,dspedido,idproducto";
				$sql.=",dsref,dscant,dsunidad,dsvalor,dssubtotal,idpos";
				$sql.=",dsdesc,dspres,dsdesct,dsivax";
				$sql.=",dsvaloriva,dsporiva";
				$sql.=",dsflete,dsres,dsprefijo) values (";
				$sql.="'','$idpedido',''";
				$sql.=",'".strtoupper($_REQUEST['dsref'][$j])."',";
				$sql.="'".$_REQUEST['dscant'][$j]."'";
				$sql.=",'".strtoupper($_REQUEST['dsun'][$j])."'";
				$sql.=",'".$_REQUEST['dsvalor'][$j]."'";
				$sql.=",'".$_REQUEST['dssubtotal'][$j]."'";
				$sql.=",'".$_REQUEST['idpos'][$j]."'";
				$sql.=",'".strtoupper($_REQUEST['dsdesc'][$j])."'";
				$sql.=",'".$_REQUEST['dspres'][$j]."'";
				$sql.=",'".$_REQUEST['dsdesct'][$j]."'";
				$sql.=",'".$_REQUEST['dsivax'][$j]."'";
				$sql.=",'".$_REQUEST['dsivaxx'][$j]."'";
				$sql.=",'".$_REQUEST['dsivax'][$j]."'";
				$sql.=",'".$_REQUEST['dsfletex'][$j]."'";
				$sql.=",$dsres,'$dsprefijo'";
				$sql.=" )";
				//echo $sql;
				//exit();
				
				if ($db->Execute($sql)) $h++;
		




			}
		}
	}
	//exit();
	////////////// FIN DATOS A LA TABLA AUXILIAR DE COLORES /////////////////////////////
	// if ($h>0) $mensajes.=", junto con su detalle asociado";
	$mod=1;
}


if ($idpedido<>"") { 
	//exit();
	// traer los datos de la tabla
	$sql="select ";
	$sql.="	 id, idanio, idmes, idpedido, idusuario, idcliente";//5
	$sql.=", dsnit, dsrazon, dsdir, dsciudad, dstele, idplazo";//11
	$sql.=", dsobsplazo, dsfechac, idfechac, dsfechav, idfechav";//16
	$sql.=", dsfechap, idfechap, idformapago, dssubtotal, dsbase";//22
	$sql.=", dsiva, dsrete, dsreteiva, dsreteica, dspordesct";//27
	$sql.=", dsdesct, dstotal, idactivo, dsobs, dsorden, dspedido";//33
	$sql.=", dsobspago, idusuariocreador, dsvendedor, dsclientedsdiasv,dsflete";//37
	$sql.=" from $tabla where idpedido='$idpedido'";
	$resultx = $db->Execute($sql);
    if (!$resultx->EOF) {
					$idcliente=$resultx->fields[5];
					$dsfechac=$resultx->fields[13];		
					$dsfechav=$resultx->fields[15];
					$dssubtotal=$resultx->fields[20];						
					$dsiva=$resultx->fields[22];		
					$dsbase=$resultx->fields[22];				
					$dsrete=$resultx->fields[24];		
					$dsreteiva=$resultx->fields[25];		
					$dsreteica=$resultx->fields[26];
					$dsdesctx=$resultx->fields[27];
					$dstotal=$resultx->fields[28];
					$dsobs=$resultx->fields[30];
					$dsorden=$resultx->fields[31];
					$dspedido=$resultx->fields[32];
					$dsvendedor=$resultx->fields[35];
					$dsfelte=$resultx->fields[37];			
	} else { 
	
		if ($idpedidoy<>"") {  //traer datos de refacturacion
				$sql="select ";
				$sql.="	 id, idanio, idmes, idpedido, idusuario, idcliente";//5
				$sql.=", dsnit, dsrazon, dsdir, dsciudad, dstele, idplazo";//11

				$sql.=", dsobsplazo, dsfechac, idfechac, dsfechav, idfechav";//16
				$sql.=", dsfechap, idfechap, idformapago, dssubtotal, dsbase";//21

				$sql.=", dsiva, dsrete, dsreteiva, dsreteica, dspordesct";//26
				$sql.=", dsdesct, dstotal, idactivo, dsobs, dsorden, dspedido";//32

				$sql.=", dsobspago, idusuariocreador, dsvendedor, dsclientedsdiasv,dsflete";//37
				$sql.=" from $tabla where idpedido='$idpedidoy'";
				//echo $sql;
				$result = $db->Execute($sql);
    			if (!$result->EOF) {
    				
    				
					$idcliente=$result->fields[5];
					$dsfechac=$result->fields[13];		
					$dsfechav=$result->fields[15];
					$dssubtotal=$result->fields[20];						
					$dsiva=$result->fields[22];		
					$dsbase=$result->fields[22];				
					$dsrete=$result->fields[24];		
					$dsreteiva=$result->fields[25];		
					$dsreteica=$result->fields[26];
					$dsdesctx=$result->fields[27];
					$dstotal=$result->fields[28];
					$dsobs=$result->fields[30];
					$dsorden=$result->fields[31];
					$dspedido=$result->fields[32];
					$dsvendedor=$result->fields[35];
					$dsfelte=$result->fields[37];	
				} else { 
					$idcliente="";
					$dsfechac=$fechaBase;
					//$dsfechav=$fechaBase;
					$dsobs="";
					$idorden="";
					$dsvendedor="";
					$dsorden="";
					//		
					$dssubtotal="";		
					$dsiva="";		
					$dstotal="";		
					//
					$dsbase="";				
					$dsrete="";		
					$dsdesct="";		
					$dsreteiva="";		
					$dsreteica="";		
				}
				$result->close();
		} else { 
			$idcliente="";
			$dsfechac=$fechaBase;
			$dsobs="";
			$idorden="";
			$dsvendedor="";
			$dsorden="";
	     	$dssubtotal="";		
			$dsiva="";		
			$dstotal="";		
			$dsbase="";				
			$dsrete="";		
			$dsdesct="";		
			$dsreteiva="";		
			$dsreteica="";		
		
		}
		
	}
	$resultx->Close();
}
if($pedido<>""){
$sql="select ";
$sql.=" idpedido,idclientepago,dssubtotal,dsdescuento,dsiva,dsflete,dstotal,dsfechalarga,dstransad";//6
$sql.=" from tblpagos where idpedido='".$pedido."'";
//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
$dsorden=$result->fields[0];
$dspedido=$result->fields[0];
$dsobs="Factura Pedido ".$result->fields[0];
$idcliente=$result->fields[1];
$dssubtotal=$result->fields[2];
$dsdesct=$result->fields[3];
$dsdesctx=$result->fields[3];
$xdsivax=$result->fields[4];
$xdsfletex=$result->fields[5];
$dstotal=$result->fields[6];	
$dsvendedor="";
$dsfechac=$result->fields[7];	
$dstransad=$result->fields[8];
$dsfechav="";
$dsbase="";				
$dsrete=0;		
$dsreteiva=0;		
$dsreteica=0;
$xdsfletex=$xdsfletex+$dstransad;
						
				} else { 
					$idcliente="";
					$dsfechac=$fechaBase;
					$dsobs="";
					$idorden="";
					$dsvendedor="";
					$dsorden="";
					$dssubtotal="";		
					$dsiva="";		
					$dstotal="";		
					$dsbase="";				
					$dsrete="";		
					$dsdesct="";		
					$dsreteiva="";		
					$dsreteica="";		
				}
				$result->close();




}
/////////////////////////////////////////////////////////////////////
// traer de la tabla iva el dspor
$IVAx=seldato("dspor","ida","tbliva",1,0);
$IVA=($IVAx/100);
// valores de la retenciones
// 1. Valor base retenciones
$baseRete=seldato("dsbase","ida","tblretenciones",1,0);
// porcentajes
// 2. la retefuente
$dsporRetex=seldato("dspor","ida","tblretenciones",1,0);
$dsporRete=($dsporRetex/100);
// 3. el rete iva
$dsBaseReteIVA=seldato("dsretiva","ida","tblretenciones",1,0);

/////////////////////////////////////////////////////////////////////

if ($dsclienterete=="") $dsclienterete=0;
if ($dsclientereteiva=="") $dsclientereteiva=0;
if ($dsclienteretica=="") $dsclienteretica=0;
if ($dsclientelista=="") $dsclientelista=0;
if ($dsclientedescuento=="") $dsclientedescuento=0;
if ($dsfechav=="") { 
	// sumar 30 dias a la fecha de creacion
	$dsmes=$_SESSION['i_dsmes'];
	if (strlen($dsmes)<2) $dsmes="0".$dsmes;
	$can_dias = 30; 
	$dyh = getdate(mktime(0, 0, 0, $dsmes, date("d"), $_SESSION['i_dsanio']) + 24*60*60*$can_dias); 
	$mesbase=$dyh['mon'];
	$diabase=$dyh['mday'];
	if (strlen($mesbase)<2) $mesbase="0".$mesbase;
	if (strlen($diabase)<2) $diabase="0".$diabase;
	$fec_vencimiento = $dyh['year']."/".$mesbase."/".$diabase;  
	$dsfechav=$fec_vencimiento;
} else { 
	$dsmes=$_SESSION['i_dsmes'];
	if (strlen($dsmes)<2) $dsmes="0".$dsmes;
	
}
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<?include ("javageneral.facturacion.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>
<br>
<table class="cont_general" width="100%">

	<tr>
		<td align="center">

		<form action="<? echo $pagina;?>" method=post name=u>
		<table width=90% align=center  border=0 cellpadding=4 cellspacing=1  class="campos_factura"  >
		<tr>
			<td colspan=6 align=center>
				<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
      			  <tr>
         			<td width="615" align="left" valign="middle">
        			<img src="../../../img_modulos/modulos/edicion.png">
         			<h1><?echo $mensajeData?></h1>
         			</td>
        		  </tr>
				</table>
			</td>
		</tr>
				<tr bgcolor="<? echo $fondos[4];?>" align=center>
			<td colspan=6 align="right" valign=top bgcolor="#FFFFFF" class="link_negro1">
			  	<input type=button name=enviar value="Regresar" class="botones" onClick="irAPaginaD('<?echo $rrx?>');">
				</td>
		</tr>
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		<p>Factura Nro.</p>		</td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1" colspan=3>
		<select name=idpedido> 
		<?combosconsecutivos($idpedido);?>
		</select>	

		</td>
		
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		<p>Fecha (AAAA/MM/DD)	</p>	</td>
		<?$dsfechax=$_SESSION['i_dsanio']."/".$dsmes."/".date("d");?>	
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
		<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechax', this);" language="javaScript">			
		<input type="text" name="dsfechax" class="link_negro1"  value="<? echo $dsfechax;?>" maxlength="10" size="10">
		</td>
		</tr>		
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1"><p>Observaciones</p></td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1" colspan=3>
<textarea name="dsobs" class="link_negro1" style="width:96%;" cols=60 rows=3><? echo $dsobs;?></textarea>

		</td>
		
		<td valign=top bgcolor="#FFFFFF" class="link_negro1"><p>Fecha de vencimiento</p> </td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechav', this);" language="javaScript">			
		
<input type="text" name="dsfechav" class="link_negro1"  value="<? echo $dsfechav;?>" maxlength="10" size="10">

</td>
</tr>

<tr bgcolor="<? echo $fondos[4];?>" >
		<td valign=top bgcolor="#FFFFFF" class="link_negro1"><p>Nro Orden</p></td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<input type="text" name="dsorden" class="link_negro1"  value="<? echo $dsorden;?>" maxlength="10" size="10">
</td>

<td valign=top bgcolor="#FFFFFF" class="link_negro1"><p>Nro Pedido</p></td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<input type="text" name="dspedido" class="link_negro1"  value="<? echo $dspedido;?>" maxlength="10" size="10">


	  <td valign=top bgcolor="#FFFFFF" class="link_negro1"><p>VENDEDOR</p> </td>
		<td valign=top bgcolor="#FFFFFF" class="link_negro1">
<select name="dsvendedor" class="link_negro1">
	<option value=""></option>
	<? combosusuarios($dsvendedor,$_SESSION['i_idempresa']);?>
</select>


</td>


		
</tr>
		
		<tr bgcolor="<? echo $fondos[4];?>" >
		<td  valign=top bgcolor="#FFFFFF" class="link_negro1">
			<p>Tercero:</p>	

		</td>
		
		<td class="link_negro1" colspan="1">
	
			<div id="capaclientex">
		<select name="idcliente" class="link_negro1" onChange="CargarVariables();" <?if($x==1) echo "disabled"?>>
		<option value="">...</option>
		<?	combosclientesp($idcliente,$_SESSION['i_idempresa']);?>
		</select>
</div>
<?if($x==1){ ?>
<input type="hidden" name="idclientex" value="<?echo $idcliente?>">
<?}?>
</td>



<td colspan="2" valign=top bgcolor="#FFFFFF" class="link_negro1">

	<!-- BOTONES VIEJOS  -->

<?if($x==""){?>
<input type=button name=enviar value="Nuevo" class="textlink2" onClick="capacliente('capaclientebase',1)">
<input type=button name=enviar value="Ver perfil cliente" class="textlink2" onClick="cargarcliente('idcliente','<? echo $pagina?>');">
<input type=button name=enviar value="Buscar" class="textlink2" onClick="irAPaginaDN('../../crm/clientesregistrados/default.php?cargarfac=1&enca=1');" title="Click para imprimir ">
<?}?>

<div id="capa_cargarvariables" style="display:none"></div>
		  </td>


		

		<td  bgcolor="#FFFFFF" >
			<?if($x==""){?>	<p>Valor A Facturar :</p><?}?>
		</td>
		
		<td class="link_negro1">
<?if($x==""){?>
			<div>
			<select name=idtipocliente  >
<option value="">----</option>
<?if(seldato('dsm','idactivo','tblnombrecampo',1,1)<>""){?>
<option value="1"><?echo seldato('dsm','idactivo','tblnombrecampo',1,1)?></option>
<?}if(seldato('dsm','idactivo','tblnombrecampo',2,1)<>""){?>
<option value="2"><?echo seldato('dsm','idactivo','tblnombrecampo',2,1)?></option>
<?}if(seldato('dsm','idactivo','tblnombrecampo',3,1)<>""){?>
<option value="3"><?echo seldato('dsm','idactivo','tblnombrecampo',3,1)?></option>
<?}if(seldato('dsm','idactivo','tblnombrecampo',4,1)<>""){?>
<option value="4"><?echo seldato('dsm','idactivo','tblnombrecampo',4,1)?></option>
<?}if(seldato('dsm','idactivo','tblnombrecampo',5,1)<>""){?>
<option value="5"><?echo seldato('dsm','idactivo','tblnombrecampo',5,1)?></option>
<?}?>
</select>

</div>
<?}?>
</td>

		</tr>
<tr bgcolor="<? echo $fondos[4];?>" >









		</tr>
			<tr bgcolor="<? echo $fondos[4];?>" id="capaclientebase" style="display:none">
		<td valign=top class="link_negro1"colspan="6"   >
		<?
		$capa="capaclientebase";
		$retenciones="1"; // carga campos de retencion
		include ("cliente.nuevo.php");?>
		</td>
		</tr>
		
		
</table>
<? //////////////////////////////////////// CUERPO CENTRAL ///////////////////////////////?>		
<br>
<table width=90% align=center  border=1 cellpadding=4 cellspacing=1   class="campos_factura"  style="table-layout:fixed" >	
<tr bgcolor="<? echo $fondos[4];?>" align="center">
<td width="5%" valign=top  class="text_blanco"><input type=button class="textnegro1 agregar_fila" value='' name='enviar' onClick="irAPaginaDN('../../ecommerce/listaproductos/default.producto.php?enca=1','500','500');" title="Agregar nuevos productos"></td>		
<td width="12%" valign=top  class="text_blanco"><strong><p>REFERENCIA</p></strong></td>
<td width="5%" valign=top  class="text_blanco"><strong><p>UNIDAD</p></strong></td>
<td width="20%" valign=top  class="text_blanco"><strong><p>DESCRIPCION</p></strong></td>
<td width="10%" valign=top  class="text_blanco"><strong><p>DESCUENTO %</p></strong></td>
<td width="10%" valign=top  class="text_blanco"><strong><p>VALOR LOGISTICA</p></strong></td>
<td width="10%" valign=top  class="text_blanco"><strong><p>VALOR</p></strong></td>
<td width="6%" valign=top  class="text_blanco"><strong><p>CANTIDAD</p></strong></td>
<td width="8%" valign=top  class="text_blanco"><strong><p>SUBTOTAL</p></strong></td>
</tr>
</table>
<?
if($x==""){
include('tabla.producto.php') ;
}else{
include('tabla.productosin.php') ;
}?>
<? //////////////////////////////////////// FIN CUERPO CENTRAL ///////////////////////////////?>				

</form>	


</td>
</tr>
</table>

<? include ($rutxx."../../incluidos_modulos/cerrarconexion.php"); ?>
	<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>



</body>
</html>



