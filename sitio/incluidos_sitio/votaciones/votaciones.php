<?
$fechafull=date("YmdHi");
$horafull=date("Hi");

$sql="select dszonaelectoral,dscodigoasociado as dscodigo from tblvotacionasociados_temp where dscodigo='".$_SESSION['i_cedula']."'";
//echo $sql;
$result=$db->Execute($sql);
  if (!$result->EOF) {
      $zonaelectoral=$result->fields[0];
      $codigo=$result->fields[1];


}
$result->Close();

  // traer maximo ganadores y maximo

  $sql="select ganadores,votos from tblvotacionzonaselectorales where zona='".$zonaelectoral."'";
  //echo $sql;
  $resultx=$db->Execute($sql);
  if (!$resultx->EOF) {
    $maxganadores=$resultx->fields[0];
    $maximovotos=$resultx->fields[1];
  }
  $resultx->Close();


?>
<article class="cont_txt">
<h1><? echo reemplazar($dstituloPagina);?></h1>
<h1><? echo reemplazar($dsdescr);?></h1>


<article class="bloque_texto " >

        <article class="bloque_voto cont_votaciones">
          <img src="images/vote.png">
          <h2>Bienvenido al sistema de votaciones.</h2>
          <!--p> Por favor ingrese su identificacion o el codigo de asociado y la clave
          </p-->
          <a href="modulos/validaciones/votaciones.salir.php" class="btn_color"><p>Salir del sistema de votaciones</p></a>
        </article>


  <article class="cont_votacion_detalle">
    <p>Apreciado <? echo $_SESSION['i_dsnombre'];?>, estas votaciones se encuentran activas:</p>

<?
// los certificados
// FECHAS DE INSCRIPCION

include("asociados_votaciones.inscripciones.php");

// FIN FECHAS DE INSCRIPCION

// FECHAS DE VOTACION

include("asociados_votaciones.votaciones.php");

// FIN FECHAS DE VOTACION


// ESCRUTINIOS

include("asociados_votaciones.escrutinios.php");


// FIN ESCRUTINIOS
?>



</article>



</article>

</article>