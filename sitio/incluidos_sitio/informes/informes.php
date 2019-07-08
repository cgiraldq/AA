<h1><? echo $dstituloPagina?></h1>
<p><? echo $dsd2Pagina?></p>
<h2>Informes financieros</h2>

<?

  $dsnombre=$_REQUEST["dsnombre"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg  from $dstabla a where idactivo not in(2,9) order by idpos asc";
 // echo $sql;
   $maxregistros=9;
        $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
        $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);

  if(!$result->EOF){
  	 while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=reemplazar($result->fields[1]);
  $dsd=reemplazar($result->fields[2]);
  $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsimg=$result->fields[3];

  $rutaDocumento="../contenidos/images/documentos/";
?>
	<article class="bloque_texto">


	<article class="cont_documentos">
		<ul>

			<li>
			<a href="<? echo $rutalocal?>/descargar.php?path=<? echo $rutaDocumento;?>&file=<? echo $result->fields[3];?>">

				<h3><? echo $dsm;?></h3>
			</a>
				<p><? echo $dsd2;?></p>
			</li>


		</ul>

	</article>

	</article>
<?
 $result->Movenext();
 }
 if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
           if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
 }
  $result->Close();
 ?>