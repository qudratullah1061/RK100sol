$(function () {

    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(400);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        $('.panel-login').removeClass('bigHeight');
    });
    $('#register-form-link').click(function (e) {
        $("#register-form").delay(100).fadeIn(400);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        $('.panel-login').addClass('bigHeight');
    });
    
    

});
