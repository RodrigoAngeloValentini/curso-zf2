$(document).ready(function() {

	$('#calcular-frete').on('click', function() {
        var cep = $('#cep').val();
        if (cep != "") {
            $.ajax({
                url: '/carrinho/calculo-frete',
                data: {cep: cep},
                type: 'POST',
                success: function(data) {
                    data = $.parseJSON(data);

                    $.each(data.cServico, function(index, value) {
                        if (value.Codigo == '40010') {
                            html = '' +
                            '<div class="input-group">' +
                                '<span class="input-group-addon">' +
                                    '<span class="input-icon input-icon-user"></span>' +
                                    '<span class="input-text">Sedex (R$ ' + value.Valor + ')</span>' +
                                '</span>' +
                                '<input type="hidden" name="codigo_frete" class="form-control" value="' + value.Codigo + '">' +
                                '<input type="radio" name="valor_frete" class="form-control input-lg" value="' + value.Valor + '">' +
                            '</div><!-- End .input-group -->';

                            $('#form-calculo-frete .col-md-12').append(html);
                        }

                        if (value.Codigo == '41106') {
                            html = '' +
                            '<div class="input-group">' +
                                '<span class="input-group-addon">' +
                                    '<span class="input-icon input-icon-user"></span>' +
                                    '<span class="input-text">PAC (R$ ' + value.Valor + ')</span>' +
                                '</span>' +
                                '<input type="hidden" name="codigo_frete" class="form-control" value="' + value.Codigo + '">' +
                                '<input type="radio" name="valor_frete" class="form-control input-lg" value="' + value.Valor + '">' +
                            '</div><!-- End .input-group -->';

                            $('#form-calculo-frete .col-md-12').append(html);
                        }

                        $('#calcular-frete').remove();

                    });

                    html = '' +
                    '<div class="input-group">' +
                        '<input type="submit" name="submit" class="btn btn-custom-2 md-margin" value="Calcular">' +
                    '</div><!-- End .input-group -->';

                    $('#form-calculo-frete .col-md-12').append(html);
                }
            });
        }
	});

});