$(document).ready(function () {
    tinymce.init({
        selector: "textarea",
        height: 450,
        plugins: [
            "advlist autolink autosave link  lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker "
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",

        menubar: false,
        toolbar_items_size: 'small'
    });
});