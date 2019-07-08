<? if ($bloqueopago==""){?>
	<article class="carrito">
		<a href="<?echo $rut?>carrito.php"><?
	          $sql="select count(*) as total ";
	          $sql.=" from tbltemporalcompras a where a.id >0 ";
	          $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
	          $sql.=" and idip='".$_SESSION['ipremota']."' and a.idtienda=$idtienda ";

	              //echo $sql;
			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){
			    echo reemplazar($resultx->fields[0]);
			}
			$resultx->Close();
			               ?>
			<p>CARRITO</p>
		</a>
	</article>
<? } ?>