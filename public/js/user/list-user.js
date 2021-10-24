var User = {
    init: function () {
        var $context = this;
        $('.js-btn-delete').click(function(e) {
            e.preventDefault();
            var idUser = $(this).data('user');
            $context.delete(idUser)
        });
    },
    delete: function (idUser) {
        $.confirm({
            title: 'EXCLUIR',
            content: 'Confirmar Exclusão?',
            buttons: {
                confirm: {
                    text: 'Sim',
                    btnClass: 'btn-green',
                    keys: [
                        'enter',
                        'shift'
                    ],
                    action: function () {
                        var url = window.location.origin +'/delete-user';
                        $.ajax({
                            type: "get",
                            url: url + '/' + idUser,
                            success: function (data) {
                                if(data == 1) {
                                    toastr.success("Registro deletado com sucesso!");
                                    setTimeout(function(){
                                        location.reload();
                                    }, 1000);
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                },
                cancel: {
                    text: 'Cancelar',
                    btnClass: 'btn-red',
                    keys: [
                        'enter',
                        'shift'
                    ],
                    action: function () {}
                }
            }
        });
    }
};


$(document).ready(function () {
    User.init();
});