<?
session_start();
include('../../incluidos_modulos/varconexion.php');
if(function_exists('date_default_timezone_set')) { 
   date_default_timezone_set('America/Bogota'); 
} else { 
   putenv("TZ=America/Bogota"); 
} 
$db=mysql_connect($servidor,$usuario,$clave);
// ARCHIVO GENERAL DE LA EVALUACION

$idficha=$_REQUEST['idficha'];	
$blanco=$_REQUEST['blanco'];	
$idcandidato=$_REQUEST['idcandidato'];
$dscandidato=$_REQUEST['dscandidato'];
$zonaelectoral=$_REQUEST['zonaelectoral'];

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
$dsnombre= $_SESSION['i_dsnombre'];
if ($regresar=="1") { 
	$dsnombre=$dsnombrex;
	$dscedula=$dscedulax;
}	
$idfecha=date("Ymd");
$idhora=date("H:i:s");

$dsfecha=date("Y/m/d H:i:s a ");
$dsfechacorta=date("Y/m/d");


$sql="select dszonaelectoral,dscodigoasociado as dscodigo,dsnombre,dscodigo as dscedula from tblvotacionasociados_temp where dscodigo='$dscedula'";
$vermas=mysql_db_query($database,$sql,$db);
if(mysql_affected_rows()>0){
	$zonaelectoral=mysql_result($vermas,"0","dszonaelectoral");
	$codigo=mysql_result($vermas,"0","dscodigo");
	$dsnombrex=mysql_result($vermas,"0","dsnombre");
	$dscedulax=mysql_result($vermas,"0","dscedula");
	
	
	
}
//echo $zonaelectoral." -- ".$codigo." -- ".$dsnombrex." -- ".$dscedulax;
//exit();
mysql_free_result($vermas);
$dsnombre= $_SESSION['i_dsnombre'];
if ($regresar=="1") { 
	$dsnombre=$dsnombrex;
	$dscedula=$dscedulax;
}	



if ($idtv==""){ 
	$rutair="../../votaciones.php";
	echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
	exit();
}

			
			// validacion que ya haya realizado la votacion previa
	        $sql="select id from tblvotacionresultados_votos where dscodigo='".$codigo."' and idtipov=$idtv ";
			//echo $sql;
			$ssql=mysql_db_query($database,$sql,$db);
			
			$total=mysql_num_rows($ssql);
				if ($total > 0){
					$mensaje=" ";
				} else {
				
				if ($blanco=="1") { // VOTO EN BLANCO
				
			    $sql= "insert into tblvotacionresultados_votos  (idficha,idtipov,idasociado,idcandidato,dscandidato,dszona,dsfecha,idfecha,dsfechacorta,idhora,dstipo,dscodigo,dscedula) values (";
				$sql.="'$idficha','$idtipov',$idasociado,$idcandidato,'".$dscandidato."','$zonaelectoral','$dsfecha',$idfecha,'$dsfechacorta','$idhora','VOTO EN BLANCO','$codigo','$dscedulax')";
				//echo $sql;
				//exit();
				
					if (!mysql_db_query($database,$sql,$db)){ 
					$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
					echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
					exit();
					}
				
				} else { 
				// VOTACION DE LOS CANDIDATOS SELECCIONADOS
					$valido=0;
					$idcandidato=$_REQUEST['idcandidato'];
					$total=count($idcandidato);
					if ($total>0) { 
					for ($i=0;$i<$total;$i++){ 
						// partir la cadena
						$partir=explode("|",$idcandidato[$i]);
						$idcandidatox=$partir[0];
						$idfichax=$partir[1];
						$dscandidatox=$partir[2];
						
						$sql= "insert into tblvotacionresultados_votos  (idficha,idtipov,idasociado,idcandidato,dscandidato,dszona,dsfecha,idfecha,dsfechacorta,idhora,dstipo,dscodigo,dscedula) values (";
						$sql.="'$idfichax','$idtipov',$idasociado,$idcandidatox,'".$dscandidatox."','$zonaelectoral','$dsfecha',$idfecha,'$dsfechacorta','$idhora','VOTO POR ASOCIADO','$codigo','$dscedulax')";
						//echo $sql."<br>";
						
						if (!mysql_db_query($database,$sql,$db)){ 
						$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
						echo "Se ha presentando un problema durante el proceso de ingreso de su registro. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
						exit();
						}
					
					}
					//exit();
					} else { 
						$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
						echo "Debe seleccionar al menos un candidato para la votacion. Por favor <a href='$rutair'>intentelo de nuevo</a>. Si el problema persiste, contacte al administrador";	
						exit();
				
					}
					//exit();
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
				
				// AUDITORIA DE ESTE PROCESO DE VOTACION
				
				$fechaBaseLarga= date ( "Y/m/d h:i:s a" );
				$fechaBaseNum= date ( "Ymd" );
				$remoto=$_SERVER["REMOTE_ADDR"];
				$dsruta=$_SERVER["PHP_SELF"];

				$hora = date("H:i:s");
				$dstitulo="Votacion en zona electoral";
				$dsdesc=" El usuario ".$codigo." genero una votacion en $dstv para la zona $zonaelectoral";
				$dsruta=$pagina;
				$titulomodulo="Zona Asociados Votaciones";

				$sqlx="insert into tblasociados_auditoria ";
				$sqlx.=" (dsnombre,dsusuario,dsmodulo,dstitulo,dsdesc,dsruta,dsfecha,idfecha,dsip)";
				$sqlx.=" values ( ";
				$sqlx.=" '".$dsnombre."','".$codigo."'";
				$sqlx.=" ,'".$titulomodulo."','".$dstitulo."'";
				$sqlx.=" ,'".$dsdesc."','".$dsruta."'";
				$sqlx.=" ,'".$fechaBaseLarga."',".$fechaBaseNum.",'".$remoto."'";
				$sqlx.=" ) ";
				//echo $sqlx;
				//exit();
				mysql_db_query($database,$sqlx,$db);
				
				
				// aca proceso de envio de datos 
				

				$headers= "From: webmaster@coogranada.com\n";
				$headers.= "Organization: coogranada\n";
				$headers.= "MIME-Version: 1.0\n";
				$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
				$headers.= "Content-Transfer-Encoding: 8bit\n";
				$asunto="Votacion para $dstv";
				$cuerpo= " <font face='Arial' size=-1>Apreciado(a) administrador:</strong><br>";
				$cuerpo1= " <font face='Arial' size=-1>Apreciado(a) Asociado(a):</strong><br>";
				$cuerpo.= " Estos son los datos del Asociado:<br>";
				$cuerpo1.= "Gracias por realizar la votacion :<br>";
				$cuerpo1.= " Sus Datos son:<br>";
				$cuerpo.= " Nombre: $dsnombre<br>";
				$cuerpo.= " Codigo: $codigo<br>";
				$cuerpo.= " Zona Electoral: $zonaelectoral<br>";
				$cuerpo.= " Fecha de Votacion: $dsfecha<br>";
				$cuerpo1.= " Nombre: $dsnombre<br>";
				$cuerpo1.= " Codigo: $codigo<br>";
				$cuerpo1.= " Zona Electoral: $zonaelectoral<br>";
				$cuerpo1.= " Fecha de Votacion: $dsfecha<br>";
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
				 $cerficha=$fila5->dsdcertvotacion; 
				 
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
				$cuerpo1.=" A continuación el resumen de su votacion:";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br>";            
										  
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" Hora de votacion: $dsfecha";
				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br>"; 
				
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" VOTACION EN LA ZONA ELECTORAL: $zonaelectoral";
				if ($blanco=="") $cuerpo1.="<br><br>VOTO EN BLANCO SI (  )   NO ( x )<br><br>";
				if ($blanco=="1") $cuerpo1.="<br><br>VOTO EN BLANCO SI ( x ) <br><br>";

				$cuerpo1.="</td>";
				$cuerpo1.="</tr>";
				$cuerpo1.="</table><br><br><br>"; 
						 
				$cuerpo1.="<table width='739' align='center'>";    
				$cuerpo1.="<tr class='textodoc2'>";  
				$cuerpo1.="<td  valign='top'>";          
				$cuerpo1.=" SI DESEA UN REPORTE DE VOTACION IMPRIMA ESTA INFORMACIÓN";
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
				$cuerpo.=" A continuación el resumen de su Votacion:";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br>";            
										  
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" Hora de Votacion: $dsfecha";
				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br>"; 
				
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" VOTACION EN LA ZONA ELECTORAL: $zonaelectoral";
				if ($blanco=="") $cuerpo.="<br><br>VOTO EN BLANCO SI (  )   NO ( x )<br><br>";
				if ($blanco=="1") $cuerpo.="<br><br>VOTO EN BLANCO SI ( x ) <br><br>";

				$cuerpo.="</td>";
				$cuerpo.="</tr>";
				$cuerpo.="</table><br><br><br>"; 
						
				$cuerpo.="<table width='739' align='center'>";    
				$cuerpo.="<tr class='textodoc2'>";  
				$cuerpo.="<td  valign='top'>";          
				$cuerpo.=" SI DESEA UN REPORTE DE VOTACION IMPRIMA ESTA INFORMACIÓN";
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
				
				//echo $cuerpo1;
				//exit();
				// traer los campos que indican si esta votacion tiene activo la opcion de enviar datos
					$sqlcer="select *  from tbltipovotacion ";
					$sqlcer.=" where  id=$idtv";
					//echo $sqlcer;
					//exit();
					$vermascer=mysql_db_query($database,$sqlcer,$db);
					 if(mysql_affected_rows()>0){
					 $filacer=mysql_fetch_object($vermascer);
					 
					 $sincerinscri=$filacer->idcertvotacion; // CERTIFICADO DE VOTACION
					 $mostrarcerinscri=$filacer->idimprcervot; // CERTIFICADO DE INSCRIPCION
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
				
				
				//echo $correo;
				//exit();
				
				if ($regresar=="") @mail($correo, $asunto, $cuerpo1, $headers);	
				//if ($regresar=="") mail("consultorweb@comprandofacil.com", $asunto, $cuerpo1, $headers);	
				
				//if ($correopersonal<>"") if ($regresar=="") mail($correopersonal,$asunto,$cuerpo1,$headers);		
				}

	
			
			} // fin valudacion de existencia del total				
					
     		//	echo $sql;
				//exit();
			
	
			
			

//if ($redir==4) { 
	
	 
	 
	 //
	 
	 


//echo $cuerpo;
//echo $cuerpo1;
//exit();
$rutair="../../votaciones.php?idy=$idy&dsy=$dsy&idx=$idx&dsx=$dsx";
mysql_close($db);
?>
<html>
<title>ENVIANDO....</title>
<head>
<meta http-equiv="REFRESH" content="1; URL=<? echo $rutair?>">
</head>
<body>
<br>
<div align="center">
<!--IMG src="img/logo_new_coogranada.jpg"-->
<br>
<font face=Arial size=-1>
 Un momento mientras es redireccionado...
</font>
</div>
</body>
</html>