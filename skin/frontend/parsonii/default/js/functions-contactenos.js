jQuery(document).ready(function () {
 
  jQuery('#enviar').click(function () {
  
        if (validarCampos()) {

            jQuery.ajax({
                type: "POST",
                url: "skin/frontend/parsonii/correos/correo-contactenos.php?opcion=1",
                data: jQuery('#contactForm').serialize(), // Adjuntar los campos del formulario enviado.
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + "\n" + errorThrown);
                },
                success: function (result) {
                    var data = eval('(' + result + ')');

                    if (data.res === 'all') {

                        alert(data.msg);
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });
  
  
    jQuery('#enviar_landing').click(function () {
//jQuery("input:text").val("123");
			
        if (validarCampos_landing()) {

            jQuery.ajax({
                type: "POST",
                url: "skin/frontend/parsonii/correos/correo-contactenos.php?opcion=2",
                data: jQuery('#contactForm').serialize(), // Adjuntar los campos del formulario enviado.
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + "\n" + errorThrown);
                },
                success: function (result) {
                    var data = eval('(' + result + ')');

                    if (data.res === 'all') {

                        alert(data.msg);
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });
  
});
var input_val="#nombre, #apellido, #cedula, #celular, #email, #ciudad, #direccion, #barrio, #day, #month, #year, #ref_personal_nom_apell, #ref_personal_cel, #ref_parentesco, #colores, #fecha";
function validarCampos_landing(){

  var campos="";
var email = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

  cssClear_landing();
   
   jQuery(input_val).each(function(){
	
        	    if(jQuery(this).val()===""){
					campos=campos+", "+jQuery(this).attr('title');
						jQuery("#"+jQuery(this).attr('id')).css({"border": "1px solid #df280a"});
						jQuery("#"+jQuery(this).attr('id')).focus();
				}else if (!email.test(jQuery("#email").val().trim())){
				   campos=' \n¡ingresar un correo valido!';
					jQuery('#email').css({"border": "1px solid #df280a"});
					jQuery( "#email" ).focus();
					return false;
}
        	});
campos=campos.substr(1);
if(campos!==""){
alert("Debes completar los campos obligatorios :\n"+ campos); 
return false;
}
			
  /*jQuery("input:radio:checked").each(function(){
        	    alert(jQuery('input[name="'+jQuery(this).attr('name')+'"]:checked').val());
        	});*/
var class_categorias=["categoria","talla","dormir","intimas","intimas2","empaque"];
		for(var i=0;i<class_categorias.length;i++){
			//alert(class_categorias[i]);
			var n = jQuery( "."+class_categorias[i]+":checked" ).length;
				 if(n==0){
					   alert('Debes elegir por lo menos una opción!');
					jQuery('.'+class_categorias[i]).addClass("validar");
					jQuery( "."+class_categorias[i] ).focus();
				   return false; 
				 }
  
}
return true;
}

function validarCampos(){
  
  cssClear();
  
  if (jQuery('#nombre').val() === ""){
    alert('Este es un campo obligatorio');
    jQuery('#nombre').css({"border": "1px solid #df280a"});
    jQuery( "#nombre" ).focus();
    return false;
  }
  
  /*if (jQuery('#empresa').val() === ""){
    alert('Ingrese Nombre de la Empresa');
    jQuery('#empresa').css({"border": "1px solid #df280a"});
    jQuery( "#empresa" ).focus();
    return false;
  }*/
  
  if (jQuery('#email').val() === ""){
    alert('Este es un campo obligatorio');
    jQuery('#email').css({"border": "1px solid #df280a"});
    jQuery( "#email" ).focus();
    return false;
  }
  
  var email = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  if (!email.test(jQuery("#email").val().trim())){
    alert('Este es un campo obligatorio');
    jQuery('#email').css({"border": "1px solid #df280a"});
    jQuery( "#email" ).focus();
    return false;
  }
  
  if (jQuery('#telefono').val() === ""){
    alert('Este es un campo obligatorio');
    jQuery('#telefono').css({"border": "1px solid #df280a"});
    jQuery( "#telefono" ).focus();
    return false;
  }
  
  if (jQuery('#mensaje').val() === ""){
    alert('Este es un campo obligatorio');
    jQuery('#mensaje').css({"border": "1px solid #df280a"});
    jQuery( "#mensaje" ).focus();
    return false;
  }

  
  return true;
}

function cssClear_landing(){
 jQuery(input_val).each(function(){
jQuery("#"+jQuery(this).attr('id')).css({"border": "", "box-shadow": ""});
});

 jQuery("input[type='checkbox']").removeClass("validar");
}


function cssClear(){
  
  jQuery('#nombre').css({"border": "", "box-shadow": ""});
  //jQuery('#empresa').css({"border": "", "box-shadow": ""});
  jQuery('#email').css({"border": "", "box-shadow": ""});
  jQuery('#telefono').css({"border": "", "box-shadow": ""});
  jQuery('#mensaje').css({"border": "", "box-shadow": ""});
  //jQuery('#terminos').css({"border": "", "box-shadow": ""});
}