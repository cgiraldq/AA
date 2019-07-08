 <?
        $rutaImagenRedes="../contenidos/images/redes/";
        $sql="select id,dsm,dsimg1,dsruta from tblredes where idactivo=1";
        //    echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
      ?>
				<article class ="redes">
					<ul>
				<?
				while(!$result->EOF){
				$id=reemplazar($result->fields[0]);
				$dsm=reemplazar($result->fields[1]);
				$dsimg1=($result->fields[2]);
				$dsruta=$result->fields[3];
				?>
						<li><a href="<? echo $dsruta ?>" target="_blank">
							<? if($dsimg1<>"") { ?><img src="<? echo $rutalocalimag;?>/contenidos/images/redes/<? echo $dsimg1; ?>"><? } ?>
							</a>
						</li>

			<?
				$result->MoveNext();
				}
			?>

					</ul>

		<?
			}
			$result->Close();
		?>

		</article>