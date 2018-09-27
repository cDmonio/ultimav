//Archivos de la carpeta /Ajax/ los jj, reducidos a 7. archivos jj_ cambiados al nombre correspondiente.
//Sólo quedan los necesarios. se han borrado 9 jj, y he limpiado bastante código.
//Por qué no está aún mas reducido? - Por que son eventos del select. Interactuan entre selects.

		$(document).ready(function(){
			puntos();
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_produccion.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
				}
			})
		}

		function puntos(){
				$.ajax({
					type: 'GET',
					url: './ajax/cargar_puntos.php'
				  })
			  .done(function(puntos){
				$('#puntos').html(puntos)
			  })
			  .fail(function(){
				alert('Hubo un errror al cargar los PUNTOS!')
			  })			
		}



	function eliminar (id)
		{
		var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el registro")){
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_produccion.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
	}

$( "#registrar_cita" ).submit(function( event ) {
  $('#guardar_cita').attr("disabled", true);
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nueva_cita.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#guardar_cita').attr("disabled", false);
			load(1);
		  }
	})
	.done(function(datos){
		alert("¡Cita subida con éxito!")
		window.location.href = "index.php";
	});
  event.preventDefault();
})

$( "#guardar_produccion" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 var parametros = $(this).serialize();
 //var formData = new FormData(document.getElementById("guardar_produccion"));
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_produccion.php",
			processData: false, 
			contentType: false, 
			cache: false,
			data: new FormData(this),
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	})
	.done(function(datos){
		// alert("Formulario Subido Con éxito y con fotos!")
		//window.location.href = "index.php";
	});
  event.preventDefault();
})

$( "#editar_produccion" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_produccion.php",
			processData: false, 
			contentType: false, 
			cache: false,
			data: new FormData(this),
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})


$( "#editar_cita" ).submit(function( event ) {
  $('#actualizar_cita').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_cita.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax4").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax4").html(datos);
			$('#actualizar_cita').attr("disabled", false);
			load(1);
		  }
	})
  event.preventDefault();
})

	$('#editarCita').on('show.bs.modal', function (event) {
		//Extraigo los datos mandados del edit hacia el archivo: buscar_produccion. ex: data-button, data-km
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var cita = button.data('cita')
	  var chora = button.data('chora')
	  var cmin = button.data('cmin')	  
	  var km = button.data('km')
	  var proyecto = button.data('proyecto')
	  var orden = button.data('orden')
	  var cp = button.data('cp')
	  var fecha = button.data('fecha')
	  var inicio = button.data('inicio')
	  var fin = button.data('fin')
	  var tipo = button.data('tipo')
	  var longacometida = button.data('longacometida')
	  var router = button.data('router')
	  var deco = button.data('deco')
 	  var antenabandeja = button.data('antenabandeja')
  	  var antena = button.data('antena')
  	  var bandeja = button.data('bandeja')
	  var material = button.data('material')
	  var estado = button.data('estado')
	  var id = button.data('id')
	  var modal = $(this)

	  //si añado o quito algo aquí también tengo que añadir en ajax/nuevo_produccion/editar/ y buscar_produccoin/admin
	  modal.find('.modal-body #mod_km').val(km)
	  modal.find('.modal-body #mod_proyecto').val(proyecto)
	  modal.find('.modal-body #mod_orden').val(orden)
	  modal.find('.modal-body #mod_cp').val(cp)
	  modal.find('.modal-body #mod_fecha').val(fecha)
	  modal.find('.modal-body #mod_inicio').val(inicio)
	  modal.find('.modal-body #mod_fin').val(fin)
	  modal.find('.modal-body #mod_tipo').val(tipo)
	  modal.find('.modal-body #mod_longacometida').val(longacometida)
	  modal.find('.modal-body #mod_router').val(router)
	  modal.find('.modal-body #mod_icajazz').val(deco)
  	  modal.find('.modal-body #mod_antenabandeja').val(antenabandeja)
  	  modal.find('.modal-body #mod_antena').val(antena)
  	  modal.find('.modal-body #mod_bandeja').val(bandeja)
	  modal.find('.modal-body #mod_material').val(material)
	  modal.find('.modal-body #mod_id').val(id)
	  modal.find('.modal-body #mod_estado').val(estado)
	  modal.find('.modal-body #mod_chora').val(chora)
	  modal.find('.modal-body #mod_cmin').val(cmin)


	  	$.ajax({
	      type: 'POST',
	      url: './ajax/form_proyecto.php'
	      })
	    .done(function(proyecto){	    
	    $('#mod_proyecto').html(proyecto);
	    })
	    .fail(function(){
	    alert('Hubo un errror al cargar las listas del proyecto')
	    })
		})

	$('#myModal2').on('show.bs.modal', function (event) {
		//Extraigo los datos mandados del edit hacia el archivo: buscar_produccion. ex: data-button, data-km
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var cita = button.data('cita')
	  var chora = button.data('chora')
	  var cmin = button.data('cmin')	  
	  var km = button.data('km')
	  var proyecto = button.data('proyecto')
	  var orden = button.data('orden')
	  var cp = button.data('cp')
	  var fecha = button.data('fecha')
	  var inicio = button.data('inicio')
	  var fin = button.data('fin')
	  var tipo = button.data('tipo')
	  var longacometida = button.data('longacometida')
	  var router = button.data('router')
	  var deco = button.data('deco')
 	  var antenabandeja = button.data('antenabandeja')
  	  var antena = button.data('antena')
  	  var bandeja = button.data('bandeja')
	  var material = button.data('material')
	  var estado = button.data('estado')
	  var id = button.data('id')
	  var modal = $(this)

	  //si añado o quito algo aquí también tengo que añadir en ajax/nuevo_produccion/editar/ y buscar_produccoin/admin
	  modal.find('.modal-body #mod_km').val(km)
	  modal.find('.modal-body #mod_proyecto').val(proyecto)
	  modal.find('.modal-body #mod_orden').val(orden)
	  modal.find('.modal-body #mod_cp').val(cp)
	  modal.find('.modal-body #mod_fecha').val(fecha)
	  modal.find('.modal-body #mod_inicio').val(inicio)
	  modal.find('.modal-body #mod_fin').val(fin)
	  modal.find('.modal-body #mod_tipo').val(tipo)
	  modal.find('.modal-body #mod_longacometida').val(longacometida)
	  modal.find('.modal-body #mod_router').val(router)
	  modal.find('.modal-body #mod_icajazz').val(deco)
  	  modal.find('.modal-body #mod_antenabandeja').val(antenabandeja)
  	  modal.find('.modal-body #mod_antena').val(antena)
  	  modal.find('.modal-body #mod_bandeja').val(bandeja)
	  modal.find('.modal-body #mod_material').val(material)
	  modal.find('.modal-body #mod_id').val(id)
	  modal.find('.modal-body #mod_estado').val(estado)
	  modal.find('.modal-body #mod_chora').val(chora)
	  modal.find('.modal-body #mod_cmin').val(cmin)




	  //Esta es la parte del JS, pero del edit, la parte de arriba es del insert, pero está bien así por que si se quiere editar algo
	  //Necesito hacer una consulta general de los datos, excepto de los campos insert.

		$.ajax({
			type: 'POST',
			url: './ajax/form_icajazz_editar.php',
			data: {'proyecto':proyecto,
					'deco':deco
				}
		})
		.done(function(proyecto){
			$('#mod_icajazz').html(proyecto) //llamo al div deco
		})
		.fail(function(){
			alert('Hubo un errror al cargar el deco')
		})

					//Añado la lista al formulario de edicion.
	    $.ajax({
	      type: 'POST',
	      url: './ajax/form_proyecto.php',
	      data: {'proyecto':proyecto
					}
	      })
	    .done(function(proyecto){	    
	    $('#mod_proyecto').html(proyecto);
	    })
	    .fail(function(){
	    alert('Hubo un errror al cargar las listas del proyecto')
	    })

	   $.ajax({
	      type: 'POST',
	      url: './ajax/form_edit_acometidas.php',
	      data:{'proyecto':proyecto,
	      		'tipo':tipo
	      }
	    })
	    .done(function(proyecto){
	      $('#mod_tipo').html(proyecto);
	    })
	    .fail(function(){
	      alert('Hubo un errror al cargar las acometidas')
	    })

	    $.ajax({

	      type: 'POST',
	      url: './ajax/form_edit_long_acometida.php',
	      data:{'proyecto':proyecto,
	      		'tipo':tipo,
	      		'longacometida':longacometida
	      }
	    })
	    .done(function(proyecto){
	      $('#mod_longacometida').html(proyecto);
	    })
	    .fail(function(){
	      alert('Hubo un errror al cargar las acometidas')
	    })

		
			$.ajax({
				type: 'POST',
				url: './ajax/form_edit_acometidas.php',
				data: {'proyecto':proyecto,
						'tipo':tipo
					}
			})
			.done(function(proyecto){
				$('#longtipos').html(proyecto) //llamo al div longtipos
			})
			.fail(function(){
				alert('Hubo un errror al cargar los tipos de acometidas')
			})


			$.ajax({
				type: 'POST',
				url: './ajax/form_edit_long_acometida.php',
				data: {'proyecto':proyecto,
						'tipo':tipo,
					   'longacometida':longacometida
					}
			})
			.done(function(proyecto){
				$('#longacometidas').html(proyecto) //llamo al div decodeco
			})
			.fail(function(){
				alert('Hubo un errror al cargar el deco')
			})

			$.ajax({
				type: 'POST',
				url: './ajax/form_noVod.php',
				data: {'proyecto':proyecto,
						'km':km,
						'cp':cp,
						'fecha':fecha,
						'inicio':inicio,
						'fin':fin,
						'router':router
						}
			})
			.done(function(proyecto){
				$('#cargarForm').html(proyecto) //llamo al div deco
			})
			.fail(function(){
				alert('Hubo un errror al cargar los km')
			})


			$.ajax({
				type: 'POST',
				url: './ajax/form_antenabandeja_editar.php',
				data: {'proyecto':proyecto,
						'antena':antena,
						'bandeja':bandeja
					}
			})
			.done(function(proyecto){
				$('#mod_antenabandeja').html(proyecto) //llamo al div decodeco
			})
			.fail(function(){
				alert('Hubo un errror al cargar el deco')
			})


			$('#mod_proyecto').on('change', function(){ 
				//Almaceno la variable proyect y se la mando al php mediante post.
				var proyecto = $('#mod_proyecto').val()

				$.ajax({
				type: 'POST',
				url: './ajax/form_icajazz_editar.php',
				data: {'proyecto':proyecto,
						'deco':deco
					}
				})
				.done(function(proyecto){
					$('#mod_icajazz').html(proyecto) //llamo al div decodeco
				})
				.fail(function(){
					alert('Hubo un errror al cargar el deco')
				})
			})


			$('#mod_proyecto').on('change', function(){ 
				//Almaceno la variable proyect y se la mando al php mediante post.
				var proyecto = $('#mod_proyecto').val()

				$.ajax({
				type: 'POST',
				url: './ajax/form_noVod.php',
				data: {'proyecto':proyecto,
						'km':km,
						'cp':cp,
						'fecha':fecha,
						'inicio':inicio,
						'fin':fin,
						'router':router
						}
				})
				.done(function(proyecto){
					$('#cargarForm').html(proyecto) //llamo al div decodeco
				})
				.fail(function(){
					alert('Hubo un errror al cargar el Formulario')
				})
			})

			$('#mod_proyecto').on('change', function(){ 
				//Almaceno la variable proyect y se la mando al php mediante post.
				var proyecto = $('#mod_proyecto').val()
				$.ajax({
				type: 'POST',
				url: './ajax/form_antenabandeja_editar.php',
				data: {'proyecto':proyecto,
						'antena':antena,
						'bandeja':bandeja
					}
				})
				.done(function(proyecto){
					$('#mod_antenabandeja').html(proyecto) //llamo al div decodeco
				})
				.fail(function(){
					alert('Hubo un errror al cargar el deco')
				})
			})

	})
