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
?>
<?
$maxregistros=10;
$sql="select dstitulo,dsfecha,dsmodulo,dsusuario,dsruta from tbl_logs order by id desc ";

include("../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if (!$result->EOF) {
$contar=0;

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
     <td align="left" valign="middle" class="titulo_index">
       <h1> &Uacute;ltimas <? echo $maxregistros?> acciones realizadas</h1>
      </td>
    </tr>
</table>


	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_internas_index">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" align="center" valign="middle" bgcolor="#F7F7F7"><table width="95%">
                  <tr class="texto_normal2" valign="top" align="center">
                    <td align="left"><strong>Acci&oacute;n</strong></td>
                    <td ><strong>Fecha</strong></td>
                    <td align="left"><strong>M&oacute;dulo</strong></td>
                    <td><strong>Usuario</strong></td>
                  </tr>
				  <? while (!$result->EOF){
					  if ($contar%2==0) {
						$fondo=$fondo1;
					} else {
						$fondo=$fondo2;
					}
				  ?>

                  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="left"><? echo $result->fields[0];?></td>
                    <td ><? echo $result->fields[1];?></td>
                 <td align="left"><a href="<? echo $result->fields[4];?>" title="Ir al modulo seleccionado" class="textazullink"><? echo $result->fields[2];?></a></td>
                    <td ><? echo $result->fields[3];?></td>
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