
  <?
/*
| ----------------------------------------------------------------- |
Paginacion version 1.0
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
  http://www.comprandofacil.com
  2005
  Soporte: consultorweb@comprandofacil.com
=====================================================================
Libreria propietaria de comprandofacil para uso de este aplicativo
| ----------------------------------------------------------------- |
Funcion generica de paginacion
 * pagina_actual:   Pagina actual
 * total:           Total de registros
 * por_pagina:      Registros por pagina
 * rutaPaginacion:  Texto del enlace
 * limitemostrar    Numero De Casillas que se mostraran
 * Devuelve un texto que representa la paginacion
 */

function paginar($pagina_actual,$totalregistros,$maxregistros,$rutaPaginacion,$limitemostrar) {
if ($_REQUEST['page']==""){
  $pagina_actual = 1;
} else {
  $pagina_actual = $_REQUEST['page'];
}
 	global $mem,$fondos;
  if ($limitemostrar=="")$limitemostrar=2;
  if ($maxregistros=="") $maxregistros=5;
  $totalregistros_paginas = ceil($totalregistros/$maxregistros);
  $anterior = $pagina_actual - 1;
  $posterior = $pagina_actual + 1;


  $antes=$pagina_actual-$limitemostrar;
  if ($antes<0) $antes=1;
  $despues=$limitemostrar+$pagina_actual;
  ?>
  <article class="paginador">
  <ul>
    <?
  $inicio=1;
  $final=$totalregistros_paginas;


  if ($pagina_actual>1){
    if(($pagina_actual+1)>=3)
    {
    $texto='<li class="anterior"><a href="'. $rutaPaginacion .'1"  title="Ir al inicio"><</a></li>' . "\n";
    }
   // $texto.= "<li><a  href=\"$rutaPaginacion$anterior\" class='paginador' title='Pagina anterior' >Anterior</a></li> ";

  }else {
    $texto= "<li><b class='paginador'></b></li> ";
  }



  for ($i=1; $i<$pagina_actual; $i++)
	  if ($i>=($antes)) {

		$texto .= "<li><a href=\"$rutaPaginacion$i\" class='paginador'>$i</a></li> ";
	  }



  $texto.= "<li><b href='' class='activo'>$pagina_actual</b></li> ";
  for ($i=$pagina_actual+1; $i<=$totalregistros_paginas; $i++) {
   if ($i>=($pagina_actual) && $i<=($despues)) {

	$texto .= "<li><a class='paginador' href=\"$rutaPaginacion$i\" title='Pagina $i'>$i</a></li> ";
  }
  }
   //if (($pagina_actual + 1) <= $totalregistros_paginas )$texto .='<li class="paginador"><a href="'. $rutaPaginacion.$posterior.'" title="Pagina Siguiente" >Siguiente</a></li>' . "\n";
  if(($pagina_actual + 1) <= $totalregistros_paginas )$texto .='<li class="paginador"><a href="'. $rutaPaginacion.$totalregistros_paginas.'" title="Ir al final">></a></li>' . "\n";


    //$texto.="<p align=center>$pagina_actual De  $totalregistros_paginas</p>";
  return $texto;?>
</ul>
</article><?

}
?>

<!--***************************Bloque 1 El Cual Imprime los valores***********************************-->
    <article class="paginador">
    <table width="100%" align=center  cellpadding="0" cellspacing="1" style="table-layout:fixed;">
    <tr>
    <td align="center" class="campos">
    <?
    if ($_REQUEST['page']<>"-1"){
      echo($pagina_actual,$totalregistros,$maxregistros,$rutaPaginacion,$limitemostrar);
    }
    ?>





    </td>
    </tr>
    </table>
    </article>
<!--************************Fin Bloque 1 **************************************-->