<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);


/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fern?ndez <consultorweb@comprandofacil.com>
  Juan Felipe S?nchez <graficoweb@comprandofacil.com>
  Jos? Fernando Pe?a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Script generico de envio de datos via formulario
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
//$db->debug=true;

$rc4 = new rc4crypt();

$redir=trim($_REQUEST['redir']);
$add=$_REQUEST['add'];
$desdesitio="";
if ($add<>"") $desdesitio=1;
$id=trim($_REQUEST['idx']);
$sel_casillero=$_REQUEST['sel_casillero'];

$dsrequerimiento=($_REQUEST['sel_requerimientos']);

$dslenguaje=($_POST['sel_lenguaje']);

$dscategoria=($_POST['sel_categoria']);


$dsimplementar=trim($_REQUEST['dsimplementar']);

$dsrecibirmovil=trim($_REQUEST['dsrecibirmovil']);
$dsrecibircorreo=trim($_REQUEST['dsrecibircorreo']);
$tienesoat=trim($_REQUEST['dssoat']);
$dsfechavencimiento=trim($_REQUEST['dsfechavencimiento']);
$dstipovehiculo=trim($_REQUEST['dstipovehiculo']);
$dstiquetesn=trim($_REQUEST['dstiquetesn']);
$dstiquetesi=trim($_REQUEST['dstiquetesi']);
$dsparques=trim($_REQUEST['dspaques']);
$dsviajero=trim($_REQUEST['dsviajero']);

$dsviajerootro=trim($_REQUEST['dsviajerootro']);
$dsnombreviajerootro=trim($_REQUEST['dsnombreviajerootro']);
$dsnumeroviajerootro=trim($_REQUEST['dsnumeroviajerootro']);
$otracategoria=trim($_REQUEST['otracategoria']);
$dsotracategoria=trim($_REQUEST['dsotracategoria']);
$dsrecibir=trim($_REQUEST['dsrecibir']);
$dscadavez=trim($_REQUEST['dscadavez']);
$dsacepto=trim($_REQUEST['dsacepto']);




if ($id<>"") {
//echo "s";
    // ACTUALIZAR

    $sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dstelefono2,dscorreocliente from tblclientes where id=$id";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {

$dsnombres=trim($resultb->fields[0]);
$dsapellidos=trim($resultb->fields[1]);
$dsidentificacion=trim($resultb->fields[2]);
$dstelefono=trim($resultb->fields[3]);
$dstelefono2=trim($resultb->fields[4]);
$dscorreocliente=trim($resultb->fields[5]);
      $_SESSION['i_idcliente'] = $id;
      $_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;
      $_SESSION['i_dscorreo'] = $dscorreocliente;
      $_SESSION['i_dstelefono'] = $dstelefono;
      $_SESSION['i_solodsnombre'] = $dsnombres;
      $_SESSION['i_solodsapellido'] = $dsapellidos;




    //almacenar en base de datos
    $sql=" update tblclientes set ";
    $sql.=" dsimplementar='$dsimplementar'";
    $sql.=",dsrecibirmovil='$dsrecibirmovil'";
    $sql.=",dsrecibircorreo='$dsrecibircorreo'";
    $sql.=",tienesoat='$tienesoat'";
    $sql.=",dsfechavencimiento='$dsfechavencimiento'";
    $sql.=",dstipovehiculo='$dstipovehiculo'";
    $sql.=",dstiquetesn='$dstiquetesn'";
    $sql.=",dstiquetesi='$dstiquetesi'";

    $sql.=",dspaques='$dsparques'";
    $sql.=",dsviajero='$dsviajero'";
    $sql.=",dsviajerootro='$dsviajerootro'";
    $sql.=",dsnombreviajerootro='$dsnombreviajerootro'";
    $sql.=",dsnumeroviajerootro='$dsnumeroviajerootro'";
    $sql.=",otracategoria='$otracategoria'";
    $sql.=",dsotracategoria='$dsotracategoria'";
    $sql.=",dsrecibir='$dsrecibir'";
    $sql.=",dscadavez='$dscadavez'";
    $sql.=",dsacepto='$dsacepto'";
    $sql.=" where id=".$id;
    if($db->Execute($sql)){
    }else{

    }
           }
   $resultb->Close();
    if(count($sel_casillero)>0){
                      $tablax="tblclientesxtblcasillero ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($sel_casillero);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$sel_casillero[$c].")";
        // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }
    }

    if(count($dsrequerimiento)>0){
                      $tablax="tblclientesxtblrequerimientos ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dsrequerimiento);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dsrequerimiento[$c].")";
       // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }
    }

if(count($dslenguaje)>0){
                      $tablax="tblclientesxtbllenguajes ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dslenguaje);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dslenguaje[$c].")";
       // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }
    }

if(count($dscategoria)>0){
                      $tablax="tblclientesxtblcategorias ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dscategoria);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dscategoria[$c].")";
   //    echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }
    }



  $redir="../../gracias.php?registro=1&entrar=".$_REQUEST['entrar'];
  if ($desdesitio==1) $redir="../../../sitio/gracias.php";


} else {
  $redir="../../registro.php?entrar=".$_REQUEST['entrar'];
  if ($desdesitio==1) $redir="../../../sitio/formulario.php";
}


//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
//exit();//para imprimir
?>