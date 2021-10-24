var Blog = {
    init: function () {
        var $context = this;

        $('.js-submit').click(function(e) {
            e.preventDefault();
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-cancelar').click(function(e) {
            e.preventDefault();
            window.location.href = '/cursos';
        });
    },
    validateForm: function () {

        //Valida Descrição
        var content = tinyMCE.activeEditor.getContent();
        if (content === "" || content === null) {
            toastr.error("Preencha o campo Descrição!");
            return false;
        }

        //Valida nome
        if($(".js_titulo").val().length <= 0 ) {
            toastr.error("Preencha o campo Titulo!");
            $(".js_titulo").focus();
            return false;
        }

        //Valida Imagem
        // console.log('sa', $('input[name="id"]').val());return false;
        // if(!$('input[name="id"]').val() && $(".js-image").val().length <= 0 ) {
        //     toastr.error("Preencha o campo Imagem");
        //     $(".js-image").focus();
        //     return false;
        // }
        return true;
    }
};


$(document).ready(function () {
    Blog.init();
});