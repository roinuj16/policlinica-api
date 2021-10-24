(function ($) {
    $.fn.limit = function (options) {
        return this.each(function () {
            var context = $(this);
            var total;
            if(options == undefined) {
                total = 200;
            } else {
                if (typeof options == 'number') {
                    total = options;
                } else {
                    console.error('Erro! O valor passado para função LIMIT() deve ser um número inteiro.');
                }
            }
            var atual = context.val().length;
            var restante = total - atual;
            var msg = '<div>Restam <span class="js-contador">' + restante + '</span> caracteres a serem digitados.</div>';
            context.after(msg);

            context.on('keyup', function () {
                var digitado = $(this).val().length;
                var restante = total - digitado;

                $(this).parent().find('.js-contador').text(restante);
                if (restante <= 0) {
                    context.attr('maxlength', total);
                }
            });
        });
    }
})( jQuery );