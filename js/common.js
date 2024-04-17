   function setCookie(c_name,value,exdays){
        var exdate=new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
        document.cookie=c_name + "=" + c_value;
    }
    function getCookie(c_name){
        var c_value = document.cookie;
        var c_start = c_value.indexOf(" " + c_name + "=");
        if (c_start == -1)
          {
          c_start = c_value.indexOf(c_name + "=");
          }
        if (c_start == -1)
          {
          c_value = null;
          }
        else
          {
          c_start = c_value.indexOf("=", c_start) + 1;
          var c_end = c_value.indexOf(";", c_start);
          if (c_end == -1)
          {
        c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
        }
        return c_value;
    }
    function checkCookie(){
        var leido=getCookie("leido");
        if (leido==null && leido!="true"){
            document.getElementById('caja_abierta').style.display='block';
        }
    }


$( document ).ready(function() {
	var windowsize = $(window).width();
	var url      = window.location.href;
	var windowHeight = $(window).height();
	var urlAjax = $('.hiddenUrl').html() + "/wp-admin/admin-ajax.php";
	var inside = false;


	//Iniciamos el buscador dinamico
	$('#search').hideseek({
	  highlight: true
	});


	//Borrar usuario desde admin
	$('.usuarioLine span').click(function(){
		$( "#dialog-confirm" ).removeClass("hiddenTag");

		var idUser = $(this).attr("id");

		$( "#dialog-confirm" ).dialog({
		      resizable: true,
		      height: "auto",
		      width: 400,
		      modal: true,
		      buttons: {
		        "Borrar Usuario": function() {
				    $.ajax({
				           type: "POST",
				           url: urlAjax,
				           data: {"action": "removeUser", "idUser": idUser}, // serializes the form's elements.
				           dataType: 'json',
				           success: function(data)
				           {
				           		
								if(data){
									$('.message.messageReal').html("Usuario borrado correctamente.");
									$('.message.messageReal').addClass('success');
									$('.message.messageReal').removeClass('hiddenTag');
								      setTimeout(function(){// wait for 5 secs(2)
								           location.reload(); // then reload the page.(3)
								      }, 1000); 									
								}else{
									$('.message.messageReal').html("No se ha podido borrar el usuario.");
									$('.message.messageReal').removeClass('hiddenTag');
									$('.message.messageReal').addClass('error');
								}	
								           
				           },
						    error: function(data) {
						    	$('.message.messageReal').html("ERROR: No se ha podido borrar el usuario.");
						    	$('.message.messageReal').removeClass('hiddenTag');
						    	$('.message.messageReal').addClass('error');
						    }
				         });	
			        $( this ).dialog( "close" );  
			                
		        },
		        Cancelar: function() {
		          $( this ).dialog( "close" );
		        }
		      }
		    });
	});



   //Activar Usuario
	$('.red.activeButton').click(function(){

		var idUsu = $(this).attr("id");


	    $.ajax({
	           type: "POST",
	           url: urlAjax,
	           data: {"action": "activeUser", "idUsu": idUsu}, // serializes the form's elements.
	           dataType: 'json',
	           success: function(data)
	           {
	           		
					if(data){
						$('.message.messageReal').html("Usuario Activado correctamente.");
						$('#'+idUsu).removeClass("red").addClass("green");
						$('#'+idUsu+' i').removeClass("fa-times-circle").addClass("fa-check-circle");
						$('.message.messageReal').addClass('success');
						$('.message.messageReal').removeClass('hiddenTag');
					}else{
						$('.message.messageReal').html("No se ha podido activar al usuario.");
						$('.message.messageReal').removeClass('hiddenTag');
						$('.message.messageReal').addClass('error');
					}	
					           
	           },
			    error: function(data) {
			    	$('.message.messageReal').html("ERROR: No se ha podido activar al usuario.");
			    	$('.message.messageReal').removeClass('hiddenTag');
			    	$('.message.messageReal').addClass('error');
			    }
	         });	

	});



	//Obtenemos los usuarios para la operacion seleccionada
	$( "#listOpe" ).on( "change", function() {
		var idOpe = $('#listOpe option:selected').attr("value");


	    $.ajax({
	           type: "POST",
	           url: urlAjax,
	           data: {"action": "getMembersByOpe", "idOpe": idOpe},
	           dataType: 'json',
	           success: function(data)
	           {
	           		
					if(data){
						for (i = 0; i < data.length; i++) {

						  $('#membersOpe').append(data[i]);
						} 
							
					
					}else{
						$('.message.messageReal').html("No se ha podido activar al usuario.");
						$('.message.messageReal').removeClass('hiddenTag');
						$('.message.messageReal').addClass('error');
					}	
					           
	           },
			    error: function(data) {
			    	$('.message.messageReal').html("ERROR: No se ha podido activar al usuario.");
			    	$('.message.messageReal').removeClass('hiddenTag');
			    	$('.message.messageReal').addClass('error');
			    }
	         });	  		
	});

	//Obtenemos IOC de la operacion seleccionada
	$( "#listOperations" ).on( "change", function() {
		var idOpe = $('#listOperations option:selected').attr("value");
		$('.usersTable').removeClass("hiddenTag");
		$('.usersTable tbody').empty();

	    $.ajax({
	           type: "POST",
	           url: urlAjax,
	           data: {"action": "getIOCByOP", "idOpe": idOpe},
	           dataType: 'json',
	           success: function(data)
	           {
	           		
					if(data){
						for (i = 0; i <= data.length; i++) {

						  $('.usersTable tbody').append(data[i]);

						} 

					}else{
						$('.message.messageReal').html("No se ha podido recuperar los IOCs.");
						$('.message.messageReal').removeClass('hiddenTag');
						$('.message.messageReal').addClass('error');
					}	
					           
	           },
			    error: function(data) {
			    	$('.message.messageReal').html("ERROR: No se ha podido recuperar los IOCs.");
			    	$('.message.messageReal').removeClass('hiddenTag');
			    	$('.message.messageReal').addClass('error');
			    }
	         });	  		
	});

	//Añadimos usuarios seleccionados a la lista
	$( "#membersOpe" ).on( "change", function() {
		var idUsu = $('#membersOpe option:selected').attr("value");
		var idOpe = $('#listOpe option:selected').attr("value");

		$('#formInsert input[name="idUsu"]').attr("value", idUsu);
		$('#formInsert input[name="idOpe"]').attr("value", idOpe); 

		//$('#listMembersSelected').append("<span>usuario</span>");
	});

	$( "#typeInsert" ).on( "change", function() {
		var type = $('#typeInsert option:selected').attr("value");
		var idUsu = $('#membersOpe option:selected').attr("value");
		var idOpe = $('#listOpe option:selected').attr("value");


		if((typeof idUsu !== 'undefined')&&(typeof idOpe !== 'undefined')){
			
			if(type == "formInsert"){
				$('.formInsertBlock').removeClass("hiddenTag");
				$('.listInsertBlock').addClass("hiddenTag");

				$('input[name="tipeForm"]').attr("value", "1");
			}else{
				$('.listInsertBlock').removeClass("hiddenTag");
				$('.formInsertBlock').addClass("hiddenTag");

				$('input[name="tipeForm"]').attr("value", "2");
			}
			$('#formInsert').removeClass("hiddenTag");
		}
	
	});


	//Borrar operacion desde admin
	$('.opLine span').click(function(){
		$( "#dialog-confirm" ).removeClass("hiddenTag");

		var idOp = $(this).attr("id");

		$( "#dialog-confirm" ).dialog({
		      resizable: true,
		      height: "auto",
		      width: 400,
		      modal: true,
		      buttons: {
		        "Borrar operación": function() {
				    $.ajax({
				           type: "POST",
				           url: urlAjax,
				           data: {"action": "removeOp", "idOp": idOp}, // serializes the form's elements.
				           dataType: 'json',
				           success: function(data)
				           {
				           		
								if(data){
								      setTimeout(function(){// wait for 5 secs(2)
								           location.reload(); // then reload the page.(3)
								      }, 500); 									
								}else{
									$('.message.messageReal').html("No se ha podido borrar la operación.");
									$('.message.messageReal').removeClass('hiddenTag');
									$('.message.messageReal').addClass('error');
								}	
								           
				           },
						    error: function(data) {
						    	$('.message.messageReal').html("ERROR: No se ha podido borrar la operación.");
						    	$('.message.messageReal').removeClass('hiddenTag');
						    	$('.message.messageReal').addClass('error');
						    }
				         });	
			        $( this ).dialog( "close" );  
			                
		        },
		        Cancelar: function() {
		          $( this ).dialog( "close" );
		        }
		      }
		    });
	});


	$('.dateInput').on( "focus", function() {
  		$(this).attr("type", "date");
	} );

	$('.dateInput').on( "focusout", function() {
  		$(this).attr("type", "text");
	} );

});



