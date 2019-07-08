<?			$sql="select a.id,a.dstit,a.dsm from tblpaginas a ";
			$sql.=" where a.idactivo in (1) and a.idtienda=1 ";
			$sql.=" order by dstit asc ";
			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){?>
			<div class="menu_categorias">
			<h2>INFORMACIÓN</h2>
			<ul>
			<?
			while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			$dsruta=$resultx->fields[2];
			$dsrutax=$dsruta;?>
			<li><a href="<?echo $rutbase."/".$dsrutax?>"><? echo $dsm?></a></li>
			<?$resultx->MoveNext();
			} // fin while*/
			?>
			</ul>
			</div>
			<?
			}
			$resultx->Close();
			?>
	