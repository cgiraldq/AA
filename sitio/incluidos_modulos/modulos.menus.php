
<?
if ($_SESSION['i_idperfil']==-1) {

	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
	$sql.=" from tblmodulos a ";
	$sql.=" where ";
	$sql.=" dsm='ADMINISTRADOR' ";
	$sql.=" order by a.idpos ASC ";

}elseif ($_SESSION['i_idperfil']==1) {
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
	$sql.=" from tblmodulos a ";
	$sql.=" where 1  ";
	$sql.=" and a.idactivo=1 ";
	$sql.=" order by a.idpos ASC ";
}elseif ($_SESSION['i_idperfil']==4) {
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
	$sql.=" from tblmodulos a inner join tblusuariosxtblmodulos b on a.id=b.iddestino";
	$sql.=" where 1  ";
	$sql.=" and a.idactivo=1 and b.idorigen=".$_SESSION['i_idusuario'];
	$sql.=" order by a.idpos ASC ";
	//echo $sql;
}
else {
	// menu cargado dinamicamente desde base de datos
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id";
	$sql.=" from tblmodulos a, tblusuariosxtblmodulos b ";
	$sql.=" where 1  ";
	$sql.=" and a.id=b.iddestino  ";
	$sql.=" and b.idorigen=".$_SESSION['i_idusuario'];
	$sql.=" and a.idactivo=1";
	$sql.=" order by a.idpos ASC ";
}
//echo $sql;
$result = $db->Execute($sql);
 if (!$result->EOF) {
 	?>
			<nav id="menu">
				<ul>
					<a href="<?echo $rutxx?>../core/default.php">
						<li class="btn_home">

							<? if (is_file("../../img_modulos/img/home.png")) {?>
				 					<img src="../../img_modulos/img/home.png">
									<?} else {?>
				 					<img src="../../../img_modulos/img/home.png">
				 			<? } ?>

							<h1>HOME</h1>

						</li>
					</a>

			<?
			$option=1;
			while (!$result->EOF) {
			?>
			<li>
			<?
			$dsmx=$result->fields[0];
			$dsdx=$result->fields[1];
			$dsrx=$result->fields[2];
			$dsicono=$result->fields[3];
			$idmodulo=$result->fields[6];
			$var=file_get_contents("http://www.comprandofacil.com/pide/corehome/core.modulos.nuevos.menu.php?codcliente=".$codcliente."&dsmodulo=".$result->fields[0]);
			$partirnuevosmodulos=explode("|",$var);



		include($rutxx."../../incluidos_modulos/modulos.campos.menus.php"); //1
		// listar los modulos asociados a cada idmodulo
		if ($_SESSION['i_idperfil']==1) {
			$sql="select ";
			$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
			$sql.=" from tblmodulos a ";
			$sql.=" where 1  ";
			$sql.=" and a.idactivo=3 and a.idmodulo=$idmodulo ";
			$sql.=" order by a.dsm ASC ";
		}elseif ($_SESSION['i_idperfil']==4) {
			$sql="select ";
			$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
			$sql.=" from tblmodulos a inner join tblusuariosxtblmodulos b on a.id=b.iddestino";
			$sql.=" where 1  ";
			$sql.=" and a.idactivo=3 and a.idmodulo=$idmodulo and b.idorigen=".$_SESSION['i_idusuario'];
			$sql.=" order by a.dsm ASC ";
			//echo $sql;
		}elseif($_SESSION['i_idperfil']==-1){
			// menu cargado dinamicamente desde base de datos
			$sql="select ";
			$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id";
			$sql.=" from tblmodulos a ";
			$sql.=" where  ";
			$sql.=" a.idactivo=3 and a.idmodulo=$idmodulo ";
			$sql.=" order by a.dsm DESC; ";
		}else {
			// menu cargado dinamicamente desde base de datos
			$sql="select ";
			$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id";
			$sql.=" from tblmodulos a, tblusuariosxtblmodulos b ";
			$sql.=" where 1  ";
			$sql.=" and a.id=b.iddestino  ";
			$sql.=" and b.idorigen=".$_SESSION['i_idusuario'];
			$sql.=" and a.idactivo=3 and a.idmodulo=$idmodulo ";
			$sql.=" order by a.dsm ASC ";
		}
			//echo $sql;
			$resultx = $db->Execute($sql);
			 if (!$resultx->EOF) {
			 		?>
			 		<ul>
			 			<? // modulos nuevos en el sistema 
			 			   for ($n=0;$n<count($partirnuevosmodulos);$n++) {
			 			   	
			 			   	$modulosnuevos=explode("*",$partir[$n]);
			 			   	if ($modulosnuevos[0]<>"" && $modulosnuevos[0]<>"0") {
 						?>
	 					<li>
							<? if (is_file("../../img_modulos/img/galeria.png")) {?>
				 					<img src="../../img_modulos/img/galeria.png">
									<?} else {?>
				 					<img src="../../../img_modulos/img/galeria.png">
				 			<? } ?>
							<a href="../../modulos/cms/galerias/default.php">
								GALER&Iacute;A</a>
						</li>
						<? 
						} // fin modulos nuevos
					} // fin modulos nuevos

					while (!$resultx->EOF) {
					    $dsmx=$resultx->fields[0];
						$dsdx=$resultx->fields[1];
			 			$dsrx=$resultx->fields[2];
						$dsiconox=$resultx->fields[3];

			 			$idmodulo=$resultx->fields[6];
			 			?>
			 			<li class="nivel2">
			 			<? include($rutxx."../../incluidos_modulos/modulos.campos.submenus.php"); //1
							// cargar adicional. querys para validar relacion con los datos pero asociados a este modulo y por activo =4
							if ($_SESSION['i_idperfil']==1) {
								$sql="select ";
								$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
								$sql.=" from tblmodulos a ";
								$sql.=" where 1  ";
								$sql.=" and a.idactivo=4 and a.idsubmodulo=$idmodulo ";
								$sql.=" order by a.dsm ASC ";
							}elseif ($_SESSION['i_idperfil']==4) {
								$sql="select ";
								$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id ";
								$sql.=" from tblmodulos a inner join tblusuariosxtblmodulos b on a.id=b.iddestino";
								$sql.=" where 1  ";
								$sql.=" and a.idactivo=4 and a.idsubmodulo=$idmodulo and b.idorigen=".$_SESSION['i_idusuario'];
								$sql.=" order by a.dsm ASC ";
								//echo $sql;
							}elseif($_SESSION['i_idperfil']==-1){
								// menu cargado dinamicamente desde base de datos
								$sql="select ";
								$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id";
								$sql.=" from tblmodulos a ";
								$sql.=" where  ";
								$sql.=" a.idactivo=4 and a.idsubmodulo=$idmodulo ";
								$sql.=" order by a.dsm DESC; ";
							}else {
								// menu cargado dinamicamente desde base de datos
								$sql="select ";
								$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id";
								$sql.=" from tblmodulos a, tblusuariosxtblmodulos b ";
								$sql.=" where 1  ";
								$sql.=" and a.id=b.iddestino  ";
								$sql.=" and b.idorigen=".$_SESSION['i_idusuario'];
								$sql.=" and a.idactivo=4 and a.idsubmodulo=$idmodulo ";
								$sql.=" order by a.dsm ASC ";
							}
							//echo $sql;
							$resulty = $db->Execute($sql);
							 if (!$resulty->EOF) {
								?>
								<ul>

								<?
								while (!$resulty->EOF) {
								    $dsmy=$resulty->fields[0];
									$dsdy=$resulty->fields[1];
						 			$dsry=$resulty->fields[2];
						 			$idmoduloy=$resulty->fields[6];
						 			$dsiconoy=$resulty->fields[3];

								?>
								<li><? include($rutxx."../../incluidos_modulos/modulos.campos.submenus.menus.php"); //?></li>
								<?
								$resulty->MoveNext();
								} // fin while interno
								?>
						<li class="mm-subtitle">
			 				<a class="mm-subclose btn_regresar" href="#mm-0">
			 					<? if (is_file("../../img_modulos/img/home.png")) {?>
			 					<img src="../../img_modulos/img/home.png">
								<?} else {?>
			 					<img src="../../../img_modulos/img/home.png">

								<?}?>
			 				HOME</a>
			 			</li>
								</ul>
								<?
							}
							$resulty->close();
						?>
						</li>
						<?
						$resultx->MoveNext();
					} // fin while interno
			 		?>
			 			<li class="mm-subtitle">
			 				<a class="mm-subclose btn_regresar" href="#mm-0">
			 					<? if (is_file("../../img_modulos/img/home.png")) {?>
			 						<img src="../../img_modulos/img/home.png">
								<?} else {?>
			 						<img src="../../../img_modulos/img/home.png">
			 					<? } ?>
			 				HOME</a>
			 			</li>
			 		</ul>
				<?
				}
				$resultx->close();
				?>
			</li>
			<?
			$result->MoveNext();
			   } // fin while  externo
			?>
          <?if(validar_core($_SESSION['i_idusuario'],75)>0){?>
		<li>
			<? if (is_file("../../img_modulos/img/b2b.png")) {?>
 					<img src="../../img_modulos/img/b2b.png">
					<?} else {?>
 					<img src="../../../img_modulos/img/b2b.png">
 			<? } ?>
			<a href="<? echo $rutxx?>../b2b/productos/default.php">
				B2B</a>
		</li>
		<? } ?>
		<li>
			<? if (is_file("../../img_modulos/img/digital.png")) {?>
 					<img src="../../img_modulos/img/digital.png">
					<?} else {?>
 					<img src="../../../img_modulos/img/digital.png">
 			<? } ?>
			<a href="#">
				ESTRATEGIA DIGITAL</a>
		
<ul>
<li class="nivel2"><a href="<? echo $rutxx;?>../core/core.redir.php?rutaredir=core.estrategia.digital&rutacore=http://www.comprandofacil.com/pide/corehome/" class="link">Asistencia</a></li>
<li class="nivel2"><a href="<? echo $rutxx;?>../core/core.redir.php?rutaredir=core.tickets.estrategia&rutacore=http://www.comprandofacil.com/pide/corehome/" class="link">Ver tickets</a></li>
<li class="nivel2"><a href="<? echo $rutxx;?>../core/core.redir.php?rutaredir=core.estrategia.asesor&rutacore=http://www.comprandofacil.com/pide/corehome/" class="link">Ver &Aacute;ngel</a></li>

<li class="nivel2"><a href="<? echo $rutxx;?>../estrategiadigital/listadocampanas/default.php" title="<? echo $dsdx?>" class="link">Campa&ntilde;as</a></li>
	<li class="mm-subtitle">
			<a class="mm-subclose btn_regresar" href="#mm-0">
				<? if (is_file("../../img_modulos/img/home.png")) {?>
				<img src="../../img_modulos/img/home.png">
			<?} else {?>
				<img src="../../../img_modulos/img/home.png">
			<?}?>HOME</a>
		</li>

		</ul>	


		</li>
	</ul>

</nav>
<?
}
$result->close();
//} // fin validacion de root
?>


