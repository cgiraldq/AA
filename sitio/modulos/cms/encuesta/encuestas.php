<?
include("sessiones.php");
include("incluidos/funciones.php");
// ingreso 
		if ($_POST['enviar']=="Ingresar") {
			$dsnombre=$_POST['dsnombre'];
			if ($dsnombre==""){
				$dsnombre=$_GET['dsnombre'];
			}
			$ubic=$_POST['ubic'];
			if ($ubic==""){
				$ubic=$_GET['ubic'];
			}
			$idactivo=$_POST['idactivo'];
			if ($idactivo==""){
				$idactivo=$_GET['idactivo'];
			}

			$fecha=date("Y-m-d h:m:s");
			// ingreso de datos 
			$sql = "select id from ".$prefix."tblencuesta where dsnombre='$dsnombre'";
			$validar=mysql_db_query($dbase,$sql,$db);
			$resultado = @mysql_result($validar,"0","id");
			// validacion
			if ($resultado =="" || $resultado=0) {
				$sql= "insert into ".$prefix."tblencuesta values (";
				$sql.="'','$dsnombre','$fecha',$ubic,$idactivo)";
				mysql_db_query($dbase,$sql,$db);
				$mensaje="<font color='$fondo8'><strong>Datos ingresados con &eacute;xito al sistema</strong></font>";
			} else {
				$mensaje="<font color='$fondo9'><strong>El dato que intenta ingresar ya existe en el sistema!</strong></font>";
			}	
		}	
//modificacion
// pero usando ciclo
		if ($_POST['enviar']=="Modificar"){
		// ciclo de datos
		$id=$_POST['id'];
		if ($id==""){
			$id=$_GET['id'];
		}
		$dsnombre=$_POST['dsnombre'];
		if ($dsnombre==""){
			$dsnombre=$_GET['dsnombre'];
		}
		$ubic=$_POST['ubic'];
		if ($ubic==""){
			$ubic=$_GET['ubic'];
		}
		$idactivo=$_POST['idactivo'];
		if ($idactivo==""){
			$idactivo=$_GET['idactivo'];
		}
		$contar=count($id);
		for ($i=0;$i<$contar;$i++){
			if ($dsnombre[$i]<>""){
				$sql = " update ".$prefix."tblencuesta set ";
				$sql.= "dsnombre='$dsnombre[$i]',ubic=$ubic[$i]";
				//$sql. = ",descing='".$descing[$i]."'";
				$sql.= ",idactivo =$idactivo[$i]";
				$sql.= " where id=".$id[$i];
				// echo $sql;
				//exit();
				mysql_db_query($dbase,$sql,$db);
			}
		}	
			$mensaje="<font color='$fondo8'><strong>Datos Modificados con &eacute;xito al sistema</strong></font>";					
		}
// eliminacion
	if ($_GET['enviar']=="Eliminar"){
			$id=$_GET['id'];
			if ($id==""){
				$id=$_POST['id'];
			}
			$sql = "delete from ".$prefix."tblencuesta";
			$sql.= " where id=$id";
			mysql_db_query($dbase,$sql,$db);
			$sql = "delete from ".$prefix."tblrespuestas";
			$sql.= " where idencuesta=$id";
			mysql_db_query($dbase,$sql,$db);
			$mensaje="<font color='$fondo9'><strong>Datos Eliminados con &eacute;xito al sistema</strong></font>";					
		}
?>
<html>
<head>
<title><? echo $TituloAdmon;?></title>
<? include ("incluidos/java.php");?>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 15px;
/*	background-image: url(img/fondo.jpg);*//*	background-repeat: repeat-x;*/
}-->
</style>
<? echo $estilos;?>

<script language="JavaScript">
<!--
	function valU(){
	
	if (document.u.dsnombre.value==""){
		alert("Debe ingresar el nombre de la encuesta que aparecer&aacute; en el sitio!");
		document.u.dsnombre.focus();
		return;
	}
	document.u.submit();
	}
//-->
</script>
</head>
<body  text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="campos">
<? include("incluidos/encabezado.php");?>
<? include("incluidos/menu.php");?>
<? include("incluidos/resultoperaciones.php");?>
<?
// listado con paginacion
$sql="select id as total from ".$prefix."tblencuesta";
$ssql=@mysql_db_query($dbase,$sql,$db);
$total_url=mysql_num_rows($ssql);
// paginacion. Botones adelante, atras.
$inicio=$_POST['inicio'];
if ($inicio==""){
	$inicio=$_GET['inicio'];
}
$fin=$_POST['fin'];
if ($fin==""){
	$fin=$_GET['fin'];
}
	
if ($inicio=="") {
	$inicio=0;
	if ($paginar<>""){
		$fin=$paginar;
	} else {
		$fin=50; // esta es la variable que controla la paginacion
	}
}	
	// fin variables de calculo de pantallazos
	$area1="select * ";
	$area1.=" from ".$prefix."tblencuesta ";	
	$area1.=" order by id desc LIMIT $inicio,$fin ";
//	echo $area1;
//	exit();
?>
<br>
<table align="center"  cellspacing="0" cellpadding="0" border="0" width=100%>
<tr  width=100%><td colspan=2 class=titulo1><strong>ENCUESTAS</strong></td></tr>
<tr  class=campos width=100%><td colspan=2><strong>Ingreso datos</strong></td></tr>
<form action="<? echo $_SERVER['PHP_SELF'];?>" method=post name=u>
<tr class=textos bgcolor="<? echo $fondo2;?>">
<td> Nombre Encuesta</td>
<td><input type=text name=dsnombre size=70 maxlength="255" class="textos"></td>
</tr>
<tr class=textos bgcolor="<? echo $fondo2;?>">
<td> Activar en el web?</td>
<td>
	<select name=idactivo class=textos>
		<option value="1">SI</option>
		<option value="2">NO</option>
		<option value="3">Reinas</option>
	</select>

</td>
</tr>

<tr class=textos bgcolor="<? echo $fondo2;?>">
<td> Ubicaci&oacute;n Encuesta</td>
<td>
	<select name=ubic class=textos>
		<option value="1">Superior</option>
		<!--option value="2">Inferior despu&eacute;s de resultados</option-->
	</select>

</td>
</tr>
<tr bgcolor="<? echo $fondo2;?>"><td colspan=2 align=center>
<input type=button name=enviar value="Ingresar" oncLick="valU();" class=textos>
<input type=hidden name=enviar value="Ingresar">
</td></tr>
</form>
</table>
<br>
<table align="center"  cellspacing="0" cellpadding="0" border="0" width=100%>
<form action="<? echo  $_SERVER['PHP_SELF'];?>" method=post name=User>
<tr valign=top>
    <td width=40% class=campos align=left bgcolor="<? echo  $fondo2;?>"><strong>Listado de las encuestas.</strong></td>
    <td width=60% bgcolor="<? echo  $fondo2;?>" class=campos>
	<strong>Cuantos registros por pantalla:</strong>&nbsp;<input type=text size=5 name=paginar value="<? echo $fin;?>" class=textos>
	<input type=submit name=enviar value="Recargar" class=textos>
	</td>
</tr>
</form>
</table>
 <table align="center"  cellspacing="1" cellpadding="2" border="0" width=100% class=textos>
 <tr bgcolor="<? echo $fondo3;?>" align=center>
 <td><strong>Nombre</strong></td>
 <td><strong>Ubicaci&oacute;n</strong></td>   
 <td><strong>Activar?</strong></td>   
  <td><strong>Opciones</strong></td>   
 </tr>
 <form action="<? echo  $_SERVER['PHP_SELF'];?>" method=post name=User4> 
 <?
 $vermas=mysql_db_query($dbase,$area1,$db);
	if(mysql_affected_rows()>0){
		while($fila=mysql_fetch_object($vermas)) {
 ?>
 <tr align=center bgcolor="<? echo $fondo10;?>"  onMouseOver="uno(this,'<? echo $fondo5;?>');" onMouseOut="dos(this,'<? echo $fondo10;?>');" class="campos">
 <td><input type=text name=dsnombre[] value="<? echo $fila->dsnombre;?>" class=textos size=55 maxlength="255"></td>
   <td>
 	<select name=ubic[] class=textos>
		<option value="" <?  if ($fila->ubic==""){ echo "selected";}?>>Seleccione..</option>
		<option value="1" <? if ($fila->ubic=="1"){ echo "selected";}?>>Superior</option>
		<!--option value="2" <?// if ($fila->ubic=="2"){ echo "selected";}?>>Inferior despu&eacute;s de resultados</option-->
	</select>
 </td>   

   <td>
   
 	<select name=idactivo[] class=textos>
		<option value="1" <? if ($fila->idactivo==1){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($fila->idactivo==2){ echo "selected";}?>>NO</option>
		<option value="3" <? if ($fila->idactivo==3){ echo "selected";}?>>Reinas</option>
	</select>
 </td>   
  <td>
    <A HREF="preguntase.php?id=<? echo $fila->id;?>&dsnombre=<? echo $fila->dsnombre;?>&enviar=preg" title="Click para cargar las preguntas que se hacen sobre esta encuesta">PREGUNTAS</a>
	|
	<a href="asocencuesta.php?id=<? echo $fila->id;?>&nombre=<? echo $fila->dsnombre;?>" title="Click para ubicar la encuesta en una secci&oacute;n">ASOCIAR</a>
	|
    <A HREF="<? echo $_SERVER['PHP_SELF'];?>?id=<? echo $fila->id;?>&enviar=Eliminar" title="Click para eliminar esta encuesta">ELIMINAR</a>	
	 <input type=hidden name=id[] value="<? echo $fila->id;?>" class=campos>
	</td>	
 </tr> 		
<?
}
} else {
?>
<tr><td bgcolor="<? echo  $fondo2;?>" colspan=7><font color=Red>A&uacute;n no hay datos disponibles</font></td></tr>
<?
}		
?>
<tr bgcolor="<? echo  $fondo3;?>">
<td ></td>
<td></td>
<td></td>
<td align="center">
<input type=submit class=textos value="Modificar" name="enviar"> 	
<input type=hidden name=inicio value="<? echo  $inicio1;?>" class=campos>
<input type=hidden name=paginar value="<? echo  $paginar;?>" class=campos>
<input type=hidden name=fin value="<? echo  $fin;?>" class=campos>
 </td>   
</tr>
</form>		
</table>
 <table align="center"  cellspacing="1" cellpadding="2" border="0" width=100% class=textos>
<tr align=center>
<form action=<? echo $_SERVER['PHP_SELF'];?> method=post name=user1>
<td align=right>
<?
	if($inicio>=$fin){
	  $inicio2=$inicio - $fin;				  
 ?>					  
<input type=submit name=enviar value="<< Anteriores" class=campos>
<input type=hidden name=inicio value="<? echo  $inicio2;?>" class=campos>
<input type=hidden name=fin value="<? echo  $fin;?>" class=campos>
<input type=hidden name=paginar value="<? echo  $paginar;?>" class=campos>
<?
}
?>
</td>
</form>
<form action=<? echo  $_SERVER['PHP_SELF'];?> method=post name=user2>
<td align=left>
<?
	if($inicio<=($total_url - $fin)){
	  $inicio1=$inicio+$fin;
 ?>
<input type=submit name=enviar value="Siguientes >>" class=campos>
<input type=hidden name=inicio value="<? echo  $inicio1;?>" class=campos>
<input type=hidden name=paginar value="<? echo  $paginar;?>" class=campos>
<input type=hidden name=fin value="<? echo  $fin;?>" class=campos>
<?}?>
</td>
</form>
</tr>
</table>

<? include("incluidos/pie.php");?>
</body>
</html>

