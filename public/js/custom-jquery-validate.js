$.validator.setDefaults({
    errorClass: 'help-block',
    highlight: function (element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
    },
    unhighlight: function (element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
    },
    errorPlacement: function (error, element) {
        if (element.prop('type') === 'checkbox') {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
        
        console.log(element);
    }
});