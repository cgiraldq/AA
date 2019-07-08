<?
/*
| ----------------------------------------------------------------- |
Sistemas Guias Saferbo
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2010
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pen <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// BUSCADOR DE DESINATARIOS
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$dsparam=$_REQUEST['dsparam'];
?>


<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>

<body>
<?// include($rutxx."../../incluidos_modulos/navegador.principal.php");?>


<table align="center"  cellspacing="1" cellpadding="6" border="0" width="100%" class="link_negro1" bgcolor="#000000">
<tr valign=top bgcolor="#CCCCCC" class="">
<td><strong>NOMBRE</strong></td>
<td><strong>NIT</strong></td>
<td><strong>TELEFONO</strong></td>
<td><strong>DIRECCION</strong></td>

</tr>
<?
if ($dsparam<>"") { 

$sql="select dsnombres,dsidentificacion,dstelefono,dsdireccion from tblclientes  where id>0 ";
$sql.=" and (dsidentificacion like '%$dsparam' or dsnombres like '%$dsparam%') ";
$sql.=" order by dsnombres asc  ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
	$contar=0;
 	while(!$result->EOF) {
 	if ($contar%2==0) { 
	$fondo="#f3f3f3";
	} else { 
	$fondo="#FFFFFF";		
	}

	$dsm 		=$result->fields[0];
	$dsnit 		=$result->fields[1];
	$dstel 		=$result->fields[2];
	$dsdir		=$result->fields[3];
			
			
?>
		<tr valign=top ondblclick="cargar_datos('<? echo $dsm?>','<? echo $dsnit?>')" bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#CCCCCC');" >
		<td><? echo $dsm?></td>
		<td><? echo $dsnit?></td>
		<td><? echo $dstel?></td>
		<td><? echo $dsdir?></td>
				
		</tr>

<?
		$contar++;

	
	$result->MoveNext();
	} // fin while 
}
$result->Close();
} // fin validacion parametros
?>
</table>

</body>

</html>
<? include ($rutxx."../../incluidos_modulos/cerrarconexion.php");
//include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
//include($rutxx."../../incluidos_modulos/modulos.remate.php"); ?>

<script language="javascript">
<!--
function cargar_datos(nombre,nit){
	window.parent.document.u.dsnit.value=nit; 
	window.parent.document.u.dsparam.value=nombre;
	
	var capadatos=window.parent.document.getElementById("capa_resultados_destinatarios");
	if (capadatos) {
	capadatos.style.display='none';
	}
	window.parent.document.location.href="ingresos.primer.paso.php?dsnit="+nit+"&enviar=Cargar&dsparam="+nombre;
	//window.parent.document.u.submit();
	
}

//-->
</script>