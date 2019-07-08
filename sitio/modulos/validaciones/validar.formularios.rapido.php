<?

session_start();
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/validacion.campos.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();

//$db->debug=true;
$idx=$_REQUEST["idx"];
$web=$_REQUEST["web"];


 $guardarx=$_REQUEST["guardarx"];
$idcampo=$_REQUEST["idy"];


$idusuario=$_REQUEST["idusuario"];


$idcliente=$_REQUEST["idcliente"];

$idfecha=date("Ymd");
$dsfechax=date("Y/m/d");
$dsfecha=date("Y/m/d H:i:s");


$sqlx="select a.dscampo from framecf_tbltiposformulariosxcampo a where id>0 and idtipoformulario='$idx' ";
$sqlx.="and idactivo not in(9)";
//echo $sqlx;
//exit();

///////////////////////////////////////////////////////////////


 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// se consultan cuales son los campos de referencia del formulario
	$sqlval=" select dscampo from framecf_tbltiposformulariosxcampo where idref=1 and idtipoformulario='$idx' ";
	 $sqlval;
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

/////////////////////////////////// solo agrega gestion
if($guardarx==2){
//echo "entra";

// se valida si el registro ingresado ya se encuentra en el sistema
$sqlxy="select id,$camposval $camposval1 from framecf_tblregistro_formularios where idformulario='$idx' ";

	if($camposval=="")  $sqlxy.=" and id='-999999'";
		if(!$resultx->EOF){
		if($camposval<>"") {
			for ($i=0; $i < $cont; $i++) {
				$sqlxy.=" and ".$partir[$i]."='".$_REQUEST[$partir[$i]]."'  ";
			}
		}// fin validar
}
 //echo $sqlxy;
//exit();
	$resultxy=$db->Execute($sqlxy);

	if(!$resultxy->EOF){
 	$msn=2;
	$idultimo=$resultxy->fields[0];

	//echo "registro ya esta en el sistema";
}else{

$db->Execute('LOCK TABLES framecf_tblregistro_formularios WRITE');
$db->Execute('SET AUTOCOMMIT = 0');
// si el registro no existe en el sistema se permite insertar
	$sql="insert into framecf_tblregistro_formularios ";
	$campos="";
	$valores="";
	while(!$resultx->EOF){
		 $campos.=",".$resultx->fields[0];
		$valores.=",'".str_replace("'", '\\\'', reemplazar($_REQUEST[$resultx->fields[0]]) )."'";

		$resultx->MoveNext();
	}
	$campos=substr($campos,1,strlen($campos));
	$valores=substr($valores,1,strlen($valores));
	$sql.=" (idformulario,idfecha,dsfecha,$campos,idpropietario,tipocliente,idactivo,idusuario) ";
	$sql.=" values  ";
	if($idselect=="") $idselect=$idcliente;
	$sql.=" ('".$_REQUEST["idx"]."','$idfecha','$dsfecha',$valores,'$idselect','propietario','1','$idusuario')";

	$result=$db->Execute($sql);
	$idultimo=mysql_insert_id();

// dejar limpio el campo de observaciones


	$db->Execute('COMMIT');
	$db->Execute('UNLOCK TABLES');
	$msn=1; // datos insertados con exito
}// fin else
// fin guradar datos

/////////////////

}else if($guardarx==1){


$sqle=" update framecf_tblregistro_formularios set ";
$campose="";
$valorese="";

while(!$resultx->EOF){
		 $campose.=",".$resultx->fields[0];
		 $valorese.=",'".$_REQUEST[$resultx->fields[0]]."'";

		 if ($_REQUEST[$resultx->fields[0]]<>"") $ingreso.=$resultx->fields[0]."='".$_REQUEST[$resultx->fields[0]]."',";

		$resultx->MoveNext();
	}
	$ingreso = trim($ingreso,',');
	$sqle.=" $ingreso,idfecha_mod='$idfecha',dsfecha_mod='$dsfecha'";
	// $sqle.=",idusuario='$idusuario'", el usuario no se edita
	if ($idagrupamiento<>"") $sqle.=",idagrupamiento='$idagrupamiento'";
	$sqle.=" where id=$idcampo";
	//echo $sqle;
	//exit();
	$resulte=$db->Execute($sqle);
	$msn=1;

	//$sqlx=" UPDATE framecf_tblregistro_formularios SET dscampo31='' WHERE idformulario=1 and  ";
	//$result=$db->Execute($sqlx);



if($dsrutap=="zona.privada.php"){
		$ruta="../../zona.privada.php?msn=1#actualizar_datos";
	}elseif($editar==2){
		  $ruta="../crm/registro/registros.editar.php?idx=$idx&idy=$idcampo&msn=3";
	}else{
		 $ruta="../crm/formularios/registros.editar.php?idx=$idx&idy=$idcampo&idgaleria=$idgaleria&msn=3";
	}


}

////////////////

/////////////////////////////////// Inicio de validacion para envio de correo ///////////////////////////
if($_REQUEST["dsobs"]<>""){ // las observaciones

if($idultimo=="")$idultimo=$_REQUEST["idy"];
if ($dsfechallamada=="") $dsfechallamada=date("Y/m/d");
// se agrega motivo de la gestion y quien la registro mas la fecha de posible llamada
// validar si es la misma gestion para no repetirla
$sql="select id from framecf_tblgestionesxusuario  where dsd='".$_REQUEST["dsobs"]."'";
$sql.=" and usuario='$idusuario' and idmotivo='$idmotivo' and dsfechallamada='$dsfechallamada' ";
$sql.=" and idcliente='$idultimo' ";
//echo $sql;
//exit();

$result=$db->Execute($sql);
if ($result->EOF) { //no exite

$sqlx=" INSERT INTO framecf_tblgestionesxusuario (dsd,usuario,dsfecha";
$sqlx.=",idfecha,dsfechal,idactivo,";
$sqlx.="idcliente,idregistra,idmotivo";
$sqlx.=",dsfechallamada) ";
$sqlx.="  VALUES ('".$_REQUEST["dsobs"]."','".$_REQUEST["idusuario"]."'";
$sqlx.=",'$dsfechax','$idfecha','$dsfecha'";
$sqlx.=",'0','$idultimo','".$_SESSION['i_idusuario']."','$idmotivo','$dsfechallamada')";

$db->Execute($sqlx);
$msn=1;
// validar 
	
				$sql="select id from framecf_tblgestionesxusuario  where dsd='".$_REQUEST["dsobs"]."'";
				$sql.=" and usuario='$idusuario' and idmotivo='$idmotivo' and dsfechallamada='$dsfechallamada' ";
				$sql.=" and idcliente='$idultimo' ";
				//echo $sql;
				//exit();

				$resulty=$db->Execute($sql);
				if (!$resulty->EOF) { //no exite
					$idgestion=$resulty->fields[0];
				}
				$resulty->Close();	

} else {
	$idgestion=$result->fields[0];
}
$result->Close();
if ($msn==1) {
		//exit();
		///////////////////////// enviar correo ////////////////////////////
		$sql="select dsasunto,dsenc,dsremate,dsasuntoar,dsimgencabezado,dsimgremate from framecf_tbltiposformularios where id=$idx";

		$result=$db->Execute($sql);
		if(!$result->EOF){
			$dsasunto=$result->fields[0];
			$dsenc=nl2br($result->fields[1]);
			$dsremate=nl2br($result->fields[2]);
			$dsasuntoar=$result->fields[3];

			$dsimg=$result->fields[4];
			$dsimg2=$result->fields[5];

		$asuntoa="Se ha generado una gestion para usted ";


		$cuerpo.="<font face='arial'>$asunto <br>";
		// envio de correo indicando la gestion para el usuari deseado
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
					$cuerpo.="<br><strong>Datos del cliente:</strong> <br>";

		$dscorreox=$_REQUEST[$campo];
			while(!$resultx->EOF){
				if ($_REQUEST[$resultx->fields[1]]<>"") {
					$cuerpo.="<br>";
					$cuerpo.="<strong>".reemplazar($resultx->fields[0])."</strong>: ".reemplazar($_REQUEST[$resultx->fields[1]])."";
					$datos.="<br><strong>".$resultx->fields[0]."</strong>: ".$_REQUEST[$resultx->fields[1]]."";
				}
		$resultx->MoveNext();
		}
		}
		$resultx->Close();

		// datos de la gestion

		$cuerpo.="<br><br><strong>Gestion:</strong><br><br>";

		$cuerpo.="<strong>Observacion de la gestion</strong>: ".reemplazar($_REQUEST['dsobs'])."";
		$cuerpo.="<br>";

		$cuerpo.="<strong>Fecha posible de contacto con este cliente</strong>: ".reemplazar($_REQUEST['dsfechallamada'])."";
		$cuerpo.="<br><br>Ingrese al sistema para agendar este cliente, haciendo click <a href='http://$autorizado/sitio/admin.php'>aqui</a>.<br><br>";

		///////////////remate general///////////////////
		$cuerpo.="<br>==============================================================<br>";
		$cuerpo.= " ".$autorizado." Online ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.co/'>Comprandofacil</a></font><br>";
		///////////// fin remate general ///////////////
		//echo $cuerpo;
		$dscorreox=seldato("a.dscorreo","a.id"," tblusuarios a",$_REQUEST["idusuario"]." ",1);
		//echo $dscorreox;
		include("../../incluidos_modulos/encabezado_correo.php");
		//exit();
		if ($_REQUEST["idusuariorelacionado"]<>$_REQUEST["idusuario"]) {
			// enviar con copia avisando que el cliente esta siendo atentido por otra persona
			$dscorreo2=seldato("a.dscorreo","a.id"," tblusuarios a",$_REQUEST["idusuariorelacionado"]." ",1);
			$asunto2="Se ha generado una gestion para un cliente asociado a usted ";
			$cuerpo2=$cuerpo;
		}
		include("../../incluidos_modulos/enviadorcorreo.php");

		}
		$result->Close();
}  // fin msn=1
} // fin ingreso cuando es una gestion




/////////////////////////////////// Fin de validacion para envio de correo ///////////////////////////


}

$resultx->Close();


 if($msn==1){// ingresa y colocar mensaje de datos registrado con exito
 	if($idultimo=="")$idultimo=$_REQUEST["idy"];
	$ruta="../crm/registro/registros.respuesta.php?idx=1&idy=$idultimo&idgestion=$idgestion"; // ya existe y se envia
} elseif ($msn==2) {
	$ruta="../crm/registro/registros.editar.php?idx=1&idy=$idultimo&msn=$msn&nuevo=2"; // ya existe y no se envia
}


//echo $ruta;
//exit();
include("../../incluidos_modulos/cerrarconexion.php");
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