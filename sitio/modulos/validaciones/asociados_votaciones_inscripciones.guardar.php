<?
session_start();
include('../../incluidos_modulos/varconexion.php');
if(function_exists('date_default_timezone_set')) { 
   date_default_timezone_set('America/Bogota'); 
} else { 
   putenv("TZ=America/Bogota"); 
} 

$db=mysql_connect($servidor,$usuario,$clave);
// ARCHIVO GENERAL DEL INGRESO DE LA FICHA DEL CANDIDATO POSTULADO
$idficha=$_REQUEST['idficha'];	
$tipo=23;
$idasociado=$_SESSION['i_cedula'];
$correo=$_SESSION['i_dsemail'];
//
$idx=$_REQUEST['idx'];
$dsx=$_REQUEST['dsx'];
//
$idy=$_REQUEST['idy'];
$dsy=$_REQUEST['dsy'];
$dscedula=$_SESSION['i_cedula'];

//
$idtv=$_REQUEST['idtv'];
$dstv=$_REQUEST['dstv'];
$idtipov=$_REQUEST['idtv'];
$regresar=$_REQUEST['regresar'];
if ($regresar=="1") $idasociado=$_REQUEST['idasociado'];



// traer la zona electoral
$sql="select dszonaelectoral,dscodigoasociado as dscodigo,dsnombre,dscodigo as dscedula from tblvotacionasociados_temp where dscodigo='$dscedula'";
$vermas=mysql_db_query($database,$sql,$db);
if(mysql_affected_rows()>0){
	$zonaelectoral=mysql_result($vermas,"0","dszonaelectoral");
	$codigo=mysql_result($vermas,"0","dscodigo");
	$dsnombrex=mysql_result($vermas,"0","dsnombre");
	$dscedulax=mysql_result($vermas,"0","dscedula");
	
	
	
	
}
mysql_free_result($vermas);
$dsnombre= $_SESSION['i_dsnombre'];
if ($regresar=="1") { 
	$dsnombre=$dsnombrex;
	$dscedula=$dscedulax;
}	
$idfecha=date("Ymd");
$idhora=date("h:i:s a");
$dsfecha=date("Y/m/d h:i:s a ");
$rutaImagen="../../../contenidos/images/fichatecnica/";
if ($_FILES['userfile']['name']<>"") {
		$temp_name =$_FILES['userfile']['tmp_name'];
		$nombre1=$codigo."_foto_".$_FILES['userfile']['name'];
		if (move_uploaded_file($temp_name,$rutaImagen.$nombre1)) { 
				$foto=$nombre1;
		} else { 
			$foto = "NO";
		}
 } else { 
	$foto=$_REQUEST['foto'];
 }
 //exit();
 //$dscorreo=$_GET['dscorreo'];
 // borrado
$sql=" delete from tblvotacionfichatecnicaasociados ";
$sql.=" where idficha=$idficha and idasociado=$idasociado";
//echo $sql;
//exit();

if ($idficha==""){ 
	$rutair="asociados_bienvenido.php";
	echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
	exit();
}

mysql_db_query($database,$sql,$db);
			$sql=" select id,dsm as dsnombre,idtipo as tipo from tblvotacionfichatecnicapreguntas  ";
			$sql.=" where idficha=$idficha order by id ASC";
			//echo $sql;
			$vermas=mysql_db_query($database,$sql,$db);
			if(mysql_affected_rows()>0){
				while($fila=@mysql_fetch_object($vermas)) {
				$idpreg=$fila->id;
				$tipo=$fila->tipo;
				$campobase="idresp$idpreg"; // armazon de la variable
				/// construir variable de datos
					if ($tipo==3 || $tipo==1) { // tipo unica respuesta o texto
						$ccampobase=$_REQUEST[$campobase];
						if ($tipo==3){ // texto
							$ccampobasen=0;
							$ccampobaset=$_REQUEST[$campobase];
						} else { // seleccion unica
							$ccampobaset=0;
							$ccampobasen=$_REQUEST[$campobase];
						}
						if ($ccampobase<>"") { 
							$sql="insert into tblvotacionfichatecnicaasociados ";
							$sql.=" values (";
							$sql.="'0',$idasociado,$idficha,$idpreg,$ccampobasen,'$ccampobaset'";
							$sql.=",'$dsfecha',$idfecha";
							$sql.=")";
							//echo $sql."<BR>";
							
						}
						mysql_db_query($database,$sql,$db);
						// echo $sql."<br>";
					} elseif($tipo==2){ // multiple respuesta
						// CONTAR
						$total=count($_REQUEST[$campobase]);
						for ($j=0;$j<$total;$j++) { 
							if ($_REQUEST[$campobase][$j]<>""){
								// insertar
								$ccampobase=$_REQUEST[$campobase][$j];	
								$sql="insert into tblvotacionfichatecnicaasociados ";
								$sql.=" values (";
								$sql.="'0',$idasociado,$idficha,$idpreg,$ccampobase,'0'";
								$sql.=",'$dsfecha',$idfecha";
								$sql.=")";
								//echo $sql."<BR>";
								mysql_db_query($database,$sql,$db);	
								//echo $sql;			
							} 
							
						}
					}
				}
			}
		//	exit();
			mysql_free_result($vermas);
			
			if ($regresar=="1") { 
			$sql="delete from tblcandidatos where idasociado=$idasociado";
			$sql.=" and dscodigo='$codigo' and idficha=$idficha";
			//echo $sql;
			//exit();
			//mysql_db_query($database,$sql,$db);
			
			}
			
			// validacion que ya exista como candidato
	        $sql="select id from tblcandidatos where idasociado=$idasociado";
			$sql.=" and dscodigo='$codigo' and idficha=$idficha and idactivo<>999 ";
			//echo $sql;
			$ssql=mysql_db_query($database,$sql,$db);
			
			$total=mysql_num_rows($ssql);
				if ($total > 0){
					$mensaje=" ";
				} else {
			    $sql= "insert into tblcandidatos  (idficha,idtipov,idasociado,dsasociado,dscedula,dscodigo,foto,fecharegistro,idfecharegi,idhorareg,idactivo,idzona) values (";
				$sql.="'$idficha','$idtipov','$idasociado','$dsnombre','".$_SESSION['i_cedula']."','".$codigo."','$foto','$dsfecha',$idfecha,'$idhora',3,'$zonaelectoral')";
				//echo $sql;
				//exit();
				
				if (!mysql_db_query($database,$sql,$db)){ 
				$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
				echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
				exit();
				}
				
				if ($dsnombre==""){ 
				$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
				echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
				exit();
				}
				if ($idtipov==0){ 
				$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
				echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
				exit();
				}
				
				// aca proceso de envio de datos 
				

				$headers= "From: webmaster@coogranada.com\n";
				$headers.= "Organization: coogranada\n";
				$headers.= "MIME-Version: 1.0\n";
				$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
				$headers.= "Content-Transfer-Encoding: 8bit\n";
				$asunto="Inscripción Para Candidatos";
				$cuerpo= " <font face='Arial' size=-1>Apreciado(a) administrador:</strong><br>";
				$cuerpo1= " <font face='Arial' size=-1>Apreciado(a) Asociado(a):</strong><br>";
				$cuerpo.= " Estos son los datos del Asociado:<br>";
				$cuerpo1.= "Gracias por llenar la Inscripcion a Candidatos :<br>";
				$cuerpo1.= " Sus Datos son:<br>";
				$cuerpo.= " Nombre: $dsnombre<br>";
				$cuerpo.= " Codigo: $codigo<br>";
				$cuerpo.= " Zona Electoral: $zonaelectoral<br>";
				$cuerpo.= " Fecha de Inscrpción: $dsfecha<br>";
				$cuerpo1.= " Nombre: $dsnombre<br>";
				$cuerpo1.= " Codigo: $codigo<br>";
				$cuerpo1.= " Zona Electoral: $zonaelectoral<br>";
				$cuerpo1.= " Fecha de Inscrpción: $dsfecha<br>";
				$cuerpo.= " Para mas información, ingrese al panel administrativo y visite la seccion de Candidatos<br>";
				$cuerpo.="==============================================================<br>";	
				$cuerpo.= " coogranada On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
				$cuerpo1.="==============================================================<br>";	
				$cuerpo1.= " coogranada On line ". date("Y")  ." <br>Todos los derechos reservados<br>";


				// query para la fica y sus imagenes
					$sql5="select a.* from ";
					$sql5.=" tblvotacionfichatecnica a ";
					$sql5.=" where idactivo=1 ";
					$sql5.=" and idtv=$idtv";
					   
				//$sql5="select * from cfvttblfichatecnica where idtipov='$idtipov'";
				// $sql5.=" order by id desc limit 0,1";
				//echo $sql5;
				//exit();
				$vermas5=mysql_db_query($database,$sql5,$db);
				if(mysql_affected_rows()>0){
				$fila5=mysql_fetch_object($vermas5);
				 $encabezado=$fila5->dsimgenc;
				 $enca="contenidos/images/fichatecnica/".$encabezado;
				 $pie=$fila5->dsimgpie;
				 $pi="contenidos/images/fichatecnica/".$pie;
				 $cerficha=$fila5->dsdcertinscripcion; 
				 
				 }
					 
				mysql_free_result($vermas5);
				 
				 // termina el query de la ficha
				
				
				// fin proceso de envio de datos
	
				$cuerpo1.="<br>"; 
				if ($enca<>"" && $enca<>"NO" ){
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				//$cuerpo1.= "<img src='http://localhost:8080/amedida/coogranada/".$enca."'><br><br>";
				$cuerpo1.= "<img src='http://www.coogranada.com/".$enca."'><br><br>";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table>";
				}
						  
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" Señor(a): $dsnombre <br><br>";
				$cuerpo1.=" $cerficha <br><br>";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br><br><br>";  
				
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" A continuación el resumen de su Inscripción:";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br>";            
										  
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" Hora de Inscripción: $dsfecha";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br>"; 
				
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" INSCRITO POR ZONA ELECTORAL: $zonaelectoral";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br><br>"; 
						 
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" SI DESEA UN REPORTE DE INSCRIPCIÓN IMPRIMA ESTA INFORMACIÓN";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br>"; 		 
				if ($pi<>"" && $pi<>"NO" ){		 
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				//$cuerpo1.= "<img src='http://localhost:8080/amedida/coogranada/".$pi."'><br><br>";
				$cuerpo1.= "<img src='http://www.coogranada.com/".$pi."'><br><br>";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table>";       
				}
				
				$cuerpo.="<br>"; 
				if ($enca<>"" && $enca<>"NO" ){
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				//$cuerpo.= "<img src='http://localhost:8080/amedida/coogranada/".$enca."'><br><br>";
				$cuerpo.= "<img src='http://www.coogranada.com/".$enca."'><br><br>";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table>";
				}
						  
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" Señor(a): $dsnombre <br><br>";
				$cuerpo.=" $cerficha <br><br>";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br><br><br>";  
				
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" A continuación el resumen de su Inscripción:";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br>";            
										  
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" Hora de Inscripción: $dsfecha";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br>"; 
				
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" INSCRITO POR ZONA ELECTORAL: $zonaelectoral";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br><br>"; 
						
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" SI DESEA UN REPORTE DE INSCRIPCIÓN IMPRIMA ESTA INFORMACIÓN";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br>"; 		 
				if ($pi<>"" && $pi<>"NO" ){	
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				//$cuerpo.= "<img src='http://localhost:8080/amedida/coogranada/".$pi."'><br><br>";
				$cuerpo.= "<img src='http://www.coogranada.com/".$pi."'><br><br>";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table>";       
				}
				
				//echo $cuerpo;
				//exit();
				// traer los campos que indican si esta votacion tiene activo la opcion de enviar datos
					$sqlcer="select *  from tbltipovotacion ";
					$sqlcer.=" where  id=$idtv";
					//echo $sqlcer;
					//exit();
					$vermascer=mysql_db_query($database,$sqlcer,$db);
					 if(mysql_affected_rows()>0){
					 $filacer=mysql_fetch_object($vermascer);
					 
					 $sincerinscri=$filacer->idcertinscripcion; // CERTIFICADO DE INSCRIPCION
					 $mostrarcerinscri=$filacer->idimprcertins; // CERTIFICADO DE INSCRIPCION
					}
					mysql_free_result($vermascer);
					
					
					// correos de confirmacion de informacion
					
					$sql1="select * from tblvotacioncorreosconfirmacion ";
					$sql1.=" where idactivo=1 ";
					$sql1.=" order by id desc";	
					   $vermas1=mysql_db_query($database,$sql1,$db);
					   if(mysql_affected_rows()>0){
					   while ($fila1=mysql_fetch_object($vermas1)){
						$paramatrocorreo=$fila1->dsm;
						//echo $paramatrocorreo."<br>";
						if ($regresar=="") mail($paramatrocorreo, $asunto, $cuerpo, $headers);	
						}
					}
					 mysql_free_result($vermas1);
				

					
				if($sincerinscri=="1" &&  $mostrarcerinscri=="1"){ 
				
				
				if ($regresar=="") mail($correo, $asunto, $cuerpo1, $headers);	
				if ($regresar=="") mail("desarrollo@comprandofacil.com", $asunto, $cuerpo1, $headers);	
				
				//if ($correopersonal<>"") if ($regresar=="") mail($correopersonal,$asunto,$cuerpo1,$headers);		
				}

	
			
			}				
					
     		//	echo $sql;
				//exit();
			
	
			
			

//if ($redir==4) { 
	
	 
	 
	 //
	 
	 


//echo $cuerpo;
//echo $cuerpo1;
//exit();
if ($regresar=="") {
	$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
	
} else { 
	$rutair="../modulos/votaciones/tipovotacion/candidatos.php?idtv=$idtv";
	
}
//echo $rutair;
mysql_close($db);
//exit();
?>
<html>
<title>ENVIANDO....</title>
<head>
<meta http-equiv="REFRESH" content="1; URL=<? echo $rutair?>">
</head>
<body>
<br>
<div align="center">
<br>
<font face=Arial size=-1>
 Un momento mientras es redireccionado...
</font>
</div>
</body>
</html>