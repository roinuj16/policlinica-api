$(document).ready(function () {
    $(function () {
        $("#fomInfo").validate();

        $('#js-descricao').limit({
            'limit': 200
        });

        $('.js-desc01').limit({
            'limit': 89
        });
        $('.js-desc02').limit({
            'limit': 89
        });
        $('.js-desc03').limit({
            'limit': 89
        });
        $('.js-desc04').limit({
            'limit': 89
        });

    });
});