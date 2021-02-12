require('./bootstrap');

$(function () {
    $('#show_pass').change(function () {
        let pwd = $('#password');
        if ($('#show_pass').is(':checked')) {
            pwd.attr('type', 'text');
        } else {
            pwd.attr('type', 'password');
        }
    });
});
