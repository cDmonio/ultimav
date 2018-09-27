		$(document).ready(function(){ //Llamamos y cargamos los puntos de los técnicos.
			puntos();
		});

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
