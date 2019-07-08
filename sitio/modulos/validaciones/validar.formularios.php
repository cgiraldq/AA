<?
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/

/*
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Validacion de datos al ingresar y manejo de perfiles
*/

session_start();
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/validacion.campos.php");
include("../../incluidos_modulos/class.rc4crypt.php");
//¿$db->debug=true;
$rc4 = new rc4crypt();


$idx=$_REQUEST["idx"];
$web=$_REQUEST["web"];


 $editar=$_REQUEST["editar"];
$idcampo=$_REQUEST["idy"];
$dstoken=$_REQUEST["dstoken"];
$idusuario=$_REQUEST["idusuario"];
$idgaleria=$_REQUEST["idgaleria"];
$idagrupamiento=$_REQUEST["idagrupamiento"];
$cercano=$_REQUEST["cercano"];
$idcliente=$_REQUEST["idcliente"];

$idfecha=date("Ymd");
$dsfecha=date("Y/m/d H:i:s");

$tablarelaciones="tblcercanosxpropiedades";
$tablaorigen="tblcercanos";

if($_SESSION['i_idperfil']==4){ $idusuario = $_SESSION['i_idusuario'];}

if($idusuario==""){ $idusuario=$_REQUEST["idusuario"];}
if($idusuario==""){ $idusuario=1;}

/////////// SE REVISA  DE QUE URL LLEGA A ESTA PAGINA
//$partir=explode("/",$_SERVER['HTTP_REFERER']);
	//$total=count($partir);
	//$dsrutap=$partir[$total-1];
$dsrutap=$_REQUEST["pagina"];

if($dsrutap=="consignar_clasificado.php"){
		$val=",clasgratis";
		$val1=",1";
	}



if($dsrutap=="consignar_propiedad.php"){
		$val=",clasgratis";
		$val1=",2";
	}


if($dsrutap==""){
		$val=",clasgratis";
		$val1=",2";
	}

if($dsrutap=="registro.php"){
	$clavee1 = $rc4->encrypt($s3m1ll4,"@adrianaarango");
			$clave1 = urlencode($clavee1);
		//$val=",dscampo28";
		//$val1=",'$clave;'";

	}


$sqlx="select a.dscampo from framecf_tbltiposformulariosxcampo a where id>0 and idtipoformulario='$idx' ";
$sqlx.="and idactivo not in(9)";
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

if($editar==1 || $editar==2){

$sqle=" update framecf_tblregistro_formularios set ";
$campose="";
$valorese="";

while(!$resultx->EOF){
		 $campose.=",".$resultx->fields[0];
		 $valorese.=",'".$_REQUEST[$resultx->fields[0]]."'";


		 if($resultx->fields[0]=='dscampo28' && $idx==1) {

		 	$clavee1 = $rc4->encrypt($s3m1ll4,$_REQUEST[$resultx->fields[0]]);
			$valorcampoe = urlencode($clavee1);

		 	$ingreso.=$resultx->fields[0]."='".$valorcampoe."',";
		 }else{
		 	if($_REQUEST[$resultx->fields[0]]<>""){
		 	 $ingreso.=$resultx->fields[0]."='".$_REQUEST[$resultx->fields[0]]."',";
		 	}
		 }

		$resultx->MoveNext();
	}
	$ingreso = trim($ingreso,',');
	$sqle.=" $ingreso,idfecha_mod='$idfecha',dsfecha_mod='$dsfecha',idusuario='$idusuario',idagrupamiento='$idagrupamiento'";
	$sqle.=" where id=$idcampo";
	$resulte=$db->Execute($sqle);

	$tablarelaciones="tblcercanosxpropiedades";
	$tablaorigen="tblcercanos";
	include("../relaciones/relaciones.operaciones.cercanos.php");

	include("cargar.propiedades.php");

if($dsrutap=="zona.privada.php"){
		$ruta="../../zona.privada.php?msn=1#actualizar_datos";
	}elseif($editar==2){
		  $ruta="../crm/registro/registros.editar.php?idx=$idx&idy=$idcampo&msn=3";
	}else{
		 $ruta="../crm/formularios/registros.editar.php?idx=$idx&idy=$idcampo&idgaleria=$idgaleria&msn=3";
	}

//exit();
}else{

// se consultan cuales son los campos de referencia del formulario
	$sqlval=" select dscampo from framecf_tbltiposformulariosxcampo where idref=1 and idtipoformulario='$idx' ";
		//echo $sqlval;
	$resultxxy=$db->Execute($sqlval);
	if(!$resultxxy->EOF){
	while(!$resultxxy->EOF){
		// se crea array con los campos de referencia del formulario
		$camposval.=$resultxxy->fields[0].",";
	$resultxxy->MoveNext();
	}
}
$resultxxy->Close();
// se le quita la ultima coma al array
 $camposval = trim($camposval,',');
// se crea vector con los campos referencia del formulario
$partir=explode(",",$camposval);
// funcion para contar el total del array
$cont=count($partir);

if($camposval=="") $camposval1="*";

// se valida si el registro ingresado ya se encuentra en el sistema
$sqlxy="select $camposval $camposval1 from framecf_tblregistro_formularios where idformulario='$idx' ";
	if($camposval=="")  $sqlxy.=" and id='-999999'";
		if(!$resultx->EOF){
		if($camposval<>"") {
			for ($i=0; $i < $cont; $i++) {
				$sqlxy.=" and ".$partir[$i]."='".$_REQUEST[$partir[$i]]."'";
			}
		}// fin validar
}
 	$resultxy=$db->Execute($sqlxy);

	if(!$resultxy->EOF){
 	$msn=2;
		//echo "registro ya esta en el sistema";
	}else{
		//echo "entra";
//exit()
if($idx==104){
$sqlverificar=" select id from framecf_tblregistro_formularios where idformulario=1 ";
$sqlverificar.=" and dscampo3='".$_REQUEST['dscampo14']."' and dscampo15='".$_REQUEST['dscampo15']."' and dscampo8='".$_REQUEST['dscampo16']."' and dscampo10='".$_REQUEST['dscampo17']."' ";
$resultverificar=$db->Execute($sqlverificar);
if(!$resultverificar->EOF){
	$idselect=$resultverificar->fields[0];

/*
		$sqlselect=" select id from framecf_tblregistro_formularios where idformulario=1 ";
		$sqlselect.=" and dscampo10='".$_REQUEST['dscampo17']."' ";
		$resultselect=$db->Execute($sqlselect);
		if(!$resultselect->EOF){
			$idselect=$resultselect->fields[0];
		}
		$resultselect->Close();
*/

}else{

		$sqlcliente=" insert into  framecf_tblregistro_formularios (dscampo3,dscampo15,dscampo8,dscampo10,idformulario,tipocliente,idactivo,idfecha,dsfecha,idusuario)values('".$_REQUEST['dscampo14']."','".$_REQUEST['dscampo15']."','".$_REQUEST['dscampo16']."','".$_REQUEST['dscampo17']."',1,'propietario',1,'$idfecha','$dsfecha','$idusuario')";
		$resultcliente=$db->Execute($sqlcliente);
		$sqlselect=" select id from framecf_tblregistro_formularios where idformulario=1 ";
		$sqlselect.=" and dscampo3='".$_REQUEST['dscampo14']."' and dscampo15='".$_REQUEST['dscampo15']."' and dscampo8='".$_REQUEST['dscampo16']."' and dscampo10='".$_REQUEST['dscampo17']."' ";
		$resultselect=$db->Execute($sqlselect);
		if(!$resultselect->EOF){
			$idselect=$resultselect->fields[0];
		}
		$resultselect->Close();
}
		$resultverificar->Close();
}


$db->Execute('LOCK TABLES framecf_tblregistro_formularios WRITE');
$db->Execute('SET AUTOCOMMIT = 0');
// si el registro no existe en el sistema se permite insertar
	$sql="insert into framecf_tblregistro_formularios ";
	$campos="";
	$valores="";
	while(!$resultx->EOF){
		$campos.=",".$resultx->fields[0];

		if($resultx->fields[0]=='dscampo28' && $idx==1) {

			if($_REQUEST[$resultx->fields[0]]==""){
				$clavee1 = $rc4->encrypt($s3m1ll4,'@adrianaarango');
				$valorcampoe = urlencode($clavee1);
			}else{
				$clavee1 = $rc4->encrypt($s3m1ll4,$_REQUEST[$resultx->fields[0]]);
				$valorcampoe = urlencode($clavee1);
			}

		 	$valores.=",'".$valorcampoe."'";
		 }else{
		 	$valores.=",'".str_replace("'", '\\\'', reemplazar($_REQUEST[$resultx->fields[0]]) )."'";
		 }

		$resultx->MoveNext();
	}
	$campos=substr($campos,1,strlen($campos));
	$valores=substr($valores,1,strlen($valores));
	$sql.=" (idformulario,idfecha,dsfecha,idactivo,$campos $val,idusuario,idpropietario,tipocliente,idagrupamiento,consecutivo) ";
	$sql.=" values  ";

	if($_REQUEST["idx"]==104){

		$sqlmax="SELECT MAX(consecutivo) from framecf_tblregistro_formularios WHERE idformulario='104' ";
		$resultmax=$db->Execute($sqlmax);
		if(!$resultmax->EOF){
			$consecutivo=$resultmax->fields[0];
			$consecutivo=$consecutivo+1;
		}
		$resultmax->Close();
	}
	if($idselect=="") $idselect=$idcliente;
	$sql.=" ('".$_REQUEST["idx"]."','$idfecha','$dsfecha',1,$valores $val1,'$idusuario','$idselect','propietario','$idagrupamiento','$consecutivo')";
	//echo "<br>";
	$result=$db->Execute($sql);
	$idultimo=mysql_insert_id();
	$idultimox=mysql_insert_id();

	$db->Execute('COMMIT');
	$db->Execute('UNLOCK TABLES');

	$msn=1; // datos insertados con exito
	$tablarelaciones="tblcercanosxpropiedades";
	$tablaorigen="tblcercanos";
	//include("../relaciones/relaciones.operaciones.cercanos.php");

	//include("cargar.propiedades.php");

}// fin else





if($_REQUEST["web"]==1){

///////////////////////// enviar correo ////////////////////////////
include("../../incluidos_modulos/encabezado_correo.php");
$sql="select dsasunto,dsenc,dsremate,dsasuntoar,dsimgencabezado,dsimgremate from framecf_tbltiposformularios where id=$idx";

$result=$db->Execute($sql);
if(!$result->EOF){
	$dsasunto=$result->fields[0];
	$dsenc=nl2br($result->fields[1]);
	$dsremate=nl2br($result->fields[2]);
	$dsasuntoar=$result->fields[3];

	$dsimg=$result->fields[4];
	$dsimg2=$result->fields[5];

$asunto="$dsasunto";
$asuntoa="$dsasuntoar";
$cuerpox="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
$cuerpox.="$asunto:<br>";

if($dsimg<>"")$cuerpo="<img src='http://www.adrianaarango.com/contenidos/images/empresa/$dsimg' alt='Logo'><br><br>";



//$cuerpo.="$asunto <br>";
$cuerpo.="$dsenc <br>";

$sqlx="select a.dsm,a.dscampo from framecf_tbltiposformulariosxcampo a where idtipoformulario=$idx ";
$sqlx.="and a.idactivo not in(2,9) and a.idpublicar=1 order by a.idposn ";

 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

$sql="select a.dscampo from framecf_tbltiposformulariosxcampo a where idtipo=5 and idtipoformulario=$idx ";

$result=$db->Execute($sql);
if(!$result->EOF){
$campo=$result->fields[0];

}
$result->Close();

$dscorreox=$_REQUEST[$campo];

$cuerpo.="<table style='width: 60%'>";
$cuerpo.="<table style='width: 60%'>";
$cuerpox.="<table style='width: 60%'>";
while(!$resultx->EOF){
// inicio cuerpo correo formulario//
$cuerpo.="<tr>";
$cuerpo.="<td style='width: 200px;font-family:Arial,Helvetica, sans-serif;font-size:small;color:#777777;'><strong> ".reemplazar($resultx->fields[0])." </strong></td>";
$cuerpo.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>".$_REQUEST[$resultx->fields[1]]."</td>";
$cuerpo.="</tr>";
// fin cuerpo correo formulario//
//inicio cuerpo correo admin//
$cuerpox.="<tr>";
$cuerpox.="<td style='width: 200px;font-family:Arial,Helvetica, sans-serif;font-size:small;color:#777777;'><strong> ".reemplazar($resultx->fields[0])." </strong></td>";
$cuerpox.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>".$_REQUEST[$resultx->fields[1]]."</td>";
$cuerpox.="</tr>";
//fin  cuerpo correo admin//
$datos.="<br>".$resultx->fields[0]." :".$_REQUEST[$resultx->fields[1]]."";
$resultx->MoveNext();

}

$cuerpo.="</table>";
$cuerpox.="</table>";

//exit();







$pass="@p#ya".date("Y");
if($idx==1) { $cuerpo.="<br><br>La clave para ingresar a la zona privada es: $pass ";

			$cuerpo.="<br><br>Si deseas ingresar a la zona privada haz click <a href='http://www.adrianaarango.com/sitio/login.php'>Aqu&iacute; </a> ";
			}

}
$resultx->Close();

$cuerpo.="<br><br>$dsremate<br><br>";

if($dsimg2<>"")$cuerpo.="<img src='http://www.adrianaarango.com/contenidos/images/empresa/$dsimg2' alt='Logo'><br><br>";

$cuerpo.="<table style='width: 60%' ";
$cuerpo.="<tr>";
$cuerpo.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>".$autorizado." Online ". date("Y")  ."</td>";
$cuerpo.="</tr>";
$cuerpo.="<tr>";
$cuerpo.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>Todos los derechos reservados</td>";
$cuerpo.="</tr>";
$cuerpo.="<tr>";
$cuerpo.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>Powered by <a href='http://www.comprandofacil.co/'>Comprandofacil</a></font></td>";
$cuerpo.="</tr>";
$cuerpo.="<tr>";
$cuerpo.="<td style='font-family: Arial, Helvetica, sans-serif;font-size: small'>IP remota: $remoto</td>";
$cuerpo.="</tr>";
$cuerpo.="</table>";
$cuerpox.="IP remota: <br>$remoto<br><br>";
$cuerpox.="==============================================================<br>";
$cuerpox.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
$cuerpox.="Powered by <a href='http://www.comprandofacil.co/' target='_blank'>http://www.comprandofacil.co</a></font><br>";
include("../../incluidos_modulos/enviadorcorreo.php");
}
$result->Close();



	if($dsrutap=="consignar_propiedad.php"){
		$ruta="../../gracias.php?msg=2&datos=$datos";
	}

	if($dsrutap=="contacto.php"){
		$ruta="../../gracias.php?msg=1&datos=$datos";
	}

	if($dsrutap=="detalle.php"){
		$ruta="../../gracias.php?msg=1&datos=$datos";
	}

	if($dsrutap=="consignar_clasificado.php"){
		$ruta="../../gracias.php?msg=3&datos=$datos";
	}

	if($dsrutap=="buscador.php"){
		$ruta="../../gracias.php?msg=1&datos=$datos";
	}

	if($dsrutap=="registro.php"){
		$ruta="../../gracias.php?msg=4&datos=$datos";
	}

	if($dsrutap=="servicios.detalle.php"){
		$ruta="../../gracias.php?msg=1&datos=$datos";
	}

	if($ruta==""){
	$ruta="../../gracias.php?msg=1&datos=$datos";
	}



//echo "hola mundo". $dsrutap;
//exit();
}else{

		if($idx==104 && $msn==1){
				$ruta="../crm/formularios/registros.editar.php?idx=104&idy=$idultimo&msn=$msn";
		}else if($cercano==1){
				$ruta="../crm/formularios/registros.editar.cercanos.php?idxx=104&idy=$idcampo&msn=$msn";
		}else if($editar==""){
				$ruta="../crm/registro/registros.editar.php?idx=1&idy=$idultimox&msn=$msn";
		}else{
			$ruta="../crm/formularios/listado.php?msn=$msn";
		}


}

}
}


$resultx->Close();

if($ruta==""){
$ruta="../../index.php";
}
//exit();
//include("../../incluidos_modulos/cerrarconexion.php");
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<?
// redireccionadores

?>
<script language="javascript">
<!--
location.href="<? echo $ruta;?>";
//-->
</script>

</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1>
</body>
</html>