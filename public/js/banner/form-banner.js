var Cursos = {
    init: function () {
        $('.js-btn').click(function(e) {
            var id =  $(this).data('id');
            var url = window.location.origin +'/status-banner';
            $.ajax({
                type: "get",
                url: url + '/' + id,
                success: function (data) {
                        toastr.success("Registro alterado com sucesso!");
                        location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    }
};


$(document).ready(function () {
    Cursos.init();
});