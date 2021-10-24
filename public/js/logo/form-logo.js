var Logo = {
    init: function () {
        var $context = this;
        $('.js-submit').click(function(e) {
            e.preventDefault();
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });
    },
    validateForm: function () {
        if(!$('input[name="id"]').val() && $(".js-image").val().length <= 0 ) {
            toastr.error("Preencha o campo Imagem");
            $(".js-image").focus();
            return false;
        }
        return true
    }
};


$(document).ready(function () {
    Logo.init();
});