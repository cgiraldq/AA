<?
include("sessiones.php");
include("incluidos/funciones.php");
// ingreso 
$dspregunta=$_POST['dspregunta'];
if ($dspregunta==""){
	$dspregunta=$_GET['dspregunta'];
}			
$id=$_POST['id'];
if ($id==""){
	$id=$_GET['id'];
}

$dsnombre=$_POST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_GET['dsnombre'];
}


	if ($_POST['enviar1']=="Ingresar"){
				// ingreso de datos 
		$idactivo=$_POST['idactivo'];
		if ($idactivo==""){
			$idactivo=$_GET['idactivo'];
		}
		
			
				$sql = "select dspregunta from ".$prefix."tblrespuestas where dspregunta='$dspregunta' and idencuesta=$id ";
				$validar=mysql_db_query($dbase,$sql,$db);
				$resultado = @mysql_result($validar,"0","dspregunta");
				//echo $resultado;
				// validacion
				if ($resultado =="" || $resultado=0) {
					$sql= "insert into ".$prefix."tblrespuestas values (";
					$sql.="'',$id,'$dspregunta',0,$idactivo)";
					//exit();
					mysql_db_query($dbase,$sql,$db);
					$mensaje="<font color='$fondo8' class=fuente1>Datos ingresados con &eacute;xito al sistema</font>";
				} else {
					$mensaje="<font color='$fondo8' class=fuente1>El dato que intenta ingresar ya existe en el sistema!</font>";
				}
	}	
//modificacion
// pero usando ciclo
		if ($_POST['enviar']=="Modificar"){
		// ciclo de datos
		$dspregunta1=$_GET['dspregunta1'];
		if ($dspregunta1==""){
			$dspregunta1=$_POST['dspregunta1'];
		}
		$idactivo=$_GET['idactivo'];
		if ($idactivo==""){
			$idactivo=$_POST['idactivo'];
		}
		$idpregunta=$_GET['idpregunta'];
		if ($idpregunta==""){
			$idpregunta=$_POST['idpregunta'];
		}
		$contar=count($idpregunta);
		
		for ($i=0;$i<$contar;$i++){
			if ($dspregunta1[$i]<>""){
				$sql = " update ".$prefix."tblrespuestas set ";
				$sql.= "dspregunta='$dspregunta1[$i]' ";
				$sql.= ",idactivo =$idactivo[$i]";
				$sql.= " where id=".$idpregunta[$i]."";
				// echo $sql;
				//exit();
				mysql_db_query($dbase,$sql,$db);
			}
		}	
			$mensaje="<font color='$fondo8'><strong>Datos Modificados con &eacute;xito al sistema</strong></font>";					
		}
// eliminacion
	if ($_GET['enviar']=="Eliminar"){
	$idpregunta=$_POST['idpregunta'];
	if ($idpregunta==""){
		$idpregunta=$_GET['idpregunta'];
	}
			$sql = "delete from ".$prefix."tblrespuestas";
			$sql.= " where id=$idpregunta ";
			//echo $sql;
			//exit();
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
	
	if (document.u.dspregunta.value==""){
		alert("Debe ingresar la pregunta relacionada con la encuesta!");
		document.u.dspregunta.focus();
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
$sql="select id as total from ".$prefix."tblrespuestas where idencuesta=$id ";
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
if($inicio=="") {
	$inicio=0;
	if ($paginar<>""){
		$fin=$paginar;
	} else {
		$fin=50; // esta es la variable que controla la paginacion
	}
}	
	// fin variables de calculo de pantallazos
	$area1="select *";
	$area1.=" from ".$prefix."tblrespuestas where idencuesta=$id ";	
	$area1.=" order by dspregunta LIMIT $inicio,$fin ";
//	echo $area1;
//	exit();
?>
<br>
<table align="center"  cellspacing="0" cellpadding="0" border="0" width=80%>
<tr bgcolor="<? echo  $fondo3;?>" class=campos width=100%><td colspan=2><strong>Ingreso datos asociados a <? echo $dsnombre;?></strong></td></tr>
<form action="<? echo $_SERVER['PHP_SELF'];?>" method=post name=u>
<tr class=textos bgcolor="<? echo $fondo2;?>">
<td> Pregunta Asociada</td>
<td><input type=text name=dspregunta size=70 maxlength="255" value="<? echo $dspregunta;?>" class=campos></td>
</tr>

<tr class=textos bgcolor="<? echo $fondo2;?>">
<td> Activar en el web?</td>
<td>
	<select name=idactivo class=textos>
		<option value="1">SI</option>
		<option value="2">NO</option>
	</select>

</td>
</tr>



<tr bgcolor="<? echo $fondo2;?>"><td colspan=2 align=center>
<input type=button name="enviar1" value="Ingresar" oncLick="valU();" class=textos>
	<input type=button name=enviar value="Regresar" class=textos onClick="irA('encuestas.php');">
<input type=hidden name=id value="<? echo $id;?>">
<input type=hidden name=dsnombre value="<? echo $dsnombre;?>">
<input type=hidden name="enviar1" value="Ingresar">

</td></tr>
</form>
</table>
<br>
<table align="center"  cellspacing="0" cellpadding="0" border="0" width=100%>
<tr  class=campos width=100%><td colspan=2><strong>CONFIGURACI&Oacute;N  DEL SISTEMA</strong></td></tr>
<form action="<? echo  $_SERVER['PHP_SELF'];?>" method=post name=User>
<tr bgcolor="<? echo  $fondo7;?>" class=campos align=right width=100%><td colspan=2></td></tr>
<tr valign=top>
    <td width=40% class=campos align=left bgcolor="<? echo  $fondo2;?>">Ingrese o modifique .</td>
    <td width=60% bgcolor="<? echo  $fondo2;?>" class=campos>
	</td>
</tr>
</form>
</table>
 <table align="center"  cellspacing="0" cellpadding="0" border="0" width=100% class=textos>
 <tr align=center bgcolor="<? echo  $fondo3;?>">
 <td><strong>Encuesta</strong></td>
 <td><strong>Pregunta</strong></td>
 <td><strong>Cant Opiniones</strong></td>
 <td><strong>Activar?</strong></td>   
 <td><strong>Opciones</strong></td>   
 </tr>
 <form action="<? echo  $_SERVER['PHP_SELF'];?>" method=post name=User> 
 <?
 $vermas=mysql_db_query($dbase,$area1,$db);
	if(mysql_affected_rows()>0){
		$total=0;
		while($fila=mysql_fetch_object($vermas)) {
		$total=$total+$fila->idhits;
 ?>
 <tr align=center bgcolor="<? echo $fondo10;?>"  onMouseOver="uno(this,'<? echo $fondo5;?>');" onMouseOut="dos(this,'<? echo $fondo10;?>');" class="campos">
 <td ><strong><? echo $dsnombre;?></strong></td>
  <td ><input type=text name="dspregunta1[]" value="<? echo $fila->dspregunta;?>" size=40 maxlength="255" class="campos"></td>
    <td align="center"><? echo $fila->idhits;?></td>
 <td >
	<input type=hidden name="idpregunta[]" value="<? echo $fila->id;?>">
 	<select name=idactivo[] class=textos>
		<option value="1" <? if ($fila->idactivo=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($fila->idactivo=="2"){ echo "selected";}?>>NO</option>
	</select>
	
	
  <td >
  <A HREF="<? echo $_SERVER['PHP_SELF'];?>?id=<? echo $id;?>&dsnombre=<? echo $dsnombre;?>&idpregunta=<? echo $fila->id;?>&enviar=Eliminar&id1=<? echo $fila->id1;?>&id2=<? echo $fila->id2;?>">ELIMINAR</a>
  </td>      
 </tr> 		
<?
}
?>
<tr bgcolor="<? echo  $fondo2;?>">
<td ><font color=Red><strong>TOTAL</strong></font></td>
<td></td>
<td  align="center"><strong><? echo $total;?></strong></td></tr>
<td></td>
 <td></td>
</tr>
<?
} else {
?>
<tr><td bgcolor="<? echo  $fondo2;?>" colspan=2><font color=Red>A&uacute;n no hay datos disponibles</font></td></tr>
<?
}		
?>
<tr bgcolor="<? echo  $fondo3;?>">
<td></td>
<td></td>
 <td align="center" colspan="2">
	<input type=submit class=textos value="Modificar" name="enviar"> 	
	<input type=hidden name=inicio value="<? echo  $inicio1;?>" class=campos>
	<input type=hidden name=paginar value="<? echo  $paginar;?>" class=campos>
	<input type=hidden name=fin value="<? echo  $fin;?>" class=campos>
	<input type=hidden name=id value="<? echo $id;?>" class=campos>
	<input type=hidden name=dsnombre value="<? echo $dsnombre;?>" class=campos>
	<input type=button name=enviar value="Regresar" class=textos onClick="irA('encuestas.php');">
 </td>   
 <td></td>
</tr>
</form>		
 </table>

 <table align="center"  cellspacing="0" cellpadding="0" border="0" width=100% class=textos>
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
<input type=hidden name=id value="<? echo $id;?>" class=campos>
<input type=hidden name=dsnombre value="<? echo $dsnombre;?>" class=campos>
<?
}
?>
</td>
</form>
<form action=<? echo  $_SERVER['PHP_SELF'];?> method=post name=user1>
<td align=left>
<?
	if($inicio<=($total_url - $fin)){
	  $inicio1=$inicio+$fin;
 ?>
<input type=submit name=enviar value="Siguientes >>" class=campos>
<input type=hidden name=inicio value="<? echo  $inicio1;?>" class=campos>
<input type=hidden name=paginar value="<? echo  $paginar;?>" class=campos>
<input type=hidden name=fin value="<? echo  $fin;?>" class=campos>
<input type=hidden name=id value="<? echo $id;?>" class=campos>
<input type=hidden name=dsnombre value="<? echo $dsnombre;?>" class=campos>
<?}?>
</td>
</form>
</tr>
</table>
<? include("incluidos/pie.php");?>
</body>
</html>

