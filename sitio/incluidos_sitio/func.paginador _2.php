
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
 * actual:          Pagina actual
 * total:           Total de registros
 * por_pagina:      Registros por pagina
 * enlace:          Texto del enlace
 * limitemostrar    Numero De Casillas que se mostraran
 * Devuelve un texto que representa la paginacion
 */

function paginar($actual,$total,$por_pagina,$enlace,$limitemostrar) {
if ($_REQUEST['page']==""){
  $actual = 1;
} else {
  $actual = $_REQUEST['page'];
}
 	global $mem,$fondos;
  if ($limitemostrar=="")$limitemostrar=2;
  if ($por_pagina=="") $por_pagina=5;
  $total_paginas = ceil($total/$por_pagina);
  $anterior = $actual - 1;
  $posterior = $actual + 1;


  $antes=$actual-$limitemostrar;
  if ($antes<0) $antes=1;
  $despues=$limitemostrar+$actual;
  ?>
  <article class="paginador">
  <ul>
    <?

  if ($actual>1)
    $texto = "<li><a href=\"$enlace$anterior\" class='paginador'>Previous</a></li> ";
  else
    $texto = "<li><b class='paginador'>Previous</b></li> ";
  for ($i=1; $i<$actual; $i++)
	  if ($i>=($antes)) {

		$texto .= "<li><a href=\"$enlace$i\" class='paginador'>$i</a></li> ";
	  }



  $texto .= "<li><b href='' class='activo'>$actual</b></li> ";
  for ($i=$actual+1; $i<=$total_paginas; $i++) {
   if ($i>=($actual) && $i<=($despues)) {

	$texto .= "<li><a class='paginador' href=\"$enlace$i\">$i</a></li> ";
  }
  }
  if ($actual<$total_paginas)
    $texto .= "<li><a class='paginador' href=\"$enlace$posterior\">Next</a></li>";
  else
    $texto .= "<li><b class='paginador'>Next</b></li>";
  return $texto;?>
</ul>
</article><?

}
?>

<!--***************************Bloque 1 El Cual Imprime los valores***********************************-->

    <table width=100% align=center  cellpadding=2 cellspacing=1 style="table-layout:fixed;">
    <tr>
    <td align="center" class="campos">
    <?
    if ($_REQUEST['page']<>"-1"){
      echo paginar($actual,$total,$por_pagina,$rutaPaginador,$limitemostrar);
    }
    ?>
    </td>
    </tr>
    </table>

<!--************************Fin Bloque 1 **************************************-->