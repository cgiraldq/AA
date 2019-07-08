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
// Variables generales de uso
// abecedario para el buscador
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$idtienda=1; // este control se aplica para las tiendas
$rutaFuenteImagenes=".."; //".."
$rutaLogoPrincipal="logo_principal.png";

if ($idtienda>1) $rutaFuenteImagenes="http://localhost:8082/coogranada/"; // ruta de origen de datos siempre y cuando sea tienda no primaria
//if ($idtienda>1) $rutaFuenteImagenes="http://www.tvcamaras.com"; // ruta de origen de datos siempre y cuando sea tienda no primaria
$rutaLogoTienda="logo_principal.png";
$rutaLogoTiendaRemate="logo_remate.png";
if ($idtienda>1) $rutaLogoTienda="logo_principal.png"; // ruta de origen de datos siempre y cuando sea tienda no primaria
if ($idtienda>1) $rutaLogoTiendaRemate="logo_remate.png"; // ruta de origen de datos siempre y cuando sea tienda no primaria
$rutaAmiga=1; // prende las rutas en 1
$apagar=1;
$rutacomunes="../../sitio2";//
$autorizado="www.coogranada.com/";
$correoautorizado="info@coogranada.com";
$rutaComprasYpagos="http://$autorizado/sitio/";

$nombreautorizado="Coogranada";
$rutaComprasYpagos="http://$autorizado/sitio/";
// ruta de sindicacion
$dirredesx="www.coogranada.com/"; // cambia si no es tienda referida
$icono1="../../img_modulos/modulos/icono4.jpg";
-$icono2="../../img_modulos/modulos/icono4(2).jpg";
$rutabase="../../../imagenes/";
$rutaGeneral="../../../contenidos/";
$tipoconstructor=2;//para las rutas amigrables, si es 1 va a la ruta amigrable y si es 2 va al detalle con id
//$rutaInclude="/tv.camaras/sitio";

//$rutalocalimag="/sitio2";
//$rutalocalimag="/coogranada/"; // comentar en el servidor

//$rutaInclude="sitio";
//$rutaAbs="http://localhost:8082/comprandofacil/$rutaInclude/";
$rutaAbs="http://$autorizado/$rutaInclude/"; // en produccion prender este y apagar el otro
$version="8.5";
date_default_timezone_set('America/Bogota');
$vector="A,B,C,D,E,F,G,H,I,J,K,L,M,N,Ñ,O,P,Q,R,S,T,U,V,W,X,Y,Z";
/*RUTAS LOCALES Y PRODUCCION*/
//$rutalocal="/coogranada/sitio2";// RUTA LOCAL COMENTAR LINEA CUANDO SE PUBLIQUE EN SERVIDOR
$rutalocal="/sitio2";
//$rutbase=$rutalocal."/".$rutaInclude."/"; //  RUTA LOCAL COMENTAR LINEA CUANDO SE PUBLIQUE EN SERVIDOR
$rutbase="/".$rutaInclude."/"; //DESCOMENTAR LINEA CUANDO SE PUBLIQUE EN SERVIDOR

$letras[0]="A";
$letras[1]="B";
$letras[2]="C";
$letras[3]="D";
$letras[4]="E";
$letras[5]="F";
$letras[6]="G";
$letras[7]="H";
$letras[8]="I";
$letras[9]="J";
$letras[10]="K";
$letras[11]="L";
$letras[12]="M";
$letras[13]="N";
$letras[14]="Ñ";
$letras[15]="O";
$letras[16]="P";
$letras[17]="Q";
$letras[18]="R";
$letras[19]="S";
$letras[20]="T";
$letras[21]="U";
$letras[22]="V";
$letras[23]="W";
$letras[24]="X";
$letras[25]="Y";
$letras[26]="Z";



// fin abecedario para el buscador
// meses
$mesesVector="Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre";
$AppNombre="Informer - Administrador de contenidos";
// fin meses
// fin vector de entidades de salud

//$tipoenviocorreo=1;// disparador de php mailer// local
$tipoenviocorreo=1;// disparador de php mail//servidor

$donde=$_SERVER["PHP_SELF"];
$referido=$_SERVER["HTTP_REFERER"];
$remoto=$_SERVER["REMOTE_ADDR"];
$servidor=$_SERVER["HTTP_HOST"];
// fin variables de gestion adicionales
// variables de correos globales
$smtpbase="correo.comprandofacil.com";
$correobase="servicioalcliente@comprandofacil.com";
$clavebase="u4fxgqe7";
$dsport=587;

$s3m1ll4="cf4nfo4mr5@3009"; // FAVOR NO MODIFICAR. PUEDE DESCONFIGURAR EL SISTEMA
$fechaBase=date("Y/m/d"); // fecha de ingreso de registros
$fechaBaseLarga=date("Y/m/d h:i:s a"); // fecha de ingreso de registros
$fechaBaseNum=date("Ymd"); // fecha numerica
// perfiles
$perfil[0]=0; // administrador
$perfil[1]=1; // Direccion Proyectos
$perfil[2]=2; // Direccion Comercial
$perfil[3]=3; // Direccion Diseño
$perfil[4]=4; // Director General;
$perfil[5]=5; // Programador
$perfil[6]=6; // Diseñador
$perfil[7]=7; // Asistente comercial
$perfil[8]=8; //Freelance;
$perfil[9]=9; //Atencion al Cliente
$perfil[10]=10; //"Atencion hosting";
// nombre de los perfiles
$perfiln[0]="Administrador";
$perfiln[1]="Direccion Proyectos";
$perfiln[2]="Direccion Comercial";
$perfiln[3]="Direccion Diseño";
$perfiln[4]="Director General";
$perfiln[5]="Programador";
$perfiln[6]="Diseñador";
$perfiln[7]="Asistente comercial";
$perfiln[8]="Freelance";;
$perfiln[9]="Atencion al Cliente";
$perfiln[10]="Atencion hosting";
// nuevo cargos
// rutas
$pagina=substr(strrchr($_SERVER['PHP_SELF'],'/'),1) ; // nombre de la pagina
// fin perfiles
// rutas de modulos

function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return true;
    else
       return false;
}




function UltimoDia($a,$m){
  if (((fmod($a,4)==0) and (fmod($a,100)!=0)) or (fmod($a,400)==0)) {
    $dias_febrero = 29;
  } else {
    $dias_febrero = 28;
  }
  switch($m) {
    case  1: $valor = 31; break;
    case  2: $valor = $dias_febrero; break;
    case  3: $valor = 31; break;
    case  4: $valor = 30; break;
    case  5: $valor = 31; break;
    case  6: $valor = 30; break;
    case  7: $valor = 31; break;
    case  8: $valor = 31; break;
    case  9: $valor = 30; break;
    case 10: $valor = 31; break;
    case 11: $valor = 30; break;
    case 12: $valor = 31; break;
  }
  return $valor;
}
function nombre_mes($m){
  switch($m) {
    case  1: $valor = "Enero";		break;
    case  2: $valor = "Febrero";	break;
    case  3: $valor = "Marzo";		break;
    case  4: $valor = "Abril";		break;
    case  5: $valor = "Mayo";		break;
    case  6: $valor = "Junio";		break;
    case  7: $valor = "Julio";		break;
    case  8: $valor = "Agosto";		break;
    case  9: $valor = "Septiembre"; break;
    case 10: $valor = "Octubre";	break;
    case 11: $valor = "Noviembre";	break;
    case 12: $valor = "Diciembre";	break;
  }
  return $valor;
}

function num_mes($m){
  switch($m) {
    case "Enero": $valor = 1;		break;
    case "Febrero": $valor = 2;		break;
    case "Marzo": $valor = 3;		break;
    case "Abril": $valor = 4;		break;
    case "Mayo": $valor = 5;		break;
    case "Junio": $valor = 6;		break;
    case "Julio": $valor = 7;		break;
    case "Agosto": $valor = 8;		break;
    case "Septiembre": $valor = 9; 	break;
    case "Octubre": $valor = 10;	break;
    case "Noviembre": $valor = 11;	break;
    case "Diciembre": $valor = 12;	break;
  }
  return $valor;
}

function nombre_mes_res($m){
  switch($m) {
    case  1: $valor = "Ene";		break;
    case  2: $valor = "Feb";		break;
    case  3: $valor = "Mar";		break;
    case  4: $valor = "Abr";		break;
    case  5: $valor = "May";		break;
    case  6: $valor = "Jun";		break;
    case  7: $valor = "Jul";		break;
    case  8: $valor = "Ago";		break;
    case  9: $valor = "Sep"; 		break;
    case 10: $valor = "Oct";		break;
    case 11: $valor = "Nov";		break;
    case 12: $valor = "Dic";		break;
  }
  return $valor;
}

function numero_dia_semana($d,$m,$a){
  $f = getdate(mktime(0,0,0,$m,$d,$a));
  $d = $f["wday"];
  if ($d==0) {$d=7;}
  return $d;
}

function nombre_dia_semana_ciclo($var){
  switch($var) {
    case 1: $valor = "Lunes";		break;
    case 2: $valor = "Martes";		break;
    case 3: $valor = "Miércoles";	break;
    case 4: $valor = "Jueves";		break;
    case 5: $valor = "Viernes";		break;
    case 6: $valor = "Sábado";		break;
    case 0: $valor = "Domingo";		break;
  }
  return $valor;
}


function nombre_dia_semana($d,$m,$a){
  $f = getdate(mktime(0,0,0,$m,$d,$a));
  switch($f["wday"]) {
    case 1: $valor = "Lunes";		break;
    case 2: $valor = "Martes";		break;
    case 3: $valor = "Miércoles";	break;
    case 4: $valor = "Jueves";		break;
    case 5: $valor = "Viernes";		break;
    case 6: $valor = "Sábado";		break;
    case 0: $valor = "Domingo";		break;
  }
  return $valor;
}
function elliStr($s,$n) {
     for ( $x = 0; $x < strlen($s); $x++ ) {
         $o = ($n+$x >= strlen($s) ? $s : ($s{$n+$x} == " " ? substr($s,0,$n+$x) . "..." : ""));
         if ( $o != "" ) { return $o; }
     }
   }
// fin variables de fechas
//////////// FUNCIONES DE USO GENERAL EN TODO EL SITIO
function RestarHoras($horaini,$horafin,$dsfecha,$dsfecha2,$tipo)
{
	$partir=explode(":",$horaini);
	$horai=$partir[0];

	$mini=$partir[1];
	$segi="00";
	$partir=explode(":",$horafin);
	$horaf=$partir[0];
	if ($horai==24 && $dsfecha<>$dsfecha2) $horai=0;
	if ($horaf==24 && $dsfecha<>$dsfecha2) $horaf=0;
	$minf=$partir[1];
	$segf="00";
	//
	$partir=explode("/",$dsfecha);
	$an=$partir[0];
	$mes=$partir[1];
	$dia=$partir[2];
	//
	$partir=explode("/",$dsfecha2);
	$an2=$partir[0];
	$mes2=$partir[1];
	$dia2=$partir[2];
	$timestamp = mktime(intval($horai),intval($mini),$segi, $mes, $dia, $an);
	$timestamp2 = mktime(intval($horaf),intval($minf),$segf, $mes2, $dia2, $an2);
	$difh = floor(($timestamp2 - $timestamp) / (3600));
	$difm = (abs($minf-$mini)/60);
	$difs=0;
//	echo $horai."-".$horaf."<br>";
	if ($tipo==1) {
		return (($difh)+($difm));
	} else {
		return date("H-i-s",mktime($difh,$difm,$difs));
	}
}
function formateohora($valor){
if ($valor>12) {
	 $valor1=12-intval($valor);
} else {
	 $valor1=$valor;
}

	if ($valor1<10){
		$valor1="0".$valor1;
	}
  return $valor1;
}
function tiempo($valor){
if (strlen($valor)==2) {
	if ($valor<12) $valor1=" a.m.";
	if ($valor==12) $valor1=" m.";
	if ($valor>12) $valor1=" p.m.";
} else {
	if ($valor<1200) $valor1=" a.m.";
	if ($valor==1200) $valor1=" m.";
	if ($valor>1200) $valor1=" p.m.";

}
return $valor1;
}
$headers= "From: $correobase\n";
$headers.= "Organization: $autorizado\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente
//$headers .= "Reply-To: jvanegas@comprandofacil.com\r\n";

//ruta del mensaje desde origen a destino
//$headers .= "Return-path: jvanegas@comprandofacil.com\r\n";

$fondo1="#FFFFFF";
$fondo2="#f3f3f3";
$fondo3="#CCCCCC";
//////////// FIN FUNCIONES DE USO GENERAL EN TODO EL SITIO
// georeferencacion google
$posbase="6.242950762610709,-75.58113098144531";
// lista de colores encuesta
$fondoE[1]="#009933";
$fondoE[2]="#FFCC00";
$fondoE[3]="#6699CC";
$fondoE[4]="#CC0000";
$fondoE[5]="#B1BFC7";
$fondoE[6]="#FF9900";
$fondoE[7]="#FFFFCC";
$fondoE[8]="#003366";
$fondoE[9]="#CCCCCC";
$fondoE[10]="#00CC00";
$fondoE[11]="#99CC00";
$fondoE[12]="#CCFF33";
// lista de datos generales para chica jalapeno
$fondoC[0]="img/barra9.jpg";
$fondoC[1]="img/barra1.jpg";
$fondoC[2]="img/barra2.jpg";
$fondoC[3]="img/barra3.jpg";
$fondoC[4]="img/barra4.jpg";
$fondoC[5]="img/barra5.jpg";
$fondoC[6]="img/barra6.jpg";
$fondoC[7]="img/barra7.jpg";
$fondoC[8]="img/barra8.jpg";
$fondoC[9]="img/barra9.jpg";
$LatLon="6.232712059925625,-75.58113098144531"; //posicion por defecto en googlemaps
function reemplazar($cadena){
	if ($cadena<>''){
		$xc=preg_replace("/á/","&aacute;",$cadena);
		$xc=preg_replace("/é/","&eacute;",$xc);
		$xc=preg_replace("/í/","&iacute;",$xc);
		$xc=preg_replace("/ó/","&oacute;",$xc);
		$xc=preg_replace("/ú/","&uacute;",$xc);

		//

		$xc=preg_replace("/Á/","&Aacute;",$xc);
		$xc=preg_replace("/É/","&Eacute;",$xc);
		$xc=preg_replace("/Í/","&Iacute;",$xc);
		$xc=preg_replace("/Ó/","&Oacute;",$xc);
		$xc=preg_replace("/Ú/","&Uacute;",$xc);

		//
		$xc=preg_replace("/ñ/","&ntilde;",$xc);
		$xc=preg_replace("/Ñ/","&Ntilde;",$xc);
		$xc=preg_replace("/¿/","&iquest;",$xc);
		$xc=preg_replace("/“/","&#148;",$xc);
		$xc=preg_replace("/”/","&#147;",$xc);
		$xc=preg_replace("/–/","-",$xc);
		$xc=preg_replace("/ü/","&uuml;",$xc);
		$xc=preg_replace("/®/","&reg;",$xc);
    $xc=preg_replace("/’/","&#39;",$xc);
    $xc=preg_replace("/Ã³/","&oacute;",$xc);
    $xc=preg_replace("/Ã±/","&ntilde;",$xc);
    $xc=preg_replace("/Ã¡/","&aacute;",$xc);




		return $xc;
	} else {
		return "";
	}
}

function reemplazar_inverso($cadena){
  if ($cadena<>''){
    $xc=str_replace("&aacute;","á",$cadena);
    $xc=str_replace("&eacute;","é",$xc);
    $xc=str_replace("&iacute;","í",$xc);
    $xc=str_replace("&oacute;","ó",$xc);
    $xc=str_replace("&uacute;","ú",$xc);

    $xc=str_replace("&Aacute;","Á",$xc);
    $xc=str_replace("&Eacute;","É",$xc);
    $xc=str_replace("&Iacute;","Í",$xc);
    $xc=str_replace("&Oacute;","Ó",$xc);
    $xc=str_replace("&Uacute;","Ú",$xc);


    $xc=str_replace("&ntilde;","ñ",$xc);
    $xc=str_replace("&Ntilde;","Ñ",$xc);


    return $xc;
  } else {
    return "";
  }
}

function limpieza($cadena)
{
global $sinespacios;
$vocalti= array ("A","E","I","O","U","á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","À","È","Ì","Ò","Ù","à","è","ì","ò","ù","ç","Ç","â","ê","î","ô","û","Â","Ê","Î","Ô","Û","ü","ö","Ö","ï","ä","ë","Ü","Ï","Ä","Ë","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;",":",",",";","'",chr(34),chr(92),"ü","?","¿","!","¡","“","”",".","%","(",")","‘","’","-","Ã³","Ã±","Ã¡","Ã");
$vocales= array ("a","e","i","o","u","a","e","i","o","u","a","a","i","o","u","ni","ni","a","e","i","o","u","a","e","i","o","u","c","C","a","e","i","o","u","a","e","i","O","u","u","o","O","i","a","e","u","i","a","e","a","e","i","o","u","A","E","I","O","U","n","N","","","","","","","u","","","","","","","","","","","","","","","","","");
$cadena=str_replace($vocalti, $vocales,$cadena);

if ($sinespacios=="") {
  $espaciosi= array(" ");
  $espacios= array("-");
  $cadena=str_replace($espaciosi, $espacios,$cadena);
}

return $cadena;
}

function formateo_caracteres($cadena)
{
	$vocalti= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",chr(34),"'","‘","’","“","”","¿","?");
	$vocales= array ("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;","&quot;","&#39;","&#8216;","&#8217;","&#8220;","&#8221;","&#191;","?");
	$cadena=str_replace($vocalti, $vocales,$cadena);
	$espaciosi= array (" ");
	$espacios= array (" ");
	$cadena=str_replace($espaciosi, $espacios,$cadena);
	return $cadena;
}
$idcomercio=1;
$idtrm="1850";
$valorbasesinseguro=100*$idtrm;
$porvalorseguro=0.015;
$valorbasesinsegurodolares=100;
$valormanejodolares=3.2;
$valormanejo=$valormanejodolares*$idtrm;
// MANEJO DE ESTADOS
$estado[0]="<font color=red>No finalizo el pedido</font>";
$estado[1]="En proceso (Pendiente de pago)";
$estado[2]="Confirmado";
$estado[3]="Rechazado";
$estado[4]="Transito Tienda a bodega -origen- ";
$estado[5]="En Bodega -origen-"; // ORIGEN
$estado[6]="De Bodega -origen- a Bodega -destino- ";
$estado[7]="En Bodega -destino- ";
$estado[8]="En Bodega -destino- a direccion de entrega";
$estado[9]="Entregado";
$estado[10]="Nacionalizacion";
$estado[11]="Horarios de Atencion";
$estado[12]="Solo Cotizacion";


// fin manejo de estados
// manejo de bodegas
$bodega[0]="Miami";
$bodega[1]="Colombia";
$bodega[2]="UK";
$apagar=1; // menus apagados y forma de acordeon
?>