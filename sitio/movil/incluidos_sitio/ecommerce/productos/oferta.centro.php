	<?
// armazon de productos

            $sql="select a.id,a.dsm,a.dsruta,a.dsimg1,a.precio1,a.iva,a.preciodescuento,a.dsd,a.idactivo,a.idnat,a.preciocompra";
            $sql.=",a.precio2";
            $sql.=" from tblproductos a";
            if ($idcat<>"") $sql.=" inner join tblcategoriaxtblproducto b on b.idorigen=a.id ";
			if ($idtienda>0<>"") $sql.=" inner join tblempresaxtblproducto c on c.idorigen=a.id ";

            $sql.=" where a.id >0 and a.idtipoprod=1 and ($fechaBaseNum between a.idfechainicial and a.idfechafinal) ";
            $sql.=" and a.idactivo=11 ";

            if ($idcat<>"") $sql.="  and b.iddestino=".$idcat;
            if ($idtienda>0) $sql.=" and c.iddestino=".$idtienda;


             $sql.=" order by rand() desc ";


//echo $sql;

//            $db->debug=true;
            $result=$db->Execute($sql);
            if(!$result->EOF){


	?>
<section class="cont_oferta_centro">
	<h4>OFERTAS DEL DÍA</h4>
	<article class="oferta_centro">
		<ul id="oferta_centro">
			<?
            while (!$result->EOF) {
            $id=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);

            $dsd=elliStr(reemplazar($result->fields[7]),70);

            $dsimg1=($result->fields[3]);
            $precio1=($result->fields[4]);
            $iva=($result->fields[5]);

            $idprecio1=$precio1+$precio1*($iva/100);
            $idactivo=trim($result->fields[8]);
            $idnat=trim($result->fields[9]);
            $preciocompra=trim($result->fields[10]);

            //$dspordescuento=($result->fields[6]);
            $preciodescuento=($result->fields[6]);
            if ($preciodescuento=="") $preciodescuento=0;
            $idprecio2=0;
            if ($idnat==1 && $preciodescuento<=0) $idprecio1=$precio1; // este valor viene con el iva incluido si es producto nacional y sin descuento
            //$idprecio2=$precio1-$precio1*($dspordescuento/100); // valor descuento
            if ($preciodescuento>0) $idprecio2=$preciodescuento; // valor descuento

            //$idprecio2=$idprecio2+$idprecio2*($iva/100);

            $dsruta=$rutaFuenteImagenes."/contenidos/".$result->fields[2];
            if ($idtienda>0) $dsruta="productos.detalle.php?idproducto=".$id;
            //if ($rutaAmiga>1) $dsruta="productos.detalle.php?idproducto=".$id;

            $preciomostrar=$idprecio1;
            if ($idprecio2<$idprecio1 && $idprecio2>0) $preciomostrar=$idprecio2;

			$preciobase=$preciomostrar;
			if ($preciocompra>0) $preciobase=$preciocompra;


            // sumar precio2
            $precio2=($result->fields[11]);
            //echo $precio2;
            if ($precio2<0) $precio2=0;
					//echo "s";
					$valorseguro=0;
					if ($idnat<>1) {
					//$valorseguro=($preciobase)-($valorbasesinseguro);
					//$valorseguro=($valorseguro)*$porvalorseguro;
					}
            $iva=($preciobase*($result->fields[5]/100));
			$ivax=($result->fields[5]);

            // constructor de mostrar porcentaje
            $precio1m=$precio1/(1-($ivax/100));
            $preciodescuentom=$preciodescuento/(1-($ivax/100));
            $pordescuentom=(($precio1m-$preciodescuentom)/$precio1m)*100;
            // fin constructor de mostrar porcentaje


            ?>
				<li>
					<a href="<? echo $dsruta?>">
					<article class="cont_gal_header">
						<p><?echo $dsm?> - <? if ($preciodescuento>0) {?><? echo number_format($pordescuentom,0) ?>% -<?}?> $<? echo number_format($preciomostrar+$precio2+$valorseguro+$iva,0) ?></p>
					</article>
					</a>
				</li>

			        <?

        $result->MoveNext();
        }
		?>
		</ul>
	</article>
</section>
<?
// fin armazon de productos

}
        $result->Close();

?>