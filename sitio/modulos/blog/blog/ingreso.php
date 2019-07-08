<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

////////////////////////////////////////

$sqlxx="select idactivocat,idactivoing from blogtbladmin";
    $resultxx=$db->Execute($sqlxx);
    if(!$resultxx->EOF){
      $activado=$resultxx->fields["0"];

    }
    $resultxx->Close();
//////////////////////////////////////

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>

<?
//echo $dsm;
$titulocampo="Titulo";
$campo="dsm";
$contadorx="counter_$campo";

$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo="";
$mensaje_capa="Debe ingresar  la pagina";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");


if($activado==1){
$titulocampo="Categoria";
$valorcampo=$idcategoria;
$campo="idcat";
  $sql="select dsm,id from blogtblcategorias where idactivo=1";

  $result=$db->Execute($sql);
  if(!$result->EOF){
$valores="";
  while(!$result->EOF){
   $id=reemplazar($result->fields[1]);
  $dsm=reemplazar($result->fields[0]);
 $valores.=";$id-$dsm";
  $result->MoveNext();
  }
  }
  $result->Close();
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");
}


$titulocampo="Posici&oacute;n";
$campo="idpos";
$contadorx="counter_$campo";
$tam=1;$valorx="8";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$idpos;
$mensaje_capa="Debe ingresar la posicion";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Activar";
$valores="1-SI;2-NO;3-DESTACADO PRINCIPAL";
$campo="idactivo";
$valorcampo=$idactivo;
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");
?>
<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>