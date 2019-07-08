<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
include ("modulos.funciones.facturacion.php");
$titulomodulo="Listado De facturacion";
$rc4 = new rc4crypt();

if ($_REQUEST['anular']=="1"){
	$idpedido=$_REQUEST['pkid'];
	$sqlx="update ecommerce_tblfacturase set idactivo=3 where id=".$idpedido;
	if ($db->Execute($sqlx)) {
	 $sqly="select dspedido  from ecommerce_tblfacturase where id=".$idpedido;
	 //echo $sqly;
	 $vermax = $db->Execute($sqly);
	if (!$vermax->EOF) {
	$dspedido=$vermax->fields[0];
	}
	$vermax->Close();
	if($dspedido<>""){
	$sqll="update ecommerce_tblpagos set idestado=2 where idpedido=".$dspedido;
	$db->Execute($sqll);
	}
	$dstitulo="Anulacion Factura ".$idpedido;
	$dsdesc=" El usuario ".$_SESSION['i_dslogin']." anulada registro de $titulomodulo";
	$dsruta="../facturacion/facturacion/default.php";
	include($rutxx."../../incluidos_modulos/logs.php");

	$error=0;
	$mensajes="Factura anulada con éxito";
	}
}
if ($_REQUEST['enviar']=="Modificar"){
 		$contar=count($_REQUEST['id']);
			$v=0;
			for ($j=0;$j<$contar;$j++){
				if ($_REQUEST['id'][$j]<>""){
					$sqlm=" update ".$tabla. " set ";
					$sqlm.= "idactivo=".$_REQUEST['idactivo'][$j];
					$sqlm.= " where id=".$_REQUEST['id'][$j];
					// echo $sqlm."<br>";
					if ($db->Execute($sql)) $v++;
				} // fin si
			} // fin for
			if ($v>0) $mensajes="Modificación realizada con éxito ".$mensajeData;
			$error=0;
	} // fin inn



$letra=$_REQUEST['letra'];
$enca=$_REQUEST['enca'];
$idclientepago=$_REQUEST['idclientepago'];
$idtiendax=$_REQUEST['idtiendax'];
$idconcursox=$_REQUEST['idconcursox'];
$tabla="ecommerce_tblfacturase";
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
$dsfecha2=$_REQUEST['dsfecha2'];
$partir=explode("/",$dsfecha2);
$idfecha2=$partir[0].$partir[1].$partir[2];
$paramx=$_REQUEST['paramx'];
$idprog=$_REQUEST['idprog'];
$dsprog=$_REQUEST['dsprog'];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<?include("javageneral.facturacion.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select ";
$sql.="id, idanio, idmes, idpedido, idusuario";//4
$sql.=", idcliente, dsnit, dsrazon, dsdir, dsciudad";//9
$sql.=", dstele, idplazo, dsobsplazo, dsfechac, idfechac";//14
$sql.=", dsfechav, idfechav, dsfechap, idfechap, idformapago";//19
$sql.=", dssubtotal, dsbase, dsiva, dsrete, dsreteiva";//24
$sql.=", dsreteica, dspordesct, dsdesct, dstotal, idactivo";//29
$sql.=", dsobs, dsorden, dspedido, dsobspago, idusuariocreador";//34
$sql.=", dsvendedor, dsclientedsdiasv,dsflete,dsprefijo,dsres";//39

$sql.=" from $tabla a where id>0  ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($idclientepago<>"") $sql.=" and a.id='".$idclientepago."'";
if ($idtiendax<>"") $sql.=" and a.idtienda='".$idtiendax."'";
if ($idconcursox<>"") $sql.=" and a.idtiporegistro='".$idconcursox."'";
$sql.=" order by a.idpedido desc, a.dsprefijo asc ";
//echo $sql;
	$bloqueabc=1;
	$mostrarestados=1;
	$mostrarfechasad=1;
	$cargau=1; // mostrasr usuarios
	include ($rutxx."../../incluidos_modulos/buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax']."&idconcursox=".$_REQUEST['idconcursox'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	?><table width="100%" cellspacing="0" cellpadding="1" class="forma2" ID="Table2" style="margin: 10px 0 0 0;">
	<tr bgcolor="<? echo $fondos[5];?>">
	<td valign=top align=left>
	<h2 style="margin: 0;">Listado de facturas
	<? if ($idprog<>"" && $dsprog<>"") echo ", $dsprog";?>
	</h2></td>
	<td valign=top align=right>
	<a href="../facturacion/rep.facturas.listado.php" title="Click para ver reporte"><p class="btn_barra">Relacion de facturas</p></a>

	<a href="../facturacion/pedidos.primer.paso.php" title="Click para ingresar una nueva factura" ><p class="btn_barra">Ingresar nueva factura</p></a>
	</td>
    </tr>
	</table>
	<?
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("tabla.facturacion.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>