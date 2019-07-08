<script>

$(document).ready(function(){

        $("#result_header").slideUp();

        var consulta;

        $("#cliente").focus();

        $("#cliente").keyup(function(){



              $cliente = $("#cliente").val();

              $.ajax({

                    type: "POST",

                    url: "../../validaciones/consultar.clientes.php?cliente="+ $cliente+"",

                    data: "cliente="+ $cliente+"",

                    dataType: "html",

                    beforeSend: function(){

                          $("#result_header").slideDown();

                          $("#result_header").html("<article><img src='../../../images/ajax-loader.gif' /></article>");

                    },

                    error: function(){

                          console.log("error peticion ajax");

                    },

                    success: function(data){

                          $("#result_header").empty();

                          $("#result_header").slideDown();

                          $("#result_header").append(data);

                          $('.item-link').on('click', function(){

                            var id = $(this).attr('data');

            							var partir = id.split("-");

                            $("#result_header").empty();

                            $("#result_header").slideDown();

                            $("#cliente").val(partir[0]);

                            $("input[name='idclien']").val(partir[1]);

                            document.getElementById('result_header').style.display='none';


                          });

                    }

              });

        });

});



$(document).ready(function(){

        $("#result_plan").slideUp();

        var consulta;

        $("#plan").focus();

        $("#plan").keyup(function(){



              $plan = $("#plan").val();

              $.ajax({

                    type: "POST",

                    url: "../../validaciones/consultar.plan.php?plan="+ $plan+"",

                    data: "plan="+ $plan+"",

                    dataType: "html",

                    beforeSend: function(){

                          $("#result_plan").slideDown();

                          $("#result_plan").html("<article><img src='../../../images/ajax-loader.gif' /></article>");

                    },

                    error: function(){

                          console.log("error peticion ajax");

                    },

                    success: function(data){

                          $("#result_plan").empty();

                          $("#result_plan").slideDown();

                          $("#result_plan").append(data);

                          $('.item-link').on('click', function(){

                            var id = $(this).attr('data');

            							var partir = id.split("-");

            						    console.log(partir);

                            $("#result_plan").empty();

                            $("#result_plan").slideDown();

                            $("#plan").val(partir[0]);

                            $("input[name='idplan']").val(partir[1]);
                            document.getElementById('result_plan').style.display='none';
                            var url='preview.plan.envio.php?idplan='+partir[1];
                            document.getElementById('preview').innerHTML="<a href='#' onclick=irAPaginaDN('"+url+"') >Previsualizar</a>    <a href='http://univiajes.viajes/beta/cms.productos.detalle.php?id="+partir[1]+"' target='_blank'>Ver en el sitio</a>";

                          });

                    }

              });

        });

});

function enviarguardar(oper){

    var plan = "";
    var cliente = "";
    var nombre = "";
    var apellido = "";
    var email = "";
    var telefono = "";
    var idcliente = "";
    var idplan = "";


    if(oper == 1)
    {


      if(document.getElementById('nombre').value != "" && document.getElementById('email').value != "" && document.getElementById('idplan').value  !=  ""){

        plan = document.getElementById('plan').value;
        cliente = document.getElementById('cliente').value;
        nombre = document.getElementById('nombre').value;
        apellido = document.getElementById('apellido').value;
        email = document.getElementById('email').value;
        telefono = document.getElementById('telefono').value;
        idcliente = document.getElementById('idclien').value;
        idplan = document.getElementById('idplan').value;

        ruta = "../../validaciones/enviar.guardar.cliente.php?&nombre="+nombre+"&telefono="+telefono+"&email="+email+"&plan="+plan+"&idplan="+idplan+"&apellido="+apellido+"&oper="+oper;

        }
        else
        {

          alert('No se puede procesar la solicitud con campos incompletos');
          return false;

        }
    }
    else
    {

      if(document.getElementById('idplan').value != "" && document.getElementById('idclien').value != "" && document.getElementById('plan').value  !=  "")
      {

       plan = document.getElementById('plan').value;
       cliente = document.getElementById('cliente').value;
       idcliente = document.getElementById('idclien').value;
       idplan = document.getElementById('idplan').value;

       ruta = "../../validaciones/enviar.guardar.cliente.php?&plan="+plan+"&idplan="+idplan+"&cliente="+cliente+"&idcliente="+idcliente+"&oper="+oper;
      }
         else
        {

          alert('No se puede procesar la solicitud con campos incompletos');
          return false;

        }
    }

    conexion1=AjaxObj()
    contenedor1="imprimir_resultado";
    conexion1.open("POST",ruta ,true);
    conexion1.onreadystatechange =function() {

    if (conexion1.readyState==4) {
        var _resultado = conexion1.responseText;
        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
        if (contenedor1){

        contenedor1=document.getElementById(contenedor1);
        contenedor1.innerHTML = _resultado;

          }

          }

        } // fin conexion1

      } // fin funcion conexion1 interna
      ruta="";
      conexion1.send(null) // limpia conexion

  }


</script>

<style type="text/css">

	.result_header

	{



	position: absolute;

	width: 350px;

	text-align: left;

	right: 0px;

	overflow-x: hidden;

	overflow-y: auto;

	max-height: 250px;

	left: 12px;

	z-index: 999999;

	background-color: #FFFFFF;

	box-shadow: 3px 3px 3px #dcdcdc;

	padding-left: 15px;

	padding-top: 5px;



	}

.result_header .cont-items .item-link:hover {

    background: #EEE none repeat scroll 0% 0%;

    border-top: 1px solid #DDD;

    border-bottom: 1px solid #DDD;

    cursor: pointer;

}

</style>


    <div id="imprimir_resultado">
    </div>

    <article class="texto_centro" >
        <h1>Enviar plan al cliente</h1>
    </article>
    <nav>
        <input type="button" value="Principal Asesor" class="botones" onclick="irAPaginaD('../../core.asesor/default.php');" title="Click para ir al principal asesor">
    </nav>

	<table class="frm_campos_consola" width="100%" cellspacing="0">

		<tr>

			<td>

				Producto o Servicio

			</td>

			<td>

				<input type="text" name="plan" id="plan">
        <span id="preview"></span>

				<input type="hidden" name="idplan" id="idplan">

				<section class="result_header" id="result_plan" ></section>

			</td>

		</tr>

		<tr>

			<td>

				Cliente

			</td>

			<td>

				<input type="text" name="cliente" id="cliente">

				<input type="hidden" name="idclien" id="idclien">

				<section class="result_header" id="result_header" ></section>

			</td>

		</tr>
    <tr>
        <td>
          &nbsp;
        </td>
      <td >
        <input type="button" class="botones2" value="Enviar y crear cotizacion" onclick="enviarguardar(2);">
      </td>
    </tr>
<tr>
  <td colspan="2">
    Si el cliente no existe lo puede registrar aqu&iacute;
  </td>
</tr>
    <tr>
      <td>
        Nombre
      </td>
      <td>
        <input type="text" name="nombre" id="nombre">
      </td>
    </tr>
        <tr>
      <td>
        Apellido
      </td>
      <td>
        <input type="text" name="apellido" id="apellido">
      </td>
    </tr>
    <tr>
      <td>
        Telefono
      </td>
      <td>
        <input type="text" name="telefono" id="telefono">
      </td>
    </tr>
    <tr>
      <td>
        Email:
      </td>
      <td>
        <input type="text" name="email" id="email">
      </td>
    </tr>
      <tr>
        <td>
          &nbsp;
        </td>
      <td >
        <input type="button" class="botones2" value="Registrar cliente, crear cotizacion y enviar" onclick="enviarguardar(1);">
      </td>

    </tr>
  </table>
