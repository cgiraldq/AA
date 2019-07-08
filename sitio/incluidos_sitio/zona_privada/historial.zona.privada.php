<article id='historial' class="cuerpo_tab">

	<h1>Historial de Compras</h1>

<?
				$idestado=$_REQUEST['idestado'];
                $sql="select dsfechalarga,idpedido,idestado,dstotal,dsformadepago dstotal,dsiva,dsdescuento ";
                $sql.=",dsvalorseguro,dsmanejo,id ";

                $sql.="from ecommerce_tblpagos where idclientepago=".$_SESSION['i_idcliente'];
                $sql.=" and idtienda = 1 ";
                if ($idestado<>"") $sql.="  and idestado=".$idestado;
                $sql.=" order by id desc ";
            	//echo $sql;
?>

	<article class="con_historial">
		<?
			$sqlp="select idestado ";
			$sqlp.="from ecommerce_tblpagos where idclientepago=".$_SESSION['i_idcliente'];
			$sqlp.=" and idtienda = 1 group by idestado ";
			$sqlp.=" order by id DESC ";
			//echo $sqlp;
		?>
		<?
			$resultp=$db->Execute($sqlp);
			if(!$resultp->EOF){
		?>
		<form name="frm_estado">
		<select onChange="abreSitio()"  name="idestado">
			<option value="zona.privada.php#historial">Ver todos los procesos</option>
			<?
					while(!$resultp->EOF){
					$i_idestado=$resultp->fields[0];
					$dsestado=seldato('dsm','id','ecommerce_tblestadoscompra',$i_idestado,1);
			?>
			<option value="zona.privada.php?idestado=<?echo $i_idestado?>#historial" <?if ($idestado==$i_idestado)echo 'selected'?>><?echo $dsestado;?></option>
			<?
			  $resultp->MoveNext();
				}
			?>
		</select>
		</form>

		<?
			}
			$resultp->Close();
		?>
		<table width="100%"  class="tbl_historial" border-collapse="0" border-spacing="0">

			<?
              $resultx=$db->Execute($sql);
                if(!$resultx->EOF){

			?>
			<thead>
				<tr>
					<th>FECHA</th>
					<th>PEDIDO</th>
					<th>ESTADO</th>
					<th>VALOR</th>
					<th>NOVEDADES</th>
				</tr>
			</thead>
                    <?
                            while(!$resultx->EOF){

                                // validar cada una si tiene bodeha origen y destino
        $dsorigen=" Origen ";
        $dsdestino=" Destino ";


                    ?>

			<tbody>
				<tr>
					<td><p><? echo reemplazar($resultx->fields[0])?></p></td>
					<td><p>
						<a onclick="imprimir_pedido('proceso.pago.impresion.php?idpedido=<? echo reemplazar($resultx->fields[1])?>','900','600')" >	
<? echo reemplazar($resultx->fields[1])?></a></p></td>
					<td>
					<p><?echo seldato('dsm','id','ecommerce_tblestadoscompra',$resultx->fields[2],1);?></p>
					</td>
					<td>
<p><?if ($resultx->fields[3]>0) echo " $ ".number_format(reemplazar($resultx->fields[3]),0);?></p>

					</td>
					<td>
<a onclick="imprimir_pedido('novedades.tracking.php?idpedido=<? echo reemplazar($resultx->fields[1])?>','700','600')" class="btn_ver">ver</a>

					</td>
				</tr>
			</tbody>

                <?
                     $resultx->MoveNext();
                }

            } else { ?>
            <tfoot>
                     <tr>
                        <td colspan=6>En estos momentos  no posee compras. Lo invitamos a visitar nuestro catalogo

                        </td>
                    </tr>

            </tfoot>


                <? }
                   $resultx->Close();
                ?>


		</table>
    </article>



</article>

<script LANGUAGE="JavaScript">
function abreSitio(){
var URL = "";
var web = document.frm_estado.idestado.value;
location.href=web;
}
</script>