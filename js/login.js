$(document).ready(function() {
    $("#login").on("click", login);
    $("#login_form").on("submit", login);
    $("#logout").on("click", logout);

    $("#email").on("blur", validateEmailField);
    $("#email").on("input change blur", updateLoginButtonState);
    $("#password").on("input change blur keypress", updateLoginButtonState);

    updateLoginButtonState();

    if (!isLoginPage()) {
        if (localStorage.getItem("auth_token") == "" || localStorage.getItem("auth_token") == null) {
            alert("You are not logged in");
            window.location.href = "login";
        } else {
            $.ajax({
                type: "POST",
                url: base_url + "user/does_token_exist",
                data: {},
                headers: {
                    Authorization: localStorage.getItem("auth_token")
                },
                success: function(response) {
                    if (response.status !== 200) {
                        localStorage.clear();
                        window.location.href = "login";
                    }
                },
                error: function() {
                    localStorage.clear();
                    window.location.href = "login";
                }
            });
        }
    } else {
        if (localStorage.getItem("auth_token") != "" && localStorage.getItem("auth_token") != null) {
            $.ajax({
                type: "POST",
                url: base_url + "user/does_token_exist",
                data: {},
                headers: {
                    Authorization: localStorage.getItem("auth_token")
                },
                success: function(response) {
                    if (response.status == 200) {
                        window.location.href = "user";
                    } else {
                        localStorage.clear();
                    }
                },
                error: function() {
                    localStorage.clear();
                }
            });
        }
    }
});

function isLoginPage() {
    return /\/login(?:\.php)?$/i.test(window.location.pathname) || /\/login(?:\.php)?(?:[?#].*)?$/i.test(window.location.href);
}

function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validateEmailField() {
    var email = $.trim($("#email").val());
    var emailInput = $("input[name='email']");

    emailInput.removeClass("input-error");
    $("#email-error").remove();

    if (email === "") {
        emailInput.addClass("input-error");
        emailInput.after('<div id="email-error" class="form-error" style="color: red; font-size: 12px; margin-top: 5px;">Email is required</div>');
    } else if (!validateEmail(email)) {
        emailInput.addClass("input-error");
        emailInput.after('<div id="email-error" class="form-error" style="color: red; font-size: 12px; margin-top: 5px;">Please provide a valid email address</div>');
    }

    updateLoginButtonState();
}

function updateLoginButtonState() {
    $("#login").prop("disabled", false).css({
        opacity: "1",
        cursor: "pointer"
    });
}

function login(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    var email = $.trim($("#email").val());
    var password = $.trim($("#password").val());

    $("input").removeClass("input-error");
    $("#email-error").remove();

    var hasError = false;

    if (email === "") {
        $("input[name='email']").addClass("input-error");
        hasError = true;
    } else if (!validateEmail(email)) {
        $("input[name='email']").addClass("input-error");
        hasError = true;
    }

    if (password === "") {
        $("input[name='password']").addClass("input-error");
        hasError = true;
    }

    if (hasError) {
        $("#error_msg_div").show();
        if (email === "" || password === "") {
            $("#error_msg_div").html("Please fill in all fields.");
        } else {
            $("#error_msg_div").html("Please provide a valid email address.");
        }
        return false;
    }

    $("#login_loader").show();
    $("#login").hide();
    $("#error_msg_div").hide();

    $.ajax({
        type: "POST",
        url: base_url + "user/login",
        data: {
            email: email,
            password: password
        },
        success: function(response) {
            if (response.status == 200 && response.data && response.data.token) {
                localStorage.setItem("auth_token", response.data.token);
                window.location.href = "user";
            } else {
                $("#login_loader").hide();
                $("#login").show();
                $("#error_msg_div").show();
                $("#error_msg_div").html(response.msg || "Login failed. Please try again.");
            }
        },
        error: function(xhr) {
            var message = "Unable to log in right now. Please try again.";

            if (xhr && xhr.responseJSON && xhr.responseJSON.msg) {
                message = xhr.responseJSON.msg;
            }

            $("#login_loader").hide();
            $("#login").show();
            $("#error_msg_div").show();
            $("#error_msg_div").html(message);
        }
    });

    return false;
}

function logout() {
    $("#logout").hide();
    $("#logout_loader").show();

    $.ajax({
        type: "POST",
        url: base_url + "user/logout",
        data: {},
        headers: {
            Authorization: localStorage.getItem("auth_token")
        },
        success: function(response) {
            if (response.status == 200) {
                localStorage.clear();
                window.location.href = "login";
            } else {
                $("#logout_loader").hide();
                $("#logout").show();
            }
        },
        error: function() {
            $("#logout_loader").hide();
            $("#logout").show();
        }
    });
}

function is_token_valid() {
    $.ajax({
        type: "POST",
        url: base_url + "user/does_token_exist",
        data: {},
        headers: {
            Authorization: localStorage.getItem("auth_token")
        },
        success: function(response) {
            if (response.status == 200) {
                localStorage.clear();
                window.location.href = "login";
            } else {
                $("#logout_loader").hide();
                $("#logout").show();
            }
        },
        error: function() {
            $("#logout_loader").hide();
            $("#logout").show();
        }
    });
}
