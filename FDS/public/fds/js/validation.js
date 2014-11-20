function validateCreate()
{
    $('#form').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The First name is required'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The Last name is required'
                    }
                }
            },
            username: {
                validators: {
                    stringLength:{
                        min:5,
                        message: 'The Username must be not less than 5 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            },
            email: {
                onError: function(e, data) {
                    // Do something ...
                },
                onSuccess: function(e, data) {
                    // Do something ...
                },
                onStatus: function(e, data) {
                    // Do something ...
                },
                validators: {
                    notEmpty: {
                        message: 'The E-mail is required'
                    }
                }
            },
            password: {
                validators: {
                    stringLength:{
                        min:4,
                        message: 'The password must be not less than 4 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            },
            password_confirmation: {    
                validators: {
                    stringLength:{
                        min:4,
                        message: 'The password confirm must be not less than 4 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            }
        }
    });
}

function adminValidateCreate()
{
        $('#form').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    stringLength:{
                        min:5,
                        message: 'The Username must be not less than 5 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            },
            email: {
                onError: function(e, data) {
                    // Do something ...
                },
                onSuccess: function(e, data) {
                    // Do something ...
                },
                onStatus: function(e, data) {
                    // Do something ...
                },
                validators: {
                    notEmpty: {
                        message: 'The E-mail is required'
                    }
                }
            },
            password: {
                validators: {
                    stringLength:{
                        min:4,
                        message: 'The password must be not less than 4 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            },
            password_confirmation: {    
                validators: {
                    stringLength:{
                        min:4,
                        message: 'The password confirm must be not less than 4 characters'
                    },
                    notEmpty: {
                        message: 'The Username is required'
                    }
                }
            }
        }
    });
}