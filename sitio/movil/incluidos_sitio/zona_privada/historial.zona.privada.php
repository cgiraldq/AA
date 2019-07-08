<article id='historial' class="cuerpo_tab">
	<article class="txt_qsomos">
	<h1>Historial de Compras</h1>
	</article>

<?
				$idestado=$_REQUEST['idestado'];
                $sql="select dsfechalarga,idpedido,idestado,dstotal,dsformadepago dstotal,dsiva,dsdescuento ";
                $sql.=",dsvalorseguro,dsmanejo,id ";

                $sql.="from tblpagos where idclientepago=".$_SESSION['i_idcliente'];
                $sql.=" and idtienda = 1 ";
                if ($idestado<>"") $sql.="  and idestado=".$idestado;
                $sql.=" order by id desc ";
            	//echo $sql;
?>

	<article class="con_historial">
		<?
			$sqlp="select idestado ";
			$sqlp.="from tblpagos where idclientepago=".$_SESSION['i_idcliente'];
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
			?>
			<option value="zona.privada.php?idestado=<?echo $i_idestado?>#historial" <?if ($idestado==$i_idestado)echo 'selected'?>><?echo ver_estado($i_idestado);?></option>
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
					<td><p><a href="proceso.pago.impresion.php?idpedido=<? echo reemplazar($resultx->fields[1])?>" target="_blank">
<? echo reemplazar($resultx->fields[1])?></a></p></td>
					<td>
					<p><?echo ver_estado($resultx->fields[2]);?></p>
					</td>
					<td>
<p><?if ($resultx->fields[3]>0) echo " $ ".number_format(reemplazar($resultx->fields[3]),0);?></p>

					</td>
					<td>
<a href="novedades.tracking.php?idpedido=<? echo reemplazar($resultx->fields[1])?>" target="_blank" class="btn_ver">ver</a>

					</td>
				</tr>
			</tbody>

                <?
                     $resultx->MoveNext();
                }

            } else { ?>
            <tfoot>
                     <tr>
                        <td colspan=6>En estos momentos  no posee compras</td>

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