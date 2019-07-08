<article class="ecommerce_header">

	      <? if ($bloqueonombre=="") {?>

			<? if ($bloqueopago==""){?>
				<article class="carrito">
					<a href="<?echo $rutbase?>/carrito.php">
					<?
		              $sql="select count(*) as total ";
		              $sql.=" from ecommerce_tbltemporalcompras a where a.id >0 ";
		              $sql.=" and idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
		              $sql.=" and idip='".$_SESSION['ipremota']."' and a.idtienda=$idtienda ";
//echo $sql;
					$resultx=$db->Execute($sql);
					if(!$resultx->EOF){
					    echo reemplazar($resultx->fields[0]);
					}
					$resultx->Close();
					               ?></a>
				</article>
			<?} ?>

			<!--article class="cont_ingreso">

					<? 
					/*
					  	$tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);// ?>
						<? if($tipocliente==2){ ?>
						<p class="perfil_usuario">Distribuidor</p>
						<?  }elseif($tipocliente==0){?>
						<? } ?>
					<h3>
					<? if ($_SESSION['i_idcliente']<>"" && $_SESSION['i_dsnombre']<>"") {?>
						<? echo $_SESSION['i_dsnombre']; ?>
		            <? } else {?>
						Bienvenido cliente nuevo
		            <? } 
		            */?>

					</h3>

					<p>
						<?
						/*
						 if ($_SESSION['i_idcliente']<>"" && $_SESSION['i_dsnombre']<>"" && $bloqueopago=="") {?>
						<a href="<? echo $rutbase?>/zona.privada.php">Mi Cuenta /</a>
						<? }else{ ?>
						<a href="<? echo $rutbase?>/inicio.sesion.php">Ingresar</a> /
						<a href="<? echo $rutbase?>/registro.php"> Cliente nuevo</a>
						<? 

						} 
						*/
						?>

						<?
						/*
						 if ($_SESSION['i_idcliente']<>"" && $_SESSION['i_dsnombre']<>"" && $bloqueopago=="") {?>
					<a href="<? echo $rutbase?>/salir.php?salir=1">Cerrar sesión</a>
				<? } 
				*/
				?>
					</p>

			</article-->

	<?} // fin bloquenombre?>


</article>
