var Register = {

    init: function() {
        $("#register").submit(function() {
            console.log('submit');
            return Register.validate();
        });
    },

    validate: function() {

        $('.error').remove();

        var ok = true;

        ok = Register.validateUsername() && ok;
        ok = Register.validateEmail() && ok;
        ok = Register.validateTelephone() && ok;
        ok = Register.validatePassword() && ok;

        return ok;
    },

    validateUsername: function() {

        var maxlen = 40;
        var minlen = 3;
        var invalidChars = /[<#@&*>]/;

        var username = $('#username').val();

        if (username.length < minlen) {
            Register.displayError('#username', 'Username is too short');
            return false;
        }

        if (username.length > maxlen) {
            Register.displayError('#username', 'Username is too long');
            return false;
        }

        if (invalidChars.test(username)) {
            Register.displayError('#username', 'Username contains invalid chars');
            return false;
        }

        return true;
    },

    validateEmail : function() {

        var email = $('#email').val();
        var emailRegex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!emailRegex.test(email)) {
            Register.displayError('#email', 'Please enter a valid email address');
            return false;
        }

        return true;
    },

    validatePassword : function() {

        var minlen = 5;

        var password = $('#password').val();
        var password2 = $('#password2').val();

        if (password !== password2) {
            Register.displayError('#password2', 'Two passwords have to be same');
            return false;
        }

        if (password.length < minlen) {
            Register.displayError('#password', 'Password is too short, 5 letters at least');
            return false;
        }

        // TODO: check password strength

        return true;
    },

    validateTelephone: function() {

        var telephoneRegex = /^\d{3}-?\d{3}-?\d{4}$/
        var telephone = $('#telephone').val();

        if (!telephoneRegex.test(telephone)) {
            Register.displayError('#telephone', 'Please enter a valid telephone number');
            return false;
        }

        return true;
    },

    displayError: function(el, errorMsg) {
        $(el).after('<span class="error">' + errorMsg + '</span>');
    },
};
