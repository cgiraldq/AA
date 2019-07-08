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
// Listado de los ultimos correos ingresados por el sitio
$maxregistros=10;
$sql="select nombredesde,nombrehacia,desdecorreo,haciacorreo from tblrecomendar order by id desc ";
//echo $sql;
include("../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if (!$result->EOF) {
$contar=0;

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
     <td align="left" valign="middle" class="titulo_index">
     <h1>
      &Uacute;ltimas <? echo $maxregistros?> Correos de recomendaciones
     </h1>
    </td>
  </tr>
</table>

	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_internas_index">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">

          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" align="center" valign="middle" bgcolor="#F7F7F7"><table width="100%">
                  <tr>
                    <td align="center" valign="top" class="texto_normal">Recomienda </td>
                    <td align="center" valign="top" class="texto_normal">Correo</td>
					<td align="center" valign="top" class="texto_normal">Recomendado</td>
					<td align="center" valign="top" class="texto_normal">Correo</td>
                  </tr>

				    <? while (!$result->EOF){
					  if ($contar%2==0) {
						$fondo=$fondo1;
					} else {
						$fondo=$fondo2;
					}
				  ?>

                  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">
                      <a href="../crm/recomendar/default.php" class="textazullink" title="Ir al modulo de correos"><? echo $result->fields[0];?>
                      </a>
                    </td>

                    <td align="center" valign="top" class="texto_normal2"><? echo $result->fields[2];?></td>
                    <td align="center" valign="top"><? echo $result->fields[1];?></td>
                    <td align="center" valign="top"><? echo $result->fields[3];?></td>
                  </tr>

				  <?
	$contar++;
			$result->MoveNext();
	} // fin while
?>

                </table></td>
              </tr>
          </table>

    </td>
        </tr>
      </table>
<?
} // fin si
$result->Close();
?>