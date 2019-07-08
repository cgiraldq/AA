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
// Listado de los modulos autorizados basandose en los permisos de usuarios
$sql="select * from  tblclientes order by id desc limit 0,10";
//echo $sql;
 $result = $db->Execute($sql);
			 if (!$result->EOF) {

?>

<table width="90%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td align="left" valign="middle" background="../../img_modulos/modulos/titulo_r1_c2.jpg" class="titulo_negro">&Uacute;ltimos clientes registrados</td>
        </tr>
      </table>
	  
	  <table width="90%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">		  
          <table width="100%" border="0" cellpadding="0" cellspacing="0">

                  <tr>
                    <td align="right" colspan="4" valign="top" class="texto_normal"><a href="../clientesregistrados/default.php">Ver Todos</a><br><br></td>
                  </tr>


              <tr>
                <td height="20" align="center" valign="middle" bgcolor="#F7F7F7"><table width="100%">
                  <tr>
                    <td align="center" valign="top" class="texto_normal">Identificacion</td>
                    <td align="center" valign="top" class="texto_normal">Nombre</td>
					<td align="center" valign="top" class="texto_normal">Telefono</td>
          <td align="center" valign="top" class="texto_normal">Fecha Registro</td>

					<td align="center" valign="top" class="texto_normal">Opciones</td>
                  </tr>
				  
				    <? while (!$result->EOF){
					  if ($contar%2==0) { 
						$fondo=$fondo1;
					} else { 
						$fondo=$fondo2;		
					}
				  ?>
				  
                  <tr class="texto_normal2" align="center" valign="top" >
                    <td align="center" valign="top" class="texto_normal2"><? echo $result->fields[4];?></td>
                    <td align="center" valign="top" class="texto_normal2"><? echo $result->fields[1]." ".$result->fields[2];?></td>
                    <td align="center" valign="top"><? echo $result->fields[9];?></td>
                    <td align="center" valign="top"><? echo $result->fields[18];?></td>

                    <td align="center" valign="top">
                    	<a href="../clientesregistrados/default.php?idclientepago=<? echo $result->fields[0];?>" title="Click para mas detalles del cliente">Ver mas</a>
                    </td>

                  </tr>
				  
				  <?		
	$contar++;		  
			$result->MoveNext();
	} // fin while 
?>	 


				  
                </table></td>
              </tr>
          </table>
		  <br />

    </td>
        </tr>
      </table>
<?
} // fin si 
$result->Close();
?>	  	  