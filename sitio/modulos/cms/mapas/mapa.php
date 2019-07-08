 <?
  $rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
?>
<html>
<head>
   <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<? echo $keyx;?>"type="text/javascript"></script>

   <script type="text/javascript">
    //<![CDATA[
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("capa_mapa"));
		map.setCenter(new GLatLng(6.232712059925625,-75.58113098144531), 13);

	    map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        map.addControl(new GScaleControl());
        map.addControl(new GOverviewMapControl());
		//map.enableContinuousZoom();
		//map.enableDoubleClickZoom();

	    var center = map.getCenter();
		map.setCenter(center, 13);
        var marker = new GMarker(center, {draggable: true});

		GEvent.addListener(marker, "dragstart", function() {
		 	map.closeInfoWindow();

		 });

 		  GEvent.addListener(marker, "dragend", function() {
		  var position = marker.getPoint();
	  	  map.panTo(new GLatLng(position.lat(), position.lng()));
		  // constructor del mensaje
		  var center = map.getCenter();
		  var texto="<form method=post name='forma' action='<? echo $pagina;?>'>";
		  texto=texto+"Latitud / Longitud: <br>";
		  texto=texto+"<textarea cols=20 rows=3 name='coord'>"+position.lat()+","+position.lng()+"</textarea><br>";
		  texto=texto+"Zoom: <input type='text' name='zoom' value='"+map.getZoom()+"' size=5 readonly><br>";
		  texto=texto+"Seleccione La tienda:<br> ";
		  <?
		  $sql="select id,dsm from cms_tbltiendas order by id asc ";
		  $result=$db->Execute($sql);
			if(!$result->EOF){
				?>
				texto=texto+"<select name='idtienda'> ";<?
				while(!$result->EOF){
				?>texto=texto+"<option value='<? echo $result->fields[0]?>'><? echo $result->fields[1]?>";<?
				$result->MoveNext();
				}
				?>texto=texto+"</select> <br>";<?
			}
		  $result->Close();
		  ?>
	 	texto=texto+"<input type=button name=enviar value='Agregar' onclick='adicionar(1);'> ";
		texto=texto+"<input type='hidden' name='del' value=''> ";
		texto=texto+"</form> ";
		  // texto hml

          document.getElementById("capa_mensaje").innerHTML=texto;



        }); // fin funcion
		 map.addOverlay(marker);

      }






    }

    function AjaxObj(){
		var xmlhttp=false;
		 try {
		 xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		 try {
		 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		 } catch (E) {
		 xmlhttp = false;
		 }
		 }
		
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		 xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
} 	




	function adicionar(tipo){
	if (tipo==1){
		var formabase=eval("document.forma");
	} else {
		var formabase=eval("document.forma");
	}
    document.all.capa_resultados.style.display = "none";
    contenedor=document.getElementById('capa_resultados');
	delx=formabase.del.value
	codigo=formabase.idtienda.value;
	coord=formabase.coord.value;
	zoom=formabase.zoom.value;
	conexion=AjaxObj();
	ruta="adicionar.mapa.php?";
	ruta=ruta+"del="+delx+"&codigo="+codigo+"&coord="+coord+"&zoom="+zoom+"&tipo=VALLAS";
	conexion.open("GET",ruta,true);
     conexion.onreadystatechange =function() {
	 if (conexion.readyState==4) {
	 document.all.capa_resultados.style.display = "";
	   var _resultado = conexion.responseText;
	   if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
		 //	 cargar datos a la capa
		 contenedor.innerHTML = _resultado;
		 document.all.capa_resultados.style.display = "";
		 cargar(1); // carga el combo de datos de las vallas
		 // redirigir aca
	   } else if(_resultado == "0"){
	   } else if(_resultado=="-1") {
	     document.all.capa_resultados.style.display = "";
		 contenedor.innerHTML = "No hay datos que mostrar";
	   }  // fin si
	  } // fin conexion
   } // fin funtcion
  conexion.send(null) // limpia conexion

	}
	

	function cargar(tipo){
    document.all.capa_ubicaciones.style.display = "none";
    contenedor=document.getElementById('capa_ubicaciones');
	conexion=AjaxObj();
	ruta="../../../incluidos_modulos/cargar.mapa.php";
	//alert(ruta);
	conexion.open("GET",ruta,true);
     conexion.onreadystatechange =function() {
	 if (conexion.readyState==4) {
	 document.all.capa_ubicaciones.style.display = "";
	   var _resultado = conexion.responseText;
	   if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
		 //	 cargar datos a la capa
		 contenedor.innerHTML = _resultado;
		 document.all.capa_ubicaciones.style.display = "";
		 // redirigir aca
	   } else if(_resultado == "0"){
	   } else if(_resultado=="-1") {
	     document.all.capa_ubicaciones.style.display = "";
		 contenedor.innerHTML = "No hay datos que mostrar";
	   }  // fin si
	  } // fin conexion
   } // fin funtcion
  conexion.send(null) // limpia conexion

	}

function ubicar(tipo){
	contenedor=document.getElementById('capa_resultados');
	var datos=document.ubicaciones.paramubicar.value;
	var tipox=tipo;
	partir=datos.split("|");
	if (datos!="") {
		codigo=partir[0];
		lat=eval(partir[1]);
		lon=eval(partir[2]);
		zoom=eval(partir[3]);
		direccion=partir[4];
		idpunto=partir[5];

	}
	if (datos!="" && tipo==1){  // ubicar en mapa
		// partir cadena

		if (GBrowserIsCompatible()) {
        	var map = new GMap2(document.getElementById("capa_mapa"));
		    map.addControl(new GMapTypeControl());
		    map.addControl(new GLargeMapControl());
		    map.addControl(new GScaleControl());
		    map.addControl(new GOverviewMapControl());
			map.enableContinuousZoom();
			map.setCenter(new GLatLng(lat,lon), zoom);
		    map.clearOverlays();
			var point=new GLatLng(lat,lon);
			var marker = new GMarker(point, {draggable: false});
		    map.addOverlay(marker);
			// cargar los mensajes
			html='<div style="border-bottom:1px solid #333;color:#006ec6">'+codigo+'</div><div style="margin-top:1px;margin-bottom:3px;"><span class=texto>' +direccion + '</span><br></div>'
			 marker.openInfoWindowHtml(html);
		}
	}else if (datos!="" && tipo==3){  // Eliminar del mapa

		// eliminar valla
	ruta="../../../incluidos_modulos/cargar.mapa.php?tipo=1&id="+idpunto;
	conexion.open("GET",ruta,true);
    conexion.onreadystatechange =function() {
	 if (conexion.readyState==4) {
	 document.all.capa_resultados.style.display = "";
	   var _resultado = conexion.responseText;
	   if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
		 //	 cargar datos a la capa
		 contenedor.innerHTML = _resultado;
		 document.all.capa_resultados.style.display = "";
		 cargar(1);
		 load();
		 // redirigir aca
	   } else if(_resultado == "0"){
	   } else if(_resultado=="-1") {
	     document.all.capa_resultados.style.display = "";
		 contenedor.innerHTML = "No hay datos que eliminar";
	   }  // fin si
	  } // fin conexion
   } // fin funcion
  conexion.send(null); // limpia conexion

	}else if (datos!="" && tipo==2){  // Modificar en el mapa




	} else {
		alert("Debe seleccionar al menos un punto");
	}
	/*
	// escuchar para procesos
	 GEvent.addListener(map, "click", function() {
 	    map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        map.addControl(new GScaleControl());
        map.addControl(new GOverviewMapControl());
		map.enableContinuousZoom();
          var center = map.getCenter();
		  map.clearOverlays();
		  // constructor del mensaje
		  texto="Latitud / Longitud: <br>";
		  texto=texto+"<textarea cols=20 rows=3 name='coord'>"+ center.toString()+"</textarea><br>";
		  texto=texto+"Zoom: <input type='text' name='zoom' value='"+map.getZoom()+"' size=5 readonly><br>";
		  // texto hml
          document.getElementById("capa_mensaje_ubicaciones").innerHTML =texto;
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);

        });
	*/
}


    //]]>
    </script>
</head>
<body onload="load()" onunload="GUnload()">
	<table align="center"  cellspacing="0" cellpadding="0" border="0" width=100%>
<tr  class=titulo valign="top">
<td>
 <div id="capa_mapa" style="width: 800px; height: 400px"></div>

</td>
<td class="texto">
<div id="capa_mensaje"></div>
<div id="capa_resultados"></div>
<form method=post action=<? echo $pagina?> name=ubicaciones>
<div id="capa_mensaje_ubicaciones"></div>
<div id="capa_ubicaciones"></div>
</form>
<div id="capa_recargar">
<form method="post" name="recargar">
<input type="button" name="enviar" value="Recargar Mapa" onclick="load(1);">
<!--input type="button" name="enviar" value="Cargar todas las vallas" onclick="vertodos();"-->
</form>
</div>
</td>


</tr>
</table>

</body>
</html>
<script type="text/javascript">
cargar(1)
</script>