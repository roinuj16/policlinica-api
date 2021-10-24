var Cursos = {
    init: function () {
        var $context = this;
        $('.js-valor').maskMoney();
        var $acao = $('input[name="id"]').val();

        $('.js-submit').click(function(e) {
            e.preventDefault();
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-cancelar').click(function(e) {
            e.preventDefault();
            window.location.href = '/list-users';
        });
    },
    validateForm: function () {

        //Valida nome
        if($(".js-nome").val().length <= 0 ) {
            toastr.error("Preencha o campo Nome!");
            $(".js-nome").focus();
            return false;
        }

        //Valida email
        if($(".js-email").val().length <= 0 ) {
            toastr.error("Preencha o campo Email!");
            $(".js-email").focus();
            return false;
        }

        if ($(".js-email").val().length > 0) {
            var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var result = regex.test($(".js-email").val());

            if (!result) {
                toastr.error("Email Inválido!");
                $(".js-email").focus();
                return false;
            }
        }

        //Valida senha
        if($(".js-password").val().length > 0 && $(".js-password-confirm").val().length <= 0) {
            toastr.error("Preencha o campo Confirmar Senha!");
            $(".js-password-confirm").focus();
            return false;
        }

        //Valida Confirmar Senha
        if($(".js-password-confirm").val().length > 0 && $(".js-password").val().length <= 0) {
            toastr.error("Preencha o campo Senha!");
            $(".js-password").focus();
            return false;
        }

        //Valida perfil
        if($(".js-perfil").val() === '0' ) {
            toastr.error("Selecione um Perfil");
            $(".js-perfil").focus();
            return false;
        }



        return true;
    }
};


$(document).ready(function () {
    Cursos.init();
});
