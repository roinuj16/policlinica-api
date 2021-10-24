var Pacientes = {
    init: function () {
        var $context = this;
        $('.js-valor').maskMoney();
        $('.js-telefone').mask('(99) 9 9999-9999');
        $('.js-cep').mask('99999-999');
        $('.js-dt-nascimento').mask('99/99/9999');

        $('.js-submit-sair').click(function(e) {
            e.preventDefault();
            $(".js-acao").val(1)
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-submit-novo').click(function(e) {
            e.preventDefault();
            $(".js-acao").val(2)
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-cancelar-paciente').click(function(e) {
            e.preventDefault();
            window.location.href = '/pacientes';
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

         //Valida Data de Nascimento
        if($(".js-dt-nascimento").val().length <= 0 ) {
            toastr.error("Preencha o campo Data de Nascimento!");
            $(".js-dt-nascimento").focus();
            return false;
        }

        //Valida sexo
        if ($(".js-sexo").val() === '0') {
            toastr.error("Selecione o campo Sexo");
            $(".js-sexo").focus();
            return false;
        }

        //Valida Telefone
        if($(".js-telefone").val().length <= 0 ) {
            toastr.error("Preencha o campo Telefone!");
            $(".js-telefone").focus();
            return false;
        }

        //Valida local cadastro
        if($(".js-local-cadastro").val() === '0' ) {
            toastr.error("Selecione o local da consulta");
            $(".js-local-cadastro").focus();
            return false;
        }

        //Valida Endereço
        if($(".js-endereco").val().length <= 0 ) {
            toastr.error("Preencha o campo Endereço!");
            $(".js-endereco").focus();
            return false;
        }

        //Valida Bairro
        if($(".js-bairro").val().length <= 0 ) {
            toastr.error("Preencha o campo Bairro!");
            $(".js-bairro").focus();
            return false;
        }

        //Valida Cidade
        if($(".js-cidade").val().length <= 0 ) {
            toastr.error("Preencha o campo Cidade!");
            $(".js-cidade").focus();
            return false;
        }

        //Valida Estado
        if($(".js-estado").val().length <= 0 ) {
            toastr.error("Preencha o campo Estado!");
            $(".js-estado").focus();
            return false;
        }



        return true;
    }
};


$(document).ready(function () {
    Pacientes.init();
});
