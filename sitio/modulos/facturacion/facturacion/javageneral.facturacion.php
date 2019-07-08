
<script language="javascript">
<!--
function capacliente(capabase,tipo){
	var contenedor=document.getElementById(''+capabase);
	if (tipo==1) { 
		contenedor.style.display="";
	} else { 
		contenedor.style.display="none";
	}
}
function moverfoco(tipo,valor,pos){
	var key=window.event.keyCode;
	if (key==13){
		if (tipo==1){
		var formabase=eval("document.u."+valor);
		formabase.select();
		return;
		} else { 
			var formabase=eval("document.u.elements['"+valor+"']["+pos+"]");
			formabase.select();
			return;
		}
	}}
function cargardatos(param,idactivox){
	// recargar el combo de clientes
	rutax="clientes.recargar.php?idclientex="+param+"&idactivox="+idactivox;
	conexion1=AjaxObj();
	conexion1.open("POST",rutax,true);
	conexion1.onreadystatechange =function() {
	var contenedorx=document.getElementById('capaclientex');
	 if (conexion1.readyState==4) {
	 var _resultadox = conexion1.responseText;
		// partir el resultado
		//contenedor.innerHTML=_resultado;		 
		contenedorx.innerHTML=_resultadox;									
	 }
	}
	conexion1.send(null) // limpia conexion	
	// recargar los datos de variables del nuevo cliente
	CargarVariables();
	// apagar las capas
	contenedor=document.getElementById('validacion_nuevo_cliente');
	contenedor.innerHTML="";	
}

function mostrarcapa(valorx,e){
	var key=window.event.keyCode;
	if (key!=13) { 
	} else { 
		  var content = document.getElementById('capaprod_'+valorx);
		  if (content) { 
			content.style.display="";
			for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
				if (i==valorx) { 
				document.u.elements['dsref[]'][i].focus();
				break;
				}
			}
		  }
	} 
	totales();
}

 function quitarcapa(div){
 	//alert("encuentra");
	var d = document.getElementById('capaprod_' + div);
			document.u.elements['dsref[]'][div].value="";
			document.u.elements['dsun[]'][div].value="";
			document.u.elements['dsdesc[]'][div].value="";
			document.u.elements['dsvalor[]'][div].value="";
			document.u.elements['dscant[]'][div].value="";
			document.u.elements['dssubtotal[]'][div].value="";
			document.u.elements['dsivax[]'][div].value="";
	if (d) d.style.display="none";	
	totales();
  }


// crear capa basandose en el tipo de producto + presentacion
function validarvalor(pos){	

	// validar que haya datos en idlista

    // Div donde se agregara la nueva linea
	
	for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
		if (i==pos) { 
		var ref=document.u.elements['dsref[]'][i].value;
		//capturar el valor del un combo
		var un=document.u.elements['dsun[]'][i].value;
		break;
		}
	}

	var idcliente=document.u.idcliente.value;
	var idtipocliente=document.u.idtipocliente.value;

if (idcliente==""){
	alert("Debe seleccionar un cliente para continuar con la facturacion");
	document.u.idcliente.focus();
	return;
}


	
	
	if (ref!=""){
		conexion=AjaxObj();
		 conexion.open("POST","pedidos.cargardatos.php?dsref="+ref+"&idprecio="+idtipocliente,true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					if (_resultado=="-1"){
						// abrir popup
						irAPaginaDN('../productos/default.php?enca=1','500','500');
					}
	        } // fin conexion
	      } // fin funcion conexion interna
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	} // fin valorbase


	if (ref!="" &&idtipocliente!=""){
		conexion=AjaxObj();
		 conexion.open("POST","pedidos.cargardatos.php?dsref="+ref+"&dsun="+un+"&idprecio="+idtipocliente+"&idlista=",true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					if (_resultado!="" && _resultado!="-1") { 
						partir=_resultado.split("|");
						for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
							if (i==pos) { 
							
							document.u.elements['dsvalor[]'][i].value=partir[1];
							document.u.elements['dsivax[]'][i].value=partir[2];
							document.u.elements['dsdesc[]'][i].value=partir[3];
							document.u.elements['dsfletex[]'][i].value=partir[4];
							break;
							}
						}
					}
	        } // fin conexion
	      } // fin funcion conexion interna
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	} // fin valorbase
}
// fin crear capa
function totales(){
	// vector valor
	var total=0;
	var subtotal=0;
	var totalbaseiva=0;
	var totalfletex=0;
	var ivax2=0;
	var iva=0;
	for (i=0;i<document.u.elements['dscant[]'].length;i++){ 
		if(document.u.elements['dscant[]'][i].value==""){
		} else { 
			var x=document.u.elements['dsvalor[]'][i].value;
			var y=document.u.elements['dscant[]'][i].value;
			var dsivax=document.u.elements['dsivax[]'][i].value;
			var dsflete=document.u.elements['dsfletex[]'][i].value;
			var dsivaxx=document.u.elements['dsivaxx[]'][i].value;
			valorbase=x*y;
			valorbaseiva=0;
			if (dsivax=="1") valorbaseiva=valorbase; //validdo si tiene iva
			subtotal=subtotal+valorbase;
			totalbaseiva=totalbaseiva+valorbaseiva;
			totalfletex=eval(totalfletex)+eval(dsflete);
			ivax2=eval(ivax2)+eval(dsivaxx);
			
		}	
	} 
	//alert(ivax2);
	/////////////////////////////////////////////////////////////////////////	
	// Basado en dsclientedescuento	
	// es la suma del calculo del descuento por cada uno activo dsdesct[]
	contenedor=document.getElementById('dsdescuentonuevo');
        descuento=0;
		for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
		var x=document.u.elements['dsvalor[]'][i].value;
		var y=document.u.elements['dscant[]'][i].value;
		var d=document.u.elements['dsdesct[]'][i].value;
		var z=(x*y*(d/100));
		descuento=descuento+z;
		}

	dsretebase=document.u.dsclienterete.value;
	if (dsretebase==1) { 
		if ((subtotal-descuento)><? echo $baseRete;?>) { 
			var dsretex=(subtotal-descuento)*<? echo $dsporRete;?>;
		} else { 
			var dsretex=0;
		}	
	} else { 
		var dsretex=0;
	}	
	// retenciones sobre el iva
	
	dsretebaseiva=document.u.dsclientereteiva.value;
	if (dsretebaseiva==1) { 
		if ((subtotal-descuento)><? echo $baseRete;?>) { 
			var dsreteivax=ivax*(<? echo $dsBaseReteIVA;?>/100);
		} else { 
			var dsreteivax=0;
		}	
	} else { 
		var dsreteivax=0;
	}
	/////////////////////////////////////////////////////////////////////////

	document.u.subtotalvalor.value=redondear(subtotal);
	document.u.totaldescuento.value=redondear(descuento);
	document.u.totaliva.value=redondear(ivax2);
	document.u.totalrete.value=redondear(dsretex);
	document.u.totalreteiva.value=redondear(dsreteivax);
	document.u.totalreteica.value=0;
	document.u.totalflete.value=redondear(totalfletex);
	totalx=(eval(ivax2))+(eval(redondear(subtotal)))+(eval(totalfletex))-((eval(redondear(descuento)))+(eval(redondear(dsretex)))+(eval(redondear(dsreteivax))));

	///
	// partir cadena
	
	//document.u.totalvalor.value=redondear(totalx);
	document.u.totalvalor.value=redondear(totalx);
	//calcularsubtotal();
}  

function calcularsubtotal(pos){




	for (i=0;i<document.u.elements['dsref[]'].length;i++){ 
		if (i==pos) { 

		var x=document.u.elements['dsvalor[]'][i].value;
		var y=document.u.elements['dscant[]'][i].value;
		var d=document.u.elements['dsdesct[]'][i].value;
		var iv=document.u.elements['dsivax[]'][i].value;
		var z=x*y -(x*y*(d/100));
		var l=z*(iv/100);
		document.u.elements['dssubtotal[]'][i].value=redondear(z);
		document.u.elements['dsivaxx[]'][i].value=redondear(l);
		document.u.elements['dssubtotal[]'][i].focus();
		break;
		}
	}	
	totales();
}

function CargarVariables(){
	// cargar datos del cliente dependiendeo de la seleccion
	
	var contenedor=document.getElementById('capa_cargarvariables');
	if (contenedor){
		contenedor.innerHTML="Cargando..."
	}
	var idclientex=document.u.idcliente.value;
	if (idclientex!="") { 
		//alert(idclientex) ;
		partirx=idclientex.split("|");
		idclientex=partirx[0];
		idtipocliente=partirx[1];
		// cargar cliente y colocar las variables seleccionadas
		conexion=AjaxObj();
		 conexion.open("POST","clientes.cargardatos.php?idclientex="+idclientex,true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					if (_resultado!="") { 
						partir=_resultado.split("|");
							document.u.dsclienterete.value=partir[0];
							document.u.dsclientereteiva.value=partir[1];
							document.u.dsclienteretica.value=partir[2];
							document.u.dsclientelista.value=partir[3];
							document.u.dsclientedescuento.value=partir[4];
							document.u.portotaldescuento.value=document.u.dsclientedescuento.value;
							//document.u.dsfechav.value=partir[5];
							document.u.dsclientedsdiasv.value=partir[6];
							document.u.idtipocliente.selectedIndex=idtipocliente;

							contenedor.innerHTML="";
							contenedor.style.display="none";
							// ubicacion vendedor
							var idusuariox=partir[7];
							var contar=document.u.elements['dsvendedor'].length;
							for (i=0;i<contar;i++){
									if 	(document.u.elements['dsvendedor'][i].value==idusuariox){
										document.u.elements['dsvendedor'].selectedIndex=i;
									}
							}
							// descuentos
							for (i=0;i<document.u.elements['dsdesct[]'].length;i++){ 
									document.u.elements['dsdesct[]'][i].value=document.u.portotaldescuento.value;
							} 


					} // fin _resultado
		        } // fin funcion
		      } // fin conexion
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	}
}

<? if ($idpedidoy<>"" && $idclientey<>"") {?>
	CargarVariables();
<? } ?>
<!--
function capacliente(capabase,tipo){
	var contenedor=document.getElementById(''+capabase);
	if (tipo==1) { 
		contenedor.style.display="";
		document.u.dsnitnuevo.focus();
	} else { 
		contenedor.style.display="none";
	}
}

function guardarcliente(){
		// datosd
	
	var formabase=eval("document.u");
	var varx=1;
	var idx=0;
	dstiponuevo=formabase.dstiponuevo.value;
	dsnitnuevo=formabase.dsnitnuevo.value;
	dsnombrenuevo=formabase.dsnombrenuevo.value;
	dsapellidosnuevo=formabase.dsapellidosnuevo.value;
	dstelnuevo=formabase.dstelnuevo.value;
	dsdirnuevo=formabase.dsdirnuevo.value;
	dsemail=formabase.dsemail.value;
	if (dstiponuevo==""){
			alert("Debe ingresar el tipo de documento");
			formabase.dstiponuevo.focus();
			return;
	}
	if (dsnitnuevo==""){
			alert("Debe ingresar el documento del nuevo cliente");
			formabase.dsnitnuevo.focus();
			return;
	}

	if (dsnombrenuevo==""){
			alert("Debe ingresar el nombre del nuevo cliente");
			formabase.dsnombrenuevo.focus();
			return;
	}
	if (dsapellidosnuevo==""){
			alert("Debe ingresar el apellido del nuevo cliente");
			formabase.dsapellidosnuevo.focus();
			return;
	}
	if (dsdirnuevo==""){
			alert("Debe ingresar la direccion del nuevo cliente");
			formabase.dsdirnuevo.focus();
			return;
	}

	if (dstelnuevo==""){
			alert("Debe ingresar el telefono del nuevo cliente");
			formabase.dstelnuevo.focus();
			return;
	}



// cargar 


var contenedor=document.getElementById('validacion_nuevo_cliente');
var contenedorx=document.getElementById('capaclientebase');
rutax="clientes.guardar.php?";
rutax=rutax+"dstiponuevo="+dstiponuevo;
rutax=rutax+"&dsnitnuevo="+dsnitnuevo;
rutax=rutax+"&dsnombrenuevo="+dsnombrenuevo;
rutax=rutax+"&dsapellidosnuevo="+dsapellidosnuevo;
rutax=rutax+"&dstelnuevo="+dstelnuevo;
rutax=rutax+"&dsdirnuevo="+dsdirnuevo;
rutax=rutax+"&email="+dsemail;
rutax=rutax+"&idactivo=1";
	if (contenedor){

		contenedor.innerHTML="Validando datos...";
		conexion=AjaxObj();
		 conexion.open("POST",rutax,true);
	     conexion.onreadystatechange =function() {
	                 //	aalert(conexion.readyState);
				 if (conexion.readyState==4) {
				 var _resultado = conexion.responseText;
				 	// partir el resultado
					
					if (_resultado!="") { 

						if (_resultado=="-1")
						{
							data="El cliente que intenta ingresa con el nit " +dsnitnuevo
							data=data+" se encuentra registrado";
						
						}else if (_resultado>0) { 

							data="El cliente"
							data=data+" ha sido registrado";	
							cargardatos(_resultado,idactivox);
							setTimeout('CargarVariables()',100);
							formabase.dsnitnuevo.value="";
							formabase.dsnombrenuevo.value="";
							formabase.dstelnuevo.value="";
							formabase.dsdirnuevo.value="";
							if (contenedorx) contenedorx.style.display='none';

						} else { 
							contenedorx.style.display='none';
							location.reload();
							data=" Problemas<br> "
							data=data+" al insertar los datos<br>"+_resultado;	
						}
						contenedor.innerHTML =data;		 
					} // fin _resultado
		        } // fin funcion
		      } // fin conexion
		    //contenedor.innerHTML ="";		   
		    conexion.send(null) // limpia conexion	
	}


}
function moverfoco(tipo,valor,pos){
	var key=window.event.keyCode;
	if (key==13){
		if (tipo==1){
		var formabase=eval("document.u."+valor);
		formabase.select();
		return;
		} else { 
			var formabase=eval("document.u.elements['"+valor+"']["+pos+"]");
			formabase.select();
			return;
		}


	}

}

    function valx(){
	document.u.submit();
 	}
//-->
<!--
     // validacion acceso
    function valI(){
	if (document.u.dsfechax.value==""){
			alert("Por favor ingrese la fecha de creación");
			document.u.dsfechax.focus();
			return;
     }

	
	if (document.u.dsfechav.value==""){
			alert("Por favor ingrese la fecha de vencimiento");
			document.u.dsfechav.focus();
			return;
     }
	 
	 if (document.u.dsvendedor.value==""){
			alert("Por favor seleccione el vendedor");
			document.u.dsvendedor.focus();
			return;
     }

	totales();

	document.u.submit();
 }
 function enviarconfirmG(m1,m2,tipo,redir,forma){
 	alert("entra");
	if (forma!=""){
		var formabase=eval("document."+forma);
	}
		if (confirm(m1)== true ){
			if (forma!=""){
				formabase.submit();
			} else{
				location.href=redir;
			}
		} else {
			alert(m2);
			return;
		}
}	
//-->
</script>