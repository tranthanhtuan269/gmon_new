$(document).ready(function(){

    $('#menu').mmenu();
    $('#loginHeader').appendTo("body");

    $('#menuRegister').on('click', function() {
        $('#loginHeader .nav .login a').removeClass('active');
        $('#loginHeader .tab-content .login').removeClass('active');
        $('#loginHeader .nav .register a').addClass('active');
        $('#loginHeader .tab-content .register a').addClass('active');
    });
});