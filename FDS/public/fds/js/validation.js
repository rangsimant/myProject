function validatePassword (password,password_confirm) {
    $(password_confirm).focusout(function()
    {
        var _password = $(password).val();
        var _password_confirmation = $(password_confirm).val();
        if (password != "") 
        {
            if (_password == _password_confirmation) 
            {
                $("#valid-password").text("PASS");
            }else
            {
                $("#valid-password").text("NOT PASS");
            };
        };
    });
}