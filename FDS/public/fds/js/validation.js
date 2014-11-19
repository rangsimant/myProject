function validatePassword (password,password_confirm) 
{
    $(password_confirm).focusout(function()
    {
        var _password = $(password).val();
        var _password_confirmation = $(password_confirm).val();
        if (password != "") 
        {
            if (_password == _password_confirmation && _password.length >= 4 && _password_confirmation.length >= 4) 
            {
                $("#valid-password").text("PASS").css({color:"Green"});
            }else
            {
                $("#valid-password").text("NOT MATCH").css({color:"Red"});
            };
        };
    });
    $(password).focusout(function()
    {
        var _password = $(password).val();
        var _password_confirmation = $(password_confirm).val();
        if (password != "") 
        {
            if (_password == _password_confirmation && _password.length >= 4 && _password_confirmation.length >= 4) 
            {
                $("#valid-password").text("PASS").css({color:"Green"});
            }else
            {
                $("#valid-password").text("NOT MATCH").css({color:"Red"});
            };
        };
    });
}
function validateEmail(emailAddress) 
{
    $(emailAddress).focusout(function()
    {
        var pattern = new RegExp(/^(\w+)+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        var email = $(emailAddress).val();
        if(pattern.test(email) == true)
        {   
            $("#valid-email").text("PASS").css({color:"Green"});
        }else
        {
            $("#valid-email").text("NOT PASS").css({color:"RED"});
        };
    });
}

function validateInputIsEmpty()
{
    if (($('#username').val() != "" && $('#email').val() != "" && $('#first_name').val() != "" && $('#last_name').val() != "" && $('#password').val() != "" && $('#password_confirmation').val() != "")) {
        var submit = $('button[type=submit]');
        submit.removeAttr("disabled");
    }else
    {
        submit.attr("disabled","disabled");
    };
}

function validateInput(email,password,password_confirm)
{
    $('#form').find(':input').each(function(){
        $(this).change(function(){
            validateEmail(email);
            validatePassword(password,password_confirm);
            validateInputIsEmpty();
        });
    });
}