$(document).ready(function() {
	$('#caracteristicaPerfil').on('change', function() {
		var idCaracteristicaPerfil = $(this).val();
		console.log(idCaracteristicaPerfil);
		$.ajax({
			url: '/admin/produto/get-caracteristicas/' + idCaracteristicaPerfil,
			type: 'GET',
			success: function(data) {
				data = $.parseJSON(data);
				$('#caracteristicas').children().remove();
				$.each(data, function (index, value) {
					console.log(value)
					var content = '<li>' +
							    	'<label for="atributo_'+ value.id + '">' +
										'<input type="checkbox" id="caracterisca_check_'+ value.id + '" name="caracteristica_check['+ value.id + ']" value="'+ value.id + '" /> '+ value.nome +
										'<input type="text" id="caracterisca_valor_'+ value.id + '" name="caracteristica_valor['+ value.id + ']" value="'+ value.valor + '" />' +
									'</label>' +
								'</li>';

					$('#caracteristicas').append(content);
					console.log(content);
				});
				console.log(data);
			}
		});
	});
});