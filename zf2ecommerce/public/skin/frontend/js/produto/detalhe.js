$(document).ready(function() {
	$('.add-cart').on('click', function() {
		var atributoCor = $('#atributo-cor').val();
		var atributoTamanho = $('#atributo-tamanho').val();
		var msg = 'Campos obrigatórios para selecionar: \n';
		var validado = true;

		if (typeof atributoCor !== "undefined") {
		    if (atributoCor == "") {
		    	msg += ' - O atributo cor obigatório \n';
		    	validado = false;
		    }
		}

		if (typeof atributoTamanho !== "undefined") {
			if (atributoTamanho == "") {
		    	msg += ' - O atributo tamanho obigatório \n';
		    	validado = false;
		    }
		}

		if (validado) {
			$('form').submit();
		} else {
			alert(msg);
		}

		console.log('atributoCor: ' + atributoCor + ' atributoTamanho: ' + atributoTamanho);
	});

	$('.filter-color-box').on('click', function() {
		var atributo = $(this).data('atributo');
		$('#atributo-cor').attr('value', atributo);
	});
});